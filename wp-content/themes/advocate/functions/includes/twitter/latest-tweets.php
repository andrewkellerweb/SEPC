<?php

// bootstrap Twitter API Wordpress library
if( ! function_exists('twitter_api_get') ){
    require dirname(__FILE__).'/lib/twitter-api.php';
}



/**
 * Pull latest tweets with some caching of raw data.
 * @param string account whose tweets we're pulling
 * @param int number of tweets to get and display
 * @return array blocks of html expected by the widget
 */
function latest_tweets_render( $screen_name, $count, $rts, $ats, $type ){
    try {
        if( ! function_exists('twitter_api_get') ){
            require_once dirname(__FILE__).'/lib/twitter-api.php';
            _twitter_api_init_l10n();
        }
        // We could cache the rendered HTML right here, but this keeps caching abstracted in library
        $ttl = (int) apply_filters('latest_tweets_cache_seconds', 300 ) and
        twitter_api_enable_cache( $ttl );
        // Build API params for "statuses/user_timeline" // https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
        $trim_user = true;
        $include_rts = ! empty($rts);
        $exclude_replies = empty($ats);
				if($type == "search") {
					$q = $screen_name;
	        $params = compact('count','exclude_replies','include_rts','trim_user','q');
				} else {
	        $params = compact('count','exclude_replies','include_rts','trim_user','screen_name');
				}
        if( $exclude_replies || ! $include_rts ){
            // Stripping tweets means we may get less than $count tweets.
            // there is no good way around this other than fetch extra and hope for the best
            $params['count'] *= 3;
        }

				if($type == "search") {
					$tweets = twitter_api_get('search/tweets', $params );
					$tweets = $tweets['statuses'];
				} else {
					$tweets = twitter_api_get('statuses/user_timeline', $params );
				}

        if( isset($tweets[$count]) ){
            $tweets = array_slice( $tweets, 0, $count );
        }
        // render each tweet as a blocks of html for the widget list items
        $rendered = array();
        foreach( $tweets as $tweet ){
            extract( $tweet );
            $link = esc_html( 'http://twitter.com/'.$screen_name.'/status/'.$id_str);
            // render nice datetime, unless theme overrides with filter
            $date = apply_filters( 'latest_tweets_render_date', $created_at );
            if( $date === $created_at ){
                function_exists('twitter_api_relative_date') or twitter_api_include('utils');
                $date = esc_html( twitter_api_relative_date($created_at) );
                $date = '<time datetime="'.$created_at.'">'.$date.'</time>';
            }
            // render and linkify tweet, unless theme overrides with filter
            $html = apply_filters('latest_tweets_render_text', $text );
            if( $html === $text ){
                if( ! function_exists('twitter_api_html') ){
                    twitter_api_include('utils');
                }
                if( ! empty($entities['urls']) || ! empty($entities['media']) ){
                    $text = twitter_api_expand_urls( $text, $entities );
                }
                $html = twitter_api_html( $text );
            }
            // piece together the whole tweet, allowing overide
            $final = apply_filters('latest_tweets_render_tweet', $html, $date, $link );
            if( $final === $html ){
                $final = '<span class="tweet_text">'.$html.'</span> '.
                         '<span class="tweet_time"><a href="'.$link.'" target="_blank">'.$date.'</a></span>';
            }
            $rendered[] = $final;
        }
        return $rendered;
    }
    catch( Exception $Ex ){
        return array( '<p class="tweet-text"><strong>Error:</strong> '.esc_html($Ex->getMessage()).'</p>' );
    }
}

/**
 * latest tweets widget class
 */
class Latest_Tweets_Widget extends WP_Widget {
    
    /** @see WP_Widget::__construct */
    public function __construct( 
        $id_base = false, 
        $name = 'Advocate - Twitter', 
        $widget_options = array('description' => 'Display your latest tweets'), 
        $control_options = array() ){
        
        if( ! function_exists('_twitter_api_init_l10n') ){
            require_once dirname(__FILE__).'/lib/twitter-api.php';
        }
        _twitter_api_init_l10n();
        $this->options = array(
            array (
                'name'  => 'title',
                'label' => __('Widget Title'),
                'type'  => 'text'
            ),
            array (
                'name'  => 'screen_name',
                'label' => __('Twitter Username'),
                'type'  => 'text'
            ),
            array (
                'name'  => 'num',
                'label' => __('Number Of Tweets'),
                'type'  => 'text'
            ),
            array (
                'name'  => 'rts',
                'label' => __('Show Retweets'),
                'type'  => 'bool'
            ),
            array (
                'name'  => 'ats',
                'label' => __('Show Replies'),
                'type'  => 'bool'
            ),
        );
        parent::__construct( $id_base, __($name), $widget_options, $control_options );  
    }    
    
    /* ensure no missing keys in instance params */
    private function check_instance( $instance ){
        if( ! is_array($instance) ){
            $instance = array();
        }
        $instance += array (
            'title' => __('Latest Tweets'),
            'screen_name' => '',
            'num' => '5',
            'rts' => '',
            'ats' => '',
        );
        return $instance;
    }
    
    /** @see WP_Widget::form */
    public function form( $instance ) {
        $instance = $this->check_instance( $instance );
        foreach ( $this->options as $val ) {
            $elmid = $this->get_field_id( $val['name'] );
            $fname = $this->get_field_name($val['name']);
            $value = isset($instance[ $val['name'] ]) ? $instance[ $val['name'] ] : '';
            $label = '<label for="'.$elmid.'">'.$val['label'].'</label>';
            if( 'bool' === $val['type'] ){
                 $checked = $value ? ' checked="checked"' : '';
                 echo '<p><input type="checkbox" value="1" id="'.$elmid.'" name="'.$fname.'"'.$checked.' /> '.$label.'</p>';
            }
            else {
                $attrs = '';
                echo '<p>'.$label.'<br /><input class="widefat" type="text" value="'.esc_attr($value).'" id="'.$elmid.'" name="'.$fname.'" /></p>';
            }
        }
    }

    /** @see WP_Widget::widget */
    public function widget( array $args, $instance ) {
        extract( $this->check_instance($instance) );
        // title is themed via Wordpress widget theming techniques
        $title = $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        // by default tweets are rendered as an unordered list
        $items = latest_tweets_render( $screen_name, $num, $rts, $ats, 'timeline' );
        $list  = apply_filters('latest_tweets_render_list', $items );
        if( is_array($list) ){
            $list = '<ul class="tweet_list"><li>'.implode('</li><li>',$items).'</li></ul>';
        }
        // output widget applying filters to each element
        echo 
        $args['before_widget'], 
            $title,
            '<div class="twitter_stream">', 
                apply_filters( 'latest_tweets_render_before', '' ),
                $list,
                apply_filters( 'latest_tweets_render_after', '' ),
            '</div>',
         $args['after_widget'];
    }
    
}
 


function latest_tweets_register_widget(){
    return register_widget('Latest_Tweets_Widget');
}

add_action( 'widgets_init', 'latest_tweets_register_widget' );


if( is_admin() ){
    if( ! function_exists('twitter_api_get') ){
        require_once dirname(__FILE__).'/lib/twitter-api.php';
    }
    // extra visibility of API settings link
    function latest_tweets_plugin_row_meta( $links, $file ){
        if( false !== strpos($file,'/latest-tweets.php') ){
            $links[] = '<a href="options-general.php?page=twitter-api-admin"><strong>'.esc_attr__('Connect to Twitter').'</strong></a>';
        } 
        return $links;
    }
    add_action('plugin_row_meta', 'latest_tweets_plugin_row_meta', 10, 2 );
}


// -------------- Twitter Notice -------------- //
add_action( 'admin_enqueue_scripts', 'custom_admin_pointers_header' );

function custom_admin_pointers_header() {
   if ( custom_admin_pointers_check() ) {
      add_action( 'admin_print_footer_scripts', 'custom_admin_pointers_footer' );

      wp_enqueue_script( 'wp-pointer' );
      wp_enqueue_style( 'wp-pointer' );
   }
}

function custom_admin_pointers_check() {
   $admin_pointers = custom_admin_pointers();
   foreach ( $admin_pointers as $pointer => $array ) {
      if ( $array['active'] )
         return true;
   }
}

function custom_admin_pointers_footer() {
   $admin_pointers = custom_admin_pointers();
   ?>
<script type="text/javascript">
/* <![CDATA[ */
( function($) {
   <?php
   foreach ( $admin_pointers as $pointer => $array ) {
      if ( $array['active'] ) {
         ?>
         $( '<?php echo $array['anchor_id']; ?>' ).pointer( {
            content: '<?php echo $array['content']; ?>',
            position: {
            edge: '<?php echo $array['edge']; ?>',
            align: '<?php echo $array['align']; ?>'
         },
            close: function() {
               $.post( ajaxurl, {
                  pointer: '<?php echo $pointer; ?>',
                  action: 'dismiss-wp-pointer'
               } );
            }
         } ).pointer( 'open' );
         <?php
      }
   }
   ?>
} )(jQuery);
/* ]]> */
</script>
   <?php
}

function custom_admin_pointers() {
   $dismissed = explode( ',', (string) get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );
   $version = '1_0'; // replace all periods in 1.0 with an underscore
   $prefix = 'custom_admin_pointers' . $version . '_';

   $new_pointer_content = '<h3>' . __( 'Twitter Update' ) . '</h3>';
   $new_pointer_content .= '<p>' . __( 'The Twitter widget and homepage Twitter functionality have been updated and must be configured before you can use it. Check out the Twitter API settings page to get started.' ) . '</p>';

   return array(
      $prefix . 'new_items' => array(
         'content' => $new_pointer_content,
         'anchor_id' => '#menu-settings',
         'edge' => 'left',
         'align' => 'left',
         'active' => ( ! in_array( $prefix . 'new_items', $dismissed ) )
      ),
   );
}

?>
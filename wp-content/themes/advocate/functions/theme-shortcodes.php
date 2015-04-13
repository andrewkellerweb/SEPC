<?php

function t2t_fix_shortcodes($content){   
	
		$new_content = '';
	
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

		$pattern_full = '{(\[raw\].*?\[/raw\])}is';
		$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
		foreach ($pieces as $piece) {
			if (preg_match($pattern_contents, $piece, $matches)) {
				$new_content .= $matches[1];
			} else {
				// Re-add 2 main auto-formatters if not wrapped in RAW tags
				$new_content .= wptexturize(wpautop($piece));
			}
		}

    $new_content = strtr($new_content, $array);
    return $new_content;
}
remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');

// // Apply Formatter
add_filter('the_content', 't2t_fix_shortcodes');
add_filter('widget_text', 't2t_fix_shortcodes', 99);
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Column Shortcodes
/*-----------------------------------------------------------------------------------*/
function t2t_column( $atts, $content = null ) {
  extract(shortcode_atts(array(
    'column' => 'one_third',
    'last' => false
  ), $atts));

  $last_class = '';
  $last_div = '';
  if( $last ) {
    $last_class = ' column_last';
    $last_div = '<div class="clear"></div>';
  }

  return '<div class="' . $column . $last_class . '">' . do_shortcode($content) . '</div>' . $last_div;
}
add_shortcode('column', 't2t_column');

function t2t_one_third( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_third" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 't2t_one_third');

function t2t_one_third_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_third column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 't2t_one_third_last');

function t2t_two_third( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="two_third" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 't2t_two_third');

function t2t_two_third_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="two_third column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_third_last', 't2t_two_third_last');

function t2t_one_half( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_half" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 't2t_one_half');

function t2t_one_half_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_half column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 't2t_one_half_last');

function t2t_one_fourth( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_fourth" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 't2t_one_fourth');

function t2t_one_fourth_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_fourth column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 't2t_one_fourth_last');

function t2t_three_fourth( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="three_fourth" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}

add_shortcode('three_fourth', 't2t_three_fourth');

function t2t_three_fourth_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="three_fourth column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourth_last', 't2t_three_fourth_last');

function t2t_one_fifth( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_fifth" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 't2t_one_fifth');

function t2t_one_fifth_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_fifth column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 't2t_one_fifth_last');

function t2t_two_fifth( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 't2t_two_fifth');

function t2t_two_fifth_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="two_fifth column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 't2t_two_fifth_last');

function t2t_three_fifth( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="three_fifth" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}

add_shortcode('three_fifth', 't2t_three_fifth');

function t2t_three_fifth_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="three_fifth column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 't2t_three_fifth_last');

function t2t_four_fifth( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="four_fifth" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 't2t_four_fifth');

function t2t_four_fifth_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="four_fifth column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 't2t_four_fifth_last');

function t2t_one_sixth( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_sixth" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 't2t_one_sixth');

function t2t_one_sixth_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="one_sixth column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 't2t_one_sixth_last');

function t2t_five_sixth( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="five_sixth" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 't2t_five_sixth');

function t2t_five_sixth_last( $atts, $content = null ) {
   extract(shortcode_atts(array(
   	'id'    => '',
		'style' => ''
   ), $atts));	
   return '<div class="five_sixth column_last" id="'.$id.'" style="'.$style.'">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 't2t_five_sixth_last');


/*-----------------------------------------------------------------------------------*/
/*	Buttons
/*-----------------------------------------------------------------------------------*/
function t2t_button( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'url'     	 => '#',
		'target'     => '_self',
		'style'   => 'white',
		'size'	=> 'small'
    ), $atts));
	
   return '<a class="button '.$size.' '.$style.'" href="'.$url.'">' . do_shortcode($content) . '</a>';
}

add_shortcode('button', 't2t_button');


/*-----------------------------------------------------------------------------------*/
/*	Alerts
/*-----------------------------------------------------------------------------------*/
function t2t_alert( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'style'   => 'white'
    ), $atts));
	
   return '<div class="alert '.$style.'">' . do_shortcode($content) . '</div>';
}

add_shortcode('alert', 't2t_alert');


/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcodes
/*-----------------------------------------------------------------------------------*/
function t2t_toggles( $atts, $content = null ) {
    
    $output = '<div class="toggle_list">';
		$output .= '<ul>';
        
    $myContent = do_shortcode($content);
    $output .= $myContent;
    $output .= '</ul>';
    $output .= '</div>';
    
    return $output;
}

add_shortcode('toggles', 't2t_toggles');

function t2t_toggle( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'title' => 'notabletitle',
				'opened' => "false"
    ), $atts));
    
    if( $title == 'notabtitle' ) { return; }
		if( $opened == "true" ) {
			$toggle_class = "opened";
		} else {
			$toggle_class = "";
		}
    
    $output = '<li class="'. $toggle_class .'">';
		$output .= '<div class="title"><h3>'. do_shortcode($title) .'</h3> <a href="javascript:;" class="toggle_link" data-open_text="+" data-close_text="-"></a></div>';
		$output .= '<div class="content">'. do_shortcode($content) . '</div>';
		$output .= '</li>';
		
    
    return $output;
}

add_shortcode('toggle', 't2t_toggle');

/*-----------------------------------------------------------------------------------*/
/*	Tabs Shortcodes
/*-----------------------------------------------------------------------------------*/
function t2t_tabs( $atts, $content = null ) {
  $defaults = array();
  extract( shortcode_atts( $defaults, $atts ) );

  STATIC $i = 0;
  $i++;

  // Extract the tab titles for use in the tab widget.
  preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );

  $tab_titles = array();
  if( isset($matches[1]) ){ $tab_titles = $matches[1]; }

  $output = '';

  if( count($tab_titles) ){
      $output .= '<div id="tabs-'. $i .'" class="tabs"><div class="inner">';
    $output .= '<ul class="nav">';

    foreach( $tab_titles as $tab ){
      $output .= '<li><a href="javascript:;" class="'. sanitize_title( $tab[0] ) .'">' . $tab[0] . '</a></li>';
    }

      $output .= '</ul>';
      $output .= do_shortcode( $content );
      $output .= '</div></div>';
  } else {
    $output .= do_shortcode( $content );
  }

  return $output;
}
add_shortcode( 'tabs', 't2t_tabs' );


function t2t_tab( $atts, $content = null ) {
  $defaults = array( 'title' => 'Tab' );
  extract( shortcode_atts( $defaults, $atts ) );

  return '<div id="'. sanitize_title( $title ) .'" class="pane">'. do_shortcode( $content ) .'</div>';
}
add_shortcode( 'tab', 't2t_tab' );

function t2t_contact_form($atts, $content) {
	extract(shortcode_atts(array(
		"contact_email" => get_option('t2t_contact_form_email'),
		"subjects" => 'Volunteer, Donation, Programs',
		"button_color" => 'white'		
	), $atts));
	
	$subjects = explode(",", $subjects);
	
	$out = '<div id="contact">';
	$out .= '<div class="full">';
	$out .= '<div class="validation"><p>Oops! Please check your submission...</p></div>';
	$out .= '<div class="success"><p>Thanks! I will get back to you shortly.</p></div>';
	$out .= '<form action="javascript:;" method="post" id="shortcode_contact">';
	$out .= '<input type="hidden" id="form_action" name="form_action" value="'.get_template_directory_uri().'/functions/includes/send_email.php" />';
	$out .= '<input type="hidden" name="send_to" value="'.$contact_email.'" />';	
	$out .= '<div class="row"><p>';
	$out .= '<label for="name">'.__('Your Name', 'framework').'</label>';
	$out .= '<input type="text" name="name" id="name" />';
	$out .= '</p><p>';
	$out .= '<label for="phone">'.__('Phone', 'framework').'</label>';
	$out .= '<input type="text" name="phone" id="phone" />';
	$out .= '</p></div>';
	$out .= '<div class="row"><p>';
	$out .= '<label for="email">'.__('Email', 'framework').'</label>';
	$out .= '<input type="text" name="email" id="email" />';
	$out .= '</p><p>';
	$out .= '<label for="subject">'.__('Subject', 'framework').'</label>';	
	$out .= '<input type="text" name="subject" id="subject" />';
	$out .= '</p></div>';
	$out .= '<p>';
	$out .= '<label for="message">'.__('Message / Question', 'framework').'</label>';
	$out .= '<textarea class="text_field" id="message" name="message"></textarea>';
	$out .= '</p>';
	$out .= '<input type="submit" class="button '.$button_color.'" value="'.__('Send Message', 'framework').'" />';
	$out .= '</form>';
	$out .= '</div>';
	$out .= '</div>';
	
	return $out;
}
add_shortcode("contact_form", "t2t_contact_form");

/*-----------------------------------------------------------------------------------*/
/*	Features Boxes
/*-----------------------------------------------------------------------------------*/
function t2t_features( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'amount'     	 => '4',
		'icon_choice'	 => '2'
    ), $atts));
	
	$query = new WP_Query();
	$query->query('post_type=t2t_feature&order=DESC&posts_per_page='.$amount.'');
	while ($query->have_posts()) : $query->the_post();
	$title = the_title();
	$content = the_content();
		$out = '<div class="box one_half">';
		$out .= '<div class="inner">';
		$out .= '<div class="box_heading"> <span class="icon general-enclosed">'.$icon_choice.'</span>';
		$out .= '<h4>'.$title.'</h4>';
		$out .= '</div>';
		$out .= '<p>'.$content.'</p>';
		$out .= '</div>';
		$out .= '</div>';
		return $out;
	endwhile;
	wp_reset_query();
}

add_shortcode('features', 't2t_features');

/*-----------------------------------------------------------------------------------*/
/*	Donation Options
/*-----------------------------------------------------------------------------------*/
function t2t_donation_options( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'description'     	 => 'Cras mattis consectetur purus sit amet fermentum.'
    ), $atts));

	if($description == "") {
		$description = "";
		$class_name = "full_width";
	} else {
		$description = '<p class="choose">'.$description.'</p>';
		$class_name = "";
	}
	
    return '<div id="donation_level">'.$description.'<ul class="amount '.$class_name.'">'.do_shortcode($content).'</ul></div>';
}

add_shortcode('donation_options', 't2t_donation_options');

/*-----------------------------------------------------------------------------------*/
/*	Donatation Option
/*-----------------------------------------------------------------------------------*/
function t2t_donation_option( $atts, $content = null ) {
	
	extract(shortcode_atts(array(
		'amount'     	 => '$5',
		'link'			 => '#',
		'color'			 => 'green', 'yellow', 'orange', 'brown', 'teal',
		'text'           => 'Donate'
    ), $atts));
	
		$out = '<li><a href="'.$link.'" class="'.$color.'">'.$text.' <h3>'.$amount.'</h3></a></li>';
		return ''.$out.'';
}

add_shortcode('donation_option', 't2t_donation_option');

/*-----------------------------------------------------------------------------------*/
/*	Box Headings
/*-----------------------------------------------------------------------------------*/

function t2t_section_heading($atts, $content = null) {
	return '<div class="box_heading"><h2>'.do_shortcode($content).'</h2><span class="line"></span></div>';
}
add_shortcode('section_heading', 't2t_section_heading');

/*-----------------------------------------------------------------------------------*/
/*	Donation Page Features
/*-----------------------------------------------------------------------------------*/

function t2t_feature_list($atts, $content = null) {
	
	global $post;
	
	extract(shortcode_atts(array(
		'amount'     	 => 4
    ), $atts));

	$out = '<div id="actions" class="full_width">';

	$query = new WP_Query();
	$query->query(array( 'post_type' => 't2t_feature', 'posts_per_page' => $amount, 'order' => 'DESC' ));
	while ($query->have_posts()) : $query->the_post();		
		$title_link = get_post_meta($post->ID, '_read_more', true);
		if($title_link == 1) { 
			$title = '<a href="'.get_permalink().'">'.$post->post_title.'</a>';
		} else { 
			$title = $post->post_title;
		}
		$content = get_the_excerpt();
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		$icon = get_post_meta($post->ID, '_select_icon', true);
		$out .= '<div class="box one_half"><div class="inner"><div class="box_heading"><span class="icon general-enclosed">'.$icon.'</span><h4>'.$title.'</h4></div>'.$content.'</div></div>';
	endwhile;
	wp_reset_query();
	
	$out .= "</div>";
	return $out;
}
add_shortcode('feature_list', 't2t_feature_list');


/*-----------------------------------------------------------------------------------*/
/*	Recent Posts
/*-----------------------------------------------------------------------------------*/
function t2t_recent_posts($atts, $content = null) {
	
	extract(shortcode_atts(array(
		'title'     	 => 'Blog',
		'amount'         => 3
    ), $atts));
	
	$category = 0;
	$recent_posts = wp_get_recent_posts(array('numberposts' => $amount, 'category' => $category, 'post_type' => 'post', 'post_status' => 'publish'));

	$out = '<div class="box_heading">';
    $out .= '<h2>'.$title.'</h2>';
    $out .= '<span class="line"></span></div>';
	
	$posts = "";
    foreach( $recent_posts as $recent ){
    $posts .= '<li>';
    $posts .= '<h5><a href="'.get_permalink($recent['ID']).'">'.$recent["post_title"].'</a></h5>';
    $posts .= '<p>'.t2t_truncate($recent["post_content"], 70, "...").'</p>';
    $posts .= '<a href="'.get_permalink($recent["ID"]).'">';
    $posts .= '</a> </li>';
   	}

	$out .= '<div class="news"><ul>';
	$out .= $posts;
    $out .= '</ul></div>';

	return $out;
}
add_shortcode('recent_posts', 't2t_recent_posts');

/*-----------------------------------------------------------------------------------*/
/*	Sponsors
/*-----------------------------------------------------------------------------------*/
function t2t_sponsors($atts, $content = null) {
	global $post; 
	
	extract(shortcode_atts(array(
		'title'     	 => 'Our Sponsors',
		'amount'         => 3
    ), $atts));
	
	$category = 0;
	$recent_posts = wp_get_recent_posts(array('numberposts' => $amount, 'category' => $category, 'post_type' => 'post', 'post_status' => 'publish'));

	$out = '<div class="box_heading">';
    $out .= '<h2>'.$title.'</h2>';
    $out .= '<span class="line"></span></div>';

	$i = 0;
	$sponsors = "";
	$query = new WP_Query();
	$query->query(array( 'post_type' => 't2t_sponsor', 'posts_per_page' => $amount ));
	while ($query->have_posts()) : $query->the_post();
    
	if($i % 2 == 0) { $class_name = ""; } else { $class_name = "last"; }

 	$sponsors .= '<li class="'.$class_name.'">';
    $image_id = get_post_thumbnail_id();  
    $image_url = wp_get_attachment_image_src($image_id,'sponsor-thumbnail');  
    $image_url = $image_url[0];

    if (has_post_thumbnail()) {
			if(get_post_meta($post->ID, '_url', true)) {
				$sponsors .= '<a href="'.get_post_meta($post->ID, '_url', true).'" target="_blank"><img src="'.$image_url.'" alt="'.get_the_title().'" /></a>';
			} else {
    		$sponsors .= '<img src="'.$image_url.'" alt="'.get_the_title().'" />';
			}
    }
    
    $sponsors .= '</li>';
	$i += 1;
    endwhile;
	wp_reset_query();
	
	$out .= '<div id="sponsors"><ul>';
	$out .= $sponsors;
   	$out .= '</ul></div>';

	return $out;
}
add_shortcode('sponsors', 't2t_sponsors');


/*-----------------------------------------------------------------------------------*/
/*	Events
/*-----------------------------------------------------------------------------------*/
function t2t_events($atts, $content = null) {
	global $post;
	
	extract(shortcode_atts(array(
		'title'     	 => 'Events',
		'amount'         => 3
    ), $atts));
	
	$out = '<div class="box_heading">';
    $out .= '<h2>'.$title.'</h2>';
    $out .= '<span class="line"></span></div>';
	
	$events = "";
	
	$query = new WP_Query();
	$query->query('post_type=t2t_event&posts_per_page='.$amount);
	while ($query->have_posts()) : $query->the_post();
		if(strtotime(get_post_meta($post->ID, '_start_date', true)) > strtotime("-1 day")) {		
		$events .= '<li>';
		$events .= '<div class="date"><span>'.gmdate('j', strtotime(get_post_meta($post->ID, '_start_date', true))).'</span> '.gmdate('M', strtotime(get_post_meta($post->ID, '_start_date', true))).'</div>';
		$events .= '<div class="details">';
		$events .= '<h5><a href="'. get_permalink() .'">' . get_the_title() . '</a></h5>';
		$events .= '<p>'.gmdate('g:i a', strtotime(get_post_meta($post->ID, '_start_date', true))).' @ '.get_post_meta($post->ID, '_venue_name', true).'</p>';
		$events .= '</div>';
		$events .= '</li>';
		}
   	
	endwhile;
	wp_reset_query();

	$out .= '<div class="events"><ul>';
	$out .= $events;
    $out .= '</ul></div>';

	return $out;
}
add_shortcode('events', 't2t_events');

?>
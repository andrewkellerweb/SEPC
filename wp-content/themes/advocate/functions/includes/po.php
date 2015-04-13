<?php

define('CPTPATH', THEME_FUNCTIONS);
define('CPTURL', THEME_FUNCTIONS);
    
function userdata_get_user_level($return_as_numeric = FALSE)
    {
        global $userdata;
        
        $user_level = '';
        for ($i=10; $i >= 0;$i--)
            {
                if (current_user_can('level_' . $i) === TRUE)
                    {
                        $user_level = $i;
                        if ($return_as_numeric === FALSE)
                            $user_level = 'level_'.$i;    
                        break;
                    }    
            }        
        return ($user_level);
    }

add_filter('pre_get_posts', 'CPTO_pre_get_posts');
function CPTO_pre_get_posts($query)
    {
       
        if (is_admin())
            {
                //no need if it's admin interface
                return false;   
            }

        //remove the supresed filters;
        if (isset($query->query['suppress_filters']))
            $query->query['suppress_filters'] = FALSE;    
        
        if (isset($query->query_vars['suppress_filters']))
            $query->query_vars['suppress_filters'] = FALSE;
            
        return $query;
    }

add_filter('posts_orderby', 'CPTOrderPosts');
function CPTOrderPosts($orderBy) 
    {
        global $wpdb;
        
        
        if (is_admin())
                {
                    $orderBy = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";
                }
            else
                {
                    $orderBy = "{$wpdb->posts}.menu_order, {$wpdb->posts}.post_date DESC";
                }

        return($orderBy);
    }

    
add_action('wp_loaded', 'initCPTO' ); 	
function initCPTO() 
    {
	    global $custom_post_type_order, $userdata;

        if (is_admin())
            {
                $custom_post_type_order = new CPTO();   
            }        
    }
    
add_filter('get_previous_post_where', 'cpto_get_previous_post_where');
add_filter('get_previous_post_sort', 'cpto_get_previous_post_sort');
add_filter('get_next_post_where', 'cpto_get_next_post_where');
add_filter('get_next_post_sort', 'cpto_get_next_post_sort');
function cpto_get_previous_post_where($where)
    {
        global $post, $wpdb;

        if ( empty( $post ) )
            return $where;

        $current_post_date = $post->post_date;

        $join = '';
        $posts_in_ex_cats_sql = '';
		if(isset($in_same_cat)) { $in_same_cat = $in_same_cat; } else { $in_same_cat = ''; }
        if ($in_same_cat || !empty($excluded_categories) ) 
            {
                $join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

                if ( $in_same_cat ) {
                    $cat_array = wp_get_object_terms($post->ID, 'category', array('fields' => 'ids'));
                    $join .= " AND tt.taxonomy = 'category' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
                }

                $posts_in_ex_cats_sql = "AND tt.taxonomy = 'category'";
                if ( !empty($excluded_categories) ) {
                    $excluded_categories = array_map('intval', explode(' and ', $excluded_categories));
                    if ( !empty($cat_array) ) {
                        $excluded_categories = array_diff($excluded_categories, $cat_array);
                        $posts_in_ex_cats_sql = '';
                    }

                    if ( !empty($excluded_categories) ) {
                        $posts_in_ex_cats_sql = " AND tt.taxonomy = 'category' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
                    }
                }
            }
        $current_menu_order = $post->menu_order;
        
        //check if there are more posts with lower menu_order
        $query = "SELECT p.* FROM $wpdb->posts AS p
                    WHERE p.menu_order < '".$current_menu_order."' AND p.post_type = '". $post->post_type ."' AND p.post_status = 'publish' $posts_in_ex_cats_sql";
        $results = $wpdb->get_results($query);
                
        if (count($results) > 0)
            {
                $where = $wpdb->prepare("WHERE p.menu_order < %d AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_menu_order, $post->post_type);        
            }
            else
                {
                    $where = $wpdb->prepare("WHERE p.post_date < %d AND p.post_type = %s AND p.post_status = 'publish' AND p.ID != %g $posts_in_ex_cats_sql", $current_post_date, $post->post_type, $post->ID);            
                }
        
        return $where;
    }
    
function cpto_get_previous_post_sort($sort)
    {
        global $post, $wpdb;
        
        $current_menu_order = $post->menu_order; 
        if(isset($posts_in_ex_cats_sql)) { $posts_in_ex_cats_sql = $posts_in_ex_cats_sql; } else { $posts_in_ex_cats_sql = ''; }
        $query = "SELECT p.* FROM $wpdb->posts AS p
                    WHERE p.menu_order < '".$current_menu_order."' AND p.post_type = '". $post->post_type ."' AND p.post_status = 'publish' $posts_in_ex_cats_sql";
        $results = $wpdb->get_results($query);
        
        if (count($results) > 0)
                {
                    $sort = 'ORDER BY p.menu_order DESC, p.post_date ASC LIMIT 1';
                }
            else
                {
                    $sort = 'ORDER BY p.post_date DESC LIMIT 1';
                }

        return $sort;
    }

function cpto_get_next_post_where($where)
    {
        global $post, $wpdb;

        if ( empty( $post ) )
            return null;

        $current_post_date = $post->post_date;

        $join = '';
        $posts_in_ex_cats_sql = '';
		if(isset($in_same_cat)) { $in_same_cat = $in_same_cat; } else { $in_same_cat = ''; }
        if ( $in_same_cat || !empty($excluded_categories) ) 
            {
                $join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

                if ( $in_same_cat ) {
                    $cat_array = wp_get_object_terms($post->ID, 'category', array('fields' => 'ids'));
                    $join .= " AND tt.taxonomy = 'category' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
                }

                $posts_in_ex_cats_sql = "AND tt.taxonomy = 'category'";
                if ( !empty($excluded_categories) ) {
                    $excluded_categories = array_map('intval', explode(' and ', $excluded_categories));
                    if ( !empty($cat_array) ) {
                        $excluded_categories = array_diff($excluded_categories, $cat_array);
                        $posts_in_ex_cats_sql = '';
                    }

                    if ( !empty($excluded_categories) ) {
                        $posts_in_ex_cats_sql = " AND tt.taxonomy = 'category' AND tt.term_id NOT IN (" . implode($excluded_categories, ',') . ')';
                    }
                }
            }
        
        $current_menu_order = $post->menu_order;
        
        //check if there are more posts with lower menu_order
        $query = "SELECT p.* FROM $wpdb->posts AS p
                    WHERE p.menu_order > '".$current_menu_order."' AND p.post_type = '". $post->post_type ."' AND p.post_status = 'publish' $posts_in_ex_cats_sql";
        $results = $wpdb->get_results($query);
        
        if (count($results) > 0)
            {
                $where = $wpdb->prepare("WHERE p.menu_order > %d AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_menu_order, $post->post_type);        
            }
            else
                {
                    $where = $wpdb->prepare("WHERE p.post_date > %d AND p.post_type = %s AND p.post_status = 'publish' AND p.ID != %g $posts_in_ex_cats_sql", $current_post_date, $post->post_type, $post->ID);            
                }
        
        return $where;
    }

function cpto_get_next_post_sort($sort)
    {
        global $post, $wpdb; 
        
        $current_menu_order = $post->menu_order; 
        if(isset($posts_in_ex_cats_sql)) { $posts_in_ex_cats_sql = $posts_in_ex_cats_sql; } else { $posts_in_ex_cats_sql = ''; }
        $query = "SELECT p.* FROM $wpdb->posts AS p
                    WHERE p.menu_order > '".$current_menu_order."' AND p.post_type = '". $post->post_type ."' AND p.post_status = 'publish' $posts_in_ex_cats_sql";
        $results = $wpdb->get_results($query);
        if (count($results) > 0)
                {
                    $sort = 'ORDER BY p.menu_order ASC, p.post_date DESC LIMIT 1';
                }
            else
                {
                    $sort = 'ORDER BY p.post_date ASC LIMIT 1';
                }
        
        return $sort;    
    }
    
    
class Post_Types_Order_Walker extends Walker 
    {

        var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');


        function start_lvl(&$output, $depth) {
            $indent = str_repeat("\t", $depth);
            $output .= "\n$indent<ul class='children'>\n";
        }


        function end_lvl(&$output, $depth) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }


        function start_el(&$output, $page, $depth, $args) {
            if ( $depth )
                $indent = str_repeat("\t", $depth);
            else
                $indent = '';

            extract($args, EXTR_SKIP);
			
			$terms = wp_get_object_terms( $page->ID, 'service_category' );

			foreach( $terms as $term )
				if(isset($term->name)) {
			    $term_names[] = $term->name;
				}

			if(isset($term_names)) {
				$categories = implode( ', ', $term_names );
			} else {
				$categories = "";
			}
			
			
            $output .= $indent . '<li id="item_'.$page->ID.'"><span><em>'.apply_filters( 'the_title', $page->post_title, $page->ID ).' </em>'.$categories.'</span>';
        }


        function end_el(&$output, $page, $depth) {
            $output .= "</li>\n";
        }

    }


class CPTO 
    {
	    var $current_post_type = null;
	    
	    function CPTO() 
            {
		        add_action( 'admin_init', array(&$this, 'registerFiles'), 11 );
                add_action( 'admin_init', array(&$this, 'checkPost'), 10 );
		        add_action( 'admin_menu', array(&$this, 'addMenu') );
                
                
		        
		        add_action( 'wp_ajax_update-custom-type-order', array(&$this, 'saveAjaxOrder') );
	        }

	    function registerFiles() 
            {
		        if ( $this->current_post_type != null ) 
                    {
                        wp_enqueue_script('jQuery');
                        wp_enqueue_script('jquery-ui-sortable');
		            }
                    
	        }
	    
	    function checkPost() 
            {
		        if ( isset($_GET['page']) && substr($_GET['page'], 0, 17) == 'order-post-types-' ) 
                    {
			            $this->current_post_type = get_post_type_object(str_replace( 'order-post-types-', '', $_GET['page'] ));
			            if ( $this->current_post_type == null) 
                            {
				                wp_die('Invalid post type');
			                }
		            }
	        }
	    
	    function saveAjaxOrder() 
            {
		        global $wpdb;
		        
		        parse_str($_POST['order'], $data);
		        
		        if (is_array($data))
                foreach($data as $key => $values ) 
                    {
			            if ( $key == 'item' ) 
                            {
				                foreach( $values as $position => $id ) 
                                    {
					                    $wpdb->update( $wpdb->posts, array('menu_order' => $position, 'post_parent' => 0), array('ID' => $id) );
				                    } 
			                } 
                        else 
                            {
				                foreach( $values as $position => $id ) 
                                    {
					                    $wpdb->update( $wpdb->posts, array('menu_order' => $position, 'post_parent' => str_replace('item_', '', $key)), array('ID' => $id) );
				                    }
			                }
		            }
	        }
	    

	    function addMenu() 
            {
		        global $userdata;
                //put a menu for all custom_type
                $post_types = get_post_types();
                foreach( $post_types as $post_type_name ) 
                    {                        
                        if ($post_type_name != 'posts'){
						
						$pretty_name = explode("_", $post_type_name);
						if(isset($pretty_name[1])) { $pretty_name = ucwords($pretty_name[1]); }
							
                                if (!is_post_type_hierarchical($post_type_name))
                                    add_submenu_page('edit.php?post_type='.$post_type_name, $pretty_name.' Order', $pretty_name.' Order', 'manage_options', 'order-post-types-'.$post_type_name, array(&$this, 'SortPage') );
                        }
		            }
	        }
	    

	    function SortPage() 
            {
		        ?>
		        <div class="wrap">
			        <div class="icon32" id="icon-edit"><br></div>
                    <h2>Services Order</h2>                   
			        <div id="ajax-response"></div>
			        
			        <noscript>
				        <div class="error message">
					        <p>This plugin can't work without javascript, because it's use drag and drop and AJAX.</p>
				        </div>
			        </noscript>
			        
			        <div id="order-post-type">
				        <ul id="sortable">
					        <?php $this->listPages('hide_empty=0&title_li=&post_type='.$this->current_post_type->name); ?>
				        </ul>
				        
				        <div class="clear"></div>
			        </div>
			        
			        <p class="submit">
				        <a href="#" id="save-order" class="button-primary">Update</a>
			        </p>
			        
			        <script type="text/javascript">
				        jQuery(document).ready(function() {
					        jQuery("#sortable").sortable({
						        'tolerance':'intersect',
						        'cursor':'pointer',
						        'items':'li',
						        'placeholder':'placeholder',
						        'nested': 'ul'
					        });
					        
					        jQuery("#sortable").disableSelection();
					        jQuery("#save-order").bind( "click", function() {
						        jQuery.post( ajaxurl, { action:'update-custom-type-order', order:jQuery("#sortable").sortable("serialize") }, function() {
							        jQuery("#ajax-response").html('<div class="message updated fade"><p>Items Order Updates</p></div>');
							        jQuery("#ajax-response div").delay(3000).hide("slow");
						        });
					        });
				        });
			        </script>
                    
		        </div>
		        <?php
	        }

	    function listPages($args = '') 
            {
		        $defaults = array(
			        'depth' => 0, 'show_date' => '',
			        'date_format' => get_option('date_format'),
			        'child_of' => 0, 'exclude' => '',
			        'title_li' => 'Pages', 'echo' => 1,
			        'authors' => '', 'sort_column' => 'menu_order',
			        'link_before' => '', 'link_after' => '', 'walker' => ''
		        );

		        $r = wp_parse_args( $args, $defaults );
		        extract( $r, EXTR_SKIP );

		        $output = '';
	        
		        $r['exclude'] = preg_replace('/[^0-9,]/', '', $r['exclude']);
		        $exclude_array = ( $r['exclude'] ) ? explode(',', $r['exclude']) : array();
		        $r['exclude'] = implode( ',', apply_filters('wp_list_pages_excludes', $exclude_array) );

		        // Query pages.
		        $r['hierarchical'] = 0;
                $args = array(
                            'sort_column'   =>  'menu_order',
                            'post_type'     =>  $post_type,
                            'posts_per_page' => -1,
                            'orderby'        => 'menu_order',
                            'order'         => 'ASC'
                );
                
                $the_query = new WP_Query($args);
                $pages = $the_query->posts;

		        if ( !empty($pages) ) {
			        if ( $r['title_li'] )
				        $output .= '<li class="pagenav intersect">' . $r['title_li'] . '<ul>';
				        
			        $output .= $this->walkTree($pages, $r['depth'], $r);

			        if ( $r['title_li'] )
				        $output .= '</ul></li>';
		        }

		        $output = apply_filters('wp_list_pages', $output, $r);

		        if ( $r['echo'] )
			        echo $output;
		        else
			        return $output;
	        }
	    
	    function walkTree($pages, $depth, $r) 
            {
		        if ( empty($r['walker']) )
			        $walker = new Post_Types_Order_Walker;
		        else
			        $walker = $r['walker'];

		        $args = array($pages, $depth, $r);
		        return call_user_func_array(array(&$walker, 'walk'), $args);
	        }
    }
   

?>
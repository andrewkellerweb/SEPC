<?php

define('TOPATH',    THEME_FUNCTIONS);
define('TOURL',     THEME_FUNCTIONS);

add_action('admin_menu', 'TOPluginMenu', 99);

function TOPluginMenu() 
    {
        include (TOPATH . '/includes/to-interface.php');
        include (TOPATH . '/includes/to-terms_walker.php');
                                
         //put a menu within all custom types if apply
        $post_types = get_post_types();
        foreach( $post_types as $post_type) 
            {
                    
                //check if there are any taxonomy for this post type
                $post_type_taxonomies = get_object_taxonomies($post_type);
                
                foreach ($post_type_taxonomies as $key => $taxonomy_name)
                    {
                        $taxonomy_info = get_taxonomy($taxonomy_name);  
                        if ($taxonomy_info->hierarchical !== TRUE) 
                            unset($post_type_taxonomies[$key]);
                    }
                    
                if (count($post_type_taxonomies) == 0)
                    continue;                
                
                if($post_type != 'posts' ) {
                    add_submenu_page('edit.php?post_type='.$post_type, 'Category Order', 'Category Order', 'manage_options', 'to-interface-'.$post_type, 'TOPluginInterface' );	
				}
            }
    }
    
    
add_action( 'wp_ajax_update-custom-type-order-hierarchical', array(&$this, 'saveAjaxOrderHierarchical') );
    

function mycategoryorder_applyorderfilter($orderby, $args)
    {
        return 't.term_order';
        return $orderby; 
    }

add_filter('get_terms_orderby', 'mycategoryorder_applyorderfilter', 10, 2);


add_action( 'wp_ajax_update-taxonomy-order', 'TOsaveAjaxOrder' );
function TOsaveAjaxOrder()
    {
        global $wpdb; 
        $taxonomy = stripslashes($_POST['taxonomy']);
        $data = stripslashes($_POST['order']);
        $unserialised_data = unserialize($data);
                
        if (is_array($unserialised_data))
        foreach($unserialised_data as $key => $values ) 
            {
                //$key_parent = str_replace("item_", "", $key);
                $items = explode("&", $values);
                unset($item);
                foreach ($items as $item_key => $item_)
                    {
                        $items[$item_key] = trim(str_replace("item[]=", "",$item_));
                    }
                
                if (is_array($items) && count($items) > 0)
                foreach( $items as $item_key => $term_id ) 
                    {
                        $wpdb->update( $wpdb->terms, array('term_order' => ($item_key + 1)), array('term_id' => $term_id) );
                    } 
            }
    }


?>

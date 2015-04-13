<?php

function t2t_build_taxonomies() {
	register_taxonomy( 'gallery_albums', 't2t_gallery', array( 'hierarchical' => true, 'label' => 'Albums', 'query_var' => 'albums', 'rewrite' => true ) );	
	register_taxonomy( 'event_gategories', 't2t_gallery', array( 'hierarchical' => true, 'label' => 'Categories', 'query_var' => 'categories', 'rewrite' => true ) );	
}

add_action( 'init', 't2t_build_taxonomies', 0 );

function t2t_post_types() {
	
	// Start Gallery Custom Post Type
	$labels = array(
		'name' => __( 'Galleries', 'framework'),
		'singular_name' => __( 'Gallery', 'framework' ),
		'add_new' => __('Add New Item', 'framework'),
		'add_new_item' => __('Add New Item', 'framework'),
		'edit_item' => __('Edit Item', 'framework'),
		'new_item' => __('New Item', 'framework'),
		'view_item' => __('View Item', 'framework'),
		'search_items' => __('Search Items', 'framework'),
		'not_found' =>  __('No items found', 'framework'),
		'not_found_in_trash' => __('No items found in Trash', 'framework'), 
		'parent_item_colon' => ''
	 );
	
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true,
	  'exclude_from_search' => true,
	  'query_var' => true,
	  'rewrite' => array( 'slug' => __('gallery', 'framework') ),
	  'capability_type' => 'post',
	  'hierarchical' => false,
	  'menu_position' => 20,
	  'supports' => array('title','editor','thumbnail', 'comments'),
	);
	register_post_type(__('t2t_gallery', 'framework'), $args);
	// End Gallery Custom Post Type
	
	// Start Features Custom Post Type
	$labels = array(
		'name' => __( 'Features', 'framework'),
		'singular_name' => __( 'Feature', 'framework' ),
		'add_new' => __('Add New Item', 'framework'),
		'add_new_item' => __('Add New Item', 'framework'),
		'edit_item' => __('Edit Item', 'framework'),
		'new_item' => __('New Item', 'framework'),
		'view_item' => __('View Item', 'framework'),
		'search_items' => __('Search Items', 'framework'),
		'not_found' =>  __('No items found', 'framework'),
		'not_found_in_trash' => __('No items found in Trash', 'framework'), 
		'parent_item_colon' => ''
	 );
	 
	 $args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true,
	  'exclude_from_search' => true,
	  'query_var' => true,
	  'rewrite' => array( 'slug' => __('feature', 'framework') ),
	  'capability_type' => 'post',
	  'hierarchical' => false,
	  'menu_position' => 20,
	  'supports' => array('title','editor','thumbnail','custom-fields','comments'),
	);
	register_post_type(__('t2t_feature', 'framework'), $args);
	// End Sponsor Custom Post Type
	
	// Start Sponsors Custom Post Type
	$labels = array(
		'name' => __( 'Sponsors', 'framework'),
		'singular_name' => __( 'Sponsor', 'framework' ),
		'add_new' => __('Add New Item', 'framework'),
		'add_new_item' => __('Add New Item', 'framework'),
		'edit_item' => __('Edit Item', 'framework'),
		'new_item' => __('New Item', 'framework'),
		'view_item' => __('View Item', 'framework'),
		'search_items' => __('Search Items', 'framework'),
		'not_found' =>  __('No items found', 'framework'),
		'not_found_in_trash' => __('No items found in Trash', 'framework'), 
		'parent_item_colon' => ''
	 );
	 
	 $args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true,
	  'exclude_from_search' => true,
	  'query_var' => true,
	  'rewrite' => array( 'slug' => __('sponsor', 'framework') ),
	  'capability_type' => 'post',
	  'hierarchical' => false,
	  'menu_position' => 20,
	  'supports' => array('title','thumbnail'),
	);
	register_post_type(__('t2t_sponsor', 'framework'), $args);
	// End Sponsor Custom Post Type
	
	// Start Events Custom Post Type
	$labels = array(
		'name' => __( 'Events', 'framework'),
		'singular_name' => __( 'Event', 'framework' ),
		'add_new' => __('Add New Event', 'framework'),
		'add_new_item' => __('Add New Event', 'framework'),
		'edit_item' => __('Edit Event', 'framework'),
		'new_item' => __('New Event', 'framework'),
		'view_item' => __('View Event', 'framework'),
		'search_items' => __('Search Events', 'framework'),
		'not_found' =>  __('No events found', 'framework'),
		'not_found_in_trash' => __('No events found in Trash', 'framework'), 
		'parent_item_colon' => ''
	 );
	
	$args = array(
	  'labels' => $labels,
	  'public' => true,
	  'publicly_queryable' => true,
	  'show_ui' => true,
	  'exclude_from_search' => true,
	  'query_var' => true,
	  'rewrite' => array( 'slug' => __('event', 'framework') ),
	  'capability_type' => 'post',
	  'hierarchical' => false,
	  'menu_position' => 20,
	  'supports' => array('title','editor','thumbnail', 'comments'),
	);
	register_post_type(__('t2t_event', 'framework'), $args);
	// End Events Custom Post Type
	
}

add_action( 'init', 't2t_post_types' );


/*-----------------------------------------------------------------------------------*/
/*	Add thumbnails to edit screens
/*-----------------------------------------------------------------------------------*/
if ( !function_exists('fb_AddThumbColumn') && function_exists('add_theme_support') ) {
	
	function fb_AddThumbColumn($cols) {
		$cols['thumbnail'] = __('Thumbnail', 'framework');
		return $cols;
	}
	
	function fb_AddThumbValue($column_name, $post_id) {
		$width = (int) 35;
		$height = (int) 35;
		if ( 'thumbnail' == $column_name ) {
			
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			
			$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
			
			if ($thumbnail_id)
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			elseif ($attachments) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
				}
			}
			if ( isset($thumb) && $thumb ) {
				echo $thumb;
			} else {
				echo __('None', 'framework');
			}
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Add thumbnails to these post types
/*-----------------------------------------------------------------------------------*/

add_filter( 'manage_t2t_gallery_posts_columns', 'fb_AddThumbColumn' );
add_action( 'manage_t2t_gallery_posts_custom_column', 'fb_AddThumbValue', 10, 2 );

}

?>
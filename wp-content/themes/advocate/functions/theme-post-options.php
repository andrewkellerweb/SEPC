<?php

/*-----------------------------------------------------------------------------------*/
/*	Define Custom Post Options
/*-----------------------------------------------------------------------------------*/
function t2t_meta_boxes($meta_name = false) {
	global $themename;
	
	$adminurl = admin_url('admin.php?page=functions.php');
	
	$meta_boxes = array(
		
		// Options for t2t_gallery post type
		't2t_gallery' => array(
			'id' => 't2t_gallery_meta',
			'title' => $themename . ' Gallery Options',
			'function' => 't2t_gallery_meta_box',
			'noncename' => 't2t_gallery',
			'type' => 't2t_gallery',
			'fields' => array(
				'video_url' => array(
					'name' => '_video_url',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'Youtube or Vimeo URL',
					'description' => "If you'd like to use a YouTube or Vimeo video, enter in the page URL here.",
					'label' => '',
					'margin' => true,
				),
				'embed_code' => array(
					'name' => '_embed_code',
					'type' => 'textarea',
					'width' => '',
					'default' => '',
					'title' => 'Embed Code',
					'description' => "If you'd like to use something other than YouTube or Vimeo, copy/paste the embed code here. This field will override the above.",
					'label' => '',
					'margin' => true,
				), 
				'height' => array(
					'name' => '_height',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'Video height',
					'description' => "Enter the height you'd like to use for this video. <b>Note:</b> 500 = (500px).",
					'label' => '',
					'margin' => true,
				),
		  )
		),

		// Options for t2t_feature post type
		't2t_feature' => array(
			'id' => 't2t_feature_meta',
			'title' => $themename . ' Feature Options',
			'function' => 't2t_feature_meta_box',
			'noncename' => 't2t_feature',
			'type' => 't2t_feature',
			'fields' => array(
				'select_icon' => array(
					'name' => '_select_icon',
					'type' => 'icon_select',
					'width' => '',
					'default' => '',
					'title' => 'Title Icon',
					'description' => "Select the Icon you wish to use for the title of this feature.",
					'label' => '',
					'margin' => true,
				),
				'read_more' => array(
					'name' => '_read_more',
					'type' => 'checkbox',
					'width' => '',
					'default' => '',
					'title' => 'Enable Title Link',
					'description' => "Check this box to enable the title linking to this item's full details page.",
					'label' => '',
					'margin' => true,
				)
		  )
		),
		
		// Options for t2t_sponsor post type
		't2t_sponsor' => array(
			'id' => 't2t_sponsor_meta',
			'title' => $themename . ' Sponsor Options',
			'function' => 't2t_sponsor_meta_box',
			'noncename' => 't2t_sponsor',
			'type' => 't2t_sponsor',
			'fields' => array(
				'read_more' => array(
					'name' => '_url',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'External Link',
					'description' => "Link this sponsor entry to an external URL. Leave blank to disable.",
					'label' => '',
					'margin' => true,
				)
		  )
		),
		
		// Options for t2t_event post type
		't2t_event' => array(
			'id' => 't2t_event_meta',
			'title' => $themename . ' Event Options',
			'function' => 't2t_event_meta_box',
			'noncename' => 't2t_event',
			'type' => 't2t_event',
			'fields' => array(
				'event_date' => array( 'type' => 'heading', 'title' => 'Event Date &amp; Time'),
				'read_more' => array(
					'name' => '_all_day_event',
					'type' => 'checkbox',
					'width' => '',
					'default' => '',
					'title' => 'All day event?',
					'label' => '',
					'margin' => true,
				),
				'start_date' => array(
					'name' => '_start_date',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'Start Date / Time',
					'description' => "",
					'label' => '',
					'class' => 'datepicker',
					'margin' => true,
				),
				'end_date' => array(
					'name' => '_end_date',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'End Date / Time',
					'description' => "",
					'label' => '',
					'class' => 'datepicker',
					'margin' => true,
				),
				'event_location' => array( 'type' => 'heading', 'title' => 'Event Location'),
				'venue_name' => array(
					'name' => '_venue_name',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'Venue Name',
					'description' => "",
					'label' => '',
					'class' => '',
					'margin' => true,
				),
				'venue_address' => array(
					'name' => '_venue_address',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'Address',
					'description' => "",
					'label' => '',
					'class' => '',
					'margin' => true,
				),
				'venue_city' => array(
					'name' => '_venue_city',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'City',
					'description' => "",
					'label' => '',
					'class' => '',
					'margin' => true,
				),
				'venue_state' => array(
					'name' => '_venue_state',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'State or Provice',
					'description' => "",
					'label' => '',
					'class' => '',
					'margin' => true,
				),
				'venue_country' => array(
					'name' => '_venue_country',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'Country',
					'description' => "",
					'label' => '',
					'class' => '',
					'margin' => true,
				),
				'venue_zip' => array(
					'name' => '_venue_zip',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'Postal Code',
					'description' => "",
					'label' => '',
					'class' => '',
					'margin' => true,
				),
				'google-maps' => array(
					'name' => '_google_maps',
					'type' => 'checkbox',
					'width' => '',
					'default' => '',
					'title' => 'Show Google Map?',
					'description' => "Check this box to display a google map on this event's detail page",
					'label' => '',
					'margin' => true,
				),
				'event_details' => array( 'type' => 'heading', 'title' => 'Event Details'),
				'cost' => array(
					'name' => '_cost',
					'type' => 'text',
					'width' => '',
					'default' => '',
					'title' => 'Cost',
					'description' => "Leave blank to hide this field.",
					'label' => '',
					'class' => '',
					'margin' => true,
				),
		  )
		),
		
	);
	if ($meta_name)
		return $meta_boxes[$meta_name];
	else
		return $meta_boxes;
}

/*-----------------------------------------------------------------------------------*/
/*	Add meta boxes
/*-----------------------------------------------------------------------------------*/

// Each custom post type w/ options needs a function like this!
function t2t_gallery_meta_box() {
	t2t_add_meta_box('t2t_gallery');
}

function t2t_feature_meta_box() {
	t2t_add_meta_box('t2t_feature');
}

function t2t_sponsor_meta_box() {
	t2t_add_meta_box('t2t_sponsor');
}

function t2t_event_meta_box() {
	t2t_add_meta_box('t2t_event');
}

function t2t_add_meta_boxes() {
	$meta_boxes = t2t_meta_boxes();
	
	foreach ($meta_boxes as $meta_box) {	
		add_meta_box($meta_box['id'], $meta_box['title'], $meta_box['function'], $meta_box['type'], 'normal', 'high');	
	}

}
add_action('admin_menu', 't2t_add_meta_boxes');

/*-----------------------------------------------------------------------------------*/
/*	Build options UI
/*-----------------------------------------------------------------------------------*/
function t2t_add_meta_box($box_name) {
	global $post, $themename;
	$meta_box = t2t_meta_boxes($box_name);
	$file_dir=get_bloginfo('template_directory');
	wp_enqueue_style("jquery-ui-theme", $file_dir."/functions/stylesheets/smoothness/jquery-ui-1.8.22.custom.css", false, "1.0", "all");
	foreach ($meta_box['fields'] as $meta_id => $meta_field){
			
			if(isset($meta_field['name'])) {
				$existing_value = get_post_meta($post->ID, $meta_field['name'], true);
			} else {
				$existing_value = '';
			}
			if($existing_value != '') {
				$value = $existing_value;
			} else {
				if(isset($meta_field['default'])) {
					$value = $meta_field['default'];
				} else {
					$value = '';
				}
			}
			if(isset($meta_field['margin'])) {
				$margin = ' class="add_margin"';
			} else {
				$margin = '';
			}

			if (isset($meta_field['description'])) {
				$description = '<p class="description">' . $meta_field['description'] . '</p>' . "\n";
			}else{
				$switch = '';
				$description = '';
			}
	
?>
	<div id="<?php echo $meta_id; ?>" class="<?php echo $themename; ?>-post-control t2t-form t2t-post-options">


	<?php switch ( $meta_field['type'] ) { 

	case "select_sidebar":
	?>
	<p<?php echo $margin; ?>>
	<select name="<?php echo $meta_field['name']; ?>">
		<option value=""<?php if($existing_value == ''){ echo " selected";} ?>>Select A Sidebar</option>
	<?php
	$sidebars = sidebar_generator_t2t::get_sidebars();
	if(is_array($sidebars) && !empty($sidebars)){
		foreach($sidebars as $sidebar){
			if($existing_value == $sidebar){
				echo "<option value='$sidebar' selected>$sidebar</option>\n";
			}else{
				echo "<option value='$sidebar'>$sidebar</option>\n";
			}
		}
	}
?>
	</select>
	</p><br/>
<?php
break;
case "heading":
?>
	
	<div class="row">
		<h4><?php echo $meta_field['title']; ?></h4>
	</div>
	
<?php
break;
case "text":
?>
	
	<div class="row">
		<label><?php echo $meta_field['title']; ?></label>
		<div class="content">
			<input type="text" name="<?php echo $meta_field['name']; ?>" value="<?php echo $existing_value; ?>"  class="t2t_field <?php echo $meta_field['class']; ?>" />
			<span class="hint"><?php if ($description){echo $description;}?></span>
		</div>
	</div>
	
<?php
break;
case "textarea":
?>

	<div class="row">
		<label><?php echo $meta_field['title']; ?></label>
		<div class="content">
			<textarea name="<?php echo $meta_field['name']; ?>" class="t2t_field"><?php echo $existing_value; ?></textarea>
			<span class="hint"><?php if ($description){echo $description;}?></span>
		</div>
	</div>

<?php
break;
case "checkbox":
?>

	<div class="row">
		<label><?php echo $meta_field['title']; ?></label>
		<div class="content check">
			<input type="checkbox" name="<?php echo $meta_field['name']; ?>" value="1" <?php if($existing_value == 1){ echo "checked='checked'"; } ?> />
			<span class="hint"><?php if ($description){echo $description;}?></span>
		</div>
	</div>
	
<?php
break;
case "icon_select":
?>

	<div class="row">
		<label><?php echo $meta_field['title']; ?></label>
		<div class="content check">
				<?php
					$alphas = range('a', 'z');
					$digits = range('1', '9');
					$misc = array("`","-","=","[","]",";","'",",",".","/","\\");
					$icon_options = array_merge($alphas, $digits,$misc);
				?>
				<select name="<?php echo $meta_field['name']; ?>" class="icon general-enclosed">
					<option value=""<?php if($existing_value == ''){ echo " selected";} ?>></option>
					<?php foreach($icon_options as $option) { ?>
					<option value="<?php echo $option; ?>" <?php if($existing_value == $option) { echo "selected"; } ?>><?php echo $option; ?></option>
					<?php } ?>
				</select>
			<span class="hint"><?php if ($description){echo $description;}?></span>
		</div>
	</div>
	
<?php
break;
}
?>
	</div>
<?php } ?>
	<input type="hidden" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)); ?>" id="<?php echo $meta_box['noncename']; ?>_noncename" name="<?php echo $meta_box['noncename']; ?>_noncename"/>
<?php 
}

/*-----------------------------------------------------------------------------------*/
/*	Save options
/*-----------------------------------------------------------------------------------*/
function t2t_save_meta($post_id) {
	$meta_boxes = t2t_meta_boxes();
	
	if (isset($_POST['post_type']) && $_POST['post_type'] == 'page') {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
	}
	else {
		if (!current_user_can('edit_post', $post_id))
			return $post_id;
	}
		if ( isset($_GET['post']) && isset($_GET['bulk_edit']) )
			return $post_id;

	foreach ($meta_boxes as $meta_box) {
		foreach ($meta_box['fields'] as $meta_field) {
			
			if(isset($meta_field['name'])) {
				$current_data = get_post_meta($post_id, $meta_field['name'], true);
				if(isset($_POST[$meta_field['name']])) {
					$new_data = $_POST[$meta_field['name']];
				}
			}

			if ($current_data) {
				if ($new_data == '')
					delete_post_meta($post_id, $meta_field['name']);
				elseif ($new_data == $meta_field['default'])
					delete_post_meta($post_id, $meta_field['name']);
				elseif ($new_data != $current_data)
					update_post_meta($post_id, $meta_field['name'], $new_data);
			}
			elseif (isset($new_data) && $new_data != '')
				add_post_meta($post_id, $meta_field['name'], $new_data, true);
		}
	}
}
add_action('save_post', 't2t_save_meta');

?>
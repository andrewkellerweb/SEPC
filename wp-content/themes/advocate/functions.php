<?php
	
/*-----------------------------------------------------------------------------------

	Below we have all of the custom functions for the theme
	Please be extremely cautious editing this file!
	
-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Global theme variables
/*-----------------------------------------------------------------------------------*/
$theme_data = wp_get_theme();
$themename = $theme_data['Name'];
$themeversion = $theme_data['Version'];
$shortname = "t2t";

/*-----------------------------------------------------------------------------------*/
/*	Add Localization Support
/*-----------------------------------------------------------------------------------*/
load_theme_textdomain('framework', get_template_directory() . '/languages');

/*-----------------------------------------------------------------------------------*/
/*	Include various function files
/*-----------------------------------------------------------------------------------*/
define('FILEPATH', get_template_directory());
define('DIRECTORY', get_template_directory_uri());
define('THEME_FUNCTIONS', get_template_directory() . '/functions');
define('THEME_IMAGES', get_template_directory_uri() . '/images' );

// Load Theme Options
require_once(THEME_FUNCTIONS . '/theme-options.php');

// Load Admin Theme UI
require_once(THEME_FUNCTIONS . '/admin-ui.php');

// Load Post Types
require_once(THEME_FUNCTIONS . '/theme-post-types.php');

// Load Post Options
require_once(THEME_FUNCTIONS . '/theme-post-options.php');

// Load Activation Options
require_once(THEME_FUNCTIONS . '/admin-activation.php');

// Load Theme UI
require_once(THEME_FUNCTIONS . '/theme-ui.php');

// Load Theme Shortcodes
require_once(THEME_FUNCTIONS . '/theme-shortcodes.php');

// Load Theme Widgets
require_once(THEME_FUNCTIONS . '/theme-widgets.php');

// Load Theme Functions
require_once(THEME_FUNCTIONS . '/theme-functions.php');

// Load Shortcodes
require_once(TEMPLATEPATH .'/shortcodes/zilla-shortcodes.php');

// Load Custom Posts Ordering
require_once(THEME_FUNCTIONS . '/includes/to.php');
require_once(THEME_FUNCTIONS . '/includes/po.php');

// Load Twitter
require_once(THEME_FUNCTIONS . '/includes/twitter/latest-tweets.php');

// Load Google Fonts
require_once(THEME_FUNCTIONS . '/includes/google-fonts.php');

/*-----------------------------------------------------------------------------------*/
/*	Set Max Content Width
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 1000;

/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	register_sidebar(array(
		'name' => 'Contact Page',
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	register_sidebar(array(
		'name' => 'Footer Widget One',
		'before_widget' => '<div id="%1$s" class="widget one_fourth">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	register_sidebar(array(
		'name' => 'Footer Widget Two',
		'before_widget' => '<div id="%1$s" class="widget one_fourth">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	register_sidebar(array(
		'name' => 'Footer Widget Three',
		'before_widget' => '<div id="%1$s" class="widget one_fourth">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
	register_sidebar(array(
		'name' => 'Footer Widget Four',
		'before_widget' => '<div id="%1$s" class="widget one_fourth column_last">',
		'after_widget' => '</div>',
		'before_title' => '<h5>',
		'after_title' => '</h5>',
	));
}

/*-----------------------------------------------------------------------------------*/
/*	If WP 3.0 or > include support for wp_nav_menu()
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'primary-menu' => $themename.__( ' Menu', 'framework' )
		)
	);
}

/*-----------------------------------------------------------------------------------*/
/*	Custom Gravatar Support
/*-----------------------------------------------------------------------------------*/
function t2t_custom_gravatar( $avatar_defaults ) {
    $tz_avatar = get_template_directory_uri() . '/images/gravatar.png';
    $avatar_defaults[$tz_avatar] = 'Custom Gravatar (/images/gravatar.png)';
    return $avatar_defaults;
}
add_filter( 'avatar_defaults', 't2t_custom_gravatar' );

/*-----------------------------------------------------------------------------------*/
/*	Add Comment Reply JS
/*-----------------------------------------------------------------------------------*/
function theme_queue_js(){
  if (!is_admin()){
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1))
      wp_enqueue_script( 'comment-reply' );
  }
}
add_action('wp_print_scripts', 'theme_queue_js');

/*-----------------------------------------------------------------------------------*/
/*	Add/configure thumbnails
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 525, 200, true );
	add_image_size( 'post-thumb', 62, 62, true );
	add_image_size( 'gallery-thumb', 470, 332, true );
	add_image_size( 'sponsor-thumbnail', 200, 100, false );
}

/*-----------------------------------------------------------------------------------*/
/*	Register and load javascripts
/*-----------------------------------------------------------------------------------*/
function t2t_register_js() {
	if (!is_admin()) {
		wp_register_script('jquery-ui', get_template_directory_uri() . '/javascripts/jquery-ui-1.8.14.js', 'jquery');
		wp_register_script('html5shiv', get_template_directory_uri().'/javascripts/html5shiv.js');
		wp_register_script('tipsy', get_template_directory_uri().'/javascripts/jquery.tipsy.js');
		wp_register_script('fancybox', get_template_directory_uri().'/javascripts/fancybox/jquery.fancybox-1.3.4.pack.js');
		wp_register_script('easing', get_template_directory_uri().'/javascripts/fancybox/jquery.easing-1.3.pack.js');
		wp_register_script('mobilemenu', get_template_directory_uri() . '/javascripts/jquery.mobilemenu.js', 'jquery');
		wp_register_script('infieldlabel', get_template_directory_uri().'/javascripts/jquery.infieldlabel.js');
		wp_register_script('quicksand', get_template_directory_uri().'/javascripts/jquery.quicksand.js');
		wp_register_script('nivo', get_template_directory_uri().'/javascripts/jquery.nivo.slider.pack.js');
		wp_register_script('fullcalendar', get_template_directory_uri().'/javascripts/fullcalendar.js');
		wp_register_script('googlemaps', '//maps.google.com/maps/api/js?sensor=false');
		wp_register_script('advocate', get_template_directory_uri().'/javascripts/advocate.js');

		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('html5shiv');
		wp_enqueue_script('tipsy');
		wp_enqueue_script('fancybox');
		wp_enqueue_script('easing');
		wp_enqueue_script('mobilemenu');
		wp_enqueue_script('infieldlabel');
		wp_enqueue_script('quicksand');
		wp_enqueue_script('fullcalendar');
		wp_enqueue_script('advocate');
		
		$fonts = array();
	
		// Add fonts to this array to be preloaded
		$fonts[] = "Pacifico|Cabin:400,700,600,500";
		if(get_option('t2t_logo_font') && get_option('t2t_logo_font_variant')) {
			$fonts[] = get_option('t2t_logo_font').':'.get_option('t2t_logo_font_variant');
		}
		if(get_option('t2t_tagline_font') && get_option('t2t_tagline_font_variant')) {
			$fonts[] = get_option('t2t_tagline_font').':'.get_option('t2t_tagline_font_variant');
		}
		if(get_option('t2t_h1_font') && get_option('t2t_h1_font_variant')) {
			$fonts[] = get_option('t2t_h1_font').':'.get_option('t2t_h1_font_variant');
		}
		if(get_option('t2t_h2_font') && get_option('t2t_h2_font_variant')) {
			$fonts[] = get_option('t2t_h2_font').':'.get_option('t2t_h2_font_variant');
		}
		if(get_option('t2t_h3_font') && get_option('t2t_h3_font_variant')) {
			$fonts[] = get_option('t2t_h3_font').':'.get_option('t2t_h3_font_variant');
		}
		$font_list = implode('|', $fonts);
	
		wp_enqueue_style("google-fonts", 'http://fonts.googleapis.com/css?family='.$font_list, false, false, "all");
	
	}
}
add_action('init', 't2t_register_js');

// Register and load css
function t2t_register_css() {
	if (!is_admin()) {
		wp_register_style('nivo-slider', get_template_directory_uri() . '/stylesheets/nivo-slider.css', array());
		wp_register_style('nivo-slider-theme', get_template_directory_uri() . '/stylesheets/nivo/default.css', array());
		wp_register_style('tipsy', get_template_directory_uri() . '/stylesheets/tipsy.css', array());
		wp_register_style('fullcalendar', get_template_directory_uri() . '/stylesheets/fullcalendar.css', array());
		wp_register_style('fancybox', get_template_directory_uri() . '/javascripts/fancybox/jquery.fancybox-1.3.4.css', array());
		wp_register_style('style', get_stylesheet_uri(), array());
		wp_register_style('media.queries', get_template_directory_uri() . '/stylesheets/media.queries.css', array());
		wp_register_style('custom', get_template_directory_uri() . '/stylesheets/custom.php', array());
		
		wp_enqueue_style('nivo-slider');
		wp_enqueue_style('nivo-slider-theme');
		wp_enqueue_style('tipsy');
		wp_enqueue_style('fullcalendar');
		wp_enqueue_style('fancybox');
		wp_enqueue_style('style');
		wp_enqueue_style('media.queries');
		wp_enqueue_style('custom');
		
	}
}
add_action('wp_enqueue_scripts', 't2t_register_css');

// Load homepage scripts 
function t2t_home_scripts() {
	if (is_page_template('template-home.php') ) wp_enqueue_script('nivo');
	if (is_single() ) wp_enqueue_script('googlemaps');
}
add_action('wp_print_scripts', 't2t_home_scripts');

function t2t_login_enqueue_scripts(){
	wp_dequeue_script( 'infieldlabel' );
}
add_action( 'login_enqueue_scripts', 't2t_login_enqueue_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Get google font properties
/*-----------------------------------------------------------------------------------*/
function t2t_google_fonts_ajax() {
	global $wpdb; 
	
	$font_list = t2t_get_google_fonts();
	$font_family = $_GET['font_family'];
	
	$result = multidimensional_search($font_list, array('family' => $font_family));
	
	echo $result['variants'];
	die();
}

add_action('wp_ajax_t2t_google_fonts_ajax', 't2t_google_fonts_ajax');

/*-----------------------------------------------------------------------------------*/
/*	Ajax file uploading
/*-----------------------------------------------------------------------------------*/
function tz_ajax_callback() {
	global $wpdb; // this is how you get access to the database
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'upload'){
		
		$clickedID = $_POST['data']; // Acts as the name
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		
		$attachment = array(
		'post_title' => $filename['name'],
		'post_content' => '',
		'post_type' => 'attachment',
		'post_mime_type' => $filename['type'],
		'guid' => $uploaded_file['url']
		);

		$id = wp_insert_attachment( $attachment,$uploaded_file['file']);
		wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $uploaded_file['file'] ) );
		 
		$upload_tracking[] = $clickedID;
		update_option( $clickedID , $uploaded_file['url'] );
				
		 if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
		 else { echo $uploaded_file['url']; } // Is the Response
	}
	elseif($save_type == 'image_reset'){
			
			$id = $_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	
	}
	die();
}

add_action('wp_ajax_tz_ajax_post_action', 'tz_ajax_callback');

/*-----------------------------------------------------------------------------------*/
/*	Add Theme Admin Functions
/*-----------------------------------------------------------------------------------*/
function t2t_add_admin() {

global $themename, $themeversion, $shortname, $options;

if (isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {

	if ( isset($_REQUEST['action']) && $_REQUEST['action'] == 'save' ) {

		foreach ($options as $value) {
			if(isset($value['id'])) {
				if( isset( $_REQUEST[ $value['id'] ] ) ) { 
					update_option( $value['id'], stripslashes($_REQUEST[ $value['id'] ])  ); 
				} else { 
					delete_option( $value['id'] ); 
				}
			}
		}
		header("Location: admin.php?page=functions.php&saved=true");
		die;

}
else if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'reset' ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }

	header("Location: admin.php?page=functions.php&reset=true");
die;
}
}

add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 't2t_admin');
}

/*-----------------------------------------------------------------------------------*/
/*	Initialize admin scripts
/*-----------------------------------------------------------------------------------*/
function t2t_add_init() {
	$file_dir=get_bloginfo('template_directory');
	wp_enqueue_style("t2t_colorpicker", $file_dir."/functions/stylesheets/colorpicker.css", false, "1.0", "all");
	wp_enqueue_style("functions", $file_dir."/functions/stylesheets/t2t_admin.css", false, "1.0", "all");
	wp_enqueue_script("t2t_colorpicker", $file_dir."/functions/javascripts/colorpicker.js", false, "1.0");
	wp_enqueue_script("t2t_admin", $file_dir."/functions/javascripts/t2t_admin.js", false, "1.0");
	wp_enqueue_script("ajaxupload", $file_dir."/functions/javascripts/ajaxupload.js", false, "1.0");
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-slider');
}

function t2t_admin_print_scripts($hook) {
	global $page_handle, $shortname;
	$nonce = wp_create_nonce('sidebar_rm');
		
	echo '<script type="text/javascript">
	//<![CDATA[
	var $removeSidebarURL = "' .admin_url('admin-ajax.php'). '";
	var $ajaxNonce = "' .$nonce. '";
	var $themeshortname = "'.$shortname.'";
	//]]></script>';
}

add_action('admin_print_scripts', 't2t_admin_print_scripts');
add_action('admin_init', 't2t_add_init');
add_action('admin_menu', 't2t_add_admin');

function t2t_admin_footer() {
	$file_dir=get_bloginfo('template_directory');
	wp_enqueue_script("jquery-ui-timepicker", $file_dir."/functions/javascripts/jquery-ui-timepicker-addon.js", false, "1.0");
	?>
	<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.datepicker').datetimepicker({
			timeFormat: 'hh:mm:ss',
			dateFormat : 'yy-mm-dd'
		});
	});
	</script>
	<?php
}
add_action('admin_footer', 't2t_admin_footer');


/*-----------------------------------------------------------------------------------*/
/*	Add menu item to admin bar
/*-----------------------------------------------------------------------------------*/
function t2t_admin_link() {
	global $wp_admin_bar, $wpdb, $themename;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array( 'id' => 't2t_admin', 'title' => __( "Advocate", 'textdomain' ), 'href' => admin_url("admin.php?page=functions.php") ) );
}
add_action( 'admin_bar_menu', 't2t_admin_link', 1000 );

/*-----------------------------------------------------------------------------------*/
/*	Function for searching PHP arrays
/*-----------------------------------------------------------------------------------*/
function multidimensional_search($parents, $searched) {
  if (empty($searched) || empty($parents)) {
    return false;
  }

  foreach ($parents as $key => $value) {
    $exists = true;
    foreach ($searched as $skey => $svalue) {
      $exists = ($exists && IsSet($parents[$key][$skey]) && $parents[$key][$skey] == $svalue);
    }
    if($exists){ return $parents[$key]; }
  }

  return false;
}

/*-----------------------------------------------------------------------------------*/
/*  Check the type of post
/*-----------------------------------------------------------------------------------*/
function is_post_type($type){
    global $wp_query;
	if(isset($wp_query->post)) {
    	if($type == get_post_type($wp_query->post->ID)) return true;
	}
    return false;
}

/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

function t2t_excerpt_length($length) {
return 16; }
add_filter('excerpt_length', 't2t_excerpt_length');

/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

function t2t_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 't2t_excerpt_more');

?>
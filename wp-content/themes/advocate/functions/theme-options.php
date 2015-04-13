<?php

// Check WP version
function t2t_check_wp_version(){
	global $wp_version;
	
	$minium_WP   = '3.0';
	$wp_ok  =  version_compare($wp_version, $minium_WP, '>=');
	
	if ( ($wp_ok == FALSE) ) {
		return false;
	}
	
	return true;
}

// Define images dir URL
$url = get_template_directory_uri() . '/functions/images/';

$options = array (

// Available Options
array( "name" => __('General Settings', 'framework'), "type" => "section"),
	// Start the section 
	array( "type" => "open"),

		// Logo (requires both hidden fields below)
		array( "name" => __('Logo', 'framework'),
			"id" => $shortname."_logo",
			"type" => "logo",
			"std" => ""),
	
			array( "name" => __('Logo Text', 'framework'),
				"id" => $shortname."_logo_text",
				"type" => "hidden", "std" => ""),	
	
			array( "name" => __('Logo Type', 'framework'),
				"id" => $shortname."_logo_type",
				"type" => "hidden", "std" => ""),

		// Tagline
		array( "name" => __('Tagline', 'framework'),
			"id" => $shortname."_tagline",
			"desc" => __('Enter a tagline for your site.', 'framework'),
			"type" => "text",
			"std" => ""),

		// Show Tagline
		array( "name" => __('Show Tagline', 'framework'),
			"id" => $shortname."_showtagline",
			"desc" => __('Check this box if you wish to show the tagline.', 'framework'),
			"type" => "checkbox",
			"std" => ""),
	
		// Custom Favicon
		array( "name" => __('Custom Favicon', 'framework'),
			"id" => $shortname."_favicon",
			"desc" => __('Upload or type the full URL of your custom favicon image here', 'framework'),
			"type" => "upload",
			"std" => ""),

		// Contact Form Email
		array( "name" => __('Contact Form Email', 'framework'),
			"id" => $shortname."_contact_form_email",
			"desc" => __('Where to send the contact form messages. Can be overridden when using the contact form shortcode.', 'framework'),
			"type" => "text",
			"std" => ""),	

		// Contact Map URL
		array( "name" => __('Contact Map URL', 'framework'),
			"id" => $shortname."_contact_map_url",
			"desc" => __('Enter the URL to your location from google maps.', 'framework'),
			"type" => "text",
			"std" => ""),	
	
		// Analytics Code
		array( "name" => __('Analytics Code', 'framework'),
			"id" => $shortname."_analytics_code",
			"desc" => __('Paste your Google Analytics or other tracking code here. This will be automatically added to the footer of every page.', 'framework'),
			"type" => "textarea",
			"std" => ""),	
			
		// Footer Copyright Text
		array( "name" => __('Footer Copyright Text', 'framework'),
			"desc" => __('Enter text shown in the right side of the footer. It can be HTML.', 'framework'),
			"id" => $shortname."_footer_copyright",
			"type" => "text",
			"std" => ""),
			
	// End the section
	array( "type" => "close"),
	
// Homepage Options
array( "name" => __('Homepage Options', 'framework'),
	"type" => "section"),
	array( "type" => "open"),
	
	// Subtitle Text
		array( "name" => __('Subtitle Text', 'framework'),
			"id" => $shortname."_subtitle_text",
			"desc" => __('Enter a subtitle that will apear to the right of your logo.', 'framework'),
			"type" => "text",
			"std" => ""),
	
	// About Title
		array( "name" => __('About Title', 'framework'),
			"id" => $shortname."_about_title",
			"desc" => __('Enter a title that will appear in the about section beneath the homepage slider.', 'framework'),
			"type" => "text",
			"std" => ""),
	
	// About Content
		array( "name" => __('About Content', 'framework'),
			"id" => $shortname."_about_content",
			"desc" => __('', 'framework'),
			"type" => "textarea",
			"std" => ""),
	
	array( "name" => "", "type" => "separator"),

	// Disable Features
		array( "name" => __('Disable Features', 'framework'),
			"id" => $shortname."_disable_features",
			"desc" => __('', 'framework'),
			"type" => "checkbox",
			"std" => ""),
	
	// Number of Features
		array( "name" => __('Number of Features to Display', 'framework'),
			"id" => $shortname."_number_of_features",
			"desc" => __('', 'framework'),
			"type" => "text",
			"std" => ""),
	
	array( "name" => "", "type" => "separator"),
		
	// Disable Donate Banner
		array( "name" => __('Disable Donate Banner', 'framework'),
			"id" => $shortname."_disable_donate_banner",
			"desc" => __('', 'framework'),
			"type" => "checkbox",
			"std" => ""),
			
	// Donate Banner Icon
		array( "name" => __('Donate Banner Icon', 'framework'),
			"id" => $shortname."_donate_banner_icon",
			"desc" => __('', 'framework'),
			"type" => "icon_select",
			"std" => ""),
			
	// Donate Banner Title
		array( "name" => __('Donate Banner Title', 'framework'),
			"id" => $shortname."_donate_banner_title",
			"desc" => __('', 'framework'),
			"type" => "text",
			"std" => ""),
			
	// Donate Banner Sub Title
		array( "name" => __('Donate Banner Sub Title', 'framework'),
			"id" => $shortname."_donate_banner_sub_title",
			"desc" => __('', 'framework'),
			"type" => "text",
			"std" => ""),
			
	// Donate Banner Button Text
		array( "name" => __('Donate Banner Button Text', 'framework'),
			"id" => $shortname."_donate_banner_button_text",
			"desc" => __('Leave blank to disable', 'framework'),
			"type" => "text",
			"std" => ""),
			
	// Donate Banner Button URL
		array( "name" => __('Donate Banner Button URL', 'framework'),
			"id" => $shortname."_donate_banner_button_url",
			"desc" => __('', 'framework'),
			"type" => "text",
			"std" => ""),
	
	array( "name" => "", "type" => "separator"),

			
	// Disable Bottom Content Area
		array( "name" => __('Disable Bottom Content Area', 'framework'),
			"id" => $shortname."_disable_bottom_content_area",
			"desc" => __('', 'framework'),
			"type" => "checkbox",
			"std" => ""),

	// Bottom Content Area
		array( "name" => __('Bottom Content Area', 'framework'),
			"id" => $shortname."_bottom_content_area",
			"desc" => __('', 'framework'),
			"type" => "textarea",
			"std" => ""),

	array( "type" => "close"),

// Style Settings
array( "name" => __('Style Settings', 'framework'),
	"type" => "section"),
	array( "type" => "open"),
	
	// Theme Accent Color
		array( "name" => __('Theme Accent Color', 'framework'),
			"id" => $shortname."_theme_accent_color",
			"desc" => __('', 'framework'),
			"width" => "80",
			"type" => "colorpicker",
			"std" => ""),
			
	// Page Background
	array( "name" => __('Page Background Color', 'framework'),
		"id" => $shortname."_theme_bg_color",
		"desc" => __('', 'framework'),
		"width" => "80",
		"type" => "colorpicker",
		"std" => ""),		
	/*		
	// Link Color
		array( "name" => __('Link Color', 'framework'),
			"id" => $shortname."_link_color",
			"desc" => __('', 'framework'),
			"width" => "80",
			"type" => "colorpicker",
			"std" => ""),
			
	// Link Hover Color
		array( "name" => __('Link Hover Color', 'framework'),
			"id" => $shortname."_link_hover_color",
			"desc" => __('', 'framework'),
			"width" => "80",
			"type" => "colorpicker",
			"std" => ""),
	*/		
	// Custom CSS
		array( "name" => __('Custom CSS', 'framework'),
			"id" => $shortname."_custom_css",
			"desc" => __('', 'framework'),
			"type" => "textarea",
			"std" => ""),
			
	// Custom Javascript
		array( "name" => __('Custom Javascript', 'framework'),
			"id" => $shortname."_custom_javascript",
			"desc" => __('', 'framework'),
			"type" => "textarea",
			"std" => ""),

	array( "type" => "close"),
	
// Slider Options
array( "name" => __('Slider Options', 'framework'),
	"type" => "section"),
	array( "type" => "open"),
	
	array( "name" => __('Disable Slider?', 'framework'),
		"desc" => __('Check this to completely disable the homepage slider. If disabled, only the first Slide will be shown.', 'framework'),
		"id" => $shortname."_disable_slider",
		"type" => "checkbox",
		"std" => ""),

	array( "name" => __('Slider Animation', 'framework'),
		"id" => $shortname."_slider_animation",
		"type" => "select",
		"options" => array('random', 'sliceDown','sliceDownLeft','sliceUp','sliceUpLeft','sliceUpDown','sliceUpDownLeft','fold','fade','random','slideInRight','slideInLeft','boxRandom','boxRain','boxRainReverse','boxRainGrow','boxRainGrowReverse'),
		"std" => ""),

	array( "name" => __('Autoplay Duration', 'framework'),
		"id" => $shortname."_autoplay_duration",
		"desc" => __('The time in milliseconds between slider transitions where 1000 = 1 second. Leave blank to disable autoplay.', 'framework'),
		"type" => "text",
		"std" => "",
		"width" => "100"),

	array( "name" => __('Pause Duration', 'framework'),
		"id" => $shortname."_pause_duration",
		"desc" => __('The time in milliseconds each slide pauses where 1000 = 1 second.', 'framework'),
		"type" => "text",
		"std" => "",
		"width" => "100"),
		array( "type" => "seperator"),
  
		array( "type" => "desc",
			   "desc" => "Each slider row supports an image with the dimensions of <b>960x350px</b>."),
  
		array( "type" => "group_open"),
  
			array( "name" => "Slide 1 Image",
				"id" => $shortname."_slide_1",
				"type" => "upload",
				"std" => ""),
  
			array( "name" => "Slide 1 Caption",
				"id" => $shortname."_slide_1_caption",
				"type" => "text",
				"desc" => "Caption that appears in an overlay on this slide. Leave blank to disable.",
				"std" => ""),
  
			array( "name" => "Slide 1 URL",
				"id" => $shortname."_slide_1_url",
				"type" => "text",
				"std" => ""),
  
		array( "type" => "group_close"),	
  
		array( "type" => "group_open"),
  
			array( "name" => "Slide 2 Image",
				"id" => $shortname."_slide_2",
				"type" => "upload",
				"std" => ""),
  
			array( "name" => "Slide 2 Caption",
				"id" => $shortname."_slide_2_caption",
				"type" => "text",
				"desc" => "Caption that appears in an overlay on this slide. Leave blank to disable.",
				"std" => ""),
  
			array( "name" => "Slide 2 URL",
				"id" => $shortname."_slide_2_url",
				"type" => "text",
				"std" => ""),
  
		array( "type" => "group_close"),
  
		array( "type" => "group_open"),
  
			array( "name" => "Slide 3 Image",
				"id" => $shortname."_slide_3",
				"type" => "upload",
				"std" => ""),
  
			array( "name" => "Slide 3 Caption",
				"id" => $shortname."_slide_3_caption",
				"type" => "text",
				"desc" => "Caption that appears in an overlay on this slide. Leave blank to disable.",
				"std" => ""),	
  
			array( "name" => "Slide 3 URL",
				"id" => $shortname."_slide_3_url",
				"type" => "text",
				"std" => ""),
  
		array( "type" => "group_close"),
  
		array( "type" => "group_open"),
  
			array( "name" => "Slide 4 Image",
				"id" => $shortname."_slide_4",
				"type" => "upload",
				"std" => ""),
  
			array( "name" => "Slide 4 Caption",
				"id" => $shortname."_slide_4_caption",
				"type" => "text",
				"desc" => "Caption that appears in an overlay on this slide. Leave blank to disable.",
				"std" => ""),	
  
			array( "name" => "Slide 4 URL",
				"id" => $shortname."_slide_4_url",
				"type" => "text",
				"std" => ""),
  
		array( "type" => "group_close"),
  
		array( "type" => "group_open"),
  
			array( "name" => "Slide 5 Image",
				"id" => $shortname."_slide_5",
				"type" => "upload",
				"std" => ""),
  
			array( "name" => "Slide 5 Caption",
				"id" => $shortname."_slide_5_caption",
				"type" => "text",
				"desc" => "Caption that appears in an overlay on this slide. Leave blank to disable.",
				"std" => ""),	
  
			array( "name" => "Slide 5 URL",
				"id" => $shortname."_slide_5_url",
				"type" => "text",
				"std" => ""),
  
		array( "type" => "group_close"),

	array( "type" => "close"),

// Typography
array( "name" => __('Typography Options', 'framework'),
	"type" => "section"),
	array( "type" => "open"),

		// Start logo typography (notice the "std" value here)
		array( "type" => "container_open", "std" => "logo"),
	
			// Typography selector
			array( "name" => __('Logo', 'framework'),
				"id" => $shortname."_logo_font",
				"type" => "google_fonts",
				"font_size" => "40",
				"font_color" => "#ffffff",
				"font_variant" => "",
				"std" => "Pacifico"),
		
				array( "name" => __('Logo Variant', 'framework'),
					"id" => $shortname."_logo_font_variant",
					"type" => "hidden",
					"class" => "typography_variant",
					"std" => ""),
		
				array( "name" => __('Logo Size', 'framework'),
					"id" => $shortname."_logo_font_size",
					"type" => "hidden",
					"class" => "typography_size",
					"std" => ""),	

				array( "name" => __('Logo Color', 'framework'),
					"id" => $shortname."_logo_font_color",
					"type" => "hidden",
					"class" => "typography_color",
					"std" => ""),
			// End Typography selector
	
		array( "type" => "container_close"),
		// End logo typography

		// Start tagline typography (notice the "std" value here)
		array( "type" => "container_open", "std" => "tagline"),
		
			// Typography selector
			array( "name" => __('Tagline', 'framework'),
				"id" => $shortname."_tagline_font",
				"type" => "google_fonts",
				"font_size" => "15",
				"font_color" => "#ffffff",
				"font_variant" => "",
				"std" => "Cabin"),
		
				array( "name" => __('Tagline Variant', 'framework'),
					"id" => $shortname."_tagline_font_variant",
					"type" => "hidden",
					"class" => "typography_variant",
					"std" => ""),
		
				array( "name" => __('Tagline Size', 'framework'),
					"id" => $shortname."_tagline_font_size",
					"type" => "hidden",
					"class" => "typography_size",
					"std" => ""),	

				array( "name" => __('Tagline Color', 'framework'),
					"id" => $shortname."_tagline_font_color",
					"type" => "hidden",
					"class" => "typography_color",
					"std" => ""),
			// End Typography selector

		array( "type" => "container_close"),
		// End tagline typography
		
		// Start h1 typography 
		array( "type" => "container_open", "std" => "tagline"),
		
			// Typography selector
			array( "name" => __('H1 Heading', 'framework'),
				"id" => $shortname."_h1_font",
				"type" => "google_fonts",
				"font_size" => "32",
				"font_color" => "#d07837",
				"font_variant" => "",
				"std" => "Pacifico"),
		
				array( "name" => __('H1 Variant', 'framework'),
					"id" => $shortname."_h1_font_variant",
					"type" => "hidden",
					"class" => "typography_variant",
					"std" => ""),
		
				array( "name" => __('H1 Size', 'framework'),
					"id" => $shortname."_h1_font_size",
					"type" => "hidden",
					"class" => "typography_size",
					"std" => ""),	

				array( "name" => __('H1 Color', 'framework'),
					"id" => $shortname."_h1_font_color",
					"type" => "hidden",
					"class" => "typography_color",
					"std" => ""),
			// End Typography selector

		array( "type" => "container_close"),
		// End h1 typography
		
		// Start h2 typography 
		array( "type" => "container_open", "std" => "tagline"),
		
			// Typography selector
			array( "name" => __('H2 Heading', 'framework'),
				"id" => $shortname."_h2_font",
				"type" => "google_fonts",
				"font_size" => "24",
				"font_color" => "#d07837",
				"font_variant" => "",
				"std" => "Pacifico"),
		
				array( "name" => __('H2 Variant', 'framework'),
					"id" => $shortname."_h2_font_variant",
					"type" => "hidden",
					"class" => "typography_variant",
					"std" => ""),
		
				array( "name" => __('H2 Size', 'framework'),
					"id" => $shortname."_h2_font_size",
					"type" => "hidden",
					"class" => "typography_size",
					"std" => ""),	

				array( "name" => __('H2 Color', 'framework'),
					"id" => $shortname."_h2_font_color",
					"type" => "hidden",
					"class" => "typography_color",
					"std" => ""),
			// End Typography selector

		array( "type" => "container_close"),
		// End h2 typography
		
		// Start h3 typography 
		array( "type" => "container_open", "std" => "tagline"),
		
			// Typography selector
			array( "name" => __('H3 Heading', 'framework'),
				"id" => $shortname."_h3_font",
				"type" => "google_fonts",
				"font_size" => "24",
				"font_color" => "#292929",
				"font_variant" => "",
				"std" => "Cabin"),
		
				array( "name" => __('H3 Variant', 'framework'),
					"id" => $shortname."_h3_font_variant",
					"type" => "hidden",
					"class" => "typography_variant",
					"std" => ""),
		
				array( "name" => __('H3 Size', 'framework'),
					"id" => $shortname."_h3_font_size",
					"type" => "hidden",
					"class" => "typography_size",
					"std" => ""),	

				array( "name" => __('H3 Color', 'framework'),
					"id" => $shortname."_h3_font_color",
					"type" => "hidden",
					"class" => "typography_color",
					"std" => ""),
			// End Typography selector

		array( "type" => "container_close"),
		// End h3 typography

	array( "type" => "close"),

// Social Options
array( "name" => __('Social Options', 'framework'),
	"type" => "section"),
	array( "type" => "open"),
	
	array( "type" => "desc",
			   "desc" => "Add social links to the header of your site. Leave any blank to disable."),

		array( "name" => "Twitter URL",
				"desc" => "",
				"id" => $shortname."_social_twitter",
				"type" => "text",
				"std" => ""),
				
		array( "name" => "Facebook URL",
				"desc" => "",
				"id" => $shortname."_social_facebook",
				"type" => "text",
				"std" => ""),
		
		array( "name" => "Flickr URL",
				"desc" => "",
				"id" => $shortname."_social_flickr",
				"type" => "text",
				"std" => ""),
				
		array( "name" => "Vimeo URL",
				"desc" => "",
				"id" => $shortname."_social_vimeo",
				"type" => "text",
				"std" => ""),
				
		array( "name" => "Google URL",
				"desc" => "",
				"id" => $shortname."_social_google",
				"type" => "text",
				"std" => ""),
		
		array( "name" => "RSS URL",
				"desc" => "",
				"id" => $shortname."_social_rss",
				"type" => "text",
				"std" => ""),
				
		array( "name" => "Picasa URL",
				"desc" => "",
				"id" => $shortname."_social_picasa",
				"type" => "text",
				"std" => ""),	
				
		array( "name" => "YouTube URL",
				"desc" => "",
				"id" => $shortname."_social_youtube",
				"type" => "text",
				"std" => ""),		

		array( "name" => "Dribbble URL",
				"desc" => "",
				"id" => $shortname."_social_dribbble",
				"type" => "text",
				"std" => ""),

		array( "name" => "Forrst URL",
				"desc" => "",
				"id" => $shortname."_social_forrst",
				"type" => "text",
				"std" => ""),

		array( "name" => "deviantArt URL",
				"desc" => "",
				"id" => $shortname."_social_deviantart",
				"type" => "text",
				"std" => ""),

		array( "name" => "Wordpress URL",
				"desc" => "",
				"id" => $shortname."_social_wordpress",
				"type" => "text",
				"std" => ""),

		array( "name" => "Blogger URL",
				"desc" => "",
				"id" => $shortname."_social_blogger",
				"type" => "text",
				"std" => ""),

		array( "name" => "Yahoo! URL",
				"desc" => "",
				"id" => $shortname."_social_yahoo",
				"type" => "text",
				"std" => ""),

		array( "name" => "Amazon URL",
				"desc" => "",
				"id" => $shortname."_social_amazon",
				"type" => "text",
				"std" => ""),
				
		array( "name" => "LinkedIn URL",
				"desc" => "",
				"id" => $shortname."_social_linkedin",
				"type" => "text",
				"std" => ""),

		array( "name" => "Last.fm URL",
				"desc" => "",
				"id" => $shortname."_social_lastfm",
				"type" => "text",
				"std" => ""),

		array( "name" => "StumbleUpon URL",
				"desc" => "",
				"id" => $shortname."_social_stumbleupon",
				"type" => "text",
				"std" => ""),

		array( "name" => "Pinterest",
				"desc" => "",
				"id" => $shortname."_social_pinterest",
				"type" => "text",
				"std" => ""),

		array( "name" => "Xing URL",
				"desc" => "",
				"id" => $shortname."_social_xing",
				"type" => "text",
				"std" => ""),

		array( "name" => "SoundCloud URL",
				"desc" => "",
				"id" => $shortname."_social_soundcloud",
				"type" => "text",
				"std" => ""),

		array( "name" => "Delicious URL",
				"desc" => "",
				"id" => $shortname."_social_delicious",
				"type" => "text",
				"std" => ""),
		
		array( "name" => "GitHub URL",
				"desc" => "",
				"id" => $shortname."_social_github",
				"type" => "text",
				"std" => ""),
		
		array( "name" => "Mail URL",
				"desc" => "",
				"id" => $shortname."_social_mail",
				"type" => "text",
				"std" => ""),

	array( "type" => "close"),

	// Start Gallery

	array( "name" => __('Gallery Options', 'framework'),
		"type" => "section"),
	array( "type" => "open"),

		array( "type" => "desc", "desc" => __('The settings below will affect the "Gallery" template', 'framework')),

		array( "name" => __('Disable Filter', 'framework'),
			"desc" => __('Check this to disable the gallery filter.', 'framework'),
			"id" => $shortname."_disable_gallery_filter",
			"type" => "checkbox",
			"std" => ""),

		array( "name" => __('Gallery Layout', 'framework'),
			"id" => $shortname."_gallery_layout",
			"desc" => __('Choose a layout that will be used on the gallery template.', 'framework'),
			"type" => "select",
			"options" => array('Two Columns', 'Three Columns', 'Four Columns'),
			"std" => ""),

		array( "name" => __('Disable Lightbox', 'framework'),
			"desc" => __('Check this to disable the lightbox effect. If disabled, images will link to their respective pages.', 'framework'),
			"id" => $shortname."_disable_gallery_lightbox",
			"type" => "checkbox",
			"std" => ""),

	array( "type" => "close"),

);
?>
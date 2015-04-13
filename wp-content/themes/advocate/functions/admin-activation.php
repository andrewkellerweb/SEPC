<?php

global $wpdb;

if(get_option($shortname.'_activated') != true) {
	
	if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {	
		
		// Check if the menu_order column exists;
        $query = "SHOW COLUMNS FROM $wpdb->terms 
                    LIKE 'term_order'";
        $result = $wpdb->query($query);

        if ($result == 0) {
            $query = "ALTER TABLE $wpdb->terms ADD `term_order` INT( 4 ) NULL DEFAULT '0'";
            $result = $wpdb->query($query); 
        }

		update_option( $shortname.'_activated', true);

		// General Settings
		update_option($shortname.'_logo_text', 'Advocate');
		update_option($shortname.'_logo_type', 'text');
		update_option($shortname.'_tagline', 'a theme for non-profits, charities, activists and political campaigns');
		update_option($shortname.'_showtagline', true);
		update_option($shortname.'_donate_banner_icon', 'l');
		
		update_option($shortname.'_footer_copyright', 'Copyright &copy; 2012 Advocate. All Rights Reserved.');
		update_option($shortname.'_contact_map_url', 'https://maps.google.com/?ll=37.0625,-95.677068&spn=69.225198,141.064453&t=m&z=4');

		// Style options
		update_option( $shortname.'_theme_accent_color', '#d07837');
		update_option( $shortname.'_theme_bg_color', '#d07837');
		
		// Homepage Options
		update_option( $shortname.'_subtitle_text', 'Join The Revolution');
		update_option( $shortname.'_about_title', 'Beautiful themes loaded with easy to customize options.');
		update_option( $shortname.'_about_content', '<p>Advocate is built with an impressive set of custom options that lets you change font styles, create <span class="color">unlimited colors</span> and is  almost entirely image free! We use font-based icons and CSS3 buttons to make your site retina sharp and fast loading.</p>');
		
		update_option( $shortname.'_number_of_features', 4);
		
		update_option( $shortname.'_donate_banner_icon', 'l');
		update_option( $shortname.'_donate_banner_title', 'Donate what you can to help');
		update_option( $shortname.'_donate_banner_sub_title', 'Your tax-free donation helps us do stuff for people, animals and communities in need.');
		update_option( $shortname.'_donate_banner_button_text', 'Donate Now!');
		
		$homepage_content = "[one_third]\r";
		$homepage_content .= '[recent_posts title="Blog" amount="3"]';
		$homepage_content .= "\r[/one_third]\r\r";

		$homepage_content .= "[one_third]\r";
		$homepage_content .= '[sponsors title="Sponsors" amount="8"]';
		$homepage_content .= "\r[/one_third]\r\r";

		$homepage_content .= "[one_third_last]\r";
		$homepage_content .= '[events title="Events" amount="4"]';
		$homepage_content .= "\r[/one_third_last]";
		
		update_option( $shortname.'_bottom_content_area', $homepage_content);
		
		// Slider
		update_option( $shortname.'_slider_type', 'Tiles');
		update_option( $shortname.'_slide_1', THEME_IMAGES . '/content/slide_1.jpg');
		update_option( $shortname.'_slide_1_caption', '<b>Protect Endangered Animals</b> - This is a great place to draw attention to your cause or charity with a bold image and some descriptive text.');
		
		update_option( $shortname.'_slide_2', THEME_IMAGES . '/content/slide_2.jpg');
		update_option( $shortname.'_slide_2_caption', "<b>Protect Our Coral Reefs</b> - This slider is also responsive, so your visitors see your site exactly as intended, no matter what device they're using.");
		
		update_option( $shortname.'_slide_3', THEME_IMAGES . '/content/slide_3.jpg');
		update_option( $shortname.'_slide_3_caption', '<b>Save the Rainforest</b> - Bring awareness to your cause with style and function. ');
		
		// Social Settings
		update_option( $shortname.'_social_twitter', '#');
		update_option( $shortname.'_social_facebook', '#');
		update_option( $shortname.'_social_vimeo', '#');
		
	}
}

?>
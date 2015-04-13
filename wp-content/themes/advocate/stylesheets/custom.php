<?php 
header("Content-type: text/css");

if(file_exists('../../../../wp-load.php')) :
	include '../../../../wp-load.php';
else:
	include '../../../../../wp-load.php';
endif; 

ob_flush(); 
?>

/*--------------------------------------------
Sets the typography of the theme

Example:

h1 {
	font-family: "<?php if(get_option('t2t_h1_headings_font')) { echo get_option('t2t_h1_headings_font'); } else { echo 'Pacifico'; } ?>";
	font-size: <?php echo get_option('t2t_h1_headings_font_size'); ?>;
	color: <?php echo get_option('t2t_h1_headings_font_color'); ?>;
}

---------------------------------------------*/

section.page_heading .logo a {
	font-family: "<?php if(get_option('t2t_logo_font')) { echo get_option('t2t_logo_font'); } else { echo 'Pacifico'; } ?>";
	font-size: <?php echo get_option('t2t_logo_font_size'); ?>;
	color: <?php echo get_option('t2t_logo_font_color'); ?>;
}

section.page_heading .logo .tagline {
	font-family: "<?php if(get_option('t2t_tagline_font')) { echo get_option('t2t_tagline_font'); } else { echo 'Cabin'; } ?>";
	font-size: <?php echo get_option('t2t_tagline_font_size'); ?>;
	color: <?php echo get_option('t2t_tagline_font_color'); ?>;
}

h1 {
	font-family: "<?php if(get_option('t2t_h1_font')) { echo get_option('t2t_h1_font'); } else { echo 'Pacifico'; } ?>";
	font-size: <?php echo get_option('t2t_h1_font_size'); ?>;
	color: <?php echo get_option('t2t_h1_font_color'); ?>;
}

h2 {
	font-family: "<?php if(get_option('t2t_h2_font')) { echo get_option('t2t_h2_font'); } else { echo 'Pacifico'; } ?>";
	font-size: <?php echo get_option('t2t_h2_font_size'); ?>;
	color: <?php echo get_option('t2t_h2_font_color'); ?>;
}

h3 {
	font-family: "<?php if(get_option('t2t_h3_font')) { echo get_option('t2t_h3_font'); } else { echo 'Cabin'; } ?>";
	font-size: <?php echo get_option('t2t_h3_font_size'); ?>;
	color: <?php echo get_option('t2t_h3_font_color'); ?>;
}


div.events ul li .date,
ul.events_display li.current a { background: <?php echo get_option('t2t_theme_accent_color'); ?>; }
.icon,
span.color { color: <?php echo get_option('t2t_theme_accent_color'); ?>; }

.donate_button { background: <?php echo get_option('t2t_theme_accent_color'); ?>; }

div.sub_heading h2, div.box_heading h2, h1, h2 { color: <?php echo get_option('t2t_theme_accent_color'); ?>; }

<?php ob_end_flush(); ?>
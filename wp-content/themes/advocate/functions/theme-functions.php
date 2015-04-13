<?php

/*-----------------------------------------------------------------------------------*/
/* Add Header Functions
/*-----------------------------------------------------------------------------------*/

function t2t_head() {
	$out = "";
	
	if (get_option('t2t_custom_favicon') != '') {
		$out .= '<link rel="shortcut icon" href="'. get_option('t2t_custom_favicon') .'"/>'."\n";
	}
	
	if(get_option('t2t_custom_css') != "") {
		$out .= '<style type="text/css" media="screen">';
		$out .= get_option('t2t_custom_css');
		$out .= '</style>';
	}
	
	if(get_option('t2t_custom_javascript') != "") {
		$out .= '<script type="text/javascript" charset="utf-8">';
		$out .= stripslashes(get_option('t2t_custom_javascript'));
		$out .= '</script>';
	}
	
	echo $out;
	
}

add_action('wp_head', 't2t_head');

/*-----------------------------------------------------------------------------------*/
/* Show analytics code in footer */
/*-----------------------------------------------------------------------------------*/

function t2t_analytics(){
	$output = get_option('t2t_analytics_code');
	if ( $output <> "" ) 
		echo stripslashes($output) . "\n";
}
add_action('wp_footer','t2t_analytics');

?>
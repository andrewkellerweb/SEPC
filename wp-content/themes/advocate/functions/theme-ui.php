<?php

function t2t_truncate($str, $length=25, $trailing='...') {
	  $length-=mb_strlen($trailing);
	  if (mb_strlen($str)> $length) {
		 return mb_substr($str,0,$length).$trailing;
	  }
	  else {
		 $res = $str;
	  }
	  return $res;
}

/*-----------------------------------------------------------------------------------*/
/*	Function to output logo for "logo" theme option
/*-----------------------------------------------------------------------------------*/
function t2t_logo() {
	if(get_option('t2t_logo_type') == "text"  && get_option('t2t_logo_text') != "") { 
		$out = '<div class="text">';
	} else if(get_option('t2t_logo_type') == "upload"  && get_option('t2t_logo') != "") {
		$out = '<div class="uploaded">';
	} else {
		$out = '<div class="logo">';
	}
	
	$home = home_url();
	
	if(get_option('t2t_logo_type') == "upload" && get_option('t2t_logo') != "") {
		$out .= '<a href="'.$home.'"><img src="'.get_option('t2t_logo').'" alt="'.get_option('blogname').'" /></a>';
	} else if(get_option('t2t_logo_type') == "text"  && get_option('t2t_logo_text') != "") {
		$style = "";
		if(get_option('t2t_logo_size')) { $style .= 'font-size:'. get_option('t2t_logo_size').';'; }
		if(get_option('t2t_logo_color')) { $style .= 'color:'. get_option('t2t_logo_color').';'; }
		$out .= '<a href="'.$home.'" style="'.$style.'">'.get_option('t2t_logo_text').'</a>';
	} else {
		$out .= '<a href="'.$home.'"><img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_option('blogname').'" /></a>';
	}
	$out .= '</div>';
	
	echo $out;
}

/*-----------------------------------------------------------------------------------*/
/*	Custom comment formatting
/*-----------------------------------------------------------------------------------*/
function t2t_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li id="comment-<?php comment_ID(); ?>">
		<?php echo get_avatar($comment, 60); ?>
		<div class="comment">
			<h5><?php printf(sprintf( '%s', get_comment_author_link())); ?></h5>
			<span class="date"><?php echo get_comment_date(); ?> at <?php echo get_comment_time(); ?></span>
			<p><?php comment_text(); ?></p>
			<?php if ($comment->comment_approved == '0') : ?>
				<br />
				<p><em><?php _e( 'Your comment is awaiting moderation.', 'framework'); ?></em></p>
			<?php endif; ?>
			<?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
<?php
			break;
	endswitch;
}

/*-----------------------------------------------------------------------------------*/
/*	Retrieve a formatted slide element for given a slide
/*-----------------------------------------------------------------------------------*/
function t2t_slide($slide,$size) {
	global $wpdb;
	
	$image = get_option($slide);
	$caption = get_option($slide.'_caption');
	$url = get_option($slide.'_url');
	
	if($caption != "") {
		$title = 'title="'.$caption.'"';
	} else {
		$title = '';
	}
	
	if($url != "") {
		$url_start = '<a href="'.$url.'">';
		$url_end = '</a>';
	} else {
		$url_start = '';
		$url_end = '';	
	}

	$output = $url_start.'<img src="'.$image.'" alt="'.$caption.'" '.$title.' />'.$url_end;
	echo $output;
}

/*-----------------------------------------------------------------------------------*/
/*	Geocode and embed a google map given an address
/*-----------------------------------------------------------------------------------*/
function t2t_embed_google_map($post_id) {
	
	$address = get_post_meta($post_id, '_venue_address', true);
	$address .= ' '.get_post_meta($post_id, '_venue_city', true);
	$address .= ' '.get_post_meta($post_id, '_venue_state', true);
	$address .= ' '.get_post_meta($post_id, '_venue_zip', true);
	$address .= ' '.get_post_meta($post_id, '_venue_country', true);
	$address = urlencode($address);
	
	$url = "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false";
	
	
	$geocode = wp_remote_get($url);

	$geocode_output = json_decode($geocode["body"]);

	$lat = $geocode_output->results[0]->geometry->location->lat;
	$long = $geocode_output->results[0]->geometry->location->lng;
	
	
   	$output = '<div id="map"></div>';
	$output .='<script type="text/javascript">';
	$output .= 'var myLatlng = new google.maps.LatLng('.$lat.', '.$long.');';		
	$output .='var myOptions = {';
	$output .='zoom: 12,';
	$output .='center: myLatlng,';
	$output .='mapTypeId: google.maps.MapTypeId.ROADMAP';
	$output .='};';

	$output .='var map = new google.maps.Map(document.getElementById("map"), myOptions);';
	
	$output .='var marker = new google.maps.Marker({';
	$output .='position: myLatlng,';
	$output .='map: map,';
	$output .='title:"'.get_post_meta($post_id, '_venue_name', true).'",';
	$output .='animation: google.maps.Animation.DROP';
	$output .='});';

	$output .='var infoWindow = new google.maps.InfoWindow({';
	$output .='content: "<address><b>'.get_post_meta($post_id, '_venue_name', true).'</b><br />'.get_post_meta($post_id, '_venue_address', true).'<br/>'.get_post_meta($post_id, '_venue_city', true).', '.get_post_meta($post_id, '_venue_state', true).', '.get_post_meta($post_id, '_venue_zip', true).'<br/>'.get_post_meta($post_id, '_venue_country', true).'</address>"';
	$output .='});';

	$output .='google.maps.event.addListener(marker, "click", function() {';
	$output .='infoWindow.open(map, marker);';
	$output .='});';
	
	
	$output .='</script>';
	
	echo $output;
}

function t2t_menu() {
	
	//If WP 3.0 or > include support for wp_nav_menu()
	if(t2t_check_wp_version()){
		
		if ( has_nav_menu( 'primary-menu' ) ) {
			wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => false, 'menu_id' => 'nav', 'fallback_cb' => '' ) );
			return;
		}
	}
	
	$active_class = (is_front_page()) ? 'class="current_page_item"' : '';
	$out = '';
	$out .= '<ul id="nav">';
	$out .= wp_list_pages("sort_column=menu_order&title_li=&echo=0&depth=1");
	$out .= '</ul>';
	
	echo $out;
}

function t2t_donate_box() {
	global $wpdb;
	
	$donatebox_icon = get_option('t2t_donate_banner_icon');
	$donatebox_title = get_option('t2t_donate_banner_title');
	$donatebox_subtitle = get_option('t2t_donate_banner_sub_title');
	$donatebox_button_text = get_option('t2t_donate_banner_button_text');
	$donatebox_button_url = get_option('t2t_donate_banner_button_url');
	
	if(get_option('t2t_donate_banner_icon') == NULL) {
	  $donatebox_icon = "l";
	};
	if(get_option('t2t_donate_banner_title') == NULL) {
	  $donatebox_title = "Donate what you can to help";
	};
	if(get_option('t2t_donate_banner_sub_title') == NULL) {
	  $donatebox_subtitle = "Your tax-free donation helps us do stuff for people, animals and communities in need.";
	};
	if(get_option('t2t_donate_banner_button_text') == NULL) {
	  $donatebox_button = "disabled";
	};
	if(get_option('t2t_donate_banner_button_url') == NULL) {
	  $donatebox_button_url = "#";
	};
	
	$output = '<div id="help" class="framed_box"><span class="icon general">';
	$output .= $donatebox_icon;
	$output .= '</span>';
	$output .= '<div class="text"><h3>';
	$output .= $donatebox_title;
	$output .= '</h3>';
	$output .= '<span class="color">';
	$output .= $donatebox_subtitle;
	$output .= '</span>';
	$output .= '</div>';
	
	if(get_option('t2t_donate_banner_button_text') == NULL) {
	  // do nothing
	} else {
	  $output .= '<a href="' .$donatebox_button_url. '" class="donate_button">' .$donatebox_button_text. '</a>';
	};
	
	$output .= '</div>';
	echo $output;
}

function t2t_video($post_id) {
	
	$video = get_post_meta($post_id, '_video_url', true);
	$embed = get_post_meta($post_id, '_embed_code', true);
	$height = get_post_meta($post_id, '_height', true);
	
	if($height == '')
		$height = 391;
	
	if(trim($embed) == '') {
		
		if(preg_match('/youtube/', $video)) {
	
			if(preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video, $matches)) {
				$output = '<iframe title="YouTube video player" class="youtube-player" type="text/html" width="710" height="'.$height.'" src="http://www.youtube.com/embed/'.$matches[1].'" frameborder="0" allowFullScreen></iframe>';
			} else {
				$output = __('Sorry that seems to be an invalid <strong>YouTube</strong> URL. Please double check it.', 'framework');
			}
			
		} elseif(preg_match('/vimeo/', $video))  {
			
			if(preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video, $matches)) {
				$output = '<iframe src="http://player.vimeo.com/video/'.$matches[1].'" width="710" height="'.$height.'" frameborder="0"></iframe>';
			} else  {
				$output = __('Sorry that seems to be an invalid <strong>Vimeo</strong> URL. Please double check it. Make sure there is a string of numbers at the end.', 'framework');
			}
		} else  {
			$output = __('Sorry that is an invalid YouTube or Vimeo URL.', 'framework');
		}
		
		echo $output;
		
	} else {
		echo stripslashes(htmlspecialchars_decode($embed));
	}
}

function t2t_lightbox($post_id, $size, $lightbox, $echo=true) {
	
	$thumb = get_the_post_thumbnail($post_id, $size);
	$original = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'original');
	$video = get_post_meta($post_id, '_video_url', true);
	$embed = get_post_meta($post_id, '_embed_code', true);
	$height = get_post_meta($post_id, '_height', true);
	
	if($video != "" || $embed != "") {
		$li_class = "video";
	} else {
		$li_class = "";
	}
	
	$terms = get_the_terms( $post_id, 'gallery_albums' );
	$term_list = "";
	if($terms != "") {	
		foreach ($terms as $term) { 
			$term_list .= $term->slug.' ';
		}
	}
		
	if($height == '')
		$height = 391;
	
	if($lightbox == true) {
		if($video != '' && $embed == '' && $thumb == '') {
			if (strpos($video, 'youtube') > 0) {
		        $link_class = 'youtube';
						$video_id = preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video, $matches);
						$thumb = '<img src="http://img.youtube.com/vi/'.$matches[1].'/0.jpg" />';
		    } elseif (strpos($video, 'vimeo') > 0) {
		        $link_class = 'vimeo';
						$video_id = preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video, $matches);
						$hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.$matches[1].'.php'));
						$thumb = '<img src="'.$hash[0]['thumbnail_medium'].'" />';
		    }
		}
		$output = '<li class="'.$li_class.'" data-type="'.$term_list.'"><a href="'.get_permalink().'">'.$thumb.'</a></li>';
	} else {
		if($embed != '') {
			$output = '<li class="'.$li_class.'" data-type="'.$term_list.'"><a href="'.get_template_directory_uri().'/functions/includes/gallery-video.php?id='.$post_id.'&iframe=true&width=710&height='.$height.'" title="'.get_the_title($post_id).'" class="fancybox" rel="gallery">'.$thumb.'</a></li>';
		} elseif($video != '' && $embed == '') {
			if (strpos($video, 'youtube') > 0) {
		        $link_class = 'youtube';
						$video_id = preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $video, $matches);
						if($thumb == '') {
							$thumb = '<img src="http://img.youtube.com/vi/'.$matches[1].'/0.jpg" />';
						}
		    } elseif (strpos($video, 'vimeo') > 0) {
		        $link_class = 'vimeo';
						$video_id = preg_match('~^http://(?:www\.)?vimeo\.com/(?:clip:)?(\d+)~', $video, $matches);
						$hash = unserialize(file_get_contents('http://vimeo.com/api/v2/video/'.$matches[1].'.php'));
						if($thumb == '') {
							$thumb = '<img src="'.$hash[0]['thumbnail_medium'].'" />';
						}
		    }
			$output = '<li class="'.$li_class.'" data-type="'.$term_list.'"><a href="'.$video.'" title="'.get_the_title($post_id).'" class="'.$link_class.'" rel="gallery">'.$thumb.'</a></li>';
		} else {
			$output = '<li class="'.$li_class.'" data-type="'.$term_list.'"><a href="'.$original[0].'" title="'.get_the_title($post_id).'" class="fancybox" rel="gallery">'.$thumb.'</a></li>';
		}
	}
	
	if($echo == true) {
		echo $output;
	} else {
		return $output;
	}
	
}

?>
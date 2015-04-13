<!DOCTYPE html>
<html lang="en" <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<title> <?php bloginfo('name'); ?> <?php wp_title('-'); ?></title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes" />
	
	<link rel="shortcut icon" href="<?php echo stripslashes(get_option('t2t_favicon')); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />

	<!-- Theme Hook -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
  <div class="container"> 
    <!-- Start Menu -->
    <nav>
      <?php t2t_menu(); ?>
    </nav>
    <!-- End Menu --> 
    
    <!-- Start Social Icons -->
    <aside>
      	<ul class="social icon">
					<?php if(get_option('t2t_social_twitter')) { ?><li><a href="<?php echo get_option('t2t_social_twitter'); ?>" title="Twitter">a</a></li><?php } ?>
					<?php if(get_option('t2t_social_facebook')) { ?><li><a href="<?php echo get_option('t2t_social_facebook'); ?>" title="Facebook">v</a></li><?php } ?>
					<?php if(get_option('t2t_social_flickr')) { ?><li><a href="<?php echo get_option('t2t_social_flickr'); ?>" title="Flickr">d</a></li><?php } ?>
					<?php if(get_option('t2t_social_vimeo')) { ?><li><a href="<?php echo get_option('t2t_social_vimeo'); ?>" title="Vimeo">c</a></li><?php } ?>
					<?php if(get_option('t2t_social_youtube')) { ?><li><a href="<?php echo get_option('t2t_social_youtube'); ?>" title="YouTube">z</a></li><?php } ?>
					<?php if(get_option('t2t_social_google')) { ?><li><a href="<?php echo get_option('t2t_social_google'); ?>" title="Google">t</a></li><?php } ?>
					<?php if(get_option('t2t_social_rss')) { ?><li><a href="<?php echo get_option('t2t_social_rss'); ?>" title="RSS">b</a></li><?php } ?>
					<?php if(get_option('t2t_social_picasa')) { ?><li><a href="<?php echo get_option('t2t_social_picasa'); ?>" title="Picasa">e</a></li><?php } ?>
					<?php if(get_option('t2t_social_dribbble')) { ?><li><a href="<?php echo get_option('t2t_social_dribbble'); ?>" title="dribbble">f</a></li><?php } ?>
					<?php if(get_option('t2t_social_forrst')) { ?><li><a href="<?php echo get_option('t2t_social_forrst'); ?>" title="Forrst">g</a></li><?php } ?>
					<?php if(get_option('t2t_social_deviantart')) { ?><li><a href="<?php echo get_option('t2t_social_deviantart'); ?>" title="deviantART">h</a></li><?php } ?>
					<?php if(get_option('t2t_social_wordpress')) { ?><li><a href="<?php echo get_option('t2t_social_wordpress'); ?>" title="WordPress">i</a></li><?php } ?>
					<?php if(get_option('t2t_social_blogger')) { ?><li><a href="<?php echo get_option('t2t_social_blogger'); ?>" title="Blogger">j</a></li><?php } ?>
					<?php if(get_option('t2t_social_yahoo')) { ?><li><a href="<?php echo get_option('t2t_social_yahoo'); ?>" title="Yahoo!">k</a></li><?php } ?>
					<?php if(get_option('t2t_social_amazon')) { ?><li><a href="<?php echo get_option('t2t_social_amazon'); ?>" title="Amazon">l</a></li><?php } ?>
					<?php if(get_option('t2t_social_linkedin')) { ?><li><a href="<?php echo get_option('t2t_social_linkedin'); ?>" title="LinkedIn">m</a></li><?php } ?>
					<?php if(get_option('t2t_social_lastfm')) { ?><li><a href="<?php echo get_option('t2t_social_lastfm'); ?>" title="Last.fm">n</a></li><?php } ?>
					<?php if(get_option('t2t_social_stumbleupon')) { ?><li><a href="<?php echo get_option('t2t_social_stumbleupon'); ?>" title="StumbleUpon">o</a></li><?php } ?>
					<?php if(get_option('t2t_social_pinterest')) { ?><li><a href="<?php echo get_option('t2t_social_pinterest'); ?>" title="Pinterest">p</a></li><?php } ?>
					<?php if(get_option('t2t_social_xing')) { ?><li><a href="<?php echo get_option('t2t_social_xing'); ?>" title="Xing">q</a></li><?php } ?>
					<?php if(get_option('t2t_social_soundcloud')) { ?><li><a href="<?php echo get_option('t2t_social_soundcloud'); ?>" title="SoundCloud">r</a></li><?php } ?>
					<?php if(get_option('t2t_social_delicious')) { ?><li><a href="<?php echo get_option('t2t_social_delicious'); ?>" title="Delicious">s</a></li><?php } ?>
					<?php if(get_option('t2t_social_mail')) { ?><li><a href="<?php echo get_option('t2t_social_mail'); ?>" title="Mail">u</a></li><?php } ?>
					<?php if(get_option('t2t_social_github')) { ?><li><a href="<?php echo get_option('t2t_social_github'); ?>" title="GitHub">y</a></li><?php } ?>
			</ul>
    </aside>
    <!-- End Social Icons --> 
  </div>
</header>
<?php if (is_page_template( 'template-home.php' )) { ?>
<section class="page_heading home">
  <div class="logo container">
    <?php t2t_logo(); ?>
    <?php if (get_option('t2t_showtagline') == true) { ?>
    <span class="tagline"><?php echo get_option( 't2t_tagline' ); ?></span>
    <?php } ?>
  </div>
</section>
<?php } else { ?>
<section class="page_heading">
  <div class="logo container"> 
    <?php t2t_logo(); ?> 
    <?php if (get_option('t2t_showtagline') == "true") { ?>
    <span class="tagline"><?php if(get_option('t2t_tagline') != "") { echo get_option('t2t_tagline'); }; ?></span>
    <?php } ?>
  </div>
</section>
<?php }; ?>

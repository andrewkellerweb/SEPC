<?php
/*
Template Name: Home
*/
?>
<?php get_header(); ?>

<!-- Start Home -->

<div id="home" class="page_wrapper"> 
  
  <!-- Start Container -->
  <section class="container"> 
    
    <!-- Start Page -->
    <div class="page"> 

		<?php
			$slide1 = get_option($shortname.'_slide_1'); 
			$slide2 = get_option($shortname.'_slide_2'); 
			$slide3 = get_option($shortname.'_slide_3'); 
			$slide4 = get_option($shortname.'_slide_4'); 
			$slide5 = get_option($shortname.'_slide_5'); 
		?>
		
		<script type="text/javascript" charset="utf-8">
		<?php 
			$output = "jQuery(document).ready(function($) {";
			$output .= "$(\"div#slides\").nivoSlider({";
			if(get_option('t2t_slider_animation') != "") {
				$output .= "	effect: '". get_option('t2t_slider_animation') ."',";
			}
			if(get_option('t2t_pause_duration') != "" && get_option('t2t_disable_slider') == "true") {
				$output .= "		manualAdvance: true,";
			} else {
				if(get_option('t2t_autoplay_duration') != '') {
					$output .= "			pauseTime: ". get_option('t2t_autoplay_duration') .",";
				} else {
					$output .= "			manualAdvance: true,";
				}
			}
			$output .= "	animSpeed:500,";
			$output .= "	directionNav: false,";
			$output .= "	captionOpacity: 0.8,";
			$output .= "	controlNav: false,";
			$output .= "	directionNav: true";
			$output .= "	});";
			$output .= "});";

			echo $output;
		?>
		</script>
      
		<!-- Start Nivo Slider -->
		<div id="slider" class="theme-default">
			<div id="slides">
				<?php if($slide1 != '') : ?>
					<?php t2t_slide($shortname.'_slide_1', ''); ?>
				<?php endif; ?>
		        <?php if($slide2 != '') : ?>
					<?php t2t_slide($shortname.'_slide_2', ''); ?>
				<?php endif; ?>
		        <?php if($slide3 != '') : ?>
					<?php t2t_slide($shortname.'_slide_3', ''); ?>
				<?php endif; ?>
		        <?php if($slide4 != '') : ?>
					<?php t2t_slide($shortname.'_slide_4', ''); ?>
				<?php endif; ?>
		        <?php if($slide5 != '') : ?>
					<?php t2t_slide($shortname.'_slide_5', ''); ?>
		        <?php endif; ?>
			</div>
		</div>
		<!-- End Nivo Slider -->
      
      <div class="sub_heading">
        <h2><?php echo get_option('t2t_subtitle_text'); ?></h2>
        <span class="line"></span> 
	 </div>
	
      <div id="revolution_wrap" class="full">
	
        <div id="description" class="<?php if(get_option('t2t_disable_features') == true) { echo "full_width"; } else { echo "one_third"; } ?>">
          <h3><?php echo get_option('t2t_about_title'); ?></h3>
          <?php echo get_option('t2t_about_content'); ?> 
		</div>
        
        <!-- Start Actions -->
        <div id="actions">
          <?php if(get_option('t2t_disable_features') != true) { ?>
          <?php 
		    query_posts('post_type=t2t_feature&order=DESC&posts_per_page='.get_option('t2t_number_of_features').''); 
		  ?>
          <ul class="actions_list">
            <?php while (have_posts()) : the_post(); ?>
            <div class="box one_half">
              <div class="inner">
                <div class="box_heading"> <span class="icon general-enclosed"><?php echo get_post_meta($post->ID, '_select_icon', true); ?></span>
                  <h4>
                   	<?php
						$title_link = get_post_custom_values('_read_more', $post->ID);
						if($title_link[0] == 1) { 
					?>
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					<?php } else { ?>
						<?php the_title(); ?>
					<?php } ?>
                  </h4>
                </div>
                <?php the_excerpt(); ?>
              </div>
            </div>
            <?php endwhile; ?>
          </ul>
          <?php }; 
		  ?>
        </div>
        <!-- End Actions --> 
      </div>
      
      <?php if(get_option('t2t_disable_donate_banner') != true) { ?>      
      <!-- Start Help -->
      <div id="help" class="framed_box"> <span class="icon general"><?php if(get_option('t2t_donate_banner_icon') != "") { echo get_option('t2t_donate_banner_icon'); } ?></span>
        <div class="text">
          <h3><?php if(get_option('t2t_donate_banner_title') != "") { echo get_option('t2t_donate_banner_title'); } ?></h3>
          <span class="color"><?php if(get_option('t2t_donate_banner_sub_title') != "") { echo get_option('t2t_donate_banner_sub_title'); } ?></span> </div>
        <?php if(get_option('t2t_donate_banner_button_text') != "") { ?><a href="<?php if(get_option('t2t_donate_banner_button_url') != "") { echo get_option('t2t_donate_banner_button_url'); } ?>" class="donate_button"><?php echo get_option('t2t_donate_banner_button_text'); } ?></a> </div>
      <!-- End Help --> 
      
      <?php } ?>
      
      <?php if(get_option('t2t_disable_bottom_content_area') != true) {  ?>
      <!-- Start Items -->
      <div id="items"> 
        
        <?php echo do_shortcode(get_option('t2t_bottom_content_area')); ?>
        
      </div>
      <!-- End Items -->
      
      <?php } ?>
      
    </div>
    <!-- End Page --> 
    
  </section>
  <!-- End Container --> 
  
</div>
<!-- End Home -->
<?php get_footer(); ?>
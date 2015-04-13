<?php
/*
Template Name: Gallery
*/
?>
<?php get_header(); ?>

<div class="page_wrapper">
  <section class="container"> 
    
    <!-- Start Gallery -->
    <div id="gallery" class="page">
	
		<?php while (have_posts()) : the_post(); ?>

			<h1><?php global $post; the_title(); ?></h1>
			<?php the_content(); ?>

		<?php endwhile; ?>
			
		<?php if(get_option('t2t_disable_gallery_filter') != true) { ?>
			
		<!-- Start Gallery Filters -->
		<ul class="filter_list">
			<li class="current"><a href="javascript:;" class="all-items"><?php _e('All', 'framework'); ?></a></li>
			<?php
				$terms = get_terms('gallery_albums');
				$count = count($terms);
				$term_list = "";
				$i=0;
				if ($count > 0) {
					foreach ($terms  as $term) {
					$i++;
					$term_list  .= '<li><a href="javascript:;" class="'.  $term->slug .'">' . $term->name . '</a></li>';
						if ($count  != $i) {
							$term_list .= '';
						} else {
							$term_list .= '';
						}
					}
					echo $term_list;
				}
			?>
		</ul>
		<!-- End Gallery Filters -->
		
		<?php } ?>
      
      <?php 
		$query = new WP_Query();
		$query->query('post_type=t2t_gallery&nopaging=true');  
		if(get_option('t2t_gallery_layout') == "Two Columns") {
			$layout = "two_column";
		} elseif(get_option('t2t_gallery_layout') == "Four Columns") {
			$layout = "four_column";
		} else {
			$layout = "three_column";
		}
	  ?>
	  <ul class="gallery_thumbnails <?php echo $layout; ?>">
		<?php while ($query->have_posts()) : $query->the_post();  ?>
			<?php t2t_lightbox(get_the_ID(), 'gallery-thumb', get_option('t2t_disable_gallery_lightbox')); ?>
		<?php endwhile; wp_reset_query(); ?>
	  </ul>
      
    </div>
    <!-- End Gallery --> 
    
  </section>
</div>

<?php get_footer(); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Start Gallery -->
<div class="page_wrapper">
  <section class="container"> 
    
    <!-- Start Page Content -->
    <div id="gallery_image" class="page with_sidebar">
	
		<h1><?php the_title(); ?></h1>
			
		<div class="image">
	
			<?php 
				$video = get_post_meta(get_the_ID(), '_video_url', true);
				$embed_code = get_post_meta(get_the_ID(), '_embed_code', true);
			?>
		
			<?php if($video !='' || $embed_code != '') : ?>
			
				<div class="video"><?php t2t_video(get_the_ID()); ?></div>
			
			<?php else : ?>
			
				<?php if ( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) : ?>
					<?php the_post_thumbnail('');  ?>
				<?php endif; ?>
			
			<?php endif; ?>
		
			<div class="caption"><?php the_content(); ?></div>
					
		</div>
	
		<!-- Start Comments -->
		<div id="comments">
			<?php comments_template('', false); ?>				
		</div>
		<!-- End Comments -->

	</div>

	<?php get_sidebar(); ?>

  </section>
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
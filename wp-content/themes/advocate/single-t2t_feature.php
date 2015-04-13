<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Start Feature -->
<div class="page_wrapper">
  <section class="container"> 
    
    <!-- Start Page Content -->
    <div id="feature" class="page with_sidebar">
		<div id="actions" class="full_width">
			
 		<div class="box">
           <div class="inner">
             <div class="box_heading"> 
				<span class="icon general-enclosed"><?php echo get_post_meta($post->ID, '_select_icon', true); ?></span>
                <h4><?php the_title(); ?> </h4>
             </div>
             <?php the_content(); ?>
           </div>
         </div>

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
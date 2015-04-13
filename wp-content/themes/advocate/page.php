<?php get_header(); ?>

<div class="page_wrapper">
  <section class="container"> 
	
    <!-- Start Page Content -->
    <div class="page with_sidebar">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      	
		<h1><?php the_title(); ?></h1>
      	<?php the_content(); ?>

      <?php endwhile; endif; ?>
      <?php wp_link_pages('before=<div class="pagination">&after=</div>'); ?>
    </div>
    <!-- End Page Content --> 
    
    <?php get_sidebar(); ?>
    
  </section>
</div>
<?php get_footer(); ?>

<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>

<div class="page_wrapper">
  <section class="container"> 
    
    <!-- Start Page Content -->
    
    <div id="<?php the_title(); ?>" class="page">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
      	<h1><?php the_title(); ?></h1>

      	<?php the_content(); ?>

      <?php endwhile; else : ?>
	      <p>
	        <?php _e('Sorry, no posts matched your criteria.', 'framework') ?>
	      </p>
      <?php endif; ?>

    </div>
    <!-- End Page Content --> 
    
  </section>
</div>

<?php get_footer(); ?>
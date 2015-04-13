<?php get_header(); ?>
<div class="page_wrapper">
  <section class="container"> 
    
    <!-- Start Page Content -->
    <div id="blog" class="page with_sidebar">
      <h1><?php _e('Blog', 'framework'); ?></h1>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div id="post_id_<?php the_ID(); ?>" <?php post_class('post'); ?>> 
        
        <!-- Start Blog Post -->
          <?php
			  if (has_post_thumbnail()) {
				$image_id = get_post_thumbnail_id();  
				$image_url = wp_get_attachment_image_src($image_id,'post-image');  
				$image_url = $image_url[0];
				echo '<img src="'.$image_url.'" alt="" class="rounded" />';
			  }
	      ?>
          <h3>
            <?php the_title(); ?>
          </h3>
          <div class="meta"> <span class="date"> <span class="icon general">i</span>
            <?php the_time('M jS') ?>
            </span> <span class="comments"><span class="icon social_misc">w</span> <a href="" title="">
            <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>
            </a></span> <span class="author"> <span class="icon social_misc">x</span>
            <?php _e('by', 'framework') ?>
            <?php the_author_posts_link(); ?>
            </span> </div>
            
            <?php the_content(); ?>
            
        <!-- End Blog Post --> 
        
      </div>
      <?php endwhile; else : ?>
      <p>
        <?php _e('Sorry, no posts matched your criteria.', 'framework') ?>
      </p>
      <?php endif; ?>
      
      <!-- Start Comments -->
      <div id="comments">
        <h4>Comments</h4>
        <?php comments_template('', true); ?>
      </div>
      <!-- End Comments --> 
      
    </div>
    <!-- End Page Content --> 
    
    <!-- Start Sidebar -->
    <aside>
      <?php get_sidebar(); ?>
    </aside>
    <!-- End Sidebar --> 
    
  </section>
</div>
<?php get_footer(); ?>

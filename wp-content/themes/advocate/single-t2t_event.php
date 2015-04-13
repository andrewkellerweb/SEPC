<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<!-- Start Event -->
<div class="page_wrapper">
  <section class="container"> 
    
    <!-- Start Page Content -->
    <div id="event" class="page with_sidebar">
	
		<h1><?php the_title(); ?> </h1>
		
		<div class="event_details">
			<?php if(get_post_meta($post->ID, '_google_maps', true) != 0 && get_post_meta($post->ID, '_venue_address', true) != "") { ?>
			<div class="event_map">
				<?php t2t_embed_google_map($post->ID); ?>
			</div>
			<?php } ?>
			<ul class="left">
				<?php if(get_post_meta($post->ID, '_venue_name', true) != "") { ?>
				<li>
					<b><?php _e('Venue:', 'framework') ?></b>
					<div class="info">
						<?php echo get_post_meta($post->ID, '_venue_name', true); ?>
					</div>
				</li>
				<?php } ?>
				<?php 
				if(get_post_meta($post->ID, '_all_day_event', true) != true) { 
					$start_date = get_post_meta($post->ID, '_start_date', true);

					// check for valid start date
					if($start_date != "") {
					?>
					<li>
						<b><?php _e('Start', 'framework') ?>:</b>
						<div class="info">
							<?php echo gmdate('F j, Y g:i a', strtotime($start_date)); ?>
						</div>
					</li>
					<?php
					}

					$end_date = get_post_meta($post->ID, '_end_date', true);

					// check for valid end date
					if($end_date != "") {
					?>
					<li>
						<b><?php _e('End', 'framework') ?>:</b>
						<div class="info">
						<?php echo gmdate('F j, Y g:i a', strtotime($end_date)); ?>
						</div>
					</li>
				<?php } ?>
				<?php } else { ?>
				<li>
					<b><?php _e('Time:', 'framework') ?></b>
					<div class="info">
						<?php _e('All day event', 'framework') ?>
					</div>
				</li>
				<?php } ?>
			</ul>
			<ul class="right">
				<?php if(get_post_meta($post->ID, '_venue_address', true) != "") { ?>
				<li>
					<b><?php _e('Address:', 'framework') ?></b>
					<div class="info">
						<?php echo get_post_meta($post->ID, '_venue_address', true); ?> <br/>
						<?php echo get_post_meta($post->ID, '_venue_city', true); ?>, 
						<?php echo get_post_meta($post->ID, '_venue_state', true); ?>,
						<?php echo get_post_meta($post->ID, '_venue_zip', true); ?> <br/>
						<?php echo get_post_meta($post->ID, '_venue_country', true); ?> 
					</div>
				</li>
				<?php } ?>
				<?php if(get_post_meta($post->ID, '_cost', true) != "") { ?>
				<li>
					<b><?php _e('Cost:', 'framework') ?></b>
					<div class="info">
						<?php echo get_post_meta($post->ID, '_cost', true); ?>
					</div>
				</li>
				<?php } ?>
			</ul>
		</div>
		
        <p><?php the_content(); ?></p>
		
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
<?php
/*
Template Name: Events
*/
?>
<?php get_header(); ?>

<div class="page_wrapper">
  <section class="container"> 
    
    <!-- Start Page Content -->
    
    <div id="events" class="page">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

      	<h1><?php the_title(); ?></h1>		

		<ul class="events_display">
			<li><a href="javascript:;" class="calendar_list">Event List</a></li>
			<li class="current"><a href="javascript:;" class="calendar">Calendar</a>
		</ul>

      	<?php the_content(); ?>
		
		<div id="calender_view">
			<div id="calendar"></div>
		</div>
		
		<div id="calendar_list">
			
			<ul>
				<?php 
					$query = new WP_Query();
					$query->query('post_type=t2t_event&nopaging=true');
					while ($query->have_posts()) : $query->the_post();
				?>
				<?php if(strtotime(get_post_meta($post->ID, '_start_date', true)) > strtotime("-1 day")) { ?>
				<li>
					<div class="box_heading">
						<h2><?php echo gmdate('F j, Y', strtotime(get_post_meta($post->ID, '_start_date', true))); ?></h2>
						<span class="line"></span>
					</div>
					<div class="event_info">
						<div class="desc">
							<h3><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo t2t_truncate(get_the_content(), 300, "..."); ?></p>
						</div>
						
						<div class="event_details meta">
							<ul>
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
					</div>
				</li>
				<?php } ?>
				<?php endwhile; wp_reset_query(); ?>
			</ul>
			
			
		</div>

      <?php endwhile; else : ?>
	      <p>
	        <?php _e('Sorry, no posts matched your criteria.', 'framework') ?>
	      </p>
      <?php endif; ?>

    </div>
    <!-- End Page Content --> 
    
  </section>
</div>

<script type="text/javascript" charset="utf-8">
	jQuery(document).ready(function($) {
		$('#calendar').fullCalendar({
			events: [
			<?php 
				$query = new WP_Query();
				$query->query('post_type=t2t_event&nopaging=true');
				while ($query->have_posts()) : $query->the_post();
			?>
				{
					title: '<?php the_title(); ?>',
					start: '<?php echo gmdate('Y-m-d H:i:s', strtotime(get_post_meta($post->ID, '_start_date', true))); ?>',
					end: '<?php echo gmdate('Y-m-d H:i:s', strtotime(get_post_meta($post->ID, '_end_date', true))); ?>',
					allDay: <?php if(get_post_meta($post->ID, '_all_day_event', true) != "") { echo "true"; } else { echo "false"; } ?>,
					color: '<?php echo get_option('t2t_theme_accent_color'); ?>',
					url: '<?php the_permalink(); ?>'
				}<?php if( ($query->current_post + 1) < ($query->post_count) ) { echo ","; } else { echo ""; } ?>
			<?php endwhile; wp_reset_query(); ?>
			],
			eventClick: function(event) {
		        if (event.url) {
		            parent.location = event.url;
		            return false;
		        }
		    },
		   eventRender: function(event, element) {                                          
		   	element.find('span.fc-event-title').html(element.find('span.fc-event-title').text());					  
		   },
		buttonText: {
			prev: 'v',
			next: 'u'
		}
		});
		
		$("a.calendar").click(function() {
			$("#calender_view").show();
			$("#calendar_list").hide();
			$("ul.events_display li").removeClass("current");
			$(this).parent().addClass("current");
		});
		
		$("a.calendar_list").click(function() {
			$("#calender_view").hide();
			$("#calendar_list").show();
			$("ul.events_display li").removeClass("current");
			$(this).parent().addClass("current");
		});
	});
</script>
<?php get_footer(); ?>
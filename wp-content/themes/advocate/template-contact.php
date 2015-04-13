<?php
/*
Template Name: Contact
*/
?>
<?php 
$error_list = "";
if(isset($_POST['submitted'])) {
		if(trim($_POST['full_name']) === '') {
			$error_list .= '<li>Please enter your name.</li>';
			$has_error = true;
		} else {
			$name = trim($_POST['full_name']);
		}
		
		if(trim($_POST['email']) === '')  {
			$error_list .= '<li>Please enter your email address.</li>';
			$has_error = true;
		} else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
			$error_list .= '<li>Please enter a valid email address.</li>';
			$has_error = true;
		} else {
			$email = trim($_POST['email']);
		}
			
		if(trim($_POST['message']) === '') {
			$error_list .= '<li>Please enter a message.</li>';
			$has_error = true;
		} else {
			if(function_exists('stripslashes')) {
				$message = stripslashes(trim($_POST['message']));
			} else {
				$message = trim($_POST['message']);
			}
		}
		
		$phone = trim($_POST['phone']);
		$subject = trim($_POST['subject']);
			
		if(!isset($has_error)) {
			$email_to = get_option('t2t_contact_form_email');
			if (!isset($email_to) || ($email_to == '') ){
				$email_to = get_option('admin_email');
			}
			$email_subject = '[Contact Form] From '.$name;
			$body = "Name: $name \n\nEmail: $email \n\nPhone: $phone \n\nSubject: $subject \n\nMessage: $message";
			$headers = 'From: '.$name.' <'.$email_to.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($email_to, $email_subject, $body, $headers);
			$sent = true;
		} else {
			$error_html = "<ul>";
			$error_html .= $error_list;
			$error_html .= "</ul>";	
		}
		
} ?>
<?php get_header(); ?>

<div class="page_wrapper">
  <section class="container"> 
    
    <!-- Start Page Content -->
    <div id="contact" class="page with_sidebar">
      <h1><?php 
		global $post;
		the_title();
	?></h1>
    
    
    <div class="full">
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<?php if(isset($sent) && $sent == true) { ?>

            <div class="sent">
                <p><?php _e('Thanks, your email has been sent successfully.', 'framework') ?></p>
            </div>

        <?php } else { ?>

            <?php the_content(); ?>	

            <?php if(isset($has_error)) { ?>
                <div class="box error">
					<p><?php _e('Sorry, your message could not be sent because of the following reasons:', 'framework') ?></p>
					<?php echo $error_html; ?>
				</div>
            <?php } ?>
	
			<form action="<?php the_permalink(); ?>" id="contact_form" method="post">
				<div class="row">
                <p>
                    <label for="full_name"><?php _e('Name', 'framework'); ?></label>
					<input type="text" name="full_name" id="full_name" title="<?php _e('Name', 'framework') ?>" value="<?php if(isset($_POST['full_name'])) echo $_POST['full_name'];?>" />
                </p>
                <p>
                    <label for="email"><?php _e('Email Address', 'framework'); ?></label>
					<input type="text" name="email" id="email" class="last" title="<?php _e('Email', 'framework') ?>" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" />
                </p>
				</div>
		
				<div class="row">
                <p>
                    <label for="phone"><?php _e('Phone', 'framework'); ?></label>
					<input type="text" name="phone" id="phone" title="<?php _e('Phone', 'framework') ?>" value="<?php if(isset($_POST['phone']))  echo $_POST['phone'];?>" />
                </p>
                <p>
					<label for="subject"><?php _e('Subject', 'framework'); ?></label>
					<input type="text" name="subject" id="subject" title="<?php _e('Subject', 'framework') ?>" value="<?php if(isset($_POST['subject']))  echo $_POST['subject'];?>" />
                </p>
				</div>
				<p>
                <label for="message"><?php _e('Message', 'framework'); ?></label>
                <textarea name="message" id="message" title="<?php _e('Message', 'framework') ?>"><?php if(isset($_POST['message']))  echo $_POST['message'];?></textarea></p>
				<input type="hidden" name="submitted" id="submitted" value="true" />
				<input type="submit" value="<?php _e('Send Email &#x2192;', 'framework') ?>" class="button white" />
		
			</form>
			
		<?php } ?>
	
	<?php endwhile; ?>
	<?php endif; ?>
    
    </div>
      
      <!-- Start Location -->
      <div id="location">
        <div class="box_heading">
          <h2><?php _e('Location', 'framework'); ?></h2>
          <span class="line"></span> </div>
        <div class="map">
          <iframe width="438" height="194" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo stripslashes(get_option('t2t_contact_map_url')); ?>&amp;output=embed"></iframe>
        </div>
        <div class="one_third column_last">
          <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Contact Page')) : ?><?php endif; ?>
        </div>
      </div>
      <!-- End Location --> 
      
    </div>
    <!-- End Page Content -->
    
    <aside>
      <?php get_sidebar(); ?>
    </aside>
    
  </section>
</div>

<?php get_footer(); ?>

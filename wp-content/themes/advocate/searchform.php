<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
	<p>	
		<label for="s"><?php _e('Enter a search term...', 'framework'); ?></label>
        <input type="text" value="<?php the_search_query(); ?>" name="s" class="text_field" id="s" />
		<input type="submit" id="searchsubmit" value="<?php _e('Search', 'framework'); ?>" />
	</p>
</form>

<!-- Start Sidebar -->
<aside>
	<div id="sidebar">
		<?php 
			if(is_post_type('t2t_gallery')) {
				if (function_exists( 'dynamic_sidebar' )) { dynamic_sidebar('Page Sidebar'); }
			} elseif(!is_page()) {
				if (function_exists( 'dynamic_sidebar' )) { dynamic_sidebar(); }
			} else {
				if (function_exists( 'dynamic_sidebar' )) { dynamic_sidebar('Page Sidebar'); }
			}
		?>
	</div>
	</aside>
<!-- End Sidebar -->
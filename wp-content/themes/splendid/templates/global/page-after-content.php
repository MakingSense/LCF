<?php
/**
 * Content wrapper presented after the loop (eg. used in page.php)
 * 
 * @package splendid
 */

if (in_array(ts_get_opt('main-layout'), array('right_sidebar','dual_sidebar'))): ?>
	<?php get_sidebar('right'); ?>
<?php endif; 

if (ts_check_if_sidebar_activated()): ?>
	</div>
	<!-- /content-with-sidebar -->
<?php endif; ?>
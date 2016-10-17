<?php
/**
 * Content wrapper presented before the loop (eg. used in page.php)
 * 
 * @package splendid
 */

if (ts_check_if_sidebar_activated()): ?>
	<div class="content-with-sidebar <?php echo sanitize_html_class(ts_get_sidebar_class('sidebar-onleft', 'sidebar-onright', 'sidebar-dual')); ?> ">
<?php endif;

if (in_array(ts_get_opt('main-layout'), array('left_sidebar','dual_sidebar'))): ?>
	<?php get_sidebar('left'); ?>
<?php endif; 
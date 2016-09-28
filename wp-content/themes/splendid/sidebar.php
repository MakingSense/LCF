<?php
/**
 * The Sidebar containing the right widget areas.
 *
 * @package splendid
 * @since splendid 1.0
 */
?>
<!-- Sidebar -->
<div class="sidebar sidebar-right">		
	<div class="sidebar-container">
		<?php if (is_active_sidebar( ts_get_custom_sidebar('main', 'sidebar-right') )): ?>
			<?php dynamic_sidebar( ts_get_custom_sidebar('main','sidebar-right') ); ?>
		<?php endif; ?>
	</div>
	<!-- End Sidebar Container -->
</div>
<!-- End Sidebar -->
<?php
/**
 * The Sidebar containing the left widget areas.
 *
 * @package splendid
 * @since splendid 1.0
 */
?>
<!-- Sidebar -->
<div class="sidebar sidebar-left">		
	<div class="sidebar-container">
		<?php if (is_active_sidebar( ts_get_custom_sidebar('main', 'sidebar-left') )): ?>
			<?php dynamic_sidebar( ts_get_custom_sidebar('main','sidebar-left') ); ?>
		<?php endif; ?>
	</div>
	<!-- End Sidebar Container -->
</div>
<!-- End Sidebar -->
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
		<?php if (is_active_sidebar( 'shop' )): ?>
			<?php dynamic_sidebar( 'shop' ); ?>
		<?php endif; ?>
	</div>
	<!-- End Sidebar Container -->
</div>
<!-- End Sidebar -->
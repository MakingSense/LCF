<?php
/**
 * Shopping cart icon
 * 
 * @package splendid
 */
?>

<?php if (class_exists('WooCommerce') && ts_get_opt('header-enable-cart')): ?>
	<div class="header-shopping-cart">
		<a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>"><i class="sprite-icon <?php echo sanitize_html_classes(ts_get_opt('header-menu-icons-color')); ?> icon-shopping-cart"></i></a>
	</div>
<?php endif; ?>


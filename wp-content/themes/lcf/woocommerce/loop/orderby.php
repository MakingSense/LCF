<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<form class="woocommerce-ordering" method="get">
	<select name="orderby" class="orderby" data-label="<?php esc_attr_e('Sort by', 'splendid'); ?>">
		<?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
			<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
		<?php endforeach; ?>
	</select>
	<?php
		// Keep query string vars intact
		foreach ( $_GET as $key => $val ) {
			if ( 'orderby' === $key || 'submit' === $key || 'postsperpage'  ) {
				continue;
			}
			if ( is_array( $val ) ) {
				foreach( $val as $innerVal ) {
					echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
				}
			} else {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
			}
		}
	?>
	<?php 
	if (isset($_GET['orderby']) && $_GET['orderby'] == 'price'): ?>
		<div class="sortby-price-low-to-high"><div></div></div>
	<?php endif;
	if (isset($_GET['orderby']) && $_GET['orderby'] == 'price-desc'): ?>
		<div class="sortby-price-high-to-low"><div></div></div>
	<?php endif;
	
	$values = splendid_wc_get_posts_per_page_dropdown_values(); 
	$current_posts_per_page_value = splendid_wc_get_current_posts_per_page_value(); 
	if (is_array($values)): ?>
		<select name="postsperpage" class="postsperpage" data-default="<?php echo esc_attr($current_posts_per_page_value); ?>" data-label="<?php esc_attr_e('Display', 'splendid'); ?>">
			<?php foreach ($values as $val): ?>
				<option value="<?php echo esc_attr( $val ); ?>" <?php selected( $val, $current_posts_per_page_value ); ?>><?php echo esc_html( $val ); ?> <?php esc_html_e('Products per page', 'splendid'); ?></option>
			<?php endforeach; ?>
		</select>
	<?php endif; ?>
</form>

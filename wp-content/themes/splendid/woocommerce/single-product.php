<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<!-- Main Container -->
<main id="splendid-main-container" class="container page-layout">

	<?php
	get_template_part('templates/global/page-before-content'); ?>
	<!-- Main Content -->
	<div class="main-content <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
//		do_action( 'woocommerce_sidebar' );
	?>
		
	</div>
	<!-- /End Main Content -->
	<?php get_template_part('templates/global/page-after-content');	?>

</main>
<!-- /Main Container -->

<?php get_footer( 'shop' ); ?>

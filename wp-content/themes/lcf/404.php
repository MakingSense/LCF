<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Splendid
 */

get_header();
$background_image = ts_get_opt_media('404-background');
$logo_404 = ts_get_opt_media('404-logo');
?>

<main id="splendid-main-container" class="layout-404 color-light align-center"<?php echo (!empty($background_image) ? ' style="background-image:url('.esc_url($background_image).');"':''); ?>>
	
	<div class="container">
		
		<?php if(!empty($logo_404)): ?>
		<img src="<?php echo esc_url($logo_404); ?>" alt="404">
		<?php endif; ?>	
		<h1 class="margin_t_40"><?php esc_html_e('404! Oops Page not found', 'splendid'); ?></h1>
		<p><?php esc_html_e('The page you requested could not be found. Try refining your search, or use the navigation above to locate the post', 'splendid'); ?></p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button bg-blue color-white margin_t_30"><?php esc_html_e('Sent me to home', 'splendid'); ?></a>
		
	</div>
	
</main>

<?php get_footer(); ?>

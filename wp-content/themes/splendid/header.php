<?php
/**
 * The header for our theme.
 *
 * Displays all of the head section and everything up till page content
 *
 * @package splendid
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html class="isie ie8 oldie no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9 ]><html class="isie ie9 no-js" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<!-- Meta Tags -->
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- Splendid Content -->
<div id="splendid-content">
	
	<?php splendid_top_special_content(); ?>
	<?php ts_get_header_template_part(); ?>
	<?php ts_get_title_wrapper_template_part(); ?>
	<?php splendid_before_content_special_content(); ?>
		
	
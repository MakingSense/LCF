<?php
/**
 * Side header template
 * 
 * @package splendid
 */

if (strstr(ts_get_opt('header-style'),'color-light')) {
	$logo_field = 'logo-light';
} else {
	$logo_field = 'logo';
}

?>

<!-- HEADER -->
<header id="sideheader" class="header7 style1 <?php echo sanitize_html_classes(ts_get_opt('header-style')); ?>">

	<div class="logo">
		<?php splendid_logo($logo_field, get_template_directory_uri().'/img/logo.png'); ?>
	</div>
	
	
	<div class="navigation">
		<nav id="main-nav" class="<?php echo sanitize_html_classes(ts_get_opt('header-menu-color')); ?> <?php echo sanitize_html_classes(ts_get_opt('header-menu-color-active')); ?>">

			<div id="mobile-menu-button">
				<span></span>
				<span></span>
				<span></span>
			</div>

			<div class="menu">
				<?php 
				$menu = '';
				if( is_singular() ) {
					$menu = ts_get_post_opt('header-primary-menu');
				}

				if (has_nav_menu('primary')):
					wp_nav_menu(array(
						'theme_location'	=> 'primary',
						'menu'				=> $menu,
						'container'			=> false,
						'menu_id'			=> 'primary-nav',
						'menu_class'		=> 'primary-nav',
						'depth'				=> 3,
						'walker'			=> new splendid_menu_widget_walker_nav_menu,
					));
				endif;
				?>
			</div>								
		</nav>
		<?php get_template_part('templates/header/parts/button'); ?>
		<?php get_template_part('templates/header/parts/cart'); ?>
		<?php get_template_part('templates/header/parts/search'); ?>
	</div>

</header>
<!-- /HEADER -->

<header id="header" class="header3 <?php echo ts_get_opt('header-side-preheader-fixed') ? 'header-fixed' : ''; ?>">
	<?php ts_get_preheader_template_part(); ?>
</header>
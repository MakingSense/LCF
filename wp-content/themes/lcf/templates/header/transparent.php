<?php
/**
 * Transparent header template
 * 
 * @package splendid
 */

if (strstr(ts_get_opt('header-style'),'color-light')) {
	$logo_field = 'logo-light';
} else {
	$logo_field = 'logo';
}

$logo_sticky_field = $logo_field;

if (ts_get_opt('header-sticky-style')) {
	if (strstr(ts_get_opt('header-sticky-style'),'color-light')) {
		$logo_sticky_field = 'logo-light';
	} else {
		$logo_sticky_field = 'logo';
	}
}
?>

<!-- HEADER -->
<header id="header" class="header6  header_fixed_enabled">
	<?php ts_get_preheader_template_part(); ?>
	<!-- Main Header -->
	<div id="main-header" class="<?php echo sanitize_html_classes(ts_get_opt('header-style')); ?> <?php echo sanitize_html_classes(ts_get_opt('header-sticky-style')); ?>">
		<div class="container">
			<div class="row">

				<div class="col-lg-3 col-md-3 col-sm-12">
					<div class="logo">
						<?php if ($logo_field != $logo_sticky_field):
							splendid_logo($logo_sticky_field, get_template_directory_uri().'/img/logo.png','sticky-logo');
						endif; ?>
						<?php splendid_logo($logo_field, get_template_directory_uri().'/img/logo.png'); ?>
					</div>
				</div>

				<div class="col-lg-9 col-md-9 col-sm-12">	
					<div class="navigation">
						<nav id="main-nav" class="<?php echo sanitize_html_classes(ts_get_opt('header-menu-color')); ?> <?php echo sanitize_html_classes(ts_get_opt('header-menu-color-active')); ?> <?php echo sanitize_html_classes(ts_get_opt('header-menu-dropdown-color')); ?> <?php echo sanitize_html_classes(ts_get_opt('header-menu-border-color')); ?>">

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
				</div>

			</div>
		</div>
	</div>
	<!-- /Main Header -->
</header>
<!-- /HEADER -->
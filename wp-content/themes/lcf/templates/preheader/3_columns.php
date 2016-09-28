<?php
/**
 * 3_columns preheader template
 * 
 * @package splendid
 */
?>
<!-- Preheader -->
<div id="preheader" class="<?php splendid_preheader_style(); ?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-4 align-left">
				<?php 
				if (has_nav_menu('preheader-contact')):
					wp_nav_menu(array(
						'theme_location'	=> 'preheader-contact',
						'container'			=> false,
						'menu_id'			=> 'preheader-contact-nav',
						'menu_class'		=> 'iconic-list inline-list',
						'depth'				=> 1,
						'walker'			=> new splendid_menu_widget_walker_nav_menu,
					));
				endif; ?>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 align-center">
				<?php 
				if (has_nav_menu('preheader-social')):
					wp_nav_menu(array(
						'theme_location'	=> 'preheader-social',
						'container'			=> false,
						'menu_id'			=> 'preheader-social-nav',
						'menu_class'		=> 'social-icons',
						'depth'				=> 1,
						'walker'			=> new splendid_menu_widget_walker_nav_menu,
					));
				endif; ?>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 align-right">
				<?php 
				if (has_nav_menu('preheader-menu')):
					wp_nav_menu(array(
						'theme_location'	=> 'preheader-menu',
						'container'			=> false,
						'menu_id'			=> 'preheader-menu-nav',
						'menu_class'		=> 'menu',
						'depth'				=> 1,
						'walker'			=> new splendid_menu_widget_walker_nav_menu,
					));
				endif; ?>
			</div>
		</div>
	</div>
</div>
<!-- /Preheader -->
<?php
/**
 * Transparent header template
 * 
 * @package splendid
 */

?>



<!-- HEADER -->
<header id="header" class="header7  header_fixed_enabled">
	<?php ts_get_preheader_template_part(); ?>
	<!-- Main Header -->
	<div id="main-header" class="<?php echo sanitize_html_classes(ts_get_opt('header-style')); ?> <?php echo sanitize_html_classes(ts_get_opt('header-sticky-style')); ?>">
		<div class="container">
			<div class="row">

				<div class="col-lg-2 col-md-1 col-sm-1">
					<div class="logo">
						<?php splendid_logo('logo-light', get_template_directory_uri().'/img/logo-light.png', 'logo-light'); ?>
						<?php splendid_logo('logo', get_template_directory_uri().'/img/logo.png', 'logo-dark'); ?>
					</div>
				</div>

				<div class="col-lg-10 col-md-11 col-sm-11">	
					<div class="navigation">
						<a class="btn btn--primary">Donate</a>
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

								<ul class="list--social">
									<li class="list__icon">
										<a href="">
											<span class="fa fa-facebook-f"></span>
										</a>
									</li>
									<li class="list__icon">
										<a href="">
											<span class="fa fa-twitter"></span>
										</a>
									</li>
								</ul>								
							</div>

							<div class="menu--mobile">
								<div class="actions">
									<a href="" class="btn btn--primary btn--inverse">Donate</a>
									<div id="mobile-menu-close">
										<span class="fa fa-close"></span>
									</div>
								</div>
								<div class="navlist">
									<details>
										<summary>Who we are</summary>
											<ul class="list">
												<li><a href="">Staff</a></li>
												<li><a href="">Board</a></li>
												<li><a href="">Mission and History</a></li>
												<li><a href="">Why Donors Choose LCF</a></li>
												<li><a href="">Press and Media Resources</a></li>
											</ul>
									</details>
									<details>
										<summary>What we do</summary>
										<ul class="list">
											<li></li>
										</ul>
									</details>
									<ul class="list">
										<li>
											<a href="">Why it matters</a>
										</li>	
										<li>
											<a href="">Our impact</a>
										</li>	
									</ul>
									<details>
										<summary>Giving & Investing</summary>
										<ul class="list">
											<li></li>
										</ul>
									</details>
									<ul class="list--social">
										<li class="list__icon">
											<a href=""><span class="fa fa-facebook-f"></span></a>
										</li>
										<li class="list__icon">
											<a href=""><span class="fa fa-twitter"></span></a>
										</li>
									</ul>
									<a href="#" class="btn btn--secondary btn--inverse">Nuestra voz</a>
								</div>
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
<?php
/**
 * The template used for displaying page content in single-portfolio.php
 *
 * @package splendid
 */
?>
<section class="portfolio-single style-extended-alternative">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="portfolio-single-content">
			<div class="portfolio-intro">
				<div class="container">
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<?php if(ts_get_post_opt('portfolio-details')): ?>
								<h2><?php echo esc_html__('The Project Brief', 'splendid'); ?></h2>
								<p><?php echo wp_kses_data(ts_get_post_opt('portfolio-details')); ?></p>
							<?php endif; ?>
							<div class="row">
								<?php if(ts_get_post_opt('portfolio-client')): ?>
								<div class="col-md-4">
									<div class="intro-details">
										<h5><?php echo esc_html__('Client', 'splendid'); ?></h5>
										<p><?php echo esc_html(ts_get_post_opt('portfolio-client')); ?></p>
									</div>
								</div>
								<?php endif; ?>
								<?php if(ts_get_post_opt('portfolio-role')): ?>
								<div class="col-md-4">
									<div class="intro-details">
										<h5><?php echo esc_html__('Role', 'splendid'); ?></h5>
										<?php $roles = explode("\n",ts_get_post_opt('portfolio-role'));
										if (is_array($roles)):
											foreach ($roles as $role):
												$role = trim($role);
												if (!empty($role)):
													echo '<p>'.esc_html($role).'</p>';
												endif;
											endforeach;
										endif;
										?>
									</div>
								</div>
								<?php endif; ?>
								<?php if(ts_get_post_opt('portfolio-date')): ?>
								<div class="col-md-4">
									<div class="intro-details">
										<h5><?php echo esc_html__('Year', 'splendid'); ?></h5>
										<p><?php echo esc_html(ts_get_post_opt('portfolio-date')); ?></p>
									</div>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php the_content(); ?>
		</div><!-- /Portfolio Single Content -->

	</article><!-- #post-## -->
</section>
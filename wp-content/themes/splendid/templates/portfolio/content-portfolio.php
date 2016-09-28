<?php
/**
 * The template used for displaying page content in single-portfolio.php
 *
 * @package splendid
 */
?>

<section class="portfolio-single style-basic">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="portfolio-single-content">

			<?php if (ts_get_opt('portfolio-enable-media')):
				
				$gallery = ts_get_post_opt_slides('portfolio-gallery');

				if (is_array($gallery)): ?>
					<div class="flexslider post-gallery margin_b_40">
						<ul class="slides">
							<?php foreach ($gallery as $item): ?>
								<li>
									<?php if (isset($item['attachment_id'])):
										echo wp_get_attachment_image( $item['attachment_id'], 'ts-big-alt-7', array('alt' => esc_attr($item['title'])) );
									endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php else: 
					//thumbnail image
					if ( has_post_thumbnail() ):
						the_post_thumbnail('ts-big-alt-7');
					endif; ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php the_content(); ?>

		</div><!-- /Portfolio Single Content -->

		<div class="portfolio-single-details">
			
			<?php if (ts_get_post_opt('portfolio-client')): ?>
				<div class="portfolio-detail">
					<h5><?php esc_html_e('Client', 'splendid'); ?></h5>
					<p><?php echo esc_html(ts_get_post_opt('portfolio-client')); ?></p>
				</div>
			<?php endif; ?>
			
			<?php if (ts_get_post_opt('portfolio-details')): ?>
				<div class="portfolio-detail">
					<h5><?php esc_html_e('Project Details', 'splendid'); ?></h5>
					<p><?php echo wp_kses_data(ts_get_post_opt('portfolio-details')); ?></p>
				</div>
			<?php endif; ?>

			<?php if (ts_get_post_opt('portfolio-skills')): ?>
				<div class="portfolio-detail">
					<h5><?php esc_html_e('Skills', 'splendid'); ?></h5>
					<ul>
						<?php $skills = explode("\n",ts_get_post_opt('portfolio-skills'));
						if (is_array($skills)):
							foreach ($skills as $skill):
								$skill = trim($skill);
								if (!empty($skill)):
									echo '<li>'.esc_html($skill).'</li>';
								endif;
							endforeach;
						endif;
						?>
					</ul>
				</div>
			<?php endif; ?>

			<?php if (ts_get_post_opt('portfolio-date')): ?>
				<div class="portfolio-detail">
					<h5><?php esc_html_e('Posted on', 'splendid'); ?></h5>
					<p><?php echo esc_html(ts_get_post_opt('portfolio-date')); ?></p>
				</div>
			<?php endif; ?>

			<?php if (ts_get_post_opt('portfolio-url')): ?>
				<a target="_blank" href="<?php echo esc_url(ts_get_post_opt('portfolio-url')); ?>" class="portfolio-website-button button bg-dark-gray color-white"><?php esc_html_e('View Website', 'splendid'); ?></a>
			<?php endif; ?>

		</div><!-- /Portfolio Single Details -->
	</article><!-- #post-## -->
</section>

<nav class="portfolio-pagination">
	<?php
	previous_post_link( '%link', '<span>%title</span>' );
	next_post_link( '%link', '<span>%title</span>' );
	?>
</nav>
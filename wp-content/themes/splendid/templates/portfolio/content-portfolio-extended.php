<?php
/**
 * The template used for displaying page content in single-portfolio.php
 *
 * @package splendid
 */
?>

<section class="portfolio-single style-extended">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php if (ts_get_opt('portfolio-enable-media')):

			$gallery = ts_get_post_opt_slides('portfolio-gallery');

			if (is_array($gallery)): ?>
				<div class="flexslider post-gallery margin_b_40">
					<ul class="slides">
						<?php foreach ($gallery as $item): ?>
							<li>
								<?php if (isset($item['attachment_id'])):
									echo wp_get_attachment_image( $item['attachment_id'], 'ts-big-alt-h', array('alt' => esc_attr($item['title'])) );
								endif; ?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php else: 
				//thumbnail image
				if ( has_post_thumbnail() ):
					the_post_thumbnail('ts-big-alt-h');
				endif; ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php the_content(); ?>
		
	</article><!-- #post-## -->
</section>
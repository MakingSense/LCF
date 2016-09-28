<?php
/** 
 * The template for displaying splendid post format content
 * 
 * @package splendid
 */

$oArgs = ThemeArguments::getInstance('blog-masonry');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-masonry isotope-item '.$oArgs -> get('column_class')); ?>>
	<div class="blog-post-inner">
		<?php 
		$gallery = ts_get_post_opt_slides('post-gallery');
		
		if (is_array($gallery)): ?>
			<div class="post-featured-image">
				<div class="post-header">
					<div class="flexslider post-gallery">
						<ul class="slides">
							<?php foreach ($gallery as $item): ?>
								<li>
									<?php if (isset($item['attachment_id'])):
										echo wp_get_attachment_image( $item['attachment_id'], 'ts-medium-alt-4', array('alt' => esc_attr($item['title'])) );
									endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		<?php else: ?>
			<?php get_template_part('templates/blog-masonry/parts/part', 'image'); ?>
		<?php endif; ?>
		<section class="post-content">
			<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
			<?php get_template_part('templates/blog-masonry/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->
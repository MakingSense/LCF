<?php
/** 
 * The template for displaying link post format content
 * 
 * @package splendid
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-medium'); ?>>
	<div class="blog-post-inner">
		<section class="post-content">
			<?php if (ts_get_post_opt('post-link-url')): ?>
				<div class="post-header">
					<div class="post-link">
						<span class="link-title"><?php echo esc_html(ts_get_post_opt('post-link-label')); ?></span>
						<a href="<?php echo esc_url(ts_get_post_opt('post-link-url')); ?>" target="_blank"><?php echo esc_url(ts_get_post_opt('post-link-url')); ?></a>
					</div>
				</div>
			<?php endif; ?>
		
			<?php get_template_part('templates/blog-medium/parts/part', 'meta'); ?>
			<?php get_template_part('templates/blog-medium/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->


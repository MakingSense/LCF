<?php
/** 
 * The template for displaying quote post format content
 * 
 * @package splendid
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-medium style-alt'); ?>>
	<div class="blog-post-inner">
		<?php get_template_part('templates/blog-medium-alt/parts/part', 'aside'); ?>
		<section class="post-content">
			<?php if (ts_get_post_opt('post-quote-content')): ?>
				<div class="post-header">
					<blockquote>
						<span class="quote-content"><?php echo esc_html(ts_get_post_opt('post-quote-content')); ?></span>
						<span class="quote-author">- <?php echo esc_html(ts_get_post_opt('post-quote-author')); ?></span>
					</blockquote>
				</div>
			<?php else: ?>
				<?php get_template_part('templates/blog-medium-alt/parts/part', 'meta'); ?>
				<?php get_template_part('templates/blog-medium-alt/parts/part', 'content'); ?>
			<?php endif; ?>
		</section>
	</div>
</article><!-- /Post -->
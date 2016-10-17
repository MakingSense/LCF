<?php
/** 
 * The template for displaying quote post format content
 * 
 * @package splendid
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-standard blog-post-standard-alt'); ?>>
	<div class="blog-post-inner">
		<?php if (ts_get_post_opt('post-quote-content')): ?>
			<div class="post-featured-image">
				<div class="post-header">
					<blockquote>
						<span class="quote-content"><?php echo esc_html(ts_get_post_opt('post-quote-content')); ?></span>
						<span class="quote-author">- <?php echo esc_html(ts_get_post_opt('post-quote-author')); ?></span>
					</blockquote>
				</div>
			</div>
		<?php endif; ?>
		<section class="post-content">
			<?php get_template_part('templates/blog-standard-alt/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->

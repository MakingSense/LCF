<?php
/** 
 * The template for displaying quote post format content
 * 
 * @package splendid
 */

$oArgs = ThemeArguments::getInstance('blog-masonry');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-masonry isotope-item '.$oArgs -> get('column_class')); ?>>
	<div class="blog-post-inner">
		<?php if (ts_get_post_opt('post-quote-content')): ?>
			<div class="post-header">
				<blockquote>
					<span class="quote-content"><?php echo esc_html(ts_get_post_opt('post-quote-content')); ?></span>
					<span class="quote-author">- <?php echo esc_html(ts_get_post_opt('post-quote-author')); ?></span>
				</blockquote>
			</div>
		<?php endif; ?>
		<section class="post-content">
			<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
			<?php get_template_part('templates/blog-masonry/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->
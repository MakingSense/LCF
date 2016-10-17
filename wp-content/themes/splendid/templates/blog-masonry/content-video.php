<?php
/** 
 * The template for displaying video post format content
 * 
 * @package splendid
 */

$oArgs = ThemeArguments::getInstance('blog-masonry');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-masonry isotope-item '.$oArgs -> get('column_class')); ?>>
	<div class="blog-post-inner">
		<?php get_template_part('templates/blog-masonry/parts/part', 'video'); ?>
		<section class="post-content">
			<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
			<?php get_template_part('templates/blog-masonry/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->
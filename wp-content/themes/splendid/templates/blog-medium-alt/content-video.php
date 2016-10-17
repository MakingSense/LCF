<?php
/** 
 * The template for displaying video post format content
 * 
 * @package splendid
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-medium style-alt'); ?>>
	<div class="blog-post-inner">
		<?php get_template_part('templates/blog-medium-alt/parts/part', 'aside'); ?>
		<?php get_template_part('templates/blog-medium-alt/parts/part', 'video'); ?>	
		<section class="post-content">
			<?php get_template_part('templates/blog-medium-alt/parts/part', 'meta'); ?>
			<?php get_template_part('templates/blog-medium-alt/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->
<?php
/** 
 * The template for displaying default post format content
 * 
 * @package splendid
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-standard blog-post-standard-alt'); ?>>
	<div class="blog-post-inner">
		<?php get_template_part('templates/blog-standard-alt/parts/part', 'image'); ?>
		<section class="post-content">
			<?php get_template_part('templates/blog-standard-alt/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->
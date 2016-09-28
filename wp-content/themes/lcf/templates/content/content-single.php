<?php
/**
 * @package Splendid
 */
?>
<!-- Post -->
<div id="post-<?php the_ID(); ?>" <?php post_class('blog-single-wrapper blog-post '.ts_get_opt('post-style')); ?>>

	<?php if(ts_get_opt('post-style') != 'extended-alternative'): ?>
	<div class="post-header">
		<?php get_template_part('templates/content/parts/single-media');?>
		<?php if (ts_get_opt('post-style') != 'modern'): ?>
			<?php splendid_entry_header('show'); ?>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	
	<section class="post-content">
		<?php the_content(); ?>
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'splendid' ),
				'after'  => '</div>',
				'link_before'  => '<span>',
				'link_after'  => '</span>',
			) );
		?>
		
	</section>
	
	<section class="post-tags">
		<?php if (ts_get_opt('post-style') == 'modern'): ?>
			<?php splendid_entry_header('show'); ?>
			<div class="clearfix"></div>
		<?php endif; ?>
		<?php splendid_entry_footer(); ?>
	</section>

	<?php if (ts_get_opt('post-enable-post-share')): ?>
		<section class="post-share">
			<h5><strong><?php esc_html_e('Share this entry', 'splendid'); ?></strong></h5>
			<?php splendid_post_share(); ?>
		</section>
	<?php endif; ?>
	
	<?php if (ts_get_opt('post-style') == 'modern'): ?>
		<?php if (ts_get_opt('post-enable-next-post')): ?>
			<?php splendid_post_next(); ?>
		<?php endif; ?>
		<?php if (ts_get_opt('post-enable-author-description')): ?>
			<?php splendid_entry_modern_author_description(); ?>
		<?php endif; ?>
	<?php elseif (ts_get_opt('post-enable-author-description')): ?>
		<?php splendid_entry_author_description(); ?>
	<?php endif; ?>
	
	<?php if (ts_get_opt('post-enable-similar-posts')): ?>
		<section class="post-related">
			<?php splendid_post_related(); ?>
		</section>
	<?php endif; ?>
		
</div>
<!-- End Post -->
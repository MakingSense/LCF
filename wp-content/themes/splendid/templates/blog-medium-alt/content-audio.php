<?php
/** 
 * The template for displaying default audio format content
 * 
 * @package splendid
 */

wp_enqueue_script( 'audio' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-medium style-alt'); ?>>
	<div class="blog-post-inner">
		<?php get_template_part('templates/blog-medium-alt/parts/part', 'aside'); ?>
		<section class="post-content">
			<?php
			$audio = ts_get_post_opt('post-audio-url');
			if (!empty($audio)): ?>
				<div class="post-header">
					<div class="audio-player-box style1">
						<audio class="sc-audio-player">
							<source src="<?php echo esc_url($audio); ?>">
						</audio>
					</div>
				</div>
			<?php endif; ?>
			
			<?php get_template_part('templates/blog-medium-alt/parts/part', 'meta'); ?>
			<?php get_template_part('templates/blog-medium-alt/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->
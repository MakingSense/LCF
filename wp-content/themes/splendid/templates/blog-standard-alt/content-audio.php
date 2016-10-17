<?php
/** 
 * The template for displaying default audio format content
 * 
 * @package splendid
 */

global $wp_query;

wp_enqueue_script( 'audio' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-standard blog-post-standard-alt'); ?>>
	<div class="blog-post-inner">
		<div class="post-featured-image">
			<div class="post-header">
				<div class="audio-player-box style1">
					<div class="featured-image">
						<?php the_post_thumbnail('ts-big-alt-h'); ?>		
					</div>
					<?php
					$audio = ts_get_post_opt('post-audio-url');
					if (!empty($audio)): ?>
						<audio class="sc-audio-player">
							<source src="<?php echo esc_url($audio); ?>">
						</audio>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<section class="post-content">
			<?php get_template_part('templates/blog-standard-alt/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->

<?php
/** 
 * The template for displaying default audio format content
 * 
 * @package splendid
 */

$oArgs = ThemeArguments::getInstance('blog-masonry');
wp_enqueue_script( 'audio' );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blog-post-masonry isotope-item '.$oArgs -> get('column_class')); ?>>
	<div class="blog-post-inner">
		<div class="post-header">
			<div class="audio-player-box style1">
				<div class="featured-image">
					<?php the_post_thumbnail('ts-big'); ?>		
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
		<section class="post-content">
			<?php get_template_part('templates/blog-masonry/parts/part', 'meta'); ?>
			<?php get_template_part('templates/blog-masonry/parts/part', 'content'); ?>
		</section>
	</div>
</article><!-- /Post -->
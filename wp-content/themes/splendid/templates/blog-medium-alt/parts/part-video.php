<?php
/** 
 * Image part for blog medium alternative
 * 
 * @package splendid
 */
global $wp_query;
if ( has_post_thumbnail() ): ?>

	<div class="post-featured-image">
		<header class="post-header">
			<?php the_post_thumbnail('ts-medium-alt-4');
			$url = ts_get_post_opt('post-video-url');
			if (!empty($url)): ?>
				<a href="<?php echo esc_url($url); ?>" class="video-play-button" data-gal="prettyPhoto"><?php esc_html_e('Play Video', 'splendid'); ?></a>
			<?php endif; ?>		
		</header>
	</div>
<?php endif; ?>
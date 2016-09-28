<?php
/** 
 * Image part for blog masonry
 * 
 * @package splendid
 */

if ( has_post_thumbnail() ): ?>

	<header class="post-header">
		<?php the_post_thumbnail('ts-medium-alt-4'); 
		$url = ts_get_post_opt('post-video-url');
		if (!empty($url)): ?>
			<a href="<?php echo esc_url($url); ?>" class="video-play-button enable-prettyPhoto"><?php esc_html_e('Play Video', 'splendid'); ?></a>
		<?php endif; ?>		
	</header>
	
<?php endif; ?>
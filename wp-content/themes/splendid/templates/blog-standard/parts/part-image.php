<?php
/** 
 * Image part for blog standard
 * 
 * @package splendid
 */

global $wp_query;
if ( has_post_thumbnail() ): ?>
	<div class="post-featured-image">
		<header class="post-header">
			<a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail('ts-big-alt-7'); ?></a>		
		</header>
	</div>
<?php endif; ?>
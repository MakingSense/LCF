<?php
/** 
 * Image part for blog masonry
 * 
 * @package splendid
 */

if ( has_post_thumbnail() ): ?>
	<header class="post-header">
		<a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail('ts-medium-alt-4'); ?></a>
	</header>
<?php endif; ?>
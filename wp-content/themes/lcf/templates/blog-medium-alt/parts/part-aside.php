<?php
/** 
 * Aside part for blog medium alternative
 * 
 * @package splendid
 */
?>
<aside class="post-side">
	<div class="post-date">
		<span class="day"><?php echo get_the_time("j"); ?></span>
		<span><?php echo get_the_time("M, Y"); ?></span>
	</div>
	<div class="post-format">
		<span class="<?php echo get_post_format() ? sanitize_html_class('format-'.get_post_format()) : ''; ?>"></span>
	</div>
	<a href="<?php echo esc_url(get_permalink()); ?>" class="button read-more bg-dark-gray color-white extended small" data-text="<?php echo esc_html__('Read More', 'splendid'); ?>"><span><?php esc_html_e('Read More', 'splendid'); ?></span></a>
</aside>

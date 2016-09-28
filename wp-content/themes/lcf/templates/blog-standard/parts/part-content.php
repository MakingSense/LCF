<?php
/** 
 * Content part for blog standard
 * 
 * @package splendid
 */
?>
<h2 class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
<?php echo wpautop(ts_get_the_excerpt_theme(45)); ?>
<footer class="post-footer">
	<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>" class="button read-more bg-dark-gray color-white small"><?php esc_html_e('Read More', 'splendid');?></a>
</footer>
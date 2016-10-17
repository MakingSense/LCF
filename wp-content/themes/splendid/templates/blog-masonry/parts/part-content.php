<?php
/** 
 * Content part for blog masonry
 * 
 * @package splendid
 */
?>
<h4 class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h4>
<?php echo wpautop(ts_get_the_excerpt_theme(33)); ?>
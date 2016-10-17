<?php
/** 
 * Content part for blog medium alternative
 * 
 * @package splendid
 */
?>
<h2 class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
<?php echo wpautop(ts_get_the_excerpt_theme(15)); ?>
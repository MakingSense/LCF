<?php
/** 
 * Content part for blog standard
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
	<a href="<?php echo esc_url(get_permalink()); ?>" class="button read-more bg-dark-gray color-white extended small" data-text="<?php echo esc_attr__('Read More', 'splendid'); ?>"><span><?php esc_html_e('Read More', 'splendid'); ?></span></a>
</aside>

<div class="post-content-inner">
	
	<ul class="post-meta">
		<li><?php esc_html_e('In', 'splendid');?> <?php echo get_the_category_list( esc_html__( ' / ', 'splendid' ) );?></li>
		<li><?php esc_html_e('By', 'splendid');?>
			<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
			<?php if ($author_url): ?>
				<a href="<?php echo esc_url($author_url); ?>">
			<?php endif; ?>
			<?php echo get_the_author(); ?>
			<?php if ($author_url): ?>
				</a>
			<?php endif; ?>
		</li>
		<li><a href="<?php comments_link(); ?>"><i class="fa fa-comments"></i> <?php comments_number( esc_html__('No comments', 'splendid'), esc_html__('1 Comment','splendid'), esc_html__('% Comments', 'splendid') ); ?></a></li>
	</ul>
	<h2 class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h2>
	<?php echo wpautop(ts_get_the_excerpt_theme(45)); ?>
</div>
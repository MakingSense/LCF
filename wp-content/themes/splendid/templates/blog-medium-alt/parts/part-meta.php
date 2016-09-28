<?php
/** 
 * Meta part for blog medium alternative
 * 
 * @package splendid
 */
?>

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
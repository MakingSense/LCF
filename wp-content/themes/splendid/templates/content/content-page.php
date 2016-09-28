<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package splendid
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_content(); ?>
	<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'splendid' ),
			'after'  => '</div>',
			'link_before'  => '<span>',
			'link_after'  => '</span>',
		) );
	?>
</article><!-- #post-## -->

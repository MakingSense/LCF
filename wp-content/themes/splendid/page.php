<?php
/**
 * The template for displaying all single posts.
 *
 * @package splendid
 */

get_header(); 

$classes = array();
if (ts_get_post_opt('page-shadow-top')) {
	$classes[] = 'shadowed';
}

if (ts_get_post_opt('page-shadow-bottom')) {
	$classes[] = 'shadowed2';
}
?>

<!-- Main Container -->
<main id="splendid-main-container" class="page-layout <?php echo sanitize_html_classes(implode(' ',$classes))?>">
	<div class="container">
		<?php
		get_template_part('templates/global/page-before-content'); ?>
		<!-- Main Content -->
		<div class="main-content <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">

			<?php if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'templates/content/content','page' ); ?>

					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
							comments_template();
						endif;
					?>

				<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'templates/content/content', 'none' ); ?>

			<?php endif; ?>	

		</div>
		<!-- /End Main Content -->
		<?php get_template_part('templates/global/page-after-content');	?>
	</div>
</main>
<!-- /Main Container -->

<?php get_footer(); ?>
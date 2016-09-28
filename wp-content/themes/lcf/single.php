<?php
/**
 * The template for displaying all single posts.
 *
 * @package splendid
 */

get_header(); 

if (ts_get_opt('post-style') == 'modern'): ?>
	<?php splendid_single_post_modern_style(); ?>
<?php else: ?>
	<?php splendid_single_post_style(); ?>
<?php endif; ?>



<!-- Main Container -->
<main id="splendid-main-container" class="blog-container">
	<div class="container">

	<?php
	get_template_part('templates/global/page-before-content'); ?>
	<!-- Main Content -->
	<div class="main-content <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'templates/content/content','single' ); ?>
				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || get_comments_number() ) :
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
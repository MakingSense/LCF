<?php
/**
 * The template for displaying all single posts.
 *
 * @package splendid
 */

get_header();
?>

<!-- Main Container -->
<main id="splendid-main-container" class="page-layout">
	<div class="container">

		<?php if ( have_posts() ) : ?>
			<div class="portfolio-single-wrapper <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php
				if (ts_get_opt('portfolio-template') == 'extended'):
					get_template_part( 'templates/portfolio/content','portfolio-extended' );
				elseif(ts_get_opt('portfolio-template') == 'extended-alternative'):
					get_template_part( 'templates/portfolio/content','portfolio-extended-alt' );
				elseif(ts_get_opt('portfolio-template') == 'extended-alternative-style2'):
					get_template_part( 'templates/portfolio/content','portfolio-extended-alt-two' );
				else:
					get_template_part( 'templates/portfolio/content','portfolio' );
				endif; ?>
			
			<?php endwhile; ?>
			</div>
		<?php else : ?>
			<?php get_template_part( 'templates/content/content', 'none' ); ?>

		<?php endif; ?>
	</div>

</main>
<!-- /Main Container -->

<?php get_footer(); ?>
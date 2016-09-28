<?php
/**
 * Template Name: Blog Masonry
 * 
 * @package splendid
*/
get_header();

if (is_page()) {
	$the_query = splendid_custom_template_query();
	$max_num_pages = $the_query -> max_num_pages;
} else {
	global $wp_query;
	$the_query = $wp_query;
	$max_num_pages = false;
}

$oArgs = ThemeArguments::getInstance('blog-masonry');
if (ts_check_if_sidebar_activated()) {	
	$oArgs -> set('column_class', 'col-lg-6 col-md-6 col-sm-6');
} else {
	$oArgs -> set('column_class', 'col-lg-4 col-md-4 col-sm-6');
}

?>

<!-- Main Container -->
<main id="splendid-main-container" class="isotope-sortable blog-container <?php echo (ts_check_if_sidebar_activated() ? 'container-with-sidebar' : '') ?>">

	<div class="container">
	
		<?php get_template_part('templates/global/page-before-content'); ?>

		<?php if (ts_check_if_sidebar_activated()): ?>
			<!-- Main Content -->
			<div class="main-content">

				<?php splendid_page_content_for_page_templates(false); ?>

				<section id="blog-wrapper" class="row isotope-container isotope-masonry">
					<!-- IMPORTANT - Used as a 1 Column width measure for a Masonry Plugin -->
					<div class="masonry-column col-lg-3 col-md-3 col-sm-3"></div>
		<?php else: ?>

			<?php splendid_page_content_for_page_templates(); ?>

			<section id="blog-wrapper" class="row isotope-container isotope-masonry padding_t_60 padding_b_60">
				<!-- IMPORTANT - Used as a 1 Column width measure for a Masonry Plugin -->
				<div class="masonry-column col-lg-1 col-md-1 col-sm-1"></div>
		<?php endif; ?>
		
		<!-- Blog Wrapper -->
		<?php if ($the_query -> have_posts()) : 
			?>
			<?php /* Start the Loop */
			while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<?php get_template_part('templates/blog-masonry/content',get_post_format()); ?>
			<?php endwhile;
			wp_reset_postdata(); ?>
		<?php else : //No posts were found ?>
			<?php get_template_part('templates/content/content','none'); ?>
		<?php endif; ?>
		<!-- /End Blog Wrapper -->

		<?php if (!ts_check_if_sidebar_activated()): ?>
			</section>	
					
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( is_page() && ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
					comments_template();
				endif;
			?>
					
		<?php else: ?>
				</section>
				
				<?php
				if (ts_get_opt('blog-enable-pagination') == 1):
					splendid_paging_nav($max_num_pages); 
				endif; ?>
				
				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( is_page() && ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
					comments_template();
				endif;
				?>
				
			</div>
			<!-- /End Main Content -->
		<?php endif; ?>
		<?php get_template_part('templates/global/page-after-content'); ?>
			
		<?php
		$next_page_url = ts_next_page_url($max_num_pages);
		
		if (!ts_check_if_sidebar_activated() && (ts_get_opt('blog-enable-pagination') == 1 || !is_page()) && !empty($next_page_url)): ?>
			<!-- Section -->
			<section class="full-width bg-dark-gray align-center padding_t_30 padding_b_30 blog-load-more-container">
				<a href="<?php echo esc_url($next_page_url); ?>" id="blog-load-more" data-loading-text="spinner" class="button small unfilled br-semi-light color-white br-color-white"><?php esc_html_e('Load More', 'splendid');?></a>
			</section>
			<!-- /Section -->
		<?php endif; ?>
	</div>
</main>
<!-- End Main Container -->
<?php
get_footer();
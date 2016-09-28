<?php
/**
 * Template Name: Blog Standard
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
?>
<!-- Main Container -->
<main id="splendid-main-container" class="blog-container <?php echo (ts_check_if_sidebar_activated() ? 'container-with-sidebar' : '') ?>">
	<div class="container">
	
	<?php get_template_part('templates/global/page-before-content'); ?>

	<?php if (!ts_check_if_sidebar_activated()): ?>
		<?php splendid_page_content_for_page_templates(); ?>
	<?php endif; ?>

	<?php if (ts_check_if_sidebar_activated()): ?>
		<!-- Main Content -->
		<div class="main-content <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local')); ?>">
			<?php splendid_page_content_for_page_templates(false); ?>
	<?php endif; ?>
		
	<!-- Blog Wrapper -->
	<div id="blog-wrapper" class="blog-standard-wrapper <?php echo (ts_check_if_sidebar_activated() ? '' : 'blog-standard-fullwidth '.sanitize_html_classes(ts_get_post_opt('page-margin-local')) ) ?>">
		<?php if ($the_query -> have_posts()) : ?>
			<?php /* Start the Loop */
			while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
				<?php get_template_part('templates/blog-standard/content',get_post_format()); ?>
			<?php endwhile;
			wp_reset_postdata(); ?>
		<?php else : //No posts were found ?>
			<?php get_template_part('templates/content/content','none'); ?>
		<?php endif; ?>
	</div>
	<!-- /End Blog Wrapper -->

	<?php
	if (ts_get_opt('blog-enable-pagination') == 1 || !is_page()):
		splendid_paging_nav($max_num_pages); 
	endif;
	
	// If comments are open or we have at least one comment, load up the comment template
	if ( is_page() && ts_get_opt('page-comments-enable') == 1 && (comments_open() || get_comments_number()) ) :
		comments_template();
	endif;
	?>
	
	<?php if (ts_check_if_sidebar_activated()): ?>
		</div>
		<!-- /End Main Content -->
	<?php endif;  ?>
	<?php get_template_part('templates/global/page-after-content'); ?>
</div>
</main>
<!-- End Main Container -->

<?php
get_footer();
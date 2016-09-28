<?php
/**
 * Default title wrapper template
 * 
 * @package splendid
 */
?>

<!-- Page Heading -->
<section class="portfolio-heading page-heading style-default full-width align-center">
	<div class="container">
		<h1><?php echo splendid_get_title(); ?></h1>
		<p class="breadcrumbs">
			<?php echo get_the_term_list( get_the_ID(), 'portfolio-category', '', ' / ', '' ); ?>
		</p>
	</div>
</section>
<!-- /Page Heading -->


<?php
/**
 * Portfolio extended title wrapper template
 * 
 * @package splendid
 */
?>

<!-- Page Heading -->
<section class="portfolio-heading portfolio-extended-heading page-heading style-default full-width">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-8 col-sm-8">
				<h1><?php echo splendid_get_title(); ?></h1>
				<p class="breadcrumbs">
					<?php echo get_the_term_list( get_the_ID(), 'portfolio-category', '', ' / ', '' ); ?>
				</p>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4">
				<nav class="portfolio-pagination style2">
					<?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i>' ); ?>
					<?php if (ts_get_opt('portfolio-page')): ?>
						<a href="<?php echo esc_url(get_permalink(ts_get_opt('portfolio-page'))); ?>" class="portfolio-all"><i class="fa fa-th-large"></i></a>
					<?php endif; ?>
					<?php next_post_link( '%link', '<i class="fa fa-angle-right"></i>' ); ?>
				</nav>
			</div>
		</div>
	</div>
</section>
<!-- /Page Heading -->


	
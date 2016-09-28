<?php
/**
 * Default title wrapper template
 * 
 * @package splendid
 */
?>

<!-- Page Heading -->
<section class="page-heading portfolio-heading portfolio-alternative-heading bg-black style-image style-image-style2 full-width parallax-bg scrollme" data-stellar-background-ratio="0.6" data-stellar-horizontal-offset="50">
	<div class="container">
		<div class="align-center animateme" data-when="exit" data-from="0" data-to="1" data-opacity="0" data-translatey="400" data-easing="linear">
			<?php if(ts_get_opt('title-wrapper-portfolio-subtitle-enable') == 1): ?>
				<?php if (ts_get_opt('portfolio-title-wrapper-subtitle-style') == 'heading'): ?>
					<?php echo get_the_term_list( get_the_ID(), 'portfolio-category', '<h5>', ' / ', '</h5>' ); ?>
				<?php else: ?>
					<?php echo get_the_term_list( get_the_ID(), 'portfolio-category', '<p>', ' / ', '</p>' ); ?>
				<?php endif;
				?>
			<?php endif; ?>
			<h1><?php echo splendid_get_title(); ?></h1>
			<?php if (ts_get_opt('portfolio-title-wrapper-breadcrumbs')): ?>
				<?php splendid_breadcrumbs(); ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- /Page Heading -->


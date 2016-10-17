<?php
/**
 * Portfolio extended title wrapper template
 * 
 * @package splendid
 */

$featured_image_url = ts_get_post_opt_media('portfolio-title-wrapper-image-local');

$featured_image = false;
$data_translatey = 80;
if (ts_get_opt('portfolio-title-wrapper-enable-image') && $featured_image_url) {
	$featured_image = true;
	$data_translatey = 350;
}

?>

<!-- Page Heading -->
<section class="page-heading portfolio-heading style-default bg-black full-width page-heading-alt scrollme <?php echo true === $featured_image ? 'full-height' : ''; ?>">
	<div class="container animateme" data-when="exit" data-easing="linear" data-from="0" data-to="0.7" data-opacity="0" data-translatey="<?php echo esc_attr($data_translatey); ?>">
		<div class="row">
			<div class="col-md-2">
				<?php if (ts_get_opt('portfolio-page')): ?>
					<nav class="portfolio-pagination left style2">
						<a href="<?php echo esc_url(get_permalink(ts_get_opt('portfolio-page'))); ?>" class="portfolio-all"><i class="fa fa-th-large"></i></a>
					</nav>
				<?php endif; ?>
			</div>
			<div class="col-md-8">
				<h1><?php echo splendid_get_title(); ?></h1>
			</div>
			<div class="col-md-2">
				<nav class="portfolio-pagination right style2">
					<?php previous_post_link( '%link', '<i class="fa fa-angle-left"></i>' ); ?>
					<?php if (ts_get_opt('portfolio-page')): ?>
						<a href="<?php echo esc_url(get_permalink(ts_get_opt('portfolio-page'))); ?>" class="portfolio-all"><i class="fa fa-th-large"></i></a>
					<?php endif; ?>
					<?php next_post_link( '%link', '<i class="fa fa-angle-right"></i>' ); ?>
				</nav>
			</div>
		</div>
	</div>
	
	<?php if ($featured_image && $featured_image_url): ?>
		<figure class="featured-image parallax-bg" style="background-image: url(<?php echo esc_url($featured_image_url); ?>);" data-stellar-ratio="0.7" data-stellar-vertical-offset="100" data-stellar-horizontal-offset="0">
			<?php the_post_thumbnail('full'); ?>
		</figure>
		<a href="#" class="move-down"><i class="fa fa-angle-down"></i></a>
	<?php endif; ?>
</section>
<!-- /Page Heading -->


	
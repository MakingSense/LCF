<?php
/**
 * Default title wrapper template
 * 
 * @package splendid
 */
?>

<!-- Page Heading -->
<section class="page-heading bg-black style-image style-image-style2 full-width parallax-bg scrollme" data-stellar-background-ratio="0.6" data-stellar-horizontal-offset="50">
	<div class="container">
		<div class="align-center animateme" data-when="exit" data-from="0" data-to="1" data-opacity="0" data-translatey="400" data-easing="linear">
			<?php $subtitle = splendid_get_subtitle();
			if (!empty($subtitle)):
				if (ts_get_opt('title-wrapper-subtitle-style') == 'heading'):
					echo '<h5>'.wp_kses_data($subtitle).'</h5>';
				else:
					echo '<p>'.wp_kses_post($subtitle).'</p>';
				endif;
			endif; ?>
			<h1><?php echo splendid_get_title(); ?></h1>
			<?php if (ts_get_opt('title-wrapper-breadcrumbs')): ?>
				<?php splendid_breadcrumbs(); ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<!-- /Page Heading -->


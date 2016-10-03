<?php
/**
 * Default title wrapper template
 * 
 * @package splendid
 */
?>

<!-- Page Heading -->
<section class="page-heading style-image <?php echo ts_get_opt('title-wrapper-paddings') == 'medium' ? 'style-medium' : ''; ?> full-width <?php echo (ts_get_opt('title-wrapper-align-center') ? 'align-center' : '' ); ?>">
	<div class="container">
		<div class="title">
			<h1><?php echo splendid_get_title(); ?></h1>
			<?php $subtitle = splendid_get_subtitle();
			if (!empty($subtitle)):
				if (ts_get_opt('title-wrapper-subtitle-style') == 'heading'):
					echo '<h5>'.wp_kses_data($subtitle).'</h5>';
				else:
					echo '<p>'.wp_kses_post($subtitle).'</p>';
				endif;
			endif; ?>
		</div>
		<?php if (ts_get_opt('title-wrapper-breadcrumbs')): ?>
			<?php splendid_breadcrumbs(); ?>
		<?php endif; ?>
		<a href="#" class="btn btn--primary">That's why we exist</a>
	</div>
</section>
<!-- /Page Heading -->


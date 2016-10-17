<?php
/**
 * Default title wrapper template
 * 
 * @package splendid
 */
?>

<!-- Page Heading -->
<section class="page-heading style-default full-width <?php echo (ts_get_opt('title-wrapper-align-center') ? 'align-center' : '' ); ?>">
	<video width="100%" height="100%" autoplay loop>
	  <source src="<?php echo get_bloginfo('template_url'); ?>/video/LCF_Hero_Reel.ogv" type="video/ogv">
	  <source src="<?php echo get_bloginfo('template_url'); ?>/video/LCF_Hero_Reel.webm" type="video/webm">
	  <source src="<?php echo get_bloginfo('template_url'); ?>/video/LCF_Hero_Reel.mp4" type="video/mp4">
	  <!-- Your browser does not support the <code>video</code> element. -->
	</video>
	<div class="container">
		<div class="title">
			<h1><?php echo splendid_get_title(); ?></h1>
			<?php $subtitle = splendid_get_subtitle();
			if (!empty($subtitle)):
				if (ts_get_opt('title-wrapper-subtitle-style') == 'heading'):
					echo '<h5>'.wp_kses_data($subtitle).'</h5>';
				else:
					echo '<p>'.wp_kses_data($subtitle).'</p>';
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


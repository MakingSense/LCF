<?php
/**
 * Logo only header template
 * 
 * @package splendid
 */
$logo_field = 'logo-light';
?>

<header class="blank-landing-header">
	<?php ts_get_preheader_template_part(); ?>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-push-4 align-center">
				<?php splendid_logo($logo_field, get_template_directory_uri().'/img/logo.png'); ?>
			</div>
		</div>
	</div>
</header>
<?php
/**
 * Button
 * 
 * @package splendid
 */
?>

<?php if (ts_get_opt('header-enable-button')): 
	$page = ts_get_opt('header-button-link');
	if ($page): ?>
		<div class="btn-container">
			<a href="<?php echo esc_url(get_permalink($page));?>" target="<?php echo esc_attr(ts_get_opt('header-button-target')); ?>" class="button signup-button unfilled small br-color-white color-white fill-frm-top"><span><?php echo esc_html(ts_get_opt('header-button-text')); ?></span></a>
		</div>
	<?php endif; ?>
<?php endif; ?>


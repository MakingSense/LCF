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
			<a href="#" class="btn btn--secondary">Nuestra voz</a>
      <a href="<?php echo esc_url(get_permalink($page));?>" target="<?php echo esc_attr(ts_get_opt('header-button-target')); ?>" class="btn btn--primary"><span><?php echo esc_html(ts_get_opt('header-button-text')); ?></span></a>
		</div>
	<?php endif; ?>
<?php endif; ?>


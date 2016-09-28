<?php
/**
 * Search icon
 * 
 * @package splendid
 */
?>

<?php if (ts_get_opt('header-enable-search')): ?>
	<div class="header-search-box">
		<a href="#"><i class="sprite-icon <?php echo sanitize_html_classes(ts_get_opt('header-menu-icons-color')); ?> icon-search"></i></a>
		<form action="<?php echo esc_url(home_url('/')); ?>" class="header-search-form bg-cranberry">
			<span class="form-close-btn">
				&times;
			</span>
			<div class="search-form-inner">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<input type="text" name="s" placeholder="<?php esc_attr_e('Type &amp; hit enter', 'splendid'); ?>" value="<?php the_search_query(); ?>">
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
<?php endif; ?>


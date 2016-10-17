<?php
/**
 * Default copyright template
 * 
 * @package splendid
 */
 ?>
<!-- Lower Footer -->
<div id="lower-footer">
	<div class="container">
		<div class="row">

			<div class="col-lg-6 col-md-6 col-sm-6">
				<p class="copyright"><?php echo wp_kses(ts_get_opt('footer-text-content'),ts_get_allowed_tags()); ?></p>
			</div>
			
			<?php if (ts_get_opt('footer-enable-social-icons')): ?>
				<div class="col-lg-6 col-md-6 col-sm-6">
					<ul class="social-icons">
						<?php splendid_social_links('<li>%s</li>',ts_get_opt('footer-social-icons-category')); ?>
					</ul>
				</div>
			<?php endif; ?>
			
		</div>
	</div>
</div>
<!-- /Lower Footer -->
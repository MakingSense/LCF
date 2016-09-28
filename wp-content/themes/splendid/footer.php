<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package splendid
 */

splendid_after_content_special_content();
?>	
	<?php if (ts_get_opt('footer-widgets-enable') || ts_get_opt('footer-enable')): ?>
	
		<!-- FOOTER -->		
		<footer id="footer" class="<?php echo sanitize_html_classes(ts_get_opt('footer-template')); ?> <?php echo sanitize_html_classes(ts_get_opt('footer-copyright-template')); ?>">
			<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>
			<?php if (ts_get_opt('footer-widgets-enable')): ?>

				<!-- Main Footer -->
				<div id="main-footer">
					<div class="container">
						<div class="row">

							<div class="col-lg-3 col-md-3 col-sm-6">
								<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-1', 'footer-sidebar-1') )): ?>
									<?php dynamic_sidebar( ts_get_custom_sidebar('footer-1', 'footer-sidebar-1') ); ?>
								<?php endif; ?>
							</div>

							<div class="col-lg-3 col-md-3 col-sm-6">
								<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-2', 'footer-sidebar-2') )): ?>
									<?php dynamic_sidebar( ts_get_custom_sidebar('footer-2', 'footer-sidebar-2') ); ?>
								<?php endif; ?>
							</div>

							<div class="col-lg-3 col-md-3 col-sm-6">
								<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-3', 'footer-sidebar-3') )): ?>
									<?php dynamic_sidebar( ts_get_custom_sidebar('footer-3', 'footer-sidebar-3') ); ?>
								<?php endif; ?>
							</div>

							<div class="col-lg-3 col-md-3 col-sm-6">
								<?php if (is_active_sidebar( ts_get_custom_sidebar('footer-4', 'footer-sidebar-4') )): ?>
									<?php dynamic_sidebar( ts_get_custom_sidebar('footer-4', 'footer-sidebar-4') ); ?>
								<?php endif; ?>
							</div>

						</div>
					</div>
				</div>
				<!-- /Main Footer -->
			<?php endif; ?>

			<?php ts_get_copyright_template_part(); ?>

		</footer>
		<!-- /FOOTER -->
	<?php endif; ?>
</div>
<!-- /Splendid Content -->
<?php wp_footer(); ?>
</body>
</html>

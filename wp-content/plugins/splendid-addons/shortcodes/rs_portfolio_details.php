<?php

/**
 *
 * RS Portfolio Details
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_portfolio_details($atts, $content = '', $id = '') {

	ob_start();

	?>

	<div class="portfolio-detail">
		<?php if (ts_get_post_opt('portfolio-details')): ?>
			<h5><?php esc_html_e('Details', 'splendid-addons'); ?></h5>
			<p><?php echo wp_kses_data(ts_get_post_opt('portfolio-details')); ?></p>
		<?php endif; ?>

		<?php if (ts_get_post_opt('portfolio-client')): ?>
			<p><strong><?php esc_html_e('Client:', 'splendid-addons'); ?></strong> <?php echo esc_html(ts_get_post_opt('portfolio-client')); ?></p>
		<?php endif; ?>

		<?php if (ts_get_post_opt('portfolio-date')): ?>
			<p><strong><?php esc_html_e('Posted on:', 'splendid-addons'); ?></strong> <?php echo esc_html(ts_get_post_opt('portfolio-date')); ?></p>
		<?php endif; ?>
	</div>

	<?php if (ts_get_post_opt('portfolio-skills')): ?>
		<div class="portfolio-detail">
			<h5><?php esc_html_e('Skills', 'splendid-addons'); ?></h5>
			<ul>
				<?php $skills = explode("\n",ts_get_post_opt('portfolio-skills'));
				if (is_array($skills)):
					foreach ($skills as $skill):
						$skill = trim($skill);
						if (!empty($skill)):
							echo '<li>'.esc_html($skill).'</li>';
						endif;
					endforeach;
				endif;
				?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if (ts_get_post_opt('portfolio-url')): ?>
		<a target="_blank" href="<?php echo esc_url(ts_get_post_opt('portfolio-url')); ?>" class="portfolio-website-button button bg-dark-gray color-white"><?php esc_html_e('View Website', 'splendid-addons'); ?></a>
	<?php endif; ?>

	<?php
	$output = ob_get_clean();
	return $output;
}

add_shortcode('rs_portfolio_details', 'rs_portfolio_details');

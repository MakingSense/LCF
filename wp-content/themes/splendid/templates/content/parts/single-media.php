<?php
/**
 * Media for single post
 * 
 * @package Splendid
 */
global $wp_query;
if (ts_get_opt('post-enable-media')):

	$format = get_post_format();

	switch ($format):
		case 'audio': ?>
			<header class="post-header">
				<div class="audio-player-box style1">
					<div class="featured-image">
						<?php the_post_thumbnail('ts-big-alt-h'); ?>		
					</div>
					<?php
					wp_enqueue_script( 'audio' );
					$audio = ts_get_post_opt('post-audio-url');
					if (!empty($audio)): ?>
						<audio class="sc-audio-player">
							<source src="<?php echo esc_url($audio); ?>">
						</audio>
					<?php endif; ?>
				</div>
			</header>
			<?php break;

		case 'gallery': ?>
			<!-- Gallery -->
			<?php
			$gallery = ts_get_post_opt_slides('post-gallery');
			if(is_array($gallery) && !empty($gallery)): ?>
			<div class="blog-media">
				<header class="post-header">
					<div class="flexslider post-gallery">
						<ul class="slides">
							<?php foreach ($gallery as $item): ?>
								<li>
									<?php if (isset($item['attachment_id'])):
										echo wp_get_attachment_image( $item['attachment_id'], 'ts-big', array('alt' => esc_attr($item['title'])) );
									endif; ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</header>
			</div>
			<?php endif; break;

		case 'video': 
			if(has_post_thumbnail()):
			?>
			<!-- Media -->
				<div class="post-featured-image">
					<header class="post-header">
						<?php the_post_thumbnail('ts-big'); 
						$url = ts_get_post_opt('post-video-url');
						if (!empty($url)): ?>
							<a href="<?php echo esc_url($url); ?>" class="video-play-button" data-gal="prettyPhoto"><?php esc_html_e('Play Video', 'splendid'); ?></a>
						<?php endif; ?>		
					</header>
				</div>
			<?php endif; break;

		case 'quote': 
			if (ts_get_post_opt('post-quote-content')):
			?>
				<header class="post-header">
					<blockquote>
						<span class="quote-content"><?php echo esc_html(ts_get_post_opt('post-quote-content')); ?></span>
						<span class="quote-author">- <?php echo esc_html(ts_get_post_opt('post-quote-author')); ?></span>
					</blockquote>
				</header>
			<?php endif; break;

		case 'link':
			if (ts_get_post_opt('post-link-url')):
			?>
			<header class="post-header">
				<div class="post-link">
					<span class="link-title"><?php echo esc_html(ts_get_post_opt('post-link-label')); ?></span>
					<a href="<?php echo esc_url(ts_get_post_opt('post-link-url')); ?>" target="_blank"><?php echo esc_url(ts_get_post_opt('post-link-url')); ?></a>
				</div>
			</header>
			
			<?php endif; break;

		default: ?>
			<!-- Image -->
			<div class="post-featured-image">
				<header class="post-header">
					<?php the_post_thumbnail('ts-big-alt-7'); ?>		
				</header>
			</div>
			<?php break;
	endswitch;
endif;
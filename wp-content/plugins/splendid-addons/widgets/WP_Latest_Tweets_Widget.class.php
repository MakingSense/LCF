<?php
/**
 * Latest Tweets widget
 * 
 * @package splendid
 */

class splendid_WP_Latest_Tweets_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_latest_tweets_widget', 'description' => esc_html__( "Displays the most latest tweets", 'splendid-addons' ) );
		parent::__construct('latest-tweets', esc_html__( 'Splendid: Latest Tweets', 'splendid-addons' ), $widget_ops);
		
		$this-> alt_option_name = 'widget_latest_tweets';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;
		
		$cache = wp_cache_get('widget_latest_tweets', 'widget');
		
		if ( !is_array($cache) )
		{
			$cache = array();
		}
		if ( ! isset( $args['widget_id'] ) )
		{
			$args['widget_id'] = $this->id;
		}
		
		if ( isset( $cache[ $args['widget_id'] ] ) )
		{
			echo $cache[ $args['widget_id'] ];
			return;
		}
	
		ob_start();
		extract($args);
		echo $before_widget;
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__( 'Latest Tweets', 'splendid-addons' ) : $instance['title'], $instance, $this->id_base);
		
		$consumer_key = ts_get_opt('twitter-consumer-key');
		$consumer_secret = ts_get_opt('twitter-consumer-secret');
		$access_token = ts_get_opt('twitter-access-token');
		$access_token_secret = ts_get_opt('twitter-access-token-secret');
		
		
		if (!empty($instance['username'])):
			
			echo $before_title.esc_html($title).$after_title;
			
			$tweets = ts_get_recent_tweets($instance['username'], $consumer_key, $consumer_secret, $access_token, $access_token_secret);
			
			if ($tweets['is_error'] == 'true'): ?>
				

			<?php elseif (!empty($tweets['tweets'])):
				$tweets['tweets'] = json_decode($tweets['tweets']);

				if (is_array($tweets['tweets']) && count($tweets['tweets']) > 0):
				?>
					<ul>
					<?php
					
					$i = 0;
					foreach ($tweets['tweets'] as $tweet): 
						if ($i >= $instance['number']):
							break;
						endif; ?>
						<li>
							<div class="tweet-icon">
								<i class="fa fa-twitter"></i>
							</div>
							<div class="tweet-content">
								<p><?php echo ts_replace_in_tweets($tweet); ?></p>
								<span class="tweet-date"><?php echo ts_time_elapsed_string($tweet -> created_at);?></span>
							</div>
						</li>
						<?php $i ++; ?>
					<?php endforeach; ?>
					</ul>				
				<?php
				endif;
			endif; 
		endif;
			
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_latest_tweets', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_latest_tweets']) )
		{
			delete_option('widget_latest_tweets');
		}
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_latest_tweets', 'widget');
	}
	
	function form( $instance )
	{
		$title = isset($instance['title']) ? $instance['title'] : '';
		$username = isset($instance['username']) ? $instance['username'] : '';
		$number = isset($instance['number']) ? $instance['number'] : 5;
		
		
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php esc_html_e( 'User name:', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e( 'Number of posts to show:', 'splendid-addons' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
		<?php
	}
}
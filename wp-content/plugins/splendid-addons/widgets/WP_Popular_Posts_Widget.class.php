<?php
/**
 * Popular posts widget
 * 
 * @package splendid
 */

class splendid_WP_Popular_Posts_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_popular_posts_entries', 'description' => esc_html__( "Displays the most popular posts", 'splendid-addons' ) );
		parent::__construct('popular-posts', esc_html__( 'Splendid: Popular Posts', 'splendid-addons' ), $widget_ops);
		
		$this-> alt_option_name = 'widget_popular_posts_entries';
		
		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;
		
		$cache = wp_cache_get('widget_popular_posts_entries', 'widget');
		
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
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_html__( 'Popular Posts', 'splendid-addons' ) : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
		{
			$number = 10;
		}
		
		$qargs = array(
			'orderby' => 'comment_count', 
			'order' => 'DESC', 
			'posts_per_page' => $number, 
			'no_found_rows' => true, 
			'post_status' => 'publish', 
			'ignore_sticky_posts' => true,
			'post_type' => 'post'
		);
		
		$r = new WP_Query( apply_filters( 'widget_posts_args', $qargs ) );
		if ($r->have_posts()) : ?>
			<?php echo $before_title.esc_html($title).$after_title;  ?>
			<?php
			
			switch ($instance['style']):
				case 'text_only': ?>
					<?php  
					while ($r->have_posts()) : $r->the_post(); ?>
						<div class="post-entry">
							<a class="post-title" href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a>
						</div>
					<?php endwhile; ?>
					<?php break;
				
				case 'with_thumbs':
				default: ?>
					<ul>
						<?php  
						while ($r->have_posts()) : $r->the_post(); ?>
							<li>
								<div class="featured-image">
									<?php the_post_thumbnail('ts-small')?>
								</div>
								<div class="post-content">
									<p class="post-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></p>
								</div>
							</li>
						<?php endwhile; ?>
					</ul>
					<?php
					break;
			endswitch;
			
			// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		endif; //have_posts()
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_popular_posts_entries', $cache, 'widget');
	}
	
	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['style'] = strip_tags($new_instance['style']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$this->flush_widget_cache();
		
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_popular_posts_entries']) )
		{
			delete_option('widget_popular_posts_entries');
		}
		return $instance;
	}
	
	function flush_widget_cache()
	{
		wp_cache_delete('widget_popular_posts_entries', 'widget');
	}
	
	function form( $instance )
	{
		$style = isset($instance['style']) ? $instance['style'] : '';
		$title = isset($instance['title']) ? $instance['title'] : '';
		$number = isset($instance['number']) ? $instance['number'] : 5;
		?>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'style' )); ?>"><?php esc_html_e( 'Style:', 'splendid-addons' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>">
			<option value="with_thumbs" <?php selected( 'with_thumbs', $style ); ?>><?php esc_html_e('With Thumbs', 'splendid-addons'); ?></option>
			<option value="text_only" <?php selected( 'text_only', $style ); ?>><?php esc_html_e('Text only', 'splendid-addons'); ?></option>		
		</select>

		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e( 'Number of posts to show:', 'splendid-addons' ); ?></label>
		<input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>
		<?php
	}
}
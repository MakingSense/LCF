<?php
/**
 * Quatro Ads widget
 *
 * @package splendid-addons
 */

class splendid_WP_Quatro_Ads_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_quatro_ads', 'description' => esc_html__( "Displays ", 'splendid-addons' ) );
		parent::__construct('quatro-adds', esc_html__( 'Splendid: Quatro Ads', 'splendid-addons' ), $widget_ops);

		$this-> alt_option_name = 'widget_quatro_ads';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;

		$cache = wp_cache_get('widget_quatro_ads', 'widget');

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

		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);

		if ($title):
			echo $before_title.esc_html($title).$after_title;
		endif;
		
		?>
		<ul class="quatro-ads">
			<?php
			for ($i = 1; $i <= 4; $i++): 
				if (isset($instance['image_'.$i]) && esc_url($instance['image_'.$i])): ?>
					<li><a href="<?php echo esc_url($instance['link_'.$i]); ?>" target="<?php echo esc_url($instance['target_'.$i]); ?>"><img src="<?php echo esc_url($instance['image_'.$i]); ?>" alt=""></a></li>
				<?php endif;
			endfor; ?>
		</ul>
		<?php
		echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_quatro_ads', $cache, 'widget');
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['image'] = strip_tags($new_instance['image']);
		
		for ($i = 1; $i <= 4; $i++) {
			$instance['link_'.$i] = esc_url($new_instance['link_'.$i]);
			$instance['image_'.$i] = esc_url($new_instance['image_'.$i]);
			$instance['target_'.$i] = $new_instance['target_'.$i] == '_blank' ? '_blank' : '_self'; 
		}
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_quatro_ads']) )
		{
			delete_option('widget_quatro_ads');
		}
		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete('widget_quatro_ads', 'widget');
	}

	function form( $instance )
	{
		$title = isset($instance['title']) ? $instance['title'] : '';
		
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<?php 
		for ($i = 1; $i <= 4; $i++): 
			$link = isset($instance['link_'.$i]) ? $instance['link_'.$i] : '';
			$image = isset($instance['image_'.$i]) ? $instance['image_'.$i] : '';
			$target = isset($instance['target_'.$i]) ? $instance['target_'.$i] : ''; ?>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('link_'.$i)); ?>"><?php esc_html_e( 'Link ('.$i.'):', 'splendid-addons' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('link_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('link_'.$i)); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></p>
			
			<p><label for="<?php echo esc_attr($this->get_field_id( 'target_'.$i )); ?>"><?php esc_html_e( 'Target ('.$i.'):', 'splendid-addons' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'target_'.$i )); ?>" name="<?php echo esc_attr($this->get_field_name( 'target_'.$i )); ?>">
				<option value="_self" <?php selected( '_self', $target ); ?>><?php esc_html_e('Same window', 'splendid-addons'); ?></option>
				<option value="_blank" <?php selected( '_blank', $target ); ?>><?php esc_html_e('New window', 'splendid-addons'); ?></option>
			</select>
			
			<p><label for="<?php echo esc_attr($this->get_field_id('image_'.$i)); ?>"><?php esc_html_e( 'Image URL', 'splendid-addons' ); echo '('.$i.'):'; ?></label></p>
			<div class="efa_field efa_field_upload">
			  <!--<div class="efa-uploader">-->
				  <input class="widefat media-attachment" id="<?php echo esc_attr($this->get_field_id('image_'.$i)); ?>" name="<?php echo esc_attr($this->get_field_name('image_'.$i)); ?>" type="text" value="<?php echo esc_attr($image); ?>" />
				  <input class="upload_image_button button button-primary" type="button" value="<?php echo esc_attr(esc_html__('Upload', 'splendid-addons')); ?>" />
				  <!--<a href="#" class="button efa-add-media" data-frame-title="<?php echo esc_attr(esc_html__('Upload', 'splendid-addons')); ?>" data-upload-type="image" data-return="url" data-insert-title="<?php echo esc_attr(esc_html__('Use Image', 'splendid-addons')); ?>"><?php esc_html_e('Upload', 'splendid-addons');?></a>-->
			  <!--</div>-->
			</div><br><br>

		<?php endfor; 
		
		
		$image = isset($instance['image']) ? $instance['image'] : '';
		?>
	<?php 
	}
}

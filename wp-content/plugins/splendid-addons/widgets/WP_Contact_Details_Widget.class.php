<?php
/**
 * Contact Details widget
 *
 * @package splendid-addons
 */

class splendid_WP_Contact_Details_Widget extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array('classname' => 'widget_contact_details', 'description' => esc_html__( "Displays feature box", 'splendid-addons' ) );
		parent::__construct('contact-details', esc_html__( 'Splendid: Contact Details', 'splendid-addons' ), $widget_ops);

		$this-> alt_option_name = 'widget_contact_details';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance)
	{
		global $post;

		$cache = wp_cache_get('widget_contact_details', 'widget');

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
		endif; ?>

		<div class="textwidget">
			<p><?php echo esc_html($instance['subtitle']); ?></p>
			<ul class="iconic-list <?php echo ($instance['style'] == 2 ? 'style2' : '' ); ?>">
				<?php
				for ($i = 1; $i <= 3; $i++):
					if (!isset($instance['icon_'.$i]) || !isset($instance['text_'.$i]) || empty($instance['text_'.$i])):
						continue;
					endif; ?>
					
					<?php
					$icon = '';
					if (!empty($instance['icon_'.$i])):
						$icon_html = '<i class="fa '.sanitize_html_classes($instance['icon_'.$i]).'"></i> ';
					endif; 

					echo '<li>'.$icon_html.' '.$instance['text_'.$i].'</li>';
					?>
				<?php endfor; ?>
			</ul>
		</div>
		<?php echo $after_widget;
		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_contact_details', $cache, 'widget');
	}

	function update( $new_instance, $old_instance )
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['style'] = intval($new_instance['style']);
		$instance['subtitle'] = strip_tags($new_instance['subtitle']);
		$instance['icon_1'] = strip_tags($new_instance['icon_1']);
		$instance['text_1'] = wp_kses_post($new_instance['text_1']);
		$instance['icon_2'] = strip_tags($new_instance['icon_2']);
		$instance['text_2'] = wp_kses_post($new_instance['text_2']);
		$instance['icon_3'] = strip_tags($new_instance['icon_3']);
		$instance['text_3'] = wp_kses_post($new_instance['text_3']);
		
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_contact_details']) )
		{
			delete_option('widget_contact_details');
		}
		return $instance;
	}

	function flush_widget_cache()
	{
		wp_cache_delete('widget_contact_details', 'widget');
	}

	function form( $instance )
	{
		$title = isset($instance['title']) ? $instance['title'] : '';
		$style = isset($instance['style']) ? $instance['style'] : '';
		$subtitle = isset($instance['subtitle']) ? $instance['subtitle'] : '';
		$icon_1 = isset($instance['icon_1']) ? $instance['icon_1'] : '';
		$text_1 = isset($instance['text_1']) ? $instance['text_1'] : '';
		$icon_2 = isset($instance['icon_2']) ? $instance['icon_2'] : '';
		$text_2 = isset($instance['text_2']) ? $instance['text_2'] : '';
		$icon_3 = isset($instance['icon_3']) ? $instance['icon_3'] : '';
		$text_3 = isset($instance['text_3']) ? $instance['text_3'] : '';
		
		$icons = rs_fontawesome_icons();
		
		?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'style' )); ?>"><?php esc_html_e( 'Style:', 'splendid-addons' ); ?></label>
		<select class="widefat" id="<?php echo esc_attr($this->get_field_id( 'style' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'style' )); ?>">
			<option value="1" <?php selected( '1', $style ); ?>>1</option>
			<option value="2" <?php selected( '2', $style ); ?>>2</option>		
		</select>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('subtitle')); ?>"><?php esc_html_e( 'Subtitle', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('subtitle')); ?>" name="<?php echo esc_attr($this->get_field_name('subtitle')); ?>" type="text" value="<?php echo esc_attr($subtitle); ?>" /></p>

		
		<p><label for="<?php echo esc_attr($this->get_field_id( 'icon_1' )); ?>"><?php esc_html_e( 'Icon 1:', 'splendid-addons' ); ?></label>
		<select class="widefat icon-select" id="<?php echo esc_attr($this->get_field_id( 'icon_1' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_1' )); ?>">
			<?php 
			if (is_array($icons)):
				foreach ($icons as $icon_item): ?>
					<option value="<?php echo esc_attr($icon_item); ?>" <?php selected( $icon_item, $icon_1 ); ?>><?php echo esc_attr($icon_item); ?></option>
				<?php endforeach;
			endif; ?>
		</select>

		<p><label for="<?php echo esc_attr($this->get_field_id('text_1')); ?>"><?php esc_html_e( 'Text 1', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text_1')); ?>" name="<?php echo esc_attr($this->get_field_name('text_1')); ?>" type="text" value="<?php echo esc_attr($text_1); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'icon_2' )); ?>"><?php esc_html_e( 'Icon 2:', 'splendid-addons' ); ?></label>
		<select class="widefat icon-select" id="<?php echo esc_attr($this->get_field_id( 'icon_2' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_2' )); ?>">
			<?php 
			if (is_array($icons)):
				foreach ($icons as $icon_item): ?>
					<option value="<?php echo esc_attr($icon_item); ?>" <?php selected( $icon_item, $icon_2 ); ?>><?php echo esc_attr($icon_item); ?></option>
				<?php endforeach;
			endif; ?>
		</select>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('text_2')); ?>"><?php esc_html_e( 'Text 2', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text_2')); ?>" name="<?php echo esc_attr($this->get_field_name('text_2')); ?>" type="text" value="<?php echo esc_attr($text_2); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id( 'icon_3' )); ?>"><?php esc_html_e( 'Icon 3:', 'splendid-addons' ); ?></label>
		<select class="widefat icon-select" id="<?php echo esc_attr($this->get_field_id( 'icon_3' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_3' )); ?>">
			<?php 
			if (is_array($icons)):
				foreach ($icons as $icon_item): ?>
					<option value="<?php echo esc_attr($icon_item); ?>" <?php selected( $icon_item, $icon_3 ); ?>><?php echo esc_attr($icon_item); ?></option>
				<?php endforeach;
			endif; ?>
		</select>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('text_3')); ?>"><?php esc_html_e( 'Text 3', 'splendid-addons' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('text_3')); ?>" name="<?php echo esc_attr($this->get_field_name('text_3')); ?>" type="text" value="<?php echo esc_attr($text_3); ?>" /></p>

		<?php
	}
}

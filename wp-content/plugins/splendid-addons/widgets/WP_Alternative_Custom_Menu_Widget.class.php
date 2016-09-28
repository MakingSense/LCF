<?php
/**
 * WP_Alternative_Custom_Menu_Widget
 *
 * @package splendid-addons
 */

class splendid_WP_Alternative_Custom_Menu_Widget extends WP_Widget {

	function __construct() {
		$widget_ops = array('description' => esc_html__('Add an alternative custom menu to your sidebar.', 'splendid-addons'));
		parent::__construct('nav_menu_alt', esc_html__('Splendid: Alternative Custom Menu', 'splendid-addons'), $widget_ops);
	}

	function widget($args, $instance) {
		// Get menu
		$nav_menu = !empty($instance['nav_menu']) ? wp_get_nav_menu_object($instance['nav_menu']) : false;

		if (!$nav_menu) {
			return;
		}
		
		$instance['title'] = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		echo $args['before_widget'];

		if (!empty($instance['title']))
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu(array('fallback_cb' => '', 'menu' => $nav_menu));

		echo $args['after_widget'];
	}

	function update($new_instance, $old_instance) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}

	function form($instance) {
		$title = isset($instance['title']) ? $instance['title'] : '';
		$nav_menu = isset($instance['nav_menu']) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus(array('orderby' => 'name'));

		// If no menus exists, direct the user to go and create some.
		if (!$menus) {
			echo '<p>' . wp_kses_post(sprintf(__('No menus have been created yet. <a href="%s">Create some</a>.', 'splendid-addons'), admin_url('nav-menus.php')) ). '</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'splendid-addons') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>"><?php esc_html_e('Select Menu:', 'splendid-addons'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>">
				<?php
				foreach ($menus as $menu) {
					echo '<option value="' . esc_attr($menu->term_id) . '"'
					. selected($nav_menu, $menu->term_id, false)
					. '>' . esc_html($menu->name) . '</option>';
				}
				?>
			</select>
		</p>
		<?php
	}

}

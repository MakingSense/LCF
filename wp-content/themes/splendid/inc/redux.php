<?php
/* 
 * Class renders redux metaboxes css when "output" field is defined for posts and other custom post types
 * This css is not rendered by redux for metaboxes or can't figure out how to activate it (redux outputs this css for pages only)
 */
class splendid_render_redux_metaboxes_css {
	
	/**
	 * Construct
	 */
	public function __construct() {
		
	}
	
	/**
	 * Redux doesn't render styles for posts and other custom post types (eg. product)
	 * This function render these styles for post and other CPT
	 * @global object $reduxConfig
	 * @param string $field_to_get
	 * @return boolean/array
	 */
	public function render() {

		$fields_to_css = $this -> metaboxes_fields_to_render_css();

		if (!is_array($fields_to_css)) {
			return false;
		}

		//we need to check shop values if we have shop page (cart, checkout are not included)

		if (class_exists( 'WooCommerce' ) && (is_shop() || is_product_category() || is_product_tag() || is_product() )) {
			$shop_page_id = woocommerce_get_page_id( 'shop' );
		}


		$css = '';

		foreach ($fields_to_css as $field) {

			$value = null;

			//if shop page we have to get 
			if (!empty($shop_page_id) ) {

				//check if function_exisits just in case but it must exisits if $shop_page_id is not empty
				//get value for product
				if (function_exists('is_product') && is_product()) {
					$value = ts_get_post_opt($field['id']);
				}

				//get value for shop page if $value is empty
				if (empty($value)) {
					$value = ts_get_post_opt($field['id'], $shop_page_id);
				}
			} else {
				$value = ts_get_post_opt($field['id']);
			}

			if (empty($value)) {
				continue;
			}

			switch ($field['type']) {
				case 'background':
					$cssStyle = $this -> get_background_css($value);

					if (!empty($cssStyle) && is_array($field['output'])) {				
						foreach ( $field['output'] as $element => $selector ) {
							$css .= $selector . '{' . $cssStyle . '}';
						}
					}
					break;

				case 'color':

					if (is_array($field['output'])) {				
						foreach ( $field['output'] as $element => $selector ) {
							if ( $element === 0 ) {
								$element = 'color';
							}
							$cssStyle = $element . ':' . esc_attr($value) . ';';
							$css .= $selector . '{' . $cssStyle . '}';
						}
					}
					break;
			}
		}
		echo '<style type="text/css" media="screen" id="redux-metaboxes-css">'.$css.'</style>';
	}
	
	/**
	 * Get list of redux metaboxes fields to render css for posts and other custom post types (redux doesn't render css for post and cpt)
	 * @global object $reduxConfig
	 * @param string $field_to_get
	 * @return boolean/array
	 */
	protected function metaboxes_fields_to_render_css() {

		$metaboxes = ts_redux_add_metaboxes(null);

		if (!is_array($metaboxes)) {
			return false;
		}

		$fields_to_css = array();
		foreach ($metaboxes as $item) {

			if (!is_array($item['post_types']) || !in_array(get_post_type(), $item['post_types'])) {
				continue;
			}

			if (!isset($item['sections']) || !is_array($item['sections'])) {
				continue;
			}

			foreach ($item['sections'] as $section) {
				if (!isset($section['fields']) || !is_array($section['fields'])) {
					continue;
				}

				foreach ($section['fields'] as $field) {
					if (!is_array($field) || !isset($field['type']) || !in_array($field['type'], array('color', 'background') )) {
						continue;
					}

					$fields_to_css[] = $field;
				}
			}


		}
		if (count($fields_to_css) > 0) {
			return $fields_to_css;
		}
		return false;
	}


	/**
	 * Get redux background css
	 * @param type $value
	 * @return string
	 */
	function get_background_css( $value = array() ) {

		$css = '';

		if ( ! empty( $value ) && is_array( $value ) ) {
			foreach ( $value as $key => $value ) {
				if ( ! empty( $value ) && $key != "media" ) {
					if ( $key == "background-image" ) {
						$css .= $key . ":url('" . esc_url($value) . "');";
					} else {
						$css .= $key . ":" . esc_attr($value) . ";";
					}
				}
			}
		}

		return $css;
	}
}
<?php
/**
 * Custom functions not related with the theme
 *
 * @package splendid
 */

if ( ! function_exists( "sanitize_html_classes" ) && function_exists( "sanitize_html_class" ) ) {
	/**
	 * Sanitize many classes at once. Useful when we can't use sanitize_html_class on a string with 
	 * many classes separated by spaces.
	 *
	 * @uses   sanitize_html_class
	 * @param  (mixed: string/array) $class   "blue hedgehog goes shopping" or array("blue", "hedgehog", "goes", "shopping")
	 * @param  (mixed) $fallback Anything you want returned in case of a failure
	 * @return (mixed: string / $fallback )
	 */
	function sanitize_html_classes( $class, $fallback = null ) {

		// Explode it, if it's a string
		if ( is_string( $class ) ) {
			$class = explode(" ", $class);
		} 

		if ( is_array( $class ) && count( $class ) > 0 ) {
			$class = array_map("sanitize_html_class", $class);
			return implode(" ", $class);
		}
		else { 
			return sanitize_html_class( $class, $fallback );
		}
	}
}

/**
 * Get theme option value
 * @param string $option
 * @param int $id post_id
 * @return mix|boolean
 */
function ts_get_theme_opt($option, $id = null) {
	
	global $ts_theme_options;
	
	if (isset($ts_theme_options[$option])) {
		return $ts_theme_options[$option];
	}
	return false;
}
/**
 * Get option value, function checks if post value exists and if not returs value from theme options
 * @param string $option
 * @param int $id post_id
 * @return mix|boolean
 */
function ts_get_opt($option, $id = null) {
	global $ts_theme_options;
	
	$local = false;
	
	//get local from main shop page
	if (class_exists( 'WooCommerce' ) && (is_shop() || is_product_category() || is_product_tag() || is_product() )) {
	
		$shop_page = woocommerce_get_page_id( 'shop' );
		
		//if is product we need to get value from product
		if (is_product()) {
			$value = ts_get_post_opt( $option.'-local', $id );
			
			//we need to check if local value is not empty
			$first_element = null;
			if (is_array($value)) {
				$first_element = reset($value);
			}
			if (is_string($value) && (strlen($value) > 0 || !empty($value)) || is_array($value) && !empty($first_element)) {
				$local = true;
			}
		} 
		
		//get shop page value if product is empty and shop_page is defined
		if ($local === false && !empty($shop_page)) {
			$value = ts_get_post_opt( $option.'-local', (int)$shop_page);
			$local = true;
		}
		
	//get local from metaboxes for the post value and override if not empty
	} else if (is_singular()) {
		$value = ts_get_post_opt( $option.'-local', $id );
		$local = true;
	}
	
	//return local value if exists
	if ($local === true) {
		//if $value is an array we need to check if first element is not empty before we return $value
		$first_element = null;
		if (is_array($value)) {
			$first_element = reset($value);
		}
		if (is_string($value) && (strlen($value) > 0 || !empty($value)) || is_array($value) && !empty($first_element)) {
			return $value;
		}
	}
	
	if (isset($ts_theme_options[$option])) {
		return $ts_theme_options[$option];
	}
	return false;
}

/**
 * Get theme option media value
 * @param string $option
 * @param string $field
 * @return mix|boolean
 */
function ts_get_opt_media($option, $field = 'url') {
	
	$media = ts_get_opt($option);
	if (is_array($media) && isset($media[$field]) && !empty($media[$field])) {
		return $media[$field];
	}
	return false;
}

/**
 * Get single post option value
 * @param unknown $option
 * @param string $id post_id
 * @return NULL|mixed
 */
function ts_get_post_opt( $option, $id = null ) {

	global $post;
	
	if (!empty($id)) {
		$local_id = $id;
	} else {
		if(!isset($post->ID)) {
			return null;
		}
		$local_id = get_the_ID();
	}
	
	if(function_exists('redux_post_meta')) {
		$options = redux_post_meta(REDUX_OPT_NAME, $local_id);
	} else {
		$options = get_post_meta( $local_id, REDUX_OPT_NAME, true );
	}

	if( isset( $options[$option] ) ) {
		return $options[$option];
	} else {
		return null;
	}
}

/**
 * Get post option media
 * @param string $option
 * @param string $field
 * @return mix|boolean
 */
function ts_get_post_opt_media($option, $field = 'url', $id = '') {
	
	$media = ts_get_post_opt($option, $id);
	if (is_array($media) && isset($media[$field]) && !empty($media[$field])) {
		return $media[$field];
	}
	return false;
}

/**
 * Get single post option value
 * Required to use with slides type
 * Returns false if no url was found for all slides
 * @param unknown $option
 * @param string $id post_id
 * @return NULL|mixed
 */
function ts_get_post_opt_slides($option, $id = null) {
	
	$value = ts_get_post_opt( $option, $id);
	
	if (is_array($value)) {
		foreach ($value as $item) {
			if (!empty($item['attachment_id'])) {
				return $value;
			}
		}
	}
	return false;
}

/**
 * Get home URL considering different language versions
 * @global type $sitepress
 * @return type
 */
function splendid_get_home_url() {
	
	//Return language home URL when WPML is acitvate
	if( function_exists('icl_get_home_url') ) {
		
		global $sitepress;
		$current_language = $sitepress->get_current_language();

		return $sitepress->language_url( $current_language );
		
	} else {
		return home_url('/');
	}
}

/**
 * Get custom sidebar, returns $default if custom sidebar is not defined
 * @param string $default
 * @param string $sidebar_option_field
 * @return string
 */
function ts_get_custom_sidebar($default = '', $sidebar_option_field = 'sidebar') {
	
	$sidebar = ts_get_opt($sidebar_option_field);
	
	if ($sidebar != 'default' && !empty($sidebar)) {
		return $sidebar;
	}
	return $default;
}

/**
 * Check if sidebar is activated
 * @return boolean
 */
function ts_check_if_sidebar_activated() {
	
	$sidebar = ts_get_opt('main-layout');
	
	if ($sidebar != 'default' && !empty($sidebar)) {
		return true;
	}
	return false;
}

/**
 * Get sidebar class
 * @param string $left
 * @param string $right
 * @param string $dual
 * @return string
 */
function ts_get_sidebar_class($left_class, $right_class, $dual_class = '') {
	
	switch (ts_get_opt('main-layout')) {
		case 'left_sidebar':
			return $left_class;
			break;
		
		case 'right_sidebar':
			return $right_class;
			break;
		
		case 'dual_sidebar':
			return $dual_class;
			break;
	}
	return '';
}

/**
 * Get image size depends on current page layout
 * @param int $post_id
 * @param string $no_sidebar
 * @param string $one_sidebar
 * @param string $dual_sidebar
 * @return string
 */
function ts_get_image_size_by_layout($post_id, $no_sidebar,$one_sidebar ,$dual_sidebar = '') {
	
	switch (ts_get_opt('main-layout',$post_id)) {
		
		case 'left_sidebar':
		case 'right_sidebar':
			return $one_sidebar;
			break;
		
		case 'dual_sidebar':
			if (empty($dual_sideba)) {
				return $one_sidebar;
			}
			return $dual_sidebar;
			break;
	}
	return $no_sidebar;
}

/**
 * Echo excerpt
 *
 * @param string/int integer for custom lenngth for tiny,short/regular/long for defined excerpt
 */
function ts_the_excerpt_theme($length = 55)
{
	ts_Excerpt::length($length);
}

/**
 * get excerpt
 *
 * @param string/int integer for custom lenngth for tiny,short/regular/long for defined excerpt
 * @since framework 1.0
 */
function ts_get_the_excerpt_theme($length = 55)
{
	return ts_Excerpt::get_by_length($length);
}

/**
 * Get video tag
 *
 * @param string $url
 * @param bool $return_url 
 * @return string
 */
function ts_get_embaded_video($url, $return_url = false) {

	if (strstr($url,'vimeo'))
	{
		if (preg_match('/(\d+)/', $url, $matches))
		{
			if ($return_url) {
				return 'http://player.vimeo.com/video/'.$matches[0].'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff';
			}
			return '<iframe src="http://player.vimeo.com/video/'.$matches[0].'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff"></iframe>';
		}
	}
	else if (strstr($url,'youtube'))
	{
		$pattern = "#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#";
		if (preg_match($pattern, $url, $matches))
		{
			if ($return_url) {
				return 'http://www.youtube.com/embed/'.$matches[0];
			}
			return '<iframe src="http://www.youtube.com/embed/'.$matches[0].'"></iframe>';
		}
	}
	return '';
}

/**
 * Adds iframe to a list of allowed tags and returns an array with allowed tags
 * @return array
 */
function ts_add_iframe_to_allowed_tags() {
	$my_allowed = wp_kses_allowed_html( 'post' );
	// iframe
	$my_allowed['iframe'] = array(
		'align' => true,
		'width' => true,
		'height' => true,
		'frameborder' => true,
		'name' => true,
		'src' => true,
		'id' => true,
		'class' => true,
		'style' => true,
		'scrolling' => true,
		'marginwidth' => true,
		'marginheight' => true,
	);
	
	return $my_allowed;
}

/**
 * Get allowed tags
 * 
 * @param string $type
 * @return array
 */
function ts_get_allowed_tags($type = 'basic') {
	
	switch ($type) {
		
		case 'basic':
		default:
			$allowed = array(
				'a' => array(
					'href' => array(),
					'title' => array(),
					'style' => array(),
				),
				'br' => array(
					'style' => array(),
				),
				'em' => array(
					'style' => array(),
				),
				'strong' => array(
					'style' => array(),
				),
			);
	}
}

/**
 * Get shortened string to words limit
 *
 * @param $text string
 * @param $word_limit
 * @return string cut to x words
 */
function ts_get_shortened_string($text,$word_limit)
{
	$words = explode(' ', $text, ($word_limit + 1));
	if(count($words) > $word_limit)
	{
		array_pop($words);
		return implode(' ', $words)."...";
	}
	else
	{
		return implode(' ', $words);
	}
}

/**
 * Get shortened string to words limit
 *
 * @param $text string
 * @param $letters_limit
 * @param $at_space
 * @param $add
 * @return string cut to x words
 */
function ts_get_shortened_string_by_letters($text,$letters_limit, $at_space = true, $add = '...')
{
	if(strlen($text) > $letters_limit)
	{
		if ($at_space) {
			$pos = strpos($text, ' ', $letters_limit);

			if (!$pos) {
				return $text;
			}
			return substr($text, 0, $pos).$add;
		}
		return substr($text, 0, $letters_limit).$add;
	}
	else
	{
		return $text;
	}
}

/**
 * Prevents from creating different image sizes than default thumbnail, medium, large
 * Images are created on demand
 * @global array $_wp_additional_image_sizes
 * @param type $out
 * @param int $id
 * @param string $size
 * @return boolean|array
 */
add_filter('image_downsize', 'ts_media_downsize', 10, 3);
function ts_media_downsize($out, $id, $size) {
	// If image size exists let WP serve it like normally
	$imagedata = wp_get_attachment_metadata($id);

	if (!is_string($size)) {
		return false;
	}

	if (is_array($imagedata) && isset($imagedata['sizes'][$size])) {
		return false;
	}

	// Check that the requested size exists, or abort
	global $_wp_additional_image_sizes;
	if (!isset($_wp_additional_image_sizes[$size])) {
		return false;
	}

	// Make the new thumb
	if (!$resized = image_make_intermediate_size(
			get_attached_file($id), $_wp_additional_image_sizes[$size]['width'], $_wp_additional_image_sizes[$size]['height'], $_wp_additional_image_sizes[$size]['crop']
			))
		return false;

	// Save image meta, or WP can't see that the thumb exists now
	$imagedata['sizes'][$size] = $resized;
	wp_update_attachment_metadata($id, $imagedata);

	// Return the array for displaying the resized image
	$att_url = wp_get_attachment_url($id);
	$att_url_arr = pathinfo($att_url);
	$att_url_dir = '';
	if ($att_url_arr && isset($att_url_arr['dirname'])) {
		$att_url_dir = $att_url_arr['dirname'];
	}
	
	return array($att_url_dir . '/' . $resized['file'], $resized['width'], $resized['height'], true);
}

/**
 * Prevent resize on upload
 * @param array $sizes
 * @return array
 */
function ts_media_prevent_resize_on_upload($sizes) {
	// Removing these defaults might cause problems, so we don't
	return array(
		'thumbnail' => $sizes['thumbnail'],
		'medium' => $sizes['medium'],
		'large' => $sizes['large']
	);
}
add_filter('intermediate_image_sizes_advanced', 'ts_media_prevent_resize_on_upload');

/**
 * Adding inline styles
 * @param string $style
 * @return void
 * 
 * Usage:
 * ts_add_inline_style(".className { color: #FF0000; }")
 */
function ts_add_inline_style( $style ) {
	
	$oArgs = ThemeArguments::getInstance('inline_style');
	$inline_styles = $oArgs -> get('inline_styles');
	if (!is_array($inline_styles)) {
		$inline_styles = array();
	}
	array_push( $inline_styles, $style );
	$oArgs -> set('inline_styles', $inline_styles);
}

/**
 * Showing inline styles html tag in the footer
 */
function ts_enqueue_inline_styles() {
 
	$oArgs = ThemeArguments::getInstance('inline_style');
	$inline_styles = $oArgs -> get('inline_styles');
	if (is_array($inline_styles) && count($inline_styles) > 0) {
		echo '<style id="custom-shortcode-css" type="text/css">'. ts_css_compress( htmlspecialchars_decode( wp_kses_data( join( '', $inline_styles ) ) ) ) .'</style>';
	}
	$oArgs -> reset();
}
add_action( 'wp_footer', 'ts_enqueue_inline_styles' );

/**
 * Inline styles
 * @param type $css
 * @return type
 */
function ts_css_compress($css) {
	$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
	$css = str_replace( ': ', ':', $css );
	$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
	return $css;
}

/**
 * Checking if woocommerce plugin is enabled
 * @return boolean
 */
function splendid_woocommerce_enabled() {
	$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
	if ( is_array($active_plugins) && in_array( 'woocommerce/woocommerce.php', $active_plugins ) ) {
		return true;
	} 
	return false;
}

/**
 * Get associative terms array
 * 
 * @param type $terms
 * @return boolean
 */
function ts_get_terms_assoc($terms) {
	$terms = get_terms( $terms , array('fields' => 'all' ) );
	
	if (is_array($terms) && !is_wp_error($terms)) {
		$terms_assoc = array();
		
		foreach ($terms as $term) {
			$terms_assoc[$term -> term_id] = $term -> name;
		}
		return $terms_assoc;
	}
	return false;
}

/**
 * Get associative special content array
 * 
 * @param type $terms
 * @return boolean
 */
function ts_get_special_content_array() {
	
	
	$args = array(
		'posts_per_page' => -1,
		'offset'          => 0,
		'orderby'         => 'title',
		'order'           => 'ASC',
		'post_type'       => 'special-content',
		'post_status'     => 'publish'
	);
	
	$custom_query = new WP_Query( $args );
	
	$special_content = array();
	
	if ( $custom_query->have_posts() ) {
		
		while ( $custom_query -> have_posts() ) {
			$custom_query -> the_post(); 
			$special_content[get_the_ID()] = get_the_title();
		}
		wp_reset_postdata();
	}
	
	return $special_content;
}

/**
 * Get next page URL
 * @param int $max_num_pages
 * @return string/boolean
 */
function ts_next_page_url($max_num_pages = 0) {

	if ($max_num_pages === false) {
		global $wp_query;
		$max_num_pages = $wp_query -> max_num_pages;
	}
	
	if ($max_num_pages > max( 1, get_query_var('paged') ) ) {
		
		return get_pagenum_link( max( 1, get_query_var('paged') ) + 1 );
	}
	return false;
}

/**
 * Read file using wp_filesystem
 * @global type $wp_filesystem
 * @param type $file_dir
 * @param type $file_name
 * @param string $nonce_url
 * @return string|\WP_Error
 */
function splendid_read_file($file_dir, $file_name, $nonce_url = '') {
	global $wp_filesystem;

	if (empty($nonce_url)) {
		$nonce_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	}

	$url = wp_nonce_url($nonce_url, "ts-filesystem-nonce");

	if (splendid_connect_fs($url, "", $file_dir)) {
		$dir = $wp_filesystem->find_folder($file_dir);
		$file = trailingslashit($dir) . $file_name;

		if ($wp_filesystem->exists($file)) {
			$text = $wp_filesystem->get_contents($file);
			if (!$text) {
				return "";
			} else {
				return $text;
			}
		} else {
			return new WP_Error("filesystem_error", "File doesn't exist");
		}
	} else {
		return new WP_Error("filesystem_error", "Cannot initialize filesystem");
	}
}

/**
 * 
 * @global object $wp_filesystem
 * @param string $file_dir
 * @param string $file_name
 * @param string $text
 * @param string $nonce_url
 * @return string\WP_Error
 */
function splendid_write_file($file_dir, $file_name, $text, $append = true, $nonce_url = '') {
	global $wp_filesystem;

	if (empty($nonce_url)) {
		$nonce_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	}

	$url = wp_nonce_url($nonce_url, "ts-filesystem-nonce");
	
	$form_fields = array("file-data");

	if (splendid_connect_fs($url, "", $file_dir, $form_fields)) {
		$dir = $wp_filesystem->find_folder($file_dir);
		$file = trailingslashit($dir) . $file_name;
		
		if ($append === true) {
			$content = $wp_filesystem-> get_contents($file);
			$text = $content.$text;
		}
		$wp_filesystem->put_contents($file, $text, FS_CHMOD_FILE);
		

		return $text;
	} else {
		return new WP_Error("filesystem_error", "Cannot initialize filesystem");
	}
}

/**
 * Conntect WP_Filesystem
 * @global type $wp_filesystem
 * @param type $url
 * @param type $method
 * @param type $context
 * @param type $fields
 * @return boolean
 */
function splendid_connect_fs($url, $method, $context, $fields = null) {
	global $wp_filesystem;

	require_once(ABSPATH . 'wp-admin/includes/file.php');

	if (false === ($credentials = request_filesystem_credentials($url, $method, false, $context, $fields))) {
		return false;
	}

	//check if credentials are correct or not.
	if (!WP_Filesystem($credentials)) {
		request_filesystem_credentials($url, $method, true, $context);
		return false;
	}

	return true;
}
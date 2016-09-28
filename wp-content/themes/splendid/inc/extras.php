<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package splendid
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function splendid_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	
	if (ts_get_opt('layout-boxed')) {
		$classes[] = 'b_1170';
	}
	
	if (ts_get_opt('header-template') != 'side') {
		switch (ts_get_opt('header-fixed')) {
			case 'sticky':
				$classes[] = 'headersticky';
				break;

			case 'fixed':
				$classes[] = 'headerfixed';
				break;
		}
	}

	switch (ts_get_opt('header-template')) {
		case 'transparent':
			$classes[] = 'headerstyle6';
			break;
		
		case 'side':
			$classes[] = 'headerstyle7';
			break;
	}

	switch (ts_get_opt('footer-template')) {
		case 'style3':
			$classes[] = 'footer-style-alternative';
			break;
		case 'light-color':
		default:
			$classes[] = 'footer-style-default';
			break;
	}

	return $classes;
}
add_filter( 'body_class', 'splendid_body_classes' );

if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat title tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 * @return string The filtered title.
	 */
	function splendid_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'splendid' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'splendid_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function splendid_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}
	add_action( 'wp_head', 'splendid_render_title' );
endif;

if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) || !function_exists('wp_site_icon') ) :
	
	/**
	 * Adds favicon support
	 */
	function splendid_favicon() {
	
		$favicon_16 = ts_get_opt('favicon-16');
		if( is_array($favicon_16) && $favicon_16['url'] != '' ) : ?>
			<link rel="icon" type="image/png" href="<?php echo esc_url($favicon_16['url']); ?>" sizes="16x16">
		<?php endif; ?>
		<?php 
		$favicon_32 = ts_get_opt('favicon-32');
		if( is_array($favicon_32) && $favicon_32['url'] != '' ) : ?>
			<link rel="icon" type="image/png" href="<?php echo esc_url($favicon_32['url']); ?>" sizes="32x32">
		<?php endif; ?>
		<?php 
		$favicon_96 = ts_get_opt('favicon-96'); 
		if( is_array($favicon_96) && $favicon_96['url'] != '' ) : ?>
			<link rel="icon" type="image/png" href="<?php echo esc_url($favicon_96['url']); ?>" sizes="96x96">
		<?php endif; ?>
		<?php 
		$favicon_160 = ts_get_opt('favicon-160');
		if( is_array($favicon_160) && $favicon_160['url'] != '' ) : ?>
			<link rel="icon" type="image/png" href="<?php echo esc_url($favicon_160['url']); ?>" sizes="160x160">
		<?php endif; ?>
		<?php 
		$favicon_192 = ts_get_opt('favicon-192');
		if( is_array($favicon_192) && $favicon_192['url'] != '' ) : ?>
			<link rel="icon" type="image/png" href="<?php echo esc_url($favicon_192['url']); ?>" sizes="192x192">
		<?php endif; ?>
		<?php 
		$favicon_a_57 = ts_get_opt('favicon-a-57');
		if( is_array($favicon_a_57) && $favicon_a_57['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url($favicon_a_57['url']); ?>">
		<?php endif; ?>
		<?php 
		$favicon_a_114 = ts_get_opt('favicon-a-114');
		if( is_array($favicon_a_114) && $favicon_a_114['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($favicon_a_114['url']); ?>">
		<?php endif; ?>
		<?php 
		$favicon_a_72 = ts_get_opt('favicon-a-72');
		if( is_array($favicon_a_72) && $favicon_a_72['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($favicon_a_72['url']); ?>">
		<?php endif; ?>
		<?php 
		$favicon_a_144 = ts_get_opt('favicon-a-144');
		if( is_array($favicon_a_144) && $favicon_a_144['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url($favicon_a_144['url']); ?>">
		<?php endif; ?>
		<?php 
		$favicon_a_60 = ts_get_opt('favicon-a-60');
		if( is_array($favicon_a_60) && $favicon_a_60['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="60x60" href="<?php echo esc_url($favicon_a_60['url']); ?>">
		<?php endif; ?>
		<?php 
		$favicon_a_120 = ts_get_opt('favicon-a-120');
		if( is_array($favicon_a_120) && $favicon_a_120['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="120x120" href="<?php echo esc_url($favicon_a_120['url']); ?>">
		<?php endif; ?>
		<?php 
		$favicon_a_76 = ts_get_opt('favicon-a-76');
		if( is_array($favicon_a_76) && $favicon_a_76['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="76x76" href="<?php echo esc_url($favicon_a_76['url']); ?>">
		<?php endif; ?>
		<?php 
		$favicon_a_152 = ts_get_opt('favicon-a-152');
		if( is_array($favicon_a_152) && $favicon_a_152['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="152x152" href="<?php echo esc_url($favicon_a_152['url']); ?>">
		<?php endif; ?>
		<?php 
		$favicon_a_180 = ts_get_opt('favicon-a-180');
		if( is_array($favicon_a_180) && $favicon_a_180['url'] != '' ) : ?>
			<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url($favicon_a_180['url']); ?>">
		<?php endif; ?>
		<?php if( ts_get_opt('favicon-win-color') != '' ) : ?>
			<meta name="msapplication-TileColor" content="<?php echo esc_url( ts_get_opt('favicon-win-color') ); ?>" />
		<?php endif; ?>
		<?php 
		$favicon_win_70 = ts_get_opt('favicon-win-70');
		if( is_array($favicon_win_70) && $favicon_win_70['url'] != '' ) : ?>
			<meta name="msapplication-square70x70logo" content="<?php echo esc_url($favicon_win_70['url']); ?>" />
		<?php endif; ?>
		<?php 
		$favicon_win_150 = ts_get_opt('favicon-win-150');
		if( is_array($favicon_win_150) && $favicon_win_150['url'] != '' ) : ?>
			<meta name="msapplication-square150x150logo" content="<?php echo esc_url($favicon_win_150['url']); ?>" />
		<?php endif; ?>
		<?php 
		$favicon_win_310 = ts_get_opt('favicon-win-310');
		if( is_array($favicon_win_310) && $favicon_win_310['url'] != '' ) : ?>
			<meta name="msapplication-wide310x150logo" content="<?php echo esc_url($favicon_win_310['url']); ?>" />
		<?php endif; ?>
		<?php 
		$favicon_win_310_quad = ts_get_opt('favicon-win-310-quad');
		if( is_array($favicon_win_310_quad) && $favicon_win_310_quad['url'] != '' ) : ?>
			<meta name="msapplication-square310x310logo" content="<?php echo esc_url($favicon_win_310_quad['url']); ?>" />
		<?php endif; ?>
	<?php
	}
add_action( 'wp_head', 'splendid_favicon', 5 );
endif;

/**
 * Insert Custom CSS Global Code in wp_head
 */
function splendid_global_custom_css() { ?>
	<style type="text/css">
		<?php echo wp_strip_all_tags(ts_get_opt('css_editor')); ?>
	</style>
	<?php
}
add_action('wp_head', 'splendid_global_custom_css', 200);

/**
 * Insert Custom CSS Global Code in wp_head
 */
function splendid_no_fouc() { ?>
	<!-- Preventing FOUC -->
	<style>
	.no-fouc{ display:none; }
	</style>

	<script>
	(function($){
		// Prevent FOUC(flash of unstyled content)
		$('html').addClass('no-fouc');
		$(document).ready(function() {
			$('html').show();
		}); 
	})(jQuery);
	</script>
	<?php
}
add_action('wp_head', 'splendid_no_fouc', 201);

/**
 * Add section to the content if there is no section added
 */
function splendid_add_section($content) {
	
	if (strstr($content,'<div class="row')) {
		return $content;
	} else if (is_singular('page') || is_singular('portfolio')) {
		
		$layout = ts_get_opt('main-layout');
		
		$output = '<section class="section">';
		$output .= '<div class="row">';
		$output .= '<div class="col-md-12">'.$content.'</div>';
		$output .= '</div>';
		$output .= '</section>';
		return $output;
	}
	return $content;
}
add_filter('the_content', 'splendid_add_section', 200);

/**
 * Flush out the transients used in splendid_categorized_blog.
 */
function splendid_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'splendid_categories' );
}
add_action( 'edit_category', 'splendid_category_transient_flusher' );
add_action( 'save_post',     'splendid_category_transient_flusher' );

/**
 * Print splendid preheader style
 */
function splendid_preheader_style() {
	
	$class = array();
	switch (ts_get_opt('preheader-style')) {
		case 'solid':
			$class[] = 'style2';
			break;

		case 'transparent':
			$class[] = 'style3';
			break;
		
		case 'borders':
		default:
			$class[] = 'style1';
	}
	
	if (ts_get_opt('preheader-color-scheme')) {
		$class[] = ts_get_opt('preheader-color-scheme');		
	}
	
	echo implode(' ',$class);
}

/**
 * Add top page custom vc css
 * @return void
 */
function splendid_page_custom_vc_css() {
	
	$pages = array();
	
	//above top page css
	if (ts_get_post_opt('page-show-special-content-above-top')) {
		$pages[] = ts_get_post_opt('page-top-special-content');
	}
	
	//before content page css
	if (ts_get_post_opt('page-show-special-content-before-content')) {
		$pages[] = ts_get_post_opt('page-before-special-content');
	}
	
	//after content page css
	if (ts_get_post_opt('page-show-special-content-after-content')) {
		$pages[] = ts_get_post_opt('page-after-special-content');
	}
	
	if (is_array($pages) && count($pages) > 0) {
		
		foreach ($pages as $page) {
			
			if (empty($page)) {
				continue;
			}
			
			$shortcodes_custom_css = get_post_meta( $page, '_wpb_shortcodes_custom_css', true );
			if ( ! empty( $shortcodes_custom_css ) ) {
				echo '<style type="text/css" data-type="vc_shortcodes-custom-css">'.$shortcodes_custom_css.'</style>';
			}
		}
	}
	
}

add_action('wp_head','splendid_page_custom_vc_css');

/**
 * Maintenance mode support, force maintenance mode page if it's enabled
 * @return type
 */
function splendid_enable_maintenance_mode($query) {
	
	if (!$query->is_main_query() || !ts_get_theme_opt('enable-maintenance-mode')) {
		return;
	}
	
	$page_id = ts_get_theme_opt('maintenance-mode-page');
	if ($page_id) {
		
		$maintenance_mode = true;
		
		//show maintenance mode only to specific time
		if (ts_get_theme_opt('enable-maintenance-mode-till')) {
			$date = ts_get_theme_opt('maintenance-mode-till-date');
			
			$hour = ts_get_theme_opt('maintenance-mode-till-hour');
			$minutes = ts_get_theme_opt('maintenance-mode-till-minutes');
			
			if (!empty($date) && !empty($hour) && !empty($minutes)) {
				$till_time = DateTime::createFromFormat('m/d/Y H:i', $date.' '.$hour.':'.$minutes);
				//don't show maintenance mode if time is in the past
				if (current_time( 'timestamp' ) > $till_time -> getTimestamp()) {
					$maintenance_mode = false;
				}
			}
		}
		
		if ($maintenance_mode === true) {
			
			add_action('wp_before_admin_bar_render', 'splendid_admin_bar_new_item');
			
			if (!is_admin() && !current_user_can( 'manage_options' )) {
			
				$query->set( 'page_id', $page_id);

				$query->is_page     = true;
				$query->is_home     = false;
				$query->is_singular = true;
			}
		}
	}	
}

add_action( 'pre_get_posts', 'splendid_enable_maintenance_mode' );

function splendid_admin_bar_new_item() {
	
global $wp_admin_bar;
$wp_admin_bar->add_menu(array(
	'id' => 'wp-admin-bar-new-item',
	'title' => __('<span style="background:maroon;color:#fff;padding:7px;">' . 'Maintenance Mode</span>'), 'splendid'));
}


/**
 * Maintenance mode support, force maintenance mode page if it's enabled
 * @return type
 */
function splendid_enable_coming_soon_mode($query) {
	
	if (is_admin() || !$query->is_main_query() || !ts_get_theme_opt('enable-coming-soon-mode')) {
		return;
	}
	
	$page_id = ts_get_theme_opt('coming-soon-mode-page');
	if ($page_id) {
		
		add_action('wp_before_admin_bar_render', 'splendid_admin_bar_new_item');
		
		if (!is_admin() && !current_user_can( 'manage_options' )) {
		
			$query->set( 'page_id', $page_id);

			$query->is_page     = true;
			$query->is_home     = false;
			$query->is_singular = true;
		}
	}	
}

add_action( 'pre_get_posts', 'splendid_enable_coming_soon_mode' );

/**
 * Maintenance mode support, force maintenance mode page if it's enabled
 * @return type
 */
function splendid_get_hours() {
	
	$hours = array();
	for ($i = 0; $i <= 24; $i++){
		
		$hour = $i;
		if ($i < 10) {
			$hour = '0'.$i; 
		}
		$hours[(string)$hour] = (string)$hour;
	}
	return $hours;
}

/**
 * Maintenance mode support, force maintenance mode page if it's enabled
 * @return type
 */
function splendid_get_minutes() {
	
	$minutes = array();
	for ($i = 0; $i < 60; $i++){
		
		$min = $i;
		if ($i < 10) {
			$min = '0'.$i; 
		}
		$minutes[(string)$min] = (string)$min;
	}
	return $minutes;
}

function splendid_custom_template_query() {
	
	//adhere to paging rules
	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}

	$posts_per_page = ts_get_post_opt('blog-posts-per-page');
	if (!$posts_per_page) {
		$posts_per_page = get_option('posts_per_page');
	}

	$oArgs = ThemeArguments::getInstance('page-templates/blog-classic');
	$oArgs -> set('main-layout',ts_get_opt('main-layout'));

	global $query_string;
	$args = array(
		'numberposts' => '',
		'posts_per_page' => $posts_per_page,
		'orderby' => 'date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'post',
		'post_mime_type' => '',
		'post_parent' => '',
		'paged' => $paged,
		'post_status' => 'publish'
	);

	$categories = ts_get_post_opt('blog-category');
	if (is_array($categories)) {
		$args['category__in'] =  $categories;
	}

	$exclude_posts = ts_get_post_opt('blog-exclude-posts');
	if (!empty($exclude_posts)) {

		$exclude_posts_arr = explode(',',$exclude_posts);
		if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
			$args['post__not_in'] = array_map('intval',$exclude_posts_arr);
		}
	}

	return new WP_Query($args);
}

function splendid_removeDemoModeLink() { // Be sure to rename this function to something more unique
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	}
	if ( class_exists('ReduxFrameworkPlugin') ) {
		remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
	}
}
add_action('init', 'splendid_removeDemoModeLink');
<?php
/**
 * Splendid functions and definitions
 *
 * @package splendid
 */
/**
 * Theme options variable $ts_theme_options
 */
define ('REDUX_OPT_NAME', 'ts_theme_options');

/**
 * Setting constant to inform the plugin that them is activated
 */
define ('SPLENDID_THEME_ACTIVATED' , true);

/**
 * Theme version used for styles,js
 */
define ('TS_THEME_VERSION','100');

/**
 * Sample data importer
 */
require get_template_directory() . '/extensions/importer/importer.php';

/**
 * Helper functions
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Template parts functions
 */
require get_template_directory() . '/inc/template-parts.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Theme extensions
 */
require get_template_directory() . '/extensions/admin.php';

/**
 * Add Redux Framework & extras
 */
require get_template_directory() . '/admin/admin-init.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'splendid_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function splendid_setup() {

	define ('TINY_EXCERPT', 10);
	define ('SHORT_EXCERPT', 20);
	define ('REGULAR_EXCERPT', 40);
	define ('LONG_EXCERPT', 60);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Splendid, use a find and replace
	 * to change 'splendid' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'splendid', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Custom image sizes
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size('ts-small',  250, 250, true);
	add_image_size('ts-medium-alt-4', 476, 418, true);
	add_image_size('ts-medium-alt-7', 600, 500, true);
	add_image_size('ts-medium-alt-10', 735, 735, true);
	add_image_size('ts-medium-alt-11', 600, 240, true);
	add_image_size('ts-medium-alt-12', 300, 230, true);
	add_image_size('ts-medium-h', 770, 325, true);
	add_image_size('ts-medium-v', 370, 680, true);
	add_image_size('ts-big', 850, 450, true);
	add_image_size('ts-big-alt-3', 1000, 700 , true);
	add_image_size('ts-big-alt-5', 800, 600 , true);
	add_image_size('ts-big-alt-6', 800, 300 , true);
	add_image_size('ts-big-alt-7', 900, 600 , true);
	add_image_size('ts-big-alt-h', 1000, 350 , true);

	add_image_size('ts-big-alt-6', 		800, 636 , true);
	add_image_size('ts-big-v', 	   		400, 636 , true);
	add_image_size('ts-medium-alt-3', 	400, 318 , true);


	add_theme_support( 'title-tag' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'splendid' ),
		'preheader-contact' => esc_html__( 'Pre/Header Contact Menu', 'splendid' ),
		'preheader-social' => esc_html__( 'Pre/Header Social Menu', 'splendid' ),
		'preheader-menu' => esc_html__( 'Pre/Header Menu', 'splendid' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'audio', 'image', 'video', 'gallery', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'splendid_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	//woocommerce support
	add_theme_support( 'woocommerce' );
}
endif; // splendid_setup
add_action( 'after_setup_theme', 'splendid_setup' );

/**
 * Added svg support on media uploader
 * @param type $mimes
 * @return type
 */
function splendid_mime_types( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'splendid_mime_types');

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function splendid_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Main Sidebar', 'splendid' ),
		'id'            => 'main',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="sidebar_widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );

	for ($i = 1; $i <= 4; $i++) {
		register_sidebar( array(
			'name'          => esc_html__( 'Footer Sidebar', 'splendid' ).' '.$i,
			'id'            => 'footer-'.$i,
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="sidebar_widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h6>',
			'after_title'   => '</h6>',
		) );
	}

	//adding custom sidebars defined in theme options
	$custom_sidebars = ts_get_opt('custom-sidebars');
	if (is_array($custom_sidebars)) {
		foreach ($custom_sidebars as $sidebar) {

			if (empty($sidebar)) {
				continue;
			}

			register_sidebar ( array (
                'name' => $sidebar,
                'id' => sanitize_title ( $sidebar ),
                'before_widget' => '<div id="%1$s" class="sidebar_widget widget %2$s">',
                'after_widget' => '</div>',
                'before_title'  => '<h5>',
				'after_title'   => '</h5>',
            ) );
		}
	}

	if (splendid_woocommerce_enabled()) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'splendid' ),
			'id'            => 'shop',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="sidebar_widget widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h5>',
			'after_title'   => '</h5>',
		) );
	}
}
add_action( 'widgets_init', 'splendid_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function splendid_scripts() {

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css',null, TS_THEME_VERSION);
	wp_register_style( 'fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css',null, TS_THEME_VERSION);
	wp_register_style( 'plugins', get_template_directory_uri() . '/css/plugins.css',null, TS_THEME_VERSION);
	wp_register_style( 'mobilenav', get_template_directory_uri() . '/css/mobilenav.css',null, TS_THEME_VERSION,'screen and (max-width: 991px)');
	wp_register_style( 'splendid-style', get_template_directory_uri() . '/css/style.css',null, TS_THEME_VERSION);
	wp_register_style( 'splendid-responsive', get_template_directory_uri() . '/css/responsive.css',null, TS_THEME_VERSION);

	wp_enqueue_style( 'bootstrap');
	wp_enqueue_style( 'fontawesome');
	wp_enqueue_style( 'plugins');
	wp_enqueue_style( 'mobilenav');
	wp_enqueue_style( 'splendid-style');
	wp_enqueue_style( 'splendid-responsive');
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	wp_register_script( 'gmapsensor', '//maps.google.com/maps/api/js?sensor=false&#038;ver=4.0.1',array(),TS_THEME_VERSION,true);
	wp_register_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),TS_THEME_VERSION,true);
	wp_register_script( 'audio', get_template_directory_uri().'/js/audio.min.js',array('jquery'),TS_THEME_VERSION,true);
	wp_register_script( 'plugins', get_template_directory_uri().'/js/plugins.js',array('jquery'),TS_THEME_VERSION,true);
	wp_register_script( 'smoothscroll', get_template_directory_uri().'/js/smoothscroll.min.js',array('jquery'),TS_THEME_VERSION,true);
	wp_register_script( 'scripts', get_template_directory_uri().'/js/scripts.js',array('jquery'),TS_THEME_VERSION,true);

	wp_enqueue_script( 'bootstrap' );
	
	// Localize the script with new data
	$vars_array = array(
		'template_url' => get_template_directory_uri(),
	);
	wp_localize_script( 'scripts', 'wp_vars', $vars_array );
	
	wp_enqueue_script( 'scripts' );
	wp_enqueue_script( 'plugins' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'splendid_scripts' );

$ie_js = create_function( '', 'echo \'<!--[if lt IE 9]><script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script><script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->\';' );

add_action( 'wp_head', $ie_js );

/**
 * Render Redux Styles for post and woocommerce pages including shop, archive, product etc.
 */
function splendid_woocommerce_render_redux_styles() {
	
	if (is_singular('post') || is_singular('portfolio') || (class_exists( 'WooCommerce' ) && (is_shop() || is_product_category() || is_product_tag() || is_product() ) ) ) {
		
		require_once get_template_directory() . '/inc/redux.php';
		$reduxCss = new splendid_render_redux_metaboxes_css();
		$reduxCss -> render();
	}
}

add_action('wp_head', 'splendid_woocommerce_render_redux_styles', 160);

/**
 * Change excerpt 'more'
 * @param type $more
 * @return string
 */
function splendid_change_excerpt( $more ) {
	return '';
}
add_filter('excerpt_more', 'splendid_change_excerpt');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Singleton class supports passing arguments to the templates
 */
require get_template_directory() . '/extensions/class/ThemeArguments.class.php';

/**
 * Excerpt class
 */
require get_template_directory() . '/extensions/class/Excerpt.class.php';

/**
 * Custom menus
 */
require get_template_directory() . '/inc/custom-menus.php';

/**
 * WooCommerce integration
 */
require get_template_directory() . '/inc/woocommerce.php';
<?php
/**
 * Social sites
 */
$labels = array(
		'name'               => esc_html__( 'Social Sites', 'splendid-addons' ),
		'singular_name'      => esc_html__( 'Social Site', 'splendid-addons' ),
		'add_new'            => esc_html__( 'Add New','splendid-addons' ),
		'add_new_item'       => esc_html__( 'Add New Social Site','splendid-addons' ),
		'edit_item'          => esc_html__( 'Edit Social Site','splendid-addons' ),
		'new_item'           => esc_html__( 'New Social Site','splendid-addons' ),
		'all_items'          => esc_html__( 'All Social Sites','splendid-addons' ),
		'view_item'          => esc_html__( 'View Social Site','splendid-addons' ),
		'search_items'       => esc_html__( 'Search Social Sites','splendid-addons' ),
		'not_found'          => esc_html__( 'No Social Sites found','splendid-addons' ),
		'not_found_in_trash' => esc_html__( 'No Social Sites found in the Trash','splendid-addons' ),
		'parent_item_colon'  => '',
		'menu_name'          => esc_html__( 'Social Sites', 'splendid-addons' ),
);

$args = array(
	'labels'        => $labels,
	'public'        => false,
	'show_ui'       => true,
	'menu_position' => 21,
	'supports'      => array( 'title', 'page-attributes' ),
	'has_archive'   => false,
	'rewrite' => array(
		'slug' => 'cpt-social-site'
	)
);
register_post_type( 'social-site', $args );

/**
 * Social sie category
 */

$labels = array(
	'name'              => _x( 'Categories', 'taxonomy general name', 'splendid-addons' ),
	'singular_name'     => _x( 'Category', 'taxonomy singular name', 'splendid-addons' ),
	'search_items'      => esc_html__( 'Search categories', 'splendid-addons' ),
	'all_items'         => esc_html__( 'All Categories', 'splendid-addons' ),
	'parent_item'       => esc_html__( 'Parent Category', 'splendid-addons' ),
	'parent_item_colon' => esc_html__( 'Parent Category:', 'splendid-addons' ),
	'edit_item'         => esc_html__( 'Edit Category', 'splendid-addons' ),
	'update_item'       => esc_html__( 'Update Category', 'splendid-addons' ),
	'add_new_item'      => esc_html__( 'Add New Category', 'splendid-addons' ),
	'new_item_name'     => esc_html__( 'New Category Name', 'splendid-addons' ),
	'menu_name'         => esc_html__( 'Categories' ),
);
$args = array(
	'labels' => $labels,
	'hierarchical' => true,
);
register_taxonomy( 'social-site-category', 'social-site', $args );

/**
 * Social sites - replace "enter title here" with "enter url here" when adding new site
 */
function ts_custom_post_social_sites_change_title( $title ){
	$screen = get_current_screen();

	if  ( 'social-site' == $screen->post_type ) {
		$title = esc_html__('http:// Enter URL here', 'splendid-addons');
	}
	return $title;
}
add_filter( 'enter_title_here', 'ts_custom_post_social_sites_change_title' );

/**
 * Social Site special columns head
 * @param type $defaults
 * @return type
 */
function ts_social_site_columns_head($defaults) {
    $defaults['social_site'] = esc_html__('Social Site', 'splendid-addons');
    $defaults['social_site_categories'] = esc_html__('Categories', 'splendid-addons');
    $defaults['menu_order'] = esc_html__('Order', 'splendid-addons');
    return $defaults;
}
 
/**
 * Social site special columns content
 * @param type $column_name
 * @param type $post_ID
 */
function ts_social_site_columns_content($column_name, $post_ID) {
    
	global $post;
	
	if ($column_name == 'social_site') {
		echo str_replace('fa-', '', get_post_meta( $post_ID, 'icon', true ));
    }
	else if ($column_name == 'menu_order') {
		$order = $post->menu_order;
		echo intval($order);
    }
	else if ($column_name == 'social_site_categories') {
		
		$categories = get_the_terms($post_ID,'social-site-category');
		if (is_array($categories)) {
			$categories_output = array();
			foreach($categories as $key => $category) {
				$edit_link = get_term_link($category,'social-site-category');
				$categories_output[$key] = '<a href="'.esc_url($edit_link).'">' . $category->name . '</a>';
			}
			echo implode(' | ',$categories_output);
		}
    }
}

add_filter( 'manage_edit-social-site_columns', 'ts_social_site_columns_head' ) ;
add_action('manage_social-site_posts_custom_column', 'ts_social_site_columns_content', 10, 2);
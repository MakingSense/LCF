<?php
/**
 * Portfolio custom posty type
 */
$labels = array(
	'name'               => _x( 'Portfolio', 'Items','splendid-addons' ),
	'singular_name'      => _x( 'Portfolio', 'Item','splendid-addons' ),
	'add_new'            => _x( 'Add New', 'Item','splendid-addons' ),
	'add_new_item'       => esc_html__( 'Add New Item','splendid-addons' ),
	'edit_item'          => esc_html__( 'Edit Item','splendid-addons' ),
	'new_item'           => esc_html__( 'New Item','splendid-addons' ),
	'all_items'          => esc_html__( 'All Items','splendid-addons' ),
	'view_item'          => esc_html__( 'View Item','splendid-addons' ),
	'search_items'       => esc_html__( 'Search Items','splendid-addons' ),
	'not_found'          => esc_html__( 'No Items found','splendid-addons' ),
	'not_found_in_trash' => esc_html__( 'No Items found in the Trash','splendid-addons' ),
	'parent_item_colon'  => '',
	'menu_name'          => esc_html__('Portfolio', 'splendid-addons')
);
$args = array(
	'labels'        => $labels,
	'description'   => esc_html__('Holds our products and product specific data', 'splendid-addons'),
	'public'        => true,
	'menu_position' => 21,
	'supports'      => array( 'title', 'thumbnail','editor' ),
	'has_archive'   => true,

);
register_post_type( 'portfolio', $args );

/**
 * Portflio category
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
register_taxonomy( 'portfolio-category', 'portfolio', $args );

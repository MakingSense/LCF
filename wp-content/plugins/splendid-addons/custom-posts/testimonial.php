<?php
/**
 * Testimonial custom posty type
 */

$labels = array(
	'name' => esc_html__( 'Testimonials', 'splendid-addons' ),
	'singular_name' => esc_html__( 'Testimonial', 'splendid-addons' ),
	'add_new' => esc_html__( 'Add New', 'splendid-addons' ),
	'add_new_item' => esc_html__( 'Add New Testimonials', 'splendid-addons' ),
	'edit_item' => esc_html__( 'Edit Testimonials', 'splendid-addons' ),
	'new_item' => esc_html__( 'New Testimonials', 'splendid-addons' ),
	'all_items' => esc_html__( 'All Testimonials', 'splendid-addons' ),
	'view_item' => esc_html__( 'View Testimonials', 'splendid-addons' ),
	'search_items' => esc_html__( 'Search Testimonials', 'splendid-addons' ),
	'not_found' => esc_html__( 'No Testimonials found', 'splendid-addons' ),
	'not_found_in_trash' => esc_html__( 'No Testimonials found in Trash', 'splendid-addons' ),
	'parent_item_colon' => '',
	'menu_name' => esc_html__( 'Testimonials', 'splendid-addons' )
);

 $args = array(
	'labels'        => $labels,
	'public'        => false,
	'show_ui'       => true,
	'menu_position' => 30,
	'supports'      => array( 'title', 'thumbnail', 'editor' ),
	'has_archive'   => true,
	 'rewrite' => array(
		'slug' => 'cpt-testimonial'
	)
);

register_post_type ( 'testimonial', $args);

/**
 * Testimonial category
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
register_taxonomy( 'testimonial-category', 'testimonial', $args );

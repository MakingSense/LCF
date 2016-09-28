<?php
/**
 * Special Content
 */
$labels = array(
		'name'               => esc_html__( 'Special Content', 'splendid-addons' ),
		'singular_name'      => esc_html__( 'Special Content', 'splendid-addons' ),
		'add_new'            => esc_html__( 'Add New','splendid-addons' ),
		'add_new_item'       => esc_html__( 'Add New Item','splendid-addons' ),
		'edit_item'          => esc_html__( 'Edit Item','splendid-addons' ),
		'new_item'           => esc_html__( 'New Item','splendid-addons' ),
		'all_items'          => esc_html__( 'All Items','splendid-addons' ),
		'view_item'          => esc_html__( 'View Item','splendid-addons' ),
		'search_items'       => esc_html__( 'Search Special Content Items','splendid-addons' ),
		'not_found'          => esc_html__( 'No Special Content items found','splendid-addons' ),
		'not_found_in_trash' => esc_html__( 'No Special Content items found in the Trash','splendid-addons' ),
		'parent_item_colon'  => '',
		'menu_name'          => esc_html__( 'Special Content', 'splendid-addons' ),
);

$args = array(
	'labels'        => $labels,
	'public'        => false,
	'show_ui'       => true,
	'menu_position' => 21,
	'supports'      => array( 'title', 'editor' ),
	'has_archive'   => false,
	'rewrite' => array(
		'slug' => 'cpt-special-content'
	)
);
register_post_type( 'special-content', $args );
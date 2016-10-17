<?php
/**
 * Team custom post type
 */
$labels = array(
	'name'               => _x( 'Team', 'Team','splendid-addons' ),
	'singular_name'      => _x( 'Team', 'Team','splendid-addons' ),
	'add_new'            => _x( 'Add New', 'Team','splendid-addons' ),
	'add_new_item'       => esc_html__( 'Add New Team Member','splendid-addons' ),
	'edit_item'          => esc_html__( 'Edit Team Memeber','splendid-addons' ),
	'new_item'           => esc_html__( 'New Team Member','splendid-addons' ),
	'all_items'          => esc_html__( 'All Team Memebers','splendid-addons' ),
	'view_item'          => esc_html__( 'View Team','splendid-addons' ),
	'search_items'       => esc_html__( 'Search Team Member','splendid-addons' ),
	'not_found'          => esc_html__( 'No Member found','splendid-addons' ),
	'not_found_in_trash' => esc_html__( 'No Team Member found in the Trash','splendid-addons' ), 
	'parent_item_colon'  => '',
	'menu_name'          => esc_html__('Team', 'splendid-addons')
);
$args = array(
	'labels'        => $labels,
	'public'        => false,
	'show_ui'       => true,
	'menu_position' => 21,
	'supports'      => array( 'title', 'thumbnail', 'editor' ),
	'has_archive'   => true,
	'rewrite' => array(
		'slug' => 'cpt-team'
	)
	//'menu_icon' =>  get_template_directory_uri() . '/admin/assets/images/pin_green.png',
);
register_post_type( 'team', $args ); 

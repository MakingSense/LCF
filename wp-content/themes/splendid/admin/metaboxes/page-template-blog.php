<?php
/**
 * Page Template Blog
 */

$sections[] = array(
	//'title' => esc_html__(' Settings', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'blog-posts-per-page',
			'type'      => 'text',
			'title'     => esc_html__('Posts per page', 'splendid'),
			'subtitle'  => esc_html__('The number of items to show.', 'splendid'),
			'default'   => '',
		),
		array(
			'id' => 'blog-enable-pagination-local',
			'type' => 'button_set', 
			'title' => esc_html__('Enable pagination', 'splendid'),
			'subtitle' => esc_html__('If on pagination will be enabled.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			
		),
		array(
			'id'        => 'blog-category',
			'type'      => 'select',
			'title'     => esc_html__('Categories', 'splendid'),
			'subtitle'  => esc_html__('Select desired categories', 'splendid'),
			'options'   => ts_get_terms_assoc('category'),
			'multi'     => true,
			'default' => '',
		),
		array(
			'id'        => 'blog-exclude-posts',
			'type'      => 'text',
			'title'     => esc_html__('Excluded blog items', 'splendid'),
			'subtitle'  => esc_html__('Post IDs you want to exclude, separated by commas eg. 120,123,1005', 'splendid'),
			'default'   => '',
		),
		array(
			'id' => 'blog-enable-page-content-local',
			'type' => 'button_set', 
			'title' => esc_html__('Enable page content', 'splendid'),
			'subtitle' => esc_html__('If on page content will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			
		),
	)
);
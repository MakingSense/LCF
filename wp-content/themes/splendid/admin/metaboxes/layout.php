<?php
/*
 * Layout Section
*/

$sections[] = array(
	'title' => esc_html__('Layout Settings', 'splendid'),
	'desc' => esc_html__('Change the main theme\'s layout and configure it.', 'splendid'),
	'icon' => 'el-icon-adjust-alt',
	'fields' => array(
		
		array(
			'id' => 'layout-boxed-local',
			'type' => 'button_set', 
			'title' => esc_html__('Boxed Layout', 'splendid'),
			'subtitle' => esc_html__('If on, page will be boxed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'boxed-background-local',
			'type' => 'background', 
			'url' => true,
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Background, color and other options.', 'splendid'),
			'output' => array(
				'background' => 'body.b_1170'
			),
			'required'  => array('layout-boxed-local', 'equals', 1 ),
		),
		
		array(
			'id'        => 'main-layout-local',
			'type'      => 'select',
			'compiler'  => true,
			'title'     => esc_html__('Main Layout', 'splendid'),
			'subtitle'  => esc_html__('Select main content and sidebar alignment. Choose between 1 or 2 column layout.', 'splendid'),
			'options'   => array(
				'default' => esc_html__('1 Column', 'splendid'),
				'left_sidebar' => esc_html__('2 - Columns Left', 'splendid'),
				'right_sidebar' => esc_html__('2 - Columns Right', 'splendid'),
				'dual_sidebar' => esc_html__('3 - Columns', 'splendid'),
			),
			'default'   => '',
		),
		
		array(
			'id'        => 'sidebar-left-local',
			'type'      => 'select',
			'title'     => esc_html__('Sidebar Left', 'splendid'),
			'subtitle'  => esc_html__('Select custom sidebar', 'splendid'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('main-layout-local', 'equals', array('left_sidebar', 'dual_sidebar')),
		),
		
		array(
			'id'        => 'sidebar-right-local',
			'type'      => 'select',
			'title'     => esc_html__('Sidebar Right', 'splendid'),
			'subtitle'  => esc_html__('Select custom sidebar', 'splendid'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('main-layout-local', 'equals', array('right_sidebar', 'dual_sidebar')),
		),
		
		array(
			'id' => 'main-container-background-local',
			'type' => 'background',
			'title' => esc_html__('Main Content Container Background', 'splendid'),
			'subtitle' => esc_html__('Content background, color and other options.', 'splendid'),
			'output' => array('
				#splendid-content
			'),
		),
		
	),
);
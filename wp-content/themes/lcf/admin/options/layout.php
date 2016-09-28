<?php
/*
 * Layout Section
*/

$this->sections[] = array(
	'title' => esc_html__('Layout Settings', 'splendid'),
	'desc' => esc_html__('Change the main theme\'s layout and configure it.', 'splendid'),
	'icon' => 'el-icon-th-large',
	'fields' => array(
		
		array(
			'id' => 'layout-boxed',
			'type' => 'switch', 
			'title' => esc_html__('Boxed Layout', 'splendid'),
			'subtitle' => esc_html__('If on, page will be boxed.', 'splendid'),
			'default' => 0,
		),
		
		array(
			'id'=>'boxed-background',
			'type' => 'background', 
			'url' => true,
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Background, color and other options.', 'splendid'),
			'output' => array(
				'background' => 'body.b_1170'
			),
			'required'  => array('layout-boxed', 'equals', 1 ),
		),
		
		array(
			'id'        => 'main-layout',
			'type'      => 'image_select',
			'compiler'  => true,
			'title'     => esc_html__('Main Layout', 'splendid'),
			'subtitle'  => esc_html__('Select main content and sidebar alignment. Choose between 1 or 2 column layout.', 'splendid'),
			'options'   => array(
				'default' => array('alt' => esc_html__('1 - Column', 'splendid'),       'img' => ReduxFramework::$_url . 'assets/img/1col.png'),
				'left_sidebar' => array('alt' => esc_html__('2 - Columns Left', 'splendid'),  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
				'right_sidebar' => array('alt' => esc_html__('2 - Columns Right', 'splendid'), 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
				'dual_sidebar' => array('alt' => esc_html__('3 - Columns', 'splendid'), 'img' => ReduxFramework::$_url . 'assets/img/3cm.png'),
			),
			'default'   => 'default',
			'validate' => 'not_empty',
		),
		
		array(
			'id'        => 'sidebar-left',
			'type'      => 'select',
			'title'     => esc_html__('Sidebar Left', 'splendid'),
			'subtitle'  => esc_html__('Select custom sidebar', 'splendid'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('main-layout', 'equals', array('left_sidebar', 'dual_sidebar') ),
		),
		
		array(
			'id'        => 'sidebar-right',
			'type'      => 'select',
			'title'     => esc_html__('Sidebar Right', 'splendid'),
			'subtitle'  => esc_html__('Select custom sidebar', 'splendid'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => '',
			'required'  => array('main-layout', 'equals', array('right_sidebar', 'dual_sidebar') ),
		),
		
		array(
			'id' => 'main-container-background',
			'type' => 'background',
			'title' => esc_html__('Main Content Container Background', 'splendid'),
			'subtitle' => esc_html__('Content background, color and other options.', 'splendid'),
			'output' => array('
				#splendid-content
			'),
		),
	),
);
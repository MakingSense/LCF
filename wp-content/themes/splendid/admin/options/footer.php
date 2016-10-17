<?php
/*
 * Footer Section
*/

$this->sections[] = array(
	'title' => esc_html__('Footer', 'splendid'),
	'desc' => esc_html__('Change the footer section configuration.', 'splendid'),
	'icon' => 'el-icon-cog',
	'fields' => array(
		
			
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => esc_html__('Footer sidebar configuration', 'splendid')
		),

		array(
			'id'=>'footer-template',
			'type' => 'select',
			'title' => esc_html__('Template', 'splendid'),
			'subtitle' => esc_html__('Choose template for footer.', 'splendid'),
			'options' => array(
				'light-color' => esc_html__('Default', 'splendid'),
				'style3' => esc_html__('Alternative', 'splendid'),
			),
			'default'   => 'light-color',
			'validate' => 'not_empty',
		),
			
		array(
			'id'=>'footer-widgets-enable',
			'type' => 'switch',
			'title' => esc_html__('Enable footer sidebar?', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			"default" => 0,
		),
		
		array(
			'id'=>'footer-widgets-background-color',
			'type' => 'color', 
			'title' => esc_html__('Background Color', 'splendid'),
			'subtitle' => esc_html__('Footer widgets area background color.', 'splendid'),
			'output' => array(
				'background-color' => '#main-footer'
			)
		),
		
		array(
			'id'        => 'footer-sidebar-1',
			'type'      => 'select',
			'title'     => esc_html__('Footer Sidebar 1', 'splendid'),
			'subtitle'  => esc_html__('Select custom sidebar', 'splendid'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => 'default',
			'required'  => array('footer-widgets-enable', 'equals', '1'),
			'validate'	=> 'not_empty'
		),
		
		array(
			'id'        => 'footer-sidebar-2',
			'type'      => 'select',
			'title'     => esc_html__('Footer Sidebar 2', 'splendid'),
			'subtitle'  => esc_html__('Select custom sidebar', 'splendid'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => 'default',
			'required'  => array('footer-widgets-enable', 'equals', '1'),
			'validate'	=> 'not_empty'
		),
		
		array(
			'id'        => 'footer-sidebar-3',
			'type'      => 'select',
			'title'     => esc_html__('Footer Sidebar 3', 'splendid'),
			'subtitle'  => esc_html__('Select custom sidebar', 'splendid'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => 'default',
			'required'  => array('footer-widgets-enable', 'equals', '1'),
			'validate'	=> 'not_empty'
		),
		
		array(
			'id'        => 'footer-sidebar-4',
			'type'      => 'select',
			'title'     => esc_html__('Footer Sidebar 4', 'splendid'),
			'subtitle'  => esc_html__('Select custom sidebar', 'splendid'),
			'options'   => ts_get_custom_sidebars_list(),
			'default'   => 'default',
			'required'  => array('footer-widgets-enable', 'equals', '1'),
			'validate'	=> 'not_empty'
		),
		
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => esc_html__('Footer bar configuration', 'splendid')
		),
		
		array(
			'id'=>'footer-enable',
			'type' => 'switch', 
			'title' => esc_html__('Enable footer?', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			"default" => 1,
		),
		
		array(
			'id'=>'footer-background-color',
			'type' => 'color', 
			'title' => esc_html__('Background Color', 'splendid'),
			'subtitle' => esc_html__('Footer background color.', 'splendid'),
			'output' => array(
				'background-color' => '#lower-footer'
			)
		),

		array(
			'id'=>'footer-copyright-template',
			'type' => 'select',
			'title' => esc_html__('Template', 'splendid'),
			'subtitle' => esc_html__('Choose template for copyright.', 'splendid'),
			'options' => array(
				'default' => esc_html__('Default', 'splendid'),
				'alternative' => esc_html__('Alternative', 'splendid'),
			),
			'default'   => 'default',
			'validate' => 'not_empty',
		),
				
		array(
			'id'=>'footer-enable-social-icons',
			'type' => 'switch',
			'title' => esc_html__('Show social icons', 'splendid'),
			'subtitle'=> esc_html__('If on, social icons will be displayed.', 'splendid'),
			"default" => 0,
		),


		array(
			'id' => 'footer-text-content',
			'type' => 'text',
			'title' => esc_html__('Copyright Content', 'splendid'),
			'subtitle' => esc_html__('Place any text to be displayed.', 'splendid'),
			'default' => '',
		),
	), // #fields
);
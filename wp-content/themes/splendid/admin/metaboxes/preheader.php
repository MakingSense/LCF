<?php
/*
 * Header Section
*/

$sections[] = array(
	'title' => esc_html__('Preheader', 'splendid'),
	'desc' => esc_html__('Change the preheader section configuration.', 'splendid'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'preheader-enable-switch-local',
			'type'	 => 'button_set',
			'title' => esc_html__('Enable Header', 'splendid'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'preheader-template-local',
			'type' => 'select',
			'title' => esc_html__('Template', 'splendid'),
			'subtitle' => esc_html__('Choose template for the title wrapper.', 'splendid'),
			'options' => array(
				'2_columns' => esc_html__('2 Columns', 'splendid'),
				'3_columns' => esc_html__('3 Columns', 'splendid'),
			),
			'default'   => '',
		),
			
		array(
 			'id'=>'preheader-style-local',
 			'type' => 'select',
 			'title' => esc_html__('Style', 'splendid'),
 			'subtitle'=> esc_html__('Select preheader style.', 'splendid'),
 			'options' => array(
				'borders' => esc_html__('Borders','splendid'),
				'solid' => esc_html__('Solid','splendid'),
				'transparent' => esc_html__('Transparent','splendid'),	
			),
			'default' => '',
 		),
		
		array(
			'id'=>'preheader-color-scheme-local',
			'type' => 'select',
			'title' => esc_html__('Color Scheme', 'splendid'),
			'subtitle' => esc_html__('Choose color scheme for preheader. Use "Borders" style above if you want to use color scheme with borders', 'splendid'),
			'options' => array(
				'bg-white color-dark' => esc_html__('White', 'splendid'),
				'bg-white color-dark br-color-turquoise' => esc_html__('White + Turquoise Border', 'splendid'),
				'bg-white color-dark br-color-blue' => esc_html__('White + Blue Border', 'splendid'),
				'bg-blue color-light' => esc_html__('Blue', 'splendid'),
				'bg-black color-light' => esc_html__('Black', 'splendid'),
				'bg-turquoise color-light' => esc_html__('Turquoise', 'splendid'),
			),
			'default'   => '',
		),	
	),
);
<?php
/*
 * Header Section
*/

$this->sections[] = array(
	'title' => esc_html__('Preheader', 'splendid'),
	'desc' => esc_html__('Change the preheader section configuration.', 'splendid'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'preheader-enable-switch',
			'type' => 'switch', 
			'title' => esc_html__('Enable Header', 'splendid'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'default' => 0,
		),
		
		array(
			'id'=>'preheader-template',
			'type' => 'select',
			'title' => esc_html__('Template', 'splendid'),
			'subtitle' => esc_html__('Choose template for preheader.', 'splendid'),
			'options' => array(
				'2_columns' => esc_html__('2 Columns', 'splendid'),
				'3_columns' => esc_html__('3 Columns', 'splendid'),
			),
			'default'   => '2_columns',
			'validate' => 'not_empty',
		),
		
 		array(
 			'id'=>'preheader-style',
 			'type' => 'select',
 			'title' => esc_html__('Style', 'splendid'),
 			'subtitle'=> esc_html__('Select preheader style.', 'splendid'),
 			'options' => array(
				'borders' => esc_html__('Borders','splendid'),
				'solid' => esc_html__('Solid','splendid'),
				'transparent' => esc_html__('Transparent','splendid'),
			),
			'default' => 'borders',
			'validate' => 'not_empty',
 		),
		
		array(
			'id'=>'preheader-color-scheme',
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
			'default'   => 'bg-white color-dark',
			'validate' => 'not_empty',
		),	
	),
);
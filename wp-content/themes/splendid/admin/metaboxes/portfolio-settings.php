<?php
/*
 * Portfolio settings
*/

$sections[] = array(
	'icon' => 'el-icon-adjust-alt',
	'title' => esc_html__('General settings', 'splendid'),
	'fields' => array(
		array(
			'id'=>'portfolio-template-local',
			'type' => 'select',
			'title' => esc_html__('Template', 'splendid'),
			'subtitle' => esc_html__('Select portfolio template.', 'splendid'),
			'options' => array(
				'standard'                    => esc_html__('Standard', 'splendid'),
				'extended'                    => esc_html__('Extended', 'splendid'),
				'extended-alternative'        => esc_html__('Extended Alternative', 'splendid'),
				'extended-alternative-style2' => esc_html__('Extended Alternative Two', 'splendid'),
			),
			'default' => '',
		),
		
		array(
			'id'=>'portfolio-enable-media-local',
			'type' => 'button_set',
			'title' => esc_html__('Enable media section', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

		array(
			'id'=>'portfolio-overlay-local',
			'type' => 'select',
			'title' => esc_html__('Overlay', 'splendid'),
			'subtitle' => esc_html__('Select portfolio overlay color.', 'splendid'),
			'options' => array(
				'bg-dark-gray'      => esc_html__('Dark Gray', 'splendid'),
				'bg-cranberry'      => esc_html__('Cranberry', 'splendid'),
				'bg-light-blue'     => esc_html__('Light Blue', 'splendid'),
				'bg-dark-green'     => esc_html__('Dark Green', 'splendid'),
				'bg-red'            => esc_html__('Red', 'splendid'),
				'bg-purple'         => esc_html__('Purple', 'splendid'),
				'bg-bittersweet'    => esc_html__('Bittersweet', 'splendid'),
				'bg-turquoise-blue' => esc_html__('Turquoise Blue', 'splendid'),
				'bg-green'          => esc_html__('Green', 'splendid'),
				'bg-orange'         => esc_html__('Orange', 'splendid'),
				'bg-pink'           => esc_html__('Pink', 'splendid'),
				'bg-dark-orange'    => esc_html__('Dark Orange', 'splendid'),
				'bg-turquoise'      => esc_html__('Turquoise', 'splendid'),
				'bg-gray'           => esc_html__('Gray', 'splendid'),
				'bg-mulberry'       => esc_html__('Mulberry', 'splendid'),
				'bg-silver'         => esc_html__('Silver', 'splendid'),
				'bg-light-gray'     => esc_html__('Light Gray', 'splendid'),
				'bg-black'          => esc_html__('Black', 'splendid'),
				'bg-white'          => esc_html__('White', 'splendid'),
				'bg-salmon'         => esc_html__('Salmon', 'splendid'),
				'bg-pictonblue'     => esc_html__('Picton Blue', 'splendid'),
			),
			'default' => '',
		),
		
		
	), // #fields
);
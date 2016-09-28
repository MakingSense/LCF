<?php
/*
 * Title Wrapper Section
*/

$sections[] = array(
	'title' => esc_html__('Title Wrapper', 'splendid'),
	'desc' => esc_html__('Change the title wrapper section configuration.', 'splendid'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'title-wrapper-enable-local',
			'type'	 => 'button_set',
			'title' => esc_html__('Enable Title Wrapper', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id' => 'title-wrapper-template-local',
			'type' => 'select',
			'title' => esc_html__('Template', 'splendid'),
			'subtitle' => esc_html__('Choose template for the title wrapper.', 'splendid'),
			'options' => array(
				'default' => esc_html__('Default', 'splendid'),
				'bigger' => esc_html__('Bigger', 'splendid'),
				'alternative' => esc_html__('Alternative', 'splendid'),
			),
			'default'   => '',
			'validate' => '',
		),
		
		array(
			'id'=>'title-wrapper-paddings-local',
			'type' => 'select',
			'title' => esc_html__('Paddings', 'splendid'),
			'subtitle' => esc_html__('Choose title padddings.', 'splendid'),
			'options' => array(
				'large' => esc_html__('Large', 'splendid'),
				'medium' => esc_html__('Medium', 'splendid'),
			),
			'default'   => '',
			'required' => array('title-wrapper-template-local' ,'=', 'bigger')
		),
		
		array(
			'id'=>'title-wrapper-background-local',
			'type' => 'background', 
			'force_output' => true,
			'compiler' => true,
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Title wrapper background, color and other options.', 'splendid'),
			'output' => array(
				'background' => '.page-heading, .page-heading.style-image'
			)
		),

		array(
			'id'=>'title-wrapper-align-center-local',
			'type' => 'button_set', 
			'title' => esc_html__('Align Center', 'splendid'),
			'subtitle'=> esc_html__('If on, title and subtitle will be centered.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'title-wrapper-title-color-local',
			'type' => 'color',
			'title' => esc_html__('Title Color', 'splendid'),
			'subtitle' => esc_html__('Choose title color.', 'splendid'),
			'output' => array(
				'color' => '.page-heading h1'
			)
		),
		
		array(
			'id'=>'title-wrapper-subtitle-color-local',
			'type' => 'color',
			'title' => esc_html__('Subtitle Color', 'splendid'),
			'subtitle' => esc_html__('Choose subtitle color.', 'splendid'),
			'output' => array(
				'color' => '.page-heading h5, .page-heading p'
			)
		),
		
		array(
			'id'        => 'title-wrapper-subtitle-local',
			'type'      => 'text',
			'title'     => esc_html__('Subtitle', 'splendid'),
			'subtitle'  => esc_html__('This is a subtitle displayed below the title.', 'splendid'),
			'default'   => '',
		),
		
		array(
			'id'=>'title-wrapper-subtitle-style-local',
			'type' => 'select',
			'title' => esc_html__('Subtitle Style', 'splendid'),
			'subtitle' => esc_html__('Choose subtitle style.', 'splendid'),
			'options' => array(
				'normal' => esc_html__('Normal', 'splendid'),
				'heading' => esc_html__('Heading', 'splendid'),
			),
			'default'   => '',
			'validate' => '',
		),	
		
		array(
			'id'=>'title-wrapper-breadcrumbs-local',
			'type' => 'button_set', 
			'title' => esc_html__('Enable Breadcrumbs', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'title-wrapper-breadcrumbs-color-local',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Breadcrumbs Color', 'splendid'),
			'subtitle' => esc_html__('Choose breadcrumbs color.', 'splendid'),
			'output' => array(
				'color' => '.page-heading .breadcrumbs li, .page-heading .breadcrumbs li a',
				'background-color' => '
					.page-heading.style-image.style-image-style2 ul li:after
				'
			)
		),
	), // #fields
);
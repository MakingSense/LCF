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
			'id'=>'title-wrapper-portfolio-template-local',
			'type' => 'select',
			'title' => esc_html__('Template', 'splendid'),
			'subtitle' => esc_html__('Choose template for the title wrapper.', 'splendid'),
			'options' => array(
				'portfolio-basic' => esc_html__('Portfolio Basic', 'splendid'),
				'portfolio-extended' => esc_html__('Portfolio Extended', 'splendid'),
				'portfolio-modern' => esc_html__('Portfolio Modern', 'splendid'),
				'portfolio-alternative' => esc_html__('Portfolio Alternative', 'splendid'),
			),
			'default'   => '',
			'validate' => '',
		),
		
		array(
			'id'=>'portfolio-title-wrapper-enable-image-local',
			'type' => 'button_set',
			'title' => esc_html__('Show Featured Image', 'splendid'),
			'subtitle'=> esc_html__('If on, featured image will be displayed on title wrapper', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('title-wrapper-portfolio-template-local', '=', 'portfolio-modern')
		),
		
		array(
			'id'       => 'portfolio-title-wrapper-image-local',
			'type'     => 'media', 
			'url'      => true,
			'title'    => esc_html__('Image', 'splendid'),
			'subtitle' => esc_html__('Image displayed below title wrapper. Upload any media using the WordPress native uploader.', 'splendid'),
			'default'  => '',
			'required' => array('title-wrapper-portfolio-template-local', '=', 'portfolio-modern')
		),
		
		array(
			'id'=>'portfolio-title-wrapper-background-local',
			'type' => 'background', 
			'url' => true,
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Title wrapper background, color and other options.', 'splendid'),
			'output' => array(
				'background' => '
					.page-heading.portfolio-heading, 
					.page-heading.portfolio-heading.portfolio-extended-heading,
					.page-heading.portfolio-heading.portfolio-alternative-heading
				'
			)
		),

		array(
			'id'=>'title-wrapper-title-color-portfolio-local',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Title Color', 'splendid'),
			'subtitle' => esc_html__('Choose title color.', 'splendid'),
			'output' => array(
				'color' => '.portfolio-heading.page-heading h1'
			)
		),

		array(
			'id' => 'title-wrapper-portfolio-subtitle-enable-local',
			'type'	 => 'button_set',
			'title' => esc_html__('Enable Subtitle', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('title-wrapper-portfolio-template-local', '=', 'portfolio-alternative')
		),	
		
		array(
			'id'=>'title-wrapper-subtitle-color-portfolio-local',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Subtitle Color', 'splendid'),
			'subtitle' => esc_html__('Choose subtitle color.', 'splendid'),
			'output' => array(
				'color' => '.portfolio-heading.page-heading h5, .portfolio-heading.page-heading p, .portfolio-heading.page-heading a'
			)
		),
		
		array(
			'id'=>'title-wrapper-icons-color-portfolio-local',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Icons Color', 'splendid'),
			'subtitle' => esc_html__('Choose icons color.', 'splendid'),
			'output' => array(
				'border-color' => '.portfolio-pagination.style2 a, .portfolio-pagination.style2 a:hover',
				'background-color' => '.portfolio-pagination.style2 .portfolio-all:after, .portfolio-pagination.style2 a[rel="prev"]:after, .portfolio-pagination.style2 a[rel="next"]:before',
				'color' => '.portfolio-pagination.style2 a i'
			),
			'required' => array(
				array('title-wrapper-portfolio-template-local', '!=', 'portfolio-basic' ),
				array('title-wrapper-portfolio-template-local', '!=', 'portfolio-alternative' ),
			)
		),
		
		array(
			'id'=>'title-wrapper-icons-hover-color-portfolio-local',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Icons Hover Color', 'splendid'),
			'subtitle' => esc_html__('Choose icons hover color.', 'splendid'),
			'output' => array(
				'color' => '.portfolio-pagination.style2 a:hover i'
			),
			'required' => array(
				array('title-wrapper-portfolio-template-local', '!=', 'portfolio-basic' ),
				array('title-wrapper-portfolio-template-local', '!=', 'portfolio-alternative' ),
			)
		),
		
		array(
			'id'=>'portfolio-title-wrapper-subtitle-style-local',
			'type' => 'select',
			'title' => esc_html__('Subtitle Style', 'splendid'),
			'subtitle' => esc_html__('Choose subtitle style.', 'splendid'),
			'options' => array(
				'normal' => esc_html__('Normal', 'splendid'),
				'heading' => esc_html__('Heading', 'splendid'),
			),
			'default'   => '',
			'validate' => '',
			'required' => array('title-wrapper-portfolio-template-local', '=', 'portfolio-alternative' )
		),	
		
		array(
			'id'=>'portfolio-title-wrapper-breadcrumbs-local',
			'type' => 'button_set', 
			'title' => esc_html__('Enable Breadcrumbs', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('title-wrapper-portfolio-template-local', '=', 'portfolio-alternative' )
		),
		
		array(
			'id'=>'portfolio-title-wrapper-breadcrumbs-color-local',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Breadcrumbs Color', 'splendid'),
			'subtitle' => esc_html__('Choose breadcrumbs color.', 'splendid'),
			'output' => array(
				'color' => '
					.page-heading .breadcrumbs li, 
					.page-heading .breadcrumbs li a',
				'background-color' => '
					.page-heading.style-image.style-image-style2 ul li:after
				'
			),
			'required' => array('title-wrapper-portfolio-template-local', '=', 'portfolio-alternative' )
		),
				
	), // #fields
);
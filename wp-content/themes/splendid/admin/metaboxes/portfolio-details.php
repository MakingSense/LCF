<?php
/*
 * Portfolio details
*/

$sections[] = array(
	'icon' => 'el-icon-align-justify',
	'title' => esc_html__('Project details', 'splendid'),
	'fields' => array(
		
		array(
			'id'        => 'portfolio-gallery',
			'type'      => 'slides',
			'title'     => esc_html__('Gallery Slider', 'splendid'),
			'subtitle'  => esc_html__('Upload images or add from media library.', 'splendid'),
			'placeholder'   => array(
				'title'         => esc_html__('Title', 'splendid'),
			),
			'show' => array(
				'title' => true,
				'description' => false,
				'url' => false,
			)
		),

		array(
			'id'        => 'portfolio-client',
			'type'      => 'text',
			'title'     => esc_html__('Client', 'splendid'),
			'subtitle'  => esc_html__('Your client name.', 'splendid'),
			'default'   => '',
		),

		array(
			'id'        => 'portfolio-title',
			'type'      => 'textarea',
			'title'     => esc_html__('Title', 'splendid'),
			'subtitle'  => esc_html__('Project title.', 'splendid'),
			'default'   => '',
		),
		
		array(
			'id'        => 'portfolio-details',
			'type'      => 'textarea',
			'title'     => esc_html__('Details', 'splendid'),
			'subtitle'  => esc_html__('Project details.', 'splendid'),
			'default'   => '',
		),
		
		array(
			'id'        => 'portfolio-skills',
			'type'      => 'textarea',
			'title'     => esc_html__('Skills', 'splendid'),
			'subtitle'  => esc_html__('One skill per row.', 'splendid'),
			'default'   => '',
		),

		array(
			'id'        => 'portfolio-role',
			'type'      => 'textarea',
			'title'     => esc_html__('Role', 'splendid'),
			'subtitle'  => esc_html__('One role per row.', 'splendid'),
			'default'   => '',
		),
		
		array(
			'id'        => 'portfolio-date',
			'type'      => 'text',
			'title'     => esc_html__('Date', 'splendid'),
			'subtitle'  => esc_html__('Project date.', 'splendid'),
			'default'   => '',
		),
		
		array(
			'id'        => 'portfolio-url',
			'type'      => 'text',
			'title'     => esc_html__('URL', 'splendid'),
			'subtitle'  => esc_html__('The URL to the project.', 'splendid'),
			'default'   => '',
			'validate'  => 'url',
		),
		
	), // #fields
);
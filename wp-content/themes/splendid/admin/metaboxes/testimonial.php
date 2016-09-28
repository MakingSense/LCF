<?php
/*
 * Testimonial
*/

$sections[] = array(
	//'icon' => 'el-icon-adjust-alt',
	'fields' => array(
		array(
			'id'        => 'testimonial-author',
			'type'      => 'text',
			'title'     => esc_html__('Author', 'splendid'),
		),

		array(
			'id'        => 'testimonial-position',
			'type'      => 'text',
			'title'     => esc_html__('Position', 'splendid'),
		),

		array(
			'id'        => 'testimonial-company',
			'type'      => 'text',
			'title'     => esc_html__('Company', 'splendid'),
		),
		
		array(
			'id'        => 'testimonial-company-url',
			'type'      => 'text',
			'title'     => esc_html__('URL', 'splendid'),
		),
	
	), // #fields
);
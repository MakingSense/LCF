<?php
/*
 * Post
*/

$sections[] = array(
	//'title' => esc_html__(' Settings', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-gallery',
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
	)
);
<?php
/*
 * Link
*/

$sections[] = array(
	//'title' => esc_html__(' Settings', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-link-url',
			'type'      => 'text',
			'title'     => esc_html__('URL', 'splendid'),
			'default'   => '',
		),
		array(
			'id'        => 'post-link-label',
			'type'      => 'text',
			'title'     => esc_html__('Label', 'splendid'),
			'subtitle'  => esc_html__('Link label.', 'splendid'),
			'default'   => '',
		),
	)
);
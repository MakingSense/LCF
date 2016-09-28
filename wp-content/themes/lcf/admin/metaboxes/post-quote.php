<?php
/*
 * Quote
*/

$sections[] = array(
	//'title' => esc_html__(' Settings', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-quote-content',
			'type'      => 'textarea',
			'title'     => esc_html__('Quote', 'splendid'),
			'subtitle'  => esc_html__('Content of your quote.', 'splendid'),
			'default'   => '',
		),
		array(
			'id'        => 'post-quote-author',
			'type'      => 'text',
			'title'     => esc_html__('Author', 'splendid'),
			'subtitle'  => esc_html__('Quote author.', 'splendid'),
			'default'   => '',
		),
	)
);
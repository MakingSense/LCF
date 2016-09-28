<?php
/*
 * Shop Section
*/

$this->sections[] = array(
	'title' => esc_html__('Shop', 'splendid'),
	'desc' => esc_html__('Change WooCommerce plugin configuration.', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		
		array(
			'id'        => 'shop-posts-per-page',
			'type'      => 'text',
			'title'     => esc_html__('Posts Per Page', 'splendid'),
			'default'   => '10',
			'validate'   => 'numeric',
		),

		
	), // #fields
);
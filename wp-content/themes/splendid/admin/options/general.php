<?php
/*
 * General Section
*/

$this->sections[] = array(
	'title' => esc_html__('General Settings', 'splendid'),
	'desc' => esc_html__('Configure easily the basic theme\'s settings.', 'splendid'),
	'icon' => 'el-icon-adjust-alt',
	'fields' => array(
		
		array(
			'id'       => 'custom-sidebars',
			'type'     => 'multi_text',
			'title'    => esc_html__( 'Custom Sidebars', 'splendid' ),
			'subtitle' => esc_html__( 'Custom sidebars can be assigned to any page or post.', 'splendid' ),
			'desc'     => esc_html__( 'You can add as many custom sidebars as you need.', 'splendid' )
		)
	),
);
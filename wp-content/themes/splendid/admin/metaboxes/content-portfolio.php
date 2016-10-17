<?php
/*
 * General Section
*/

$sections[] = array(
	'title' => esc_html__('Content', 'splendid'),
	'desc' => esc_html__('Change the content section configuration.', 'splendid'),
	'icon' => 'el-icon-lines',
	'fields' => array(
		array(
			'id'        => 'page-margin-local',
			'type'      => 'select',
			'title'     => esc_html__('Content Margin', 'splendid'),
			'subtitle'  => esc_html__('Select desired margin for the content', 'splendid'),
			'options'   => array(
				'' => esc_html__('Default', 'splendid'),
				'padding_t_0 padding_b_0' => esc_html__('No margin', 'splendid'),
				'padding_b_0' => esc_html__('Only top margin', 'splendid'),
				'padding_t_0' => esc_html__('Only bottom margin', 'splendid'),
			),
			'default' => '',
		),
	),
);
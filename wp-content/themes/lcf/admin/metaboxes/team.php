<?php
/*
 * Team genearal
*/

$sections[] = array(
	//'icon' => 'el-icon-adjust-alt',
	'fields' => array(
		array(
			'id'=>'team-overlay',
			'type' => 'select',
			'title' => esc_html__('Overlay', 'splendid'),
			'subtitle' => esc_html__('Select team overlay color.', 'splendid'),
			'options' => array(
				'bg-dark-gray'      => esc_html__('Dark Gray', 'splendid'),
				'bg-cranberry'      => esc_html__('Cranberry', 'splendid'),
				'bg-light-blue'     => esc_html__('Light Blue', 'splendid'),
				'bg-dark-green'     => esc_html__('Dark Green', 'splendid'),
				'bg-red'            => esc_html__('Red', 'splendid'),
				'bg-purple'         => esc_html__('Purple', 'splendid'),
				'bg-bittersweet'    => esc_html__('Bittersweet', 'splendid'),
				'bg-turquoise-blue' => esc_html__('Turquoise Blue', 'splendid'),
				'bg-green'          => esc_html__('Green', 'splendid'),
				'bg-orange'         => esc_html__('Orange', 'splendid'),
				'bg-pink'           => esc_html__('Pink', 'splendid'),
				'bg-dark-orange'    => esc_html__('Dark Orange', 'splendid'),
				'bg-turquoise'      => esc_html__('Turquoise', 'splendid'),
				'bg-gray'           => esc_html__('Gray', 'splendid'),
				'bg-silver'         => esc_html__('Silver', 'splendid'),
				'bg-light-gray'     => esc_html__('Light Gray', 'splendid'),
				'bg-black'          => esc_html__('Black', 'splendid'),
				'bg-white'          => esc_html__('White', 'splendid'),
			),
			'default' => '',
		),
		array(
			'id'        => 'team-position',
			'type'      => 'text',
			'title'     => esc_html__('Postion', 'splendid'),
			'subtitle'  => esc_html__('Position of the team member.', 'splendid'),
		),

		array(
			'id'        => 'team-facebook',
			'type'      => 'text',
			'title'     => esc_html__('Facebook', 'splendid'),
			'subtitle'  => esc_html__('Social site URL.', 'splendid'),
		),
	
		array(
			'id'        => 'team-twitter',
			'type'      => 'text',
			'title'     => esc_html__('Twitter', 'splendid'),
			'subtitle'  => esc_html__('Social site URL.', 'splendid'),
		),
		
		array(
			'id'        => 'team-dribble',
			'type'      => 'text',
			'title'     => esc_html__('Dribble', 'splendid'),
			'subtitle'  => esc_html__('Social site URL.', 'splendid'),
		),

		array(
			'id'        => 'team-behance',
			'type'      => 'text',
			'title'     => esc_html__('Behance', 'splendid'),
			'subtitle'  => esc_html__('Social site URL.', 'splendid'),
		),	
	), // #fields
);
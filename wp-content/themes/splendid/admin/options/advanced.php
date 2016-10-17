<?php
/*
 * Advanced
*/

$this->sections[] = array(
	'title' => esc_html__('Advanced', 'splendid'),
	'desc' => esc_html__('Change advanced theme options.', 'splendid'),
	'icon' => 'el-icon-cogs',
	'fields' => array(
				
		/**
		 * Twitter API
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => esc_html__('Twitter API', 'splendid'),
			'subtitle' => esc_html__('Go to "https://dev.twitter.com/apps," login with your twitter account and click "Create a new application".', 'splendid')
		),
		
		array(
			'id' => 'twitter-help',
			'type' => 'raw',
			'desc' => esc_html__('To get required keys please go to "https://dev.twitter.com/apps," login with your twitter account and click "Create a new application".', 'splendid')
		),
		
		array(
			'id'        => 'twitter-consumer-key',
			'type'      => 'text',
			'title'     => esc_html__('Consumer Key', 'splendid'),
			'subtitle'  => '',
			'default'   => '',
		),
		
		array(
			'id'        => 'twitter-consumer-secret',
			'type'      => 'text',
			'title'     => esc_html__('Consumer Secret', 'splendid'),
			'subtitle'  => '',
			'default'   => '',
		),
		
		array(
			'id'        => 'twitter-access-token',
			'type'      => 'text',
			'title'     => esc_html__('Access Token', 'splendid'),
			'subtitle'  => '',
			'default'   => '',
		),
		
		array(
			'id'        => 'twitter-access-token-secret',
			'type'      => 'text',
			'title'     => esc_html__('Access Token Secret', 'splendid'),
			'subtitle'  => '',
			'default'   => '',
		),
		
	), // #fields
);
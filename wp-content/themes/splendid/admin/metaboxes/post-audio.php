<?php
/*
 * Post
*/

$sections[] = array(
	//'title' => esc_html__(' Settings', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-audio-url',
			'type'      => 'text',
			'title'     => esc_html__('Audio URL', 'splendid'),
			'subtitle'  => esc_html__('Audio file URL in format: mp3, ogg, wav.', 'splendid'),
			'default'   => '',
		),
	)
);
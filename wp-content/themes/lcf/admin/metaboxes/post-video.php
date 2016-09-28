<?php
/*
 * Post
*/

$sections[] = array(
	//'title' => esc_html__(' Settings', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		array(
			'id'        => 'post-video-url',
			'type'      => 'text',
			'title'     => esc_html__('Video URL', 'splendid'),
			'subtitle'  => esc_html__('YouTube or Vimeo video URL', 'splendid'),
			'default'   => '',
		),
	)
);
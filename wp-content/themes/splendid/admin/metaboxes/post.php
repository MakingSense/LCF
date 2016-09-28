<?php
/*
 * Post
*/
$sections[] = array(
//	'title' => esc_html__('Layout Settings', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		
		array(
			'id'=>'post-style-local',
			'type' => 'select',
			'title' => esc_html__('Post Style', 'splendid'),
			'subtitle' => esc_html__('Select post style.', 'splendid'),
			'options' => array(
				'standard'             => esc_html__('Standard','splendid'),
				'extended'             => esc_html__('Extended','splendid'),
				'extended-alternative' => esc_html__('Extended Alternative','splendid'),
				'modern'               => esc_html__('Modern','splendid'),
			),
			'default' => '',
		),

		array(
			'id' => 'post-extended-subtitle',
			'type' => 'text',
			'title' => esc_html__('Subtitle', 'splendid'),
			'subtitle' => esc_html__('Enter subtitle which will be displayed below post title.', 'splendid'),
			'default' => '',
			'required'  => array('post-style-local', 'equals', array('extended')),
		),
		
		array(
			'id'=>'post-enable-media-local',
			'type' => 'button_set',
			'title' => esc_html__('Enable media', 'splendid'),
			'subtitle'=> esc_html__('If on, featured image, gallery, video or audio will be displayed automatically on a single post page.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'post-enable-post-share-local',
			'type' => 'button_set',
			'title' => esc_html__('Enable Post Share', 'splendid'),
			'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'post-enable-next-post-local',
			'type' => 'button_set',
			'title' => esc_html__('Enable Next Post Section', 'splendid'),
			'subtitle'=> esc_html__('If on, next post section will be displayed on a single post page.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('post-style-local', '=', 'modern')
		),
		
		array(
			'id'=>'post-enable-author-description-local',
			'type' => 'button_set',
			'title' => esc_html__('Enable Author Description', 'splendid'),
			'subtitle'=> esc_html__('If on, author description will be displayed on a single post page.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id'=>'post-enable-similar-posts-local',
			'type' => 'button_set',
			'title' => esc_html__('Enable similar posts', 'splendid'),
			'subtitle'=> esc_html__('If on, similar posts will be displayed automatically on a single post page.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),

	)
);
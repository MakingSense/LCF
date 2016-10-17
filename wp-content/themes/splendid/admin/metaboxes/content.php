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
		
		array(
			'id'=>'page-comments-enable-local',
			'type' => 'switch', 
			'title' => esc_html__('Enable Comments?', 'splendid'),
			'subtitle'=> esc_html__('If on, the comment form will be avaliable for this page.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
			'id' => 'page-shadow-top',
			'type' => 'switch', 
			'title' => esc_html__('Enable Shadow Top', 'splendid'),
			'subtitle' => esc_html__('If on, shadown will be displayed.', 'splendid'),
			'default' => 0,
		),
		
		array(
			'id' => 'page-shadow-bottom',
			'type' => 'switch', 
			'title' => esc_html__('Enable Shadow Bottom', 'splendid'),
			'subtitle' => esc_html__('If on, shadown will be displayed.', 'splendid'),
			'default' => 0,
		),
		
		array(
			'id' => 'page-show-special-content-above-top',
			'type' => 'switch', 
			'title' => esc_html__('Show Special Content Above Top', 'splendid'),
			'subtitle' => esc_html__('If on, selected special content item will be displayed above the header and preheader.', 'splendid'),
			'default' => 0,
		),
		
		array(
			'id'        => 'page-top-special-content',
			'type'      => 'select',
			'title'     => esc_html__('Special Content Displayed Above Top', 'splendid'),
			'subtitle'  => esc_html__('Select special content item to be displayed above header and preheader.', 'splendid'),
			'options'   => ts_get_special_content_array(),
			'default' => '',
			'required' => array('page-show-special-content-above-top' ,'=', '1')
		),
		
		array(
			'id' => 'page-show-special-content-before-content',
			'type' => 'switch', 
			'title' => esc_html__('Show Special Content Before Page Content', 'splendid'),
			'subtitle' => esc_html__('If on, selected special content item will be displayed before page content.', 'splendid'),
			'default' => 0,
		),
		
		array(
			'id'        => 'page-before-special-content',
			'type'      => 'select',
			'title'     => esc_html__('Special Content Displayed Before Page Content', 'splendid'),
			'subtitle'  => esc_html__('Select special content item to be displayed before page content.', 'splendid'),
			'options'   => ts_get_special_content_array(),
			'default' => '',
			'required' => array('page-show-special-content-before-content' ,'=', '1')
		),
		
		array(
			'id' => 'page-show-special-content-after-content',
			'type' => 'switch', 
			'title' => esc_html__('Show Special Content After Page Content', 'splendid'),
			'subtitle' => esc_html__('If on, selected page content will be displayed after content.', 'splendid'),
			'default' => 0,
		),
		
		array(
			'id'        => 'page-after-special-content',
			'type'      => 'select',
			'title'     => esc_html__('Special Content Displayed After Content', 'splendid'),
			'subtitle'  => esc_html__('Select special content item to be displayed after page content', 'splendid'),
			'options'   => ts_get_special_content_array(),
			'default' => '',
			'required' => array('page-show-special-content-after-content' ,'=', '1')
		),
	),
);
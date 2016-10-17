<?php
/*
 * Favicon Section
*/

if ( version_compare( $GLOBALS['wp_version'], '4.3', '<' ) || !function_exists('wp_site_icon') ) {
	
	$this->sections[] = array(
		'title' => esc_html__('Favicon Settings', 'splendid'),
		'desc' => esc_html__('Configure the favicon in a lot of plataforms. Generate and download your package at http://realfavicongenerator.net/', 'splendid'),
		'icon' => 'el-icon-wrench',
		'fields' => array(

			array(
				'id' => 'random-general-number',
				'type' => 'info',
				'desc' => esc_html__('Generate and download your image package at http://realfavicongenerator.net/', 'splendid')
			),

			array(
				'id' => 'random-general-number',
				'type' => 'info',
				'desc' => esc_html__('Default Favicons', 'splendid')
			),

			array(
				'title' => esc_html__('Favicon 16x16', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (16x16)', 'splendid'),
				'id' => 'favicon-16',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 32x32', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (32x32)', 'splendid'),
				'id' => 'favicon-32',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 96x96', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (96x96)', 'splendid'),
				'id' => 'favicon-96',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 160x160', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (160x160)', 'splendid'),
				'id' => 'favicon-160',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 192x192', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (192x192)', 'splendid'),
				'id' => 'favicon-192',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'id' => 'random-general-number',
				'type' => 'info',
				'desc' => esc_html__('Apple Favicons', 'splendid')
			),

			array(
				'title' => esc_html__('Favicon 57x57', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (57x57)', 'splendid'),
				'id' => 'favicon-a-57',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 114x114', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (114x114)', 'splendid'),
				'id' => 'favicon-a-114',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 72x72', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (72x72)', 'splendid'),
				'id' => 'favicon-a-72',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 144x144', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (144x144)', 'splendid'),
				'id' => 'favicon-a-144',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 60x60', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (60x60)', 'splendid'),
				'id' => 'favicon-a-60',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 120x120', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (120x120)', 'splendid'),
				'id' => 'favicon-a-120',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 76x76', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (76x76)', 'splendid'),
				'id' => 'favicon-a-76',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 152x152', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (152x152)', 'splendid'),
				'id' => 'favicon-a-152',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Favicon 180x180', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions (180x180)', 'splendid'),
				'id' => 'favicon-a-180',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'id' => 'random-general-number',
				'type' => 'info',
				'desc' => esc_html__('Windows Metro', 'splendid')
			),

			array(
				'id'       => 'favicon-win-color',
				'type'     => 'color',
				'title'    => esc_html__('Custom Tile Background Color', 'splendid'), 
				'subtitle' => esc_html__('Pick a background color for the tile.', 'splendid'),
				'validate' => 'color',
				'transparent' => false,
				'description' => 'You can see a few recommended tile colors at "Favicon for Windows 8 - Tile" section at http://realfavicongenerator.net/',
			),

			array(
				'title' => esc_html__('Tile Image 70x70', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions. Minimum image size: 70x70. Recommended: 128x128.', 'splendid'),
				'id' => 'favicon-win-70',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Tile Image 150x150', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions. Minimum image size: 150x150. Recommended: 270x270.', 'splendid'),
				'id' => 'favicon-win-150',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Tile Image 310x150', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions. Minimum image size: 310x150. Recommended: 558x270.', 'splendid'),
				'id' => 'favicon-win-310',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

			array(
				'title' => esc_html__('Tile Image 310x310', 'splendid'),
				'desc' => esc_html__('Upload favicon image in the following dimensions. Minimum image size: 310x310. Recommended: 558x558.', 'splendid'),
				'id' => 'favicon-win-310-quad',
				'type' => 'media',
				'readonly' => false,
				'url'=> true,
			),

		),
	);

}
<?php
/*
 * Header Section
*/

$this->sections[] = array(
	'title' => esc_html__('Header', 'splendid'),
	'desc' => esc_html__('Change the header section configuration.', 'splendid'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'header-enable-switch',
			'type' => 'switch', 
			'title' => esc_html__('Enable Header', 'splendid'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'default' => 1,
		),
		
		array(
 			'id'=>'header-template',
 			'type' => 'select',
 			'title' => esc_html__('Template', 'splendid'),
 			'subtitle'=> esc_html__('Choose template for header.', 'splendid'),
 			'options' => array(
				'default' => esc_html__('Default','splendid'),
				'alternative' => esc_html__('Atlernative','splendid'),
				'centered_logo' => esc_html__('Centered Logo','splendid'),
				'full-width' => esc_html__('Full Width','splendid'),
				'transparent' => esc_html__('Transparent','splendid'),
				'transparent-alt' => esc_html__('Transparent Atlernative','splendid'),
				'side' => esc_html__('Side','splendid'),
				'logo_only' => esc_html__('Logo Only','splendid'),
			),
			'default' => 'default',
			'validate' => 'not_empty',
 		),
		
 		array(
 			'id'=>'header-fixed',
 			'type' => 'select',
 			'title' => esc_html__('Sticky or Fixed', 'splendid'),
 			'subtitle'=> esc_html__('Select if header is fixed.', 'splendid'),
			'options' => array(
				'sticky' => esc_html__('Sticky','splendid'),
				'fixed' => esc_html__('Fixed','splendid'),
			),
 			'default' => '',
			'required' => array(
				array('header-template' ,'!=', 'side'),
				array('header-template' ,'!=', 'logo_only'),
			),
 		),
		
		array(
 			'id'=>'header-side-preheader-fixed',
 			'type' => 'switch', 
			'title' => esc_html__('Fixed preheader', 'splendid'),
			'subtitle' => esc_html__('If on, preheader will be fixed.', 'splendid'),
			'default' => 1,
			'required' => array('header-template' ,'=', 'side'),
 		),
		
		array(
			'id' => 'header-shadow',
			'type' => 'switch', 
			'title' => esc_html__('Shadow', 'splendid'),
			'subtitle' => esc_html__('If on, shadown will be displayed below the header.', 'splendid'),
			'default' => 1,
			'required' => array('header-template' ,'=', array('default', 'alternative', 'centered_logo')),
		),
		
		array(
			'id'=>'header-style',
			'type' => 'select',
			'title' => esc_html__('Header Style', 'splendid'),
			'subtitle' => esc_html__('Select the header style.', 'splendid'),
			'options' => array(
				'bg-white color-dark' => esc_html__('White Background','splendid'),
				'bg-blue color-light' => esc_html__('Blue Background','splendid'),
				'bg-bittersweet color-light' => esc_html__('Bittersweet Background','splendid'),
				'bg-dark-blue color-light' => esc_html__('Dark Blue Background','splendid'),
				'bg-light-blue color-light' => esc_html__('Light Blue Background','splendid'),
				'bg-green color-light' => esc_html__('Green Background','splendid'),
				'bg-black color-light' => esc_html__('Black Background','splendid'),
			),
			'default' => 'bg-white color-dark',
			'validate' => 'not_empty',
			'required' => array('header-template' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-sticky-style',
			'type' => 'select',
			'title' => esc_html__('Sticky Header Style', 'splendid'),
			'subtitle' => esc_html__('Select the header style.', 'splendid'),
			'options' => array(
				'sticky-bg-white sticky-color-dark' => esc_html__('White Background','splendid'),
				'sticky-bg-blue sticky-color-light' => esc_html__('Blue Background','splendid'),
				'sticky-bg-bittersweet sticky-color-light' => esc_html__('Bittersweet Background','splendid'),
				'sticky-bg-dark-blue sticky-color-light' => esc_html__('Dark Blue Background','splendid'),
				'sticky-bg-light-blue sticky-color-light' => esc_html__('Light Blue Background','splendid'),
				'sticky-bg-green sticky-color-light' => esc_html__('Green Background','splendid'),
				'sticky-bg-black sticky-color-light' => esc_html__('Black Background','splendid'),
			),
			'default' => '',
			'validate' => '',
			'required' => array(
				array('header-template' ,'!=', 'side'),
				array('header-template' ,'!=', 'logo_only'),
			),
		),
		
		array(
			'id'=>'header-menu-color',
			'type' => 'select',
			'title' => esc_html__('Menu Color', 'splendid'),
			'subtitle' => esc_html__('Select the header menu color.', 'splendid'),
			'options' => array(
				'color-white' => esc_html__('White','splendid'),
				'color-white inactive-opacity' => esc_html__('White + Opacity','splendid'),
				'color-dark-gray' => esc_html__('Dark Gray','splendid'),
			),
			'default' => 'color-white',
			'validate' => 'not_empty',
			'required' => array('header-template' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-menu-color-active',
			'type' => 'select',
			'title' => esc_html__('Menu Active Color', 'splendid'),
			'subtitle' => esc_html__('Select the header menu active color.', 'splendid'),
			'options' => array(
				'active-color-blue' => esc_html__('Blue','splendid'),
				'active-color-white' => esc_html__('White','splendid'),
				'active-color-turquoise' => esc_html__('Turquoise','splendid'),
			),
			'default' => 'active-color-blue',
			'validate' => 'not_empty',
			'required' => array('header-template' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-menu-dropdown-color',
			'type' => 'select',
			'title' => esc_html__('Menu Dropdown Color', 'splendid'),
			'subtitle' => esc_html__('Select the header dropdown menu color.', 'splendid'),
			'options' => array(
				'dropdown-light' => esc_html__('Light','splendid'),
				'dropdown-dark' => esc_html__('Dark','splendid'),
			),
			'default' => 'dropdown-light',
			'validate' => 'not_empty',
			'required' => array(
				array('header-template' ,'!=', 'side'),
				array('header-template' ,'!=', 'logo_only'),
			),
		),
		
		array(
			'id'=>'header-menu-border-color',
			'type' => 'select',
			'title' => esc_html__('Menu Border Color', 'splendid'),
			'subtitle' => esc_html__('Select the header borders color.', 'splendid'),
			'options' => array(
				'border-color-blue' => esc_html__('Blue','splendid'),
				'border-color-light-blue' => esc_html__('Light Blue','splendid'),
				'border-color-bittersweet' => esc_html__('Bittersweet','splendid'),
				'border-color-white' => esc_html__('White','splendid'),
				'border-color-black' => esc_html__('Black','splendid'),
				'border-color-turquoise' => esc_html__('Turquoise','splendid'),
			),
			'default' => 'border-color-blue',
			'validate' => 'not_empty',
			'required' => array(
				array('header-template' ,'!=', 'side'),
				array('header-template' ,'!=', 'logo_only'),
			),
		),
		
		array(
			'id'=>'header-menu-icons-color',
			'type' => 'select',
			'title' => esc_html__('Icons Color', 'splendid'),
			'subtitle' => esc_html__('Select the header icons color.', 'splendid'),
			'options' => array(
				'default' => esc_html__('Default','splendid'),
				'light' => esc_html__('Light','splendid'),
			),
			'default' => 'default',
			'validate' => 'not_empty',
			'required' => array('header-template' ,'!=', 'logo_only'),
		),
		
		array(
			'id' => 'random-number-logo',
			'type' => 'info',
			'desc' => esc_html__('Logo Module Configuration.', 'splendid')
		),

		array(
			'id'=>'logo',
			'type' => 'media', 
			'url' => true,
			'title' => esc_html__('Logo', 'splendid'),
			'subtitle' => esc_html__('Upload the logo that will be displayed in the header.', 'splendid'),
		),

		array(
			'id'=>'logo-retina',
			'type' => 'media', 
			'url'=> true,
			'title' => esc_html__('Logo Retina', 'splendid'),
			'desc'=> esc_html__('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200. Logo must include @2x in the file name, eg. if your logo file name is <strong>logo.png</strong>, retina version must be <strong>logo@2x.png</strong> and must be placed in the same directory! This featrue requires the plugin <strong>WP Retina 2x</strong> to be activated.', 'splendid'),
			'subtitle' => esc_html__('Optional retina version displayed in devices with retina display (high resolution display).', 'splendid'),
		),

		array(
			'id'=>'logo-light',
			'type' => 'media', 
			'url' => true,
			'title' => esc_html__('Logo (light)', 'splendid'),
			'subtitle' => esc_html__('Upload a light version of logo used in dark backgrounds', 'splendid'),
		),

		array(
			'id'=>'logo-retina-light',
			'type' => 'media', 
			'url'=> true,
			'title' => esc_html__('Logo Retina (light)', 'splendid'),
			'desc'=> esc_html__('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200. Logo must include @2x in the file name, eg. if your logo file name is <strong>logo.png</strong>, retina version must be <strong>logo@2x.png</strong> and must be placed in the same directory! This featrues require the plugin <strong>WP Retina 2x</strong> to be activated.', 'splendid'),
			'subtitle' => esc_html__('Optional retina version displayed in devices with retina display (high resolution display).', 'splendid'),
		),

		array(
			'id' => 'random-number-mod',
			'type' => 'info',
			'desc' => esc_html__('Modules Configuration.', 'splendid'),
			'required' => array('header-template' ,'!=', 'logo_only'),
		),

		array(
			'id'=>'header-enable-search',
			'type' => 'switch', 
			'title' => esc_html__('Search', 'splendid'),
			'subtitle'=> esc_html__('If on, a search module will be displayed.', 'splendid'),
			'default' => 0,
			'required' => array('header-template' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-enable-cart',
			'type' => 'switch', 
			'title' => esc_html__('Cart', 'splendid'),
			'subtitle'=> esc_html__('If on, a cart module will be displayed. Works only when Woocommerce plugin is installed', 'splendid'),
			'default' => 0,
			'required' => array('header-template' ,'!=', 'logo_only'),
		),

		array(
			'id'=>'header-enable-button',
			'type' => 'switch', 
			'title' => esc_html__('Button', 'splendid'),
			'subtitle'=> esc_html__('If on, a button module will be displayed.', 'splendid'),
			'default' => 0,
			'required' => array('header-template' ,'!=', 'logo_only'),
		),
		array(
			'id'=>'header-button-text',
			'type' => 'text', 
			'title' => esc_html__('Button Text', 'splendid'),
			'subtitle'=> esc_html__('Button label to be disaplayed.', 'splendid'),
			'default' => '',
			'required' => array('header-enable-button' ,'=', '1')
		),
		array(
			'id'        => 'header-button-link',
			'type'      => 'select',
			'data'      => 'pages',
			'title'     => esc_html__('Button Link', 'splendid'),
			'required' => array('header-enable-button' ,'=', '1')
		),
		
		array(
			'id'        => 'header-button-target',
			'type'		=> 'select',
 			'title'		=> esc_html__('Button Target', 'splendid'), 
 			'options'	=> array( 
 				'_blank'	=> esc_html__('Blank', 'splendid'),
				'_self'		=> esc_html__('Self', 'splendid'),
 			),
 			'default' => '_blank',
			'required' => array('header-enable-button' ,'=', '1')
		),
		
	), // #fields
);
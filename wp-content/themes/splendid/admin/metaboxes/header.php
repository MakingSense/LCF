<?php
/*
 * Header Section
*/

$sections[] = array(
	'title' => esc_html__('Header', 'splendid'),
	'desc' => esc_html__('Change the header section configuration.', 'splendid'),
	'icon' => 'el-icon-cog',
	'fields' => array(

		array(
			'id' => 'header-enable-switch-local',
			'type'	 => 'button_set',
			'title' => esc_html__('Enable Header', 'splendid'),
			'subtitle' => esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
		),
		
		array(
 			'id'=>'header-template-local',
 			'type' => 'select',
 			'title' => esc_html__('Template', 'splendid'),
 			'subtitle'=> esc_html__('Choose template for header.', 'splendid'),
 			'options' => array(
				'default' => esc_html__('Default','splendid'),
				'alternative' => esc_html__('Alternative','splendid'),
				'centered_logo' => esc_html__('Centered Logo','splendid'),
				'full-width' => esc_html__('Full Width','splendid'),
				'transparent' => esc_html__('Transparent','splendid'),
				'transparent-alt' => esc_html__('Transparent Alternative','splendid'),
				'side' => esc_html__('Side','splendid'),
				'logo_only' => esc_html__('Logo Only','splendid'),
			),
			'default' => '',
			'validate' => '',
 		),
		
		array(
			'id'=>'header-primary-menu',
			'type' => 'select',
			'title' => esc_html__('Primary Menu', 'splendid'),
			'subtitle' => esc_html__('Select a menu to overwrite the header menu location.', 'splendid'),
			'data' => 'menus',
			'default' => '',
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),
	
 		array(
 			'id'=>'header-fixed-local',
 			'type' => 'select',
 			'title' => esc_html__('Sticky or Fixed', 'splendid'),
 			'subtitle'=> esc_html__('Select if header is fixed.', 'splendid'),
			'options' => array(
				'sticky' => esc_html__('Sticky','splendid'),
				'fixed' => esc_html__('Fixed','splendid'),
			),
 			'default' => '',
			'required' => array(
				array('header-template-local' ,'!=', 'side'),
				array('header-template-local' ,'!=', 'logo_only'),
			),
 		),
		
		array(
 			'id'=>'header-side-preheader-fixed-local',
			'type'	 => 'button_set',
			'title' => esc_html__('Fixed preheader', 'splendid'),
			'subtitle' => esc_html__('If on, preheader will be fixed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
 			'default' => '',
			'required' => array(
				array('header-template-local' ,'=', 'side')
			),
 		),
		
		array(
			'id' => 'header-shadow-local',
			'type' => 'button_set', 
			'title' => esc_html__('Shadow', 'splendid'),
			'subtitle' => esc_html__('If on, shadown will be displayed below the header.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
 			'default' => '',
			'required' => array('header-template-local' ,'=', array('default', 'alternative', 'centered_logo')),
		),
		
		array(
			'id'=>'header-style-local',
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
			'default' => '',
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-sticky-style-local',
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
				array('header-template-local' ,'!=', 'side'),
				array('header-template-local' ,'!=', 'logo_only'),
			),
		),
		
		array(
			'id'=>'header-menu-color-local',
			'type' => 'select',
			'title' => esc_html__('Menu Color', 'splendid'),
			'subtitle' => esc_html__('Select the header menu color.', 'splendid'),
			'options' => array(
				'color-white' => esc_html__('White','splendid'),
				'color-white inactive-opacity' => esc_html__('White + Opacity','splendid'),
				'color-dark-gray' => esc_html__('Dark Gray','splendid'),
			),
			'default' => '',
			'validate' => '',
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-menu-color-active-local',
			'type' => 'select',
			'title' => esc_html__('Menu Active Color', 'splendid'),
			'subtitle' => esc_html__('Select the header menu color.', 'splendid'),
			'options' => array(
				'active-color-blue' => esc_html__('Blue','splendid'),
				'active-color-white' => esc_html__('White','splendid'),
				'active-color-turquoise' => esc_html__('Turquoise','splendid'),
			),
			'default' => '',
			'validate' => '',
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-menu-dropdown-color-local',
			'type' => 'select',
			'title' => esc_html__('Menu Dropdown Color', 'splendid'),
			'subtitle' => esc_html__('Select the header dropdown menu color.', 'splendid'),
			'options' => array(
				'dropdown-light' => esc_html__('Light','splendid'),
				'dropdown-dark' => esc_html__('Dark','splendid'),
			),
			'default' => '',
			'validate' => '',
			'required' => array(
				array('header-template-local' ,'!=', 'side'),
				array('header-template-local' ,'!=', 'logo_only'),
			),
		),
		
		array(
			'id'=>'header-menu-border-color-local',
			'type' => 'select',
			'title' => esc_html__('Menu Border Color', 'splendid'),
			'subtitle' => esc_html__('Select the header dropdown menu color.', 'splendid'),
			'options' => array(
				'border-color-blue' => esc_html__('Blue','splendid'),
				'border-color-light-blue' => esc_html__('Light Blue','splendid'),
				'border-color-bittersweet' => esc_html__('Bittersweet','splendid'),
				'border-color-white' => esc_html__('White','splendid'),
				'border-color-black' => esc_html__('Black','splendid'),
				'border-color-turquoise' => esc_html__('Turquoise','splendid'),
			),
			'default' => '',
			'validate' => '',
			'required' => array(
				array('header-template-local' ,'!=', 'side'),
				array('header-template-local' ,'!=', 'logo_only'),
			),
		),
		
		array(
			'id'=>'header-menu-icons-color-local',
			'type' => 'select',
			'title' => esc_html__('Icons Color', 'splendid'),
			'subtitle' => esc_html__('Select the header icons color.', 'splendid'),
			'options' => array(
				'default' => esc_html__('Default','splendid'),
				'light' => esc_html__('Light','splendid'),
			),
			'default' => '',
			'validate' => '',
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),

		array(
			'id' => 'random-number-logo',
			'type' => 'info',
			'desc' => esc_html__('Logo Module Configuration.', 'splendid')
		),

		array(
			'id'=>'logo-local',
			'type' => 'media', 
			'url' => true,
			'title' => esc_html__('Logo', 'splendid'),
			'subtitle' => esc_html__('Upload the logo that will be displayed in the header.', 'splendid'),
		),

		array(
			'id'=>'logo-retina-local',
			'type' => 'media', 
			'url'=> true,
			'title' => esc_html__('Logo Retina', 'splendid'),
			'desc'=> esc_html__('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200. Logo must include @2x in the file name, eg. if your logo file name is <strong>logo.png</strong>, retina version must be <strong>logo@2x.png</strong> and must be placed in the same directory! This featrues require the plugin <strong>WP Retina 2x</strong> to be activated.', 'splendid'),
			'subtitle' => esc_html__('Optional retina version displayed in devices with retina display (high resolution display).', 'splendid'),
		),

		array(
			'id'=>'logo-light-local',
			'type' => 'media', 
			'url' => true,
			'title' => esc_html__('Logo (light)', 'splendid'),
			'subtitle' => esc_html__('Upload a light version of logo used in dark backgrounds', 'splendid'),
		),

		array(
			'id'=>'logo-retina-light-local',
			'type' => 'media', 
			'url'=> true,
			'title' => esc_html__('Logo Retina (light)', 'splendid'),
			'desc'=> esc_html__('The same logo image but with twice dimensions, e.g. your logo is 100x100, then your retina logo must be 200x200. Logo must include @2x in the file name, eg. if your logo file name is <strong>logo.png</strong>, retina version must be <strong>logo@2x.png</strong> and must be placed in the same directory! This featrues require the plugin <strong>WP Retina 2x</strong> to be activated.', 'splendid'),
			'subtitle' => esc_html__('Optional retina version displayed in devices with retina display (high resolution display).', 'splendid'),
		),
		
		array(
			'id' => 'random-number-modules',
			'type' => 'info',
			'desc' => esc_html__('Modules Configuration.', 'splendid'),
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-enable-search-local',
			'type' => 'button_set', 
			'title' => esc_html__('Search', 'splendid'),
			'subtitle'=> esc_html__('If on, a search module will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-enable-cart-local',
			'type' => 'button_set', 
			'title' => esc_html__('Cart', 'splendid'),
			'subtitle'=> esc_html__('If on, a cart module will be displayed. Works only when Woocommerce plugin is installed', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),
	
		array(
			'id'=>'header-enable-button-local',
			'type' => 'button_set', 
			'title' => esc_html__('Button', 'splendid'),
			'subtitle'=> esc_html__('If on, a button module will be displayed.', 'splendid'),
			'options' => array(
				'1' => 'On',
				'' => 'Default',
				'0' => 'Off',
			),
			'default' => '',
			'required' => array('header-template-local' ,'!=', 'logo_only'),
		),
		
		array(
			'id'=>'header-button-text-local',
			'type' => 'text', 
			'title' => esc_html__('Button Text', 'splendid'),
			'subtitle'=> esc_html__('Button label to be disaplayed.', 'splendid'),
			'default' => '',
			'required' => array('header-enable-button-local' ,'=', '1')
		),
		
		array(
			'id' => 'header-button-link-local',
			'type' => 'select',
			'data' => 'pages',
			'title' => esc_html__('Button Link', 'splendid'),
			'required' => array('header-enable-button-local' ,'=', '1')
		),
		
		array(
			'id'        => 'header-button-target-local',
			'type'		=> 'select',
 			'title'		=> esc_html__('Button Target', 'splendid'), 
 			'options'	=> array( 
 				'_blank'	=> esc_html__('New window', 'splendid'),
				'_self'		=> esc_html__('Same window', 'splendid'),
 			),
 			'default' => '',
			'required' => array('header-enable-button-local' ,'=', '1')
		),		
	), // #fields
);
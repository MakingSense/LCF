<?php

/**
 * TGM Init Class
 */
include_once ('class-tgm-plugin-activation.php');

function starter_plugin_register_required_plugins() {

	$plugins = array(
		
		array(
            'name'               => 'Splendid Addons', // The plugin name.
            'slug'               => 'splendid-addons', // The plugin slug (typically the folder name).
            'source'             => get_template_directory_uri() . '/plugins/splendid-addons.zip', // The plugin source.
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        ),
		array(
            'name'					=> 'WPBakery Visual Composer', // The plugin name
            'slug'					=> 'js_composer', // The plugin slug (typically the folder name)
            'source'				=>  get_template_directory_uri() . '/plugins/js_composer.zip', // The plugin source
            'required'				=> true, // If false, the plugin is only 'recommended' instead of required
            'version'				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
            'external_url'			=> '', // If set, overrides default API URL and points to an external URL
        ),
		array(
			'name' 		=> 'Revolution Slider WP',
			'slug' 		=> 'revslider',
			'required' 	=> false,
			'source'	=> get_template_directory_uri().'/plugins/revslider.zip'
		),
		array(
            'name' => 'MailPoet Newsletters',
            'slug' => 'wysija-newsletters',
            'required' => false ,
        ),
		array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false,
        ),
	);

	$config = array(
		'id'           => 'splendid',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}

add_action( 'tgmpa_register', 'starter_plugin_register_required_plugins' );
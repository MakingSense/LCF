<?php
/*
 * Import/Export Section
*/

$button = '';

if (splendid_check_if_wordpress_importer_activated()) {
	
	$max_execution_time = null;
	if (function_exists('ini_get')) {
		$max_execution_time = ini_get('max_execution_time');
		
	}
	
	if ($max_execution_time != null && $max_execution_time < 500) {
		$execution_time = sprintf(esc_html__('Your script maximum execution time is set to %d seconds. It may be not enough for import to succeed. Suggested value is 500 seconds.', 'splendid'),$max_execution_time);
	} else {
		$execution_time = esc_html__('Before running import check script maximum execution time. Suggested value is 500 seconds. Lower value may be not enough for import to succeed', 'splendid');
	}
	
	$importer_message = '
		<p class="description">
			'.esc_html__('Import sample data including posts, pages, portfolio items, theme options, images, sliders etc. It may take severals minutes!', 'splendid').'
			<br/><br/>
			'.$execution_time.'
		</p>';
	
	$button = '
		<p>
			<span id="import-sample-data" class="button button-primary">'.esc_html__('Import', 'splendid').'</span>
			<span class="hidden" id="import-sample-data-confirm">'.esc_html__('Do you want to continue? Your data will be lost!', 'splendid').'</span>

			'.(get_option('splendid_import_started') == 1 ? '
				<span id="reset-importer-status" class="button button-primary">'.esc_html__('Reset Status', 'splendid').'</span>' : '').'
				<span class="hidden" id="reset-importer-status-confirm">'.esc_html__('Do you want to continue? If you already imported sample data some theme features WILL NOT WORK CORRECTLY for imported post, pages, portfolio and other items!', 'splendid').'</span>
				<span class="hidden" id="reset-importer-status-done">'.esc_html__('Done','splendid').'</span>
		</p>
		<div id="import-sample-data-log" class="hidden"><div>';
	
} else {
	$plugin_slug = 'wordpress-importer';
	
	if ( file_exists( WP_PLUGIN_DIR . '/' . $plugin_slug ) ) {
		// Looks like Importer is installed, But not active
		$plugins = get_plugins( '/' . $plugin_slug );
		if ( !empty($plugins) ) {
			$keys = array_keys($plugins);
			$plugin_file = $plugin_slug . '/' . $keys[0];
			$action = '<a href="' . esc_url(wp_nonce_url(admin_url('plugins.php?action=activate&plugin=' . $plugin_file), 'activate-plugin_' . $plugin_file)) .
									'"title="' . esc_attr__('Activate importer', 'splendid') . '"">' . esc_html__('Activate Wordpress Importer', 'splendid') . '</a>';
		}
	}
	if ( empty($action) ) {
		if ( is_main_site() ) {
			$action = '<a href="' . esc_url( network_admin_url( 'plugin-install.php?tab=plugin-information&plugin=' . $plugin_slug .
								'&TB_iframe=true&width=600&height=550' ) ) . '" class="thickbox" title="' .
								esc_attr__('Install importer', 'splendid') . '">' . esc_html__('Install Wordpress Importer', 'splendid') . '</a>';
		} 

	}
	
	$importer_message = esc_html__('Wordpress Importer plugin must be installed and activated to import sample data.', 'splendid').' '.$action;
}

$fields = array(
		
	array(
		'id' => 'section-start',
		'type' => 'section',
		'title' => esc_html__('Import Sample Data', 'splendid'),
		'indent' => true 
	),

	array(
		'id' => 'opt-import-message',
		'type' => 'raw',
		'content' => $importer_message,
	)
);

if ($button) {
	$fields[] = array(
		'id'=>'opt-import-template',
		'type' => 'select',
		'title' => esc_html__('Template', 'splendid'),
		'subtitle'=> esc_html__('Choose template to import.', 'splendid'),
		'options' => array(
			'default' => esc_html__('Default','splendid'),
			'agency' => esc_html__('Agency','splendid'),
		),
		'default' => 'default',
		'validate' => 'not_empty',
	);

	$fields[] = array(
		'id'            => 'opt-import-sample-data-button',
		'type'			=> 'raw',
		'content'		=> $button,
	);
}

$fields[] = array(
	'id' => 'section-end',
	'type' => 'section',
	'indent' => false 
);

$fields[] = array(
	'id'            => 'opt-import-export',
	'type'          => 'import_export',
	'title'         => esc_html__('Import Export', 'splendid'),
	'subtitle'      => esc_html__('Save and restore your Redux options', 'splendid'),
	'full_width'    => false,
);

$this->sections[] = array(
	'title' => esc_html__('Import/Export', 'splendid'),
	'desc' => esc_html__('Import/Export Options', 'splendid'),
	'icon' => 'el-icon-arrow-down',
	'fields' => $fields
);
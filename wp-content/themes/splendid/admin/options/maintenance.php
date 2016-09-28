<?php
/*
 * General Section
*/

$this->sections[] = array(
	'title' => esc_html__('Maintenace Mode', 'splendid'),
	'desc' => esc_html__('Configure Maintenace Mode settings.', 'splendid'),
	'icon' => 'el-icon-warning-sign',
	'fields' => array(
		
		array(
			'id'=>'enable-maintenance-mode',
			'type' => 'switch', 
			'title' => esc_html__('Enable Maintenance Mode', 'splendid'),
			'subtitle'=> esc_html__('If on, the frontend shows maintenance mode page only.', 'splendid'),
			'desc' => esc_html__('Only administrator will be able to visit site. If you want to check if maintenance mode is enabled you have to logout.', 'splendid'),
			'default' => 0,
		),
		
		array(
			'id'        => 'maintenance-mode-page',
			'type'      => 'select',
			'data'      => 'pages',
			'title'     => esc_html__('Maintenance Mode Page', 'splendid'),
			'required' => array('enable-maintenance-mode' ,'=', '1')
		),
		
		array(
			'id'=>'enable-maintenance-mode-till',
			'type' => 'switch', 
			'title' => esc_html__('Enable Maintenance Mode Till', 'splendid'),
			'subtitle'=> sprintf(esc_html__('If on, the maintenance mode will be enabled to specific time. Current server time is %s ', 'splendid'),date(get_option('date_format').' '.get_option('time_format'),current_time( 'timestamp' ))),
			'default' => 0,
		),
		
		array(
			'id'        => 'maintenance-mode-till-date',
			'type'      => 'date',
			'title'     => esc_html__('Date (mm/dd/yyyy)', 'splendid'),
			'default'   => date('m/d/Y'),
			'required' => array('enable-maintenance-mode-till' ,'=', '1'),
		),
		
		array(
			'id'        => 'maintenance-mode-till-hour',
			'type'      => 'select',
			'title'     => esc_html__('Hour', 'splendid'),
			'options' => splendid_get_hours(),
			'default'   => '00',
			'required' => array('enable-maintenance-mode-till' ,'=', '1')
		),
		
		array(
			'id'        => 'maintenance-mode-till-minutes',
			'type'      => 'select',
			'title'     => esc_html__('Minutes', 'splendid'),
			'options' => splendid_get_minutes(),
			'default'   => '00',
			'required' => array('enable-maintenance-mode-till' ,'=', '1')
		),
	),
);
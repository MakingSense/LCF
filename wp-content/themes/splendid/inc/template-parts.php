<?php
/**
 * Template parts functions
 *
 * @package splendid
 */

/**
 * Preheader template
 */
function ts_get_preheader_template_part() {
	
	if (!ts_get_opt('preheader-enable-switch')) {
		return;
	}
	
	$template = ts_get_opt('preheader-template');
	
	switch ($template) {
		
		case '3_columns':
			get_template_part('templates/preheader/3_columns');
			break;
			
		case '2_columns':
		default:
			get_template_part('templates/preheader/default');
	}
}

/**
 * Header template
 */
function ts_get_header_template_part() {
	
	if (class_exists('ReduxFramework') && !ts_get_opt('header-enable-switch')) {
		return;
	}
	
	$template = ts_get_opt('header-template');
	
	switch ($template) {
		
		case 'alternative':
			get_template_part('templates/header/alternative');
			break;
		
		case 'centered_logo':
			get_template_part('templates/header/centered-logo');
			break;
		
		case 'logo_only':
			get_template_part('templates/header/logo-only');
			break;
		
		case 'full-width':
			get_template_part('templates/header/full-width');
			break;
		
		case 'side':
			get_template_part('templates/header/side');
			break;
		
		case 'transparent':
			get_template_part('templates/header/transparent');
			break;
		case 'transparent-alt':
			get_template_part('templates/header/transparent-alt');
			break;
		
		default:
			get_template_part('templates/header/default');
	}
}

/**
 * Title wrapper template
 */
function ts_get_title_wrapper_template_part() {
	
	if (class_exists('ReduxFramework') && (!ts_get_opt('title-wrapper-enable') || is_404() ) ) {
		return;
	}
	
	if (is_singular('portfolio')) {
		$template = ts_get_opt('title-wrapper-portfolio-template');
	} else {
		$template = ts_get_opt('title-wrapper-template');
	}
	switch ($template) {
		
		case 'bigger':
			get_template_part('templates/title-wrapper/bigger');
			break;
			
		case 'alternative':
			get_template_part('templates/title-wrapper/alternative');
			break;
		
		case 'portfolio-alternative':
			get_template_part('templates/title-wrapper/portfolio-alternative');
			break;
		
		case 'portfolio-basic':
			get_template_part('templates/title-wrapper/portfolio-basic');
			break;
		
		case 'portfolio-extended':
			get_template_part('templates/title-wrapper/portfolio-extended');
			break;
		
		case 'portfolio-modern':
			get_template_part('templates/title-wrapper/portfolio-modern');
			break;
		
		default:
			if (is_singular('portfolio')) {
				get_template_part('templates/title-wrapper/portfolio-basic');
			} else {
				get_template_part('templates/title-wrapper/default');
			}
			
	}
}

/**
 * Copyright template
 */
function ts_get_copyright_template_part() {

	
	if (!ts_get_opt('footer-enable')) {
		return;
	}
	
	$template = ts_get_opt('footer-copyright-template');
	
	switch ($template) {
		
		case 'alternative':
			get_template_part('templates/copyright/alternative');
			break;
			
		case 'default':
		default:
			get_template_part('templates/copyright/default');
	}
}
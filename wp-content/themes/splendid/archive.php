<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package splendid
 */

$archive_template = ts_get_opt('archive-template');
switch ($archive_template) {
	case 'blog-standard':
	case 'blog-standard-alt':
	case 'blog-medium':
	case 'blog-medium-alt':
	case 'blog-masonry':
		get_template_part('page-templates/'.$archive_template);
		break;
	
	default:
		get_template_part('page-templates/blog-standard');
}
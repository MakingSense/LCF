<?php
/**
 * The template for displaying search results pages.
 *
 * @package splendid
 */

$search_template = ts_get_opt('search-template');
switch ($search_template) {
	case 'blog-standard':
	case 'blog-standard-alt':
	case 'blog-medium':
	case 'blog-medium-alt':
	case 'blog-masonry':
		get_template_part('page-templates/'.$search_template);
		break;
	
	default:
		get_template_part('page-templates/blog-standard');
}
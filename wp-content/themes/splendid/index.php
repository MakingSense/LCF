<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package splendid
 */

$blog_template = ts_get_opt('blog-template');
switch ($blog_template) {
	case 'blog-standard':
	case 'blog-standard-alt':
	case 'blog-medium':
	case 'blog-medium-alt':
	case 'blog-masonry':
		get_template_part('page-templates/'.$blog_template);
		break;
	
	default:
		get_template_part('page-templates/blog-standard');
}
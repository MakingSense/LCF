<?php
/*
 * Blog Section
*/

$this->sections[] = array(
	'title' => esc_html__('Pages/Templates', 'splendid'),
	'desc' => esc_html__('Change templates and pages templates.', 'splendid'),
	'icon' => 'el-icon-screen',
	'fields' => array(
		
		/**
		 * 404
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('404 page', 'splendid').'</h2>'
		),
		
		array(
			'id'=>'404-background',
			'type' => 'media', 
			'url' => true,
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Upload the background that will be displayed in the 404 page.', 'splendid'),
		),

		array(
			'id'=>'404-logo',
			'type' => 'media', 
			'url' => true,
			'title' => esc_html__('Image', 'splendid'),
			'subtitle' => esc_html__('Upload the image that will be displayed in the 404 page.', 'splendid'),
		),
		
		
		/**
		 * Archive
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('Archive', 'splendid').'</h2>'
		),
		
		array(
			'id'=>'archive-template',
			'type' => 'select',
			'title' => esc_html__('Archive Template', 'splendid'),
			'subtitle' => esc_html__('Select the archive default template.', 'splendid'),
			'options' => array(
				'blog-standard' => esc_html__('Standard', 'splendid'),
				'blog-standard-alt' => esc_html__('Standard Alternative', 'splendid'),
				'blog-medium' => esc_html__('Medium', 'splendid'),
				'blog-medium-alt' => esc_html__('Medium Alternative', 'splendid'),
				'blog-masonry' => esc_html__('Masonry', 'splendid'),
			),
			'default' => 'blog-standard',
			'validate' => 'not_empty',
		),
		
		/**
		 * Blog
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('Blog', 'splendid').'</h2>'
		),
		
		array(
			'id'=>'blog-template',
			'type' => 'select',
			'title' => esc_html__('Blog Template', 'splendid'),
			'subtitle' => esc_html__('Select the blog default template.', 'splendid'),
			'options' => array(
				'blog-standard' => esc_html__('Standard', 'splendid'),
				'blog-standard-alt' => esc_html__('Standard Alternative', 'splendid'),
				'blog-medium' => esc_html__('Medium', 'splendid'),
				'blog-medium-alt' => esc_html__('Medium Alternative', 'splendid'),
				'blog-masonry' => esc_html__('Masonry', 'splendid'),
			),
			'default' => 'blog-standard',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'blog-enable-pagination',
			'type' => 'switch', 
			'title' => esc_html__('Enable pagination', 'splendid'),
			'subtitle' => esc_html__('If on pagination will be enabled.', 'splendid'),
			'default' => 1,
		),

		array(
			'id' => 'blog-enable-page-content',
			'type' => 'switch', 
			'title' => esc_html__('Enable page content', 'splendid'),
			'subtitle' => esc_html__('If on page content will be displayed.', 'splendid'),
			'default' => 0,
		),
		
		/**
		 * Pages
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('Pages', 'splendid').'</h2>'
		),
		
		array(
			'id'=>'page-comments-enable',
			'type' => 'switch', 
			'title' => esc_html__('Enable Comments in Pages?', 'splendid'),
			'subtitle'=> esc_html__('If on, the comment form will be avaliable in all pages.', 'splendid'),
			'default' => 0,
		),
		
		/**
		 * Portfolio
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('Portfolio Single', 'splendid').'</h2>'
		),
		
		array(
			'id'        => 'portfolio-page',
			'type'      => 'select',
			'data'      => 'pages',
			'title'     => esc_html__('Portfolio Page', 'splendid'),
		),
		
		array(
			'id'=>'portfolio-template',
			'type' => 'select',
			'title' => esc_html__('Template', 'splendid'),
			'subtitle' => esc_html__('Select portfolio template.', 'splendid'),
			'options' => array(
				'standard'                    => esc_html__('Standard', 'splendid'),
				'extended'                    => esc_html__('Extended', 'splendid'),
				'extended-alternative'        => esc_html__('Extended Alternative', 'splendid'),
				'extended-alternative-style2' => esc_html__('Extended Alternative Two', 'splendid'),
			),
			'default' => 'standard',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'title-wrapper-portfolio-template',
			'type' => 'select',
			'title' => esc_html__('Title Wrapper Template', 'splendid'),
			'subtitle' => esc_html__('Choose template for the title wrapper.', 'splendid'),
			'options' => array(
				'portfolio-basic' => esc_html__('Portfolio Basic', 'splendid'),
				'portfolio-extended' => esc_html__('Portfolio Extended', 'splendid'),	
				'portfolio-modern' => esc_html__('Portfolio Modern', 'splendid'),
				'portfolio-alternative' => esc_html__('Portfolio Alternative', 'splendid'),
			),
			'default'   => 'portfolio-basic',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'portfolio-title-wrapper-enable-image',
			'type' => 'switch',
			'title' => esc_html__('Show Image on Portfolio Modern Template', 'splendid'),
			'subtitle'=> esc_html__('If on, featured image will be displayed on title wrapper', 'splendid'),
			"default" => 1,
		),
		
		array(
			'id'=>'portfolio-title-wrapper-background',
			'type' => 'background', 
			'url' => true,
			'title' => esc_html__('Title Wrapper Background', 'splendid'),
			'subtitle' => esc_html__('Title wrapper background, color and other options.', 'splendid'),
			'output' => array(
				'background' => '.page-heading.portfolio-heading, .page-heading.portfolio-heading.portfolio-extended-heading'
			)
		),
		
		array(
			'id'=>'portfolio-title-wrapper-title-color',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Title Color', 'splendid'),
			'subtitle' => esc_html__('Choose title color.', 'splendid'),
			'output' => array(
				'color' => '.portfolio-heading.page-heading h1'
			)
		),

		array(
			'id'=>'title-wrapper-portfolio-subtitle-enable',
			'type' => 'switch', 
			'title' => esc_html__('Enable Subtitle', 'splendid'),
			'subtitle'=> esc_html__('If on, subtitle will be displayed.', 'splendid'),
			'default' => 1,
			'required' => array('title-wrapper-portfolio-template', '=', 'portfolio-alternative' )
		),
		
		array(
			'id'=>'portfolio-title-wrapper-subtitle-color',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Subtitle Color', 'splendid'),
			'subtitle' => esc_html__('Choose subtitle color.', 'splendid'),
			'output' => array(
				'color' => '.portfolio-heading.page-heading h5, .portfolio-heading.page-heading p, .portfolio-heading.page-heading a'
			)
		),
		
		array(
			'id'=>'portfolio-title-wrapper-icons-color',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Title Wrapper Icons Color', 'splendid'),
			'subtitle' => esc_html__('Choose icons color.', 'splendid'),
			'output' => array(
				'border-color' => '.portfolio-pagination.style2 a, .portfolio-pagination.style2 a:hover',
				'background-color' => '.portfolio-pagination.style2 .portfolio-all:after, .portfolio-pagination.style2 a[rel="prev"]:after, .portfolio-pagination.style2 a[rel="next"]:before',
				'color' => '.portfolio-pagination.style2 a i'
			)
		),
		
		array(
			'id'=>'portfolio-title-wrapper-icons-hover-color',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Title Wrapper Icons Hover Color', 'splendid'),
			'subtitle' => esc_html__('Choose icons hover color.', 'splendid'),
			'output' => array(
				'color' => '.portfolio-pagination.style2 a:hover i'
			)
		),
		
		array(
			'id'=>'portfolio-title-wrapper-breadcrumbs',
			'type' => 'switch', 
			'title' => esc_html__('Enable Breadcrumbs', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			'default' => 0,
			'required' => array('title-wrapper-portfolio-template', '=', 'portfolio-alternative' )
		),
		
		array(
			'id'=>'portfolio-title-wrapper-breadcrumbs-color',
			'type' => 'color', 
			'url' => true,
			'title' => esc_html__('Breadcrumbs Color', 'splendid'),
			'subtitle' => esc_html__('Choose breadcrumbs color.', 'splendid'),
			'output' => array(
				'color' => '.page-heading .breadcrumbs li, .page-heading .breadcrumbs li a'
			),
			'required' => array('title-wrapper-portfolio-template', '=', 'portfolio-alternative' )
		),
		
		array(
			'id'=>'portfolio-enable-media',
			'type' => 'switch',
			'title' => esc_html__('Enable media section', 'splendid'),
			'subtitle'=> esc_html__('If on, this layout part will be displayed.', 'splendid'),
			"default" => 1,
		),
		
		/**
		 * Post
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('Post', 'splendid').'</h2>'
		),
		
		array(
			'id'=>'post-style',
			'type' => 'select',
			'title' => esc_html__('Post Style', 'splendid'),
			'subtitle' => esc_html__('Select post style.', 'splendid'),
			'options' => array(
				'standard'             => esc_html__('Standard','splendid'),
				'extended'             => esc_html__('Extended','splendid'),
				'extended-alternative' => esc_html__('Extended Alternative','splendid'),
				'modern'               => esc_html__('Modern','splendid'),
			),
			'default' => 'standard',
			'validate' => 'not_empty',
		),
		
		array(
			'id'=>'post-enable-media',
			'type' => 'switch',
			'title' => esc_html__('Enable media', 'splendid'),
			'subtitle'=> esc_html__('If on, featured image, gallery, video or audio will be displayed automatically on a single post page.', 'splendid'),
			'default' => 1,
		),
		
		array(
			'id'=>'post-enable-post-share',
			'type' => 'switch',
			'title' => esc_html__('Enable Post Share', 'splendid'),
			'subtitle'=> esc_html__('If on, post share section will be displayed on a single post page.', 'splendid'),
			'default' => 1,
		),
			
		array(
			'id'=>'post-enable-next-post',
			'type' => 'switch',
			'title' => esc_html__('Enable Next Post Section', 'splendid'),
			'subtitle'=> esc_html__('If on, next post section will be displayed on a single post page.', 'splendid'),
			'default' => 1,
			'required' => array('post-style', '=', 'modern')
		),
		
		array(
			'id'=>'post-enable-author-description',
			'type' => 'switch',
			'title' => esc_html__('Enable Author Description', 'splendid'),
			'subtitle'=> esc_html__('If on, author description will be displayed on a single post page.', 'splendid'),
			'default' => 1,
		),
		
		array(
			'id'=>'post-enable-similar-posts',
			'type' => 'switch',
			'title' => esc_html__('Enable similar posts', 'splendid'),
			'subtitle'=> esc_html__('If on, similar posts will be displayed automatically on a single post page.', 'splendid'),
			'default' => 1,
		),
		
		
		/**
		 * Search
		 */
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('Search Results', 'splendid').'</h2>'
		),
		
		array(
			'id'=>'search-template',
			'type' => 'select',
			'title' => esc_html__('Search Template', 'splendid'),
			'subtitle' => esc_html__('Select the search default template.', 'splendid'),
			'options' => array(
				'blog-standard' => esc_html__('Standard', 'splendid'),
				'blog-standard-alt' => esc_html__('Standard Alternative', 'splendid'),
				'blog-medium' => esc_html__('Medium', 'splendid'),
				'blog-medium-alt' => esc_html__('Medium Alternative', 'splendid'),
				'blog-masonry' => esc_html__('Masonry', 'splendid'),
			),
			'default' => 'blog-standard',
			'validate' => 'not_empty',
		),

		
	), // #fields
);
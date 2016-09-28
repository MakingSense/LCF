<?php
/**
 * Customizer Section
 */

$this->sections[] = array(
	'title' => esc_html__('Customizer', 'splendid'),
	'desc' => esc_html__('Check child sections to style properly the correct area of the theme.', 'splendid'),
	'icon' => 'el-icon-cog',
	'fields' => array(
				
	), // #fields
);

/**
 * Preheader Section
 */
$this->sections[] = array(
	'title' => esc_html__('Preheader', 'splendid'),
	'desc' => esc_html__('Configure preheader styles.', 'splendid'),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'customizer-preheader-background',
			'type' => 'background',
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Preheader background with image, color and other options.', 'splendid'),
			'output' => array('
				#header #preheader,
				#header #preheader.bg-white,
				#header #preheader.bg-blue,
				#header #preheader.bg-black,
				#header #preheader.bg-turquoise
				'),
		),
		
		array(
			'id' => 'customizer-preheader-border',
			'type' => 'color',
			'title' => esc_html__('Border Color', 'splendid'),
			'subtitle' => esc_html__('Preheader border color. Ignored when border is not used.', 'splendid'),
			'output' => array(
				'border-top-color' => '
					#header #preheader.br-color-turquoise,
					#header #preheader.br-color-blue,
					.header2 #preheader
			'),
		),
		
		
		array(
			'id' => 'customizer-pre-header-typography',
			'type' => 'typography',
			'title' => esc_html__('Typography', 'splendid'),
			'subtitle' => esc_html__('Menu, modules and other header items font.', 'splendid'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => false,
			'output' => array('
				#preheader, 
				#header #preheader .iconic-list li, 
				#preheader .menu li a
			'),
		),
		
		array(
			'id'        => 'customizer-preheader-color',
			'type'      => 'color',
			'title'     => esc_html__('Color', 'splendid'),
			'default'   => '',
			'output'    => array('color' => '
				#preheader, 
				#header #preheader .iconic-list li .fa, 
				#header #preheader .social-icons a, 
				#preheader .menu li a,
				
				#header #preheader.color-light,
				#header #preheader.color-light a, 
				#header #preheader.color-light .menu li a
			')
		),
	),
);

/**
 * Header Section
 */
$this->sections[] = array(
	'title' => esc_html__('Header', 'splendid'),
	'desc' => esc_html__('Configure header styles.', 'splendid'),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'customizer-header-background',
			'type' => 'background',
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Header background with image, color and other options.', 'splendid'),
			'output' => array('
				#main-header,
				.header4 #main-header,
				#sideheader,
				#header #main-header.bg-white,
				#header #main-header.bg-blue,
				#header #main-header.bg-bittersweet,
				#header #main-header.bg-dark-blue,
				#header #main-header.bg-light-blue,
				#header #main-header.bg-green,
				#header #main-header.bg-black,
				.blank-landing-header
			'),
		),
	
		array(
			'id' => 'customizer-low-header-background',
			'type' => 'background',
			'title' => esc_html__('Lower Background', 'splendid'),
			'subtitle' => esc_html__('Lower Header background with image, color and other options. Lower Header is not available for all header styles!', 'splendid'),
			'output' => array('
				.header4 #lower-header,
				#lower-header.bg-white
			'),
		),
		
		array(
			'id' => 'customizer-header-typography',
			'type' => 'typography',
			'title' => esc_html__('Typography', 'splendid'),
			'subtitle' => esc_html__('Menu, modules and other header items font.', 'splendid'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => false,
			'output' => array('
				#main-header #main-nav>.menu,
				#main-nav>.menu,
				#main-header #preheader-contact-nav
			'),
		),
		
		array(
			'id'        => 'customizer-header-color',
			'type'      => 'color',
			'title'     => esc_html__('Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					.header4 #main-header
					',
				'border-color' => '#header #main-header .button'
			)
		),
		
		array(
			'id'        => 'customizer-header-icons-color',
			'type'      => 'color',
			'title'     => esc_html__('Icons Color', 'splendid'),
			'description'=> esc_html__('Only font icons eg. social icons. Doesn\'t work with iamge icons eg. search icon, cart icon .', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					#header .social-icons a,
					#header .iconic-list li .fa
				',
			)
		),
		
		array(
			'id'        => 'customizer-header-menu-color',
			'type'      => 'color',
			'title'     => esc_html__('Menu Color', 'splendid'),
			'default'   => '',
			'output'    => array('
				#sideheader #main-nav.color-dark-gray li a,
				#header #main-nav.color-dark-gray li a,
				#sideheader #main-nav.active-color-dark-gray li:hover>a,
				#header #main-nav.active-color-dark-gray li:hover>a,
				#sideheader #main-nav.active-color-dark-gray li.current-menu-item>a,
				#header #main-nav.active-color-dark-gray li.current-menu-item>a,
				#sideheader #main-nav.active-color-dark-gray li.current-menu-ancestor>a,
				#header #main-nav.active-color-dark-gray li.current-menu-ancestor>a,
				
				#sideheader #main-nav.color-white li a,
				#header #main-nav.color-white li a,
				#sideheader #main-nav.active-color-white li:hover>a,
				#header #main-nav.active-color-white li:hover>a,
				#sideheader #main-nav.active-color-white li.current-menu-item>a,
				#header #main-nav.active-color-white li.current-menu-item>a,
				#sideheader #main-nav.active-color-white li.current-menu-ancestor>a,
				#header #main-nav.active-color-white li.current-menu-ancestor>a,
				
				#lower-header #main-nav li a
			')
		),
				
		array(
			'id'        => 'customizer-header-menu-hover-color',
			'type'      => 'color',
			'title'     => esc_html__('Menu Hover Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					#sideheader #main-nav.color-turquoise li a,
					#header #main-nav.color-turquoise li a,
					#sideheader #main-nav.active-color-turquoise li:hover>a,
					#header #main-nav.active-color-turquoise li:hover>a,
					#sideheader #main-nav.active-color-turquoise li.current-menu-item>a,
					#header #main-nav.active-color-turquoise li.current-menu-item>a,
					#sideheader #main-nav.active-color-turquoise li.current-menu-ancestor>a,
					#header #main-nav.active-color-turquoise li.current-menu-ancestor>a,
					
					#sideheader #main-nav.color-blue li a, 
					#header #main-nav.color-blue li a, 
					#sideheader #main-nav.active-color-blue li:hover > a, 
					#header #main-nav.active-color-blue li:hover > a, 
					#sideheader #main-nav.active-color-blue li.current-menu-item > a, 
					#header #main-nav.active-color-blue li.current-menu-item > a, 
					#sideheader #main-nav.active-color-blue li.current-menu-ancestor > a, 
					#header #main-nav.active-color-blue li.current-menu-ancestor > a,
					
					#sideheader #main-nav.color-white > li > a,
					#header #main-nav.color-white > li > a,
					#sideheader #main-nav.active-color-white .primary-nav > li:hover>a,
					#header #main-nav.active-color-white .primary-nav > li:hover>a,
					#sideheader #main-nav.active-color-white li.current-menu-item>a,
					#header #main-nav.active-color-white li.current-menu-item>a,
					#sideheader #main-nav.active-color-white li.current-menu-ancestor>a,
					#header #main-nav.active-color-white li.current-menu-ancestor>a

				',
			)
		),
		
		array(
			'id'        => 'customizer-header-menu-hover-border-color',
			'type'      => 'color',
			'title'     => esc_html__('Menu Hover Border Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'background' => '
					#sideheader #main-nav.border-color-turquoise li a:before,
					#header #main-nav.border-color-turquoise li a:before,
					
					#sideheader #main-nav.border-color-blue li a:before,
					#header #main-nav.border-color-blue li a:before,
					
					#sideheader #main-nav.border-color-light-blue li a:before,
					#header #main-nav.border-color-light-blue li a:before,
					
					#sideheader #main-nav.border-color-bittersweet li a:before,
					#header #main-nav.border-color-bittersweet li a:before,
					
					#sideheader #main-nav.border-color-white li a:before,
					#header #main-nav.border-color-white li a:before,
					
					#sideheader #main-nav.border-color-black li a:before,
					#header #main-nav.border-color-black li a:before
			')
		),
		
		array(
			'id'        => 'customizer-header-dropdown-background-color',
			'type'      => 'color',
			'title'     => esc_html__('Dropdown Background Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'background-color' => '#header #main-nav ul ul, #header #main-nav.dropdown-dark ul ul'
			)
		),
		
		array(
			'id'        => 'customizer-header-dropdown-top-border-color',
			'type'      => 'color',
			'title'     => esc_html__('Dropdown Top Border Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'border-top-color' => '
					#header #main-nav ul ul,
					#header #main-nav.active-color-turquoise ul ul'
			)
		),
		
		array(
			'id'        => 'customizer-header-dropdown-text-color',
			'type'      => 'color',
			'title'     => esc_html__('Dropdown Text Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '#header #main-nav .menu ul ul a, #header #main-nav.dropdown-dark .menu ul ul a'
			)
		),
		
		array(
			'id'        => 'customizer-header-dropdown-hover-text-color',
			'type'      => 'color',
			'title'     => esc_html__('Dropdown Hover Text Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					#header #main-nav .menu ul ul a:hover, 
					#header #main-nav.dropdown-dark .menu ul ul a:hover,
					#header #main-nav .menu ul ul li.current-menu-item a, 
					#header #main-nav.dropdown-dark .menu ul ul li.current-menu-item a
				'
			)
		),
		
		array(
			'id'        => 'customizer-header-dropdown-hover-background-color',
			'type'      => 'color',
			'title'     => esc_html__('Dropdown Hover Background Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'background-color' => '#header #main-nav .menu ul ul a:hover,  #header #main-nav.dropdown-dark .menu ul ul a:hover'
			)
		),
		
		array(
			'id'        => 'customizer-header-search-background-color',
			'type'      => 'color',
			'title'     => esc_html__('Full Screen Search Background Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'background-color' => '
					#sideheader .header-search-box .header-search-form, 
					#header .header-search-box .header-search-form'
			)
		),
	),
);

/**
 * Title Wrapper Section
 */
$this->sections[] = array(
	'title' => esc_html__('Title Wrapper', 'splendid'),
	'desc' => esc_html__('Configure title wrapper styles.', 'splendid'),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'customizer-title-wrapper-background',
			'type' => 'background',
			'background-image' => true,
			'output' => array('.page-heading'),
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Title wrapper background, color and other options. Background image can be set in Title Wrapper section outside Customizer.', 'splendid'),
		),
		
		array(
			'id' => 'customizer-title-wrapper-typography',
			'type' => 'typography',
			'title' => esc_html__('Title Typography', 'splendid'),
			'subtitle' => esc_html__('Title font.', 'splendid'),
			'font-size'=> true,
			'line-height'=> true,
			'text-align' => false,
			'color' => true,
			'output' => array('.page-heading h1, .page-heading.style-image h1'),
		),
		
		array(
			'id' => 'customizer-subtitle-wrapper-typography',
			'type' => 'typography',
			'title' => esc_html__('Subtitle Typography', 'splendid'),
			'subtitle' => esc_html__('Subtitle font.', 'splendid'),
			'font-size'=> true,
			'line-height'=> true,
			'text-align' => false,
			'color' => true,
			'output' => array('.page-heading h5, .page-heading p, .page-heading a'),
		),
		
		array(
			'id' => 'customizer-breadcrumbs-wrapper-typography',
			'type' => 'typography',
			'title' => esc_html__('Breadcrumbs Typography', 'splendid'),
			'subtitle' => esc_html__('Breadcrumbs font.', 'splendid'),
			'font-size'=> true,
			'line-height'=> true,
			'text-align' => false,
			'color' => true,
			'output' => array('.page-heading .breadcrumbs li, .page-heading .breadcrumbs li a'),
		),

	),
);

/**
 * Content Section
 */
$this->sections[] = array(
	'title' => esc_html__('Content', 'splendid'),
	'desc' => esc_html__('Configure content styles.', 'splendid'),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'customizer-content-background',
			'type' => 'background',
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Content background, color and other options.', 'splendid'),
			'output' => array('
				#splendid-content,
				body:not(.b_1170) blog-pagination>ul a
			'),
		),
		
		array(
			'id' => 'customizer-content-typography',
			'type' => 'typography',
			'title' => esc_html__('Typography', 'splendid'),
			'subtitle' => esc_html__('Content font.', 'splendid'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'font-weight' => false,
			'color' => false,
			'output' => array('
				body,
				.blog-post .post-meta li, 
				.blog-extended-header .post-meta li,
				.button, 
				.wysija-submit-field.wysija-submit
			'),
		),
		
		array(
			'id'        => 'customizer-content-blocks-1-color',
			'type'      => 'color',
			'title'     => esc_html__('Blocks Color (1)', 'splendid'),
			'subtitle'     => esc_html__('Colors of the blocks like item backgrounds, some buttons etc..', 'splendid'),
			'default'   => '',
			'output'    => array(
				'background-color' => '
					.post-side .post-date,
					#comment_submit,
					.audio-player-box,
					.portfolio-item-v2 .read-more:hover,
					.widget_latest_tweets_widget>ul>li:hover .tweet-icon,
					.widget_nav_menu_alt ul li:hover > a:after,
					.accordion.active .accordion-header,
					.pricing-table footer .button.bg-blue,
					.wysija-submit-field.wysija-submit,
					
					.promo-box.style4:before, 
					.promo-box.style4:after, 
					.promo-box.style4 .promo-box-inner:before, 
					.promo-box.style4 .promo-box-inner:after,
					
					.content-box.style1 .icon:after,
					.portfolio-pagination a:hover,
					.process-item .icon-inner
					

				',
				'border-color' => '
					.sc-carousel .carousel-nav a:hover,
					.accordion.active .accordion-header,
					.accordion-filters .filter.active,
					.pricing-table footer .button,
					.content-box.style1 .icon:before, 
					.content-box.style1 .icon:after,
					.portfolio-filters .filter.active, 
					.color-light .portfolio-filters .filter.active,
					.portfolio-pagination a:hover,
					.content-box.style11 .icon:before, 
					.content-box.style11 .icon:after

				',
				'color' => '
					.accordion-filters .filter.active,
					.pricing-table span.price,
					.promo-box.style4 .icon,
					.portfolio-filters .filter.active, 
					.color-light .portfolio-filters .filter.active
				'
			),
		),
		
		array(
			'id'        => 'customizer-content-blocks-2-color',
			'type'      => 'color',
			'title'     => esc_html__('Blocks Color (2)', 'splendid'),
			'subtitle'     => esc_html__('Colors of the blocks like item backgrounds, some buttons etc..', 'splendid'),
			'default'   => '',
			'output'    => array(
				'background-color' => '
					.button.read-more,
					.post-side .button.read-more:before,
					.blog-load-more-container.bg-dark-gray,
					.pricing-table.style-default.featured header .pricing-table-tag,
					.load-more-pagination
				',
				'border-color' => '
					.sc-blog-post.blog-post-medium .post-side .button.read-more,
					.post-side .button.read-more,
					.widget_latest_tweets_widget>ul>li .tweet-icon,
					.sc-carousel .carousel-nav a,
					.pricing-table.style-default header,
					.content-box.style1 .icon,
					.portfolio-pagination a
				',
				'color' => '
					.sc-blog-post.blog-post-medium .post-side .button.read-more,
					.post-side .button.read-more,
					.widget_latest_tweets_widget>ul>li .tweet-date,
					.widget_latest_tweets_widget>ul>li .tweet-icon,
					.pricing-table.style-default header,
					.content-box.style1 .icon,
					.portfolio-pagination a
				',
			),
		),
		
		array(
			'id'        => 'customizer-content-blocks-3-color',
			'type'      => 'color',
			'title'     => esc_html__('Blocks Color (3)', 'splendid'),
			'subtitle'     => esc_html__('Colors of the blocks like item backgrounds, some buttons etc..', 'splendid'),
			'default'   => '',
			'output'    => array(
				'background-color' => '
					.post-header .post-link'
			),
		),
		
		array(
			'id'        => 'customizer-content-blocks-4-color',
			'type'      => 'color',
			'title'     => esc_html__('Blocks Color (4)', 'splendid'),
			'subtitle'     => esc_html__('Colors of the blocks like item backgrounds, some buttons etc..', 'splendid'),
			'default'   => '',
			'output'    => array(
				'background-color' => '
					.post-header blockquote'
			),
		),
		
		array(
			'id'        => 'customizer-content-text-color',
			'type'      => 'color',
			'title'     => esc_html__('Color', 'splendid'),
			'subtitle'     => esc_html__('Text color.', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					body, 
					label, 
					.widget_recent_comments>ul>li,
					.blog-pagination>ul a,
					.blog-pagination>ul a.next,
					.blog-pagination>ul a.prev,
					.portfolio-categories li',
				'border-color' => '
					.blog-pagination>ul a.pagination-last, 
					.blog-pagination>ul a.pagination-first,
					.blog-pagination>ul a.next,
					.blog-pagination>ul a.prev'
			),
		),
		
		array(
			'id'        => 'customizer-content-headers-color',
			'type'      => 'color',
			'title'     => esc_html__('Headers Color', 'splendid'),
			'subtitle'     => esc_html__('Color of the headers.', 'splendid'),
			'default'   => '',
			'output'    => array('color' => 'h1,h2,h3,h4,h5,h6'),
		),
		
		array(
			'id'        => 'customizer-content-links-color',
			'type'      => 'color',
			'title'     => esc_html__('Links color', 'splendid'),
			'subtitle'     => esc_html__('Color of the links.', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					a,
					.sidebar_widget a,
					.widget_latest_tweets_widget>ul>li a,
					.tab-header li.active-tab a',
				'border-color' => '
					.widget_categories .cat-item:before'
			),
		),
		
		array(
			'id'        => 'customizer-content-links-hover-color',
			'type'      => 'color',
			'title'     => esc_html__('Link Hover Color', 'splendid'),
			'subtitle'     => esc_html__('Color of the links.', 'splendid'),
			'default'   => '',
			'output'    => array('color' => '
				a:hover,
				.sidebar_widget a:hover
			'),
		),
		
		array(
			'id'        => 'customizer-content-alternative-links-color',
			'type'      => 'color',
			'title'     => esc_html__('Alternative Links Color', 'splendid'),
			'subtitle'     => esc_html__('Color of the links.', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					.blog-post .post-meta li a,
					.blog-post .post-meta li,
					.blog-extended-header .post-meta li a,
					.blog-post-standard a,
					.blog-post-masonry a,
					.blog-post-medium a,
					.post-tags ul li a,
					.portfolio-title a,
					.sc-blog-post.style-list .blog-post-inner .post-title a,
					.sc-blog-post.style-squared .post-title a
				',
				
			),
		),
		
		array(
			'id'        => 'customizer-content-alternative-links-hover-color',
			'type'      => 'color',
			'title'     => esc_html__('Alterative Links Hover Color', 'splendid'),
			'subtitle'     => esc_html__('Color of the links.', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					.blog-post .post-meta li a:hover, 
					.blog-extended-header .post-meta li a:hover,
					.blog-post-standard a:hover,
					.blog-pagination>ul a:hover,
					.blog-pagination>ul .active a,
					.blog-post-masonry a:hover,
					.blog-post-medium a:hover,
					.post-tags ul li a:hover,
					.portfolio-title a:hover,
					.sc-blog-post.style-list .blog-post-inner .post-title a:hover,
					.sc-blog-post.style-squared .post-title a:hover
				',
				'border-color' => '
					.blog-pagination>ul a.pagination-last:hover, 
					.blog-pagination>ul a.pagination-first:hover, 
					.blog-pagination>ul a.prev:hover, 
					.blog-pagination>ul a.next:hover,
					.blog-pagination>ul a:hover,
					.blog-pagination>ul .active a',
				'background-color' => '
					.portfolio-pagination a:hover'
			),
		),
	),
);

/**
 * Footer Section
 */
$this->sections[] = array(
	'title' => esc_html__('Footer', 'splendid'),
	'desc' => esc_html__('Configure footer sidebar styles.', 'splendid'),
	'subsection' => true,
	'fields' => array(
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('Footer Sidebar Configuration', 'splendid').'</h2>'
		),
		
		array(
			'id' => 'customizer-footer-sidebar-background',
			'type' => 'background',
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Footer sidebar background, color and other options.', 'splendid'),
			'output' => array('#main-footer'),
		),
		
		array(
			'id' => 'customizer-footer-sidebar-typography',
			'type' => 'typography',
			'title' => esc_html__('Typography', 'splendid'),
			'subtitle' => esc_html__('Widgets font and color.', 'splendid'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => false,
			'output' => array('#main-footer'),
		),
		
		array(
			'id'        => 'customizer-footer-sidebar-headers-color',
			'type'      => 'color',
			'title'     => esc_html__('Headers Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					#main-footer h1,
					#main-footer h2,
					#main-footer h3,
					#main-footer h4,
					#main-footer h5,
					#main-footer h6'
			)
		),
		
		array(
			'id'        => 'customizer-footer-sidebar-text-color',
			'type'      => 'color',
			'title'     => esc_html__('Text Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					#main-footer,
					#footer #main-footer
			'),
		),
		
		array(
			'id'        => 'customizer-footer-sidebar-alternative-text-color',
			'type'      => 'color',
			'title'     => esc_html__('Alternative Text Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					#footer .widget_latest_posts .post-meta,
					#footer .widget_latest_tweets_widget>ul>li .tweet-date
			'),
		),
		
		
		
		array(
			'id'        => 'customizer-footer-sidebar-links-color',
			'type'      => 'color',
			'title'     => esc_html__('Links Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '
					#main-footer a
			'),
		),
			
		array(
			'id'        => 'customizer-footer-sidebar-links-hover-color',
			'type'      => 'color',
			'title'     => esc_html__('Links Hover Color', 'splendid'),
			'default'   => '',
			'output'    => array('color' => '
				#main-footer a:hover
			'),
		),
		
		array(
			'id' => 'random-number',
			'type' => 'info',
			'desc' => '<h2>'.esc_html__('Footer Bar Configuration', 'splendid').'</h2>'
		),
		
		array(
			'id' => 'customizer-footer-background',
			'type' => 'background',
			'title' => esc_html__('Background', 'splendid'),
			'subtitle' => esc_html__('Footer background, color and other options.', 'splendid'),
			'output' => array('#lower-footer'),
		),
		
		array(
			'id' => 'customizer-footer-typography',
			'type' => 'typography',
			'title' => esc_html__('Typography', 'splendid'),
			'subtitle' => esc_html__('Footer font.', 'splendid'),
			'font-size'=> false,
			'line-height'=> false,
			'text-align' => false,
			'color' => true,
			'output' => array('#footer #lower-footer'),
		),
		
		array(
			'id'        => 'customizer-footer-social-links-color',
			'type'      => 'color',
			'title'     => esc_html__('Icons Color', 'splendid'),
			'default'   => '',
			'output'    => array(
				'color' => '#footer .social-icons a',
			)
		),
	),
);



<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package spledid
 */
 
 /**
 * Theme logo
 * @param string $logo_field
 * @param string $default_url
 * @param string $class
 */
function splendid_logo($logo_field = '', $default_url = '', $class = 'default-logo') {
	
	if (empty($logo_field)) {
		$logo_field = 'logo';
	}
	
	$logo = '';
	$logo_retina = '';
	
	if( ts_get_opt( $logo_field ) != null ) {
		$logo_array = ts_get_opt( $logo_field );
	}
	?>
	<a class="<?php echo sanitize_html_classes($class);?>" href="<?php echo esc_url( splendid_get_home_url() ); ?>" title="<?php echo esc_attr(get_bloginfo( 'name' )); ?>"> 
		<?php
		if( !isset( $logo_array['url'] ) || empty($logo_array['url']) ) {
			echo '<img src="'.esc_url($default_url).'" alt="'. esc_attr(get_bloginfo( 'name' )) .'" />';
		} else {
			echo '<img src="'. esc_url($logo_array['url']) . '" alt="'. esc_attr(get_bloginfo( 'name' )) .'" />';
		}
		?>
	</a>
	<?php
}

if ( ! function_exists( 'splendid_get_title' ) ) : 

/**
 * Get page title
 * @global object $wp_query
 */
function splendid_get_title() {
		
	$title = '';
	
	//woocoomerce page
	if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()):
		if (apply_filters( 'woocommerce_show_page_title', true )):
			$title = woocommerce_page_title(false);
		endif;
	// Default Latest Posts page
	elseif( is_home() && !is_singular('page') ) :
		$title = esc_html__('Blog','splendid');

	// Singular
	elseif( is_singular() ) :
		$title = get_the_title();
		
	// Search
	elseif( is_search() ) :
		global $wp_query;
		$total_results = $wp_query->found_posts;
		$prefix = '';

		if( $total_results == 1 ){
			$prefix = esc_html__('1 search result for', 'splendid');
		}
		else if( $total_results > 1 ) {
			$prefix = $total_results . ' ' . esc_html__('search results for', 'splendid');
		}
		else {
			$prefix = esc_html__('Search results for', 'splendid');
		}
		$title = $prefix . ': ' . get_search_query();

	// Category and other Taxonomies
	elseif ( is_category() ) :
		$title = single_cat_title('', false);

	elseif ( is_tag() ) :
		$title = single_tag_title('', false);

	elseif ( is_author() ) :
		$title = sprintf( esc_html__( 'Author: %s', 'splendid' ), '<span class="vcard">' . get_the_author() . '</span>' );

	elseif ( is_day() ) :
		$title = sprintf( esc_html__( 'Day: %s', 'splendid' ), '<span>' . get_the_date() . '</span>' );

	elseif ( is_month() ) :
		$title = sprintf( esc_html__( 'Month: %s', 'splendid' ), '<span>' . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'splendid' ) ) . '</span>' );

	elseif ( is_year() ) :
		$title = sprintf( esc_html__( 'Year: %s', 'splendid' ), '<span>' . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'splendid' ) ) . '</span>' );

	elseif( is_tax() ) :
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$title = $term->name;

	elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
		$title = esc_html__( 'Asides', 'splendid' );

	elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
		$title = esc_html__( 'Galleries', 'splendid');

	elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
		$title = esc_html__( 'Images', 'splendid');

	elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
		$title = esc_html__( 'Videos', 'splendid' );

	elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
		$title = esc_html__( 'Quotes', 'splendid' );

	elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
		$title = esc_html__( 'Links', 'splendid' );

	elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
		$title = esc_html__( 'Statuses', 'splendid' );

	elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
		$title = esc_html__( 'Audios', 'splendid' );

	elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
		$title = esc_html__( 'Chats', 'splendid' );

	elseif( is_404() ) :
		$title = esc_html__( '404', 'splendid' );

	else :
		$title = esc_html__( 'Archives', 'splendid' );
	endif;
	
	return $title;
}
endif;

if ( ! function_exists( 'splendid_get_subtitle' ) ) : 

/**
 * Get page subtitle
 * @global object $wp_query
 */
function splendid_get_subtitle() {
	
	if (is_singular() || ( function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop() )) {
		
		if ( function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop() ) {
			$shop_page_id = woocommerce_get_page_id( 'shop' );
			return ts_get_post_opt('title-wrapper-subtitle-local', $shop_page_id);
		}
		
		return ts_get_post_opt('title-wrapper-subtitle-local');
	}
	return '';
}
endif;



if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo wp_kses_post($before . $description . $after);
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function splendid_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'splendid_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'splendid_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so splendid_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so splendid_categorized_blog should return false.
		return false;
	}
}

if ( ! function_exists( 'splendid_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @param int/boolean $max_num_pages
 * @return void
 */
function splendid_paging_nav($max_num_pages = false, $class = '') {

	if ($max_num_pages === false) {
		global $wp_query;
		$max_num_pages = $wp_query -> max_num_pages;
	}
	
	$big = 999999999; // need an unlikely integer

	$args = array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, get_query_var('paged') ),
		'total' => $max_num_pages,
		'prev_next'		=> true,
		'prev_text' 	=> '<span>'.esc_html__('Previous', 'splendid').'</span>',
		'next_text' 	=> '<span>'.esc_html__('Next', 'splendid').'</span>',
		'end_size'		=> 1,
		'mid_size'		=> 2,
		'type' 			=> 'array',
	);
	
	$links = paginate_links( $args );
	
	if (!empty($links)): ?>
		<div class="blog-pagination <?php echo sanitize_html_classes($class); ?>">
			<span><?php echo sprintf(esc_html__('Page %s of %s', 'splendid'),max( 1, get_query_var('paged') ), $max_num_pages); ?></span>
			
			<?php  if (is_array($links)): ?>
				<ul>
					<?php if (max( 1, get_query_var('paged') ) > 1): ?>
						<li><a href="<?php echo esc_url( get_pagenum_link( 1 ) ); ?>" class="pagination-first"><?php esc_html_e('&laquo; First', 'splendid'); ?></a></li>
					<?php endif; ?>

					<?php foreach ($links as $link): ?>
						<?php 
						if (strstr($link,'href')):
							echo '<li>'.wp_kses_data($link).'</li>';
						else:
							echo '<li class="active"><a href="#">'.strip_tags($link).'</a></li>';
						endif; ?>
					<?php endforeach; ?>

					<?php if (max( 1, get_query_var('paged') ) < $max_num_pages ): ?>
						<li><a href="<?php echo esc_url( get_pagenum_link($max_num_pages) ); ?>" class="pagination-last"><?php esc_html_e('Last &raquo;', 'splendid'); ?></a></li>
					<?php endif; ?>

				</ul>
			<?php endif; ?>
		</div>
	<?php endif;
}
endif;

if ( ! function_exists( 'splendid_comment' ) ) :
/**
 * Comments and pingbacks. Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since splendid 1.0
 */
function splendid_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			?>
			<li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID(); ?>">
				<div class="media-body"><?php esc_html_e( 'Pingback:', 'splendid' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( 'Edit', 'splendid' ), ' ' ); ?></div>
			</li>
			<?php
		break;
	
		default :
			$class = array('comment_wrap');
			if ($depth > 1) {
				$class[] = 'chaild';
			}
			?>
			<!-- Comment Item -->
			<li <?php comment_class('media comment'); ?> id="comment-<?php comment_ID(); ?>">

				<div class="comment-content-wrapper">
					<div class="comment-avatar"><?php echo get_avatar( $comment, 90 ); ?></div>

					<div class="comment-content">

						
						<header>
							<p>
								<strong><?php comment_author_link();?></strong> <?php echo esc_html__('on', 'splendid'); ?>
								<?php echo comment_date(get_option('date_format')) ?> <?php echo esc_html__('at', 'splendid'); ?> <?php echo comment_date(get_option('time_format')) ?>
								<?php echo get_comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => 2 ) ) ); ?>
								<?php edit_comment_link( esc_html__( 'Edit', 'splendid' ), '', '' );?>
							</p>
						</header>
						

						<?php if ( $comment->comment_approved == '0' ) : ?>
							<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'splendid' ); ?></em>
						<?php endif; ?>
						<section>
						<?php comment_text(); ?>
						</section>
					</div>
				</div>
			<?php
			break;
	endswitch;
}

endif; // ends check for splendid_comment()

if (!function_exists('splendid_close_comment')):
/**
 * Close comment
 * 
 * @since splendid 1.0
 */
function splendid_close_comment() { ?>		
			</li>
			<!-- End Comment Item -->
<?php }

endif; // ends check for splendid_close_comment()


/**
 * Show breadcrumbs
 * 
 * @since splendid 1.0
 */
function splendid_breadcrumbs($class = '') { 
	
	$before = '<li>';
	$after = '</li>';
	$before_last = '';
	$after_last = '';
	$separator = '';
	
	$output = '';
	?>
	<!-- Breadcrumbs -->
	<ul class="breadcrumbs <?php echo sanitize_html_classes($class); ?>">
		<?php
		
		if (function_exists('is_woocoomerce') && is_woocommerce() || function_exists('is_shop') && is_shop()) {
			$args = array(
				'delimiter'   => '',
				'wrap_before' => '',
				'wrap_after'  => '',
				'before'      => '<li>',
				'after'       => '</li>',
				'home'        => esc_html_x( 'Home', 'breadcrumb', 'splendid' )
			);

			woocommerce_breadcrumb($args);

		} else if (!is_home()) {

			$output .= $before.'<a href="';
			$output .= esc_url(splendid_get_home_url());
			$output .= '">';
			$output .= esc_html__('Home', 'splendid');
			$output .= '</a>'.$after. $separator .'';
			
			if (is_single()) {

				$cats = get_the_category();

				if( isset($cats[0]) ) :
					$output .= $before.'<a href="'. esc_url(get_category_link( $cats[0]->term_id )) .'">'. $cats[0]->cat_name.'</a>' . $after . $separator;
				endif;

				if (is_single()) {
					$output .= $before.$before_last;
					$output .= get_the_title();
					$output .= $after_last.$after;
				}
			} elseif( is_category() ) {

				$cats = get_the_category();

				if( isset($cats[0]) ) :
					$output .= $before.$before_last.single_cat_title('', false).$after_last.$after;
				endif;

			} elseif (is_page()) {
				global $post;
				
				if($post->post_parent){
					$anc = get_post_ancestors( $post->ID );
					$title = get_the_title();
					foreach ( $anc as $ancestor ) {
						$parent_output = $before.'<a href="'.esc_url(get_permalink($ancestor)).'" title="'.esc_attr(get_the_title($ancestor)).'"  rel="v:url" property="v:title">'.get_the_title($ancestor).'</a>'.$after.' ' . $separator;
					}
					$output .= $parent_output;
					$output .= $before.$before_last.$title.$after_last.$after;
				} else {
					$output .= $before.$before_last.get_the_title().$after_last.$after;
				}
			}
			elseif (is_tag()) { 
				$output .= $before.$before_last.single_cat_title('', false).$after_last.$after; 
				
			} elseif (is_day()) {
				$output .= $before.$before_last. esc_html__('Archive for', 'splendid').' '; 
				$output .= get_the_time('F jS, Y');
				$output .= $after_last.$after;
				
			} elseif (is_month()) {
				$output .= $before.$before_last.esc_html__('Archive for', 'splendid').' '; 
				$output .= get_the_time('F, Y');
				$output .= $after_last.$after;
				
			} elseif (is_year()) {
				$output .= $before.$before_last. esc_html__('Archive for', 'splendid').' '; 
				$output .= get_the_time('Y');
				$output .= $after_last.$after;
				
			} elseif (is_author()) {
				$output .= $before.$before_last. esc_html__('Author Archive', 'splendid');
				$output .= $after_last.$after;
				
			} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
				$output .= $before.$before_last.esc_html__('Blog Archives', 'splendid').$after_last.$after;
				
			} elseif (is_search()) {
				$output .= $before.$before_last. esc_html__('Search Results', 'splendid').$after_last.$after;
				
			}

		} elseif (is_home()) { 
			$output .= $before.$before_last. esc_html__('Home', 'splendid') .$after_last.$after; 
		}
		
		echo wp_kses_post($output);
		?>
	</ul>
	<!-- End Breadcrumbs -->
<?php }

/**
 * Social links
 * @param string $pattern
 * @param string $category
 */
function splendid_social_links($pattern = '%s', $category = '') {
	$args = array(
		'posts_per_page' => -1,
		'offset'          => 0,
		'orderby'         => 'menu_order',
		'order'           => 'ASC',
		'post_type'       => 'social-site',
		'post_status'     => 'publish'
	);
	
	if (!empty($category)) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'social-site-category',
				'field'    => 'id',
				'terms'    => $category,
			),
		);
	}
	
	$custom_query = new WP_Query( $args );
	if ( $custom_query->have_posts() ):
		
		$found_posts = $custom_query -> found_posts;
		$ts_loop_it = 0;
		while ( $custom_query -> have_posts() ) :
			$custom_query -> the_post(); 			
			echo sprintf($pattern, '<a href="'.esc_url(get_the_title()).'" target="_blank"><i class=" fa '.esc_attr(ts_get_post_opt('icon')).'"></i></a>');
		?>
		<?php endwhile; // end of the loop.
	endif;
	wp_reset_postdata();
}

/**
 * Displays special content set as top page on page options>content
 * @return void
 */
function splendid_top_special_content() {
	
	if (!is_page() || !ts_get_post_opt('page-show-special-content-above-top')) {
		return;
	}
	
	$page = ts_get_post_opt('page-top-special-content');
	splendid_echo_page_content($page);
}

/**
 * Displays special content set as before content page on page options>content
 * @return void
 */
function splendid_before_content_special_content() {
	
	if (!is_page() || !ts_get_post_opt('page-show-special-content-before-content')) {
		return;
	}
	
	$page = ts_get_post_opt('page-before-special-content');
	splendid_echo_page_content($page);
}

/**
 * Displays special content set as after content page on page options>content
 * @return void
 */
function splendid_after_content_special_content() {
	
	if (!is_page() || !ts_get_post_opt('page-show-special-content-after-content')) {
		return;
	}
	
	$page = ts_get_post_opt('page-after-special-content');
	splendid_echo_page_content($page);
}

/**
 * Echo page content
 * @param int $page
 * @return void
 */
function splendid_echo_page_content($page) {

	if (!intval($page)) {
		return;
	}
	
	$args = array(
		'posts_per_page' => 1,
		'page_id' => $page,
		'post_type' => 'special-content',
		'post_status' => 'publish'
	);
	$query = new WP_Query( $args );
	
	if ($query -> have_posts()) : ?>
		
		<?php
		while ($query -> have_posts()) : 
			$query -> the_post();

			?>
			<!-- Special Content -->
			<div class="specal-content main-content">
				<article <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>
			</div>
			<!-- /Special Content -->
		<?php endwhile; 
		
		wp_reset_postdata();
	endif;
}


if ( ! function_exists( 'splendid_entry_header' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function splendid_entry_header($cat) {
	
	$tags_list = '';
	if ( 'post' == get_post_type() ) {
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'splendid' ) );
	} ?>
	<ul class="post-meta">
		<?php 
		echo sprintf( '<li><time class="entry-date published updated" datetime="%1$s">%2$s</time></li>',
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		?>
		<?php if($cat == 'show'): ?>
			<li><?php esc_html_e('In','splendid')?> <?php echo get_the_category_list( esc_html__( ', ', 'splendid' ) );?></li>
		<?php endif; ?>	

		<?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
		<li><?php esc_html_e('By','splendid')?>
		<?php if ($author_url): ?>
			<a href="<?php echo esc_url($author_url); ?>">
		<?php endif; ?>
		<?php echo get_the_author(); ?>
		<?php if ($author_url): ?>
			</a>
		<?php endif; ?>
		</li>
		<li><?php comments_number( esc_html__('No Comments','splendid'), esc_html__('1 Comment','splendid'), esc_html__('% Comments','splendid') ); ?></li>
	</ul>
	<?php
}
endif;

if ( ! function_exists( 'splendid_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function splendid_entry_footer() {
	
	$tags_list = '';
	if ( 'post' == get_post_type() ) {
		$tags_list =  get_the_tag_list('<ul><li>','</li><li>','</li></ul>');
	} ?>
	<?php if (!empty($tags_list)): ?>
		<span><?php esc_html_e('Tags:','splendid')?></span> <?php echo wp_kses_post($tags_list); ?>
	<?php endif; ?>
	<?php
}
endif;

if ( ! function_exists( 'splendid_entry_author_description' ) ) :
/**
 * Prints next post link with post featured image
 */
function splendid_post_next() {
	
	$next_post = get_next_post();
	if ($next_post):
		if (has_post_thumbnail($next_post -> ID)): ?>
			<!-- Next Post -->
			<section class="post-related section full-width">
				<div class="blog-post related-post related-post-style2 panr-active">
					<header class="post-header panr-element">
						<?php echo get_the_post_thumbnail($next_post -> ID, 'full' ); ?>
					</header>
					<div class="container">
						<a href="<?php echo esc_url(get_permalink($next_post -> ID)); ?>" class="post-content">
							<h6><?php esc_html_e('Next Post', 'splendid'); ?></h6>
							<h3 class="post-title"><?php echo esc_html(get_the_title($next_post -> ID)); ?></h3>
						</a>
					</div>
				</div>
			</section>
			<!-- /Next Post -->	
		<?php endif;
	endif; ?>
<?php
}
endif;

if ( ! function_exists( 'splendid_entry_author_description' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function splendid_entry_author_description() {
	global $post;
	$curauth = get_userdata($post->post_author); ?>
	<section class="post-author">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta('ID'), 130 ); ?>
		</div>

		<div class="author-content">
			<h5 class="author-name"><?php the_author(); ?></h5>
			<ul class="author-meta">
				<li><a href="<?php echo esc_url($curauth->user_url); ?>">@<?php echo esc_html($curauth->user_login); ?></a></li>
			</ul>
			<p class="author-description"><?php if(!empty($curauth->description)): ?>
				<?php echo get_the_author_meta('description'); ?>
			<?php else: ?><?php esc_html_e('There is no author description yet.', 'splendid'); ?><?php endif; ?></p>	
		</div>
	</section>
<?php
}
endif;

if ( ! function_exists( 'splendid_entry_modern_author_description' ) ) :
/**
 * Prints HTML with modern author description
 */
function splendid_entry_modern_author_description() {
	global $post;
	$curauth = get_userdata($post->post_author); ?>
	
	<!-- Post Author -->
	<section class="post-author style2">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta('ID'), 130 ); ?>
		</div>
		<div class="author-content">
			<h5 class="author-name"><?php the_author(); ?></h5>
			<p class="author-description">
				<?php if(!empty($curauth->description)): ?>
					<?php echo get_the_author_meta('description'); ?>
				<?php endif; ?>
			</p>
			<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="button fill-frm-top"><span><?php echo sprintf(esc_html__('More Posts By %s', 'splendid'),get_the_author()); ?></span></a>
		</div>
	</section>
	<!-- /Post Author -->

	<hr class="full-width">

<?php
}
endif;

if ( ! function_exists( 'splendid_single_post_style' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function splendid_single_post_style() {
	global $post;
	
	$single_post_style = ts_get_opt('post-style');
	if (empty($single_post_style) || $single_post_style == 'standard') {
		return;
	}
	
	$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	
	switch ($single_post_style) {
		case 'extended-alternative': ?>
			<!-- Page Heading -->
			<section class="page-heading bg-black style-image style-image-style2 full-width parallax-bg scrollme" <?php echo ( !empty($featured_image_url)  ? ' style="background:url('.esc_url($featured_image_url).');"':'' ); ?> data-stellar-background-ratio="0.6" data-stellar-horizontal-offset="50">
				<div class="container">
					<div class="align-center animateme" data-when="exit" data-from="0" data-to="1" data-opacity="0" data-translatey="400" data-easing="linear">
						<h1><?php the_title(); ?></h1>
						<ul>
							<li><?php the_time('F d, Y'); ?></li>
							<li><?php esc_html_e('In','splendid')?> <?php echo get_the_category_list( esc_html__( ', ', 'splendid' ) );?></li>
						</ul>
					</div>
				</div>
			</section>
			<!-- /Page Heading -->
			<?php
			break;
		
		default: ?>
			<section class="page-heading bg-dark-blue blog-extended-header"<?php echo ( !empty($featured_image_url)  ? ' style="background:url('.esc_url($featured_image_url).');"':'' ); ?>>
				<div class="container">
					<ul class="post-meta">
						<?php 
							echo sprintf( '<li><time class="entry-date published updated" datetime="%1$s">%2$s</time></li>',
							esc_attr( get_the_date( 'c' ) ),
							esc_html( get_the_date() ),
							esc_attr( get_the_modified_date( 'c' ) ),
							esc_html( get_the_modified_date() )
						);
						?>
						<li><?php esc_html_e('In','splendid')?> <?php echo get_the_category_list( esc_html__( ', ', 'splendid' ) );?></li>
					</ul>
					<h1><?php the_title(); ?></h1>
					<h4><?php echo esc_html(ts_get_post_opt('post-extended-subtitle')); ?></h4>
					<footer>
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6">
								<div class="post-author">
									<div class="avatar">
										<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>
									</div>
									<span class="author-name"><?php esc_html_e('By', 'splendid'); ?> <?php the_author_meta( 'user_nicename', $post->post_author ); ?></span>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6">
								<nav class="post-nav">
									<?php previous_post_link( '%link', ''. esc_html__( 'Next', 'splendid' )); ?>
									<?php next_post_link( '%link', esc_html__( 'Prev', 'splendid' ) .' ' ); ?>
								</nav>
							</div>
						</div>
					</footer>
				</div>
			</section>
			<?php # code...
			break;
		}
	?>

<?php
}
endif;

if ( ! function_exists( 'splendid_single_post_modern_style' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function splendid_single_post_modern_style() {
	global $post;
	
	$featured_image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	
	?>
	<!-- Page Heading -->
	<section class="page-heading bg-dark-blue blog-extended-header blog-extended-header-alt full-height scrollme" data-offset-element="#header" data-stellar-background-ratio="0.6" style="background:url(<?php echo esc_url($featured_image_url); ?>);">
		<div class="container">
			<div class="info">
				<div class="info-inner animateme" data-easing="linear" data-when="exit" data-from="0" data-to="1" data-opacity="0" data-translatey="500">
					<h1><?php the_title(); ?></h1>
					<div class="post-author">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 60 ); ?>
						<div class="details">
							<span class="author-name"><?php esc_html_e('By', 'splendid'); ?> <?php the_author_meta( 'user_nicename', $post->post_author ); ?></span>
							<?php 
								echo sprintf( '<time class="entry-date published updated" datetime="%1$s">%2$s</time>',
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_attr( get_the_modified_date( 'c' ) ),
								esc_html( get_the_modified_date() )
							);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<a href="#" class="move-down"><i class="fa fa-angle-down"></i></a>
	</section>
	<!-- /Page Heading -->
		
<?php
}
endif;

if ( ! function_exists( 'splendid_post_related' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function splendid_post_related() {
	global $post;
	$tags = wp_get_post_tags($post->ID);

	if(!empty($tags) && is_array($tags)) {
  	$simlar_tag = $tags[0]->term_id; 

  	?>

  	<div class="sc-carousel" data-items="2">
		<header class="carousel-header">
			<h5 class="carousel-title"><strong><?php esc_html_e('You might also like' , 'splendid'); ?></strong></h5>
			<nav class="carousel-nav">
				<a href="#" class="carousel-prev"><?php esc_html_e('Previous', 'splendid'); ?></a>
				<a href="#" class="carousel-next"><?php esc_html_e('Next', 'splendid'); ?></a>
			</nav>
		</header>
		<div class="owl-carousel">
			<?php
		      $args = array(
		        'tag__in'             => array($simlar_tag),
		        'post__not_in'        => array($post->ID),
		        'posts_per_page'      => 4,
		        'meta_query'          => array(array('key' => '_thumbnail_id', 'compare' => 'EXISTS')),
		        'ignore_sticky_posts' => 1,
		      );
		      $re_query = new WP_Query($args);
		      while ($re_query->have_posts()) : $re_query->the_post();
		      //$img_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), $related_image_size);
		    ?>

			<div>
				<div class="blog-post related-post">
					<header class="post-header">
						<?php if(ts_get_opt('post-style') == 'extended-alternative'): ?>
							<?php the_post_thumbnail('ts-medium-alt-11'); ?>
							<ul class="post-meta">
								<li><?php the_time('F d, Y'); ?></li>
								<li><?php esc_html_e('In','splendid')?> <?php echo get_the_category_list( esc_html__( ', ', 'splendid' ) );?></li>
							</ul>
						<?php else: ?>
							<a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail('ts-medium-alt-11'); ?></a>
							<?php splendid_entry_header('hide'); ?>
						<?php endif; ?>
					</header>
					<section class="post-content">
						<h3 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
					</section>
				</div>
			</div>
			<?php endwhile; wp_reset_postdata(); ?>
		</div><!-- /Owl Carousel -->
	</div>
	<?php } else { ?> <h5 class="carousel-title"><strong><?php esc_html_e('No Similar Posts Found', 'splendid'); ?></strong></h5> <?php }

}
endif;

if ( ! function_exists( 'splendid_post_share' ) ) :
/**
 * Prints HTML with social share sites
 */
function splendid_post_share($header = null) { 
	global $post;
	$pinterest_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'ts-medium-alt-10' );
?>
  	
	<div class="social-sharebox style1">
		<div class="share-buttons">
			<!-- Facebook Share Button | Replace URL with the url that needs to be shared -->
			<a class="share-button facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>">
				<i class="fa fa-facebook"></i>
			</a>
			<!-- Twitter Share Button | Replace URL with the url that needs to be shared -->
			<a class="share-button twitter" target="_blank" href="https://twitter.com/home?status=<?php echo esc_url(get_the_permalink()); ?>">
				<i class="fa fa-twitter"></i>
			</a>
			<!-- Google Plus | Replace URL with the url that needs to be shared -->
			<a class="share-button google-plus" target="_blank" href="https://plus.google.com/share?url=<?php echo esc_url(get_the_permalink()); ?>">
				<i class="fa fa-google-plus"></i>
			</a>
			<!-- Pinterest Share Button | Replace URL with the url that needs to be shared and replace description -->
			<?php if(!empty($pinterest_image) && isset($pinterest_image)):?>
			<a class="share-button pinterest" target="_blank" href="https://pinterest.com/pin/create/button/?url=&amp;media=<?php echo esc_url($pinterest_image[0]); ?>&amp;description=<?php echo urlencode(get_the_title()); ?>">
				<i class="fa fa-pinterest"></i>
			</a>
			<?php endif; ?>
			<!-- Linkedin Share Button | Replace URL with the url that needs to be sharedand replace summary and source -->
			<a class="share-button linkedin" target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_the_permalink()); ?>&amp;title=&amp;summary=&amp;source=">
				<i class="fa fa-linkedin"></i>
			</a>
			<!-- Tumblr Share Button | Doesn't work, need to find alternative -->
			<a class="share-button tumblr" target="_blank" href="http://www.tumblr.com/share?v=3&amp;u=<?php echo esc_url(get_the_permalink()); ?>&amp;t=">
				<i class="fa fa-tumblr"></i>
			</a>
			<!-- Reddit Share Button | Replace URL with the url that needs to be shared and replace title -->
			<a class="share-button reddit" target="_blank" href="http://www.reddit.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&amp;title=">
				<i class="fa fa-reddit"></i>
			</a>
			<!-- Email Share Button | Fires a modal with form below -->
			<a class="share-button digg" target="_blank" href="http://digg.com/submit?url=<?php echo esc_url(get_the_permalink()); ?>&amp;title=">
				<i class="fa fa-digg"></i>
			</a>

		</div>
	</div>		
	<?php 

}
endif;

/**
 * Page content for page templates (eg. Blog Masonry) 
 */
function splendid_page_content_for_page_templates($add_container = true) { 

	if (ts_get_opt('blog-enable-page-content') && have_posts() ) : ?>

		<?php if ($add_container === true): ?>
			<div class="main-content <?php echo sanitize_html_classes(ts_get_post_opt('page-margin-local'));?>">
		<?php endif; ?>
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'templates/content/content','page' ); ?>
				<?php endwhile; ?>

		<?php if ($add_container === true): ?>
			</div>
		<?php endif; ?>
	<?php endif;
}

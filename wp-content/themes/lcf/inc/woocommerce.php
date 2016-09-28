<?php
/**
 * WooCommerce integration
 * 
 * @package splendid
 */

//archive-product.php
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

//content-product.php
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

/**
 * Define woocommerce image sizes
 */
function splendid_woocommerce_image_dimensions() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

 	$catalog = array(
		'width' 	=> '300',	// px
		'height'	=> '360',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '720',	// px
		'height'	=> '918',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '158',	// px
		'height'	=> '158',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

add_action( 'after_switch_theme', 'splendid_woocommerce_image_dimensions', 1 );

// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'splendid_header_add_to_cart_fragment' );

function splendid_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<a class="cart-contents" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>"><i class="fa fa-shopping-cart"></i> <?php echo sprintf(esc_html__('Cart(%d)','splendid'),WC()->cart->cart_contents_count); ?></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}

/**
* WP Core doens't let us change the sort direction for invidual orderby params - http://core.trac.wordpress.org/ticket/17065
*
* This lets us sort by meta value desc, and have a second orderby param.
*
* @param array $args
* @return array
*/
function splendid_woocommerce_order_by_popularity_post_clauses( $args ) {
	global $wpdb;

	$args['orderby'] = "$wpdb->postmeta.meta_value+0 DESC, $wpdb->posts.post_date DESC";

	return $args;
}

/**
* order_by_rating_post_clauses function.
*
* @param array $args
* @return array
*/
function splendid_woocommerce_order_by_rating_post_clauses( $args ) {
   global $wpdb;

   $args['fields'] .= ", AVG( $wpdb->commentmeta.meta_value ) as average_rating ";

   $args['where'] .= " AND ( $wpdb->commentmeta.meta_key = 'rating' OR $wpdb->commentmeta.meta_key IS null ) ";

   $args['join'] .= "
	   LEFT OUTER JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
	   LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
   ";

   $args['orderby'] = "average_rating DESC, $wpdb->posts.post_date DESC";

   $args['groupby'] = "$wpdb->posts.ID";

   return $args;
}

/**
 * Get default posts per page value
 * @return int
 */
function splendid_wc_get_current_posts_per_page_value($force_value = null) {
	
	$posts_per_page = get_query_var( 'postsperpage' );
	
	if (empty($posts_per_page)) {
		
		if ($force_value != null && intval($force_value)) {
			$posts_per_page = $force_value;
		} else {
			$posts_per_page = ts_get_opt('shop-posts-per-page');
			if (empty($posts_per_page)) {
				$posts_per_page = get_option('posts_per_page');
			}	
		}		
	}
	return intval($posts_per_page);
}

/**
 * Limit post on products archive
 * @return type
 */
function splendid_wc_limit_archive_posts_per_page() {
	
	return splendid_wc_get_current_posts_per_page_value();
}
add_filter( 'loop_shop_per_page', 'splendid_wc_limit_archive_posts_per_page', 20 );

/**
 * Add postsperpage var to custom query
 * @param array $vars
 * @return string
 */
function splendid_wc_add_custom_query_var( $vars ){
  $vars[] = "postsperpage";
  return $vars;
}
add_filter( 'query_vars', 'splendid_wc_add_custom_query_var' );

/**
 * Get values to post per pages dropdown list
 * @return type
 */
function splendid_wc_get_posts_per_page_dropdown_values($add_value = null) {
  
	$current_value = splendid_wc_get_current_posts_per_page_value($add_value);
	
	$values = array(6,12,18,24,30);
	
	if (!in_array($current_value,$values)) {
		$values[] = $current_value;
		sort($values);
	}
	
	if (!in_array($add_value,$values)) {
		$values[] = $add_value;
		sort($values);
	}
	
	$defined_posts_per_apge = intval(ts_get_opt('shop-posts-per-page'));
	if (!empty($defined_posts_per_apge) && !in_array($defined_posts_per_apge,$values)) {
		$values[] = ts_get_opt('shop-posts-per-page');
		sort($values);
	}
	
	return $values;
}

/**
 * Custom order by array
 * @param array $sortby
 * @return string
 */
function splendid_woocommerce_catalog_orderby( $sortby ) {
	
	$sortby = array(
		'menu_order' => esc_html__('Default Order', 'splendid'),
		'popularity' => esc_html__('Popularity', 'splendid'),
		'rating' => esc_html__('Average rating', 'splendid'),
		'date' => esc_html__('Newness', 'splendid'),
		'price' => esc_html__('Price: low to high', 'splendid'),
		'price-desc' => esc_html__('Price: high to low', 'splendid')
	);
	
	return $sortby;
}

add_filter( 'woocommerce_catalog_orderby', 'splendid_woocommerce_catalog_orderby' );


function splendid_woocommerce_share() { ?>
	
	<div class="woocommerce-share-item align-center">
		<h3><?php esc_html_e('Share this Item with your friends', 'splendid'); ?></h3>
		<?php splendid_post_share(); ?>
	</div>
	<?php
}

add_action ('woocommerce_after_single_product_summary', 'splendid_woocommerce_share', 12);

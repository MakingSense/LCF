<?php

/**
 *
 * Woo Products
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_woo_products($atts, $content = '', $id = '') {

	global $wpdb, $product;

	if (!function_exists('splendid_woocommerce_enabled') || splendid_woocommerce_enabled() !== true) {
		return false;
	}

	extract(shortcode_atts(array(
		'id' => '',
		'class' => '',
		'category_id' => '',
		'orderby' => 'rand',
		'order' => 'asc',
		'show' => '',
		'limit' => '',
		'sorting_posts_per_page' => 'no',
		'pagination' => 'no'
	), $atts));

	$id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
	$class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';
	
	//adhere to paging rules
	if (get_query_var('paged')) {
		$paged = get_query_var('paged');
	} elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}
	
	
	
	$posts_per_page = get_query_var( 'postsperpage' );
	if (!empty($posts_per_page)) {
		$limit = $posts_per_page;
	}
	
	//query args
	$args = array(
		'posts_per_page' => intval($limit) ? intval($limit) : 4,
		'orderby' => 'date',
		'order' => 'DESC',
		'include' => '',
		'exclude' => '',
		'meta_key' => '',
		'meta_value' => '',
		'post_type' => 'product',
		'post_mime_type' => '',
		'post_parent' => '',
		'paged' => $paged,
		'post_status' => 'publish',
	);

	$args['meta_query'] = array();
	$args['meta_query'][] = WC()->query->stock_status_meta_query();
	$args['meta_query'] = array_filter($args['meta_query']);

	// default - menu_order
	
	if (isset( $_GET['orderby'] ) ) {
		$orderby = wc_clean( $_GET['orderby'] );
		$order = '';
	}
	
	$args['orderby'] = 'menu_order title';
	$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
	$args['meta_key'] = '';

	switch ($orderby) {
		case 'rand' :
			$args['orderby'] = 'rand';
			break;
		case 'date' :
			$args['orderby'] = 'date';
			$args['order'] = $order == 'ASC' ? 'ASC' : 'DESC';
			break;
		case 'price' :
			$args['orderby'] = "meta_value_num {$wpdb->posts}.ID";
			$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
			$args['meta_key'] = '_price';
			break;
		case 'price-desc' :
			$args['orderby'] = "meta_value_num {$wpdb->posts}.ID";
			$args['order'] = $order == 'DESC';
			$args['meta_key'] = '_price';
			break;
		case 'popularity' :
			$args['meta_key'] = 'total_sales';

			// Sorting handled later though a hook
			add_filter('posts_clauses', 'splendid_woocommerce_order_by_popularity_post_clauses');
			break;
		case 'rating' :
			// Sorting handled later though a hook
			add_filter('posts_clauses', 'splendid_woocommerce_order_by_rating_post_clauses');
			break;
		case 'title' :
			$args['orderby'] = 'title';
			$args['order'] = $order == 'DESC' ? 'DESC' : 'ASC';
			break;
	}

	switch ($show) {
		case 'featured' :
			$args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);
			break;
		case 'onsale' :
			$product_ids_on_sale = wc_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;
			$args['post__in'] = $product_ids_on_sale;
			break;
	}
	$shop = new WP_Query($args);
	
	ob_start();

	if ($shop->have_posts()) :
		?>
		<div class="woocommerce">
			
			<?php if ($pagination == 'yes' || $sorting_posts_per_page == 'yes'): ?>
			
				<div class="margin_b_30">

					<?php if ($pagination == 'yes'): ?>
					
						<p class="woocommerce-result-count">
							<?php
							$paged    = max( 1, $shop->get( 'paged' ) );
							$per_page = $shop->get( 'posts_per_page' );
							$total    = $shop->found_posts;
							$first    = ( $per_page * $paged ) - $per_page + 1;
							$last     = min( $total, $shop->get( 'posts_per_page' ) * $paged );

							if ( 1 == $total ) {
								esc_html_e( 'Showing the single result', 'woocommerce' );
							} elseif ( $total <= $per_page || -1 == $per_page ) {
								printf( esc_html__( 'Showing all %d results', 'woocommerce' ), $total );
							} else {
								printf( _x( 'Showing %1$d&ndash;%2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'woocommerce' ), $first, $last, $total );
							}
							?>
						</p>
					<?php endif; ?>
						
					<?php if ($sorting_posts_per_page == 'yes'): ?>
						<?php

							$orderby                 = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
							$show_default_orderby    = 'menu_order' === apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
							$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
								'menu_order' => esc_html__( 'Default sorting', 'woocommerce' ),
								'popularity' => esc_html__( 'Sort by popularity', 'woocommerce' ),
								'rating'     => esc_html__( 'Sort by average rating', 'woocommerce' ),
								'date'       => esc_html__( 'Sort by newness', 'woocommerce' ),
								'price'      => esc_html__( 'Sort by price: low to high', 'woocommerce' ),
								'price-desc' => esc_html__( 'Sort by price: high to low', 'woocommerce' )
							) );

							if ( ! $show_default_orderby ) {
								unset( $catalog_orderby_options['menu_order'] );
							}

							if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
								unset( $catalog_orderby_options['rating'] );
							}

							wc_get_template( 'loop/orderby.php', array( 'catalog_orderby_options' => $catalog_orderby_options, 'orderby' => $orderby, 'show_default_orderby' => $show_default_orderby, 'limit' => $limit ) );
						?>
					<?php endif; ?>
					<div class="clearfix">	</div>
				</div>
			<?php endif; ?>
			
			<?php woocommerce_product_loop_start(); ?>

			<?php
			if (function_exists('wc_get_template_part')):
				while ($shop->have_posts()) :
					$shop->the_post();
					$product = new WC_Product(get_the_ID());
					wc_get_template_part('content', 'product');
				endwhile; // end of the loop.
			endif;
			wp_reset_postdata();
			woocommerce_product_loop_end();
			
			if ( $pagination == 'yes' && $shop->max_num_pages >= 1 ): ?>
				<nav class="woocommerce-pagination">
					<?php
						echo paginate_links( apply_filters( 'woocommerce_pagination_args', array(
							'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
							'format'       => '',
							'add_args'     => '',
							'current'      => max( 1, get_query_var( 'paged' ) ),
							'total'        => $shop->max_num_pages,
							'prev_text'    => '&larr;',
							'next_text'    => '&rarr;',
							'type'         => 'list',
							'end_size'     => 3,
							'mid_size'     => 3
						) ) );
					?>
				</nav>
			<?php endif; ?>
		</div>
	<?php
	endif;

	remove_filter('posts_clauses', 'splendid_woocommerce_order_by_popularity_post_clauses');
	remove_filter('posts_clauses', 'splendid_woocommerce_order_by_rating_post_clauses');

	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

add_shortcode('rs_woo_products', 'rs_woo_products');

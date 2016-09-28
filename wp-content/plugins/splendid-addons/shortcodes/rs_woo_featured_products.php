<?php

/**
 *
 * Woo Products
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_woo_featured_products($atts, $content = '', $id = '') {

    global $wpdb, $product;

    if (!function_exists('splendid_woocommerce_enabled') || splendid_woocommerce_enabled() !== true) {
      return false;
    }
	
	extract(shortcode_atts(array(
      'id'          => '',
      'class'       => '',
      'category_id' => '',
      'orderby'     => '',
      'order'       => '',
      'limit'       => 5,
    ), $atts));

    $id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
    $class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';

    //echo 'a';

    //query args
    $args = array(
      'posts_per_page' => $limit,
      'offset' => 0,
      'orderby' => 'date',
      'cats'   => $category_id,
      'order' => 'DESC',
      'include' => '',
      'exclude' => '',
      'meta_key' => '',
      'meta_value' => '',
      'post_type' => 'product',
      'post_mime_type' => '',
      'post_parent' => '',
      'paged' => 1,
      'post_status' => 'publish',
    );

    $args['meta_query'] = array();
    $args['meta_query'][] = WC()->query->stock_status_meta_query();
    $args['meta_query'] = array_filter($args['meta_query']);

    // default - menu_order
    $args['orderby']  = 'menu_order title';
    $args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
    $args['meta_key'] = '';

    switch ( $orderby ) {
      case 'rand' :
        $args['orderby']  = 'rand';
      break;
      case 'date' :
        $args['orderby']  = 'date';
        $args['order']    = $order == 'ASC' ? 'ASC' : 'DESC';
      break;
      case 'price' :
        $args['orderby']  = "meta_value_num {$wpdb->posts}.ID";
        $args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
        $args['meta_key'] = '_price';
      break;
      case 'popularity' :
        $args['meta_key'] = 'total_sales';

        // Sorting handled later though a hook
        add_filter( 'posts_clauses', 'splendid_woocommerce_order_by_popularity_post_clauses');
      break;
      case 'rating' :
        // Sorting handled later though a hook
        add_filter( 'posts_clauses', 'splendid_woocommerce_order_by_rating_post_clauses'  );
      break;
      case 'title' :
        $args['orderby']  = 'title';
        $args['order']    = $order == 'DESC' ? 'DESC' : 'ASC';
      break;
    }

    $args['meta_query'][] = array(
      'key' => '_featured',
      'value' => 'yes'
    );

    $shop = new WP_Query($args);
	
	ob_start();

    if ( $shop -> have_posts() ) : ?>
      <div class="sc-carousel" data-items="4">
        <header class="carousel-header margin_b_60">
          <h2 class="carousel-title"><?php esc_html_e('Featured Products', 'splendid'); ?></h2>
          <nav class="carousel-nav">
            <a href="#" class="carousel-prev"><?php esc_html_e('Previous' ,'splendid'); ?></a>
            <a href="#" class="carousel-next"><?php esc_html_e('Next', 'splendid'); ?></a>
          </nav>
        </header>
        <div class="owl-carousel">
          <?php while ( $shop -> have_posts() ) :
            global $product;
            $shop -> the_post();
            $product = new WC_Product(get_the_ID());?>
          <div>
            <article class="sc-shop-product style-normal">
              <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
              <header class="img">
                <?php woocommerce_template_loop_product_thumbnail(); ?>
              </header>
              <section class="content">
                <h6 class="bold shop-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h6>
                <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
              </section>
              <footer class="shop-footer">
                <ul class="shop-meta">
                  <li><a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="btn add-to-cart"><?php esc_html_e('Add To Cart', 'splendid-addons'); ?></a></li>
                  <li><a href="<?php echo esc_url(get_permalink()); ?>" class="btn details"><?php esc_html_e('Details', 'splendid-addons'); ?></a></li>
                  <li><span class="raty-rating" data-score="<?php echo esc_attr($product->get_average_rating()); ?>" title="regular"></span></li>
                </ul>
              </footer>
            </article>
          </div>
          <?php endwhile; // end of the loop.
            wp_reset_postdata(); ?>
        </div><!-- /Owl Carousel -->
      </div>
    <?php endif;

    remove_filter( 'posts_clauses', 'splendid_woocommerce_order_by_popularity_post_clauses'  );
    remove_filter( 'posts_clauses', 'splendid_woocommerce_order_by_rating_post_clauses'  );

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('rs_woo_featured_products', 'rs_woo_featured_products');




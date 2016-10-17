<?php

/**
 *
 * Woo Products
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_woo_best_seller($atts, $content = '', $id = '') {

    global $wpdb, $product;

    if (!function_exists('splendid_woocommerce_enabled') || splendid_woocommerce_enabled() !== true) {
      return false;
    }

    extract(shortcode_atts(array(
      'id'          => '',
      'class'       => '',
      'category_id' => '',
      'limit'       => 6,
    ), $atts));

    $id = ( $id ) ? ' id="' . esc_attr($id) . '"' : '';
    $class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';

    //query args
    $args = array(
      'posts_per_page' => $limit,
      'offset'         => 0,
      'orderby'        => 'total_sales',
      'cats'           => $category_id,
      'order'          => 'ASC',
      'include'        => '',
      'exclude'        => '',
      'meta_key'       => '',
      'meta_value'     => '',
      'post_type'      => 'product',
      'post_mime_type' => '',
      'post_parent'    => '',
      'paged'          => 1,
      'post_status'    => 'publish',
    );

    $args['meta_query']   = array();
    $args['meta_query'][] = WC()->query->stock_status_meta_query();
    $args['meta_query']   = array_filter($args['meta_query']);

    // default - menu_order
    $args['orderby']  = 'total_sales';
    $args['order']    = 'ASC';
    $args['meta_key'] = '';

    $shop = new WP_Query($args);

    ob_start();

    if ( $shop -> have_posts() ) : ?>
    <h2 class="margin_b_10"><?php esc_html_e('Best Sellers', 'splendid-addons'); ?></h2>
    <div class="row">
      <?php
        while ( $shop -> have_posts() ) :
          $shop -> the_post();
          $product = new WC_Product(get_the_ID());
      ?>
      <div <?php echo esc_attr($id); ?> class="col-lg-4 col-md-6 col-sm-6 <?php echo sanitize_html_classes($class); ?>">
        <article class="sc-shop-product style-small">
          <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
          <header class="img">
            <?php woocommerce_template_loop_product_thumbnail(); ?>
            <?php woocommerce_show_product_loop_sale_flash(); ?>
          </header>
          <section class="content">
            <h6 class="bold shop-title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h6>
            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

          </section>
          <footer class="shop-footer">
            <ul class="shop-meta">
              <li><a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="btn add-to-cart"><?php esc_html_e('Add To Cart', 'splendid-addons'); ?></a></li>
              <li><a href="<?php echo esc_url(get_permalink()); ?>" class="btn details"><?php esc_html_e('Details', 'splendid-addons'); ?></a></li>
              <li><span class="raty-rating" data-score="<?php echo esc_attr($product->get_average_rating()); ?>" title="regular"></span></li>
            </ul>
          </footer>
        </article>
      </div>

      <?php endwhile; // end of the loop.
        wp_reset_postdata();
        endif; ?>
    </div>

    <?php

    remove_filter( 'posts_clauses', 'splendid_woocommerce_order_by_popularity_post_clauses'  );
    remove_filter( 'posts_clauses', 'splendid_woocommerce_order_by_rating_post_clauses'  );

    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}

add_shortcode('rs_woo_best_seller', 'rs_woo_best_seller');




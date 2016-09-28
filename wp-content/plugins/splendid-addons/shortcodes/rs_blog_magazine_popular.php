<?php
/**
 *
 * RS Blog Magazine Alt
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_magazine_popular( $atts, $content = '', $id = '' ) {

  global $paged, $post, $wp_query;

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'length'        => '40',
    'exclude_posts' => '',
    'limit'         => ''
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. $class : '';

  if( is_front_page() || is_home() ) {
    $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
  } else {
    $paged = intval( get_query_var('paged') );
  }

  $args = array(
    'paged'           => $paged,
    'orderby'         => 'comment_count',
    'posts_per_page'  => $limit,
    'meta_query'      => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
  );

  if( $cats ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field'    => 'ids',
        'terms'    => explode( ',', $cats )
      )
    );
  }

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  $query   = new WP_Query( $args );
  ob_start();

  if( $query-> have_posts() ) :?>
    <div <?php echo esc_attr($id); ?> class="sc-carousel <?php echo sanitize_html_classes($class); ?>" data-items="3">
        <header class="carousel-header margin_b_60">
          <h2 class="carousel-title"><?php esc_html_e('Most Popular Posts', 'splendid-addons'); ?></h2>
          <nav class="carousel-nav">
            <a href="#" class="carousel-prev"><?php esc_html_e('Previous', 'splendid-addons'); ?></a>
            <a href="#" class="carousel-next"><?php esc_html_e('Next', 'splendid-addons'); ?></a>
          </nav>
        </header>
        <div class="owl-carousel">
          <?php while( $query->have_posts() ) : $query->the_post(); ?>
          <div>
            <article class="sc-blog-post blog-post blog-post-standard style-normal">
              <div class="blog-post-inner">
                <div class="post-featured-image">
                  <header class="post-header">
                    <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail('ts-big-alt-7'); ?></a>
                  </header>
                </div>
                <section class="post-content">
                  <ul class="post-meta">
                    <li><?php the_time('F d, Y'); ?></li>
                    <li><?php esc_html_e('In', 'splendid-addons');?> <?php echo get_the_category_list( esc_html__( ' / ', 'splendid-addons' ) );?></li>
                  </ul>
                  <h3 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
                  <?php ts_the_excerpt_theme($length); ?>
                </section>
              </div>
            </article>
          </div>
          <?php endwhile; ?>

        </div><!-- /Owl Carousel -->
      </div>
  <?php
  endif;
  wp_reset_postdata();
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_blog_magazine_popular', 'rs_blog_magazine_popular' );


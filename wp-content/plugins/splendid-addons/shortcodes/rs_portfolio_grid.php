<?php
/**
 *
 * RS Works
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_portfolio_grid( $atts, $content = '', $id = '' ) {

  global $paged, $post;

  extract( shortcode_atts( array(
    'class'         => '',
    'cats'          => 0,
    'limit'         => '',
    'filter_cats'   => 0,
    'orderby'       => 'ID',
    'exclude_posts' => '',
  ), $atts ) );

  $class = ( $class ) ? ' '. $class: '';

  if( is_front_page() || is_home() ) {
    $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
  } else {
    $paged = intval( get_query_var('paged') );
  }

  // Query args
  $args = array(
    'paged'           => $paged,
    'orderby'         => $orderby,
    'post_type'       => 'portfolio',
    'posts_per_page'  => $limit
  );

  if( $cats ) {
    $args['tax_query'] = array(
      array(
        'taxonomy'  => 'portfolio-category',
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

  ?>

  <section id="portfolio-wrapper" class="isotope-sortable full-width <?php echo sanitize_html_classes($class); ?>">

    <div class="portfolio-filters portfolio-filters-style2 align-center margin_b_0">
      <?php
        $filter_args = array(
        'echo'     => 0,
        'title_li' => '',
        'style'    => 'none',
        'taxonomy' => 'portfolio-category',
        'walker'   => new Walker_Portfolio_List_Categories(),
        );

        if( $filter_cats ) {

        $exp_cats = explode(',',$filter_cats);
        $new_cats = array();

        foreach ( $exp_cats as $cat_value ) {
          $has_children = get_term_children( intval($cat_value), 'portfolio-category' );
          if( ! empty( $has_children ) ) {
              $new_cats[] = implode( ',', $has_children );
          } else {
              $new_cats[] = $cat_value;
          }
        }

        $filter_args['include'] = implode( ',', $new_cats );

      }

      $filter_args = wp_parse_args( $args, $filter_args );

    ?>
      <ul>
        <li class="filter active" data-filter="*"><?php esc_html_e('All', 'splendid-addons'); ?></li>
        <?php echo wp_list_categories( $filter_args ); ?>
      </ul>
    </div>

    <div class="portfolio-container isotope-container isotope-masonry row">
      <!-- IMPORTANT - Used as a 1 Column width measure for a Masonry Plugin -->
      <div class="masonry-column col-lg-1 col-md-1 col-sm-1"></div>
      <?php
        while( $query->have_posts() ) : $query->the_post();
          $hover_overlay = ts_get_post_opt('portfolio-overlay-local');
          $item_args = array(
            'hover_overlay' => $hover_overlay,
          );
          rs_portfolio_grid_item( $item_args, $args);
        endwhile;
        wp_reset_postdata();
      ?>
    </div><!--end of sc-recent projects-->
  </section>

  <?php
  $output = ob_get_clean();

  return $output;
}
add_shortcode( 'rs_portfolio_grid', 'rs_portfolio_grid' );

/**
 * Portfolio Items
 * @param type $type
 * @return type
 */
if( !function_exists('rs_portfolio_grid_item')) {
  function rs_portfolio_grid_item( $item_args, $query_args) {

    global $post;
    extract($item_args);

    $terms        = wp_get_post_terms($post->ID, 'portfolio-category', $query_args);
    $lightbox_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full');
    $term_slugs   = array();
    $term_names   = array();
    if (count($terms) > 0):
      foreach ($terms as $term):
        $term_slugs[] = $term->slug;
        $term_names[] = $term->name;
      endforeach;
    endif;
    if(has_post_thumbnail()):
    ?>

    <div class="col-md-3 isotope-item <?php echo implode(' ', $term_slugs); ?>">
      <article class="portfolio-item portfolio-item-grid portfolio-style2">
        <div class="portfolio-image panr-active">
          <?php the_post_thumbnail('ts-medium-alt-3', array('class'=> 'panr-element')); ?>
          <div class="portfolio-hover <?php echo sanitize_html_classes($hover_overlay); ?>">
            <div class="portfolio-info">
              <ul class="portfolio-categories">
                <?php echo '<li>'.implode('</li><li>', $term_names).'</li>'; ?>
              </ul>
              <h5 class="portfolio-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h5>
            </div>
          </div>
        </div>
      </article>
    </div><!-- /Column -->
    <?php 
    endif;
  }
}

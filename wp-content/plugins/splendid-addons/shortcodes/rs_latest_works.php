<?php
/**
 *
 * RS Works
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_latest_works( $atts, $content = '', $id = '' ) {

  global $paged, $post;

  extract( shortcode_atts( array(
    'class'               => '',
    'cats'                => 0,
    'filter_cats'         => 0,
    'orderby'             => '',
    'filter_align'        => 'align-left',
    'style'               => '4col_full_width',
    'filter_border_color' => '',
    'filter_text_color'   => '',
    'show_filter'         => 'yes',
    'limit'               => '',
    'use_external_url'    => 'no',
    'exclude_posts'       => '',
  ), $atts ) );

  $class                     = ( $class ) ? ' '. $class: '';
  $portfolio_container_class = ( $style == '4col_full_width' ) ? 'recent-projects full-width':'sc-recent-projects';
  $customize                 = ( $filter_border_color || $filter_text_color ) ? true:false;
  $uniqid_class              = '';

  $col_size = array(
    'col-lg-6 col-md-6 col-sm-6',
    'col-lg-3 col-md-3 col-sm-3',
    'col-lg-3 col-md-3 col-sm-3',
    'col-lg-3 col-md-3 col-sm-3',
    'col-lg-3 col-md-3 col-sm-3',
    'col-lg-6 col-md-6 col-sm-6',
    'col-lg-3 col-md-3 col-sm-3',
    'col-lg-3 col-md-3 col-sm-3',
    'col-lg-6 col-md-6 col-sm-6',
  );
  // now only for demo
  $image_size = array(
    'ts-big-alt-5',
    'ts-big-alt-5',
    'ts-big-alt-5',
    'ts-big-alt-5',
    'ts-big-alt-5',
    'ts-big-alt-5',
    'ts-big-alt-5',
    'ts-big-alt-5',
    'ts-big-alt-6',
  );

  $col_size_alt = array(
    'col-lg-8 col-md-8 col-sm-8',
    'col-lg-4 col-md-4 col-sm-4',
    'col-lg-4 col-md-4 col-sm-4',
    'col-lg-4 col-md-4 col-sm-4',
  );

  $image_size_alt = array(
    'ts-medium-h',
    'ts-medium-v',
    'ts-medium-alt-4',
    'ts-medium-alt-4',
  );
  if( $customize ) {

    $uniqid       = time().'-'.mt_rand();
    $custom_style = '';

    if($filter_text_color || $filter_border_color ) {
      $custom_style .=  '.portfolio-custom-filter-'.$uniqid.' .filter.active {';
      $custom_style .=  ( $filter_border_color ) ? 'border-color:'.$filter_border_color.' !important;':'';
      $custom_style .=  ( $filter_text_color ) ? 'color:'.$filter_text_color.' !important;':'';
      $custom_style .= '}';
    }

    ts_add_inline_style( $custom_style );

    $uniqid_class = 'portfolio-custom-filter-'. $uniqid;

  }

  $inner_wrapper = $close_div = '';

  switch ($style) {
    case '4col_half_width_title_and_category':
      $inner_wrapper = '<div class="portfolio-container sc-isotope row portfolio-4columns">';
      $close_div     =  '</div>';
      break;

    case '3col_half_width_without_title_and_category':
      $inner_wrapper = '<div class="portfolio-container sc-isotope row portfolio-3columns">';
      $close_div     =  '</div>';
      break;

    case '4col_full_width_with_carousel':
      $inner_wrapper = '<div class="sc-carousel style2" data-items="4">
      <header class="carousel-header">
      <nav class="carousel-nav">
      <a href="#" class="carousel-prev">'.esc_html__('Previous', 'splendid-addons').'</a>
      <a href="#" class="carousel-next">'.esc_html__('Next', 'splendid-addons').'</a>
      </nav>
      </header>
      <div class="owl-carousel">';

      $close_div = '</div></div>';
      break;

    case 'masonry_layout_with_different_size':
      $inner_wrapper = '<div class="sc-isotope isotope-masonry row"><div class="masonry-column col-lg-1 col-md-1 col-sm-1"></div>';
      $close_div     =  '</div>';
      break;

    case 'masonry_layout_with_space_different_size':
      $inner_wrapper = '<div class="sc-isotope isotope-masonry style2 row"><div class="masonry-column col-lg-1 col-md-1 col-sm-1"></div>';
      $close_div     =  '</div>';
      break;

    case '2col_half_width_with_title_and_category';
    default:
      $inner_wrapper = '<div class="portfolio-container sc-isotope row">';
      $close_div     =  '</div>';
      break;
  }

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
    'posts_per_page'  => $limit,
    'suppress_filters' => false
  );

  if( $cats ) {
    $cats_arr = explode( ',', $cats );
    $slugs = array();
    if (is_array($cats_arr)) {
      foreach ($cats_arr as $cat_id) {
        $cat_obj = get_category($cat_id);
        if ($cat_obj -> slug) {
          $slugs[] = $cat_obj -> slug;
        }
      }
    }

    $args['tax_query'] = array(
      array(
        'taxonomy'  => 'portfolio-category',
        'field'    => 'slug',
        'terms'    => $slugs
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

  <div class="<?php echo sanitize_html_classes($portfolio_container_class); ?><?php echo sanitize_html_classes($class); ?>">

  <?php
  if($show_filter == 'yes' && $style != '4col_full_width' && $style != '4col_full_width_with_carousel' && $style != 'masonry_layout_with_different_size' && $style != 'masonry_layout_with_space_different_size') {

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

    <div class="portfolio-filters <?php echo sanitize_html_classes($filter_align); ?> style-blue margin_b_80 <?php echo sanitize_html_classes($uniqid_class); ?>">
      <ul>
        <li class="filter active" data-filter="*"><?php esc_html_e('All', 'splendid-addons'); ?></li>
        <?php echo wp_list_categories( $filter_args ); ?>
      </ul>
    </div>

  <?php } // end of filter ?>

    <?php echo wp_kses_post($inner_wrapper); ?>

      <?php
        $i = 0;
        while( $query->have_posts() ) : $query->the_post();
          $hover_overlay = ts_get_post_opt('portfolio-overlay-local');
          $item_args = array(
            'hover_overlay' => $hover_overlay,
            'style'         => $style,
            'counter'       => $i,
          );
          rs_portfolio_item( $item_args, $args, $col_size, $image_size, $col_size_alt, $image_size_alt );
          $i++;
        endwhile;
        wp_reset_postdata();
      ?>
    <?php echo wp_kses_post($close_div); ?>
  </div><!--end of sc-recent projects-->

  <?php
  $output = ob_get_clean();

  return $output;
}
add_shortcode( 'rs_latest_works', 'rs_latest_works' );

/**
 * Portfolio Items
 * @param type $type
 * @return type
 */
if( !function_exists('rs_portfolio_item')) {
  function rs_portfolio_item( $item_args, $query_args, $col_size = '', $image_size = '', $col_size_alt = '', $image_size_alt = '' ) {

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

    switch ($style) {
      case '4col_full_width_with_carousel':
      case '4col_full_width':

      echo ( $style == '4col_full_width_with_carousel' ) ? '<div>':'';

      ?>
        <article class="portfolio-item portfolio-item-grid">
          <div class="portfolio-image">
            <?php the_post_thumbnail('ts-big-alt-5'); ?>
            <div class="portfolio-hover <?php echo sanitize_html_class($hover_overlay); ?>">
              <div>
                <div>
                  <a href="<?php echo esc_url($lightbox_url); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid-addons'); ?></a>
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid-addons'); ?></a>
                </div>
              </div>
              <div class="portfolio-info">
                <h5 class="portfolio-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h5>
                <ul class="portfolio-categories">
                  <?php echo '<li>'.implode('</li><li>', $term_names).'</li>'; ?>
                </ul>
              </div>
            </div>
          </div>
        </article>
      <?php echo ( $style == '4col_full_width_with_carousel' ) ? '</div>':'';  break;

      case '4col_half_width_title_and_category': ?>

      <div class="col-lg-3 col-md-4 col-sm-6 isotope-item <?php echo implode(' ', $term_slugs); ?>">
        <article class="portfolio-item">
          <div class="portfolio-image">
            <?php the_post_thumbnail('ts-small'); ?>
            <div class="portfolio-hover <?php echo sanitize_html_class($hover_overlay); ?>">
              <div>
                <div>
                  <a href="<?php echo esc_url($lightbox_url); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid-addons'); ?></a>
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid-addons'); ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="portfolio-content">
            <h3 class="portfolio-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
            <ul class="portfolio-categories">
              <?php echo '<li>'.implode('</li><li>', $term_names).'</li>'; ?>
            </ul>
          </div>
        </article>
        </div><!-- /Column -->

      <?php break;

      case '3col_half_width_without_title_and_category': ?>
      <div class="col-lg-4 col-md-4 col-sm-6 isotope-item <?php echo implode(' ', $term_slugs); ?>">
        <article class="portfolio-item portfolio-item-grid">
          <div class="portfolio-image">
            <?php the_post_thumbnail('ts-small'); ?>
            <div class="portfolio-hover <?php echo sanitize_html_class($hover_overlay); ?>">
              <div>
                <div>
                  <a href="<?php echo esc_url($lightbox_url); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid-addons'); ?></a>
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid-addons'); ?></a>
                </div>
              </div>
              <div class="portfolio-info">
                <h5 class="portfolio-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h5>
                <ul class="portfolio-categories">
                  <?php echo '<li>'.implode('</li><li>', $term_names).'</li>'; ?>
                </ul>
              </div>
            </div>
          </div>
        </article>
      </div><!-- /Column -->
      <?php break;

      case '2col_half_width_with_title_and_category': ?>
      <div class="col-lg-6 col-md-6 col-sm-6 isotope-item <?php echo implode(' ', $term_slugs); ?>">
        <article class="portfolio-item portfolio-item-2column">
          <div class="portfolio-image">
            <?php the_post_thumbnail('ts-big-alt-7'); ?>
            <div class="portfolio-hover <?php echo sanitize_html_class($hover_overlay); ?>">
              <div>
                <div>
                  <a href="<?php echo esc_url($lightbox_url); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid-addons'); ?></a>
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid-addons'); ?></a>
                </div>
              </div>
            </div>
          </div>
          <div class="portfolio-content">
            <h3 class="portfolio-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
            <ul class="portfolio-categories">
              <?php echo '<li>'.implode('</li><li>', $term_names).'</li>'; ?>
            </ul>
          </div>
        </article>
      </div><!-- /Column -->
      <?php break;

      case 'masonry_layout_with_different_size':
      $counter  = ( $counter < 9 ) ? $counter:0;
      ?>
      <div class="<?php echo sanitize_html_classes($col_size[$counter]); ?> isotope-item cat-logos <?php echo implode(' ', $term_slugs); ?>">
        <article class="portfolio-item portfolio-item-grid">
          <div class="portfolio-image">
            <?php the_post_thumbnail($image_size[$counter]); ?>
            <div class="portfolio-hover <?php echo sanitize_html_class($hover_overlay); ?>">
              <div>
                <div>
                  <a href="<?php echo esc_url($lightbox_url); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid-addons'); ?></a>
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid-addons'); ?></a>
                </div>
              </div>
              <div class="portfolio-info">
                <h5 class="portfolio-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h5>
                <ul class="portfolio-categories">
                  <?php echo '<li>'.implode('</li><li>', $term_names).'</li>'; ?>
                </ul>
              </div>
            </div>
          </div>
        </article>
        </div>
        <?php break;

        case 'masonry_layout_with_space_different_size':
        $counter  = ( $counter < 4 ) ? $counter:0;
        ?>
          <div class="<?php echo sanitize_html_classes($col_size_alt[$counter]); ?> isotope-item <?php echo implode(' ', $term_slugs); ?>">
            <article class="portfolio-item portfolio-item-grid">
              <div class="portfolio-image">
                <?php the_post_thumbnail($image_size_alt[$counter]); ?>
                <div class="portfolio-hover <?php echo sanitize_html_class($hover_overlay); ?>">
                  <div>
                    <div>
                      <a href="<?php echo esc_url($lightbox_url); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid-addons'); ?></a>
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid-addons'); ?></a>
                    </div>
                  </div>
                  <div class="portfolio-info">
                    <h5 class="portfolio-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h5>
                    <ul class="portfolio-categories">
                      <?php echo '<li>'.implode('</li><li>', $term_names).'</li>'; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </article>
          </div><!-- /Column -->
          <?php break;
    }
  }
}

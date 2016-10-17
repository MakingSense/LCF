<?php

/**
 *
 * RS Portfolio
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_portfolio($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'id'                      => '',
    'class'                   => '',
    'style'                   => '1',
    'variant_1'               => '1', //variant for style = 1
    'show_slider_for_gallery' => 'no', //show slider for gallery
    'variant_masonry'         => '1',
    'enable_filter'           => 'yes',
    'filter_style'            => 'standard',
    'filter_background'       => '',
    'filter_color'            => 'accent',
    'filter_title'            => '',
    'enable_pagination'       => 'yes',
    'posts_per_page'          => 10,
    'categories'              => '',
    'exclude_posts'           => '',

  ), $atts));

  $class = ( $class ) ? ' ' .$class : '';

  //paging rules
  if (get_query_var('paged')) {
    $paged = get_query_var('paged');
  } elseif (get_query_var('page')) { // applies when this page template is used as a static homepage in WP3+
    $paged = get_query_var('page');
  } else {
    $paged = 1;
  }

  //posts per page
  if (!intval($posts_per_page)) {
    $posts_per_page = 10;
  }

  $args = array(
    'numberposts'    => '',
    'posts_per_page' => $posts_per_page,
    'meta_query'     => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
    'cat'            => '',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'include'        => '',
    'exclude'        => '',
    'meta_key'       => '',
    'meta_value'     => '',
    'post_type'      => 'portfolio',
    'post_mime_type' => '',
    'post_parent'    => '',
    'paged'          => $paged,
    'post_status'    => 'publish'
  );

  if (is_array($categories)) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'portfolio-category',
        'field'    => 'id',
        'terms'    => $categories,
      ),
    );
  }

  if (!empty($exclude_posts)) {

    $exclude_posts_arr = explode(',',$exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval',$exclude_posts_arr);
    }
  }

  ob_start();

  $the_query = new WP_Query($args);
  $max_num_pages = $the_query -> max_num_pages;

  $settings = rs_portfolio_get_style_settings($style, $variant_1, $variant_masonry);
  if (isset($settings['container_class'])) {
    $class .= ' '.$settings['wrapper_class'];
  }
  ?>

  <!-- Portfolio -->
  <section id="portfolio-wrapper" class="isotope-sortable <?php echo sanitize_html_classes($class); ?>">

    <?php if ($enable_filter == 'yes'):
      $terms = get_terms('portfolio-category', array('orderby' => 'name', 'include' => $categories)); ?>
      <?php if (count($terms) > 0):
        if ($filter_style == 'alternative'):

          $filter_background_src = '';
          if (!empty($filter_background)):
            $filter_background_arr = wp_get_attachment_image_src( $filter_background, 'full');
            if (isset($filter_background_arr[0])) {
              $filter_background_src = $filter_background_arr[0];
            }
          endif;

          ?>
          <!-- Portfolio Filter -->
          <section class="page-heading bg-black filter-color-<?php echo sanitize_html_classes($filter_color); ?> style-default" <?php echo !empty($filter_background_src) ? 'style="background-image: url('.esc_url($filter_background_src).')"' : ''; ?>>
            <div class="container">
              <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5">
                  <h1><?php echo esc_html($filter_title); ?></h1>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-7">
                  <div class="portfolio-filters align-right">
                    <ul>
                      <li class="filter active" data-filter="*"><?php esc_html_e('All', 'splendid'); ?></li>
                      <?php foreach ($terms as $term): ?>
                        <li class="filter" data-filter=".cat-<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </section>
          <!-- End Portfolio Filter -->
        <?php else: ?>
          <!-- Portfolio Filter -->
          <div class="portfolio-filters filter-color-<?php echo sanitize_html_classes($filter_color); ?> align-center margin_b_80">
            <ul>
              <li class="filter active" data-filter="*"><?php esc_html_e('All', 'splendid'); ?></li>
              <?php foreach ($terms as $term): ?>
                <li class="filter" data-filter=".cat-<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
          <!-- End Portfolio Filter -->
        <?php endif;

        ?>

      <?php endif; ?>
    <?php endif; ?>

    <?php if ($the_query -> have_posts()) : ?>
      <div class="portfolio-container isotope-container row <?php echo sanitize_html_classes($settings['container_class']); ?>">

        <?php echo wp_kses_post($settings['html_addon']); ?>

        <?php /* Start the Loop */
        while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
          <?php
          $terms = wp_get_post_terms(get_the_ID(), 'portfolio-category');
          $hover_color = ts_get_post_opt('portfolio-overlay-local');
          $term_slugs = array();
          $term_names = array();
          if (count($terms) > 0):
            foreach ($terms as $term):
              $term_slugs[] = 'cat-'.$term->slug;
              $term_names[] = $term->name;
            endforeach;
          endif;

          $full_image = '';
          $full_image_arr = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_id()), 'full' );
          if (isset($full_image_arr[0]) && !empty($full_image_arr[0])) {
            $full_image = $full_image_arr[0];
          }

          $item_args = array(
            'full_image' => $full_image,
            'term_slugs' => $term_slugs,
            'term_names' => $term_names,
            'show_slider_for_gallery' => $show_slider_for_gallery,
            'columns_sequence' => $settings['columns_sequence'],
            'image_sizes_sequence' => $settings['image_sizes_sequence'],
            'hover_color' => $hover_color
          );

          //call function rs_portfolio_style_x eg. rs_portfolio_style_1_1
          if (isset($settings['callback']) && !empty($settings['callback']) && function_exists($settings['callback'])) {
            call_user_func_array($settings['callback'], array($item_args));
          }
          ?>


        <?php endwhile;
        wp_reset_postdata();
        ?>

      </div>
    <?php endif; ?>

  </section>
  <!-- End Portfolio -->
  <?php

  if ($enable_pagination == 'yes'):

    if ($settings['pagination'] == 'load-more'):
      $next_page_url = ts_next_page_url($max_num_pages);

      if (!empty($next_page_url)): ?>
        <!-- Section -->
        <section class="load-more-pagination full-width bg-dark-gray align-center padding_t_30 padding_b_30">
          <a href="<?php echo esc_url($next_page_url); ?>" id="portfolio-load-more" data-loading-text="spinner" class="button small unfilled br-semi-light color-white br-color-white"><?php esc_html_e('Load More', 'splendid'); ?></a>
        </section>
        <!-- /Section -->
      <?php endif; ?>
    <?php elseif (function_exists('splendid_paging_nav')):
      splendid_paging_nav($max_num_pages, 'portfolio-pagination');
    endif;
  endif;

  $output = ob_get_clean();
  return $output;
}

add_shortcode('rs_portfolio', 'rs_portfolio');

/**
 * Get portfolio style settings
 * @param string $style
 * @param int $variant_1
 * @param int $variant_masonry
 * @return string
 */
function rs_portfolio_get_style_settings($style, $variant_1 = 1, $variant_masonry = 1) {

  $settings = array();
  $settings['callback'] = '';
  $settings['wrapper_class'] = '';
  $settings['container_class'] = '';
  $settings['html_addon'] = '';
  $settings['pagination'] = 'default';
  $settings['columns_sequence'] = array(); //for styles where columns are not the same
  $settings['image_sizes_sequence'] = ''; //for styles where image sizes are not the same

  switch ($style) {

    case 2:
      $settings['callback'] = 'rs_portfolio_style_2';
      $settings['wrapper_class'] = 'portfolio-2columns padding_t_60 padding_b_50';
      break;

    case 3:
      $settings['callback'] = 'rs_portfolio_style_3';
      $settings['wrapper_class'] = 'portfolio-3columns padding_t_60 padding_b_50';
      break;

    case 4:
      $settings['callback'] = 'rs_portfolio_style_4';
      $settings['wrapper_class'] = 'portfolio-4columns padding_t_60 padding_b_50';
      break;

    case 5:
      $settings['callback'] = 'rs_portfolio_style_5';
      $settings['wrapper_class'] = 'portfolio-5columns padding_t_60 padding_b_50';
      break;

    case 'grid':
      $settings['callback'] = 'rs_portfolio_style_grid';
      $settings['wrapper_class'] = 'full-width';
      $settings['container_class'] = 'isotope-masonry';
      $settings['html_addon'] = '<!-- IMPORTANT - Used as a 1 Column width measure for a Masonry Plugin --><div class="masonry-column col-lg-1 col-md-1 col-sm-1"></div>';
      $settings['pagination'] = 'load-more';
      break;

    case 'masonry':

      $settings['html_addon'] = '<!-- IMPORTANT - Used as a 1 Column width measure for a Masonry Plugin --><div class="masonry-column col-lg-1 col-md-1 col-sm-1"></div>';
      $settings['pagination'] = 'load-more';

      if ($variant_masonry == 2) {
        $settings['callback'] = 'rs_portfolio_style_masonry_2';
        $settings['wrapper_class'] = 'full-width';
        $settings['container_class'] = 'isotope-masonry';
        $settings['columns_sequence'] = array(6,3,3,3,3,3,3,6,6);
		
		$settings['image_sizes_sequence'] = array(
          'ts-big-alt-3',
          'ts-big-alt-3',
          'ts-big-alt-3',
          'ts-big-alt-3',
          'ts-big-alt-3',
          'ts-big-alt-3',
          'ts-big-alt-3',
          'ts-big-alt-3',
          'ts-big-alt-h',
        );

      } else {
        $settings['callback'] = 'rs_portfolio_style_masonry_1';
        $settings['wrapper_class'] = 'padding_t_60 padding_b_50';
        $settings['container_class'] = 'isotope-masonry';
        $settings['columns_sequence'] = array(8,4,4,4,4,8,4,4);
        $settings['image_sizes_sequence'] = array(
          'ts-medium-h',
          'ts-medium-v',
          'ts-medium-alt-4',
          'ts-medium-alt-4',
          'ts-medium-v',
          'ts-medium-h',
          'ts-medium-alt-4',
          'ts-medium-alt-4',
        );
      }

      $oArgs = ThemeArguments::getInstance('rs_portfolio');
      $oArgs -> set('columns_sequence', 0);
      $oArgs -> set('image_sizes_sequence', 0);

      break;

    case 1:
    default:
      if ($variant_1 == 2) {
        $settings['callback'] = 'rs_portfolio_style_1_2';
        $settings['wrapper_class'] = 'portfolio-1column padding_t_60 padding_b_50';
      } else {
        $settings['callback'] = 'rs_portfolio_style_1_1';
        $settings['wrapper_class'] = 'portfolio-1column portfolio-1columnd-ext padding_t_60 padding_b_50';
      }
      break;
  }
  return $settings;
}

/**
 * Style - 1 Column, Variant - 1
 * @param type $args
 */
function rs_portfolio_style_1_1($args) {

  extract($args); ?>

  <div class="col-lg-12 col-md-12 col-sm-12 isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item portfolio-item-ext">
      <?php rs_portfolio_part_image('ts-big-alt-7', $full_image, $hover_color); ?>
      <div class="portfolio-content">
        <?php rs_portfolio_part_content($term_names); ?>
        <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more button bg-dark-gray color-white"><?php esc_html_e('View Project', 'splendid'); ?></a>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}

/**
 * Style - 1 Column, Variant - 2
 * @param type $args
 */
function rs_portfolio_style_1_2($args) {

  extract($args); ?>

  <div class="col-lg-12 col-md-12 col-sm-12 isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item portfolio-item-v2">
      <?php rs_portfolio_part_image('ts-big-alt-h', $full_image, $hover_color); ?>
      <div class="portfolio-content">
        <div class="portfolio-info">
          <?php rs_portfolio_part_content($term_names); ?>
        </div>
        <div class="portfolio-actions">
          <a href="<?php echo esc_url(get_permalink()); ?>" class="read-more button bg-dark-gray color-white"><?php esc_html_e('View Project', 'splendid'); ?></a>
        </div>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}

/**
 * Style - 2 Columns
 * @param type $args
 */
function rs_portfolio_style_2($args) {

  extract($args); ?>
  <div class="col-lg-6 col-md-6 col-sm-6 isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item">
      <?php rs_portfolio_part_image('ts-big-alt-7', $full_image, $hover_color); ?>
      <div class="portfolio-content">
        <?php rs_portfolio_part_content($term_names); ?>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}

/**
 * Style - 3 Columns
 * @param type $args
 */
function rs_portfolio_style_3($args) {

  extract($args); ?>

  <div class="col-lg-4 col-md-4 col-sm-6 isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item portfolio-item-grid">
      <div class="portfolio-image">
        <?php if ( has_post_thumbnail() ):
          the_post_thumbnail('ts-big-alt-5');
        endif; ?>
        <div class="portfolio-hover <?php echo sanitize_html_classes($hover_color); ?>">
          <div>
            <div>
              <a href="<?php echo esc_url($full_image); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid'); ?></a>
              <a href="<?php echo esc_url(get_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid'); ?></a>
            </div>
          </div>
          <div class="portfolio-info">
            <?php rs_portfolio_part_content($term_names, 'h5'); ?>
          </div>
        </div>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}

/**
 * Style - 4 Columns
 * @param type $args
 */
function rs_portfolio_style_4($args) {

  extract($args); ?>

  <div class="col-lg-3 col-md-4 col-sm-6 isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item">
      <?php

      //gallery slider
      $gallery = null;
      if ($show_slider_for_gallery == 'yes'):
        $gallery = ts_get_post_opt_slides('portfolio-gallery');
      endif; ?>
      <?php if (is_array($gallery)): ?>
        <div class="portfolio-image">
          <div class="flexslider post-gallery">
            <ul class="slides">
              <?php foreach ($gallery as $item): ?>
                <li>
                  <?php if (isset($item['attachment_id'])):
                    echo wp_get_attachment_image( $item['attachment_id'], 'ts-small', array('alt' => esc_attr($item['title'])) );
                  endif; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php else:
        //thumbnail image
        rs_portfolio_part_image('ts-small', $full_image, $hover_color); ?>
      <?php endif; ?>


      <div class="portfolio-content">
        <?php rs_portfolio_part_content($term_names); ?>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}


/**
 * Style - 5 Columns
 * @param type $args
 */
function rs_portfolio_style_5($args) {

  extract($args); ?>

  <div class="col-lg-one-fifth col-md-3 col-sm-4 isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item">
      <?php rs_portfolio_part_image('ts-small', $full_image, $hover_color); ?>
      <div class="portfolio-content">
        <?php rs_portfolio_part_content($term_names); ?>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}

/**
 * Style - Grid
 * @param type $args
 */
function rs_portfolio_style_grid($args) {

  extract($args); ?>
  <div class="col-lg-3 col-md-4 col-sm-6 isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item portfolio-item-grid">
      <div class="portfolio-image">
        <?php if ( has_post_thumbnail() ):
          the_post_thumbnail('ts-big-alt-3');
        endif; ?>
        <div class="portfolio-hover <?php echo sanitize_html_classes($hover_color); ?>">
          <div>
            <div>
              <a href="<?php echo esc_url($full_image); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid'); ?></a>
              <a href="<?php echo esc_url(get_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid'); ?></a>
            </div>
          </div>
          <div class="portfolio-info">
            <?php rs_portfolio_part_content($term_names,'h5'); ?>
          </div>
        </div>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}

/**
 * Style - Masonry, Variant - 1
 * @param type $args
 */
function rs_portfolio_style_masonry_1($args) {

  extract($args);

  $oArgs = ThemeArguments::getInstance('rs_portfolio');
  $it_columns_sequence = intval($oArgs -> get('columns_sequence'));
  $it_image_sizes_sequence = intval($oArgs -> get('image_sizes_sequence'));

  $col = 4;
  if (is_array($columns_sequence)) {
    if ($it_columns_sequence >= count($columns_sequence)) {
      $it_columns_sequence = 0;
    }
    if (isset($columns_sequence[$it_columns_sequence])) {
      $col = $columns_sequence[$it_columns_sequence];
    }
  }

  $image_size = 'ts-medium-alt-4';
  if (is_array($image_sizes_sequence)) {
    if ($it_image_sizes_sequence >= count($image_sizes_sequence)) {
      $it_image_sizes_sequence = 0;
    }
    if (isset($image_sizes_sequence[$it_image_sizes_sequence])) {
      $image_size = $image_sizes_sequence[$it_image_sizes_sequence];
    }
  }

  $oArgs -> set('columns_sequence', $it_columns_sequence + 1);
  $oArgs -> set('image_sizes_sequence', $it_image_sizes_sequence + 1);

  ?>

  <div class="<?php echo sanitize_html_classes('col-lg-'.$col.' col-md-'.$col.' col-sm-'.$col.''); ?> isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item portfolio-item-grid">
      <div class="portfolio-image">
        <?php if ( has_post_thumbnail() ):
          the_post_thumbnail($image_size);
        endif; ?>
        <div class="portfolio-hover <?php echo sanitize_html_classes($hover_color); ?>">
          <div>
            <div>
              <a href="<?php echo esc_url($full_image); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid'); ?></a>
              <a href="<?php echo esc_url(get_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid'); ?></a>
            </div>
          </div>
          <div class="portfolio-info">
            <?php rs_portfolio_part_content($term_names,'h5'); ?>
          </div>
        </div>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}

/**
 * Style - Masonry, Variant - 2
 * @param type $args
 */
function rs_portfolio_style_masonry_2($args) {

  extract($args);

  $oArgs = ThemeArguments::getInstance('rs_portfolio');
  $it_columns_sequence = intval($oArgs -> get('columns_sequence'));
  $it_image_sizes_sequence = intval($oArgs -> get('image_sizes_sequence'));

  $col = 3;
  if (is_array($columns_sequence)) {
    if ($it_columns_sequence >= count($columns_sequence)) {
      $it_columns_sequence = 0;
    }
    if (isset($columns_sequence[$it_columns_sequence])) {
      $col = $columns_sequence[$it_columns_sequence];
    }
  }

  $image_size = 'ts-big-alt-3';
  if (is_array($image_sizes_sequence)) {
    if ($it_image_sizes_sequence >= count($image_sizes_sequence)) {
      $it_image_sizes_sequence = 0;
    }
    if (isset($image_sizes_sequence[$it_image_sizes_sequence])) {
      $image_size = $image_sizes_sequence[$it_image_sizes_sequence];
    }
  }

  $oArgs -> set('columns_sequence', $it_columns_sequence + 1);
  $oArgs -> set('image_sizes_sequence', $it_image_sizes_sequence + 1);

  ?>

  <div class="<?php echo sanitize_html_classes('col-lg-'.$col.' col-md-'.$col.' col-sm-'.$col.''); ?> isotope-item <?php echo sanitize_html_classes(implode(' ', $term_slugs)); ?>">
    <article class="portfolio-item portfolio-item-grid">
      <div class="portfolio-image">
        <?php if ( has_post_thumbnail() ):
          the_post_thumbnail($image_size);
        endif; ?>
        <div class="portfolio-hover <?php echo sanitize_html_classes($hover_color); ?>">
          <div>
            <div>
              <a href="<?php echo esc_url($full_image); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid'); ?></a>
              <a href="<?php echo esc_url(get_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid'); ?></a>
            </div>
          </div>
          <div class="portfolio-info">
            <?php rs_portfolio_part_content($term_names,'h5'); ?>
          </div>
        </div>
      </div>
    </article>
  </div><!-- /Column -->
  <?php
}

/**
 * Image part
 * @param type $image_size
 * @param type $full_image
 */
function rs_portfolio_part_image($image_size, $full_image, $hover_color) { ?>
  <div class="portfolio-image">
    <?php if ( has_post_thumbnail() ):
      the_post_thumbnail($image_size);
    endif; ?>
    <div class="portfolio-hover <?php echo sanitize_html_classes($hover_color); ?>">
      <div>
        <div>
          <a href="<?php echo esc_url($full_image); ?>" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon"><?php esc_html_e('Zoom', 'splendid'); ?></a>
          <a href="<?php echo esc_url(get_permalink()); ?>" class="portfolio-hover-button arrow-icon"><?php esc_html_e('View Project', 'splendid'); ?></a>
        </div>
      </div>
    </div>
  </div>
  <?php
}

function rs_portfolio_part_content($term_names = '', $h = 'h3') { ?>
  <<?php echo esc_attr($h); ?> class="portfolio-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></<?php echo esc_attr($h); ?>>
  <?php if (is_array($term_names) && count($term_names) > 0): ?>
    <ul class="portfolio-categories">
      <?php echo '<li>'.implode('</li><li>', $term_names).'</li>'; ?>
    </ul>
  <?php endif; ?>
  <?php
}

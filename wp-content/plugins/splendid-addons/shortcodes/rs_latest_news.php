<?php
/**
 *
 * RS Latest News
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_latest_news( $atts, $content = '', $id = '' ) {

  global $paged, $post;

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'style'         => 'squared',
    'cats'          => 0,
    'orderby'       => '',
    'header'        => '',
    'layout'        => 'hor',
    'length'        => '17',
    'btn_text'      => '',
    'exclude_posts' => '',
    'title_color'   => '',
    'meta_color'    => '',
    'content_color' => '',
    'limit'         => '',
    'show_date'     => 'yes',
    'show_author'   => 'no',
    'show_comment'  => 'yes',
    'load_more'     => 'no',
  ), $atts ) );

  $id               = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class            = ( $class ) ? ' '. $class : '';
  $el_content_style = ( $content_color ) ? 'color:'.$content_color.';':'';
  $el_title_style   = ( $title_color ) ? 'color:'.$title_color.';':'';
  $el_meta_style    = ( $meta_color ) ? 'color:'.$meta_color.';':'';

  if( is_front_page() || is_home() ) {
    $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
  } else {
    $paged = intval( get_query_var('paged') );
  }

  $args = array(
    'paged'           => $paged,
    'orderby'         => $orderby,
    'posts_per_page'  => $limit
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
        'taxonomy' => 'category',
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
  $max_num_pages = $query -> max_num_pages;
  ob_start();

  $item_args = array(
    'style'            => $style,
    'class'            => $class,
    'length'           => $length,
    'btn_text'         => $btn_text,
    'el_content_style' => $el_content_style,
    'el_title_style'   => $el_title_style,
    'el_meta_style'    => $el_meta_style,
  );

  if($style != 'with_out_featured_img') {
    if( $style == 'masonry' ) {
      echo ( !empty($header) ) ? '<h2 class="margin_b_50">'.esc_html($header).'</h2>':'';
      echo '<div class="container'.$class.'">';
      echo '<div class="row">';
      echo '<div class="sc-isotope isotope-masonry"><div class="masonry-column col-lg-1 col-md-1 col-sm-1"></div>';
    }
    echo ( $layout == 'hor' && $style == 'squared' ) ? '<div '.$id.' class="blog-posts-squared'.$class.'">':'';
    $i = 0;
    while( $query->have_posts() ) : $query->the_post();
      echo ($i % 2 == 0 && $layout == 'hor' && $style == 'squared') ? '<div class="posts-row">':'';
        rs_blog_item( $item_args );
      echo  (++$i % 2 == 0 && $layout == 'hor' && $style == 'squared'  ) ? '</div>':'';
    endwhile;
    wp_reset_postdata();
    echo ( $layout == 'hor' && $style == 'squared' ) ? '</div>':'';
    echo ( $style == 'masonry' ) ? '</div>':'';
    echo ( $style == 'masonry' ) ? '</div>':'';
    echo ( $style == 'masonry' ) ? '</div>':'';
  } else {
    echo '<div class="latest-posts">';
      echo '<div class="latest-post-row">';
      while( $query->have_posts() ) : $query->the_post();
        rs_blog_item($item_args);
      endwhile;
      wp_reset_postdata();
    echo '</div>';
    $next_page_url = ts_next_page_url($max_num_pages);
    if(!empty($next_page_url) && $load_more == 'yes') {        
      echo '<section class="full-width bg-gallery align-center padding_t_50 padding_b_50">';
        echo '<a href="'.esc_url($next_page_url).'" id="latest-blog-load-more" data-loading-text="spinner" class="button style2 medium color-white bg-blue">'.esc_html__('Load More', 'splendid-addons').'</a>';
      echo '</section>';
    }
    echo '</div>';
  }

  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_latest_news', 'rs_latest_news' );

/**
 * Part of blog shortcode
 * @param type $type
 * @return type
 */
if( !function_exists('rs_blog_item')) {
  function rs_blog_item( $item_args ) {
    extract($item_args);
    switch ($style) {
      case 'squared': ?>
        <article class="sc-blog-post blog-post style-squared <?php echo sanitize_html_classes($class); ?>">
          <div class="blog-post-inner">
            <div class="post-featured-image">
              <header class="post-header">
                <?php 
                if(has_post_thumbnail()): ?>
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank">
                    <?php the_post_thumbnail('thumbnail'); ?>
                  </a>
                <?php endif;?>
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="button read-more bg-dark-gray color-white extended small" data-text="<?php echo esc_attr__('Read More', 'splendid-addons'); ?>"><span><?php esc_html_e('Read More', 'splendid-addons'); ?></span></a>
              </header>
            </div>
            <section class="post-content">
              <?php if($show_author == 'yes' || $show_comment == 'yes' || $show_date == 'yes'): ?>
                <ul class="post-meta" <?php echo (!empty($el_meta_style) ? 'style="'.esc_attr($el_meta_style).'"' : '' ); ?>>
                  <?php if($show_date == 'yes'): ?>
                    <li><?php the_time('F j, Y'); ?></li>
                  <?php endif; ?>
                  <?php if($show_author == 'yes'): ?>
                    <li><?php esc_html_e('By', 'splendid-addons');?>
                      <?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
                      <?php if ($author_url): ?>
                        <a <?php echo (!empty($el_meta_style) ? 'style="'.esc_attr($el_meta_style).'"' : '' ); ?> href="<?php echo esc_url($author_url); ?>">
                      <?php endif; ?>
                      <?php echo get_the_author(); ?>
                      <?php if ($author_url): ?>
                        </a>
                      <?php endif; ?>
                    </li>
                  <?php endif; ?>
                  <?php if($show_comment == 'yes'): ?>
                    <li><?php comments_number( esc_html__('No Comments','splendid-addons'), esc_html__('1 Comment','splendid-addons'), esc_html__('% Comments','splendid-addons') ); ?></li>
                  <?php endif; ?>
                </ul>
              <?php endif;?>
              <h3 class="post-title"><a <?php echo (!empty($el_title_style) ? 'style="'.esc_attr($el_title_style).'"' : '' ); ?> href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h3>
              <div class="post-excerpt" <?php echo (!empty($el_content_style) ? 'style="'.esc_attr($el_content_style).'"' : '' ); ?>><?php ts_the_excerpt_theme($length); ?></div>
            </section>
          </div>
        </article>
        <?php break;

        case 'with_out_featured_img': ?>
        <div class="latest-post col-md-6">
          <article>
            <header>
              <time <?php echo (!empty($el_meta_style) ? 'style="'.esc_attr($el_meta_style).'"' : '' ); ?> datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
              <div class="categories">
                <p <?php echo (!empty($el_meta_style) ? 'style="'.esc_attr($el_meta_style).'"' : '' ); ?>><?php esc_html_e('In', 'splendid-addons'); ?></p>
                <ul <?php echo (!empty($el_meta_style) ? 'style="'.esc_attr($el_meta_style).'"' : '' ); ?>>
                  <?php echo get_the_category_list( esc_html__( ' / ', 'splendid-addons' ) );?>
                </ul>
              </div>
              <h2><a <?php echo (!empty($el_title_style) ? 'style="'.esc_attr($el_title_style).'"' : '' ); ?> href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
            </header>
            <div class="contents">
              <div class="post-excerpt" <?php echo (!empty($el_content_style) ? 'style="'.esc_attr($el_content_style).'"' : '' ); ?>><?php ts_the_excerpt_theme($length); ?></div>
              <a href="<?php echo esc_url(get_the_permalink()); ?>" data-text="<?php echo esc_attr($btn_text); ?>" class="read-more"><span><?php echo esc_attr($btn_text); ?></span></a>
            </div><!-- /contents -->
          </article>
        </div>
        <?php break;

      case 'masonry':
      default: ?>
        <div class="col-lg-4 col-md-4 col-sm-4 isotope-item">
          <article class="sc-blog-post blog-post blog-post-masonry">
            <div class="blog-post-inner">
              <?php if(has_post_thumbnail()): ?>
                <header class="post-header">
                  <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank">
                    <?php the_post_thumbnail('ts-big-alt-7'); ?>
                  </a>
                </header>
              <?php endif; ?>
              <section class="post-content">
                <?php if($show_author == 'yes' || $show_comment == 'yes' || $show_date == 'yes'): ?>
                  <ul class="post-meta" <?php echo (!empty($el_meta_style) ? 'style="'.esc_attr($el_meta_style).'"' : '' ); ?>>
                    <?php if($show_date == 'yes'): ?>
                      <li><?php the_time('F j, Y'); ?></li>
                    <?php endif; ?>
                    <?php if($show_comment == 'yes'): ?>
                      <li><?php esc_html_e('In', 'splendid-addons');?> <?php echo get_the_category_list( esc_html__( ' / ', 'splendid-addons' ) );?></li>
                    <?php endif; ?>
                    <?php if($show_author == 'yes'): ?>
                      <li><?php esc_html_e('By', 'splendid-addons');?>
                        <?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
                        <?php if ($author_url): ?>
                          <a <?php echo (!empty($el_meta_style) ? 'style="'.esc_attr($el_meta_style).'"' : '' ); ?> href="<?php echo esc_url($author_url); ?>">
                        <?php endif; ?>
                        <?php echo get_the_author(); ?>
                        <?php if ($author_url): ?>
                          </a>
                        <?php endif; ?>
                      </li>
                    <?php endif; ?>
                  </ul>
                <?php endif; ?>
                <h4 class="post-title"><a <?php echo (!empty($el_title_style) ? 'style="'.esc_attr($el_title_style).'"' : '' ); ?> href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>
                <div class="post-excerpt" <?php echo (!empty($el_content_style) ? 'style="'.esc_attr($el_content_style).'"' : '' ); ?>><?php ts_the_excerpt_theme($length); ?></div>
              </section>
            </div>
          </article>
        </div>
      <?php break;
    }
  }
}

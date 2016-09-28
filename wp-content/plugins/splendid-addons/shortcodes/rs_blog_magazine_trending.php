<?php

/**
 *
 * RS Blog Magazine Trending
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_magazine_trending($atts, $content = '', $id = '') {

  global $post;

  extract(shortcode_atts(array(
    'id'            => '',
    'class'         => '',
    'header'        => '',
    'style'         => 'style1',
    'cats'          => 0,
    'orderby'       => 'ID',
    'length'        => 20,
    'exclude_posts' => '',
    'limit'         => ''
  ), $atts));

  $class = ( $class ) ? ' ' . $class : '';

  // Query args
  $args = array(
    'orderby' => $orderby,
    'posts_per_page' => $limit,
    'meta_query' => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
  );

  if ($cats) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'category',
        'field' => 'ids',
        'terms' => explode(',', $cats)
      )
    );
  }

  if (!empty($exclude_posts)) {
    $exclude_posts_arr = explode(',', $exclude_posts);
    if (is_array($exclude_posts_arr) && count($exclude_posts_arr) > 0) {
      $args['post__not_in'] = array_map('intval', $exclude_posts_arr);
    }
  }

  switch ($style) {
    case 'style1':
      $loop          = 4;
      $outer_class   = 'row';
      $inner_class   = 'col-lg-3 col-md-3 col-sm-4';
      $article_class = 'sc-blog-post blog-post style-trending';
      $image_size    = 'ts-medium-alt-4';
      $add_thumb     = false;
      $heading_tag   = 'h5';
      $excerpt       = false;
      break;
    case 'style2':
    default:
      $loop        = 1;
      $outer_class = 'row-trending';
      $inner_class = 'style2-trending post';
      $article_class = 'sc-blog-post blog-post blog-post-standard style-normal';
      $image_size  = 'ts-big-alt-7';
      $add_thumb   = true;
      $heading_tag = 'h3';
      $excerpt     = true;
      break;
  }

  $query = new WP_Query($args);
  ob_start();

  ?>

  <!--Blog Magazine -->
  <div <?php echo ( $id ? ' id="' . esc_attr($id) . '"' : ''); ?> class="blog-magazine-trending <?php echo sanitize_html_classes($class); ?>">

    <?php if (!empty($header) && $style == 'style1'): ?>
      <h2 class="margin_b_60"><?php echo esc_html($header); ?></h2>
    <?php endif; ?>

    <!-- Blog Posts -->
    <div class="<?php echo sanitize_html_classes($outer_class); ?>">
      <?php
      if ($query -> have_posts()) :
        for ($i = 0; $i < $loop; $i ++):
        $query -> the_post(); ?>

        <div class="<?php echo sanitize_html_classes($inner_class); ?>">

          <article class="<?php echo sanitize_html_classes($article_class); ?>">
            <div class="post-featured-image">
              <header class="post-header">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail($image_size); ?></a>
              </header>
            </div>
            <section class="post-content">
              <ul class="post-meta">
                <li><?php the_time('F d, Y'); ?></li>
                <li><?php esc_html_e('In', 'splendid-addons');?> <?php echo get_the_category_list( esc_html__( ' / ', 'splendid-addons' ) );?></li>
                <?php if($style == 'style2'): ?>
                <li><?php esc_html_e('By', 'splendid-addons');?>
                  <?php $author_url = get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>
                  <?php if ($author_url): ?>
                    <a href="<?php echo esc_url($author_url); ?>">
                  <?php endif; ?>
                  <?php echo get_the_author(); ?>
                  <?php if ($author_url): ?>
                    </a>
                  <?php endif; ?>
                </li>
                <?php endif; ?>
              </ul>
              <<?php echo esc_attr($heading_tag); ?> class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></<?php echo esc_attr($heading_tag); ?>>
              <?php if($excerpt) { ts_the_excerpt_theme($length); } ?>
            </section>
          </article>
        </div>
        <?php
          if (!$query -> have_posts()) :
            break;
          endif; ?>
        <?php endfor; ?>
      <?php endif; ?>
    </div>
    <!-- End Blog Posts -->

    <?php

    $small_previews_count = $query -> post_count - 1;


    if ($query -> have_posts() && $small_previews_count > 0):

      $posts_per_column = ceil($small_previews_count / 4);
      ?>
      <!-- Trending Post -->
      <div class="<?php echo sanitize_html_classes($outer_class); ?>">
        <?php for ($k = 0; $k < $loop; $k ++): ?>
          <div class="<?php echo sanitize_html_classes($inner_class); ?>">

            <?php for ($i = 0; $i < $posts_per_column; $i++):

              if (!$query -> have_posts()) :
                break;
              endif;
              $query -> the_post();
              $border_class = ( $i == 0 ) ? ' top-border':'';
              if($add_thumb):
              ?>
                <article class="sc-blog-post blog-post style-trending style-list <?php echo sanitize_html_classes($border_class); ?>">
                <div class="blog-post-inner">
                  <div class="post-featured-image">
                    <header class="post-header">
                      <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail('ts-medium-alt-4'); ?></a>
                    </header>
                  </div>
                  <section class="post-content">
                    <h6 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h6>
                    <ul class="post-meta">
                      <li><?php the_time('F d, Y'); ?></li>
                    </ul>
                  </section>
                </div>
              </article>
              <?php else: ?>
                <article class="sc-blog-post blog-post style-trending <?php echo sanitize_html_classes($border_class); ?>">
                <section class="post-content">
                  <ul class="post-meta">
                    <li><?php the_time('F d, Y'); ?></li>
                    <li><?php esc_html_e('In', 'splendid-addons');?> <?php echo get_the_category_list( esc_html__( ' / ', 'splendid-addons' ) );?></li>
                  </ul>
                  <h5 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h5>
                </section>
              </article>
            <?php endif; ?>
            <?php endfor; ?>
          </div>
        <?php endfor; ?>
      </div>
      <!-- End trending post -->
    <?php endif; ?>
  </div>
  <!-- End Blog Magazine -->

  <?php
  wp_reset_postdata();

  $output = ob_get_clean();
  return $output;
}

add_shortcode('rs_blog_magazine_trending', 'rs_blog_magazine_trending');

<?php
/**
 *
 * RS Blog Magazine Alt
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_magazine_alt( $atts, $content = '', $id = '' ) {

  global $paged, $post;

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'style'         => 'style1',
    'cats'          => 0,
    'orderby'       => '',
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
    'orderby'         => $orderby,
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

  $item_args = array('style' => $style, 'length' => $length, 'id' => $id, 'class' => $class);

  if( $query->have_posts() ) :
      while( $query->have_posts() ) : $query->the_post();
        rs_blog_magazine_item_alt($item_args);
      endwhile;
  endif;

  wp_reset_postdata();
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_blog_magazine_alt', 'rs_blog_magazine_alt' );

/**
 *
 * RS Blog Magazine Item
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if(!function_exists('rs_blog_magazine_item_alt')) {
  function rs_blog_magazine_item_alt($item_args = array()) {
    extract($item_args);
    switch ($style) {
      case 'style1': ?>
        <article <?php echo esc_attr($id); ?> class="sc-blog-post blog-post blog-post-medium style-alt <?php echo sanitize_html_classes($class); ?>">
          <div class="blog-post-inner">
            <aside class="post-side">
              <div class="post-date">
                <span class="day"><?php the_time('d'); ?></span>
                <span><?php the_time('M, Y'); ?></span>
              </div>
              <div class="post-format">
                <span class="format-image"></span>
              </div>
              <a href="<?php echo esc_url(get_the_permalink()); ?>" class="button read-more bg-dark-gray color-white extended small" data-text="<?php echo esc_attr__('Read More', 'splendid-addons'); ?>"><span><?php esc_html_e('Read More', 'splendid-addons'); ?></span></a>
            </aside>
            <div class="post-featured-image">
              <header class="post-header">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail('ts-medium-alt-4'); ?></a>
              </header>
            </div>
            <section class="post-content">
              <ul class="post-meta">
                <li><?php esc_html_e('In', 'splendid-addons');?> <?php echo get_the_category_list( esc_html__( ' / ', 'splendid-addons' ) );?></li>
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
                <li><?php comments_number( esc_html__('No Comments','splendid-addons'), esc_html__('1 Comment','splendid-addons'), esc_html__('% Comments','splendid-addons') ); ?></li>
              </ul>
              <h2 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
              <?php ts_the_excerpt_theme($length); ?>
            </section>
          </div>
        </article>
        <?php break;
      case 'style2': ?>
        <article class="sc-blog-post blog-post style-list">
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
      <?php break;

      case 'style3': ?>
        <article class="sc-blog-post blog-post blog-post-medium">
          <div class="blog-post-inner">
            <div class="post-featured-image">
              <header class="post-header">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail('ts-medium-alt-4'); ?></a>
              </header>
            </div>
            <section class="post-content">
              <ul class="post-meta">
                <li><?php the_time('F d, Y'); ?></li>
                <li><?php esc_html_e('In', 'splendid-addons');?> <?php echo get_the_category_list( esc_html__( ' / ', 'splendid-addons' ) );?></li>
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
              </ul>
              <h3 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
              <?php ts_the_excerpt_theme($length); ?>
            </section>
          </div>
        </article>
      <?php break;

      case 'style4': ?>
        <article class="sc-blog-post blog-post blog-post-standard">
          <div class="blog-post-inner">
            <div class="post-featured-image">
              <header class="post-header">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail('ts-big-alt-7'); ?></a>
                <?php $url = ts_get_post_opt('post-video-url'); if(get_post_format() == 'video' && !empty($url)):  ?>
                  <a href="<?php echo esc_url($url); ?>" class="video-play-button" data-gal="prettyPhoto"><?php esc_html_e('Play Video', 'splendid-addons'); ?></a>
                <?php endif; ?>
              </header>
            </div>
            <section class="post-content">
              <ul class="post-meta">
                <li><?php esc_html_e('In', 'splendid-addons');?> <?php echo get_the_category_list( esc_html__( ' / ', 'splendid-addons' ) );?></li>
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
                <li><?php comments_number( esc_html__('No Comments','splendid-addons'), esc_html__('1 Comment','splendid-addons'), esc_html__('% Comments','splendid-addons') ); ?></li>
              </ul>
              <h2 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h2>
              <?php ts_the_excerpt_theme($length); ?>
            </section>
          </div>
        </article><!-- /Post -->
      <?php break;
      default:
        # code...
        break;
    }
  }
}


<?php
/**
 *
 * RS Blog Magazine
 * @since 1.0.0
 * @version 1.1.0
 *
 */
function rs_blog_magazine( $atts, $content = '', $id = '' ) {

  global $paged, $post;

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'style'         => 'style1',
    'orderby'       => '',
    'length'        => '40',
    'exclude_posts' => ''
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. $class : '';
  $limit  = ( $style == 'style1') ? '4':'1';

  if( is_front_page() || is_home() ) {
    $paged = ( get_query_var('paged') ) ? intval( get_query_var('paged') ) : intval( get_query_var('page') );
  } else {
    $paged = intval( get_query_var('paged') );
  }

  $args = array(
    'paged'           => $paged,
    'orderby'         => $orderby,
    'posts_per_page'  => $limit,
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

  $latest  = new WP_Query( $args );
  ob_start();

  if ($latest->have_posts()):
    if($style == 'style1'):
  ?>

  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
      <?php
        if ($latest->have_posts()): $latest->the_post();
          rs_blog_magazine_item(array('image_size' => 'ts-medium-alt-7', 'excerpt' => true, 'length' => $length));
        endif;
      ?>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <?php
        if ($latest->have_posts()): $latest->the_post();
          rs_blog_magazine_item(array('image_size' => 'ts-medium-alt-11', 'excerpt' => false));
        endif;
      ?>
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <?php
            if ($latest->have_posts()): $latest->the_post();
              rs_blog_magazine_item(array('image_size' => 'ts-medium-alt-12', 'excerpt' => false));
            endif;
          ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <?php
            if ($latest->have_posts()): $latest->the_post();
              rs_blog_magazine_item(array('image_size' => 'ts-medium-alt-12', 'excerpt' => false));
            endif;
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php else: ?>
  <?php
      if ($latest->have_posts()): $latest->the_post();
        rs_blog_magazine_item(array('image_size' => 'ts-big-alt-7', 'excerpt' => true, 'length' => $length));
      endif;
  ?>
  <?php endif; ?>
  <?php
  endif;
  wp_reset_postdata();
  $output = ob_get_clean();
  return $output;
}
add_shortcode( 'rs_blog_magazine', 'rs_blog_magazine' );

/**
 *
 * RS Blog Magazine Item
 * @since 1.0.0
 * @version 1.1.0
 *
 */
if(!function_exists('rs_blog_magazine_item')) {
  function rs_blog_magazine_item($item_args = '') { extract($item_args); global $wp_query; ?>
    <div class="blog-magazine post-news">
      <?php
        switch (get_post_format()) :
          case 'gallery':
            $gallery = ts_get_post_opt_slides('post-gallery');
            if(is_array($gallery)):
          ?>
            <div class="flexslider posts-slider">
              <ul class="slides">
                <?php foreach ($gallery as $item): ?>
                <li>
                  <?php if (isset($item['attachment_id'])): ?>
                    <article class="sc-blog-post blog-post style-featured">
                      <header class="post-featured-image">
                        <?php echo wp_get_attachment_image( $item['attachment_id'], ts_get_image_size_by_layout($wp_query -> get_queried_object_id(),$image_size, 'ts-big'), array('alt' => esc_attr($item['title'])) ); ?>
                      </header>
                      <section class="post-content">
                        <ul class="post-meta">
                          <li><?php the_time('F j, Y'); ?></li>
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
                        <h4 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h4>
                        <?php if( $excerpt ) { ts_the_excerpt_theme($length); } ?>
                      </section>
                    </article>
                  <?php endif; ?>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; break;

        default:
        $featured_class = ( has_post_thumbnail() ) ? 'with-featured-image':'with-no-featured-image';
        ?>
          <article class="sc-blog-post blog-post style-featured <?php echo sanitize_html_class($featured_class); ?>">
            <?php if(has_post_thumbnail()): ?>
            <header class="post-featured-image">
              <a href="<?php echo esc_url(get_the_permalink()); ?>" target="_blank"><?php the_post_thumbnail($image_size); ?></a>
            </header>
            <?php endif; ?>
            <section class="post-content">
              <ul class="post-meta">
                <li><?php the_time('F j, Y'); ?></li>
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
              <h4 class="post-title"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h4>
              <?php if( $excerpt ) { ts_the_excerpt_theme($length); } ?>
            </section>
          </article>
        <?php break;
      endswitch;
    ?>
    </div>
    <?php
  }
}

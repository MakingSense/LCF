<?php
/**
 *
 * Testimonial
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_testimonial( $atts, $content = '', $id = '' ) {

  global $post;

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'cats'          => 0,
    'style'         => '1',
    'color'         => 'style-light',
    'icon_color'    => '',
    'wrap'          => 'no',
    'content_color' => '',
    'cite_color'    => '',
    'author_color'  => '',
    'content_size'  => '',
    'cite_size'     => '',
    'author_size'   => ''
  ), $atts ) );

  $id               = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class            = ( $class ) ? ' '. $class : '';

  //color
  $cite_color    = ( $cite_color ) ? 'color:'.$cite_color.';':'';
  $content_color = ( $content_color ) ? 'color:'.$content_color.';':'';
  $author_color  = ( $author_color ) ? 'color:'.$author_color.';':'';

  //size
  $cite_size    = ( $cite_size ) ? 'font-size:'.$cite_size.';':'';
  $content_size = ( $content_size ) ? 'font-size:'.$content_size.';':'';
  $author_size  = ( $author_size ) ? 'font-size:'.$author_size.';':'';

  //elstyle
  $el_cite_style    = ( $cite_size || $cite_color ) ? $cite_color.$cite_size :'';
  $el_content_style = ( $content_size || $content_color ) ? $content_color.$content_size:'';
  $el_author_style  = ( $author_size || $author_color ) ? $author_color.$author_size:'';
  $limit            = ( $style == 5 ) ? 1:-1;

  $args = array(
    'post_type'      => 'testimonial',
    'posts_per_page' => $limit,
  );

  if( $cats ) {
    $args['tax_query'] = array(
      array(
        'taxonomy' => 'testimonial-category',
        'field'    => 'ids',
        'terms'    => explode( ',', $cats )
      )
    );
  }

  $query   = new WP_Query( $args );

  ob_start();
  switch ($style) {
    case '1':
    case '2':
    case '3':
    case '5':
      echo ( $style != '3') ? '<div class="flexslider testimonials-slider style'.sanitize_html_class($style).'">':
      '<div class="testimonial-wrapper style'.sanitize_html_class($style).'">';
        echo '<ul class="slides">';
          $i = 0;
          while( $query->have_posts() ) : $query->the_post();
            echo ($i % $style == 0 ) ? '<li><div class="row">':'';
              $author      = ts_get_post_opt('testimonial-author');
              $position    = ts_get_post_opt('testimonial-position');
              $company     = ts_get_post_opt('testimonial-company');
              $company_url = ts_get_post_opt('testimonial-company-url');

              $item_args = array(
                'style'            => $style,
                'color'            => $color,
                'author'           => $author,
                'position'         => $position,
                'company'          => $company,
                'company_url'      => $company_url,
                'wrap'             => $wrap,
                'el_cite_style'    => $el_cite_style,
                'el_content_style' => $el_content_style,
                'el_author_style'  => $el_content_style,
              );
              rs_testimonial_item($item_args);
            echo (++$i % $style == 0) ? '</div></li>':'';
          endwhile;
          wp_reset_postdata();
      echo '</ul></div>';
      break;

    case '4':
    default: ?>
      <div class="testimonial style-4">
        <?php 
          $n = 0;
          while( $query->have_posts() ) : $query->the_post(); 
          if( $n > 0 ) { break; }
          $author      = ts_get_post_opt('testimonial-author');
          $position    = ts_get_post_opt('testimonial-position');
        ?>
        <div class="testimonial-content-alt">
          <?php the_content(); ?>
          <div class="author-content">
            <span class="name" <?php echo (!empty($el_author_style) ? 'style="'.esc_attr($el_author_style).'"' : ''); ?>><?php echo esc_html($author); ?></span>
            <span class="meta" <?php echo (!empty($el_cite_style) ? 'style="'.esc_attr($el_cite_style).'"' : ''); ?>><?php echo esc_html($position); ?></span>
          </div>
        </div>
        <?php $n++; endwhile; wp_reset_postdata(); ?>
      </div>
    <?php break;
  }


  $output = ob_get_clean();

  return $output;
}
add_shortcode( 'rs_testimonial', 'rs_testimonial');


/**
 * Part of blog shortcode
 * @param type $type
 * @return type
 */
if( !function_exists('rs_testimonial_item')) {
  function rs_testimonial_item( $item_args = array() ) {
    extract($item_args);
    switch ($style) {
      case '1':
      case '5':
      echo ($wrap == 'yes') ? '<div class="col-lg-6 col-md-6 col-sm-8 col-lg-push-3 col-md-push-3 col-sm-push-2">':'';
      ?>
        <div class="testimonial">
          <div class="testimonial-content" <?php echo (!empty($el_content_style) ? 'style="'.esc_attr($el_content_style).'"' : ''); ?>>
            <?php the_content(); ?>
          </div>
          <div class="testimonial-author">
            <?php if(has_post_thumbnail()): ?>
            <div class="avatar">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <?php endif; ?>
            <div class="author-content">
              <span class="name" <?php echo (!empty($el_author_style) ? 'style="'.esc_attr($el_author_style).'"' : ''); ?>><?php echo esc_html($author); ?></span>
              <span class="meta" <?php echo (!empty($el_cite_style) ? 'style="'.esc_attr($el_cite_style).'"' : ''); ?>><?php echo esc_html($position); ?> - <a href="<?php echo (!empty($company_url) ? esc_url($company_url) : '#'); ?>" target="_blank"><?php echo esc_html($company); ?></a></span>
            </div>
          </div>
        </div>
        <?php
        echo ($wrap == 'yes') ? '</div>':'';
        break;

      case '2': ?>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="testimonial">
          <div class="testimonial-content" <?php echo (!empty($el_content_style) ? 'style="'.esc_attr($el_content_style).'"' : ''); ?>>
            <?php the_content(); ?>
          </div>
          <div class="testimonial-author">
            <?php if(has_post_thumbnail()): ?>
            <div class="avatar">
              <?php the_post_thumbnail('full'); ?>
            </div>
            <?php endif; ?>
            <div class="author-content">
              <span class="name" <?php echo (!empty($el_author_style) ? 'style="'.esc_attr($el_author_style).'"' : ''); ?>><?php echo esc_html($author); ?></span>
              <span class="meta" <?php echo (!empty($el_cite_style) ? 'style="'.esc_attr($el_cite_style).'"' : ''); ?>><?php echo esc_html($position); ?> - <a href="<?php echo (!empty($company_url) ? esc_url($company_url) : '#'); ?>" target="_blank"><?php echo esc_html($company); ?></a></span>
            </div>
          </div>
        </div>
      </div>
      <?php break;

      case '3':
      default: ?>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="testimonial <?php echo sanitize_html_class($color); ?>">
            <div class="testimonial-content" <?php echo (!empty($el_content_style) ? 'style="'.esc_attr($el_content_style).'"' : ''); ?>>
              <?php the_content(); ?>
            </div>
            <div class="testimonial-author">
            <?php if(has_post_thumbnail()): ?>
              <div class="avatar">
                <?php the_post_thumbnail('full'); ?>
              </div>
            <?php endif; ?>
              <div class="author-content">
                <span class="name" <?php echo (!empty($el_author_style) ? 'style="'.esc_attr($el_author_style).'"' : ''); ?>><?php echo esc_html($author); ?></span>
                <span class="meta" <?php echo (!empty($el_cite_style) ? 'style="'.esc_attr($el_cite_style).'"' : ''); ?>><?php echo esc_html($position); ?> - <a href="<?php echo (!empty($company_url) ? esc_url($company_url) : '#'); ?>" target="_blank"><?php echo esc_html($company); ?></a></span>
              </div>
            </div>
          </div>
        </div>
      <?php break;
    }
  }
}

<?php
/**
 *
 * RS Space
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_portfolio_related( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'         => '',
    'class'      => '',
    'limit'      => '4',
    'show_title' => 'no'
  ), $atts ) );

  $id     = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class  = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $args = array(
    'posts_per_page' => $limit,
    'offset'         => 0,
    'meta_query'     => array(array('key' => '_thumbnail_id')), //get posts with thumbnails only
    'cat'            => '',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'include'        => '',
    'exclude'        => get_the_ID(),
    'meta_key'       => '',
    'meta_value'     => '',
    'post_type'      => 'portfolio',
    'post_mime_type' => '',
    'post_parent'    => '',
    'paged'          => 1,
    'post_status'    => 'publish',
    'post__not_in'   => array(get_the_ID()),
  );

  $parent_categories = wp_get_object_terms( get_the_ID(), 'portfolio-category', array('fields' => 'ids') );

  if (is_array($parent_categories) && count($parent_categories) > 0):
    $args['tax_query'][] = array (
      'taxonomy' => 'portfolio-category',
      'field'    => 'term_id',
      'terms'    => $parent_categories
    );

  endif;

  $the_query = new WP_Query($args); 
  ob_start();
  if ($the_query -> have_posts()) :
  ?>
  <section <?php echo wp_kses_post($id); ?> class="pf-project-related <?php echo sanitize_html_classes($class); ?>">
    <?php if($show_title == 'yes'): ?>
      <div class="pf-related-title"><h4><?php echo esc_html__('Related Projects', 'splendid-addons'); ?></h4></div>
    <?php endif; ?>
  <?php
    global $post; 
    while ($the_query -> have_posts()) : $the_query -> the_post(); 
      $hover_overlay = ts_get_post_opt('portfolio-overlay-local'); 
      $terms        = wp_get_post_terms($post->ID, 'portfolio-category', $args);
      $term_slugs   = array();
      $term_names   = array();
      if (count($terms) > 0):
        foreach ($terms as $term):
          $term_slugs[] = $term->slug;
          $term_names[] = $term->name;
        endforeach;
    endif;
  ?>
    <div class="col-md-3 col-sm-6 isotope-item <?php echo implode(' ', $term_slugs); ?>">
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
  <?php endwhile; wp_reset_postdata(); ?>
  <section> 
  <?php 
  endif;
  $output = ob_get_clean();
  return $output;
}

add_shortcode('rs_portfolio_related', 'rs_portfolio_related');

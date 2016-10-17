<?php
/**
 *
 * RS Team
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_team( $atts, $content = '', $id = '' ) {

  global $post;

  extract( shortcode_atts( array(
    'id'         => '',
    'class'      => '',
    'style'      => '',
    'person_id'  => '',
    'image_size' => 'ts-medium-alt-7',

  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $args = array(
    'post_type'      => 'team',
    'posts_per_page' => 1,
    'post__in'       => explode(',', $person_id),
  );

  $query   = new WP_Query( $args );

  ob_start();
  echo '<div '.$id.' class="team-member'.$class.' '.sanitize_html_class($style).'">';
  while( $query->have_posts() ) : $query->the_post();
    $hover_overlay = ts_get_post_opt('team-overlay');
    $team_position = ts_get_post_opt('team-position');
    $team_facebook = ts_get_post_opt('team-facebook');
    $team_twitter  = ts_get_post_opt('team-twitter');
    $team_behance  = ts_get_post_opt('team-behance');
    $team_dribble  = ts_get_post_opt('team-dribble');

    $item_args = array(
      'style'         => $style,
      'team_position' => $team_position,
      'team_facebook' => $team_facebook,
      'team_twitter'  => $team_twitter,
      'team_behance'  => $team_behance,
      'team_dribble'  => $team_dribble,
      'image_size'    => $image_size,
      'hover_overlay' => $hover_overlay
    );
    rs_team_item( $item_args );
  endwhile;
  wp_reset_postdata();
  echo '</div>'; // end of team member
  $output = ob_get_clean();
  return $output;

}
add_shortcode('rs_team', 'rs_team');



/**
 * Part of team shortcode
 * @param type $type
 * @return type
 */
if( !function_exists('rs_team_item')) {
  function rs_team_item( $item_args ) {
    extract($item_args);
    switch ($style) {
      case 'style1': ?>
        <div class="team-member-inner">
          <div class="featured-image">
            <?php the_post_thumbnail($image_size); ?>
            <div class="team-member-hover <?php echo sanitize_html_class($hover_overlay); ?>">
              <div>
                <div>
                  <span class="name"><?php the_title(); ?></span>
                  <span class="position"><?php echo esc_html($team_position); ?></span>
                  <span class="separator"></span>
                  <?php the_content(); ?>
                  <?php if(!empty($team_facebook) || !empty($team_twitter) || !empty($team_behance) || !empty($team_dribble)) :?>
                  <ul class="social-media">
                    <?php if(!empty($team_facebook)): ?>
                      <li><a href="<?php echo esc_url($team_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($team_twitter)): ?>
                      <li><a href="<?php echo esc_url($team_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($team_dribble)): ?>
                      <li><a href="<?php echo esc_url($team_dribble); ?>"><i class="fa fa-dribbble"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($team_behance)): ?>
                      <li><a href="<?php echo esc_url($team_behance); ?>"><i class="fa fa-behance"></i></a></li>
                    <?php endif; ?>
                  </ul>
                  <?php endif; ?>
                </div>
              </div>
            </div><!-- /Hover -->
          </div>
          <div class="team-member-info">
            <span class="name"><?php the_title(); ?></span>
            <span class="position"><?php echo esc_html($team_position); ?></span>
          </div>
        </div>
        <?php break;

      case 'style2': ?>
      <div class="team-member-inner">
      <div class="featured-image">
        <?php the_post_thumbnail($image_size); ?>
        <div class="team-member-hover <?php echo sanitize_html_class($hover_overlay); ?>">
          <div>
            <div>
              <?php if(!empty($team_facebook) || !empty($team_twitter) || !empty($team_behance) || !empty($team_dribble)) :?>
                <ul class="social-media">
                  <?php if(!empty($team_facebook)): ?>
                    <li><a href="<?php echo esc_url($team_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                  <?php endif; ?>
                  <?php if(!empty($team_twitter)): ?>
                    <li><a href="<?php echo esc_url($team_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                  <?php endif; ?>
                  <?php if(!empty($team_dribble)): ?>
                    <li><a href="<?php echo esc_url($team_dribble); ?>"><i class="fa fa-dribbble"></i></a></li>
                  <?php endif; ?>
                  <?php if(!empty($team_behance)): ?>
                    <li><a href="<?php echo esc_url($team_behance); ?>"><i class="fa fa-behance"></i></a></li>
                  <?php endif; ?>
                </ul>
              <?php endif; ?>
            </div>
          </div>
        </div><!-- /Hover -->
      </div>
      <div class="team-member-info">
        <span class="name"><?php the_title(); ?></span>
        <span class="position"><?php echo esc_html($team_position); ?></span>
      </div>
      </div>
      <?php break;

      case 'style3':
      default: ?>
        <div class="team-member-inner">
          <div class="featured-image">
            <?php the_post_thumbnail($image_size); ?>
            <div class="team-member-hover <?php echo sanitize_html_class($hover_overlay); ?>">
              <div>
                <div>
                  <?php if(!empty($team_facebook) || !empty($team_twitter) || !empty($team_behance) || !empty($team_dribble)) :?>
                  <ul class="social-media">
                    <?php if(!empty($team_facebook)): ?>
                      <li><a href="<?php echo esc_url($team_facebook); ?>"><i class="fa fa-facebook"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($team_twitter)): ?>
                      <li><a href="<?php echo esc_url($team_twitter); ?>"><i class="fa fa-twitter"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($team_dribble)): ?>
                      <li><a href="<?php echo esc_url($team_dribble); ?>"><i class="fa fa-dribbble"></i></a></li>
                    <?php endif; ?>
                    <?php if(!empty($team_behance)): ?>
                      <li><a href="<?php echo esc_url($team_behance); ?>"><i class="fa fa-behance"></i></a></li>
                    <?php endif; ?>
                  </ul>
                  <?php endif; ?>
                </div>
              </div>
            </div><!-- /Hover -->
          </div>
          <div class="team-member-info">
            <span class="name"><?php the_title(); ?></span>
            <span class="position"><?php echo esc_html($team_position); ?></span>
            <span class="separator"></span>
            <?php the_content(); ?>
          </div>
        </div>
      <?php break;
    }
  }
}

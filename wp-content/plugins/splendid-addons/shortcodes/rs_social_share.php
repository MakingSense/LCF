<?php
/**
 *
 * RS Social Share
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_social_share( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'style'         => 'style1',
    'title'         => '',
    'share_count'   => '',
    'facebook_url'  => '',
    'tumblr_url'    => '',
    'twitter_url'   => '',
    'google_url'    => '',
    'pinterest_url' => '',
    'linkedin_url'  => '',
    'twitter_url'   => '',
    'reddit_url'    => '',
    'instagram_url' => '',
    'dribble_url'   => ''
  ), $atts ) ); 

  $id       = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class    = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $bg_color = ( $style == 'style3' ) ? ' bg-light-blue':'';

  $output  = '';
  $output .= ( $style != 'style3' && $title) ? '<h2 class="align-center">'.esc_html($title).'</h2>':'';
  $output .=  '<div '.$id.' class="social-sharebox '.sanitize_html_classes($style).$bg_color.$class.'">';
  $output .= ( $style == 'style3' && $title) ? '<h2 class="color-white">'.esc_html($title).'</h2>':'';
  if($style == 'style1' ) {
    $output .=  '<div class="share-total">';
    $output .=  '<span class="count">'.esc_html($share_count).'</span>';
    $output .=  '<span>'.esc_html__('Shares', 'splendid-addons').'</span>';
    $output .=  '</div>';
    $output .=  '<div class="share-buttons">';
  }

  if( $style == 'style1' || $style == 'style2') {
    $output .=  '<a class="share-button facebook" target="_blank" href="'.esc_url($facebook_url).'"><i class="fa fa-facebook"></i></a>';
    $output .=  '<a class="share-button twitter" target="_blank" href="'.esc_url($twitter_url).'"><i class="fa fa-twitter"></i></a>';
    $output .=  '<a class="share-button google-plus" target="_blank" href="'.esc_url($google_url).'"><i class="fa fa-google-plus"></i></a>';
    $output .=  '<a class="share-button pinterest" target="_blank" href="'.esc_url($pinterest_url).'"><i class="fa fa-pinterest"></i></a>';
    $output .=  '<a class="share-button linkedin" target="_blank" href="'.esc_url($linkedin_url).'"><i class="fa fa-linkedin"></i></a>';
    $output .=  '<a class="share-button tumblr" target="_blank" href="'.esc_url($tumblr_url).'"><i class="fa fa-tumblr"></i></a>';
    $output .=  '<a class="share-button reddit" target="_blank" href="'.esc_url($reddit_url).'"><i class="fa fa-reddit"></i></a>';
    $output .=  '<a class="share-button email"><i class="fa fa-envelope-o"></i></a>';
    $output .=  ($style == 'style1') ? '</div>':'';
  }

  if($style == 'style4') {
    $output .=  '<a class="share-button facebook" target="_blank" href="'.esc_url($facebook_url).'"><i class="fa fa-facebook"></i></a>';
    $output .=  '<a class="share-button twitter" target="_blank" href="'.esc_url($twitter_url).'"><i class="fa fa-twitter"></i></a>';
    $output .=  '<a class="share-button google-plus" target="_blank" href="'.esc_url($google_url).'"><i class="fa fa-google-plus"></i></a>';
    $output .=  '<a class="share-button dribble" target="_blank" href="'.esc_url($dribble_url).'"><i class="fa fa-dribbble"></i></a>';
    $output .=  '<a class="share-button instagram" target="_blank" href="'.esc_url($instagram_url).'"><i class="fa fa-instagram"></i></a>';
  }

  if( $style == 'style3' ) {
    $output .=  '<a class="share-button facebook button unfilled br-color-white color-white" target="_blank" href="'.esc_url($facebook_url).'"><i class="fa fa-facebook"></i> <span>'.esc_html__('Facebook', 'splendid-addons').'</span></a>';
    $output .=  '<a class="share-button twitter button unfilled br-color-white color-white" target="_blank" href="'.esc_url($twitter_url).'"><i class="fa fa-twitter"></i> <span>'.esc_html__('Twitter', 'splendid-addons').'</span></a>';
    $output .=  '<a class="share-button button unfilled br-color-white color-white google-plus" target="_blank" href="'.esc_url($google_url).'"><i class="fa fa-google-plus"></i> <span>'.esc_html__('Google Plus', 'splendid-addons').'</span></a>';
  }

  $output .=  '</div>';
  return $output;

}
add_shortcode( 'rs_social_share', 'rs_social_share' );

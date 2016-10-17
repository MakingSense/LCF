<?php
/**
 *
 * Banner
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_banner( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                      => '',
    'class'                   => '',
    'style'                   => 'bold_promo',
    'small_heading'           => '',
    'background_color'        => '',
    'big_heading'             => '',
    'btn_one_text'            => '',
    'btn_one_color'           => '',
    'btn_two_color'           => '',
    'btn_two_text'            => '',
    'btn_one_link'            => '',
    'btn_two_link'            => '',
    'big_heading_color'       => '',
    'small_heading_color'     => '',
    'small_heading_font_size' => '',
    'big_heading_font_size'   => ''
  ), $atts ) );

  $id                      = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class                   = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $el_background_color     = ( $background_color ) ? ' style="background-color:'.esc_attr($background_color).';"':'';
  $big_heading_color       = ( $big_heading_color ) ? 'color:'.$big_heading_color.';':'';
  $small_heading_color     = ( $small_heading_color ) ? 'color:'.$small_heading_color.';':'';
  $small_heading_font_size = ( $small_heading_font_size ) ? 'font-size:'.$small_heading_font_size.';':'';
  $big_heading_font_size   = ( $big_heading_font_size ) ? 'font-size:'.$big_heading_font_size.';':'';

  $el_small_heading = ( $small_heading_font_size || $small_heading_color ) ? ' style="'.esc_attr($small_heading_font_size.$small_heading_color).'"':'';
  $el_big_heading   = ( $big_heading_font_size || $big_heading_color ) ? ' style="'.esc_attr($big_heading_font_size.$big_heading_color).'"':'';

  $href = $href_2 = $title = $title_2 = $target = $target_2 = '';
  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_one_link );
    $href       = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title      = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target     = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

  if ( function_exists( 'vc_parse_multi_attribute' ) ) {
    $parse_args = vc_parse_multi_attribute( $btn_two_link );
    $href_2     = ( isset( $parse_args['url'] ) ) ? $parse_args['url'] : '#';
    $title_2    = ( isset( $parse_args['title'] ) ) ? $parse_args['title'] : 'button';
    $target_2   = ( isset( $parse_args['target'] ) ) ? trim( $parse_args['target'] ) : '_self';
  }

  $output = '';
  switch ($style) {
    case 'bold_promo':
      $output .=  '<section '.$id.' class="page-heading style-image full-width'.$class.'"'.$el_background_color.'>';
      $output .= '<div '.$id.' class="padding_l_60 padding_r_60">';
      $output .=  '<h3 class="color-light-gray"'.$el_small_heading.'><i>'.esc_html($small_heading).'</i></h3>';
      $output .=  '<h1 class="bold big margin_b_40"'.$el_big_heading.'>'.wp_kses_post($big_heading).'</h1>';
      if(!empty($btn_one_text)):
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button shaped '.sanitize_html_classes($btn_one_color).' color-dark-gray">'.esc_html($btn_one_text).'</a>';
      endif;
      if(!empty($btn_two_text)):
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button shaped br-semi-light br-color-white color-white">'.esc_html($btn_two_text).' <i class="fa fa-play icon-after"></i></a>';
      endif;
      $output .=  '</div>';
      $output .=  '</section>';
      break;
    case 'promo_big':
      $output .=  '<section '.$id.' class="page-heading style-big align-center full-width'.$class.'"'.$el_background_color.'>';
      $output .=  '<h1 class="heading-block"'.$el_big_heading.'>'.esc_html($big_heading).'</h1>';
      $output .=  '<h3 class="color-gray"'.$el_small_heading.'><i>'.esc_html($small_heading).'</i></h3>';
      if(!empty($btn_one_text)):
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button '.sanitize_html_classes($btn_one_color).' color-white">'.esc_html($btn_one_text).'</a>';
      endif;
      if(!empty($btn_two_text)):
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button '.sanitize_html_classes($btn_two_color).' color-white">'.esc_html($btn_two_text).'</a>';
      endif;
      $output .=  '</section>';
      break;

    case 'promo_info':
      $output .=  '<section '.$id.' class="page-heading style-image align-center full-width'.$class.'"'.$el_background_color.'>';
      $output .=  '<h1'.$el_big_heading.'>'.esc_html($big_heading).'</h1>';
      $output .=  '<h3'.$el_small_heading.'>'.esc_html($small_heading).'</h3>';
      if(!empty($btn_one_text)):
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button '.sanitize_html_classes($btn_one_color).' color-white">'.esc_html($btn_one_text).'</a>';
      endif;
      if(!empty($btn_two_text)):
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button '.sanitize_html_classes($btn_two_color).' color-white"><i class="fa fa-play icon-before"></i>'.esc_html($btn_two_text).'</a>';
      endif;
      $output .=  '</section>';
      break;
    case 'splendid_bold_banner':
      $output  = '<section '.$id.' class="home-flexslider flexslider color-light style-light'.sanitize_html_classes($class).'">';
      $output .=  '<ul class="slides">';
      $output  =  '<li>';
      $output .=  '<div class="slide dark-gradient-overlay">';
      $output .=  '<div class="container align-center">';
      $output .=  '<h3 class="margin_t_80 margin_b_0"'.$el_small_heading.'><i>'.esc_html($small_heading).'</i></h3>';
      $output .=  '<h1 class="heading-block style-simple margin_t_0 margin_b_0"'.$el_big_heading.'>'.esc_html($big_heading).'</h1>';
      if(!empty($btn_one_text)):
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="margin_b_80 button shaped bg-white color-dark-gray">'.esc_html($btn_one_text).'</a>';
      endif;
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</li>';
      $output .=  '</ul>';
      $output .=  '</section>';
      break;
    default:
      # code...
      break;
  }

  return $output;

}
add_shortcode( 'rs_banner', 'rs_banner' );

<?php
/**
 *
 * RS Banner Rotator
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_banner_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'             => '',
    'class'          => '',
    'slide_speed'    => '',
    'style'          => 'splendid_banner',
    'content_pos'    => 'left',
  ), $atts ) );

  global $rs_banner_style, $rs_content_pos;
  $rs_banner_style = $style;
  $rs_content_pos = $content_pos;

  $id                  = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class               = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $slide_speed         = ( $slide_speed ) ? $slide_speed:'';

  switch ($style) {
    case 'splendid_bold_banner':
    case 'splendid_banner':
    case 'basic_banner':
    case 'bold_attraction':
    case 'basic_modern_banner':
      $output  = '<section '.$id.' class="home-flexslider flexslider color-light style-light'.sanitize_html_classes($class).'">';
      $output .=  '<ul class="slides">';
      $output .=  do_shortcode(wp_kses_post($content));
      $output .=  '</ul>';
      $output .=  '</section>';
      break;

    case 'promo_inn':
      $output  = '<div '.$id.' class="home-flexslider flexslider'.sanitize_html_classes($class).'" data-speed="'.esc_attr($slide_speed).'">';
      $output .=  '<ul class="slides">';
      $output .=  do_shortcode(wp_kses_post($content));
      $output .=  '</ul>';
      $output .= '</div>';
      break;
    case 'bold_promo_inn':
      $output  =  '<section '.$id.' class="home-flexslider style-dots flexslider color-light style-light blod-promo-inn'.sanitize_html_classes($class).'">';
      $output .=  '<ul class="slides">';
      $output .=  do_shortcode(wp_kses_post($content));
      $output .=  '</ul>';
      $output .= '</section>';
      break;

    case 'simple_banner':
      $output  = '<section '.$id.' class="page-heading style-slider full-width"'.sanitize_html_classes($class).'>';
      $output .=  '<div class="flexslider main-flexslider">';
      $output .=  '<ul class="slides">';
      $output .=  do_shortcode(wp_kses_post($content));
      $output .=  '</ul>';
      $output .=  '</div>';
      $output .=  '</section>';
      break;
    default:
      # code...
      break;
  }


  return $output;
}

add_shortcode('rs_banner_slider', 'rs_banner_slider');

function rs_banner_slide($atts, $content = '') {
  extract( shortcode_atts( array(
    'background'              => '',
    'small_heading'           => '',
    'no_buttons'              => '',
    'big_heading'             => '',
    'promo_image'             => '',
    'background_color'        => '',
    'btn_one_link'            => '',
    'btn_two_link'            => '',
    'btn_one_text'            => '',
    'btn_two_text'            => '',
    'big_heading_color'       => '',
    'btn_one_color'           => '',
    'btn_two_color'           => '',
    'small_heading_color'     => '',
    'small_heading_font_size' => '',
    'big_heading_font_size'   => '',
    'content_font_size'       => '',
    'content_color'           => '',
    'padding_top'             => '',
    'padding_bottom'          => ''
  ), $atts ) );

  global $rs_banner_style, $rs_content_pos;

  $big_heading_color       = ( $big_heading_color ) ? 'color:'.$big_heading_color.';':'';
  $small_heading_color     = ( $small_heading_color ) ? 'color:'.$small_heading_color.';':'';
  $small_heading_font_size = ( $small_heading_font_size ) ? 'font-size:'.$small_heading_font_size.';':'';
  $big_heading_font_size   = ( $big_heading_font_size ) ? 'font-size:'.$big_heading_font_size.';':'';
  $padding_top             = ( $padding_top ) ? 'padding-top:'.$padding_top.';':'';
  $padding_top             = ( $padding_top ) ? 'padding-bottom:'.$padding_bottom.';':'';
  $content_color           = ( $content_color ) ? 'color:'.$content_color.';':'';
  $content_font_size       = ( $content_font_size ) ? 'font-size:'.$content_font_size.';':'';
  $el_content_style        = ( $content_color || $content_font_size ) ? ' style="'.esc_attr($content_color.$content_font_size).'"':'';
  $el_background_color     = ( $background_color ) ? ' style="background-color:'.$background_color.';"':'';
  $el_padding_style        = ( $padding_top || $padding_bottom ) ? ' style="'.esc_attr($padding_top.$padding_bottom).'"':'';

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

  switch ($rs_banner_style) {
    case 'splendid_banner':
      $output  = '<li>';
      $output .=  '<div class="slide"'.$el_background_color.'>';
      $output .=  '<div class="container align-center">';
      if(is_numeric($background) && !empty($background)) {
        $image_src  = wp_get_attachment_image_src( $background, 'full' );
        if(isset($image_src[0])) {
          $output .=  '<img class="align-center" src="'.esc_url($image_src[0]).'" alt="">';
        }
      }
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</li>';
      break;

    case 'promo_inn':
      $output  = '<li>';
      $output .=  '<div class="slide"'.$el_padding_style.'>';
      $output .=  '<div class="container align-center">';
      $output .=  '<h1'.$el_big_heading.'>'.esc_html($big_heading).'</h1>';
      $output .=  '<h3 class="margin_t_0 margin_b_40"'.$el_small_heading.'>'.esc_html($small_heading).'</h3>';
      if(!empty($btn_one_text)):
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button '.sanitize_html_classes($btn_one_color).' color-white">'.esc_html($btn_one_text).'</a>';
      endif;
      if(!empty($btn_two_text)):
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button '.sanitize_html_classes($btn_two_color).' color-white"><i class="icon-before fa fa-play"></i> '.esc_html($btn_two_text).'</a>';
      endif;

      if(is_numeric($background) && !empty($background)) {
        $image_src  = wp_get_attachment_image_src( $background, 'full' );
        if(isset($image_src[0])) {
          $output .=  '<img class="margin_t_60" src="'.esc_url($image_src[0]).'" alt="">';
        }
      }
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</li>';
      break;

    case 'splendid_bold_banner':
      $bold_promo_bg_color  = ( $background_color ) ? 'background-color:'.$background_color.';':'';
      $bold_promo_bg = '';
      if(is_numeric($background) && !empty($background)) {
        $image_src  = wp_get_attachment_image_src( $background, 'full' );
        if(isset($image_src[0])) {
          $bold_promo_bg = ' background-image:url('.esc_url($image_src[0]).');';
        }
      }
      $el_banner_bg_style = ( $bold_promo_bg_color || $bold_promo_bg ) ? ' style="'.$bold_promo_bg_color.$bold_promo_bg.'"':'';
      $output  =  '<li>';
      $output .=  '<div class="slide dark-gradient-overlay"'.$el_banner_bg_style.'>';
      $output .=  '<div class="container align-center">';
      $output .=  '<h3 class="margin_t_80 margin_b_0"'.$el_small_heading.'><i>'.esc_html($small_heading).'</i></h3>';
      $output .=  '<h1 class="heading-block style-simple margin_t_0 margin_b_0"'.$el_big_heading.'>'.esc_html($big_heading).'</h1>';
      if(!empty($btn_one_text)):
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="margin_b_80 button shaped '.sanitize_html_classes($btn_one_color).' color-dark-gray">'.esc_html($btn_one_text).'</a>';
      endif;
      if(!empty($btn_two_text)):
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button '.sanitize_html_classes($btn_two_color).' shaped br-semi-light br-color-white color-white">'.esc_html($btn_two_text).' <i class="fa fa-play icon-after"></i></a>';
      endif;
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</li>';
      break;

    case 'bold_promo_inn':
      $bold_promo_bg_color  = ( $background_color ) ? 'background-color:'.$background_color.';':'';
      $bold_promo_bg = '';
      if(is_numeric($background) && !empty($background)) {
        $image_src  = wp_get_attachment_image_src( $background, 'full' );
        if(isset($image_src[0])) {
          $bold_promo_bg = ' background-image:url('.esc_url($image_src[0]).');';
        }
      }

      $output  = '<li>';
      $output .=  '<div class="slide blod-prmo-att" style="'.esc_attr($bold_promo_bg_color).$bold_promo_bg.'">';
      $output .=  '<div class="container">';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-lg-6col-md-6 col-sm-6 padding_t_80">';
      $output .=  '<h6 class="heading-spaced"'.$el_small_heading.'>'.esc_html($small_heading).'</h6>';
      $output .=  '<h1 class="extra-bold"'.$el_big_heading.'>'.wp_kses_post($big_heading).'</h1>';
      if(!empty($btn_one_text)):
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button '.sanitize_html_classes($btn_one_color).' color-white">'.esc_html($btn_one_text).'</a>';
      endif;
      if(!empty($btn_two_text)):
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button '.sanitize_html_classes($btn_two_color).' color-white"><i class="fa fa-play icon-before"></i>'.esc_html($btn_two_text).'</a>';
      endif;

      $output .=  '</div>';
      $output .=  '<div class="col-lg-6col-md-6 col-sm-6 align-center">';
      if(is_numeric($promo_image) && !empty($promo_image)) {
        $image_src  = wp_get_attachment_image_src( $promo_image, 'full' );
        if(isset($image_src[0])) {
          $output .=  '<img src="'.esc_url($image_src[0]).'" alt="">';
        }
      }
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</li>';
      break;

    case 'basic_banner':
      $output = '<li>';
      if($rs_content_pos == 'right') {
        $output .=  '<div class="slide"'.$el_background_color.'>';
        $output .=  '<div class="container">';
        $output .=  '<div class="row">';
        $output .=  '<div class="col-lg-6 col-md-6 col-sm-6 col-lg-push-6 col-md-push-6 col-sm-push-6"'.$el_content_style.'>';
        $output .=  '<h1'.$el_big_heading.'>'.wp_kses_post($big_heading).'</h1>';
        $output .=  rs_set_wpautop($content);
        if(!empty($btn_one_text)):
          $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button '.sanitize_html_classes($btn_one_color).' color-white">'.esc_html($btn_one_text).'</a>';
        endif;
        if(!empty($btn_two_text)):
          $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button '.sanitize_html_classes($btn_two_color).' color-white">'.esc_html($btn_two_text).'</a>';
        endif;
        $output .=  '</div>';
        $output .=  '</div>';
        $output .=  '</div>';
        $output .=  '</div>';
      } else {
        $output .=  '<div class="slide light-gradient-overlay"'.$el_background_color.'>';
        $output .=  '<div class="container">';
        $output .=  '<div class="row">';
        $output .=  '<div class="col-lg-5 col-md-6 col-sm-8"'.$el_content_style.'>';
        $output .=  '<h1'.$el_big_heading.'>'.wp_kses_post($big_heading).'</h1>';
        $output .=  rs_set_wpautop($content);
        if(!empty($btn_one_text)):
          $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button '.sanitize_html_classes($btn_one_color).' color-white">'.esc_html($btn_one_text).'</a>';
        endif;
        if(!empty($btn_two_text)):
          $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button '.sanitize_html_classes($btn_two_color).' color-white">'.esc_html($btn_two_text).'</a>';
        endif;
        $output .=  '</div>';
        $output .=  '</div>';
        $output .=  '</div>';
        $output .=  '</div>';
      }
      $output .=  '</li>';
      break;
    case 'basic_modern_banner':
      $output  = '<li>';
      $output .=  '<div class="slide"'.$el_background_color.'>';
      $output .=  '<div class="container align-center"'.$el_content_style.'>';
      $output .=  '<h1'.$el_big_heading.'>'.esc_html($big_heading).'</h1>';
      $output .=  rs_set_wpautop($content);
      $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button '.sanitize_html_classes($btn_one_color).' color-white">'.esc_html($btn_one_text).'</a>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</li>';
      break;

    case 'bold_attraction':
      $bold_att_bg_color  = ( $background_color ) ? ' style="background-color:'.$background_color.';"':'';

      $output  = '<li>';
      $output .=  '<div class="slide light-gradient-overlay"'.$bold_att_bg_color.'>';
      $output .=  '<div class="container">';
      $output .=  '<div class="row">';
      $output .=  '<div class="col-lg-7 col-md-7 col-sm-7">';
      $output .=  '<h4'.$el_small_heading.'><i>'.wp_kses_post($small_heading).'</i></h4>';
      $output .=  '<h1 class="big extra-bold uppercase"'.$el_big_heading.'>'.esc_html($big_heading).'</h1>';
      if(!empty($btn_one_text)):
        $output .=  '<a href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'" class="button '.sanitize_html_classes($btn_one_color).' color-white">'.esc_html($btn_one_text).'</a>';
      endif;
      if(!empty($btn_two_text)):
        $output .=  '<a href="'.esc_url($href_2).'" title="'.esc_attr($title_2).'" target="'.esc_attr($target_2).'" class="button '.sanitize_html_classes($btn_two_color).' color-white">'.esc_html($btn_two_text).'</a>';
      endif;
      $output .=  '</div>';
      if(is_numeric($promo_image) && !empty($promo_image)) {
        $image_src  = wp_get_attachment_image_src( $promo_image, 'full' );
        if(isset($image_src[0])) {
          $output .=  '<div class="col-lg-5 col-md-5 col-sm-5">';
          $output .=  '<img src="'.esc_url($image_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      }
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</li>';
      break;

    case 'simple_banner':
	  $output = '';
      if(is_numeric($background) && !empty($background)) {
        $image_src  = wp_get_attachment_image_src( $background, 'full' );
        if(isset($image_src[0])) {
          $output .=  '<li><img src="'.esc_url($image_src[0]).'" alt=""></li>';
        }
      }
      break;
    default:
      # code...
      break;
  }


  return $output;
}

add_shortcode('rs_banner_slide', 'rs_banner_slide');

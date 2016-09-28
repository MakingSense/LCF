<?php
/**
 *
 * Content Box
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_content_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                           => '',
    'class'                        => '',
    'style'                        => 'style1',
    'icon_image'                   => '',
    'title'                        => '',
    'btn_link'                     => '',
    'btn_text'                     => '',
    'box_border'                   => 'yes',
    'text_align'                   => 'on-left',
    'icon'                         => '',
    'icon_color'                   => '',
    'icon_color_hover'             => '',
    'title_color'                  => '',
    'text_color'                   => '',
    'title_size'                   => '',
    'content_size'                 => '',
    'icon_size'                    => '',
    'title_top'                    => '',
    'title_bottom'                 => '',
    'icon_bg_color_hover'          => '',
    'icon_bg_color'                => '',
    'icon_border_color'            => '',
    'icon_ring_border_color_hover' => '',
    'box_header_color'             => '',
    'custom_box_border_color'      => '',
    'custom_box_header_color'      => '',
    'icon_animation'               => '',
    'icon_delay'                   => '',
    'title_animation'              => '',
    'title_delay'                  => '',
    'content_animation'            => '',
    'content_delay'                => '',
    'btn_hover_effect'             => '',
    'btn_fill_bg_color'            => '',
    'btn_border_color'             => '',
    'btn_text_color'               => '',
    'btn_text_color_hover'         => '',
    'btn_bg_color'                 => '',
    'btn_bg_color_hover'           => '',

  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $icon_animation = ( $icon_animation ) ? ' wow '.$icon_animation:'';
  $icon_delay     = ( $icon_delay ) ? ' data-wow-delay="'.esc_attr($icon_delay).'s"':'';

  $title_animation = ( $title_animation ) ? ' wow '.$title_animation:'';
  $title_delay     = ( $title_delay ) ? ' data-wow-delay="'.esc_attr($title_delay).'s"':'';

  $content_animation = ( $content_animation ) ? ' wow '.$content_animation:'';
  $content_delay     = ( $content_delay ) ? ' data-wow-delay="'.esc_attr($content_delay).'s"':'';

  $title_color             = ( $title_color ) ? 'color:'.$title_color.';':'';
  $text_color              = ( $text_color ) ? 'color:'.$text_color.';':'';
  $title_size              = ( $title_size ) ? 'font-size:'.$title_size.';':'';
  $content_size            = ( $content_size ) ? 'font-size:'.$content_size.';':'';
  $box_border              = ( $box_border == 'yes' ) ? '':'no_border';
  $top                     = ( $title_top ) ? 'margin-top:'.$title_top.';':'';
  $bottom                  = ( $title_bottom ) ? 'margin-bottom:'.$title_bottom.';':'';
  $custom_box_header_color = ( $custom_box_header_color ) ? ' style="background-color:'.esc_attr($custom_box_header_color).' !important;"':'';

  $el_title_style = ( $title_color || $title_bottom || $title_size || $title_top ) ? ' style="'.esc_attr($top.$bottom.$title_size.$title_color).'"':'';
  $el_content_style = ( $content_size || $text_color ) ? ' style="'.esc_attr($content_size.$text_color).'"':'';

  $output = $href = $btn_title = $target = '';
  if (function_exists('vc_parse_multi_attribute')) {
    $parse_args = vc_parse_multi_attribute($btn_link);
    $href = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
    $btn_title = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
    $target = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  }

  $customize    = ( $btn_text_color_hover || $btn_bg_color || $btn_bg_color_hover || $btn_border_color || $btn_text_color || $btn_fill_bg_color || $icon_ring_border_color_hover || $icon_color || $icon_color_hover || $icon_bg_color || $icon_bg_color_hover || $icon_border_color ) ? true:false;
  $uniqid_class = $uniqid_btn_class =  '';

  if( $customize ) {
    $uniqid       = time().'-'.mt_rand();
    $custom_style = '';

    if( $icon_color || $icon_bg_color || $icon_border_color ) {
      $custom_style .=  '.content-box-custom-'.$uniqid.'{';
      $custom_style .=  ( $icon_color ) ? 'color:'.$icon_color.' !important;':'';
      $custom_style .=  ( $icon_bg_color ) ? 'background:'.$icon_bg_color.' !important;':'';
      $custom_style .=  ( $icon_border_color ) ? 'border-color:'.$icon_border_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $icon_color_hover ) {
      $custom_style .=  '.content-box:hover .content-box-custom-'.$uniqid.'{';
      $custom_style .=  ( $icon_color_hover ) ? 'color:'.$icon_color_hover.' !important;':'';
      $custom_style .= '}';
    }

    if( $icon_bg_color_hover ) {
      $custom_style .=  '.content-box:hover .content-box-custom-'.$uniqid.' {';
      $custom_style .=  ( $icon_bg_color_hover ) ? 'background:'.$icon_bg_color_hover.' !important;':'';
      $custom_style .= '}';
    }

    if( $icon_ring_border_color_hover && $style == 'style1' ) {
      $custom_style .=  '.content-box.style1 .content-box-custom-'.$uniqid.':before {';
      $custom_style .=  ( $icon_ring_border_color_hover ) ? 'border-color:'.$icon_ring_border_color_hover.' !important;':'';
      $custom_style .= '}'; 
    }

    if( $icon_bg_color_hover && $style == 'style1' ) {
      $custom_style .=  '.content-box:hover .content-box-custom-'.$uniqid.':after {';
      $custom_style .=  ( $icon_bg_color_hover ) ? 'background:'.$icon_bg_color_hover.' !important;':'';
      $custom_style .= '}';
    }

    if( $icon_border_color && $style == 'style8' ) {
      $custom_style .=  '.content-box-custom-'.$uniqid.':before,.content-box-custom-'.$uniqid.':after {';
      $custom_style .=  ( $icon_border_color ) ? 'border-color:'.$icon_border_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $btn_fill_bg_color && $style == 'style6') {
      $custom_style .=  '.custom-btn-'.$uniqid.'.button:before {';
      $custom_style .=  ( $btn_fill_bg_color ) ? 'background-color:'.$btn_fill_bg_color.' !important;':'';
      $custom_style .= '}'; 
    }

    if( $btn_border_color || $btn_text_color || $btn_bg_color && $style == 'style6') {
      $custom_style .=  '.custom-btn-'.$uniqid.'.button {';
      $custom_style .=  ( $btn_border_color ) ? 'border-color:'.$btn_border_color.' !important;':'';
      $custom_style .=  ( $btn_text_color ) ? 'color:'.$btn_text_color.' !important;':'';
      $custom_style .=  ( $btn_bg_color ) ? 'background-color:'.$btn_bg_color.' !important;':'';
      $custom_style .= '}'; 
    }

    if( $btn_text_color_hover || $btn_bg_color_hover && $style == 'style6') {
      $custom_style .=  '.custom-btn-'.$uniqid.'.button:hover {';
      $custom_style .=  ( $btn_text_color_hover ) ? 'color:'.$btn_text_color_hover.' !important;':'';
      $custom_style .=  ( $btn_bg_color_hover ) ? 'background-color:'.$btn_bg_color_hover.' !important;':'';
      $custom_style .= '}'; 
    }

    $uniqid_class     = ' content-box-custom-'. $uniqid;
    $uniqid_btn_class = ' custom-btn-'. $uniqid;

    ts_add_inline_style( $custom_style );

  }

  switch ($style) {
    case 'style1':
      $output .= '<div '.$id.' class="content-box style1'.$class.'">';
      if(is_numeric($icon_image) && !empty($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
      }
      $output .=  '<div class="title'.$title_animation.'"'.$title_delay.'>';
      $output .=  '<h6'.$el_title_style.'>'.esc_html($title).'</h6>';
      $output .=  '</div>';
      $output .=  '<div class="content'.$content_animation.'"'.$content_delay.'>';
      $output .=  rs_set_wpautop($content);
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style2':
      $output .=  '<div '.$id.' class="content-box style2'.$class.'">';
      if(is_numeric($icon_image) && !empty($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
      }
      $output .=  '<div class="title'.$title_animation.'"'.$title_delay.'>';
      $output .=  '<h6'.$el_title_style.'>'.esc_html($title).'</h6>';
      $output .=  '</div>';
      $output .=  '<div class="content'.$content_animation.'"'.$content_delay.'>';
      $output .=  rs_set_wpautop($content);
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style3':
      $output .=  '<div '.$id.' class="content-box style3'.$class.'">';
      if(is_numeric($icon_image) && !empty($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
      }
      $output .=  '<div class="title'.$title_animation.'"'.$title_delay.'>';
      $output .=  '<h3'.$el_title_style.'>'.esc_html($title).'</h3>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style4':
      $output .=  '<div '.$id.' class="content-box style4'.$class.'">';
      if(is_numeric($icon_image) && !empty($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
      }
      $output .=  '<div class="title'.$title_animation.'"'.$title_delay.'>';
      $output .=  '<h6'.$el_title_style.'>'.esc_html($title).'</h6>';
      $output .=  '</div>';
      $output .=  '<div class="content'.$content_animation.'"'.$content_delay.'>';
      $output .=  rs_set_wpautop($content);
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style5':
      $box_border_color_style = ( $custom_box_border_color ) ? ' style="border-color:'.esc_attr($custom_box_border_color).';"':'';
      $output .=  '<div '.$id.' class="content-box '.sanitize_html_classes($box_border).' style7'.$class.'"'.$box_border_color_style.'>';
      $output .=  '<div class="content-box-heading'.$title_animation.'"'.$title_delay.'>';
      $output .=  '<h3'.$el_title_style.'>'.esc_html($title).'</h3>';
      $output .=  '</div>';
      $output .=  '<div class="content-box-content'.$content_animation.'"'.$content_delay.'>';
      $output .=  '<p'.$el_content_style.'>'.wp_kses_data($content).'</p>';
      $output .=  '</div>';
      if(is_numeric($icon_image) && !empty($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
      }
      $output .=  '</div>';
      break;

    case 'style6':
      $output .=  '<div '.$id.' class="content-box style8'.$class.'">';
      if(is_numeric($icon_image) && !empty($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
      }
      $output .=  '<div class="title'.$title_animation.'"'.$title_delay.'>';
      $output .=  '<h6'.$el_title_style.'>'.esc_html($title).'</h6>';
      $output .=  '</div>';

      $output .=  '<div class="content'.$content_animation.'"'.$content_delay.'>';
      $output .=  '<p'.$el_content_style.'>'.wp_kses_data($content).'</p>';
      $output .=  '</div>';

      $output .=  '<a class="button small bg-dark-gray color-white '.sanitize_html_classes($btn_hover_effect).$uniqid_btn_class.'" href="'.esc_url($href).'" title="'.esc_attr($btn_title).'" target="'.esc_attr($target).'"><span>'.esc_html($btn_text).'</span></a>';
      $output .=  '</div>';
      break;

    case 'style9':
      $output .=  '<div '.$id.' class="content-box style2'.$class.'">';
      if(is_numeric($icon_image) && !empty($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
      }
      $output .=  '<div class="title'.$title_animation.'"'.$title_delay.'>';
      $output .=  '<h6'.$el_title_style.'>'.esc_html($title).'</h6>';
      $output .=  '</div>';
      $output .=  '<div class="content'.$content_animation.'"'.$content_delay.'>';
      $output .=  rs_set_wpautop($content);
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style8':
    default:
      $output .=  '<div '.$id.' class="content-box style11 '.sanitize_html_classes($text_align).$class.'">';
      if(is_numeric($icon_image) && !empty($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon'.$uniqid_class.$icon_animation.'"'.$icon_delay.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
      }
      $output .=  '<div class="title'.$title_animation.'"'.$title_delay.'>';
      $output .=  '<h6'.$el_title_style.'>'.esc_html($title).'</h6>';
      $output .=  '</div>';
      $output .=  '<div class="content'.$content_animation.'"'.$content_delay.'>';
      $output .=  rs_set_wpautop($content);
      $output .=  '</div>';
      $output .=  '</div>';
      break;
  }

  return $output;
}
add_shortcode( 'rs_content_box', 'rs_content_box' );

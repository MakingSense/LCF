<?php
/**
 *
 * RS Promo Box
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_promo_box( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                     => '',
    'class'                  => '',
    'style'                  => 'style1',
    'heading'                => '',
    'icon'                   => '',
    'subheading'             => '',
    'bg_image'               => '',
    'bg_color'               => '',
    'border_width'           => 'br-light',
    'btn_text'               => '',
    'full_width'             => '',
    'btn_hover_effect'       => '',
    'btn_style'              => '',
    'btn_color'              => '',
    'btn_link'               => '',
    'heading_color'          => '',
    'subheading_color'       => '',
    'custom_bg_color'        => '',
    'border_color'           => '',
    'icon_color'             => '',
    'background_color'       => '',
    'text_color'             => '',
    'border_color_hover'     => '',
    'background_color_hover' => '',
    'text_color_hover'       => '',
    'custom_bg_color_hover'  => '',
  ), $atts ) );


  $id                    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class                 = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $full_width            = ( $full_width == 'yes' ) ? 'full-width':'no-full-width';
  $heading_color         = ( $heading_color ) ? ' style="color:'.esc_attr($heading_color).';"':'';
  $subheading_color      = ( $subheading_color ) ? ' style="color:'.esc_attr($subheading_color).';"':'';
  $icon_color            = ( $icon_color ) ? ' style="color:'.esc_attr($icon_color).';"':'';
  $btn_effect            = ( $btn_hover_effect ) ? ' '.$btn_hover_effect:'';

  $bg_style = '';
  if(!empty($bg_image) && is_numeric($bg_image) && $style !== 'style9') {
    $image_url = wp_get_attachment_image_src( $bg_image, 'full' );
    if(isset($image_url[0])) {
      $bg_style = 'background-image:url('.esc_url($image_url[0]).');';
    }
  }

  $custom_bg_color_style = ( $custom_bg_color || $bg_style ) ? ' style="background-color:'.esc_attr($custom_bg_color).';'.$bg_style.'"':'';

  switch ($style) {
    case 'style8':
    case 'style1':
      $heading_tag = ( $style == 'style1' ) ? 'h2':'h4';
      $promo_class = ( $style == 'style8' ) ? ' small':'';
      $output  = '<div '.$id.' class="promo-box '.sanitize_html_class($bg_color).''.$promo_class.' style1 '.sanitize_html_class($full_width).''.$class.'"'.$custom_bg_color_style.'>';
      $output .=  ($full_width == 'full-width') ? '<div class="container">':'';
      $output .=  '<div class="promo-box-inner">';
      $output .=  '<div class="promo-box-content">';
      $output .=  ($heading) ? '<'.$heading_tag.$heading_color.'>'.esc_html($heading).'</'.$heading_tag.'>':'';
      $output .=  ( $content ) ? '<p'.$subheading_color.'>'.wp_kses_data($content).'</p>':'';
      $output .=  '</div>';
      if(!empty($btn_text) && !empty($btn_link)) {
        $output .=  '<div class="promo-box-actions">';
        $output .=  rs_buttons(array(
          'btn_style'              => $btn_style,
          'btn_link'               => $btn_link,
          'btn_text'               => $btn_text,
          'btn_color'              => $btn_color,
          'border_width'           => $border_width,
          'border_color'           => $border_color,
          'text_color'             => $text_color,
          'background_color'       => $background_color,
          'border_color_hover'     => $border_color_hover,
          'background_color_hover' => $background_color_hover,
          'text_color_hover'       => $text_color_hover,
          'btn_hover_effect'       => $btn_effect
        ));
        $output .=  '</div>';
      }
      $output .=  '</div>';
      $output .=  ($full_width == 'full-width') ? '</div>':'';
      $output .=  '</div>';
      break;

    case 'style2':
      $output  = '<div '.$id.' class="promo-box '.sanitize_html_class($bg_color).' style2 '.sanitize_html_class($full_width).$class.'"'.$custom_bg_color_style.'>';
      $output .=  '<div class="container">';
      $output .=  '<div class="promo-box-inner">';
      $output .=  '<div class="promo-box-content">';
      $output .=  ($heading) ? '<h2'.$heading_color.'>'.wp_kses_post($heading).'</h2>':'';
      $output .=  ($content) ? '<h5 class="big"'.$subheading_color.'>'.wp_kses_data($content).'</h5>':'';
      if(!empty($btn_text) && !empty($btn_link)) {
        $output .=  rs_buttons(array(
          'btn_style'              => $btn_style,
          'btn_link'               => $btn_link,
          'btn_text'               => $btn_text,
          'btn_color'              => $btn_color,
          'border_width'           => $border_width,
          'border_color'           => $border_color,
          'text_color'             => $text_color,
          'background_color'       => $background_color,
          'border_color_hover'     => $border_color_hover,
          'background_color_hover' => $background_color_hover,
          'text_color_hover'       => $text_color_hover,
          'btn_hover_effect'       => $btn_effect
        ));
      }
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style3':
      $output  =  '<div '.$id.' class="promo-box '.sanitize_html_class($bg_color).' style3'.$class.'"'.$custom_bg_color_style.'>';
      $output .=  '<div class="promo-box-inner">';
      $output .=  '<div class="promo-box-content">';
      $output .=  ($heading) ? '<h2'.$heading_color.'>'.esc_html($heading).'</h2>':'';
      $output .=  ($content) ? '<p'.$subheading_color.'>'.do_shortcode(wp_kses_data($content)).'</p>':'';
      $output .=  '</div>';
      if(!empty($btn_text) && !empty($btn_link)) {
        $output .=  '<div class="promo-box-actions">';
        $output .=  rs_buttons(array(
          'btn_style'              => $btn_style,
          'btn_link'               => $btn_link,
          'btn_text'               => $btn_text,
          'btn_color'              => $btn_color,
          'border_width'           => $border_width,
          'border_color'           => $border_color,
          'text_color'             => $text_color,
          'background_color'       => $background_color,
          'border_color_hover'     => $border_color_hover,
          'background_color_hover' => $background_color_hover,
          'text_color_hover'       => $text_color_hover,
          'btn_hover_effect'       => $btn_effect
        ));
        $output .=  '</div>';
      }
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style4':
      $output =  '<div '.$id.' class="promo-box style4'.$class.'">';
      $output .=  '<div class="promo-box-inner">';
      $output .=  '<div class="promo-box-content">';
      $output .=  '<div class="icon"'.$icon_color.'>';
      $output .=  '<i class="'.esc_attr($icon).'"></i>';
      $output .=  '</div>';
      $output .=  ( $heading ) ? '<h6'.$heading_color.'>'.esc_html($heading).'</h6>':'';
      $output .=  ( $content) ? '<p'.$subheading_color.'>'.wp_kses_data($content).'</p>':'';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;
    case 'style6':
    case 'style5':
      $output  =  '<div '.$id.' class="promo-box style5'.$class.'">';
      $output .=  '<div class="promo-box-inner">';
      $output .=  '<div class="promo-box-content">';
      $output .=  ($style == 'style5') ? '<h5'.$subheading_color.'>'.wp_kses_data($content).'</h5>':'<h3'.$subheading_color.'>'.wp_kses_data($content).'</h3>';
      $output .=  '</div>';
      if(!empty($btn_text) && !empty($btn_link)) {
        $output .=  '<div class="promo-box-actions">';
        $output .=  rs_buttons(array(
            'btn_style'              => $btn_style,
            'btn_link'               => $btn_link,
            'btn_text'               => $btn_text,
            'btn_color'              => $btn_color,
            'border_width'           => $border_width,
            'border_color'           => $border_color,
            'text_color'             => $text_color,
            'background_color'       => $background_color,
            'border_color_hover'     => $border_color_hover,
            'background_color_hover' => $background_color_hover,
            'text_color_hover'       => $text_color_hover,
            'btn_hover_effect'       => $btn_effect
          ));
        $output .=  '</div>';
      }
      $output .=  '</div>';
      $output .=  '</div>';
      break;

    case 'style7':
      $customize  = ( $custom_bg_color_hover ) ? true:false;
      $uniqid_class = '';
      if( $customize ) {
        $uniqid       = time().'-'.mt_rand();
        $custom_style = '';

        if( $custom_bg_color_hover ) {
          $custom_style .=  '.promo-custom-'.$uniqid.':hover {';
          $custom_style .=  ( $custom_bg_color_hover ) ? 'background:'.$custom_bg_color_hover.' !important;':'';
          $custom_style .= '}';
        }

        ts_add_inline_style( $custom_style );

        $uniqid_class = ' promo-custom-'. $uniqid;
      }
      if (function_exists('vc_parse_multi_attribute')) {
        $parse_args = vc_parse_multi_attribute($btn_link);
        $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
        $title      = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
        $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
      }
      $output  = '<a href="'.esc_url($href).'" class=" promo-box-container '.sanitize_html_class($full_width).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'">';
      $output .= '<div '.$id.' class="promo-box '.sanitize_html_class($bg_color).' style2 '.$class.$uniqid_class.'"'.$custom_bg_color_style.'>';
      $output .=  '<div class="container">';
      $output .=  '<div class="promo-box-inner">';
      $output .=  '<div class="promo-box-content">';
      $output .=  ($content) ? '<h2 class="big"'.$subheading_color.'>'.wp_kses_data($content).'</h2>':'';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</a>';
      break;

    case 'style9':
      $output  = '<div '.$id.' class="promo-box '.sanitize_html_class($bg_color).' style2 style2-alt '.$class.'"'.$custom_bg_color_style.'>';
      $output .=  '<div class="container">';
      $output .=  '<div class="promo-box-inner">';
      $output .=  '<div class="promo-box-content">';
      $output .=  ($heading) ? '<h2'.$heading_color.'>'.wp_kses_post($heading).'</h2>':'';
      $output .=  ($content) ? '<h5 class="big"'.$subheading_color.'>'.wp_kses_data($content).'</h5>':'';
      if(!empty($btn_text) && !empty($btn_link)) {
        $output .=  rs_buttons(array(
          'btn_style'              => $btn_style,
          'btn_link'               => $btn_link,
          'btn_text'               => $btn_text,
          'btn_color'              => $btn_color,
          'border_width'           => $border_width,
          'border_color'           => $border_color,
          'text_color'             => $text_color,
          'background_color'       => $background_color,
          'border_color_hover'     => $border_color_hover,
          'background_color_hover' => $background_color_hover,
          'text_color_hover'       => $text_color_hover,
          'btn_hover_effect'       => $btn_effect
        ));
      }
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      $output .=  '</div>';
      break;
    default:
      # code...
      break;
  }

  return $output;
}
add_shortcode('rs_promo_box', 'rs_promo_box');


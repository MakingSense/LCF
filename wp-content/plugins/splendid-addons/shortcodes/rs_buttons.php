<?php
/**
 *
 * Buttons
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_buttons( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'                       => '',
    'class'                    => '',
    'btn_color'                => '',
    'btn_icon'                 => 'no',
    'btn_hover_effect'         => '',
    'btn_style'                => 'style1',
    'icon'                     => '',
    'border_width'             => 'br-light',
    'btn_shape'                => 'btn-round',
    'btn_style'                => '',
    'btn_size'                 => '',
    'btn_link'                 => '',
    'btn_text'                 => '',
    'border_color'             => '',
    'overlay_background_color' => '',
    'background_color'         => '',
    'text_color'               => '',
    'icon_color'               => '',
    'border_color_hover'       => '',
    'background_color_hover'   => '',
    'text_color_hover'         => '',

  ), $atts ) );

  $id           = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class        = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $icon_html    = ( $icon && $btn_icon == 'yes' ) ? ' <i class="'.esc_attr($icon).' icon-before"></i>':'';
  $border_width = ( $btn_style == 'unfilled' ) ? ' '.sanitize_html_classes($border_width):'';
  $big_margin   = ( $btn_style == '') ? ' big-margin':' small-margin';
  $btn_effect   = ( $btn_hover_effect ) ? ' '.sanitize_html_classes($btn_hover_effect):'';
  $customize    = ( $overlay_background_color || $background_color || $border_color || $text_color || $icon_color || $border_color_hover || $background_color_hover || $text_color_hover ) ? true:false;
  $uniqid_class = '';

  $unfilled = $border_class = '';
  //$text_color_html = 'color-white';
  $text_color_html  = ( $btn_color == 'bg-light-gray' ) ? 'color-dark':'color-white';
  if( $btn_style == 'unfilled') {
    $unfilled        = 'unfilled';
    $border_class    = ' '.str_replace('bg', 'br-color', $btn_color);
    $text_color_html = str_replace('bg', 'color', $btn_color);
    $btn_color       = '';
  }

  if (function_exists('vc_parse_multi_attribute')) {
    $parse_args = vc_parse_multi_attribute($btn_link);
    $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
    $title      = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
    $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  }

  if( $customize ) {

    $uniqid       = time().'-'.mt_rand();
    $custom_style = '';

    if($background_color || $text_color || $border_color ) {
      $custom_style .=  '.btn-custom-'.$uniqid.'{';
      $custom_style .=  ( $background_color ) ? 'background:'.$background_color.' !important;':'';
      $custom_style .=  ( $border_color ) ? 'border-color:'.$border_color.' !important;':'';
      $custom_style .=  ( $text_color ) ? 'color:'.$text_color.' !important;':'';
      $custom_style .= '}';
    }

    if ($icon_color) {
      $custom_style .=  '.btn-custom-'.$uniqid.' i {';
      $custom_style .=  'color:'.$icon_color.' !important;';
      $custom_style .= '}';
    }

    if($background_color_hover || $text_color_hover || $border_color_hover ) {
      $custom_style .=  '.btn-custom-'.$uniqid.':hover {';
      $custom_style .=  ( $background_color_hover ) ? 'background:'.$background_color_hover.' !important;':'';
      $custom_style .=  ( $text_color_hover ) ? 'color:'.$text_color_hover.' !important;':'';
      $custom_style .=  ( $border_color_hover ) ? 'border-color:'.$border_color_hover.' !important;':'';
      $custom_style .= '}';
    }

    if( $overlay_background_color ) {
      $custom_style .=  '.btn-custom-'.$uniqid.':before {';
      $custom_style .=  ( $overlay_background_color ) ? 'background:'.$overlay_background_color.' !important;':'';
      $custom_style .= '}'; 
    }

    ts_add_inline_style( $custom_style );

    $uniqid_class = 'btn-custom-'. $uniqid;

  }

  return '<a '.$id.' class="button '.$btn_style.' '.sanitize_html_class($uniqid_class).$class.$border_class.$border_width.$big_margin.$btn_effect.' '.sanitize_html_class($btn_style).' '.sanitize_html_class($btn_color).' '.sanitize_html_class($btn_size).' '.sanitize_html_class($btn_shape).' '.$text_color_html.'" href="'.esc_url($href).'" title="'.esc_attr($title).'" target="'.esc_attr($target).'">'.$icon_html.'<span>'.esc_html($btn_text).'</span></a>';

}
add_shortcode( 'rs_buttons', 'rs_buttons' );

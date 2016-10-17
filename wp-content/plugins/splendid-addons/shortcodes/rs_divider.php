<?php
/**
 *
 * Divider
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_divider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'style'         => 'solid',
    'margin_top'    => '',
    'margin_bottom' => '',
    'icon'          => 'fa fa-adjust',
    'border_color'  => '',
    'icon_color'    => '',
  ), $atts ) );

  $id                = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class             = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $margin_top        = ( $margin_top ) ? 'margin-top:'.$margin_top.';':'';
  $margin_bottom     = ( $margin_bottom ) ? 'margin-bottom:'.$margin_bottom.';':'';
  $customize         = ( $border_color ) ? true:false;
  $border_color_attr = ( $border_color && $style !== 'with_icon' ) ? 'border-color:'.$border_color.';':'';
  $el_style          = ( $margin_top || $margin_bottom || $border_color_attr ) ? ' style="'.esc_attr($margin_top.$margin_bottom.$border_color_attr).'"':'';
  $el_icon_style     =  ( $icon_color ) ? ' style="color:'.esc_attr($icon_color).';"':'';

  $output = '';
  switch ($style) {
    case 'solid':
    case 'br-dashed':
    case 'br-dotted':
    case 'unique':
    default:
      $output .=  '<div '.$id.' class="divider '.$class.' '.$style.'"'.$el_style.'></div>'; 
      break;
    case 'with_icon':
      if( $customize ) {

      $uniqid       = time().'-'.mt_rand();
      $custom_style = '';

      if($border_color ) {
        $custom_style .=  '.divider-custom-'.$uniqid.':before, .divider-custom-'.$uniqid.':after {';
        $custom_style .=  ( $border_color ) ? 'background-color:'.$border_color.' !important;':'';
        $custom_style .= '}';
      }

      ts_add_inline_style( $custom_style );

      $uniqid_class = ' divider-custom-'. $uniqid;

    }
      $output .=  '<div '.$id.' class="iconic-divider'.$class.$uniqid_class.'"'.$el_style.'>';
      $output .=  '<i class="'.sanitize_html_classes($icon).'"'.$el_icon_style.'></i>';
      $output .=  '</div>';
      break;
  }

  return $output;


}
add_shortcode( 'rs_divider', 'rs_divider' );

<?php
/**
 *
 * RS Tabs
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_tabs( $atts, $content = '', $id = '' ) {

  global $rs_tabs;
  $rs_tabs = array();

  extract( shortcode_atts( array(
    'id'           => '',
    'class'        => '',
    'style'        => '',
    'active'       => 1,
    'accent_color' => '',
    'color'        => '',
    'align'        => ''
  ), $atts ) );

  do_shortcode( $content );

  if( empty( $rs_tabs ) ) { return; }

  $output           = '';
  $id               = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class            = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $style            = ( $style ) ? ' '.sanitize_html_classes($style):'';
  $align            = ( $align && $style == ' sidetabs' ) ? ' '.sanitize_html_classes($align):'';
  $tab_header_style = ( $style == ' style-modern' ) ? true:false;
  $accent_color     = str_replace('bg', 'style', $accent_color);
  $uniqid           = uniqid();

  $output .=  '<div '.$id.' class="tabs'.$class.$style.$align.' '.sanitize_html_class($accent_color).' '.sanitize_html_class($color).'">';
  $output .=  '<div class="tab-header">';
  $output .=  '<ul>';

  foreach( $rs_tabs as $key => $tab) {
    $icon               = ( isset($tab['atts']['icon'])) ? $tab['atts']['icon']:'fa fa-paper-plane-o';
    $image_icon         = ( isset($tab['atts']['image_icon'])) ? $tab['atts']['image_icon']:'';
    if( $tab_header_style && !empty($image_icon)) {
      $image_icon_url  = wp_get_attachment_image_src( $image_icon, 'full' );
      if(isset($image_icon_url[0])) {
        $title = '<img src="'.esc_url($image_icon_url[0]).'" alt="">';
      }
    } elseif( $tab_header_style && empty($image_icon)) {
      $title = '<i class="'.esc_attr($icon).'"></i>';
    } else {
      $title = esc_html($tab['atts']['title']);
    }
    $tab_header_color   = isset($tab['atts']['tab_header_color']) ? $tab['atts']['tab_header_color']:'';
    $active_nav         = ( ( $key + 1 ) == $active ) ? 'active-tab ' : '';
    $output            .= '<li class="'.$active_nav.$tab_header_color.'"><a href="#'.$uniqid.'-'.$key.'">'.$title.'</a></li>';
  }
  $output .=  '</ul>';
  $output .=  '</div>';
  $output .=  '<div class="tab-content">';
  foreach ($rs_tabs as $key => $tab) {
    $active_content = ( ( $key + 1 ) == $active ) ? ' in active' : '';
    $title          = $tab['atts']['title'];
    $output        .= '<div id="'.$uniqid.'-'.$key.'" class="tab '.$active_content.'">';
    $output        .= do_shortcode(wp_kses_post($tab['content']));
    $output        .= '</div>';
  }
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;

}
add_shortcode('vc_tabs', 'rs_tabs');

/**
 *
 * RS Tab
 * @version 1.0.0
 * @since 1.0.0
 *
 */
function rs_tab( $atts, $content = '', $id = '' ) {
  global $rs_tabs;
  $rs_tabs[]  = array( 'atts' => $atts, 'content' => $content );
  return;
}
add_shortcode('vc_tab', 'rs_tab');

<?php
/**
 *
 * RS Checklist
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_checklist( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'            => '',
    'class'         => '',
    'icon_bg_color' => '',
    'icon_style'    => 'style-check',
    'list_content'  => ''
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output = '<ul '.$id.' class="checklist '.sanitize_html_class($icon_style).' icon-'.sanitize_html_classes($icon_bg_color).$class.'">';
  if(!empty($list_content)) {
    $feature_list = explode('|', $list_content);
    for($i = 0; $i < count($feature_list); $i++) {
      $output .=  '<li>'.esc_html($feature_list[$i]).'</li>';
    }
  }
  $output .=  '</ul>';
  return $output;
}

add_shortcode('rs_checklist', 'rs_checklist');

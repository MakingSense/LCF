<?php

/**
 *
 * RS Content Box 2
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_content_box_2($atts, $content = '', $id = '') {

  global $rs_content_box_2;
  $rs_content_box_2 = array();

  extract(shortcode_atts(array(
    'id'            => '',
    'class'         => '',
  ), $atts));

  do_shortcode( $content );

  if( empty( $rs_content_box_2 ) ) { return; }

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';

  $output  = '<div '.$id.' class="content-boxes'.sanitize_html_classes($class).'">';
  foreach( $rs_content_box_2 as $key => $item) {
    $output .=  ($key % 3 == 0) ? '<div class="content-boxes-row">':'';
    $image             = ( isset($item['atts']['image'])) ? $item['atts']['image']:'';
    $content_color     = ( isset($item['atts']['content_color'])) ? $item['atts']['content_color']:'';
    $title_color       = ( isset($item['atts']['title_color'])) ? $item['atts']['title_color']:'';
    $data_stroke_color = ( isset($item['atts']['stroke_color'])) ? $item['atts']['stroke_color']:'#ecca42';
    $el_title_style    = ( $title_color ) ? ' style="color:'.esc_attr($title_color).';"':'';
    $el_content_style  = ( $content_color ) ? ' style="color:'.esc_attr($content_color).';"':'';
    $output .=  '<div class="content-box col-md-4 style12'.$animation.'"'.$animation_delay.'>';
    if(!empty($image) && is_numeric($image)) {
      $image_src = wp_get_attachment_image_src( $image, 'full' );
      if(isset($image_src[0])) {
        $output .=  '<div class="icon-container" data-animation-type="delayed" data-animation-delay="0" data-stroke-color="'.esc_attr($data_stroke_color).'">';
        $output .=  '<object type="image/svg+xml" data="'.esc_url($image_src[0]).'"></object>';
        $output .=  '</div>';
      }
    }
    $output .=  '<h6'.$el_title_style.'>'.esc_html($item['atts']['title']).'</h6>';
    $output .=  '<p'.$el_content_style.'>'.do_shortcode(wp_kses_data($item['content'])).'</p>';
    $output .=  '</div>';
    $output .=  (++$key % 3 == 0) ? '</div>':'';
  }
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_content_box_2', 'rs_content_box_2');

function rs_content_box_2_item($atts, $content = '', $id = '') {
  global $rs_content_box_2;
  $rs_content_box_2[]  = array( 'atts' => $atts, 'content' => $content );
  return;
}

add_shortcode('rs_content_box_2_item', 'rs_content_box_2_item');

<?php
/**
 *
 * RS Process Box
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_process_box( $atts, $content = '', $id = '' ) {

  global $rs_process_box;
  $rs_process_box = array();

  extract( shortcode_atts( array(
    'id'                    => '',
    'class'                 => '',
    'icon_color'            => '',
    'title_color'           => '',
    'icon_background_color' => '',
    'content_color'         => '',
    'animation'             => '',
    'animation_delay'       => ''
  ), $atts ) );

  do_shortcode( $content );

  if( empty( $rs_process_box ) ) { return; }


  $output                = '';
  $id                    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class                 = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $icon_color            = ( $icon_color ) ? 'color:'.$icon_color.';':'';
  $icon_background_color = ( $icon_background_color ) ? 'background:'.$icon_background_color.';':'';
  $el_icon_style         = ( $icon_color || $icon_background_color ) ? ' style="'.esc_attr($icon_color.$icon_background_color).'"':'';
  $title_color           = ( $title_color ) ? ' style="color:'.$title_color.';"':'';
  $content_color         = ( $content_color ) ? ' style="color:'.$content_color.';"':'';
  $animation             = ( $animation ) ? ' wow '. $animation : '';
  $animation_delay       = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';


  $output .=  '<div '.$id.' class="sc-process-box'.$class.$animation.'"'.$animation_delay.'>';
  $count_item = count($rs_process_box);
  foreach( $rs_process_box as $key => $process) {
    $align_class     = ( $key % 2 == 0 ) ? 'style-left':'style-right';
    $last_class      = ( $key == ( $count_item - 1 ) ) ? ' last':'';
    $icon_image      = isset($process['atts']['icon_image']) ? $process['atts']['icon_image']:'';
    $icon_image      = (!empty($icon_image)) ? $icon_image:'';
    $title           = isset($process['atts']['title']) ? $process['atts']['title']:'';
    $icon            = isset($process['atts']['icon']) ? $process['atts']['icon']:'';
    $output         .= '<div class="process-item '.sanitize_html_classes($align_class).$last_class.'">';
    if( $align_class == 'style-left' ) {
      $output .=  '<div class="content">';
      $output .=  '<div class="content-inner">';
      $output .=  '<h6'.$title_color.'><b>'.esc_html($title).'</b></h6>';
      $output .=  '<p'.$content_color.'>'.wp_kses_data($process['content']).'</p>';
      $output .=  '</div>';
      $output .=  '</div>';
      if(!empty($icon_image) && is_numeric($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon">';
          $output .=  '<div class="icon-inner"'.$el_icon_style.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon">';
        $output .=  '<div class="icon-inner"'.$el_icon_style.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
        $output .=  '</div>';
      }

      $output .=  '<div class="line">';
      $output .=  '<div class="line-inner"></div>';
      $output .=  '</div>';
    } else {
      $output .=  '<div class="line">';
      $output .=  '<div class="line-inner"></div>';
      $output .=  '</div>';

      if(!empty($icon_image) && is_numeric($icon_image)) {
        $icon_src = wp_get_attachment_image_src( $icon_image, 'full' );
        if(isset($icon_src[0])) {
          $output .=  '<div class="icon">';
          $output .=  '<div class="icon-inner"'.$el_icon_style.'>';
          $output .=  '<img src="'.esc_url($icon_src[0]).'" alt="">';
          $output .=  '</div>';
          $output .=  '</div>';
        }
      } else {
        $output .=  '<div class="icon">';
        $output .=  '<div class="icon-inner"'.$el_icon_style.'>';
        $output .=  '<i class="'.esc_attr($icon).'"></i>';
        $output .=  '</div>';
        $output .=  '</div>';
      }

      $output .=  '<div class="content">';
      $output .=  '<div class="content-inner">';
      $output .=  '<h6'.$title_color.'><b>'.esc_html($title).'</b></h6>';
      $output .=  '<p'.$content_color.'>'.wp_kses_data($process['content']).'</p>';
      $output .=  '</div>';
      $output .=  '</div>';
    }
    $output .=  '</div>';
    //$count_process++;
  }
  $output .=  '</div>';


  return $output;

}
add_shortcode('rs_process_box', 'rs_process_box');

/**
 *
 * RS Process Box Item
 * @version 1.0.0
 * @since 1.0.0
 *
 */
function rs_process_box_item( $atts, $content = '', $id = '' ) {
  global $rs_process_box;
  $rs_process_box[]  = array( 'atts' => $atts, 'content' => $content );
  return;
}
add_shortcode('rs_process_box_item', 'rs_process_box_item');

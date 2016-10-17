<?php
/**
 *
 * Gallery Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 */

function rs_grid_gallery( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'     => '',
    'class'  => '',
    'images' => '',
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output = '';
  if( !empty($images)) {
    $images = explode(',', $images);
    $output .=  '<ul '.$id.' class="grid-gallery'.$class.'">';
    foreach($images as $image) {
      $image_src       = wp_get_attachment_image_src( $image, 'full' );
      $image_src_thumb = wp_get_attachment_image_src( $image, 'thumb' );
      if(isset($image_src[0])) {
        $output .=  '<li>';
        $output .=  '<a data-gal="prettyPhoto[gallery1]" href="'.esc_url($image_src[0]).'"><img src="'.esc_url($image_src_thumb[0]).'" alt=""></a>';
        $output .=  '</li>';
      }
    }
    $output .=  '</ul>';
  }

  return $output;

}
add_shortcode( 'rs_grid_gallery', 'rs_grid_gallery' );

<?php
/**
 *
 * Gallery Slider
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function rs_gallery_slider( $atts, $content = '', $id = '' ) {

  extract( shortcode_atts( array(
    'id'           => '',
    'class'        => '',
    'images'       => '',
    'style'        => 'style1',
    'slider_thumb' => 'yes'
  ), $atts ) );

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' '. sanitize_html_classes($class) : '';

  $output = '';
  switch ($style) {
    case 'style1':
      if( !empty($images)) {
        $images = explode(',', $images);
        $output .=  '<div '.$id.' class="flexslider gallery-slider'.$class.'">';
        $output .=  '<ul class="slides">';
        foreach($images as $image) {
          $image_src       = wp_get_attachment_image_src( $image, 'full' );
          $image_src_thumb = wp_get_attachment_image_src( $image, 'thumb' );
          if(isset($image_src[0])) {
            $output .=  '<li data-thumb="'.esc_url($image_src_thumb[0]).'">';
            $output .=  '<img src="'.esc_url($image_src[0]).'" alt="">';
            $output .=  '</li>';
          }
        }
        $output .=  '</ul>';
        $output .=  '</div>';
      }
      break;

    case 'style2':
      if(!empty($images)) {
        $images = explode(',', $images);
        $output .=  ($slider_thumb == 'yes') ? '<div '.$id.' class="slider-gallery'.$class.'">':'';
        $output .=  '<div '.$id.' class="post-gallery flexslider'.$class.'">';
        $output .=  '<ul class="slides">';
        foreach($images as $image) {
          $image_src = wp_get_attachment_image_src( $image, 'full' );
          if(isset($image_src[0])) {
            $output .=  '<li><img src="'.esc_url($image_src[0]).'" alt=""></li>'; // here loops goes
          }
        }
        $output .=  '</ul>';
        $output .=  '</div>';

        if($slider_thumb == 'yes') {
          $output .=  '<div class="slider-thumbs">';
          $output .=  '<ul>';
          foreach($images as $image) {
            $image_src_thumb = wp_get_attachment_image_src( $image, 'full' );
            $image_src_lightbox = wp_get_attachment_image_src( $image, 'full' );
            $output .=  '<li>';
            if(isset($image_src_thumb[0])) {
              $output .=  '<img src="'.esc_url($image_src_thumb[0]).'" alt="">';
            }
            if(isset($image_src_lightbox[0])) {
              $output .=  '<div class="thumb-hover">';
              $output .=  '<a href="'.esc_url($image_src_lightbox[0]).'" data-gal="prettyPhoto" class="portfolio-hover-button zoom-icon">Zoom</a>';
              $output .=  '</div>';
            }
            $output .=  '</li>';
          }
          $output .=  '</ul>';
          $output .=  '</div>';
        }

        $output .=  ($slider_thumb == 'yes') ? '</div>':'';
      }
      break;

    default:
      # code...
      break;
  }

  return $output;

}
add_shortcode( 'rs_gallery_slider', 'rs_gallery_slider' );

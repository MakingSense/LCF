<?php
/**
 *
 * VC Column Text
 * @since 1.0.0
 * @version 1.0.0
 *
 */
function vc_column_text( $atts, $content = '', $id = '' ){

  extract( shortcode_atts( array(
    'id'              => '',
    'class'           => '',
    'align'           => '',
    'text_size'       => '',
    'text_color'      => '',
    'line_height'     => '',
    'letter_spacing'  => '',
    'animate'         => '',
    'data_sb'         => 'enter',
    'data_from'       => '0',
    'data_to'         => '0',
    'data_opacity'    => '0',
    'data_scale'      => '',
    'data_translatey' => '',
    'font'            => 'default',
    'font_weight'     => '300',
    'font_style'      => 'normal',
  ), $atts ) );

  $id              = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class           = ( $class ) ? ' '. sanitize_html_classes($class) : '';
  $align           = ( $align ) ? ' align-'.$align:'';
  $animate_class   = ( $animate == 'yes') ? ' animateme':'';
  $data_sb         = ( $data_sb ) ? ' data-when="'.esc_attr($data_sb).'"':'';
  $data_from       = ' data-from="'.esc_attr($data_from).'"';
  $data_to         = ' data-to="'.esc_attr($data_to).'"';
  $data_opacity    = ' data-opacity="'.esc_attr($data_opacity).'"';
  $data_scale      = ( $data_scale ) ? ' data-scale="'.esc_attr($data_scale).'"':'';
  $data_translatey = ( $data_translatey ) ? ' data-translatey="'.esc_attr($data_translatey).'"':'';

  $customize      = ($font || $font_style || $font_weight ) ? true:false;
  $text_size      = ( $text_size )? 'font-size:'.$text_size.';':'';
  $text_color     = ( $text_color )? 'color:'.$text_color.';':'';
  $line_height    = ( $line_height )? 'line-height:'.$line_height.';':'';
  $letter_spacing = ( $letter_spacing )? 'letter-spacing:'.$letter_spacing.';':'';
  $el_style       = ( $text_size || $text_color ) ? 'style="'.esc_attr($text_color.$text_size.$line_height.$letter_spacing).'"':'';

  if ($font == 'default') {
    $font = '';
  }
  
  $output =  $uniqid_class = '';
  if(strpos($font, 'google') !== false) {
    $font_weight_type = ($font_style == 'italic' && $font_weight ) ? $font_weight.$font_style:$font_weight;
    $ifont_name  = str_replace('google_web_font_', '', $font);
    $font_name  = str_replace(' ', '+', $ifont_name);
    $output .=  "<link href='http://fonts.googleapis.com/css?family=".esc_attr($font_name).":".esc_attr($font_weight_type).", 400, 300, 600' rel='stylesheet' type='text/css'>";
  } else {
    $ifont_name = $font;
  }

  if( $customize ) {

    $uniqid       = time().'-'.mt_rand();
    $custom_style = '';

    $custom_style .=  '.custom-font-text-'.$uniqid.'{';
    $custom_style .=  ($font) ? 'font-family:'.$ifont_name.', san-serif;':'';
    $custom_style .=  ($font_weight) ? 'font-weight:'.$font_weight.';':'';
    $custom_style .=  ($font_style) ? 'font-style:'.$font_style.';':'';
    $custom_style .= '}';

    ts_add_inline_style( $custom_style );

    $uniqid_class = ' custom-font-text-'. $uniqid;

  }

  $output .= '<div class="section-text text-block'.$class.$uniqid_class.' '.sanitize_html_class($align).$animate_class.'" '.$id.''.$el_style.$data_sb.$data_from.$data_to.$data_opacity.$data_scale.$data_translatey.'>'.rs_set_wpautop($content).'</div>';
  return $output;
}
add_shortcode( 'vc_column_text', 'vc_column_text');

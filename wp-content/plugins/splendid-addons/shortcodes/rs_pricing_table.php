<?php

/**
 *
 * RS Pricing Table
 * @since 1.0.0
 * @version 1.0.0
 *
 *
 */
function rs_pricing_table($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'id'    => '',
    'class' => '',
    'color' => 'style-default',
  ), $atts));

  $id    = ( $id ) ? ' id="'. esc_attr($id) .'"' : '';
  $class = ( $class ) ? ' ' . sanitize_html_classes($class) : '';

  global $rs_pricing_color;
  $rs_pricing_color = $color;

  $output  =  '<article '.$id.' class="pricing-tables'.$class.'">';
  $output .=  do_shortcode(wp_kses_data($content));
  $output .= '</article>';

  return $output;
}

add_shortcode('rs_pricing_table', 'rs_pricing_table');

function rs_pricing_table_item($atts, $content = '', $id = '') {

  extract(shortcode_atts(array(
    'title'                         => '',
    'feature'                       => '',
    'currency'                      => '',
    'is_featured'                   => 'no',
    'subtitle'                      => '',
    'price'                         => '',
    'period'                        => '',
    'small_price'                   => '',
    'btn_text'                      => '',
    'btn_link'                      => '',
    'title_background_color'        => '',
    'title_text_color'              => '',
    'price_text_color'              => '',
    'header_border_color'           => '',
    'content_text_color'            => '',
    'feature_bullet_color'          => '',
    'feature_text_color'            => '',
    'feature_text_background_color' => '',
    'btn_background_color'          => '',
    'currency_color'                => '',
    'title_border_color'            => '',
    'btn_text_color'                => '',
    'overlay_background_color'      => '',
    'btn_background_color_hover'    => '',
    'btn_text_color_hover'          => '',
    'animation'                     => '',
    'btn_hover_effect'              => '',
    'animation_delay'               => '',
    'btn_border_color'              => '',
    'btn_border_hover_color'        => ''

  ), $atts));

  global $rs_pricing_color;
  $customize          = ( $btn_border_color || $btn_border_hover_color || $overlay_background_color || $btn_background_color || $btn_text_color || $btn_background_color_hover || $btn_text_color_hover || $feature_bullet_color ) ? true:false;
  $uniqid_class       = '';
  $is_featured_class  = ( $is_featured == 'yes' ) ? ' featured':'';
  $btn_hover_effect   = ( $btn_hover_effect ) ? ' '.sanitize_html_classes($btn_hover_effect):'';

  $title_background_color        = ( $title_background_color ) ? 'background:'.esc_attr($title_background_color).';':'';
  $title_text_color              = ( $title_text_color ) ? 'color:'.esc_attr($title_text_color).';':'';
  $title_border_color            = ( $title_border_color ) ? 'border-color:'.esc_attr($title_border_color).';':'';
  $feature_text_color            = ( $feature_text_color ) ? 'color:'.esc_attr($feature_text_color).';':'';
  $feature_text_background_color = ( $feature_text_background_color ) ? 'background:'.esc_attr($feature_text_background_color).';':'';
  $el_title_style                = ( $title_background_color || $title_text_color || $title_border_color ) ? ' style="'.$title_border_color.$title_background_color.$title_text_color.'"':'';
  $el_feature_style              = ( $feature_text_background_color || $feature_text_color ) ? ' style="'.$feature_text_background_color.$feature_text_color.'"':'';
  $el_price_text_color           = ( $price_text_color ) ? ' style="color:'.esc_attr($price_text_color).';"':'';
  $el_content_color              = ( $content_text_color ) ? ' style="color:'.esc_attr($content_text_color).';"':'';
  $el_currency_color             = ( $currency_color ) ? ' style="color:'.esc_attr($currency_color).';"':'';
  $animation                     = ( $animation ) ? ' wow '. $animation : '';
  $animation_delay               = ( $animation_delay ) ? ' data-wow-delay="'.esc_attr($animation_delay).'s"':'';

  $custom_style = '';
  $uniqid       = time().'-'.mt_rand();
  if( $customize ) {
    
    if( $feature_bullet_color && $rs_pricing_color == 'style-dark' ) {
      $custom_style .= '.custom-pricing-'.$uniqid.' ul li:before {';
      $custom_style .=  ( $feature_bullet_color ) ? 'border-color:'.$feature_bullet_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $feature_bullet_color && $rs_pricing_color == 'style-default' ) {
      $custom_style .= '.custom-pricing-'.$uniqid.' ul li:before {';
      $custom_style .=  ( $feature_bullet_color ) ? 'color:'.$feature_bullet_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $btn_background_color || $btn_text_color ) {
      $custom_style .= '.custom-pricing-'.$uniqid.' footer a.bg-blue {';
      $custom_style .=  ( $btn_background_color ) ? 'background:'.$btn_background_color.' !important;':'';
      $custom_style .=  ( $btn_text_color ) ? 'color:'.$btn_text_color.' !important;':'';
      $custom_style .= '}';
    }

    if( $btn_text_color_hover || $btn_background_color_hover ) {
      $custom_style .= '.custom-pricing-'.$uniqid.' footer a.bg-blue:hover {';
      $custom_style .=  ( $btn_background_color_hover ) ? 'background:'.$btn_background_color_hover.' !important;':'';
      $custom_style .=  ( $btn_text_color_hover ) ? 'color:'.$btn_text_color_hover.' !important;':'';
      $custom_style .= '}';
    }

    if( $overlay_background_color ) {
      $custom_style .= '.custom-pricing-'.$uniqid.' a.button:before {';
      $custom_style .=  ( $overlay_background_color ) ? 'background:'.$overlay_background_color.' !important;':'';
      $custom_style .= '}'; 
    }

    if( $btn_border_color ) {
      $custom_style .= '.custom-pricing-'.$uniqid.' a.button {';
      $custom_style .=  ( $btn_border_color ) ? 'border-color:'.$btn_border_color.' !important;':'';
      $custom_style .= '}'; 
    }

    if( $btn_border_hover_color ) {
      $custom_style .= '.custom-pricing-'.$uniqid.' a.button:hover {';
      $custom_style .=  ( $btn_border_hover_color ) ? 'border-color:'.$btn_border_hover_color.' !important;':'';
      $custom_style .= '}'; 
    }

  }

  ts_add_inline_style( $custom_style );
  $uniqid_class = ' custom-pricing-'. $uniqid;

  $href = $target = $btn_title = '';
  if (function_exists('vc_parse_multi_attribute')) {
    $parse_args = vc_parse_multi_attribute($btn_link);
    $href       = ( isset($parse_args['url']) ) ? $parse_args['url'] : '#';
    $btn_title  = ( isset($parse_args['title']) ) ? $parse_args['title'] : 'button';
    $target     = ( isset($parse_args['target']) ) ? trim($parse_args['target']) : '_self';
  }

  $output  = '';
  $output .=  '<div class="pricing-table'.$is_featured_class.' '.$rs_pricing_color.$uniqid_class.$animation.'"'.$animation_delay.'>';
  $output .=  '<div class="pricing-table-inner"'.$el_content_color.'>';
  $output .=  '<header'.$el_title_style.'>';
  $output .=  ( $is_featured == 'yes' && !empty($subtitle)) ? '<span class="pricing-table-tag"'.$el_feature_style.'>'.esc_html($subtitle).'</span>':'';
  $output .=  '<h4>'.esc_html($title).'</h4>';
  $output .=  '</header>';
  $output .=  '<div class="pricing">';
  $output .=  '<span class="currency"'.$el_currency_color.'>'.esc_html($currency).'</span>';
  $output .=  '<span class="price"'.$el_price_text_color.'>'.esc_html($price).'</span>';
  $output .=  '<span class="inline-blocks">';
  $output .=  '<span class="price small"'.$el_price_text_color.'>'.esc_html($small_price).'</span>';
  $output .=  '<span class="period"'.$el_currency_color.'>'.esc_html($period).'</span>';
  $output .=  '</span>';
  $output .=  '</div>';
  $output .=  '<ul class="features">';
  $feature_list = explode('|', $feature);
  for($i = 0; $i < count($feature_list); $i++) {
    $output .=  '<li>'.esc_html($feature_list[$i]).'</li>';
  }
  $output .=  '</ul>';
  $output .=  '<footer>';
  $output .=  '<a href="'.esc_url($href).'" target="'.esc_attr($target).'" title="'.esc_attr($btn_title).'" class="button bg-blue color-white'.$btn_hover_effect.'"><span>'.esc_html($btn_text).'</span></a>';
  $output .=  '</footer>';
  $output .=  '</div>';
  $output .=  '</div>';

  return $output;
}

add_shortcode('rs_pricing_table_item', 'rs_pricing_table_item');



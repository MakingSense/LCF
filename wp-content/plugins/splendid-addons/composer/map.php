<?php
/*
* Visual Composre Map File
*/
function rs_get_current_post_type() {

  $type = false;

  if( isset( $_GET['post'] ) ) {
    $id = $_GET['post'];
    $post = get_post( $id );

    if( is_object( $post ) && $post->post_type == 'portfolio' ) {
      $type = true;
    }

  } elseif ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'portfolio' ) {
    $type = true;
  }

  return $type;

}

include_once( RS_ROOT .'/composer/helpers.php' );
include_once( RS_ROOT .'/composer/params.php' );

if ( ! function_exists( 'is_plugin_active' ) ) {
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // Require plugin.php to use is_plugin_active() below
}

// Extras
// ------------------------------------------------------------------------------------------
$vc_theme_color = array(
  'Select Color'   => '',
  'Blue'           => 'bg-blue',
  'Dark Gray'      => 'bg-dark-gray',
  'Cranberry'      => 'bg-cranberry',
  'Light Blue'     => 'bg-light-blue',
  'Dark Green'     => 'bg-dark-green',
  'Red'            => 'bg-red',
  'Purple'         => 'bg-purple',
  'Bittersweet'    => 'bg-bittersweet',
  'Turquoise Blue' => 'bg-turquoise-blue',
  'Green'          => 'bg-green',
  'Orange'         => 'bg-orange',
  'Pink'           => 'bg-pink',
  'Dark Orange'    => 'bg-dark-orange',
  'Turquoise'      => 'bg-turquoise',
  'Gray'           => 'bg-gray',
  'Sliver'         => 'bg-silver',
  'Light Gray'     => 'bg-light-gray',
  'Black'          => 'bg-black',
  'White'          => 'bg-white',
);

$vc_column_width_list = array(
  '1 column - 1/12'     => '1/12',
  '2 columns - 1/6'     => '1/6',
  '3 columns - 1/4'     => '1/4',
  '4 columns - 1/3'     => '1/3',
  '5 columns - 5/12'    => '5/12',
  '6 columns - 1/2'     => '1/2',
  '7 columns - 7/12'    => '7/12',
  '8 columns - 2/3'     => '2/3',
  '9 columns - 3/4'     => '3/4',
  '10 columns - 5/6'    => '5/6',
  '11 columns - 11/12'  => '11/12',
  '12 columns - 1/1'    => '1/1'
);

$vc_map_extra_id = array(
  'type'        => 'textfield',
  'heading'     => 'Extra ID',
  'param_name'  => 'id',
  'group'       => 'Extras'
);

$vc_map_extra_class = array(
  'type'        => 'textfield',
  'heading'     => 'Extra Class',
  'param_name'  => 'class',
  'group'       => 'Extras'
);

// ==========================================================================================
// VC ROW
// ==========================================================================================
vc_map( array(
  'name'                    => 'Row',
  'base'                    => 'vc_row',
  'icon'                    => 'fa fa-plus-square-o',
  'is_container'            => true,
  'show_settings_on_create' => false,
  'description'             => 'Place content elements inside the section',
  'params'                  => array(
    array(
      'type'                => 'dropdown',
      'value'               => array(
        'No'                    => 'no',
        'Stretch Row Only'      => 'stretch_row_only',
        'Stretch Row & Content' => 'stretch_row_content',
      ),
      'heading'             => '100% Full-width, without container',
      'param_name'          => 'fluid',
    ),

    array(
      'type'                => 'dropdown',
      'param_name'          => 'parallax',
      'heading'             => 'Parallax',
      'value'               => array(
        'No'  => 'no',
        'Yes' => 'yes'
      ),
    ),

    array(
      'type'        => 'textfield',
      'param_name'  => 'parallax_stellar_ratio',
      'heading'     => 'Parallax Stellar Ratio',
      'description' => 'Enter stellar ratio in between 0-1.',
      'dependency'  => array( 'element' => 'parallax', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'textfield',
      'param_name'  => 'parallax_stellar_hor_offset',
      'heading'     => 'Parallax Stellar Horizontal Offset',
      'description' => 'Enter stellar ratio in between 0-100.',
      'dependency'  => array( 'element' => 'parallax', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'textfield',
      'param_name'  => 'parallax_stellar_ver_offset',
      'heading'     => 'Parallax Stellar Vertical Offset',
      'description' => 'Enter stellar ratio in between 0-100.',
      'dependency'  => array( 'element' => 'parallax', 'value' => array('yes') ),
    ),

    //Padding
    array(
      'type'                => 'dropdown',
      'param_name'          => 'padding_top',
      'heading'             => 'Padding Top',
      'value'               => array(
        'Choose or use Design Options' => '',
        'Small'                        => 'padding_t_40',
        'Medium'                       => 'padding_t_60',
        'Big'                          => 'padding_t_80',
        'Custom Padding'               => 'custom-padding'
      ),
    ),

    array(
      'type'                => 'textfield',
      'heading'             => 'Custom Padding Top',
      'param_name'          => 'custom_padding_top',
      'dependency'          => array( 'element' => 'padding_top', 'value' => array('custom-padding') ),
    ),

    array(
      'type'                => 'dropdown',
      'param_name'          => 'padding_bottom',
      'heading'             => 'Padding Bottom',
      'value'               => array(
        'Choose or use Design Options' => '',
        'Small'                        => 'padding_b_40',
        'Medium'                       => 'padding_b_60',
        'Big'                          => 'padding_b_80',
        'Custom Padding'               => 'custom-padding'
      ),
    ),

    array(
      'type'                => 'textfield',
      'heading'             => 'Custom Padding Bottom',
      'param_name'          => 'custom_padding_bottom',
      'dependency'          => array( 'element' => 'padding_bottom', 'value' => array('custom-padding') ),
    ),

    //Margin
    array(
      'type'                => 'dropdown',
      'param_name'          => 'margin_top',
      'heading'             => 'Margin Top',
      'value'               => array(
        'Choose or use Design Options' => '',
        'Small'                        => 'margin_t_40',
        'Medium'                       => 'margin_t_60',
        'Big'                          => 'margin_t_80',
        'Custom Margin'                => 'custom-margin'
      ),
    ),

    array(
      'type'                => 'dropdown',
      'param_name'          => 'margin_bottom',
      'heading'             => 'Margin Bottom',
      'value'               => array(
        'Choose or use Design Options' => '',
        'Small'                        => 'margin_b_40',
        'Medium'                       => 'margin_b_60',
        'Big'                          => 'margin_b_80',
        'Custom Margin'                => 'custom-margin'
      ),
    ),

    array(
      'type'                => 'dropdown',
      'param_name'          => 'bg_position',
      'heading'             => 'Background Position',
      'value'               => array(
        'Choose or use Design Options' => '',
        'Center Center'                => 'center center',
        'Left Top'                     => 'left top',
        'Left Center'                  => 'left center',
        'Left Bottom'                  => 'left bottom',
        'Right Top'                    => 'right top',
        'Right Center'                 => 'right center',
        'Right Bottom'                 => 'right bottom',
        'Center Top'                   => 'center top',
        'Center Bottom'                => 'center bottom',
        'Custom Position'              => 'custom-position',
      ),
    ),

    array(
      'type'                => 'textfield',
      'heading'             => 'Custom Position',
      'param_name'          => 'custom_position',
      'dependency'          => array( 'element' => 'bg_position', 'value' => array('custom-position') ),
    ),

    array(
      'type'                => 'dropdown',
      'param_name'          => 'bg_size',
      'heading'             => 'Background Size',
      'value'               => array(
        'Choose or use Design Options' => '',
        'Cover'                        => 'cover',
        'Contain'                      => 'contain',
        'Auto'                         => 'auto',
        'Custom Size'                  => 'custom-size',
      ),
    ),

    array(
      'type'                => 'textfield',
      'heading'             => 'Custom Size',
      'param_name'          => 'custom_size',
      'dependency'          => array( 'element' => 'bg_size', 'value' => array('custom-size') ),
    ),

    array(
      'type'                => 'checkbox',
      'param_name'          => 'attributes',
      'heading'             => 'Attributes',
      'value'               => array(
        'Shadow Top'       => 'shadowed',
        'Shadow Bottom'    => 'shadowed2',
        'Split Section'    => 'section-splitted',
        'Border'           => 'bordered',
        'Text Color White' => 'color-light',
      ),
    ),

  array(
    'type' => 'css_editor',
    'heading' => esc_html__( 'CSS box', 'js_composer' ),
    'param_name' => 'css',
    'group' => esc_html__( 'Design Options', 'js_composer' )
  ),
    // Extras
    // ------------------------------------------------------------------------------------------
   $vc_map_extra_id,
   $vc_map_extra_class,

  ),
  'js_view'                 => 'VcRowView'
) );

// ==========================================================================================
// VC ROW INNER
// ==========================================================================================
vc_map( array(
  'name'                    => 'Row',
  'base'                    => 'vc_row_inner',
  'icon'                    => 'fa fa-plus-square-o',
  'is_container'            => true,
  'content_element'         => false,
  'show_settings_on_create' => false,
  'weight'                  => 1000,
  'js_view'                 => 'VcRowView'
) );

// ==========================================================================================
// VC COLUMN
// ==========================================================================================
vc_map( array(
  'name'            => 'Column',
  'base'            => 'vc_column',
  'is_container'    => true,
  'content_element' => false,
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Align',
      'param_name'  => 'align',
      'value'       => array(
        'Select Alignment'  => '',
        'Left'              => 'left',
        'Center'            => 'center',
        'Right'             => 'right',
      ),
    ),
    array(
      'type'  => 'dropdown',
      'value' => array(
        'Yes' => 'yes',
        'No'  => 'no',
      ),
      'heading'    => 'Padding',
      'param_name' => 'is_padding',
      'description' => 'No padding deducts all sides padding i.e left and right both.'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Column Class Type',
      'param_name'  => 'class_type',
      'value'       => array(
        'col-md-x' => 'md',
        'col-sm-x' => 'sm',
      ),
      'description' => 'This is optional, leave default for default settings.'
    ),
    array(
      'type' => 'dropdown',
      'heading' => 'Width',
      'param_name' => 'width',
      'value' => $vc_column_width_list,
      'group' => 'Width & Responsiveness',
      'description' => 'Select column width.',
      'std' => '1/1'
    ),
    array(
      'type' => 'column_offset',
      'heading' => 'Responsiveness',
      'param_name' => 'offset',
      'group' => 'Width & Responsiveness',
      'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
    ),
    array(
      'type' => 'css_editor',
      'heading' => esc_html__( 'CSS box', 'js_composer' ),
      'param_name' => 'css',
      'group' => esc_html__( 'Design Options', 'js_composer' )
    ),
    rs_get_animation_param('animation', 'Animation'),
    rs_get_animation_delay_param('animation_delay', 'Animation', 'animation'),
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
  'js_view'         => 'VcColumnView'
) );


// ==========================================================================================
// VC COLUMN INNER
// ==========================================================================================
vc_map( array(
  'name'                      => 'Column',
  'base'                      => 'vc_column_inner',
  'class'                     => '',
  'icon'                      => '',
  'wrapper_class'             => '',
  'controls'                  => 'full',
  'allowed_container_element' => false,
  'content_element'           => false,
  'is_container'              => true,
  'params'                    => array(
    array(
      'type'  => 'dropdown',
      'value' => array(
        'Yes' => 'yes',
        'No'  => 'no',
      ),
      'heading'    => 'Padding',
      'param_name' => 'padding',
      'description' => 'No padding deducts all sides padding i.e left and right both.'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Column Class Type',
      'param_name'  => 'class_type',
      'value'       => array(
        'col-md-x' => 'md',
        'col-sm-x' => 'sm',
      ),
      'description' => 'This is optional, leave default for default settings.'
    ),
    array(
      'type' => 'dropdown',
      'heading' => 'Width',
      'param_name' => 'width',
      'value' => $vc_column_width_list,
      'group' => 'Width & Responsiveness',
      'description' => 'Select column width.',
      'std' => '1/1'
    ),
    array(
      'type' => 'column_offset',
      'heading' => 'Responsiveness',
      'param_name' => 'offset',
      'group' => 'Width & Responsiveness',
      'description' => 'Adjust column for different screen sizes. Control width, offset and visibility settings.',
    ),
    rs_get_animation_param('animation', 'Animation'),
    rs_get_animation_delay_param('animation_delay', 'Animation', 'animation'),
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
  'js_view'                   => 'VcColumnView'
) );

// ==========================================================================================
// SECTION TITLE
// ==========================================================================================
vc_map( array(
  'name'          => 'Section Title',
  'base'          => 'rs_section_title',
  'icon'          => 'fa fa-italic',
  'description'   => 'Create title for section.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'holder'      => 'h2',
      'value'       => ''
    ),
    // Custom Colors
    array(
      'type'        => 'dropdown',
      'heading'     => 'Title Font Weight',
      'param_name'  => 'title_font_weight',
      'value'       => array(
        'Select Weight' => '',
        'Thin'       => 'thin',
        'Regular'    => 'regular',
        'Bold'       => 'bold',
        'Extra Bold' => 'extra-bold',
      ),
      'group'       => 'Font Weight Properties',
    ),

    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'group'       => 'Custom Colors',
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Title Size',
      'param_name'  => 'title_size',
      'admin_label' => true,
      'description' => 'Add size in pixels e.g 15px',
      'group'       => 'Font Size Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title Margin Top',
      'param_name'  => 'top',
      'admin_label' => true,
      'group'       => 'Margin Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title Margin Bottom',
      'param_name'  => 'bottom',
      'admin_label' => true,
      'group'       => 'Margin Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// GOOGLE MAP
// ==========================================================================================
vc_map( array(
  'name'          => 'Google Map',
  'base'          => 'rs_google_map',
  'icon'          => 'fa fa-map-marker',
  'description'   => 'Add google map.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Latitude',
      'param_name'  => 'latidude',
      'admin_label' => true
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Longitude',
      'param_name'  => 'longitude',
      'admin_label' => true
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Zoom Size',
      'param_name'  => 'zoom_size',
      'admin_label' => true
    ),

    array(
      'type'        => 'attach_image',
      'heading'     => 'Marker',
      'param_name'  => 'custom_marker',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// FAQ
// ==========================================================================================
vc_map( array(
  'name'          => 'FAQ',
  'base'          => 'rs_faq',
  'icon'          => 'fa fa-map-marker',
  'description'   => 'Add faq.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'holder'      => 'h2'
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div'
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// SHOP BOX
// ==========================================================================================
vc_map( array(
  'name'          => 'Shop Box',
  'base'          => 'rs_shop_box',
  'icon'          => 'fa fa-map-marker',
  'description'   => 'Add shop box.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1'   => 'style1',
        'Style 2'   => 'style2',
        'Style 3'   => 'style3'
      ),
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Background',
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Heading',
      'param_name'  => 'small_heading',
      'holder'      => 'h4'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Big Heading',
      'param_name'  => 'big_heading',
      'holder'      => 'h2',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Additonal Text',
      'param_name'  => 'additional_text',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// SOCIAL SHARE
// ==========================================================================================
vc_map( array(
  'name'          => 'Social Share',
  'base'          => 'rs_social_share',
  'icon'          => 'fa fa-map-marker',
  'description'   => 'Add social share.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style3',
        'Style 4' => 'style4',
      ),
      'admin_label' => true
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title (optional)',
      'param_name'  => 'title',
      'description' => 'Enter title e.g Share this Item with your friends'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Share Count',
      'param_name'  => 'share_count',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Facebook URL',
      'param_name'  => 'facebook_url',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Twitter URL',
      'param_name'  => 'twitter_url',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Google Plus URL',
      'param_name'  => 'google_url',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Pinterset URL',
      'param_name'  => 'pinterset_url',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'style2', 'style4') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Linkedin URL',
      'param_name'  => 'linkedin_url',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'style2', 'style4') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Tumblr URL',
      'param_name'  => 'tumblr_url',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'style2', 'style4') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Reddit URL',
      'param_name'  => 'reddit_url',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'style2', 'style4') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Instagram URL',
      'param_name'  => 'instagram_url',
      'dependency'  => array( 'element' => 'style', 'value' => array('style4') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Dribble URL',
      'param_name'  => 'dribble_url',
      'dependency'  => array( 'element' => 'style', 'value' => array('style4') ),
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// TESTIMONIAL
// ==========================================================================================
vc_map( array(
  'name'          => 'Testimonial',
  'base'          => 'rs_testimonial',
  'icon'          => 'fa fa-comments',
  'description'   => 'Create a testimonial block.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1'   => '1',
        'Style 2'   => '2',
        'Style 3'   => '3',
        'Style 4'   => '4',
        'Style 5'   => '5',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Wrap With Column',
      'param_name'  => 'wrap',
      'value'       => array(
        'No'   => 'no',
        'Yes'  => 'yes',
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('1', '5') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Color',
      'param_name'  => 'color',
      'value'       => array(
        'Light' => 'style-light',
        'Dark'  => 'style-dark',
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('3') ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Category ID',
      'param_name'  => 'cats',
      'value'       => rs_element_values( 'categories', array('sort_order'  => 'ASC','taxonomy'    => 'testimonial-category','hide_empty'  => false,) ),
      'std'         => '',
      'placeholder' => 'Choose Category',
      'admin_label' => true,
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Custom Color'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Author Name Color',
      'param_name'  => 'author_color',
      'group'       => 'Custom Color'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Meta Color',
      'param_name'  => 'cite_color',
      'group'       => 'Custom Color'
    ),

    //size
    array(
      'type'        => 'textfield',
      'heading'     => 'Cite Size',
      'param_name'  => 'cite_size',
      'group'       => 'Font Size Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Content Size',
      'param_name'  => 'content_size',
      'group'       => 'Font Size Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Author Name Size',
      'param_name'  => 'author_size',
      'group'       => 'Font Size Properties'
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// TEAM BLOCK
// ==========================================================================================
vc_map( array(
  'name'          => 'Team member',
  'base'          => 'rs_team',
  'icon'          => 'fa fa-users',
  'description'   => 'Add team block.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'admin_label' => true,
      'param_name'  => 'style',
      'value'       => array(
        'Style 1'   => 'style1',
        'Style 2'   => 'style2',
        'Style 3'   => 'style3'
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Image Size',
      'admin_label' => true,
      'param_name'  => 'image_size',
      'value'       => array(
        '600 x 500' => 'ts-medium-alt-7',
        '400 x 400' => 'ts-medium-alt-10',
      )
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Team member ID',
      'admin_label' => true,
      'param_name'  => 'person_id',
      'description' => 'Enter post id seperated e.g 672'
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// IMAGE BLOCK
// ==========================================================================================
vc_map( array(
  'name'          => 'Image Block',
  'base'          => 'rs_image_block',
  'icon'          => 'fa fa-image',
  'description'   => 'Add image.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Alignment',
      'admin_label' => true,
      'param_name'  => 'align',
      'value'       => array(
        'Select Align' => '',
        'Left'         => 'align-left',
        'Center'       => 'align-center',
        'Right'        => 'align-right'
      ),
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image',
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Link To Image ?',
      'param_name'  => 'image_link',
      'value'       => array(
        'No'        => 'no',
        'Yes'       => 'yes'
      ),
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Link URL',
      'param_name'  => 'link',
      'dependency'  => array( 'element' => 'image_link', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Top',
      'param_name'  => 'margin_top',
      'admin_label' => true,
      'group'       => 'Margin Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Bottom',
      'param_name'  => 'margin_bottom',
      'admin_label' => true,
      'group'       => 'Margin Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Width',
      'param_name'  => 'width',
      'group'       => 'Width & Height Properties',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Height',
      'param_name'  => 'height',
      'group'       => 'Width & Height Properties',
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// IMAGE FRAME
// ==========================================================================================
vc_map( array(
  'name'          => 'Image Frame',
  'base'          => 'rs_image_frame',
  'icon'          => 'fa fa-image',
  'description'   => 'Add image on frame.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'admin_label' => true,
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style3',
        'Style 4' => 'style4',
      ),
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image',
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Link To Image ?',
      'param_name'  => 'image_link',
      'value'       => array(
        'No'        => 'no',
        'Yes'       => 'yes'
      ),
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Link URL',
      'param_name'  => 'link',
      'dependency'  => array( 'element' => 'image_link', 'value' => array('yes') ),
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {

  global $wpdb;

  $db_cf7froms  = $wpdb->get_results("SELECT ID, post_title FROM $wpdb->posts WHERE post_type = 'wpcf7_contact_form'");
  $cf7_forms    = array();

  if ( $db_cf7froms ) {

    foreach ( $db_cf7froms as $cform ) {
      $cf7_forms[$cform->post_title] = $cform->ID;
    }

  } else {
    $cf7_forms['No contact forms found'] = 0;
  }

// ==========================================================================================
// Contact Form
// ==========================================================================================

  vc_map( array(
  'name'            => 'Contact Form',
  'base'            => 'rs_contact_form',
  'icon'            => 'fa fa-envelope ',
  'description'     => 'Contact Form 7',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Contact Form',
      'param_name'  => 'form_id',
      'value'       => $cf7_forms,
      'admin_label' => true,
      'description' => 'Choose previously created contact form from the drop down list.',
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )

) );


}

// ==========================================================================================
// CONTACT DETAILS
// ==========================================================================================
vc_map( array(
  'name'          => 'Contact Details',
  'base'          => 'rs_contact_details',
  'icon'          => 'fa fa-tachometer ',
  'description'   => 'Add contact details.',
  'params'        => array(
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Select Icon',
      'param_name'  => 'icon',
      'icon_type'   => 'fontawesome',
      'placeholder' => 'Select Icon',
    'value'   => '',
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
      'value'       => ''
    ),

    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Border Color',
      'param_name'  => 'icon_border_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// LATEST NEWS
// ==========================================================================================
vc_map( array(
  'name'            => 'Latest News',
  'base'            => 'rs_latest_news',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a latest news post.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Squared'                => 'squared',
        'Masonry'                => 'masonry',
        'Without Featured Image' => 'with_out_featured_img'
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Header',
      'param_name'  => 'header',
      'admin_label' => true,
      'dependency'  => array( 'element' => 'style', 'value' => array('masonry') ),
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Layout',
      'param_name'  => 'layout',
      'value'       => array(
        'Horizontally' => 'hor',
        'Vertically'   => 'ver',
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('squared') ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'value'       => rs_element_values( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'category',
        'hide_empty'  => false,
      ) ),
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Limit',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Excerpt Length',
      'param_name'  => 'length',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'btn_text',
      'admin_label' => true,
      'value'       => ''
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Exclue posts',
      'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
      'param_name'  => 'exclude_posts',
      'admin_label' => true,
      'value'       => ''
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Show Date ?',
      'param_name'  => 'show_date',
      'value'       => array(
        'Yes'       => 'yes',
        'No'        => 'no'
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('masonry, squared') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Show Author ?',
      'param_name'  => 'show_author',
      'value'       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('masonry, squared') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Show Comment ?',
      'param_name'  => 'show_comment',
      'value'       => array(
        'Yes'       => 'yes',
        'No'        => 'no'
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('masonry, squared') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Load More',
      'param_name'  => 'load_more',
      'value'       => array(
        'No'        => 'no',
        'Yes'       => 'yes'
      ),
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'group'       => 'Custom Color'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Meta Color',
      'param_name'  => 'meta_color',
      'group'       => 'Custom Color'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Custom Color'
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// Magazine NEWS
// ==========================================================================================
vc_map( array(
  'name'            => 'Magazine News',
  'base'            => 'rs_blog_magazine',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a magazine news post.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1'   => 'style1',
        'Style 2'   => 'style2',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'value'       => rs_element_values( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'category',
        'hide_empty'  => false,
      ) ),
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Excerpt Length',
      'param_name'  => 'length',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Exclue posts',
      'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
      'param_name'  => 'exclude_posts',
      'admin_label' => true,
      'value'       => ''
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// Magazine NEWS
// ==========================================================================================
vc_map( array(
  'name'            => 'Magazine News Alternative',
  'base'            => 'rs_blog_magazine_alt',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a magazine style 2.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1'   => 'style1',
        'Style 2'   => 'style2',
        'Style 3'   => 'style3',
        'Style 4'   => 'style4',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'value'       => rs_element_values( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'category',
        'hide_empty'  => false,
      ) ),
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Excerpt Length',
      'param_name'  => 'length',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'style3', 'style4') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Limit',
      'param_name'  => 'limit',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Exclue posts',
      'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
      'param_name'  => 'exclude_posts',
      'admin_label' => true,
      'value'       => ''
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// Magazine NEWS
// ==========================================================================================
vc_map( array(
  'name'            => 'Magazine News Trending',
  'base'            => 'rs_blog_magazine_trending',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a magazine trending.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1'   => 'style1',
        'Style 2'   => 'style2',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Header',
      'param_name'  => 'header',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1') ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'value'       => rs_element_values( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'category',
        'hide_empty'  => false,
      ) ),
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Excerpt Length',
      'param_name'  => 'length',
      'dependency'  => array( 'element' => 'style', 'value' => array('style2') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Limit',
      'param_name'  => 'limit',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Exclue posts',
      'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
      'param_name'  => 'exclude_posts',
      'admin_label' => true,
      'value'       => ''
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// Magazine Popular
// ==========================================================================================
vc_map( array(
  'name'            => 'Magazine News Popular',
  'base'            => 'rs_blog_magazine_popular',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a magazine popular.',
  'params'          => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Select Categories',
      'param_name'  => 'cats',
      'placeholder' => 'Select category',
      'value'       => rs_element_values( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'category',
        'hide_empty'  => false,
      ) ),
      'std'         => '',
      'description' => 'You can choose specific categories for blog, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Excerpt Length',
      'param_name'  => 'length',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Limit',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Exclue posts',
      'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
      'param_name'  => 'exclude_posts',
      'admin_label' => true,
      'value'       => ''
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),
) );

// ==========================================================================================
// SPECIAL TEXT
// ==========================================================================================
vc_map( array(
  'name'          => 'Special Text',
  'base'          => 'rs_special_text',
  'icon'          => 'fa fa-tint',
  'description'   => 'Create special text.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Font',
      'param_name'  => 'font',
      'admin_label' => true,
      'value'       => array_flip(rs_get_font_choices(true)),
    ),

    array(
      'type'        => 'dropdown',
      'heading'     => 'Tag Name',
      'param_name'  => 'tag',
      'value'       => array(
        'H1'  => 'h1',
        'H2'  => 'h2',
        'H3'  => 'h3',
        'H4'  => 'h4',
        'H5'  => 'h5',
        'H6'  => 'h6',
        'div' => 'div',
      ),
    ),

    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Align',
      'param_name'  => 'align',
      'value'       => array(
        'Select Align' => '',
        'Left'   => 'left',
        'Center' => 'center',
        'Right'  => 'right',
      ),
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Font Size',
      'param_name'  => 'font_size',
      'description' => 'Enter the size in pixel e.g 45px',
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Line Height',
      'param_name'  => 'line_height',
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Letter Spacing',
      'param_name'  => 'letter_spacing',
      'description' => 'Enter the size in pixel e.g 1px',
      'group'       => 'Custom Font Properties'
    ),

    array(
      'type'        => 'colorpicker',
      'heading'     => 'Font Color',
      'param_name'  => 'font_color',
      'group'       => 'Custom Font Properties'
    ),

    array(
      'type'        => 'dropdown',
      'heading'     => 'Font Weight',
      'param_name'  => 'font_weight',
      'value'       => array(
        'Light'      => '300',
        'Normal'     => '400',
        'Bold'       => '600',
        'Bold'       => '700',
        'Extra Bold' => '800',
      ),
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Font Style',
      'param_name'  => 'font_style',
      'value'       => array(
        'Normal' => 'normal',
        'Italic' => 'italic',
      ),
      'group'       => 'Custom Font Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Text Transform',
      'param_name'  => 'transform',
      'value'       => array(
        'Select Transform' => '',
        'Uppercase'        => 'uppercase',
        'Lowercase'        => 'lowercase',
      ),
      'group'       => 'Custom Font Properties'
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Top',
      'param_name'  => 'margin_top',
      'description' => 'Enter the size in pixel e.g 45px',
      'group'       => 'Custom Margin Properties'
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Bottom',
      'param_name'  => 'margin_bottom',
      'description' => 'Enter the size in pixel e.g 45px',
      'group'       => 'Custom Margin Properties'
    ),
    array(
      'type' => 'css_editor',
      'heading' => esc_html__( 'CSS box', 'js_composer' ),
      'param_name' => 'css',
      'group' => esc_html__( 'Design Options', 'js_composer' )
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );


// ==========================================================================================
// LATEST WORKS
// ==========================================================================================
vc_map( array(
  'name'            => 'Latest Works',
  'base'            => 'rs_latest_works',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a portfolio latest work.',
  'params'          => array(
    array(
      'type'       => 'dropdown',
      'heading'    => 'Style',
      'param_name' => 'style',
      'value'      => array(
        '4 Column Full Width'                            => '4col_full_width',
        '4 Column Half Width With Title And Category'    => '4col_half_width_title_and_category',
        '4 Column Full Width With Carousel'              => '4col_full_width_with_carousel',
        '3 Column Half Width Without Title And Category' => '3col_half_width_without_title_and_category',
        '2 Column Half Width With Title And Category'    => '2col_half_width_with_title_and_category',
        'Masonry Layout With Different Size'             => 'masonry_layout_with_different_size',
        'Masonry Layout With Space And Different Size'   => 'masonry_layout_with_space_different_size',
      ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Categories',
      'description' => 'Show portfolio items only from these categories',
      'param_name'  => 'cats',
      'placeholder' => 'Categories',
      'value'       => rs_get_custom_term_values('portfolio-category'),
      'admin_label' => true,
      'std'         => '', //required for vc_efa_chosen type
    ),
    array(
      'type'       => 'dropdown',
      'heading'    => 'Show Filter ?',
      'param_name' => 'show_filter',
      'value'      => array(
        'Yes'      => 'yes',
        'No'       => 'no',
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('4col_half_width_title_and_category', '3col_half_width_without_title_and_category', '2col_half_width_with_title_and_category') ),
    ),
    array(
      'type'       => 'dropdown',
      'heading'    => 'Filter Align',
      'param_name' => 'filter_align',
      'value'      => array(
        'Left'   => 'align-left',
        'Center' => 'align-center',
      ),
      'dependency'  => array( 'element' => 'show_filter', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Filter categories',
      'param_name'  => 'filter_cats',
      'placeholder' => 'Categories',
      'value'       => rs_get_custom_term_values('portfolio-category'),
      'admin_label' => true,
      'std'         => '', //required for vc_efa_chosen type
      'dependency'  => array( 'element' => 'show_filter', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Limit',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'value'       => array(
        'No'  => 'no',
        'Yes' => 'yes',
      ),
      'heading'    => 'Use external URL if exists',
      'param_name' => 'use_external_url',
      'dependency' => array( 'element' => 'lightbox', 'value' => array('no') ),
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Exclude posts',
      'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
      'param_name'  => 'exclude_posts',
      'admin_label' => true,
      'value'       => ''
    ),

    array(
      'type'        => 'colorpicker',
      'heading'     => 'Active Border Color',
      'param_name'  => 'filter_border_color',
      'group'       => 'Filter Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Active Text Color',
      'param_name'  => 'filter_text_color',
      'group'       => 'Filter Custom Colors',
    ),
    // Extras
    $vc_map_extra_class,
  )

) );

// ==========================================================================================
// Portfolio Masonry Full Width
// ==========================================================================================
vc_map( array(
  'name'            => 'Portfolio Masonry Full Width',
  'base'            => 'rs_portfolio_masonry_full_width',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a portfolio masonry.',
  'params'          => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Categories',
      'description' => 'Show portfolio items only from these categories',
      'param_name'  => 'cats',
      'placeholder' => 'Categories',
      'value'       => rs_get_custom_term_values('portfolio-category'),
      'admin_label' => true,
      'std'         => '', //required for vc_efa_chosen type
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Limit',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Exclude posts',
      'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
      'param_name'  => 'exclude_posts',
      'admin_label' => true,
      'value'       => ''
    ),
    $vc_map_extra_class,
  )

) );

// ==========================================================================================
// Portfolio Masonry Full Width
// ==========================================================================================
vc_map( array(
  'name'            => 'Portfolio Related',
  'base'            => 'rs_portfolio_related',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a portfolio related.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Show Title',
      'param_name'  => 'show_title',
      'value'       => array(
        'No'        => 'no',
        'Yes'       => 'yes'
      ),
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Limit',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  )

) );

// ==========================================================================================
// Portfolio Masonry Full Width
// ==========================================================================================
vc_map( array(
  'name'            => 'Portfolio Grid',
  'base'            => 'rs_portfolio_grid',
  'icon'            => 'fa fa-briefcase',
  'description'     => 'Create a portfolio grid.',
  'params'          => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Categories',
      'description' => 'Show portfolio items only from these categories',
      'param_name'  => 'cats',
      'placeholder' => 'Categories',
      'value'       => rs_get_custom_term_values('portfolio-category'),
      'admin_label' => true,
      'std'         => '', //required for vc_efa_chosen type
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Categories',
      'description' => 'Show filter only from these categories',
      'param_name'  => 'filter_cats',
      'placeholder' => 'Categories',
      'value'       => rs_get_custom_term_values('portfolio-category'),
      'admin_label' => true,
      'std'         => '', //required for vc_efa_chosen type
    ),
    array(
      'type'        => 'dropdown',
      'admin_label' => true,
      'heading'     => 'Order by',
      'param_name'  => 'orderby',
      'value'       => array(
        'ID'            => 'ID',
        'Author'        => 'author',
        'Post Title'    => 'title',
        'Date'          => 'date',
        'Last Modified' => 'modified',
        'Random Order'  => 'rand',
        'Comment Count' => 'comment_count',
        'Menu Order'    => 'menu_order',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Post Limit',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Exclude posts',
      'description' => 'Post IDs you want to exclude, separated by commas eg. 120,123,1005',
      'param_name'  => 'exclude_posts',
      'admin_label' => true,
      'value'       => ''
    ),
    $vc_map_extra_class,
  )

) );

// ==========================================================================================
// CONTENT BOX
// ==========================================================================================
vc_map( array(
  'name'          => 'Content Box',
  'base'          => 'rs_content_box',
  'icon'          => 'fa fa-dot-circle-o',
  'description'   => 'Create a feature box.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'admin_label' => true,
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style3',
        'Style 4' => 'style4',
        'Style 5' => 'style5',
        'Style 6' => 'style6',
        'Style 8' => 'style8',
        'Style 9' => 'style9',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Text Align',
      'param_name'  => 'text_align',
      'admin_label' => true,
      'value'       => array(
        'Left'      => 'on-left',
        'Right'      => 'on-right',
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('style8') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Border',
      'param_name'  => 'box_border',
      'value'       => array(
        'Yes'       => 'yes',
        'No'        => 'no'
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('style5') ),
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Box Border Custom Color ( Optional )',
      'param_name'  => 'custom_box_border_color',
      'dependency'  => array( 'element' => 'box_border', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Box Header Color',
      'param_name'  => 'box_header_color',
      'admin_label' => true,
      'value'       => $vc_theme_color,
      'dependency'  => array( 'element' => 'style', 'value' => array('style7') ),
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Box Header Custom Color ( Optional )',
      'param_name'  => 'custom_box_header_color',
      'dependency'  => array( 'element' => 'style', 'value' => array('style7') ),
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Icon Image',
      'param_name'  => 'icon_image',
    ),
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Select Icon',
      'param_name'  => 'icon',
      'icon_type'   => 'fontawesome',
      'placeholder' => 'Select Icon',
      'value'       => '',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'holder'      => 'h3'
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
      'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'style2','style4','style5', 'style6', 'style7', 'style8', 'style9') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'btn_text',
      'dependency'  => array( 'element' => 'style', 'value' => array('style6') ),
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link',
      'param_name'  => 'btn_link',
      'dependency'  => array( 'element' => 'btn_text', 'not_empty' => true )
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Hover Effect (Optional)',
      'param_name'  => 'btn_hover_effect',
      'value'       => array(
        'Select Hover Effect' => '',
        'Fill From Top'       => 'fill-frm-top',
        'Fill From Right'     => 'fill-frm-right',
        'Fill From Bottom'    => 'fill-frm-bottom',
        'Fill From Left'      => 'fill-frm-left',
      ),
      'dependency'  => array( 'element' => 'btn_text', 'not_empty' => true )
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Icon Size',
      'param_name'  => 'icon_size',
      'admin_label' => true,
      'group'       => 'Size Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title Size',
      'param_name'  => 'title_size',
      'admin_label' => true,
      'group'       => 'Size Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Content Size',
      'param_name'  => 'content_size',
      'admin_label' => true,
      'group'       => 'Size Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Top',
      'param_name'  => 'title_top',
      'admin_label' => true,
      'group'       => 'Title Margin Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Bottom',
      'param_name'  => 'title_bottom',
      'admin_label' => true,
      'group'       => 'Title Margin Properties',
      'description' => 'Add size in pixels e.g 15px'
    ),

    // Custom Color
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Background Color',
      'param_name'  => 'icon_bg_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Border Color',
      'param_name'  => 'icon_border_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Ring Border Color On Hover',
      'param_name'  => 'icon_ring_border_color_hover',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Background Color On Hover',
      'param_name'  => 'icon_bg_color_hover',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Color On Hover',
      'param_name'  => 'icon_color_hover',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Button Fill Background Color',
      'param_name'  => 'btn_fill_bg_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Button Border Color',
      'param_name'  => 'btn_border_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Button Text Color',
      'param_name'  => 'btn_text_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Button Text Color On Hover',
      'param_name'  => 'btn_text_color_hover',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Button Background Color',
      'param_name'  => 'btn_bg_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Button Background On Hover',
      'param_name'  => 'btn_bg_color_hover',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Colors',
    ),
    rs_get_animation_param('icon_animation', 'Icon Animation'),
    rs_get_animation_delay_param('icon_delay', 'Icon Animation', 'icon_animation'),
    rs_get_animation_param('title_animation', 'Title Animation'),
    rs_get_animation_delay_param('title_delay', 'Title Animation', 'title_animation'),
    rs_get_animation_param('content_animation', 'Content Animation'),
    rs_get_animation_delay_param('content_delay', 'Content Animation', 'content_animation'),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// Content Box 2
// ==========================================================================================
vc_map( array(
  'name'                    => 'Feature Box',
  'base'                    => 'rs_feature_box',
  'icon'                    => 'fa fa-th',
  'as_parent'               => array('only' => 'rs_feature_box_item'),
  'show_settings_on_create' => true,
  'js_view'                 => 'VcColumnView',
  'content_element'         => true,
  'description'             => 'Create a feature box.',
  'params'  => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra ID',
      'param_name'  => 'id',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra Class',
      'param_name'  => 'class',
    ),
  ),

) );

vc_map( array(
  'name'        => 'Feature Box Item',
  'base'        => 'rs_feature_box_item',
  'icon'        => 'fa fa-picture-o',
  'description' => 'Add content box item.',
  'as_child'    => array('only' => 'rs_feature_box'),
  'params'      => array(
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image',
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'holder'      => 'div',
      'param_name'  => 'content',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Scrolling Boundaries',
      'param_name'  => 'data_sb',
      'value'       => array(
        'Enter' => 'enter',
        'Exit'  => 'exit',
        'Span'  => 'span',
      ),
      'group'       => 'Image Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'From',
      'param_name' => 'data_from',
      'description' => 'Enter the value in between 0 - 1.',
      'group'       => 'Image Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'To',
      'param_name' => 'data_to',
      'description' => 'Enter the value in between 0 - 1.',
      'group'       => 'Image Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Opacity',
      'param_name' => 'data_opacity',
      'description' => 'Enter the value in between 0 - 1.',
      'group'       => 'Image Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Scale',
      'param_name' => 'data_scale',
      'group'       => 'Image Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Translatey',
      'param_name' => 'data_translatey',
      'group'       => 'Image Properties'
    ),

    // content properties
    array(
      'type'        => 'dropdown',
      'heading'     => 'Scrolling Boundaries',
      'param_name'  => 'c_data_sb',
      'value'       => array(
        'Enter' => 'enter',
        'Exit'  => 'exit',
        'Span'  => 'span',
      ),
      'group'       => 'Content Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'From',
      'param_name' => 'c_data_from',
      'description' => 'Enter the value in between 0 - 1.',
      'group'       => 'Content Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'To',
      'param_name' => 'c_data_to',
      'description' => 'Enter the value in between 0 - 1.',
      'group'       => 'Content Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Opacity',
      'param_name' => 'c_data_opacity',
      'description' => 'Enter the value in between 0 - 1.',
      'group'       => 'Content Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Scale',
      'param_name' => 'c_data_scale',
      'group'       => 'Content Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Translatey',
      'param_name' => 'c_data_translatey',
      'group'       => 'Content Properties'
    ),
  )

) );

// ==========================================================================================
// Content Box 2
// ==========================================================================================
vc_map( array(
  'name'                    => 'Content Box 2',
  'base'                    => 'rs_content_box_2',
  'icon'                    => 'fa fa-th',
  'as_parent'               => array('only' => 'rs_content_box_2_item'),
  'show_settings_on_create' => true,
  'js_view'                 => 'VcColumnView',
  'content_element'         => true,
  'description'             => 'Create a content box.',
  'params'  => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra ID',
      'param_name'  => 'id',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra Class',
      'param_name'  => 'class',
    ),
  ),

) );

vc_map( array(
  'name'        => 'Content Box 2 Item',
  'base'        => 'rs_content_box_2_item',
  'icon'        => 'fa fa-picture-o',
  'description' => 'Add content box item.',
  'as_child'    => array('only' => 'rs_content_box_2'),
  'params'      => array(
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image',
      'param_name'  => 'image',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'holder'      => 'h4'
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'holder'      => 'div',
      'param_name'  => 'content',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Stroke Color',
      'param_name'  => 'stroke_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Custom Colors'
    ),
    rs_get_animation_param('animation', 'Animation'),
    rs_get_animation_delay_param('animation_delay', 'Animation', 'animation'),
  )

) );



// ==========================================================================================
// BANNER SLIDER
// ==========================================================================================
vc_map( array(
  'name'                    => 'Banner Slider',
  'base'                    => 'rs_banner_slider',
  'icon'                    => 'fa fa-sort-numeric-asc',
  'as_parent'               => array('only' => 'rs_banner_slide'),
  'show_settings_on_create' => true,
  'js_view'                 => 'VcColumnView',
  'content_element'         => true,
  'description'             => 'Add banner slider.',
  'params'  => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'value'       => array(
        'Splendid Banner'      => 'splendid_banner',
        'Splendid Bold Banner' => 'splendid_bold_banner',
        'Promo Inn'            => 'promo_inn',
        'Bold Promo Inn'       => 'bold_promo_inn',
        'Basic Banner'         => 'basic_banner',
        'Basic Modern Banner'  => 'basic_modern_banner',
        'Bold Attraction'      => 'bold_attraction',
        'Simple Banner'        => 'simple_banner',
      ),
      'param_name'  => 'style',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Content Position',
      'value'       => array(
        'Left'      => 'left',
        'Right'     => 'right',
      ),
      'param_name'  => 'content_pos',
      'dependency'  => array( 'element' => 'style', 'value' => array('basic_banner') ),
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),

) );

vc_map( array(
  'name'                    => 'Slide Item',
  'base'                    => 'rs_banner_slide',
  'icon'                    => 'fa fa-sort-numeric-asc',
  'description'             => 'Add banner slide.',
  'as_child'                => array('only' => 'rs_banner_slider'),
  'params'  => array(
    array(
      'type'        => 'attach_image',
      'heading'     => 'Background',
      'param_name'  => 'background',
      'admin_label' => true,
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Promo Image',
      'param_name'  => 'promo_image',
      'admin_label' => true,
      'description' => 'This option is for banner type <strong>Bold Promo Inn & Bold Attraction</strong>.'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color',
      'description' => 'This option is for banner type <strong>Splendid Bold Banner, Splendid Banner, Basic Banner, Bold Attraction, Basic Modern Banner & Bold Promo Inn</strong>.'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Heading',
      'param_name'  => 'small_heading',
      'holder'      => 'h2',
      'description' => 'This option is <strong>NOT</strong> for banner type <strong>Basic Banner & Basic Modern Banner</strong>.'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Big Heading',
      'param_name'  => 'big_heading',
      'holder'      => 'h4',
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
      'description' => 'This option is for banner type <strong>Basic Banner & Basic Modern Banner</strong>.'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button One Text',
      'param_name'  => 'btn_one_text',
      'description' => 'Leave blank to hide the button.'
      //'dependency' => Array('element' => 'no_buttons','value' => array('one', 'two')),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button One Color',
      'param_name'  => 'btn_one_color',
      'value'       => $vc_theme_color,
      'dependency'  => array( 'element' => 'btn_one_text', 'not_empty' => true )
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button One Link',
      'param_name'  => 'btn_one_link',
      'dependency'  => array( 'element' => 'btn_one_text', 'not_empty' => true )
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Button Two Text',
      'param_name'  => 'btn_two_text',
      'description' => 'Leave blank to hide the button.'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Two Color',
      'param_name'  => 'btn_two_color',
      'value'       => $vc_theme_color,
      'dependency'  => array( 'element' => 'btn_two_text', 'not_empty' => true )
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Two Link',
      'param_name'  => 'btn_two_link',
      'dependency'  => array( 'element' => 'btn_two_text', 'not_empty' => true )
    ),


    //custom colors
    array(
      'type'        => 'textfield',
      'heading'     => 'Padding Top',
      'param_name'  => 'padding_top',
      'description' => 'Add padding in px or em e.g 120px ( Only for Promo Inn banner type. )',
      'group'       => 'Padding Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Padding Bottom',
      'param_name'  => 'padding_bottom',
      'description' => 'Add padding in px or em e.g 120px ( Only for Promo Inn banner type. )',
      'group'       => 'Padding Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Big Heading Color',
      'param_name'  => 'big_heading_color',
      'group'       => 'Colors Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Small Heading Color',
      'param_name'  => 'small_heading_color',
      'group'       => 'Colors Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Colors Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Heading',
      'param_name'  => 'small_heading_font_size',
      'description' => 'Enter the font size in px e.g 14px',
      'group'       => 'Font Size Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Big Heading',
      'param_name'  => 'big_heading_font_size',
      'description' => 'Enter the font size in px e.g 14px',
      'group'       => 'Font Size Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Content Font Size',
      'param_name'  => 'content_font_size',
      'description' => 'Enter the font size in px e.g 14px',
      'group'       => 'Font Size Properties'
    ),
  )

) );

// ==========================================================================================
// BANNER SLIDER
// ==========================================================================================
vc_map( array(
  'name'                    => 'Banner',
  'base'                    => 'rs_banner',
  'icon'                    => 'fa fa-sort-numeric-asc',
  'description'             => 'Add banner slide.',
  'params'  => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'value'       => array(
        'Bold Promo'           => 'bold_promo',
        'Promo Big'            => 'promo_big',
        'Promo Info'           => 'promo_info',
        'Splendid Bold Banner' =>'splendid_bold_banner',
      ),
      'param_name'  => 'style',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Heading',
      'param_name'  => 'small_heading',
      'holder'      => 'h2',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Big Heading',
      'param_name'  => 'big_heading',
      'holder'      => 'h4',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button One Text',
      'param_name'  => 'btn_one_text',
      'description' => 'Leave blank to hide the button.'
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button One Link',
      'param_name'  => 'btn_one_link',
      'dependency'  => array( 'element' => 'btn_one_text', 'not_empty' => true )
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button One Color',
      'param_name'  => 'btn_one_color',
      'value'       => $vc_theme_color,
      'dependency'  => array( 'element' => 'btn_one_text', 'not_empty' => true )
    ),

    array(
      'type'        => 'textfield',
      'heading'     => 'Button Two Text',
      'param_name'  => 'btn_two_text',
      'description' => 'Leave blank to hide the button.'
    ),

    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Two Link',
      'param_name'  => 'btn_two_link',
      'dependency'  => array( 'element' => 'btn_two_text', 'not_empty' => true )
    ),

    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Two Color',
      'param_name'  => 'btn_two_color',
      'value'       => $vc_theme_color,
      'dependency'  => array( 'element' => 'btn_two_text', 'not_empty' => true )
    ),

    //custom colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Big Heading Color',
      'param_name'  => 'big_heading_color',
      'group'       => 'Colors Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Small Heading Color',
      'param_name'  => 'small_heading_color',
      'group'       => 'Colors Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Heading',
      'param_name'  => 'small_heading_font_size',
      'description' => 'Enter the font size in px e.g 14px',
      'group'       => 'Font Size Properties'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Big Heading',
      'param_name'  => 'big_heading_font_size',
      'description' => 'Enter the font size in px e.g 14px',
      'group'       => 'Font Size Properties'
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )

) );

// ==========================================================================================
// Tool Tip
// ==========================================================================================
vc_map( array(
  'name'          => 'ToolTip',
  'base'          => 'rs_tooltip',
  'icon'          => 'fa fa fa-comment',
  'description'   => 'Create tooltip.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'ToolTip Position',
      'param_name'  => 'position',
      'value'       => array(
        'Top'    => 'top',
        'Left'   => 'left',
        'Bottom' => 'bottom',
        'Right'  => 'right',
      ),
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'ToolTip Text',
      'param_name'  => 'content',
      'holder'      => 'div'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'ToolTip Text On Hover',
      'param_name'  => 'tool_tip_text_hover',
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Highlights
// ==========================================================================================
vc_map( array(
  'name'          => 'Highlights',
  'base'          => 'rs_highlights',
  'icon'          => 'fa fa fa-comment',
  'description'   => 'Create highlights.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Background Color',
      'param_name'  => 'bg_color',
      'value'       => $vc_theme_color
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'value'       => $vc_theme_color
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'ToolTip Text',
      'param_name'  => 'content',
      'holder'      => 'div'
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Check list
// ==========================================================================================
vc_map( array(
  'name'          => 'Checklist',
  'base'          => 'rs_checklist',
  'icon'          => 'fa fa fa-comment',
  'description'   => 'Create icon list.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Background Color',
      'param_name'  => 'icon_bg_color',
      'value'       => $vc_theme_color
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Icon Style',
      'param_name'  => 'icon_style',
      'value'       => array(
        'Check' => 'style-check',
        'Cross' => 'style-close',
        'Arrow' => 'style-arrow',
        'Plus'  => 'style-plus',
      ),
      'admin_label' => true
    ),
    array(
      'type'        => 'textarea',
      'heading'     => 'List Content',
      'param_name'  => 'list_content',
      'holder'      => 'div',
      'description' => 'Add list item seperated with | e.g cupidatat non dolor|Excepteur sint'
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Space
// ==========================================================================================
vc_map( array(
  'name'          => 'Space',
  'base'          => 'rs_space',
  'icon'          => 'fa fa fa-arrows-v',
  'description'   => 'Add space.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Height',
      'admin_label' => true,
      'param_name'  => 'height',
      'description' => 'Add value on pixel e.g 25px'
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Portfolio
// ==========================================================================================
vc_map( array(
  'name'                    => 'Portfolio',
  'base'                    => 'rs_portfolio',
  'icon'                    => 'fa fa-th',
  'content_element'         => true,
  'description'             => 'Create a portfolio.',
  'params'  => array(
  array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'admin_label' => true,
      'value'       => array(
        '1 Column'  => '1',
        '2 Columns' => '2',
        '3 Columns' => '3',
        '4 Columns' => '4',
        '5 Columns' => '5',
        'Grid'      => 'grid',
        'Masonry'   => 'masonry',
      ),
    ),
    array(
        'type'        => 'dropdown',
        'heading'     => 'Variant',
        'param_name'  => 'variant_1',
        'admin_label' => false,
        'value'       => array(
          '1' => '1',
          '2' => '2',
        ),
      'dependency'  => array( 'element' => 'style', 'value' => array('1') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Variant',
      'param_name'  => 'variant_masonry',
      'admin_label' => false,
      'value'       => array(
        '1' => '1',
        '2' => '2',
      ),
    'dependency'  => array( 'element' => 'style', 'value' => array('masonry') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Show slider for gallery items',
      'param_name'  => 'show_slider_for_gallery',
      'admin_label' => false,
      'value'       => array(
        'No' => 'no',
        'Yes' => 'yes',
      ),
    'dependency'  => array( 'element' => 'style', 'value' => array('4') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Enable filter',
      'param_name'  => 'enable_filter',
      'value'       => array(
        'Yes' => 'yes',
        'No'  => 'no',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Filter Style',
      'param_name'  => 'filter_style',
      'admin_label' => false,
      'value'       => array(
        'Standard' => 'standard',
        'Alternative' => 'alternative',
      ),
    'dependency'  => array( 'element' => 'enable_filter', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Filter Color',
      'param_name'  => 'filter_color',
      'admin_label' => false,
      'value'       => array(
        'Accent' => 'accent',
        'White'  => 'white',
      ),
    'dependency'  => array( 'element' => 'enable_filter', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Filter Background',
      'param_name'  => 'filter_background',
      'dependency'  => array( 'element' => 'filter_style', 'value' => array('alternative') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Filter Title',
      'param_name'  => 'filter_title',
      'dependency'  => array( 'element' => 'filter_style', 'value' => array('alternative') ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Enable pagination',
      'param_name'  => 'enable_pagination',
      'value'       => array(
        'Yes' => 'yes',
    'No'  => 'no',
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Posts per page',
      'admin_label' => true,
      'param_name'  => 'posts_per_page',
    ),
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Categories',
      'param_name'  => 'categories',
      'placeholder' => 'Select category',
      'value'       => rs_element_values( 'categories', array(
        'sort_order'  => 'ASC',
        'taxonomy'    => 'portfolio-category',
        'hide_empty'  => false,
      ) ),
      'std'         => '',
      'description' => 'You can choose specific categories, default is all categories.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Exclude posts',
      'admin_label' => true,
      'param_name'  => 'exclude_posts',
    'description' => 'Post IDs separated by comma.',
    ),
    $vc_map_extra_class,
  ),
) );

if ( rs_get_current_post_type() ) {

  // ==========================================================================================
  // Portfolio Details
  // ==========================================================================================
  vc_map( array(
    'name'                    => 'Portfolio Details',
    'base'                    => 'rs_portfolio_details',
    'icon'                    => 'fa fa-th',
    'content_element'         => true,
    'description'             => 'Display a portfolio item details.',
    'show_settings_on_create' => false,
    'params'                  => array(),
  ) );

}

// ==========================================================================================
// Process Box
// ==========================================================================================
vc_map( array(
  'name'                    => 'Process Box',
  'base'                    => 'rs_process_box',
  'icon'                    => 'fa fa-th',
  'as_parent'               => array('only' => 'rs_process_box_item'),
  'show_settings_on_create' => false,
  'js_view'                 => 'VcColumnView',
  'content_element'         => true,
  'description'             => 'Create a process box.',
  'params'  => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra ID',
      'param_name'  => 'id',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra Class',
      'param_name'  => 'class',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Background Color',
      'param_name'  => 'icon_background_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'group'       => 'Custom Colors'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
    rs_get_animation_param('animation', 'Animation'),
    rs_get_animation_delay_param('animation_delay', 'Animation', 'animation'),
  ),

) );

vc_map( array(
  'name'        => 'Process Box Item',
  'base'        => 'rs_process_box_item',
  'icon'        => 'fa fa-picture-o',
  'description' => 'Add process box item.',
  'as_child'    => array('only' => 'rs_process_box'),
  'params'      => array(
    array(
      'type'        => 'attach_image',
      'heading'     => 'Icon Image',
      'param_name'  => 'icon_image',
    ),
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Select Icon',
      'param_name'  => 'icon',
      'icon_type'   => 'fontawesome',
      'placeholder' => 'Select Icon',
      'value'       => '',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'holder'      => 'h4'
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'holder'      => 'div',
      'param_name'  => 'content',
    ),
  )

) );

// ==========================================================================================
// Pricing Table
// ==========================================================================================
vc_map( array(
  'name'                    => 'Pricing Table',
  'base'                    => 'rs_pricing_table',
  'icon'                    => 'fa fa-th',
  'as_parent'               => array('only' => 'rs_pricing_table_item'),
  'show_settings_on_create' => false,
  'js_view'                 => 'VcColumnView',
  'content_element'         => true,
  'description'             => 'Create a pricing table.',
  'params'  => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Table Color',
      'param_name'  => 'color',
      'value'       => array(
        'Light'     => 'style-default',
        'Dark'      => 'style-dark',
      ),
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),

) );

vc_map( array(
  'name'        => 'Pricing Table Item',
  'base'        => 'rs_pricing_table_item',
  'icon'        => 'fa fa-picture-o',
  'description' => 'Add table item.',
  'as_child'    => array('only' => 'rs_pricing_table'),
  'params'      => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Set As Featured ?',
      'param_name'  => 'is_featured',
      'value'       => array(
        'No'  => 'no',
        'Yes' => 'yes'
      ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Sub Title',
      'param_name'  => 'subtitle',
      'dependency'  => array( 'element' => 'is_featured', 'value' => array('yes') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textarea',
      'heading'     => 'Feature',
      'value'       => '',
      'param_name'  => 'feature',
      'description' => 'Add feature seperated with |'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Currency Symbol',
      'param_name'  => 'currency',
      'value'       => '',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Price',
      'param_name'  => 'price',
      'value'       => '',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Price',
      'param_name'  => 'small_price',
      'value'       => '',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Period',
      'param_name'  => 'period',
      'value'       => '',
      'description' => 'E.g monthly, yearly.'
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link',
      'param_name'  => 'btn_link',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'btn_text',
      'value'       => '',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Hover Effect (Optional)',
      'param_name'  => 'btn_hover_effect',
      'value'       => array(
        'Select Hover Effect' => '',
        'Fill From Top'       => 'fill-frm-top',
        'Fill From Right'     => 'fill-frm-right',
        'Fill From Bottom'    => 'fill-frm-bottom',
        'Fill From Left'      => 'fill-frm-left',
      ),
    ),

    // colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Feature Text Color',
      'param_name'  => 'feature_text_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Feature Text Background Color',
      'param_name'  => 'feature_text_background_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Border Color',
      'param_name'  => 'title_border_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Background Color',
      'param_name'  => 'title_background_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Text Color',
      'param_name'  => 'title_text_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Price Text Color',
      'param_name'  => 'price_text_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Currency & Period Color',
      'param_name'  => 'currency_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Text Color',
      'param_name'  => 'content_text_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Bullet Color',
      'param_name'  => 'feature_bullet_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'btn_background_color',
      'group'       => 'Button Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Overlay Background Color',
      'param_name'  => 'overlay_background_color',
      'group'       => 'Button Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Button Border Color',
      'param_name'  => 'btn_border_color',
      'group'       => 'Button Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Button Border Color On Hover',
      'param_name'  => 'btn_border_hover_color',
      'group'       => 'Button Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'btn_text_color',
      'group'       => 'Button Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color On Hover',
      'param_name'  => 'btn_background_color_hover',
      'group'       => 'Button Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color On Hover',
      'param_name'  => 'btn_text_color_hover',
      'group'       => 'Button Custom Colors'
    ),
    rs_get_animation_param('animation', 'Animation'),
    rs_get_animation_delay_param('animation_delay', 'Animation', 'animation'),
  )

) );

// ==========================================================================================
// Counter box
// ==========================================================================================
vc_map( array(
  'name'          => 'Counter Box',
  'base'          => 'rs_counter',
  'icon'          => 'fa fa-dot-circle-o',
  'description'   => 'Create a counter box.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'admin_label' => true,
      'value'       => array(
        'With No Icon'   => 'style1',
        'With Icon'      => 'style2',
        'With Content'   => 'style3',
        'With Text Bold' => 'style4',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Align',
      'param_name'  => 'align',
      'admin_label' => true,
      'value'       => array(
        'Left'  => 'align-left',
        'Right' => 'align-right',
      ),
      'dependency'  => array( 'element' => 'style', 'value' => array('style3') ),
    ),
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Select Icon',
      'param_name'  => 'icon',
      'icon_type'   => 'fontawesome',
      'placeholder' => 'Select Icon',
      'value'       => '',
      'dependency'  => array( 'element' => 'style', 'value' => array('style2') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Count No',
      'param_name'  => 'count_no',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textarea',
      'heading'     => 'Counter Content',
      'param_name'  => 'counter_content',
      'admin_label' => true,
      'dependency'  => array( 'element' => 'style', 'value' => array('style1', 'style2', 'style4') ),
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Counter Content',
      'param_name'  => 'content',
      'holder'      => 'div',
      'dependency'  => array( 'element' => 'style', 'value' => array('style3') ),
    ),


    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Count No Color',
      'param_name'  => 'count_no_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Seperator Color',
      'param_name'  => 'sep_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// Counter Box 2
// ==========================================================================================
vc_map( array(
  'name'                    => 'Counter Box 2',
  'base'                    => 'rs_counter_2',
  'icon'                    => 'fa fa-th',
  'as_parent'               => array('only' => 'rs_counter_2_item'),
  'show_settings_on_create' => true,
  'js_view'                 => 'VcColumnView',
  'content_element'         => true,
  'description'             => 'Create a content box.',
  'params'  => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra ID',
      'param_name'  => 'id',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra Class',
      'param_name'  => 'class',
    ),
  ),

) );

vc_map( array(
  'name'        => 'Counter Box 2 Item',
  'base'        => 'rs_counter_2_item',
  'icon'        => 'fa fa-picture-o',
  'description' => 'Add counter box item.',
  'as_child'    => array('only' => 'rs_counter_2'),
  'params'      => array(
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color ( optional )',
      'param_name'  => 'bg_color',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Count No',
      'param_name'  => 'count_no',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'admin_label' => true,
      'param_name'  => 'content',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Count No Color',
      'param_name'  => 'count_no_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Custom Colors'
    ),
  )

) );

// ==========================================================================================
// Pie Chart
// ==========================================================================================
vc_map( array(
  'name'          => 'Chart',
  'base'          => 'rs_chart',
  'icon'          => 'fa fa-dot-circle-o',
  'description'   => 'Create a pie chart.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Size',
      'param_name'  => 'size',
      'value'       => array(
        'Small'     => 'small',
        'Big'       => 'big'
      ),
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Track Color',
      'param_name'  => 'track_color',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Bar Color',
      'param_name'  => 'bar_color',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Percentage',
      'param_name'  => 'percent',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textarea',
      'heading'     => 'Chart Content',
      'param_name'  => 'chart_content',
      'admin_label' => true,
    ),


    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Percent Color',
      'param_name'  => 'percent_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Custom Colors',
    ),
    rs_get_animation_param('animation', 'Animation'),
    rs_get_animation_delay_param('animation_delay', 'Animation', 'animation'),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// Modal
// ==========================================================================================
vc_map( array(
  'name'            => 'Modal',
  'base'            => 'rs_modal',
  'icon'            => 'fa fa-info-circle',
  'description'     => 'Create a modal',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Unique ID',
      'param_name'  => 'modal_id',
      'value'       => 'modal-'. uniqid(),
      'description' => 'Copy-paste this unique id for any element class attribute',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textfield',
      'heading'     => 'Modal Title',
      'param_name'  => 'title',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textarea_html',
      'heading'     => 'Modal Content',
      'param_name'  => 'content',
    ),
    array(
      'holder'      => 'div',
      'type'        => 'textarea',
      'heading'     => 'Contact Form Shortcode',
      'param_name'  => 'cf7_shortcode',
    ),
    // Extras
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Audio Player
// ==========================================================================================
vc_map( array(
  'name'          => 'Audio Player',
  'base'          => 'rs_audio_player',
  'icon'          => 'fa fa-dot-circle-o',
  'description'   => 'Create a audio player.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
        'Style 3' => 'style3',
        'Style 4' => 'style4',
      ),
      'admin_label' => true,
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Album Cover',
      'param_name'  => 'image',
      'dependency'  => array( 'element' => 'style', 'value' => array('style2', 'style3', 'style1') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Audio URL MP3',
      'param_name'  => 'audio_mp3_url',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Audio URL OOG',
      'param_name'  => 'audio_ogg_url',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Track Name',
      'param_name'  => 'track_name',
      'dependency'  => array( 'element' => 'style', 'value' => array('style2', 'style3', 'style4') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Track Author',
      'param_name'  => 'track_author',
      'dependency'  => array( 'element' => 'style', 'value' => array('style2', 'style3', 'style4') ),
    ),


    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Audio Bar Background Color',
      'param_name'  => 'bar_bg_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// Progress Bar
// ==========================================================================================
vc_map( array(
  'name'          => 'Progress Bar',
  'base'          => 'rs_progress_bar',
  'icon'          => 'fa fa-dot-circle-o',
  'description'   => 'Create a progress bar.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Bar Color',
      'value'       => array(
        'Light Blue'   => 'bg-light-blue',
        'Blue'         => 'bg-blue',
        'Red'          => 'bg-red',
        'Orange'       => 'bg-orange',
        'Bitter Sweet' => 'bg-bittersweet',
        'Custom Color' => 'bg-custom-color',
      ),
      'param_name'  => 'bar_color',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Bar Custom Color',
      'param_name'  => 'bar_custom_color',
      'dependency'  => array( 'element' => 'bar_color', 'value' => array('bg-custom-color') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'admin_label' => true,
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Percentage',
      'param_name'  => 'percent',
      'admin_label' => true,
    ),


    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Title Color',
      'param_name'  => 'title_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// BUTTONS
// ==========================================================================================
vc_map( array(
  'name'          => 'Buttons',
  'base'          => 'rs_buttons',
  'icon'          => 'fa fa-square',
  'description'   => 'Create a classy button.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Style',
      'param_name'  => 'btn_style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Color',
      'param_name'  => 'btn_color',
      'value'       => $vc_theme_color
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Icon',
      'param_name'  => 'btn_icon',
      'value'       => array(
        'No'        => 'no',
        'Yes'        => 'yes',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Hover Effect (Optional)',
      'param_name'  => 'btn_hover_effect',
      'value'       => array(
        'Select Hover Effect' => '',
        'Fill From Top'       => 'fill-frm-top',
        'Fill From Right'     => 'fill-frm-right',
        'Fill From Bottom'    => 'fill-frm-bottom',
        'Fill From Left'      => 'fill-frm-left',
      ),
    ),
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Select Icon',
      'param_name'  => 'icon',
      'icon_type'   => 'fontawesome',
      'placeholder' => 'Select Icon',
      'value'       => 'fa fa-paper-plane-o',
      'dependency' => Array('element' => 'btn_icon','value' => array('yes')),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Shape',
      'param_name'  => 'btn_shape',
      'admin_label' => true,
      'value'       => array(
        'Rounded' => 'btn-round',
        'Circle'  => 'shaped',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Style',
      'param_name'  => 'btn_style',
      'admin_label' => true,
      'value'       => array(
        'Select Style' => '',
        'Flat'         => 'flat',
        '3D'           => 'b3d',
        'Outlined'     => 'unfilled',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Border Width',
      'param_name'  => 'border_width',
      'value'       => array(
        'Light'      => 'br-light',
        'Semi Light' => 'br-semi-light',
        'Medium'     => 'br-medium',
        'Semi Thick' => 'br-semi-thick',
        'Thick'      => 'br-thick',
      ),
      'dependency' => Array('element' => 'btn_style','value' => array('unfilled')),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Size',
      'param_name'  => 'btn_size',
      'admin_label' => true,
      'value'       => array(
        'Small'       => '',
        'Large'       => 'btn-large',
      ),
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link',
      'param_name'  => 'btn_link',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'btn_text',
    ),

    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Colors',
    ),
  array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color',
      'group'       => 'Custom Colors',
    ),

    array(
      'type'        => 'colorpicker',
      'heading'     => 'Overlay Background Color',
      'param_name'  => 'overlay_background_color',
      'group'       => 'Custom Colors',
    ),

    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color_hover',
      'group'       => 'Hover Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color_hover',
      'group'       => 'Hover Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color_hover',
      'group'       => 'Hover Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// DIVIDER
// ==========================================================================================
vc_map( array(
  'name'            => 'Divider',
  'base'            => 'rs_divider',
  'icon'            => 'fa fa-sliders',
  'description'     => 'Add divider.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'admin_label' => true,
      'value'       => array(
        'Solid'     => 'solid',
        'Dashed'    => 'br-dashed',
        'Dotted'    => 'br-dotted',
        'Unique'    => 'unique',
        'With Icon' => 'with_icon',
      ),
    ),
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Icon',
      'param_name'  => 'icon',
      'placeholder' => 'Select Icon',
      'icon_type'   => 'fontawesome',
      'value'       => 'fa fa-paper-plane-o',
      'dependency' => Array('element' => 'style','value' => array('with_icon')),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Top',
      'admin_label' => true,
      'param_name'  => 'margin_top',
      'description' => 'Add size in pixels e.g 15px ( optional )',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Margin Bottom',
      'admin_label' => true,
      'param_name'  => 'margin_bottom',
      'description' => 'Add size in pixels e.g 15px ( optional )'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color ( optional )',
      'admin_label' => true,
      'param_name'  => 'border_color',
      'group'       => 'Custom Colors'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Color',
      'admin_label' => true,
      'param_name'  => 'icon_color',
      'group'       => 'Custom Colors'
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Clients
// ==========================================================================================
vc_map( array(
  'name'                    => 'Clients',
  'base'                    => 'rs_client',
  'icon'                    => 'fa fa-sliders',
  'as_parent'               => array('only' => 'rs_client_item'),
  'show_settings_on_create' => true,
  'js_view'                 => 'VcColumnView',
  'content_element'         => true,
  'description'             => 'Create a client box.',
  'params'  => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra ID',
      'param_name'  => 'id',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra Class',
      'param_name'  => 'class',
    ),
  ),

) );

vc_map( array(
  'name'        => 'Client Item',
  'base'        => 'rs_client_item',
  'icon'        => 'fa fa-picture-o',
  'description' => 'Add counter box item.',
  'as_child'    => array('only' => 'rs_client'),
  'params'      => array(
    array(
      'type'        => 'attach_images',
      'heading'     => 'Images',
      'admin_label' => true,
      'param_name'  => 'images',
      'description' => 'Multiple images are supported.',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Tool Tip Text',
      'admin_label' => true,
      'param_name'  => 'tooltip_text',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Hover Effect',
      'admin_label' => true,
      'param_name'  => 'hover_effect',
      'value'       => array(
        'No'  => 'hvr-off',
        'Yes' => 'hvr-on',
      ),
    ),
    rs_get_animation_param('animation', 'Animation'),
    rs_get_animation_delay_param('animation_delay', 'Animation', 'animation'),
  )

) );


// ==========================================================================================
// Promo Box
// ==========================================================================================
vc_map( array(
  'name'            => 'Promo Boxes',
  'base'            => 'rs_promo_box',
  'icon'            => 'fa fa-sliders',
  'description'     => 'Add promo boxes.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'admin_label' => true,
      'value'       => array(
        'Style 1'  => 'style1',
        'Style 2'  => 'style2',
        'Style 3'  => 'style3',
        'Style 4'  => 'style4',
        'Style 5'  => 'style5',
        'Style 6'  => 'style6',
        'Style 7'  => 'style7',
        'Style 8'  => 'style8',
        'Style 9'  => 'style9',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => '100% Full Width',
      'param_name'  => 'full_width',
      'admin_label' => true,
      'value'       => array(
        'No'  => 'no',
        'Yes' => 'yes',
      ),
      'dependency' => Array('element' => 'style','value' => array('style1', 'style2', 'style7', 'style8')),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Background Color',
      'param_name'  => 'bg_color',
      'value'       => $vc_theme_color,
      'dependency' => Array('element' => 'style','value' => array('style1', 'style2', 'style3', 'style7', 'style8', 'style9')),
    ),
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Icon',
      'param_name'  => 'icon',
      'placeholder' => 'Select Icon',
      'icon_type'   => 'fontawesome',
      'value'       => 'fa fa-paper-plane-o',
      'dependency' => Array('element' => 'style','value' => array('style4')),
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Background Image (optional)',
      'param_name'  => 'bg_image',
      'dependency' => Array('element' => 'style','value' => array('style2', 'style7')),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Heading',
      'param_name'  => 'heading',
      'holder'      => 'h2',
      'dependency' => Array('element' => 'style','value' => array('style1', 'style2', 'style3', 'style4', 'style8', 'style9')),
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Color',
      'param_name'  => 'btn_color',
      'value'       => $vc_theme_color,
      'dependency' => Array('element' => 'style','value' => array('style1', 'style2', 'style3', 'style5', 'style6', 'style8', 'style9')),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Style',
      'param_name'  => 'btn_style',
      'value'       => array(
        'Flat'      => 'flat',
        'Outlined'  => 'unfilled'
      ),
      'dependency' => Array('element' => 'style','value' => array('style1', 'style2', 'style3', 'style5', 'style6', 'style8', 'style9')),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Border Width',
      'param_name'  => 'border_width',
      'value'       => array(
        'Light'      => 'br-light',
        'Semi Light' => 'br-semi-light',
        'Medium'     => 'br-medium',
        'Semi Thick' => 'br-semi-thick',
        'Thick'      => 'br-thick',
      ),
      'dependency' => Array('element' => 'btn_style','value' => array('unfilled')),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'btn_text',
      'dependency' => Array('element' => 'style','value' => array('style1', 'style2', 'style3', 'style5', 'style6', 'style8', 'style9')),
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link',
      'param_name'  => 'btn_link',
      'dependency' => Array('element' => 'style','value' => array('style1', 'style2', 'style3', 'style5', 'style6', 'style7', 'style8', 'style9')),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Hover Effect (Optional)',
      'param_name'  => 'btn_hover_effect',
      'value'       => array(
        'Select Hover Effect' => '',
        'Fill From Top'       => 'fill-frm-top',
        'Fill From Right'     => 'fill-frm-right',
        'Fill From Bottom'    => 'fill-frm-bottom',
        'Fill From Left'      => 'fill-frm-left',
      ),
      'dependency' => Array('element' => 'style','value' => array('style1', 'style2', 'style3', 'style5', 'style6', 'style8', 'style9')),
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'custom_bg_color',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color Hover',
      'param_name'  => 'custom_bg_color_hover',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Heading Color',
      'param_name'  => 'heading_color',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Icon Color',
      'param_name'  => 'icon_color',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'subheading_color',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Button Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Button Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color',
      'group'       => 'Button Colors',
    ),

    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color_hover',
      'group'       => 'Button Hover Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color_hover',
      'group'       => 'Button Hover Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color_hover',
      'group'       => 'Button Hover Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Dropcap
// ==========================================================================================
vc_map( array(
  'name'            => 'Promo Box With Border',
  'base'            => 'rs_promo_box_border',
  'icon'            => 'fa fa-sliders',
  'description'     => 'Create a promo box with borderd.',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Heading',
      'param_name'  => 'heading',
      'holder'      => 'h2'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Heading',
      'param_name'  => 'small_heading',
      'holder'      => 'h3'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text One',
      'param_name'  => 'btn_text_one',
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link One',
      'param_name'  => 'btn_link_one',
      'dependency'  => array( 'element' => 'btn_text_one', 'not_empty' => true )
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text Two',
      'param_name'  => 'btn_text_two',
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link Two',
      'param_name'  => 'btn_link_two',
      'dependency'  => array( 'element' => 'btn_text_two', 'not_empty' => true )
    ),

    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Color',
      'param_name'  => 'btn_color',
      'value'       => $vc_theme_color,
      'group'       => 'Button One Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Hover Effect (Optional)',
      'param_name'  => 'btn_hover_effect',
      'value'       => array(
        'Select Hover Effect' => '',
        'Fill From Top'       => 'fill-frm-top',
        'Fill From Right'     => 'fill-frm-right',
        'Fill From Bottom'    => 'fill-frm-bottom',
        'Fill From Left'      => 'fill-frm-left',
      ),
      'group'       => 'Button One Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Style',
      'param_name'  => 'btn_style',
      'value'       => array(
        'Select Style'  => '',
        'Flat'      => 'flat',
        'Outlined'  => 'unfilled'
      ),
      'group'       => 'Button One Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Border Width',
      'param_name'  => 'border_width',
      'value'       => array(
        'Light'      => 'br-light',
        'Semi Light' => 'br-semi-light',
        'Medium'     => 'br-medium',
        'Semi Thick' => 'br-semi-thick',
        'Thick'      => 'br-thick',
      ),
      'dependency' => Array('element' => 'btn_style','value' => array('unfilled')),
      'group'       => 'Button One Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Overlay Background Color',
      'param_name'  => 'overlay_one_background_color',
      'group'       => 'Button One Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Color',
      'param_name'  => 'btn_two_color',
      'value'       => $vc_theme_color,
      'group'       => 'Button Two Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Hover Effect (Optional)',
      'param_name'  => 'btn_two_hover_effect',
      'value'       => array(
        'Select Hover Effect' => '',
        'Fill From Top'       => 'fill-frm-top',
        'Fill From Right'     => 'fill-frm-right',
        'Fill From Bottom'    => 'fill-frm-bottom',
        'Fill From Left'      => 'fill-frm-left',
      ),
      'group'       => 'Button Two Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Style',
      'param_name'  => 'btn_two_style',
      'value'       => array(
        'Select Style'  => '',
        'Flat'      => 'flat',
        'Outlined'  => 'unfilled'
      ),
      'group'       => 'Button Two Properties'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Border Width',
      'param_name'  => 'border_two_width',
      'value'       => array(
        'Light'      => 'br-light',
        'Semi Light' => 'br-semi-light',
        'Medium'     => 'br-medium',
        'Semi Thick' => 'br-semi-thick',
        'Thick'      => 'br-thick',
      ),
      'dependency' => Array('element' => 'btn_two_style','value' => array('unfilled')),
      'group'       => 'Button Two Properties'
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Overlay Background Color',
      'param_name'  => 'overlay_two_background_color',
      'group'       => 'Button Two Properties'
    ),


    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Heading Color',
      'param_name'  => 'heading_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Heading Color',
      'param_name'  => 'heading_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Small Heading Color',
      'param_name'  => 'content_color',
      'group'       => 'Custom Colors',
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// Dropcap
// ==========================================================================================
vc_map( array(
  'name'            => 'Dropcap',
  'base'            => 'rs_dropcap',
  'icon'            => 'fa fa-sliders',
  'description'     => 'Create dropcap.',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Cap Alphabet',
      'param_name'  => 'cap',
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Cap Color',
      'param_name'  => 'color',
      'value'       => $vc_theme_color
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
      'value'       => ''
    ),
    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// GALLERY
// ==========================================================================================
vc_map( array(
  'name'            => 'Gallery Slider',
  'base'            => 'rs_gallery_slider',
  'icon'            => 'fa fa-film',
  'description'     => 'Add gallery.',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Style',
      'param_name'  => 'style',
      'value'       => array(
        'Style 1' => 'style1',
        'Style 2' => 'style2',
      ),
    ),
    array(
      'type'        => 'attach_images',
      'heading'     => 'Image',
      'admin_label' => true,
      'param_name'  => 'images',
      'description' => 'Multiple images are supported.'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Show Slider Thumbs ?',
      'param_name'  => 'slider_thumb',
      'value'       => array(
        'Yes'       => 'yes',
        'No'        => 'no'
      ),
      'dependency' => Array('element' => 'style','value' => array('style2')),
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )

) );

// ==========================================================================================
// BLOCKQUOTE
// ==========================================================================================
vc_map( array(
  'name'          => 'BlockQuote',
  'base'          => 'rs_blockquote',
  'icon'          => 'fa fa-quote-left',
  'description'   => 'Create a block quote.',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Background Color',
      'param_name'  => 'bg_color',
      'value'       => $vc_theme_color
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
      'value'       => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Cite',
      'param_name'  => 'cite',
      'admin_label' => true,
      'value'       => ''
    ),

    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'custom_bg_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Cite Color',
      'param_name'  => 'cite_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// GALLERY
// ==========================================================================================
vc_map( array(
  'name'            => 'Grid Gallery',
  'base'            => 'rs_grid_gallery',
  'icon'            => 'fa fa-film',
  'description'     => 'Add gallery on gird layout.',
  'params'          => array(
    array(
      'type'        => 'attach_images',
      'heading'     => 'Image',
      'admin_label' => true,
      'param_name'  => 'images',
      'description' => 'Multiple images are supported.'
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )

) );

// ==========================================================================================
// Iframe
// ==========================================================================================
vc_map( array(
  'name'            => 'Iframe Code',
  'base'            => 'rs_iframe',
  'icon'            => 'fa fa-film',
  'description'     => 'Add iframe code.',
  'params'          => array(
    array(
      'type'        => 'textarea_raw_html',
      'heading'     => 'iFrame Code',
      'holder'      => 'div',
      'param_name'  => 'content',
      'description' => 'Add iframe code'
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )

) );

// ==========================================================================================
// Play Box
// ==========================================================================================
vc_map( array(
  'name'            => 'Play Box',
  'base'            => 'rs_play_box',
  'icon'            => 'fa fa-film',
  'description'     => 'Add play box.',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
      'holder'      => 'h2'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Video URL',
      'param_name'  => 'video_url',
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div'
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )

) );

// ==========================================================================================
// VC TABS
// ==========================================================================================
$tab_unique_id_1 = time() . '-1-' . rand( 0, 100 );
$tab_unique_id_2 = time() . '-2-' . rand( 0, 100 );
$tab_unique_id_3 = time() . '-3-' . rand( 0, 100 );
vc_map( array(
  'name'            => 'Tabs',
  'base'            => 'vc_tabs',
  'is_container'    => true,
  'icon'            => 'fa fa-toggle-right',
  'description'     => 'Tabbed content',
  'params'          => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Tab Style',
      'param_name'  => 'style',
      'value'       => array(
        'Standard'  => 'standard',
        'Side Tabs' => 'sidetabs',
        'With Icon' => 'style-modern',
        'With Group'  => 'style2'
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Tab Color',
      'param_name'  => 'color',
      'value'       => array(
        'Light'  => 'style-default',
        'Dark'   => 'style-dark',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Tab Accent Color',
      'param_name'  => 'accent_color',
      'value'       => $vc_theme_color
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Tab Align',
      'param_name'  => 'align',
      'value'       => array(
        'Left'  => 'left',
        'Right' => 'onright',
      ),
      'dependency' => Array('element' => 'style','value' => array('sidetabs')),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Active Tab',
      'param_name'  => 'active',
      'description' => 'You can active any tab as default. Eg. 1 or 2 or 3'
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,

  ),
  'custom_markup'   => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children"><ul class="tabs_controls"></ul>%content%</div>',
  'default_content' => '
    [vc_tab title="Tab 1" tab_id="' . $tab_unique_id_1 . '"][/vc_tab]
    [vc_tab title="Tab 2" tab_id="' . $tab_unique_id_2 . '"][/vc_tab]
    [vc_tab title="Tab 3" tab_id="' . $tab_unique_id_3 . '"][/vc_tab]',
  'js_view'         => 'VcTabsView'
) );

// ==========================================================================================
// VC TAB
// ==========================================================================================
vc_map( array(
  'name'                      => 'Tab',
  'base'                      => 'vc_tab',
  'allowed_container_element' => 'vc_row',
  'is_container'              => true,
  'content_element'           => false,
  'params'                    => array(
    array(
      'type'        => 'tab_id',
      'heading'     => 'Tab Unique ID',
      'param_name'  => 'tab_id'
    ),
    array(
      'type'        => 'attach_image',
      'heading'     => 'Image Icon',
      'param_name'  => 'image_icon',
      'description' => 'This option is only for <strong>tab with icon</strong>'
    ),
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Icon',
      'param_name'  => 'icon',
      'placeholder' => 'Select Icon',
      'icon_type'   => 'fontawesome',
      'value'       => 'fa fa-paper-plane-o',
      'description'  => 'This option is only for <strong>tab with icon & image icon should be empty.</strong>'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Header Color',
      'param_name'  => 'tab_header_color',
      'value'       => array(
        'Green'      => 'tab-green',
        'Light Blue' => 'tab-light-blue',
        'Blue'       => 'tab-blue',
        'Red'        => 'tab-red',
        'Yellow'     => 'tab-yellow',
      ),
      'description'  => 'This option is only for <strong>tab with icon.</strong>'
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Tab Title',
      'param_name'  => 'title',
    ),
  ),
  'js_view'         => 'VcTabView'
) );

// ==========================================================================================
// VC ACCORDION
// ==========================================================================================
vc_map( array(
  'name'            => 'Accordion',
  'base'            => 'vc_accordion',
  'is_container'    => true,
  'icon'            => 'fa fa-plus-circle',
  'description'     => 'Accordion',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Active tab',
      'param_name'  => 'active_tab',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,
  ),

  'custom_markup'   => '<div class="wpb_accordion_holder wpb_holder clearfix vc_container_for_children">%content%</div><div class="tab_controls"><a class="add_tab" title="Add section"><span class="vc_icon"></span> <span class="tab-label">Add section</span></a></div>',
  'default_content' => '
    [vc_accordion_tab title="Section 1"][/vc_accordion_tab]
    [vc_accordion_tab title="Section 2"][/vc_accordion_tab]
  ',
  'js_view'         => 'VcAccordionView'
) );

// ==========================================================================================
// VC ACCORDION TAB
// ==========================================================================================
vc_map( array(
  'name'                      => 'Accordion Section',
  'base'                      => 'vc_accordion_tab',
  'allowed_container_element' => 'vc_row',
  'is_container'              => true,
  'content_element'           => false,
  'params'                    => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Title',
      'param_name'  => 'title',
    ),
  ),
  'js_view'         => 'VcAccordionTabView'
) );

// ==========================================================================================
// VC TOGGLE
// ==========================================================================================
vc_map( array(
  'name'        => 'Toggle',
  'base'        => 'vc_toggle',
  'icon'        => 'fa fa-unsorted',
  'description' => 'Toggle element for Q&A block',
  'params'      => array(
    array(
      'type'        => 'textfield',
      'holder'      => 'h4',
      'class'       => 'toggle_title',
      'heading'     => 'Toggle title',
      'param_name'  => 'title',
      'value'       => 'Toggle title',
    ),
    array(
      'type'        => 'textarea_html',
      'holder'      => 'div',
      'class'       => 'toggle_content',
      'heading'     => 'Toggle content',
      'param_name'  => 'content',
      'value'       => '<p>Toggle content goes here, click edit button to change this text.</p>',
    ),
    $vc_map_extra_id,
    $vc_map_extra_class,

  ),
  'js_view' => 'VcToggleView'
) );


// ==========================================================================================
// MESSAGE BOX
// ==========================================================================================
vc_map( array(
  'name'          => 'Message Box',
  'base'          => 'rs_msg_box',
  'icon'          => 'fa fa-warning',
  'description'   => 'Create a message box.',
  'params'        => array(
    array(
      'type'        => 'vc_icon',
      'heading'     => 'Select Icon',
      'param_name'  => 'icon',
      'icon_type'   => 'fontawesome',
      'placeholder' => 'Choose Icon',
      'admin_label' => true,
      'value'       => 'fa fa-paper-plane-o'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Box Type',
      'param_name'  => 'box_type',
      'admin_label' => true,
      'value'       => array(
        'Alert'   => 'alert',
        'Success' => 'success',
        'Notice'  => 'notification',
        'Danger'  => 'danger'
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Border Style',
      'param_name'  => 'border_style',
      'value'       => array(
        'Select Style' => '',
        'Thick Solid'  => 'br-thick',
        'Dashed'       => 'br-dashed',
      ),
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div',
      'value'       => ''
    ),

    // Custom Colors
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Custom Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color',
      'group'       => 'Custom Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// VC COLUMN TEXT
// ==========================================================================================
vc_map( array(
  'name'          => 'Text Block',
  'base'          => 'vc_column_text',
  'icon'          => 'fa fa-text-width',
  'description'   => 'A block of text with WYSIWYG editor',
  'params'        => array(
    array(
      'type'        => 'dropdown',
      'heading'     => 'Animate',
      'param_name'  => 'animate',
      'value'       => array(
        'No'  => 'no',
        'Yes' => 'yes',
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Scrolling Boundaries',
      'param_name'  => 'data_sb',
      'value'       => array(
        'Enter' => 'enter',
        'Exit'  => 'exit',
        'Span'  => 'span',
      ),
      'dependency' => Array('element' => 'animate','value' => array('yes')),
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'From',
      'param_name' => 'data_from',
      'description' => 'Enter the value in between 0 - 1.',
      'dependency' => Array('element' => 'animate','value' => array('yes')),
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'To',
      'param_name' => 'data_to',
      'description' => 'Enter the value in between 0 - 1.',
      'dependency' => Array('element' => 'animate','value' => array('yes')),
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Opacity',
      'param_name' => 'data_opacity',
      'description' => 'Enter the value in between 0 - 1.',
      'dependency' => Array('element' => 'animate','value' => array('yes')),
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Scale',
      'param_name' => 'data_scale',
      'dependency' => Array('element' => 'animate','value' => array('yes')),
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Translatey',
      'param_name' => 'data_translatey',
      'dependency' => Array('element' => 'animate','value' => array('yes')),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Align',
      'param_name'  => 'align',
      'value'       => array(
        'Choose Align' => '',
        'Left'         => 'left',
        'Center'       => 'center',
        'Right'        => 'Right'
      ),
    ),
    array(
      'holder'     => 'div',
      'type'       => 'textarea_html',
      'heading'    => 'Text',
      'param_name' => 'content',
      'value'      => '<p>I am text block. Click edit button to change this text.</p>',
    ),

    array(
      'type'        => 'dropdown',
      'heading'     => 'Font',
      'param_name'  => 'font',
      'admin_label' => true,
      'value'       => array_flip(rs_get_font_choices(true)),
      'group'       => 'Font Properties'
    ),

    array(
      'type'        => 'dropdown',
      'heading'     => 'Font Weight',
      'param_name'  => 'font_weight',
      'value'       => array(
        'Light'      => '300',
        'Normal'     => '400',
        'Bold'       => '600',
        'Bold'       => '700',
        'Extra Bold' => '800',
      ),
      'group'       => 'Font Properties'
    ),

    array(
      'type'        => 'dropdown',
      'heading'     => 'Font Style',
      'param_name'  => 'font_style',
      'value'       => array(
        'Normal' => 'normal',
        'Italic' => 'italic',
      ),
      'group'       => 'Font Properties'
    ),

    //custom color
    array(
      'type'       => 'colorpicker',
      'heading'    => 'Text Color',
      'param_name' => 'text_color',
      'group'      => 'Custom Color'
    ),

    //size
    array(
      'type'       => 'textfield',
      'heading'    => 'Text Size',
      'param_name' => 'text_size',
      'description' => 'Add in pixel e.g 14px',
      'group'      => 'Font Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Line Height',
      'param_name' => 'line_height',
      'description' => 'Add in pixel e.g 11px',
      'group'      => 'Font Properties'
    ),
    array(
      'type'       => 'textfield',
      'heading'    => 'Letter Spacing',
      'param_name' => 'letter_spacing',
      'description' => 'Add in pixel e.g 1px',
      'group'      => 'Font Properties'
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

if ( is_plugin_active( 'wysija-newsletters/index.php' ) ) {
  // ==========================================================================================
  // NEWS LETTER
  // ==========================================================================================
  vc_map( array(
    'name'          => 'Newsletter',
    'base'          => 'rs_newsletter',
    'icon'          => 'fa fa-envelope',
    'description'   => 'Add newsletter.',
    'params'        => array(
      array(
        'type'        => 'dropdown',
        'heading'     => 'Text Align',
        'param_name'  => 'align',
        'value'       => array(
          'Select Align' => '',
          'Left'         => 'align-left',
          'Center'       => 'text-center',
          'Right'        => 'align-right',
        ),
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Title',
        'param_name'  => 'title',
      ),
      array(
        'type'        => 'textfield',
        'heading'     => 'Note',
        'param_name'  => 'note',
        'admin_label' => true,
      ),
      array(
        'type'        => 'textarea',
        'heading'     => 'Content',
        'param_name'  => 'content',
        'description' => 'Insert newsletter shortcode.e.g [wysija_form id="1"]'
      ),
      array(
      'type'        => 'dropdown',
      'heading'     => 'Button Color',
      'param_name'  => 'button_color',
      'value'       => array(
        'Blue'       => 'btn-blue',
        'Light Blue' => 'btn-light-blue',
        ),
      ),

      // Extras
      $vc_map_extra_id,
      $vc_map_extra_class,

    )
  ) );
}

// ==========================================================================================
// Promo Box
// ==========================================================================================
vc_map( array(
  'name'            => 'Link Boxes',
  'base'            => 'rs_link_box',
  'icon'            => 'fa fa-sliders',
  'description'     => 'Add link boxes.',
  'params'          => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Small Heading',
      'param_name'  => 'small_heading',
      'holder'      => 'h5',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Big Heading',
      'param_name'  => 'big_heading',
      'holder'      => 'h2',
    ),
    array(
      'type'        => 'textarea_html',
      'heading'     => 'Content',
      'param_name'  => 'content',
      'holder'      => 'div'
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Color',
      'param_name'  => 'btn_color',
      'value'       => $vc_theme_color,
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Button Style',
      'param_name'  => 'btn_style',
      'value'       => array(
        'Flat'      => 'flat',
        'Outlined'  => 'unfilled'
      ),
    ),
    array(
      'type'        => 'dropdown',
      'heading'     => 'Border Width',
      'param_name'  => 'border_width',
      'value'       => array(
        'Light'      => 'br-light',
        'Semi Light' => 'br-semi-light',
        'Medium'     => 'br-medium',
        'Semi Thick' => 'br-semi-thick',
        'Thick'      => 'br-thick',
      ),
      'dependency' => Array('element' => 'btn_style','value' => array('unfilled')),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Button Text',
      'param_name'  => 'btn_text',
    ),
    array(
      'type'        => 'vc_link',
      'heading'     => 'Button Link',
      'param_name'  => 'btn_link',
      'dependency'  => array( 'element' => 'btn_text', 'not_empty' => true )
    ),

    array(
      'type'        => 'colorpicker',
      'heading'     => 'Small Heading Color',
      'param_name'  => 'small_heading_color',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Big Heading Color',
      'param_name'  => 'big_heading_color',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'heading_border_color',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Content Color',
      'param_name'  => 'content_color',
      'group'       => 'Extra Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color',
      'group'       => 'Button Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color',
      'group'       => 'Button Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color',
      'group'       => 'Button Colors',
    ),

    array(
      'type'        => 'colorpicker',
      'heading'     => 'Border Color',
      'param_name'  => 'border_color_hover',
      'group'       => 'Button Hover Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Text Color',
      'param_name'  => 'text_color_hover',
      'group'       => 'Button Hover Colors',
    ),
    array(
      'type'        => 'colorpicker',
      'heading'     => 'Background Color',
      'param_name'  => 'background_color_hover',
      'group'       => 'Button Hover Colors',
    ),

    // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,
  )
) );

// ==========================================================================================
// CS FAQ
// ==========================================================================================
$faq_unique_id_1 = time() . '-1-' . rand( 0, 100 );
$faq_unique_id_2 = time() . '-2-' . rand( 0, 100 );
$faq_unique_id_3 = time() . '-3-' . rand( 0, 100 );

vc_map( array(
  'name'                    => 'Sortable Toggle',
  'base'                    => 'cs_faq',
  'icon'                    => 'fa fa-question-circle',
  'description'             => 'Create a faq',
  'class'                   => 'wpb_vc_tabs',
  'is_container'            => true,
  'show_settings_on_create' => false,
  'params'                  => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra ID',
      'param_name'  => 'id',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Extra Class',
      'param_name'  => 'class',
    ),
  ),
  'custom_markup'           => '<div class="wpb_tabs_holder wpb_holder vc_container_for_children"><ul class="tabs_controls"></ul>%content%</div>',
  'default_content'         => '
    [cs_faq_block title="Tab 1" tab_id="' . $faq_unique_id_1 . '"][vc_toggle mix_class="mix" title="Question"]Answer[/vc_toggle][/cs_faq_block]
    [cs_faq_block title="Tab 2" tab_id="' . $faq_unique_id_2 . '"][vc_toggle mix_class="mix" title="Question"]Answer[/vc_toggle][/cs_faq_block]
    [cs_faq_block title="Tab 3" tab_id="' . $faq_unique_id_3 . '"][vc_toggle mix_class="mix" title="Question"]Answer[/vc_toggle][/cs_faq_block]',
  'js_view'                 => 'CSFAQSView'
) );


// ==========================================================================================
// CS FAQ BLOCK
// ==========================================================================================
vc_map( array(
  'name'                      => 'Tab Block',
  'base'                      => 'cs_faq_block',
  'allowed_container_element' => 'vc_row',
  'as_parent'                 => array('only' => 'vc_toggle'),
  'is_container'              => true,
  'content_element'           => false,
  'params'                    => array(
    array(
      'type'                  => 'tab_id',
      'heading'               => 'Tab Unique ID',
      'param_name'            => 'tab_id'
    ),
    array(
      'type'                  => 'textfield',
      'heading'               => 'Title',
      'param_name'            => 'title',
    ),
  ),
  'js_view'                   => 'CSFAQView'
) );


// ==========================================================================================
// WOO PRODUCTS
// ==========================================================================================
vc_map( array(
  'name'          => 'Woo Featured Products',
  'base'          => 'rs_woo_featured_products',
  'icon'          => 'fa fa-shopping-cart',
  'description'   => 'Add WooCommerce products.',
  'params'        => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Category ID',
      'value'       => rs_element_values( 'categories', array('sort_order'  => 'ASC','taxonomy'    => 'product_cat','hide_empty'  => false,) ),
      'placeholder' => 'Choose Category',
      'admin_label' => true,
      'std'         => '',
      'param_name'  => 'category_id',
    ),
    array(
        'type' => 'dropdown',
        'admin_label' => true,
        'heading' => 'Order by',
        'param_name' => 'orderby',
        'value' => array(
          esc_html__('Rand', 'rs')       => 'rand',
          esc_html__('Date', 'rs')       => 'date',
          esc_html__('Price', 'rs')      => 'price',
          esc_html__('Popularity', 'rs') => 'popularity',
          esc_html__('Rating', 'rs')     => 'rating',
          esc_html__('Title', 'rs')      => 'title',
        ),
    ),
    array(
      'type' => 'dropdown',
      'admin_label' => true,
      'heading' => 'Order',
      'param_name' => 'order',
      'value' => array(
        esc_html__('Ascending', 'rs')  => 'asc',
        esc_html__('Descending', 'rs') => 'desc'
      ),
    'dependency'  => array( 'element' => 'orderby', 'value' => array('date', 'price', 'title') ),
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Limit',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),
     // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// WOO PRODUCTS
// ==========================================================================================
vc_map( array(
  'name'          => 'Woo Best Seller Products',
  'base'          => 'rs_woo_best_seller',
  'icon'          => 'fa fa-shopping-cart',
  'description'   => 'Add WooCommerce products.',
  'params'        => array(
    array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Category ID',
      'value'       => rs_element_values( 'categories', array('sort_order'  => 'ASC','taxonomy'    => 'product_cat','hide_empty'  => false,) ),
      'placeholder' => 'Choose Category',
      'std'         => '',
      'admin_label' => true,
      'param_name'  => 'category_id',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Limit',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),
     // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );

// ==========================================================================================
// WOO PRODUCTS
// ==========================================================================================
vc_map( array(
  'name'          => 'Woo Products',
  'base'          => 'rs_woo_products',
  'icon'          => 'fa fa-shopping-cart',
  'description'   => 'Add WooCommerce products.',
  'params'        => array(
	array(
      'type'        => 'vc_efa_chosen',
      'heading'     => 'Category ID',
      'value'       => rs_element_values( 'categories', array('sort_order'  => 'ASC','taxonomy'    => 'product_cat','hide_empty'  => false,) ),
      'placeholder' => 'Choose Category',
      'std'         => '',
      'admin_label' => true,
      'param_name'  => 'category_id',
    ),
	array(
      'type' => 'dropdown',
      'admin_label' => true,
      'heading' => 'Order by',
      'param_name' => 'orderby',
      'value' => array(
        esc_html__('Rand', 'rs') => 'rand',
        esc_html__('Date', 'rs') => 'date',
        esc_html__('Price', 'rs') => 'price',
        esc_html__('Popularity', 'rs') => 'popularity',
        esc_html__('Rating', 'rs') => 'rating',
        esc_html__('Title', 'rs') => 'title',
      ),
	),
	array(
      'type' => 'dropdown',
      'admin_label' => true,
      'heading' => 'Order',
      'param_name' => 'order',
      'value' => array(
        esc_html__('Ascending', 'rs') => 'asc',
        esc_html__('Descending', 'rs') => 'desc'
      ),
	  'dependency'  => array( 'element' => 'orderby', 'value' => array('date', 'price', 'title') ),
    ),
    array(
      'type' => 'dropdown',
      'heading' => 'Show',
      'param_name' => 'show',
      'admin_label' => true,
      'value' => array(
        esc_html__('All Products'   , 'splendid-addons') 	=> '',
        esc_html__('Featured Products'  , 'splendid-addons') 	=> 'featured',
        esc_html__('On-sale Products', 'splendid-addons') 	=> 'onsale',
      ),
      'description' => ''
    ),
	array(
      'type'        => 'textfield',
      'heading'     => 'Limit Per Page',
      'param_name'  => 'limit',
      'admin_label' => true,
    ),
	array(
      'type'  => 'dropdown',
      'value' => array(
        'Yes' => 'yes',
        'No'  => 'no',
      ),
	  'std' => 'no',
      'heading'    => 'Enable Sorting and Posts Per Page Dropdowns',
      'param_name' => 'sorting_posts_per_page',
    ),
	array(
      'type'  => 'dropdown',
      'value' => array(
        'Yes' => 'yes',
        'No'  => 'no',
      ),
	  'std' => 'no',
      'heading'    => 'Enable Pagination',
      'param_name' => 'pagination',
    ),
	// Extras
    $vc_map_extra_id,
    $vc_map_extra_class
  )
) );

// ==========================================================================================
// COMMING SOON COUNTER
// ==========================================================================================
vc_map( array(
  'name'          => 'Coming Soon Counter',
  'base'          => 'rs_coming_soon_counter',
  'icon'          => 'fa fa-shopping-cart',
  'description'   => 'Add coming soon counter.',
  'params'        => array(
    array(
      'type'        => 'textfield',
      'heading'     => 'Year',
      'admin_label' => true,
      'param_name'  => 'year',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Month',
      'admin_label' => true,
      'param_name'  => 'month',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Day',
      'admin_label' => true,
      'param_name'  => 'day',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Hour',
      'admin_label' => true,
      'param_name'  => 'hour',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Minute',
      'admin_label' => true,
      'param_name'  => 'minute',
    ),
    array(
      'type'        => 'textfield',
      'heading'     => 'Second',
      'param_name'  => 'second',
      'admin_label' => true,
    ),
     // Extras
    $vc_map_extra_id,
    $vc_map_extra_class,

  )
) );


// ==========================================================================================
// SLIDER CONTENTS
// ==========================================================================================
vc_map( array(
  'name'                    => 'Parallax Container',
  'base'                    => 'rs_parallax_container',
  'icon'                    => 'fa fa-exchange',
  'description'             => 'Add content inside parallax',
  'params'                  => array(
    array(
      'type'        => 'textfield',
      'param_name'  => 'parallax_stellar_ratio',
      'heading'     => 'Parallax Stellar Ratio',
      'description' => 'Enter stellar ratio in between 0-1.',
    ),
    array(
      'type'        => 'textfield',
      'param_name'  => 'parallax_stellar_hor_offset',
      'heading'     => 'Parallax Stellar Horizontal Offset',
      'description' => 'Enter stellar ratio in between 0-100.',
    ),
    array(
      'type'        => 'textfield',
      'param_name'  => 'parallax_stellar_ver_offset',
      'heading'     => 'Parallax Stellar Vertical Offset',
      'description' => 'Enter stellar ratio in between 0-100.',
    ),
    array(
      'type' => 'css_editor',
      'heading' => esc_html__( 'CSS box', 'js_composer' ),
      'param_name' => 'css',
      'group' => esc_html__( 'Design Options', 'js_composer' )
    ),

    $vc_map_extra_id,
    $vc_map_extra_class,

  ),
  'as_parent'       => array('only' => 'rs_parallax_container_item'),
  'js_view'         => 'RSSliderView',
) );

vc_map( array(
  'name'            => 'Parallax Content',
  'base'            => 'rs_parallax_container_item',
  'as_child'        => array('only' => 'rs_parallax_container'),
  'is_container'    => true,
  'content_element' => false,
  'js_view'         => 'VcColumnView',
) );


require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-tab.php' );
require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-tabs.php' );

class WPBakeryShortCode_CS_FAQ extends WPBakeryShortCode_VC_Tabs {}
class WPBakeryShortCode_CS_FAQ_Block extends WPBakeryShortCode_VC_Tab {
  public function mainHtmlBlockParams( $width, $i ) {
    return 'data-element_type="'.$this->settings["base"].'" class="wpb_'.$this->settings['base'].' wpb_vc_tab wpb_sortable wpb_content_holder"'.$this->customAdminBlockParams();
  }
}

class WPBakeryShortCode_RS_Parallax_Container extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Parallax_Container_Item extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Feature_Box  extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Feature_Box_Item  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Content_Box_2  extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Content_Box_2_Item  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Pricing_Table  extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Pricing_Table_Item  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Process_Box  extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Process_Box_Item  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Banner_Slider   extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Banner_Slide  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Counter_2   extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Counter_Item_2  extends WPBakeryShortCode {}
class WPBakeryShortCode_RS_Client   extends RS_WPBakeryShortCodesContainer {}
class WPBakeryShortCode_RS_Client_Item  extends WPBakeryShortCode {}

class RS_WPBakeryShortCodesContainer extends WPBakeryShortCodesContainer {
  public function contentAdmin( $atts, $content = null ) {
      $width = $el_class = '';
      extract( shortcode_atts( $this->predefined_atts, $atts ) );
      $label_class = ( isset( $this->settings['label_class'] ) ) ? $this->settings['label_class'] : 'info';
      $output  = '';

      $column_controls = $this->getColumnControls( $this->settings( 'controls' ) );
      $column_controls_bottom = $this->getColumnControls( 'add', 'bottom-controls' );
      for ( $i = 0; $i < count( $width ); $i ++ ) {
        $output .= '<div ' . $this->mainHtmlBlockParams( $width, $i ) . '>';
        $output .= '<div class="rs-container-title"><span class="rs-label rs-label-'. $label_class .'">'. $this->settings['name'] .'</span></div>'; // ADDED THIS LINE
        $output .= $column_controls;
        $output .= '<div class="wpb_element_wrapper">';
        $output .= '<div ' . $this->containerHtmlBlockParams( $width, $i ) . '>';
        $output .= do_shortcode( shortcode_unautop( $content ) );
        $output .= '</div>';
        if ( isset( $this->settings['params'] ) ) {
          $inner = '';
          foreach ( $this->settings['params'] as $param ) {
            $param_value = isset( $$param['param_name'] ) ? $$param['param_name'] : '';
            if ( is_array( $param_value ) ) {
              // Get first element from the array
              reset( $param_value );
              $first_key = key( $param_value );
              $param_value = $param_value[$first_key];
            }
            $inner .= $this->singleParamHtmlHolder( $param, $param_value );
          }
          $output .= $inner;
        }
        $output .= '</div>';
        $output .= $column_controls_bottom;
        $output .= '</div>';
      }
      return $output;
  }
}


add_action( 'admin_init', 'vc_remove_elements', 10);
function vc_remove_elements( $e = array() ) {

  if ( !empty( $e ) ) {
    foreach ( $e as $key => $r_this ) {
      vc_remove_element( 'vc_'.$r_this );
    }
  }
}

$s_elemets = array( 'icon', 'masonry_media_grid', 'masonry_grid', 'basic_grid', 'media_grid', 'custom_heading', 'empty_space', 'clients', 'widget_sidebar', 'images_carousel', 'carousel', 'tour', 'gallery', 'posts_slider', 'posts_grid', 'teaser_grid', 'separator', 'text_separator', 'message', 'facebook', 'tweetmeme', 'googleplus', 'pinterest', 'single_image', 'button', 'button2', 'cta_button', 'cta_button2', 'video', 'gmaps', 'flickr', 'progress_bar', 'raw_js', 'pie', 'wp_meta', 'wp_recentcomments', 'wp_text', 'wp_calendar', 'wp_pages', 'wp_custommenu', 'wp_posts', 'wp_links', 'wp_categories', 'wp_archives', 'wp_rss' );
vc_remove_element('client', 'testimonial', 'contact-form-7');
vc_remove_elements( $s_elemets );

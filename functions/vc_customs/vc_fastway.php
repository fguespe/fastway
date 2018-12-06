<?
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Responsiveness",
    "param_name" => "fw_responsive",
    "value" => array(
        "Select an option" => "",
        "Only In Desktop" => "d-none d-md-flex",
        "Only on Mobile" => "d-md-none",
    )
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Width of Columns Inside",
    "param_name" => "fw_columns_responsive",
    "value" => array(
        "Select an option" => "",
        "50%" => "two_mobile_columns",
        "33%" => "three_mobile_columns",
        "25%" => "four_mobile_columns",
    )
));
vc_add_param("vc_row", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Has a FW Slider In It AND row is Full Width?",
    "param_name" => "fw_swiper",
    "value" => array(
        "Select an option" => "",
        "Yes" => "fw_swiper",
    )
));
vc_add_param("vc_row_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Responsiveness",
    "param_name" => "fw_responsive",
    "value" => array(
        "Select an option" => "",
        "Only In Desktop" => "d-none d-md-flex",
        "Only on Mobile" => "d-md-none",
    )
));
vc_add_param("vc_row_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Width of Columns Inside",
    "param_name" => "fw_columns_responsive",
    "value" => array(
        "Select an option" => "",
        "50%" => "two_mobile_columns",
        "33%" => "three_mobile_columns",
        "25%" => "four_mobile_columns",
    )
));
vc_add_param("vc_column", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Responsiveness",
    "param_name" => "fw_responsive",
    "value" => array(
        "Select an option" => "",
        "Only In Desktop" => "d-none d-md-flex",
        "Only on Mobile" => "d-md-none",
    )
));
vc_add_param("vc_column", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Width of Column In Mobile",
    "param_name" => "fw_columns_responsive",
    "value" => array(
        "Select an option" => "",
        "50%" => "onehalf_mobile",
        "33%" => "onethird_mobile",
        "25%" => "onefourth_mobile",
    )
));
vc_add_param("vc_column", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Margin in Mobile",
    "param_name" => "fw_columns_margin",
    "value" => array(
        "Select an option" => "",
        "Top" => "withtopmargin",
        "Bottom" => "withbottommargin",
    )
));
vc_add_param("vc_column_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Responsiveness",
    "param_name" => "fw_responsive",
    "value" => array(
        "Select an option" => "",
        "Only In Desktop" => "d-none d-md-flex",
        "Only on Mobile" => "d-md-none",
    )
));
vc_add_param("vc_column_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Margin in Mobile",
    "param_name" => "fw_columns_margin",
    "value" => array(
        "Select an option" => "",
        "Top" => "withtopmargin",
        "Bottom" => "withbottommargin",
    )
));
vc_add_param("vc_column_inner", array(
    "type" => "dropdown",
    "group" => "Fastway",
    "class" => "",
    "heading" => "Width of Column In Mobile",
    "param_name" => "fw_columns_responsive",
    "value" => array(
        "Select an option" => "",
        "50%" => "onehalf_mobile",
        "33%" => "onethird_mobile",
        "25%" => "onefourth_mobile",
    )
));

add_action( 'vc_before_init', 'vc_statick_block' );//Prds de categoria
function vc_statick_block() {

    $static_block_args = fastway_get_stblock();
    vc_map( array(
            "name" => __("Static Block", 'fastway'),
            'base' => 'fw_shortcode_stblock',
            'description' => __('FW Statick Block', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   "controls" => "full",
            'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                "params" => array(
                array(
                  "type"        => "dropdown",
                  "heading"     => __("Select Block"),
                  "param_name"  => "slug",
                  "admin_label" => true,
                  "value"       => $static_block_args,
                  "std"         => " ",
                ),
            )
    ) );

}
add_action( 'vc_before_init', 'vc_meta_slider' );//Prds de categoria
function vc_meta_slider() {

    $fw_getmsliders = fw_getmsliders();
    vc_map( array(
            "name" => __("Meta Sliders", 'fastway'),
            'base' => 'fw_shortcode_metaslider',
            'description' => __('FW Meta Sliders', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   "controls" => "full",
            'icon' => get_template_directory_uri().'/assets/img/favi.png',            
            "params" => array(
                array(
                  "type"        => "dropdown",
                  "heading"     => __("Desktop Slider"),
                  "param_name"  => "sl_desktop",
                  "admin_label" => true,
                  "value"       => $fw_getmsliders,
                  "std"         => " ",
                ),
                array(
                  "type"        => "dropdown",
                  "heading"     => __("Mobile Slider"),
                  "description"     => __("Leave empty to use desktop also"),
                  "param_name"  => "sl_mobile",
                  "admin_label" => true,
                  "value"       => $fw_getmsliders,
                  "std"         => " ",
                ),

            )
    ) );

}

// After VC Init
add_action( 'vc_after_init', 'vc_after_init_actions' );
 
function vc_after_init_actions() {
     
    
 
    // Add Params
    $vc_single_image_params = array(
         
        // Example
        array(
            'type' => 'textfield',
            'heading' => __( 'Image size', 'js_composer' ),
            'param_name' => 'img_size',
            'value' => 'full',
            'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use "thumbnail" by default.', 'js_composer' ),
        ),  
        array(
                'type' => 'dropdown',
                'heading' => __( 'Image alignment', 'js_composer' ),
                'param_name' => 'alignment',
                'value' => array(
                    __( 'Left', 'js_composer' ) => '',
                    __( 'Right', 'js_composer' ) => 'right',
                    __( 'Center', 'js_composer' ) => 'center',
                ),
                'std'=>'center',
                'description' => __( 'Select image alignment.', 'js_composer' ),
        ),    
     
    );
    $vc_empty_space_params = array(
         
        // Example
        array(
            'type' => 'textfield',
            'heading' => __( 'Height', 'js_composer' ),
            'param_name' => 'height',
            'value' => '64px',
        ),  
        
     
    );
    $vc_row_params = array(
         
        // Example
        array(
            'type' => 'dropdown',
            'heading' => __( 'Row stretch', 'js_composer' ),
            'param_name' => 'full_width',
            'value' => array(
                __( 'Default', 'js_composer' ) => '',
                __( 'Stretch row', 'js_composer' ) => 'stretch_row',
                __( 'Stretch row and content', 'js_composer' ) => 'stretch_row_content',
                __( 'Stretch row and content (no paddings)', 'js_composer' ) => 'stretch_row_content_no_spaces',
            ),
            'std'=>'stretch_row',
            'description' => __( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property'), 
        ),
        
     
    );
     
    vc_add_params( 'vc_single_image', $vc_single_image_params ); 
    //vc_add_params( 'vc_empty_space', $vc_empty_space_params ); 
    vc_add_params( 'vc_row', $vc_row_params ); 
         
}
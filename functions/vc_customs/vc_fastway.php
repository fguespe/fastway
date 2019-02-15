<?php

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

function fw_slider() {
    // Title
    vc_map(
        array(
            'name' => __( 'FW Slider' ),
            'base' => 'fw_slider_function',
            'description' => __('FW Slider', 'fastway'), 
            'category' => __('Fastway', 'fastway'), 
            'icon' => get_template_directory_uri().'/assets/img/favi.png',  
            'params' => array(
                array(
                    "type"        => "attach_images",
                    "heading"     => esc_html__( "Desktop Images", "fastway" ),
                    "param_name"  => "slides_desktop",
                    "value"       => "",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Desktop Links (separated with ,)"),
                    "param_name"  => "links_desktop",
                ),
                array(
                    "type"        => "attach_images",
                    "heading"     => esc_html__( "Mobile Images", "fastway" ),
                    "param_name"  => "slides_mobile",
                    "value"       => "",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Desktop Links (separated with ,)"),
                    "param_name"  => "links_mobile",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("Columns"),
                    "param_name"  => "cols",
                    'value' => '1',
                ),
                array(
                    'type' => 'el_id',
                    'heading' => __( 'Element ID', 'js_composer' ),
                    'param_name' => 'el_id',
                    'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'js_composer' ),
                    'param_name' => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
                ),  

            )
        )
    );
    }

add_action( 'vc_before_init', 'fw_slider' );



function fw_slider_function( $atts, $content ) {
    $rand=generateRandomString(5);
    $atts = shortcode_atts(
        array(
            'slides_desktop'      =>  '',
            'links_desktop'      =>  '',
            'slides_mobile'      =>  '',
            'links_mobile'      =>  '',
            'cols'      =>  'cols',
        ), $atts );
    $cols=$atts['cols'];
    if(!is_numeric($cols))$cols=1;
    //Desktop
    $image_ids = explode(',',$atts['slides_desktop']);
    $claserespo=' d-none d-md-block ';
    $ismobile=!empty($atts['slides_mobile']);
    if(!$ismobile)$claserespo=' ';
    $links = explode(',',$atts['links_desktop']);
    $return = '
    <div class="swiper-fwslider-'.$rand.'  '.$claserespo.'  over-hidden relative">
    <div class="swiper-wrapper clear-ul">';
    $cant=0;
    foreach( $image_ids as $image_id ){
        $images = wp_get_attachment_image_src( $image_id, '' );
        $link=$links[$cant];
        $image=$images[0];
        if(!$link)$link="#";
        $return .= '<div class="swiper-slide">';
        $return .= '<a href="'.$link.'" ><div class="item product-category">';
        $return .= '<img src="'.$image.'" width="100%"  height="auto"/>';
        $return .= '</div></a></div>';    
        $cant++;
    }
    $return .='</div>
    <div class="swiper-prev swiper-fwslider-'.$rand.'-prev"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-next swiper-fwslider-'.$rand.'-next"><i class="fa fa-angle-right"></i></div>
    </div>
    <script>
    var swiper = new Swiper(".swiper-fwslider-'.$rand.'", {
        navigation: {
            nextEl: ".swiper-fwslider-'.$rand.'-next",
            prevEl: ".swiper-fwslider-'.$rand.'-prev",
        },   
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        loop: true,
        autoplay: { delay: 4500, },
        autoplayDisableOnInteraction: true,
        slidesPerView: '.$cols.'
    });
    </script>';
    if(!$ismobile)return $return;
    //Mobile
    $image_ids = explode(',',$atts['slides_mobile']);
    $links = explode(',',$atts['links_mobile']);
    $cant=0;
    $return .= '
    <div class="swiper-fwslider-'.$rand.' d-md-none   over-hidden relative">
    <div class="swiper-wrapper clear-ul">';
    foreach( $image_ids as $image_id ){
        $images = wp_get_attachment_image_src( $image_id, '' );
        $link=$links[$cant];
        $image=$images[0];
        $return .= '<div class="swiper-slide">';
        $return .= '<a href="'.$link.'" ><div class="item product-category">';
        $return .= '<img src="'.$image.'" width="100%"  height="auto"/>';
        $return .= '</div></a></div>';    
    }
    $return .='</div>
    <div class="swiper-prev swiper-fwslider-'.$rand.'-prev"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-next swiper-fwslider-'.$rand.'-next"><i class="fa fa-angle-right"></i></div>
    </div>
    <script>
    var swiper = new Swiper(".swiper-fwslider-'.$rand.'", {
        navigation: {
            nextEl: ".swiper-fwslider-'.$rand.'-next",
            prevEl: ".swiper-fwslider-'.$rand.'-prev",
        },   
        paginationClickable: true,
        spaceBetween: 30,
        centeredSlides: true,
        autoplay: { delay: 4500, },
        loop: true,
        autoplayDisableOnInteraction: true,
        slidesPerView: '.$cols.'
    });
    </script>';
    
    return $return;
}   
add_shortcode( 'fw_slider_function', 'fw_slider_function' ); 


add_action( 'vc_before_init', 'vc_statick_block' );//Prds de categoria
function vc_statick_block() {

    $static_block_args = fastway_get_stblock();
    vc_map( array(
            "name" => __("Static Block", 'fastway'),
            'base' => 'fw_shortcode_stblock',
            'description' => __('FW Statick Block', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   
            "controls" => "full",
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

add_action( 'vc_before_init', 'vc_fw_shorts' );//Prds de categoria
function vc_fw_shorts() {

    $static_block_args = fastway_get_stblock();
    $static_block_args=array_merge(array(
        "Select an option" => "",),$static_block_args);

    vc_map( array(
            "name" => __("FW Icon", 'fastway'),
            'base' => 'fw_data',
            'description' => __('FW Icon', 'fastway'), 
            'category' => __('Fastway', 'fastway'),   "controls" => "full",
            'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                "params" => array(
                array(
                  "type" => 'textfield',
                  "heading"     => __("Type"),
                  "param_name"  => "type",
                  'description' => 'fb,youtube,whatsapp,ig,email,phone,address <br>
                  or fa-icon fal or fa-icon',
                  "admin_label" => true,
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Type"),
                    "param_name"  => "format",
                    
                    "value" => array(
                        "Select an option" => "",
                        "Icono Izq,Texto Arriba Grande y Texto Chiquito Abajo (stext)" =>"isli"  ,
                        "Icono Izq,Texto Abajo Grande y Texto Chiquito Arriba (stext)"=>"isli_i",
                        "Solo Icono/s (Separar con ,)"=>"iconsnext",
                        "Icono arriba, texto abajo"=>"iconbox",
                    ),
                    "std" => 'iconsnext', //Default Red color
                ),
                array(
                    "type" => 'dropdown',
                    "heading"     => __("Alignment"),
                    "param_name"  => "text_align",
                    
                    "value" => array(
                        "Left" =>"left",
                        "Center"=>"center",
                        "Right"=>"right",
                    ),
                    "std" => 'left', //Default Red color
                ),
                array(
                    "type" => 'checkbox',
                    "heading"     => "Hide Icon",
                    "param_name"  => "only_text",
                    "std"         => "",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => "Texto",
                    'description' => '(Por default pone company data solo)',
                    "param_name"  => "text",
                    "admin_label" => true,
                ),
                
                array(
                    "type" => 'textfield',
                    "heading"     => 'Subtext',
                    "param_name"  => "stext",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("size"),
                    "param_name"  => "size",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("link"),
                    "param_name"  => "link",
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("cant"),
                    "param_name"  => "cant",
                ),

               
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Icon color", "fastway" ),
                    "param_name" => "icon_color",
                    "value" => '', //Default Red color
                    "description" => __( "Choose text color", "fastway" )
                ),
                array(
                    "type" => "colorpicker",
                    "class" => "",
                    "heading" => __( "Text color", "fastway" ),
                    "param_name" => "text_color",
                    "value" => '', //Default Red color
                    "description" => __( "Choose text color", "fastway" )
                ),
                array(
                    "type" => 'textfield',
                    "heading"     => __("iframe"),
                    "param_name"  => "iframe",
                    "admin_label" => true,
                ),
                array(
                    "type"        => "dropdown",
                    "heading"     => __("Select Block"),
                    "param_name"  => "sblock",
                    "value"       => $static_block_args,
                    "std"         => "",
                ),
                array(
                    'type' => 'el_id',
                    'heading' => __( 'Element ID', 'js_composer' ),
                    'param_name' => 'el_id',
                    'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'js_composer' ),
                    'param_name' => 'el_class',
                    'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
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
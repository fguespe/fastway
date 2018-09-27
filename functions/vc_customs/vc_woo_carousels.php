<?php

add_action( 'vc_before_init', 'vc_category_carousel' );//Prds de categoria
function vc_category_carousel() {

    vc_map( 
            array(
                'name' => __('Category Products Carousel', 'fastway'),
                'base' => 'fw_category_carousel',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'fastway' ),
                        'param_name' => 'title',
                        'value' => 'Title',
                        'std' => 'Title',
                        'admin_label' => true,
                        'weight' => 0,
                    ), 
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Categories Slugs', 'fastway' ),
                        'param_name' => 'category',
                        'value' => '',
                        'std' => '',
                        'admin_label' => true,
                        'weight' => 0,
                    ), 
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Prods per row ', 'fastway' ),
                        'param_name' => 'prodsperrow',
                        'value' => '4',
                        'std' => '4',
                        'admin_label' => false,
                        'weight' => 0,
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
                    ),   array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                ),
            )

            
        );          

}
add_action( 'vc_before_init', 'vc_categories_carousel' );//Cates en general
function vc_categories_carousel() {

    vc_map( 
            array(
                'name' => __('Categories Carousel', 'fastway'),
                'base' => 'fw_categories_carousel',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'fastway' ),
                        'param_name' => 'title',
                        'value' => 'Title',
                        'std' => 'Title',
                        'admin_label' => true,
                        'weight' => 0,
                    ), 
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Categories', 'fastway' ),
                        'param_name' => 'cats',
                        'weight' => 0,
                    ), 
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Prods per row ', 'fastway' ),
                        'param_name' => 'prodsperrow',
                        'value' => '4',
                        'std' => '4',
                        'admin_label' => false,
                        'weight' => 0,
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
                    ),   array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
                ),
            )

            
        );          

}

add_action( 'vc_before_init', 'vc_featured_products' );
function vc_featured_products() {

  vc_map( 
            array(
                'name' => __('Featured Products Carousel', 'fastway'),
                'base' => 'fw_featured_products',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                'params' => getwoocampos(),
            )

            
        );          

}
add_action( 'vc_before_init', 'vc_sale_products' );
function vc_sale_products() {

  vc_map( 
            array(
                'name' => __('Sale Products Carousel', 'fastway'),
                'base' => 'fw_sale_products',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                'params' => getwoocampos(),
            )

            
        );          

}
add_action( 'vc_before_init', 'vc_bestselling_products' );
function vc_bestselling_products() {

  vc_map( 
            array(
                'name' => __('Best Selling Products Carousel', 'fastway'),
                'base' => 'fw_bestselling_products',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                'params' => getwoocampos(),
            )

            
        );          

}


add_action( 'vc_before_init', 'vc_recent_products' );
function vc_recent_products() {

  vc_map( 
            array(
                'name' => __('Recent Products Carousel', 'fastway'),
                'base' => 'fw_recent_products',
                'description' => __('Carousel of products', 'fastway'), 
                'category' => __('Fastway', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                'params' => getwoocampos(),
            )

            
        );          

}
function getwoocampos(){
  return array(
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'fastway' ),
                        'param_name' => 'title',
                        'value' => 'Title',
                        'std' => 'Title',
                        'admin_label' => true,
                        'weight' => 0,
                    ), 
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Prods per row ', 'fastway' ),
                        'param_name' => 'prodsperrow',
                        'value' => '4',
                        'std' => '4',
                        'admin_label' => false,
                        'weight' => 0,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Max Quantiy', 'fastway' ),
                        'param_name' => 'maxcant',
                        'value' => '12',
                        'std' => '12',
                        'admin_label' => false,
                        'weight' => 0,
                    ), 
                    /*
                    array(
                      "type"        => "dropdown",
                      "heading"     => __("Select category"),
                      "param_name"  => "type",
                      "admin_label" => true,
                      "value"       => array(
                          'Featured'   => 'featured',
                          'Recent'   => 'recent',
                          'Best Selling' => 'bestselling',
                          'Sale' => 'bestselling',
                          'Best Selling' => 'bestselling',
                      ), //value
                      'std' => 'Recent',
                      'admin_label' => false,
                      'weight' => 0,
                    ),   
                    */
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
                    ),   array(
                        'type' => 'css_editor',
                        'heading' => __( 'CSS box', 'js_composer' ),
                        'param_name' => 'css',
                        'group' => __( 'Design Options', 'js_composer' ),
                    ),
);
}


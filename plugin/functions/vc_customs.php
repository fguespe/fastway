<?php

class vcInfoBox extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
        add_shortcode( 'vc_infobox', array( $this, 'vc_infobox_html' ) );
    }
     
    // Element Mapping
    public function vc_infobox_mapping() {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }
         
        // Map the block with vc_map()
        vc_map( 
            array(
                'name' => __('Product Slider', 'text-domain'),
                'base' => 'theshopier_featured_products',
                'description' => __('Another simple VC box', 'text-domain'), 
                'category' => __('Fastway', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
                'params' => array(   
                         
                    array(
                        'type' => 'textfield',
                        
                        'heading' => __( 'Title', 'text-domain' ),
                        'param_name' => 'title',
                        'value' => __( 'Products', 'text-domain' ),
                        'admin_label' => true,
                        'weight' => 0,
                        'group' => 'Options',
                    ), 
                    array(
                      "type"        => "dropdown",
                      "heading"     => __("Select category"),
                      "param_name"  => "ja",
                      "admin_label" => true,
                      "value"       => array(
                          'Featured'   => 'Featured',
                          'Recent'   => 'Recent',
                          'Most selled' => 'Most selled ',
                      ), //value
                      'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Options',
                    ),      
                     
                        
                ),
            )
            
        );                                
        
    }
     
     
    // Element HTML
    public function vc_infobox_html( $atts ) {
         
        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'title'   => '',
                    'text' => '',
                ), 
                $atts
            )
        );
         
        // Fill $html var with data
        $html = '
        <div class="vc-infobox-wrap">
         
            <h2 class="vc-infobox-title">' . $title . '</h2>
             
            <div class="vc-infobox-text">' . $text . '</div>
         
        </div>';      
         
        return $html;
         
    }
     
} // End Element Class
 
 
// Element Class Init
new vcInfoBox();    

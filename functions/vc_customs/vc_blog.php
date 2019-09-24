<?php

add_action( 'vc_before_init', 'vc_blog_carousel' );
function vc_blog_carousel() {

  vc_map( 
            array(
                'name' => __('FW Blog Carousel', 'fastway'),
                'base' => 'fw_blog_carousel',
                'description' => __('FW Blog Carousel', 'fastway'), 
                'category' => __('Fastway Blog', 'fastway'),   
                'icon' => get_template_directory_uri().'/assets/img/favi.png',            
                'params' => getwoocampos(),
            )

            
        );          

}



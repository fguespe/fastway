<?php 


add_action( 'init', 'cptui_register_my_cpts' );
function cptui_register_my_cpts() {

/**
 * Post Type: Webinars.
 */

$labels = [
    "name" => __( "Events", "custom-post-type-ui" ),
    "singular_name" => __( "Event", "custom-post-type-ui" ),
];

$args = [
    "label" => __( "Events", "custom-post-type-ui" ),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "delete_with_user" => false,
    "exclude_from_search" => false,
    "capability_type" => "post",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => [ "slug" => "fw_event", "with_front" => true ],
    "query_var" => true,
    "supports" => [ "title", "editor", "thumbnail" ],
];

register_post_type( "fw_event", $args );

register_taxonomy( 'fw_event_cat',array( 'fw_event' ),array(
    'hierarchical'  => false,
    'labels'        => array(
        'name'              => __( 'Categories'             ,'fastway'),
        'singular_name'     => __( 'Category'               ,'fastway'),
        'search_items'      => __( 'Search Categories'      ,'fastway'),
        'all_items'         => __( 'All Categories'         ,'fastway'),
        'parent_item'       => __( 'Parent Category'        ,'fastway'),
        'parent_item_colon' => __( 'Parent Category:'       ,'fastway'),
        'edit_item'         => __( 'Edit Category'          ,'fastway'),
        'update_item'       => __( 'Update Category'        ,'fastway'),
        'add_new_item'      => __( 'Add New Category'       ,'fastway'),
        'new_item_name'     => __( 'New Category Name'      ,'fastway'),
        'popular_items'     => NULL,
        'menu_name'         => __( 'Categories'             ,'fastway'),
    ),
    'show_ui'       => true,
    'public'        => true,
    'query_var'     => true,
    'hierarchical'  => true,
    'rewrite'       => array( 'slug' => 'fw_event_cat' ),
));

}


add_shortcode( 'fw_event_carousel', 'fw_event_carousel' ); 
function fw_event_carousel( $atts, $content ) {
    $rand=generateRandomString(5);
    $atts = shortcode_atts(
    array(
          'loop'      =>  'false',
          'slider_speed'  => '250',
          'slider_delay'  => '4000',
          'autoplay'  => 'false',
          'maxcant' => '12',
          'el_class'  => '',
          'title'  => '',
          'type'    => '',
          'prodsperrow' => 3,
    ), $atts );

    if(!$atts['type'])$atts['type']='webinars';
    if(!$atts['loop'])$atts['loop']='false';
    if(!$atts['autoplay'])$atts['autoplay']='false';
    //Desktop
    error_log(print_r($atts,true));
  
    ob_start();

    $tax_query   = WC()->query->get_tax_query();
    $tax_query[] = array(
        'taxonomy' => 'fw_event_cat',
        'field'    => 'slug', // Or 'name' or 'term_id'
        'terms'    => array($atts['type']),
        'operator' => 'IN', // Excluded
    );
    
    $args = array(
        'post_type' => 'fw_event',
        'numberposts'   => -1,
        'orderby'       => 'menu_order',
        'order'         => 'ASC',
        'tax_query' =>  $tax_query
    );
    error_log(print_r($args,true));

    $posts = new WP_Query($args);
    fw_get_template('fw-event-carousel.php',$atts,$posts);
    
    return ob_get_clean();
  
}   

function fw_loop_event(){
	global $preset_code;
	$code=$preset_code?$preset_code:fw_theme_mod('woo_loop_event_code');
	echo do_shortcode(stripslashes(htmlspecialchars_decode( $code)));
  }



if( function_exists('acf_add_local_field_group') ):
    acf_add_local_field_group(array(
        'key' => 'group_602d0e7189796',
        'title' => 'Data',
        'fields' => array(
            array(
                'key' => 'field_602d0e7919f88',
                'label' => 'Date',
                'name' => 'start_date',
                'type' => 'date_time_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'd/m/Y g:i a',
                'return_format' => 'd/m/Y g:i a',
                'first_day' => 1,
            ),
            array(
                'key' => 'field_602d0ea819f89',
                'label' => 'City',
                'name' => 'city',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_602d0f2c6b8ff',
                'label' => 'Description',
                'name' => 'description',
                'type' => 'textarea',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'maxlength' => '',
                'rows' => '',
                'new_lines' => '',
            ),
            array(
                'key' => 'field_602d10d0134d3',
                'label' => 'Link',
                'name' => 'link',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'fw_event',
                ),
            )
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            0 => 'excerpt',
        ),
        'active' => true,
        'description' => '',
    ));
    
endif;


add_shortcode('fw_event_container', 'fw_event_container');
function fw_event_container($atts = [], $content = null){
    global $fw_loop_event;
    echo '<li class="fw_post_loop"><a href="'.esc_url( get_permalink($fw_loop_blog->ID)).'">';
    echo do_shortcode(stripslashes(htmlspecialchars_decode($content)));
    echo '</a></li>';
}

add_shortcode('fw_event_image', 'fw_event_image');
function fw_event_image(){
  global $fw_loop_event;
  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $fw_loop_event->ID ), 'medium' ); 
  $image_url = $image[0]; 
  echo '<div class="loopimg_container"><img src="'.$image_url.'" width="100%" height="auto"/></div>';
}
add_shortcode('fw_event_title', 'fw_event_title');
function fw_event_title(){
  global $fw_loop_event;
  echo '<h2 class="blog_title" >'.$fw_loop_event->post_title.'</h2>' ;
}

add_shortcode('fw_event_desc', 'fw_event_desc');
function fw_event_desc(){
  global $fw_loop_event;
  if(function_exists('get_field'))echo '<p class="desc" >'.get_field('description',$fw_loop_event->ID).'</p>';
}

add_shortcode('fw_event_date', 'fw_event_date');
function fw_event_date(){
  global $fw_loop_event;
  if(function_exists('get_field'))echo '<label class="date" >'.get_field('date',$fw_loop_event->ID).'</label>';
}


add_shortcode('fw_event_url', 'fw_event_url');
function fw_event_url(){
  global $fw_loop_event;
  if(function_exists('get_field'))echo '<a href="'.get_field('link',$fw_loop_event->ID).'" class="vermas" target="_blank" >Register</a>';
}


function my_page_columns($columns) {
    $columns = array(
     'cb' => '< input type="checkbox" />',
     'title' => 'Title',
     'city' => 'City',
     'start_date' => 'Start date',
     'category' => 'Category'
    );
    return $columns;
   }
   function my_custom_columns($column) {
    global $post;
    $cates=wp_get_post_terms( $post->ID, 'fw_event_cat' );
    if($column == 'city' || $column == 'start_date')echo get_field($column, $post->ID);
    else if($column=='category')  foreach( $cates as $cate ) echo $cate->name . ' ';
    else echo '';
    
   }
   add_action("manage_fw_event_posts_custom_column", "my_custom_columns");
   add_filter("manage_edit-fw_event_columns", "my_page_columns");
   
?>
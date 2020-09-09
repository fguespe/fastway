<?php 
add_action( 'init', 'fw_review_create' );
function fw_review_create() {

    register_post_type( 'fw_review',array(
      'description'           => __('Reviews','pressapps-accordion-review'),
      'labels'                => array(
        'name'                  => __('Review'                     ,'pressapps-accordion-review'),
        'all_items'             => __('All Reviews'                ,'pressapps-accordion-review'),
        'singular_name'         => __('Review'                     ,'pressapps-accordion-review'),
        'add_new'               => __('Add New'                    ,'pressapps-accordion-review'),
        'add_new_item'          => __('Add New Review'             ,'pressapps-accordion-review'),
        'edit_item'             => __('Edit Review'                ,'pressapps-accordion-review'),
        'new_item'              => __('New Review'                 ,'pressapps-accordion-review'),
        'view_item'             => __('View Review'                ,'pressapps-accordion-review'),
        'search_items'          => __('Search Review'              ,'pressapps-accordion-review'),
        'not_found'             => __('No Review found'            ,'pressapps-accordion-review'),
        'not_found_in_trash'    => __('No Review found in Trash'   ,'pressapps-accordion-review'),
      ),
      'public'                => true,
      'menu_position'         => 5,
      'rewrite'               => array( 'slug' => 'fw_review' ),
      'supports'              => array( 'title' ,'thumbnail'),
      'public'                => true,
      'show_ui'               => true,
      'publicly_queryable'    => true,
      'exclude_from_search'   => false,
      'menu_icon'				=> 'dashicons-editor-help',
    ));
    register_taxonomy( 'fw_review_category',array( 'fw_review' ),array(
			'hierarchical'  => false,
			'labels'        => array(
				'name'              => __( 'Categories'             ,'pressapps-accordion-review'),
				'singular_name'     => __( 'Category'               ,'pressapps-accordion-review'),
				'search_items'      => __( 'Search Categories'      ,'pressapps-accordion-review'),
				'all_items'         => __( 'All Categories'         ,'pressapps-accordion-review'),
				'parent_item'       => __( 'Parent Category'        ,'pressapps-accordion-review'),
				'parent_item_colon' => __( 'Parent Category:'       ,'pressapps-accordion-review'),
				'edit_item'         => __( 'Edit Category'          ,'pressapps-accordion-review'),
				'update_item'       => __( 'Update Category'        ,'pressapps-accordion-review'),
				'add_new_item'      => __( 'Add New Category'       ,'pressapps-accordion-review'),
				'new_item_name'     => __( 'New Category Name'      ,'pressapps-accordion-review'),
				'popular_items'     => NULL,
				'menu_name'         => __( 'Categories'             ,'pressapps-accordion-review'),
			),
			'show_ui'       => true,
			'public'        => true,
			'query_var'     => true,
			'hierarchical'  => true,
			'rewrite'       => array( 'slug' => 'fw_review_category' ),
    ));
}



function get_review_template( $template_name, $args = array(), $posts = null ){
  if ( $args && is_array( $args ) )extract( $args );
  $located = get_template_directory() . '/functions/shortcodes/'.$template_name;
  ob_start();
  if ( $posts->have_posts() )include( $located );
  wp_reset_postdata();
}


add_shortcode( 'fw_review_carousel_function', 'fw_review_carousel_function' ); 
function fw_review_carousel_function( $atts, $content ) {
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
          'prodsperrow' => 4,
      ), $atts );

  if(!$atts['loop'])$atts['loop']='false';
  if(!$atts['autoplay'])$atts['autoplay']='false';
  //Desktop
  
  ob_start();
  $qry_args= array(  
      'post_type'     =>'fw_review',
      'numberposts'   => -1,
      'orderby'       => 'menu_order',
      'order'         => 'ASC',
  );
  $posts = new WP_Query($qry_args);
  get_review_template('fw-review-carousel.php',$atts,$posts);
  
  return ob_get_clean();
  
}   

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5f591afcb07e5',
	'title' => 'Campos',
	'fields' => array(
		array(
			'key' => 'field_5f591b0579c2c',
			'label' => 'Position',
			'name' => 'position',
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
			'key' => 'field_5f591b2079c2d',
			'label' => 'Review',
			'name' => 'review',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 1,
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
			'key' => 'field_5f591b2a79c2e',
			'label' => 'Logo',
			'name' => 'logo',
			'type' => 'image',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
		array(
			'key' => 'field_5f591b3e79c30',
			'label' => 'URL',
			'name' => 'url',
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
				'value' => 'fw_review',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
));

endif;

?>

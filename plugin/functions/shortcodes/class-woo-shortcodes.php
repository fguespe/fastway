<?php 
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'fw_Woo_Shortcodes' ) ) :

class fw_Woo_Shortcodes {

	private static $classes = array('nth-shortcode', 'woocommerce');
	
	public static function get_template( $template_name, $args = array(), $products = null ){
		
		
		if ( $args && is_array( $args ) ) {
			extract( $args );
		}
		
		$located = get_template_directory() . '/plugin/functions/shortcodes/'.$template_name;
		
		if ( ! file_exists( $located ) ) {
			_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '1.0' );
			return;
		}
		
		include( $located );
	}
	
	public static function ajax_call(){
		add_action( 'wp_ajax_nth_woo_get_product_by_cat' , array( __CLASS__, 'woo_get_product_by_cat' ) );
		add_action( 'wp_ajax_nopriv_nth_woo_get_product_by_cat', array( __CLASS__, 'woo_get_product_by_cat' ) );
	}
	
	public static function shortcodeArgs(){
		
		self::ajax_call();

		return array(
			'fw_featured_products'				=> __CLASS__ . '::featured_products',
			'fw_sale_products'				=> __CLASS__ . '::sale_products',
			'fw_bestselling_products'				=> __CLASS__ . '::best_selling_products',
			'fw_toprated_products'				=> __CLASS__ . '::top_rated_products',
			'fw_recent_products'				=> __CLASS__ . '::recent_products',
			'fw_category_carousel'				=> __CLASS__ . '::products_category',
			'fw_categories_carousel'			=> __CLASS__ . '::product_cats',
		);
	}
	private static function pareShortcodeClass( $class = '' ){
		$classes = self::$classes;
		if( strlen($class) > 0 )
			$classes[] = $class;
		return $classes;
	}
	public static function featured_products( $atts ){
		
		global $woocommerce_loop;
		$atts = shortcode_atts( array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> '0',
			"auto_play"		=> '0',
			"excerpt_limit" => 10,
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"hide_free"		=> 0,
			"show_hidden"	=> 0
		), $atts );
		
        $meta_query  = WC()->query->get_meta_query();
        $tax_query   = WC()->query->get_tax_query();
        $tax_query[] = array(
            'taxonomy' => 'product_visibility',
            'field'    => 'name',
            'terms'    => 'featured',
            'operator' => 'IN',
        );
		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'orderby'             => $atts['orderby'],
			'order'               => $atts['order'],
            'meta_query'          => $meta_query,
            'tax_query'           => $tax_query,
		);

		
		
		ob_start();
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		if ( $products->have_posts() ) :
			self::get_template( 'woo-products-carousel.php', $atts, $products );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}
	public static function recent_products( $atts ){
		global $woocommerce_loop;
		
		$atts = shortcode_atts(array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> 0,
			"auto_play"		=> '0',
			"excerpt_limit" => 10,
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"hide_free"		=> 0,
			"show_hidden"	=> 0
		),$atts);
		
		$args = array(
			'post_type'				=> 'product',
			'post_status'			=> 'publish',
			'no_found_rows'			=> 1,
			'posts_per_page' 		=> $atts['per_page'],
			'orderby' 				=> $atts['orderby'],
			'order' 				=> $atts['order'],
			'meta_query' 			=> array()
		);
		
		if ( !absint($atts['show_hidden']) ) {
            $product_visibility_term_ids = wc_get_product_visibility_term_ids();
            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                'operator' => 'NOT IN',
            );
            $query_args['post_parent']  = 0;
		}
		
		if ( absint( $atts['hide_free'] ) ) {
			$args['meta_query'][] = array(
				'key'     => '_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'DECIMAL',
			);
		}
		
		ob_start();
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		
		if ( $products->have_posts() ) :
			self::get_template( 'woo-products-carousel.php', $atts, $products );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}

	public static function sale_products( $atts ) {
		global $woocommerce_loop, $woocommerce;
		
		$atts = shortcode_atts(array(
			'title' 		=> '',
			'item_style'	=> 'grid',
			'is_slider'		=> '1',
			"is_biggest"	=> 0,
			'cats'			=> '',
			'auto_play'		=> '0',
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			'orderby'		=> 'title',
			'is_deal'		=> 0,
			'supper_style'	=> 0,
			'order'			=> 'asc',
			'as_widget'		=> 0,
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			'excerpt_limit' => 10,
			'hide_free'		=> 0,
			'show_hidden'	=> 0
		),$atts);
		
		$args = array(
			'posts_per_page'	=> $atts['per_page'],
			'orderby' 			=> $atts['orderby'],
			'order' 			=> $atts['order'],
			'no_found_rows' 	=> 1,
			'post_status' 		=> 'publish',
			'post_type' 		=> 'product',
            'meta_query'        => WC()->query->get_meta_query(),
            'tax_query'         => WC()->query->get_tax_query(),
			'post__in'			=> array_merge( array( 0 ), wc_get_product_ids_on_sale() ),

		);

		if( strlen(trim($atts['cats'])) > 0 ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['cats'] ) ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				)
			);
		}
		
		if( absint($atts['as_widget']) ) {
			if ( !absint($atts['show_hidden']) ) {
                $product_visibility_term_ids = wc_get_product_visibility_term_ids();
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                    'operator' => 'NOT IN',
                );
                $query_args['post_parent']  = 0;
			}
			
			if ( absint( $atts['hide_free'] ) ) {
				$args['meta_query'][] = array(
					'key'     => '_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'DECIMAL',
				);
			}
		} else {
			//$args['meta_query'] = WC()->query->get_meta_query();
			if( absint($atts['is_deal']) ) {
				$fil_date = strtotime ("now");
				$args['meta_query'] = array(
					array(
						'key' => '_sale_price_dates_from',
						'value' => $fil_date,
						'compare' => '<=',
						'type' => 'numeric'
					),
					array(
						'key' => '_sale_price_dates_to',
						'value' => $fil_date,
						'compare' => '>=',
						'type' => 'numeric'
					)
				);
			} else {
				$args['meta_query'] = WC()->query->get_meta_query();
			}

		}
		
		ob_start();
		
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		
		if ( $products->have_posts() ) :
			self::get_template( 'woo-products-carousel.php', $atts, $products );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}
	
	public static function products_category( $atts ){
		global $woocommerce_loop;
		$atts = shortcode_atts( array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> 0,
			"auto_play"		=> '0',
			"excerpt_limit" => 10,
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"category" 		=> '',
			"hide_free"		=> 0,
			"show_hidden"	=> 0
		), $atts );
		
		$ordering_args = WC()->query->get_catalog_ordering_args( $atts['orderby'], $atts['order'] );
		$meta_query    = WC()->query->get_meta_query();
	
		$args = array(
			'post_type'				=> 'product',
			'post_status' 			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'orderby' 				=> $ordering_args['orderby'],
			'order' 				=> $ordering_args['order'],
			'posts_per_page' 		=> $atts['per_page'],
			'meta_query' 			=> $meta_query,
			'tax_query' 			=> array(
				array(
					'taxonomy' 		=> 'product_cat',
					'terms' 		=> array_map( 'sanitize_title', explode( ',', $atts['category'] ) ),
					'field' 		=> 'slug',
					'operator' 		=> 'IN'
				)
			)
		);
		
		if ( isset( $ordering_args['meta_key'] ) ) {
			$args['meta_key'] = $ordering_args['meta_key'];
		}
		ob_start();
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		
		if ( $products->have_posts() ) :
			self::get_template( 'woo-products-carousel.php', $atts, $products );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}

	public static function woo_categories( $atts ){
		global $woocommerce_loop;
		$taxonomy     = 'product_cat';
		  $orderby      = 'name';  
		  $show_count   = 0;      // 1 for yes, 0 for no
		  $pad_counts   = 0;      // 1 for yes, 0 for no
		  $hierarchical = 1;      // 1 for yes, 0 for no  
		  $title        = '';  
		  $empty        = 0;

		  $args = array(
		         'taxonomy'     => $taxonomy,
		         'orderby'      => $orderby,
		         'show_count'   => $show_count,
		         'pad_counts'   => $pad_counts,
		         'hierarchical' => $hierarchical,
		         'title_li'     => $title,
		         'hide_empty'   => $empty
		  );
		 $all_categories = get_categories( $args );
		 foreach ($all_categories as $cat) {
		    if($cat->category_parent == 0) {
		        $category_id = $cat->term_id;       
		        echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';

		        $args2 = array(
		                'taxonomy'     => $taxonomy,
		                'child_of'     => 0,
		                'parent'       => $category_id,
		                'orderby'      => $orderby,
		                'show_count'   => $show_count,
		                'pad_counts'   => $pad_counts,
		                'hierarchical' => $hierarchical,
		                'title_li'     => $title,
		                'hide_empty'   => $empty
		        );
		        $sub_cats = get_categories( $args2 );
		        if($sub_cats) {
		            foreach($sub_cats as $sub_category) {
		                echo  $sub_category->name ;
		            }   
		        }
		    }       
		}
		
	}
	
	
	public static function product_cats( $atts ){
		$atts = shortcode_atts( array(
			'title'			=> '',
			'cats' 			=> '',
			'terms' 			=> '',
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
		), $atts );
		
		if( strlen( trim( $atts['cats'] ) ) == 0 ) return;
		
		$cats = explode( ',', $atts['cats'] );
		
		$args = array(
			'slug' => $cats,
			'orderby'	=> 'name',
			'order'		=> 'ASC',
			'hide_empty'	=> false,
		);
		
		ob_start();
		
		$atts['terms'] = get_terms('product_cat', $args);

		if(!empty($atts['terms']))self::get_template( 'woo-cats-carousel.php', $atts,$atts['terms']  );
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}

	public static function best_selling_products( $atts ){
		global $woocommerce_loop;
		$atts = shortcode_atts(array(
			"title" 		=> '',
			"item_style"	=> 'grid',
			"as_widget"		=> '0',
			"box_style"		=> '',
			"head_style"	=> '',
			"border_color"	=> '',
			"is_slider"		=> '1',
			"is_biggest"	=> 0,
			"auto_play"		=> '0',
			"excerpt_limit" => 10,
			"per_page"		=> isset($atts["maxcant"])&& !empty($atts["maxcant"])?$atts["maxcant"]:12,
			"columns"		=> isset($atts["prodsperrow"])&& !empty($atts["prodsperrow"])?$atts["prodsperrow"]:4,
		),$atts);
		
		$meta_query = WC()->query->get_meta_query();
		
		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $atts['per_page'],
			'meta_key'            => 'total_sales',
			'orderby'             => 'meta_value_num',
			'meta_query'          => $meta_query
		);
		
		ob_start();
		
		$products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $args, $atts ) );

		
		if ( $products->have_posts() ) :
			self::get_template( 'woo-products-carousel.php', $atts, $products );
		endif;
		
		wp_reset_postdata();
		
		
		return ob_get_clean();
	}


}

endif;
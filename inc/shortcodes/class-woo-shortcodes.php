<?php 
// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists( 'Nexthemes_Woo_Shortcodes' ) ) :

class Nexthemes_Woo_Shortcodes {

	private static $classes = array('nth-shortcode', 'woocommerce');
	
	public static function get_template( $template_name, $args = array(), $products = null ){
		
		
		if ( $args && is_array( $args ) ) {
			extract( $args );
		}
		
		$located = get_template_directory() . '/inc/shortcodes/'.$template_name;
		
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
			'theshopier_featured_products'				=> __CLASS__ . '::featured_products',
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
			"per_page"		=> '12',
			"columns"		=> '4',
			"orderby"		=> 'date',
			"order"			=> 'desc',
			"hide_free"		=> 0,
			"show_hidden"	=> 0
		), $atts );

		$classes = self::pareShortcodeClass( 'columns-' . absint( $atts['columns'] ) );
		$cache = self::get_cached_shortcode($atts, 'theshopier_'. __FUNCTION__ );

		if( !is_array($cache) && strlen(trim($cache)) > 0 ) {
			return '<div class="cached_shortcode '.esc_attr( implode( ' ', $classes ) ).'">' . $cache . '</div>';
		}

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

		$old_columns = $woocommerce_loop['columns'];
		
		if ( $products->have_posts() ) :

			if( absint($atts['as_widget']) )
				self::get_template( 'shortcode-woo-widget.tpl.php', $atts, $products );
			else {

				if( absint($atts['is_biggest']) ) self::get_template( 'shortcode-woo-big.tpl.php', $atts, $products );
				else self::get_template( 'shortcode-woo-nomal.tpl.php', $atts, $products );
			}
			
		endif;
		
		wp_reset_postdata();
		
		$woocommerce_loop['columns'] = $old_columns;

		$output = ob_get_clean();

		$output = self::cache_shortcode($atts, 'theshopier_'. __FUNCTION__, $output, $cache);
		
		return '<div class="'.esc_attr( implode( ' ', $classes ) ).'">' . $output . '</div>';
	}


	public static function get_cached_shortcode( $atts, $key ){
		
		$cache_id = md5(serialize($atts));
		$cache = wp_cache_get( $key, 'shortcode');
		if ( ! is_array( $cache ) ) $cache = array();
		if ( isset( $cache[$cache_id] ) )
			return $cache[ $cache_id ];
		else return $cache;
	}

	public static function cache_shortcode( $atts, $key, $content, $cache ) {

		$cache_id = md5(serialize($atts));
		$cache[$cache_id] = $content;
		wp_cache_set( $key, $cache, 'shortcode' );
		return $content;
	}
}

endif;
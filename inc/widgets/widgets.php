<?php
/**
 * Declaring widgets
 *
 * @package understrap
 */

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
if ( ! function_exists( 'understrap_slbd_count_widgets' ) ) {
	function understrap_slbd_count_widgets( $sidebar_id ) {
		// If loading from front page, consult $_wp_sidebars_widgets rather than options
		// to see if wp_convert_widget_settings() has made manipulations in memory.
		global $_wp_sidebars_widgets;
		if ( empty( $_wp_sidebars_widgets ) ) :
			$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
		endif;

		$sidebars_widgets_count = $_wp_sidebars_widgets;

		if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
			$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
			if ( $widget_count % 4 == 0 || $widget_count > 6 ) :
				// Four widgets per row if there are exactly four or more than six
				$widget_classes .= ' col-md-3';
			elseif ( 6 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-2';
			elseif ( $widget_count >= 3 ) :
				// Three widgets per row if there's three or more widgets 
				$widget_classes .= ' col-md-4';
			elseif ( 2 == $widget_count ) :
				// If two widgets are published
				$widget_classes .= ' col-md-6';
			elseif ( 1 == $widget_count ) :
				// If just on widget is active
				$widget_classes .= ' col-md-12';
			endif; 
			return $widget_classes;
		endif;
	}
}

if ( ! function_exists( 'understrap_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function understrap_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Main Right Sidebar', 'understrap' ),
			'id'            => 'right-sidebar',
			'description'   => 'Right sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Main Left Sidebar', 'understrap' ),
			'id'            => 'left-sidebar',
			'description'   => 'Left sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Top Header', 'understrap' ),
			'id'            => 'header-top-widget-area',
			'description'   => 'Left sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Shop Right Sidebar', 'understrap' ),
			'id'            => 's-right-sidebar',
			'description'   => 'Right sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Shop Left Sidebar', 'understrap' ),
			'id'            => 's-left-sidebar',
			'description'   => 'Left sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		register_sidebar( array(
			'name'          => __( 'Single Product Right Sidebar', 'understrap' ),
			'id'            => 'sp-right-sidebar',
			'description'   => 'Right sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Single Product Left Sidebar', 'understrap' ),
			'id'            => 'sp-left-sidebar',
			'description'   => 'Left sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		

		

	}
} // endif function_exists( 'understrap_widgets_init' ).
add_action( 'widgets_init', 'understrap_widgets_init' );





add_action( 'widgets_init', 'theshopier_register_widgets' );
function theshopier_register_widgets() {
    register_widget('Theshopier_StaticBlock_Widget');
	
}

add_action('in_widget_form', 'theshopier_customfield_widget_form',5,3);

if( ! function_exists('theshopier_customfield_widget_form') ) {

	function theshopier_customfield_widget_form($widget,$return,$instance){
		$instance = wp_parse_args( (array) $instance, array( 'hidden_mb' => 0) );
		if ( !isset($instance['hidden_mb']) ) $instance['hidden_mb'] = 0;
		if ( !isset($instance['hidden_sm']) ) $instance['hidden_sm'] = 0;
		if ( !isset($instance['css_classes']) ) $instance['css_classes'] = '';
		?>
		<p>
			<input id="<?php echo esc_attr( $widget->get_field_id( 'hidden_mb' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'hidden_mb' ) ); ?>" type="checkbox" value="1" <?php checked( $instance['hidden_mb'], 1 ); ?> />
			<label for="<?php echo esc_attr($widget->get_field_id( 'hidden_mb' )); ?>"><?php esc_html_e("Hidden on mobile", 'theshopier'); ?></label>
		</p>
		<p>
			<input id="<?php echo esc_attr( $widget->get_field_id( 'hidden_sm' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'hidden_sm' ) ); ?>" type="checkbox" value="1" <?php checked( $instance['hidden_sm'], 1 ); ?> />
			<label for="<?php echo esc_attr($widget->get_field_id( 'hidden_sm' )); ?>"><?php esc_html_e("Hidden on Tablet", 'theshopier'); ?></label>
		</p>
		<p>
			<label for="<?php echo esc_attr($widget->get_field_id( 'css_classes' )); ?>"><?php esc_html_e("Css Classes", 'theshopier'); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $widget->get_field_id( 'css_classes' ) ); ?>" name="<?php echo esc_attr( $widget->get_field_name( 'css_classes' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['css_classes'] ); ?>"/>
		</p>
		<?php
		return array($widget,$return,$instance);
	}

}


add_filter('widget_update_callback', 'theshopier_customfield_widget_form_update',5,3);

if( ! function_exists('theshopier_customfield_widget_form_update') ) {

	function theshopier_customfield_widget_form_update( $instance, $new_instance, $old_instance ){
		$instance['hidden_mb'] = $new_instance['hidden_mb'];
		$instance['hidden_sm'] = $new_instance['hidden_sm'];
		$instance['css_classes'] = $new_instance['css_classes'];
		return $instance;
	}

}

add_filter('dynamic_sidebar_params', 'theshopier_customfield_dynamic_sidebar_params');

if( ! function_exists('theshopier_customfield_dynamic_sidebar_params') ) {

	function theshopier_customfield_dynamic_sidebar_params( $params ){
		global $wp_registered_widgets, $theshopier_datas;

		$widget_id = $params[0]['widget_id'];
		$widget_obj = $wp_registered_widgets[$widget_id];
		$widget_opt = get_option($widget_obj['callback'][0]->option_name);
		$widget_num = $widget_obj['params'][0]['number'];

		$rex_class = array();
		if (isset($widget_opt[$widget_num]['hidden_mb'])){
			$rex_class[] = absint($widget_opt[$widget_num]['hidden_mb'])? "hidden-xs": '';
		}
		if (isset($widget_opt[$widget_num]['hidden_sm'])){
			$rex_class[] = absint($widget_opt[$widget_num]['hidden_sm'])? "hidden-sm": '';
		}

		if (isset($widget_opt[$widget_num]['css_classes'])){
			$rex_class[] = isset($widget_opt[$widget_num]['css_classes'])? esc_attr($widget_opt[$widget_num]['css_classes']): '';
		}

		if(!empty($theshopier_datas['sidebar-widget-style']) && strcmp('default', trim($theshopier_datas['sidebar-widget-style'])) !== 0 ) {
			$rex_class[] = esc_attr($theshopier_datas['sidebar-widget-style']);
		}

		$params[0]['before_widget'] = preg_replace('/class="/', 'class="'. implode(' ', $rex_class) . ' ',  $params[0]['before_widget'], 1);

		return $params;
	}

}



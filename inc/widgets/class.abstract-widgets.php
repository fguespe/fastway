<?php 
/**
 * Abstract Widget Class
 *
 * @author   Nexthemes
 * @version  1.0.0
 * @extends  WP_Widget
 */
 
abstract class Theshopier_Widget extends WP_Widget {
	
	public $widget_cssclass;
	public $widget_description;
	public $widget_id;
	public $widget_name;
	public $settings;
	
	public function __construct() {
		$widget_ops = array(
			'classname'   => $this->widget_cssclass,
			'description' => $this->widget_description
		);
		
		parent::__construct( $this->widget_id, "" . $this->widget_name, $widget_ops );
		add_action( 'save_post', array( $this, 'f_widget_cache' ) );
		add_action( 'deleted_post', array( $this, 'f_widget_cache' ) );
		add_action( 'switch_theme', array( $this, 'f_widget_cache' ) );
	}
	
	/**
	 * get_cached_widget function.
	 */
	public function get_cached_widget( $args ) {

		$cache = wp_cache_get( apply_filters( 'woocommerce_cached_widget_id', $this->widget_id ), 'widget' );

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return true;
		}

		return false;
	}

	/**
	 * Cache the widget
	 *
	 * @param  array $args
	 * @param  string $content
	 * @return string the content that was cached
	 */
	public function cache_widget( $args, $content ) {
		wp_cache_set( apply_filters( 'woocommerce_cached_widget_id', $this->widget_id ), array( $args['widget_id'] => $content ), 'widget' );

		return $content;
	}

	/**
	 * Flush the cache
	 *
	 * @return void
	 */
	public function f_widget_cache() {
		wp_cache_delete( apply_filters( 'woocommerce_cached_widget_id', $this->widget_id ), 'widget' );
	}

	/**
	 * Output the html at the start of a widget
	 *
	 * @param  array $args
	 * @return string
	 */
	public function widget_start( $args, $instance ) {
		echo $args['before_widget'];

		if ( $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
	}

	/**
	 * Output the html at the end of a widget
	 *
	 * @param  array $args
	 * @return string
	 */
	public function widget_end( $args ) {
		echo $args['after_widget'];
	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		if ( ! $this->settings ) {
			return $instance;
		}

		foreach ( $this->settings as $key => $setting ) {

			if ( isset( $new_instance[ $key ] ) ) {
				if('textarea' === $setting['type']) {
					$instance[ $key ] = wp_kses( $new_instance[ $key ], wp_kses_allowed_html('post') );
				} else {
					$instance[ $key ] = sanitize_text_field( $new_instance[ $key ] );
				}
			} elseif ( 'checkbox' === $setting['type'] ) {
				$instance[ $key ] = 0;
			}
		}

		$this->f_widget_cache();

		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @param array $instance
	 */
	public function form( $instance ) {

		if ( ! $this->settings ) {
			return;
		}

		foreach ( $this->settings as $key => $setting ) {

			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];
			
			switch ( $setting['type'] ) {

				case 'text' :
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']);?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
				break;

				case 'number' :
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
				break;

				case 'select' :
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
						<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<?php
				break;

				case 'checkbox' :
					?>
					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
					</p>
					<?php
					break;

				case 'textarea':
					?>
					<p>
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']);?></label>
						<textarea rows="8" class="widefat" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr($this->get_field_name( $key )); ?>"><?php echo wp_kses( $value, wp_kses_allowed_html('post') ); ?></textarea>
					</p>
					<?php
					break;

				case 'attach_image' :
					if( strlen( $value ) > 0 ){
						$image = wp_get_attachment_image_src( esc_attr( $value ), 'thumbnail' );
						$image = $image[0];
						$dis_none_remove = "display: inline-block;";
					} else {
						$dis_none_remove = "display: none;";
						$image = THEME_BACKEND_URI . "images/placeholder.png";
					}
					?>
					<div style="margin: 10px 0;">
						<label for="<?php echo esc_attr($this->get_field_id( $key )); ?>"><?php echo esc_html($setting['label']); ?></label>
						<div style="margin-top: 5px;" class="nth_upload_image" data-f_title="<?php esc_attr_e( 'Choose an image', 'theshopier' ); ?>" data-f_btext="<?php esc_attr_e( 'Use image', 'theshopier' ); ?>">
							
							<div class="nth_thumbnail" style="float:left;margin-right:10px;">
								<?php theshopier_getImage(array(
									'src'	=> esc_url($image),
									'alt'	=> esc_attr__('Media thumbnail', 'theshopier'),
									'width' => '28',
									'height' => '28'
								));?>
							</div>
							<div style="line-height:28px;">
								<input type="hidden" class="nth_image_id" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" value="<?php echo esc_attr( $value ); ?>" />
								<button type="submit" class="nth_upload_image_button button"><?php esc_html_e( 'Add image', 'theshopier' ); ?></button>
								<button style="<?php echo esc_attr($dis_none_remove);?>" class="nth_remove_image_button button"><?php esc_html_e( 'Remove', 'theshopier' ); ?></button>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<?php 
				break;
			}
		}
	}
	
	public function getOrderby(){
		return array(
			'date'   => esc_html__( 'Date', 'theshopier' ),
			'price'  => esc_html__( 'Price', 'theshopier' ),
			'rand'   => esc_html__( 'Random', 'theshopier' ),
			'sales'  => esc_html__( 'Sales', 'theshopier' ),
		);
	}
	
	public function getOrder(){
		return array(
			'asc'  => esc_html__( 'ASC', 'theshopier' ),
			'desc' => esc_html__( 'DESC', 'theshopier' ),
		);
	}
	
	public function get_productCat(){
		$args = array(
			'type' => 'post',
			'child_of' => 0,
			'parent' => '',
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => false,
			'hierarchical' => 1,
			'exclude' => '',
			'include' => '',
			'number' => '',
			'taxonomy' => 'product_cat',
			'pad_counts' => false,
		);
		
		$categories = get_categories( $args );

		$datas = array();
		
		foreach( $categories as $term ){
			$datas[$term->slug] = $term->name;
		}
			
		return $datas;
	}
	
}
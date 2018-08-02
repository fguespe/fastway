<?php
/*
Plugin Name: WooCommerce Product Enquiry Form
Plugin URI: http://woothemes.com/woocommerce
Description: Adds an enquiry form tab to certain product pages which allows customers to contact you about a product. Also includes optional reCAPTCHA for preventing spam.
Version: 1.2.1
Author: WooThemes
Author URI: http://woothemes.com
Requires at least: 3.1
Text Domain: wc_enquiry_form
Domain Path: /languages
Tested up to: 4.3

	Copyright: © 2009-2011 WooThemes.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

/**
 * Required functions
 */
if ( ! function_exists( 'woothemes_queue_update' ) )
	require_once( 'woo-includes/woo-functions.php' );

/**
 * Plugin updates
 */
woothemes_queue_update( plugin_basename( __FILE__ ), '5a0f5d72519a8ffcc86669f042296937', '18601' );

if ( is_woocommerce_active() ) {

	add_action( 'plugins_loaded', 'fw_init_woocommerce_product_enquirey_form' );

	function fw_init_woocommerce_product_enquirey_form() {
		
        if(get_option("nubicommerce_modulo_enquiry_loggin") && !is_user_logged_in())return;
		$locale = apply_filters( 'plugin_locale', get_locale(), 'wc_enquiry_form' );
		$dir    = trailingslashit( WP_LANG_DIR );
		load_textdomain( 'wc_enquiry_form', $dir . 'woocommerce-product-enquiry-form/woocommerce-product-enquiry-form-' . $locale . '.mo' );
		load_plugin_textdomain( 'wc_enquiry_form', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

		/**
		 * woocommerce_product_enquiry_form class
		 */
		if ( ! class_exists( 'WC_Product_Enquiry_Form' ) ) {

			class WC_Product_Enquiry_Form {
				var $send_to;
				var $settings;

				/**
				 * __construct function.
				 *
				 * @access public
				 * @return void
				 */
				public function __construct() {

					$this->send_to = get_option( 'woocommerce_product_enquiry_send_to' );

					// Init settings
					$this->settings = array(
						array( 'name' => __( 'Product Enquiries', 'wc_enquiry_form' ), 'type' => 'title', 'desc' => '', 'id' => 'product_enquiry' ),
						array(
							'name' => __('Product enquiry email', 'wc_enquiry_form'),
							'desc' 		=> __('Where to send product enquiries.', 'wc_enquiry_form'),
							'id' 		=> 'woocommerce_product_enquiry_send_to',
							'type' 		=> 'text',
							'std'		=> get_option('admin_email')
						),
						array(
							'name' => __('ReCaptcha public key', 'wc_enquiry_form'),
							'desc' 		=> __('Enter your key if you wish to use <a href="https://www.google.com/recaptcha/">recaptcha</a> on the product enquiry form.', 'wc_enquiry_form'),
							'id' 		=> 'woocommerce_recaptcha_public_key',
							'type' 		=> 'text',
							'std'		=> ''
						),
						array(
							'name' => __('ReCaptcha private key', 'wc_enquiry_form'),
							'desc' 		=> __('Enter your key if you wish to use <a href="https://www.google.com/recaptcha/">recaptcha</a> on the product enquiry form.', 'wc_enquiry_form'),
							'id' 		=> 'woocommerce_recaptcha_private_key',
							'type' 		=> 'text',
							'std'		=> ''
						),
						array( 'type' => 'sectionend', 'id' => 'product_enquiry'),
					);

					// Default options
					add_option( 'woocommerce_product_enquiry_send_to', get_option( 'admin_email' ) );

					// Settings
					add_action( 'woocommerce_settings_general_options_after', array( $this, 'admin_settings' ) );
					add_action( 'woocommerce_update_options_general', array( $this, 'save_admin_settings' ) );

				   	// Frontend
				   	if ( version_compare( WOOCOMMERCE_VERSION, '2.0', '<' ) ) {
						add_action( 'woocommerce_product_tabs', array( $this, 'product_enquiry_tab' ), 25 );
						add_action( 'woocommerce_product_tab_panels', array( $this, 'product_enquiry_tab_panel' ), 25 );
					} else {
						add_filter( 'woocommerce_product_tabs', array( $this, 'add_product_enquiry_tab' ), 25 );
					}

					// AJAX
					add_action( 'wp_ajax_woocommerce_product_enquiry_post', array( $this, 'process_form' ) );
					add_action( 'wp_ajax_nopriv_woocommerce_product_enquiry_post', array( $this, 'process_form' ) );

					// Write panel
					add_action( 'woocommerce_product_options_general_product_data', array( $this, 'write_panel' ) );
					add_action( 'woocommerce_process_product_meta', array( $this, 'write_panel_save' ) );

					// Enqueue Google reCAPTCHA scripts
					add_action( 'wp_enqueue_scripts', array( $this, 'recaptcha_scripts' ) );
			    }

			    /**
			     * function recaptcha_scripts
			     * Queues recaptcha JS script if enabled
			     *
			     */
				function recaptcha_scripts() {
					$publickey  = get_option( 'woocommerce_recaptcha_public_key' );
					$privatekey = get_option( 'woocommerce_recaptcha_private_key' );
					if ( $publickey && $privatekey ) {
						wp_enqueue_script( 'recaptcha', 'https://www.google.com/recaptcha/api.js' );
					}
				}

			    /**
			     * add_product_enquiry_tab function.
			     *
			     * @access public
			     * @param array $tabs (default: array())
			     * @return void
			     */
			    function add_product_enquiry_tab( $tabs = array() ) {
			    	global $post, $woocommerce;

					if ( $post && get_post_meta( $post->ID, 'woocommerce_disable_product_enquiry', true ) == 'yes' )
						return $tabs;

				    $tabs['product_enquirey'] = array(
						'title'    => apply_filters( 'product_enquiry_tab_title', __( 'Consulta', 'wc_enquiry_form' ) ),
						'priority' => 40,
						'callback' => array( $this, 'add_product_enquiry_tab_content' )
					);

					return $tabs;
			    }

			    /**
			     * add_product_enquiry_tab_content function.
			     *
			     * @access public
			     * @return void
			     */
			    function add_product_enquiry_tab_content() {
			    	global $post, $woocommerce;

			    	if ( is_user_logged_in() )
						$current_user = get_user_by( 'id', get_current_user_id() );
			    	?>
						<h2>Consulta</h2>
						<style type="text/css">
							.woocommerce form .form-row-first, .woocommerce form .form-row-last, .woocommerce-page form .form-row-first, .woocommerce-page form .form-row-last{
							width:32% !important;
							margin-right:1%;
							}
						</style>
						<form action="" method="post" id="product_enquiry_form">

							<?php do_action( 'product_enquiry_before_form' ); ?>

							<p class="form-row form-row-first">
								<label for="product_enquiry_name">Nombre</label>
								<input type="text" class="input-text" name="product_enquiry_name" id="product_enquiry_name" placeholder="" value="" />
							</p>

							<p class="form-row form-row-last">
								<label for="product_enquiry_email">Email</label>
								<input type="text" class="input-text" name="product_enquiry_email" id="product_enquiry_email" placeholder="" value=""/>
							</p>

							<p class="form-row form-row-last">
								<label for="product_enquiry_phone">Teléfono</label>
								<input type="text" class="input-text" name="product_enquiry_phone" id="product_enquiry_phone" placeholder="" value="" />
							</p>

							<div class="clear"></div>

							<?php do_action('product_enquiry_before_message'); ?>

							<p class="form-row notes">
								<label for="product_enquiry_message"><?php _e( 'Enquiry', 'wc_enquiry_form' ); ?></label>
								<textarea class="input-text" name="product_enquiry_message" id="product_enquiry_message" rows="5" cols="20" placeholder="<?php _e( 'Hacé tu consulta', 'wc_enquiry_form' ); ?>"></textarea>
							</p>

							<?php do_action( 'product_enquiry_after_message' ); ?>

							<div class="clear"></div>

							<?php
								$publickey  = get_option( 'woocommerce_recaptcha_public_key' );
								$privatekey = get_option( 'woocommerce_recaptcha_private_key' );
	  							if ( $publickey && $privatekey ) :
	  								?>
	  								<div class="form-row notes">
										<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $publickey ); ?>"></div>
   									</div>
									<div class="clear"></div>
									<?php

	  							endif;
							?>

							<p>
								<input type="hidden" name="product_id" value="<?php echo $post->ID; ?>" />
								<input type="submit" id="send_product_enquiry" value="<?php _e( 'Enviar', 'wc_enquiry_form' ); ?>" class="button" />
							</p>

							<?php do_action( 'product_enquiry_after_form' ); ?>

						</form>
						<script type="text/javascript">
							jQuery(function(){
								jQuery('#send_product_enquiry').click(function(){

									// Remove errors
									jQuery('.product_enquiry_result').remove();

									// Required fields
									if (!jQuery('#product_enquiry_name').val()) {
										jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_error woocommerce-error"><?php _e('Please enter your name.', 'wc_enquiry_form'); ?></p>');
										jQuery('.product_enquiry_result').fadeIn();
										return false;
									}

									if (!jQuery('#product_enquiry_email').val()) {
										jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_error woocommerce-error"><?php _e('Please enter your email.', 'wc_enquiry_form'); ?></p>');
										jQuery('.product_enquiry_result').fadeIn();
										return false;
									}

									if (!jQuery('#product_enquiry_message').val()) {
										jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_error woocommerce-error"><?php _e('Please enter your enquiry.', 'wc_enquiry_form'); ?></p>');
										jQuery('.product_enquiry_result').fadeIn();
										return false;
									}

									// Block elements
									jQuery('#product_enquiry_form').block({message: null, overlayCSS: {background: '#fff url(<?php echo $woocommerce->plugin_url(); ?>/assets/images/ajax-loader.gif) no-repeat center', opacity: 0.6}});

									// AJAX post
									var data = {
										action: 			'woocommerce_product_enquiry_post',
										security: 			'<?php echo wp_create_nonce("product-enquiry-post"); ?>',
										post_data:			jQuery('#product_enquiry_form').serialize()
									};

									jQuery.post( '<?php echo str_replace( array('https:', 'http:'), '', admin_url( 'admin-ajax.php' ) ); ?>', data, function(response) {
										if (response=='SUCCESS') {
											
											jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_message woocommerce-message"><?php echo apply_filters('product_enquiry_success_message', __('Enquiry sent successfully. We will get back to you shortly.', 'wc_enquiry_form')); ?></p>');

											jQuery('#product_enquiry_form textarea').val('');
											<?php if(get_option("nubicommerce_modulo_enquiry_redirect")){?>
											window.location.replace("/successform");
											
											<?php }?>

										} else {
											jQuery('#product_enquiry_form').before('<p style="display:none;" class="product_enquiry_result woocommerce_error woocommerce-error">' + response + '</p>');

										}

										// Reset ReCaptcha if in use
										if ( typeof grecaptcha !== 'undefined' ) {
											grecaptcha.reset();
										}

										jQuery('#product_enquiry_form').unblock();

										jQuery('.product_enquiry_result').fadeIn();

									});

									return false;

								});
							});
						</script>
					<?php
			    }

				/**
				 * product_enquiry_tab function.
				 *
				 * @access public
				 * @return void
				 */
				public function product_enquiry_tab() {
					global $post, $woocommerce;

					if ( get_post_meta( $post->ID, 'woocommerce_disable_product_enquiry', true ) == 'yes' )
						return;

					?><li><a href="#tab-enquiry"><?php echo apply_filters( 'product_enquiry_tab_title', __( 'Product Enquiry', 'wc_enquiry_form' ) ); ?></a></li><?php
				}

				/**
				 * product_enquiry_tab_panel function.
				 *
				 * @access public
				 * @return void
				 */
				public function product_enquiry_tab_panel() {
					global $post, $woocommerce;

					if ( get_post_meta( $post->ID, 'woocommerce_disable_product_enquiry', true ) == 'yes' )
						return;
					?>
					<div class="panel" id="tab-enquiry">
						<?php $this->add_product_enquiry_tab_content(); ?>
					</div>
					<?php
				}

				/**
				 * process_form function.
				 *
				 * @access public
				 * @return void
				 */
				public function process_form() {
					global $woocommerce;

					check_ajax_referer( 'product-enquiry-post', 'security' );

					do_action( 'product_enquiry_process_form' );

					$post_data = array();
					parse_str( $_POST['post_data'], $post_data );

					$name 		= isset( $post_data['product_enquiry_name'] ) ? woocommerce_clean( $post_data['product_enquiry_name'] ) : '';
					$email 		= isset( $post_data['product_enquiry_email'] ) ? woocommerce_clean( $post_data['product_enquiry_email'] ) : '';
					$phone 		= isset( $post_data['product_enquiry_phone'] ) ? woocommerce_clean( $post_data['product_enquiry_phone'] ) : '';
					$enquiry 	= isset( $post_data['product_enquiry_message'] ) ? woocommerce_clean( $post_data['product_enquiry_message'] ) : '';
					$product_id = isset( $post_data['product_id'] ) ? (int) $post_data['product_id'] : 0;

					if ( ! $product_id )
						die( __( 'Invalid product!', 'wc_enquiry_form' ) );

					if ( ! is_email( $email ) )
						die( __( 'Please enter a valid email.', 'wc_enquiry_form' ) );

					// Recaptcha
					$publickey  = get_option( 'woocommerce_recaptcha_public_key' );
					$privatekey = get_option( 'woocommerce_recaptcha_private_key' );
					if ( $publickey && $privatekey ) {

						$response = wp_safe_remote_get( add_query_arg( array(
							'secret'   => $privatekey,
							'response' => isset( $post_data['g-recaptcha-response'] ) ? $post_data['g-recaptcha-response'] : '',
							'remoteip' => isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']
						), 'https://www.google.com/recaptcha/api/siteverify' ) );

						if ( is_wp_error( $response ) || empty( $response['body'] ) || ! ( $json = json_decode( $response['body'] ) ) || ! $json->success ) {
							die( __('Please click on the anti-spam checkbox.', 'wc_enquiry_form') );
						}
					}

					$product 	= get_post( $product_id );
					$subject 	= apply_filters( 'product_enquiry_email_subject', sprintf( __( 'Product Enquiry - %s', 'wc_enquiry_form'), $product->post_title ) );

					$message = array();

					$message['greet']		= "Hola!";
					$message['space_1']  	= '';
					$message['intro']		= sprintf(  "Fuiste contactado por %s (%s) (%s) sobre %s (%s). " , $name, $email,$phone, $product->post_title, get_permalink( $product->ID ) );
					$message['space_2']  	= '';
					$message['message'] 	= $enquiry;

					$message 	= implode( "\n", apply_filters( 'product_enquiry_email_message', $message, $product_id, $name, $email ) );

					$this->from_name    = $name;
					$this->from_address = $email;

					add_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
					add_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );

					if ( wp_mail( apply_filters( 'product_enquiry_send_to', $this->send_to, $product_id ), $subject, $message ) )
						echo 'SUCCESS';
					else
						echo 'Error';

					remove_filter( 'wp_mail_from', array( $this, 'get_from_address' ) );
					remove_filter( 'wp_mail_from_name', array( $this, 'get_from_name' ) );

					die();
				}

				/**
				 * From address for the email
				 */
				public function get_from_address() {
					return $this->from_address;
				}

				/**
				 * From name for the email
				 */
				public function get_from_name() {
					return $this->from_name;
				}

				/**
				 * admin_settings function.
				 *
				 * @access public
				 * @return void
				 */
				public function admin_settings() {
					woocommerce_admin_fields( $this->settings );
				}

				/**
				 * save_admin_settings function.
				 *
				 * @access public
				 * @return void
				 */
				public function save_admin_settings() {
					woocommerce_update_options( $this->settings );
				}

			    /**
			     * write_panel function.
			     *
			     * @access public
			     * @return void
			     */
			    public function write_panel() {
			    	echo '<div class="options_group">';
			    	woocommerce_wp_checkbox( array( 'id' => 'woocommerce_disable_product_enquiry', 'label' => __( 'Disable enquiry form?', 'wc_enquiry_form' ) ) );
			  		echo '</div>';
			    }

			    /**
			     * write_panel_save function.
			     *
			     * @access public
			     * @param mixed $post_id
			     * @return void
			     */
			    public function write_panel_save( $post_id ) {
			    	$woocommerce_disable_product_enquiry = isset( $_POST['woocommerce_disable_product_enquiry'] ) ? 'yes' : 'no';
			    	update_post_meta( $post_id, 'woocommerce_disable_product_enquiry', $woocommerce_disable_product_enquiry );
			    }

			}

			$GLOBALS['WC_Product_Enquiry_Form'] = new WC_Product_Enquiry_Form();
		}
	}
}

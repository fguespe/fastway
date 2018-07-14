<?php
/**
 * Plugin Name:       Woo Empty Cart Button
 * Plugin URI:        http://www.wpcodelibrary.com
 * Description:       This plugin is use for empty whole cart using single click.
 * Version:           1.0.1
 * Author:            WPCodelibrary
 * Author URI:        http://www.wpcodelibrary.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woo-empty-cart-button
 * Domain Path:       /languages
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}


if (!class_exists('Woo_Empty_Cart_Button')) {

    /**
     * Plugin main class.
     *
     * @package Woo_Empty_Cart_Button
     */
    class Woo_Empty_Cart_Button {

        /**
         * Plugin version.
         *
         * @var string
         */
        const VERSION = '1.0.0';

        /**
         * Instance of this class.
         *
         * @var object
         */
        protected static $instance = null;

        /**
         * Initialize the plugin public actions.
         */
        private function __construct() {
            add_action('init', array($this, 'wecb_load_plugin_textdomain'));
            add_action('woocommerce_after_cart_contents', array($this, 'woo_empty_cart_button'));
            add_shortcode('wec_button', array($this, 'wec_create_button_shortcode'));
            add_filter('widget_text', 'do_shortcode');
        }

        /**
         * Return an instance of this class.
         *
         * @return object A single instance of this class.
         */
        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if (null == self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Load the plugin text domain for translation.
         */
        public function wecb_load_plugin_textdomain() {
            load_plugin_textdomain('woo-empty-cart-button', false, dirname(plugin_basename(__FILE__)) . '/languages/');
            global $woocommerce;
            if (isset($_REQUEST['empty-cart']) && $_REQUEST['empty-cart'] == 'clearcart') {
                $woocommerce->cart->empty_cart();
            }
        }

        /**
         * Create empty cart button on cart page
         */
        public function woo_empty_cart_button() {
            global $woocommerce;
            $cart_url = $woocommerce->cart->get_cart_url();
            ?>
            <tr>
                <td colspan="6" class="actions">
                    <?php if (empty($_GET)) { ?>
                        <a class="button wecb_emptycart" href="<?php echo $cart_url; ?>?empty-cart=clearcart">Vaciar Carrito</a>
                    <?php } else { ?>
                        <a class="button wecb_emptycart" href="<?php echo $cart_url; ?>&empty-cart=clearcart">Vaciar Carrito</a>
                    <?php } ?>
                </td>
            </tr>
            <?php
        }

        public function wec_create_button_shortcode() {
            global $woocommerce;
            $cart_url = $woocommerce->cart->get_cart_url();
            if (empty($_GET)) {
                return '<a class="button wecb_emptycart" href="' . $cart_url . '?empty-cart=clearcart">Vaciar Carrito</a>';
            } else {
                return '<a class="button wecb_emptycart" href="' . $cart_url . '?empty-cart=clearcart">Vaciar Carrito</a>';
            }
        }

    }

    add_action('plugins_loaded', array('Woo_Empty_Cart_Button', 'get_instance'));
}

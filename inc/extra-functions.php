<?php
add_action( 'fastway_footer_init', 'fastway_footer_block', 10 );
add_action( 'fastway_singleblock_init', 'fastway_singleblock_block', 10 );

function fastway_footer_block(){
    global $redux_demo;
    if( isset( $redux_demo["footer-stblock"] ) && strlen( $redux_demo["footer-stblock"] ) > 0 && class_exists("Nexthemes_StaticBlock") ) Nexthemes_StaticBlock::getSticBlockContent( $redux_demo["footer-stblock"] );
}
function fastway_singleblock_block(){
    global $redux_demo;
    if( isset( $redux_demo["product-page-footer-block"] ) && strlen( $redux_demo["product-page-footer-block"] ) > 0 && class_exists("Nexthemes_StaticBlock") ) Nexthemes_StaticBlock::getSticBlockContent( $redux_demo["product-page-footer-block"] );
}
function fastway_getWidgetHeaderText(){
    global $redux_demo;
    if($redux_demo['header-headerwidget-switch']){
      echo do_shortcode(stripslashes(htmlspecialchars_decode( $redux_demo['header-headerwidget-text'].'<style>'.$redux_demo['css_editor-header-headerwidget'].'</style>' )));
    }
}
function fw_companyname() {
    global $redux_demo;
    return $redux_demo['short-fw_companyname'];
}
function fw_companywhatsapp() {
    global $redux_demo;
    return $redux_demo['short-fw_companywhatsapp'];
}
function fw_companyig() {
    global $redux_demo;
    return $redux_demo['short-fw_companyig'];
}
function fw_companyyoutube() {
    global $redux_demo;
    return $redux_demo['short-fw_companyyoutube'];
}
function fw_companyemail() {
    global $redux_demo;
    return $redux_demo['short-fw_companyemail'];
}
function fw_companyphone() {
    global $redux_demo;
    return $redux_demo['short-fw_companyphone'];
}
function fw_companyfb() {
    global $redux_demo;
    return $redux_demo['short-fw_companyfb'];
}


add_shortcode('fw_companyfb', 'fw_companyfb');
add_shortcode('fw_companyig', 'fw_companyig');
add_shortcode('fw_companyyoutube', 'fw_companyyoutube');
add_shortcode('fw_companyemail', 'fw_companyemail');
add_shortcode('fw_companyphone', 'fw_companyphone');
add_shortcode('fw_companywhatsapp', 'fw_companywhatsapp');
add_shortcode('fw_companyname', 'fw_companyname');

function quicklinks(){
    echo "<div class='fw_quicklinks'>";
    if(!empty(fw_companyfb()))echo '<a href="'.fw_companyfb().'"><i class="fa fa-facebook-official" style="color:blue;"></i> Facebook</a>';
    if(!empty(fw_companyig()))echo '<a href="'.fw_companyig().'"><i class="fa fa-instagram"></i> Instagram</a>';
    if(!empty(fw_companyemail()))echo '<a href="mailto:'.fw_companyemail().'"><i class="fa fa-envelope-o" style="color:green;"></i> Mandar un mail</a>';
    if(!empty(fw_companyphone()))echo '<a href="tel:'.fw_companyphone().'"><i class="fa fa-phone" style="color:green;"></i> Llamar</a>';
    echo "</div>";
    echo "<style>.fw_quicklinks a{
        display:block !important;
        line-height:40px;
        font-size:18px;
        }
        .fw_quicklinks{
        border-top:1px solid black !important;
        margin-top:10px;
        }</style>";
}

if( !function_exists( 'fw_shoppingCart' ) ) {

    function fw_shoppingCart($style = 1){
        if( !fw_checkPlugin('woocommerce/woocommerce.php') ) return;
        global $woocommerce;

        $mini_popup_meta = '<p class="hidden-xs">%s</p>';
        $mini_popup_icon = true;
        $mini_popup_price = true;
        switch($style) {
            case 2:
                $mini_popup_meta = '';
                break;
            case 3:
                $mini_popup_meta = '<span>%s</span>';
                $mini_popup_icon = false;
                break;
            case 4:
                $mini_popup_meta = '<span class="arrow_down">%s</span>';
                $mini_popup_icon = false;
                $mini_popup_price = false;
                break;
            case 5:
                break;
        }

        ?>
        <div class="nth-mini-popup nth-shopping-cart">
            <div class="mini-popup-hover nth-shopping-hover">
                <?php if(absint($style) !== 5) : ?>
                    <?php if($mini_popup_icon):?>
                    <a href="javascript:void(0)" title="<?php esc_attr_e('My Cart','theshopier');?>">
                        <span class="nth-icon icon-nth-cart" data-count="<?php echo absint($woocommerce->cart->cart_contents_count);?>"></span>
                    </a>
                    <?php endif;?>
                    <div class="mini-popup-meta">
                        <?php
                        printf($mini_popup_meta, esc_html__("My Cart", 'theshopier' ));
                        if($mini_popup_price) {
                            printf('<span class="cart-total hidden-xs">%s</span>', $woocommerce->cart->get_cart_total());
                        }
                        ?>
                    </div>
                <?php else: ?>
                    <a href="javascript:void(0)" title="<?php esc_attr_e('My Cart','theshopier');?>">
                        <i class="glyphicon glyphicon-trash" aria-hidden="true"></i>
                        <span class="cart-meta-st5"><?php printf(__('Cart: %s item(s)', 'theshopier'), absint($woocommerce->cart->cart_contents_count));?> </span>
                    </a>
                <?php endif;?>
            </div>

            <div class="nth-mini-popup-cotent nth-shopping-cart-content">
                <div class="widget_shopping_cart_content"></div>
            </div>
        </div>
        <?php
    }

}


if( !function_exists('fastway_getLogo') ) {
    function fastway_getLogo( $type="" ){
        global $redux_demo;
        switch( $type ) {
            case 'sticky':
                break;
            default:
                $title = !empty($redux_demo['logo-text'])? esc_attr($redux_demo['logo-text']): get_bloginfo('name');
                $logo_arg = array(
                    'title' => esc_attr($title),
                    'alt'   => esc_attr($title)
                );

                if( isset( $redux_demo['general-logo'] ) && strlen(trim($redux_demo['general-logo']['url'])) > 0 ){
                    $logo_arg['src'] = esc_url( $redux_demo['general-logo']['url'] );
                    $logo_arg['width'] = absint($redux_demo['general-logo']['width']);
                    $logo_arg['height'] = absint($redux_demo['general-logo']['height']);
                } else {
                    $logo_arg['src'] = esc_url( $THEME_IMG_URI . "logo.png" );
                    $logo_arg['width'] = 530;
                    $logo_arg['height'] = 104;
                }

                echo '<div class="logo">';
                echo '<a href="'.esc_attr(home_url()).'">';
                fastway_getImage($logo_arg);
                echo '</a>';
                echo '</div>';
        }
    }
}

if(!function_exists('fastway_getImage')) {
    function fastway_getImage($atts){
        $atts = wp_parse_args($atts, array(
            'alt'   => esc_attr__('image alt', 'fastway'),
            'width' => '',
            'height' => '',
            'src'  => '',
            'class' => 'fastway-image'
        ));

        $src = esc_url($atts['src']);

        if(strlen(trim($src)) > 0) {
            $_img = '<img';
            foreach($atts as $k => $v) {
                if(empty($v)) continue;
                $_img .= " {$k}=\"{$v}\"";
            }
            $_img .= '>';
            echo wp_kses($_img, array(
                'img' => array('alt' => array(), 'width' => array(), 'height' => array(), 'src' => array(), 'class' => array())
            ));
        }
    }
}




add_action( 'fastway_header_init', 'fastway_header_body', 20 );
add_action( 'fastway_header_init_mobile', 'fastway_header_tablet', 20 );



if( !function_exists('fastway_header_body') ){
    function fastway_header_body( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'templates/header-templates/header-'.$style.'.php') ) $style = 1;
        get_template_part('templates/header-templates/header', $style);
    }
}

if( !function_exists('fastway_header_tablet') ) {
    function fastway_header_tablet( $style = 1 ){
        global $THEME_DIR;
        if( file_exists($THEME_DIR . 'templates/header-templates/header-tablet-'.$style.'.php') )
            get_template_part('templates/header-templates/header-tablet', $style);
    }
}

add_action( 'fastway_product_loop_init', 'fastway_product_loop', 20 );
if( !function_exists('fastway_product_loop') ){
    function fastway_product_loop( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'templates/product-loop-templates/product-loop-'.$style.'.php') ) $style = 1;
        get_template_part('templates/product-loop-templates/product-loop', $style);
    }
}
add_action( 'fastway_product_loop_init_mobile', 'fastway_product_loop_mobile', 20 );
if( !function_exists('fastway_product_loop_mobile') ){
    function fastway_product_loop_mobile( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'templates/product-loop-templates/product-loop-mobile-'.$style.'.php') ) $style = 1;
        get_template_part('templates/product-loop-templates/product-loop-mobile', $style);
    }
}

add_action( 'fastway_product_single_init', 'fastway_product_single', 20 );
if( !function_exists('fastway_product_single') ){
    function fastway_product_single( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'templates/single-product-templates/content-single-product-'.$style.'.php') ) $style = 1;
        get_template_part('templates/single-product-templates/content-single-product', $style);
    }
}
add_action( 'fastway_product_single_init_mobile', 'fastway_product_single_mobile', 20 );
if( !function_exists('fastway_product_single_mobile') ){
    function fastway_product_single_mobile( $style = 1 ){
        global $THEME_DIR;
        if( strlen( $style ) == 0 || !file_exists($THEME_DIR . 'woocommerce/templates-single/content-single-product-mobile-'.$style.'.php') ) $style = 1;
        get_template_part('woocommerce/templates-single/content-single-product-mobile', $style);
    }
}



add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
    global $redux_demo;
  $cols =  $redux_demo['shop_per_page'];
  return $cols;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
    function loop_columns() {
           global $redux_demo;
        return $redux_demo['shop_columns'];
    }
}
function fastway_get_stblock( $cats = array('all') ){
    $res_args = array();

    $meta_query = array();
    
    $args = array(
        'post_type'         => 'fw_stblock',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'title',
        'order'             => 'ASC',
        //'meta_query'        => $meta_query
    );

    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->post_name;
        $res_args[$slug] = get_the_title($block->ID);
    }
    return $res_args;
}


function get_blocks( ){
    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'DESC',
        'post_type'        => 'static-block',
        'post_status'      => 'publish',
    );
    
    $blocks = get_posts( $args );

    foreach($blocks as $block) {
        $slug = $block->ID;
        $res_args[$slug] = get_the_title($block->ID);
    }
    return $res_args;
}
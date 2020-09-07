<?php 

if(is_admin())add_action( 'wp_dashboard_setup', 'prefix_add_dashboard_widget' );

function prefix_add_dashboard_widget() {
   
    if(fw_theme_mod('fw_widget_estado')){
        wp_add_dashboard_widget(
            'fw_widget_estado', 
            __('Site Status','fastway'), 
            'fw_widget_estado_dash', 
            'fw_widget_estado_dash_handler'
        );
    }
    if(fw_theme_mod('fw_currency_conversion')){
        wp_add_dashboard_widget(
            'fw_currency_widget', 
            __('Currency Conversion','fastway'), 
            'fw_dash_conversion', 
            'fw_dash_conversion_handler'
        );
    }
    if(fw_theme_mod('fw_widget_lili_discount')){
        wp_add_dashboard_widget(
            'fw_widget_lili_discount', 
            __('Lili Discount','fastway'), 
            'fw_widget_lili_discount_dash', 
            'fw_widget_lili_discount_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_desc_prods')){
        wp_add_dashboard_widget(
            'fw_widget_desc_prods', 
            __('Product Discount','fastway'), 
            'fw_widget_desc_prods_dash', 
            'fw_widget_desc_prods_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_popup')){
        wp_add_dashboard_widget(
            'fw_widget_popup', 
            __('Popup','fastway'), 
            'fw_widget_popup_dash', 
            'fw_widget_popup_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_cupones')){
        wp_add_dashboard_widget(
            'fw_widget_cupones', 
            __('Coupons','fastway'), 
            'fw_widget_cupones_dash', 
            'fw_widget_cupones_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_cuotas_tp')){
        wp_add_dashboard_widget(
            'fw_widget_cuotas_tp', 
            __('Todopago Installments','fastway'), 
            'fw_widget_cuotas_tp_dash', 
            'fw_widget_cuotas_tp_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_cuotas_general')){
        wp_add_dashboard_widget(
            'fw_widget_cuotas_general', 
            __('Installments','fastway'), 
            'fw_widget_cuotas_general_dash', 
            'fw_widget_cuotas_general_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_mensaje_barra')){
        wp_add_dashboard_widget(
            'fw_widget_mensaje_barra', 
            __('Important Message','fastway'), 
            'fw_widget_mensaje_barra_dash', 
            'fw_widget_mensaje_barra_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_mensaje_sec')){
        wp_add_dashboard_widget(
            'fw_widget_mensaje_sec', 
            __('Secondary Message','fastway'), 
            'fw_widget_mensaje_sec_dash', 
            'fw_widget_mensaje_sec_dash_handler'
        );
    }
}

function fw_widget_popup_dash(){
    $estado=fw_theme_mod('fw_popup_type');
    $color=$estado=='off'?'red':'green';
    if($estado!='off') $estado=($estado=='html')?'Newsletter':'Imagen';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
    $l_label=__('Change','fastway');
    $l_estado=__('Status','fastway');
    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$l_estado: $estado</label><br>
        <a class="iralasopciones" href="index.php?edit=fw_widget_popup#fw_widget_popup">$l_label</a>
    </div>
HTML;
}


function fw_widget_popup_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_popup_options' ) )$widget_options = array( );

    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_popup_options'] ) ) {

        $estado = ( $_POST['fw_widget_popup_options']['estados'] );
        $widget_options['urlimg'] = ( $_POST['fw_widget_popup_options']['urlimg'] );
        $widget_options['link'] = ( $_POST['fw_widget_popup_options']['link'] );

        if($estado=='html')set_theme_mod('fw_popup_form_mode',true);
        else set_theme_mod('fw_popup_form_mode',false);

        set_theme_mod('fw_popup_type',$estado);
        set_theme_mod('fw_popup_img',$widget_options['urlimg']);
        set_theme_mod('fw_popup_link',$widget_options['link']);
        
    }

    if( !isset( $widget_options['estados'] ) )$widget_options['estados'] = '';

    echo "
      <div class='feature_post_class_wrap'>
        <label>Tipo</label>
         <select name=\"fw_widget_popup_options[estados]\" id=\"estados\">
            <option value=\"off\">".__('Disabled','fastway')."</option> 
            <option value=\"image\">".__('Image','fastway')."</option>
            <option value=\"html\">".__('Newsletter','fastway')."</option>
         </select><br>

        <label>URL img: <input type=\"text\" name=\"fw_widget_popup_options[urlimg]\" id=\"urlimg\" value=\"".fw_theme_mod('fw_popup_img')."\"><br>
        <small>*".__('Copy the image url,you can get it from the <a target=\"_blank\" href=\"/wp-admin/upload.php\">gallery</a>. You can also copy for example a GIF from its url on <a href="https://giphy.com/create/gifmaker">giphy</a>')."<br>
        <label>".__('URL to link').":<input type=\"text\" name=\"fw_widget_popup_options[link]\" id=\"link\" value=\"".fw_theme_mod('fw_popup_link')."\"><br>
        *".__('If empty, it will not redirect on click')."</small><br><br>
      </div>";
}






function fw_widget_cupones_dash(){
    $estado=get_option('woocommerce_enable_coupons')==='yes'?__('Active','fastway'):__('Inactive','fastway');
    $color=$estado=='Activo'?'green':'red';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
    $cambiar_l=__('Change','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$estado</label><br>
        <a class="iralasopciones" href="index.php?edit=fw_widget_cupones#fw_widget_cupones">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_cupones_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_cupones_options' ) )$widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD']/* && isset( $_POST['fw_widget_cupones_options'] )*/) {
        $ess='no';
        if($_POST['fw_widget_cupones_options']) $ess='yes';
        update_option( 'woocommerce_enable_coupons',  $ess);
    }
    
    $estado=get_option('woocommerce_enable_coupons')==='yes'?true:false;
    $estado=$estado?"checked=\"".$estado."\"":"";

    echo "<div>
        <label>".__('Status','fastway')." <input type=\"checkbox\" name=\"fw_widget_cupones_options[estado]\" id=\"estado\" ".$estado." ></label><br>
    </div><br>";
}



function fw_widget_desc_prods_dash(){

    $cates =__('Applies to','fastway').': '.(fw_theme_mod('fw_product_discount_categories')?fw_theme_mod('fw_product_discount_categories'):'All products');
    $estado=fw_theme_mod('fw_product_discount')?__('Active','fastway'):__('Inactive','fastway');
    $color=$estado==__('Active','fastway')?'green':'red';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
    $porcentage=__('Discount (%)','fastway').': '.floatval(fw_theme_mod('fw_product_discount_percentage'));
    $cambiar_l=__('Change','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$estado</label><br>
        <label>$cates</label><br>
        <label>$porcentage </label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_desc_prods#fw_widget_desc_prods">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_desc_prods_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_desc_prods' ) )$widget_options = array();
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_desc_prods'] ) ) {
        set_theme_mod('fw_product_discount',$_POST['fw_widget_desc_prods']['estado']);
        set_theme_mod('fw_product_discount_percentage',$_POST['fw_widget_desc_prods']['percentage']);
        set_theme_mod('fw_product_discount_categories',$_POST['fw_widget_desc_prods']['categories']);
    }

    $estado=fw_theme_mod('fw_product_discount')?true:false;
    $estado=$estado?"checked=\"".$estado."\"":"";

    echo "
    <div>
    <label>".__('Status','fastway').": <input type=\"checkbox\" name=\"fw_widget_desc_prods[estado]\" id=\"estado\" ".$estado." ></label><br>
    <label>".__('Categories','fastway').": <input type=\"text\" name=\"fw_widget_desc_prods[categories]\" id=\"categories\" value=\"".fw_theme_mod('fw_product_discount_categories')."\"><br>
    <small>*".__('If empty, aplies to all products','fastway')."</small><br>
    <label>".__('Discount (%)','fastway').":<input type=\"number\" name=\"fw_widget_desc_prods[percentage]\" id=\"percentage\" placewholder=\"Ej: 20\" value=\"".fw_theme_mod('fw_product_discount_percentage')."\"><br>
    <small>".__('For more info: <a href=\"https://altoweb.freshdesk.com/a/solutions/articles/36000234206\">click here</a>','fastway')."<br>
    </div><br>";
}


function fw_widget_lili_discount_dash(){
    $cates =__('Applies to','fastway').': '.(fw_theme_mod('fw_lili_discount_categories')?fw_theme_mod('fw_lili_discount_categories'):'All products');
    $cant=fw_theme_mod('fw_lili_discount_cant');
    $cant=__('Quantity','fastway').': '.$cant."x".($cant-1);
    $estado=__('Status','fastway').': '.fw_theme_mod('fw_lili_discount')?__('Active','fastway'):__('Inactive','fastway');
    $color=$estado==__('Active','fastway').':'?'green':'red';
    $cupones=__('Allows coupons','fastway').': '.(fw_theme_mod('fw_lili_discount_cupones')?__('Yes','fastway'):__('No','fastway'));
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';
    $porcentage=__('Discount (%)','fastway').': '.floatval(fw_theme_mod('fw_lili_discount_percentage')).'<small>('.__('Applies to the cheapiest','fastway').'</small>';
    $cambiar_l=__('Change','fastway').':';
    
    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$estado</label><br>
        <label>$cates</label><br>
        <label>$cupones</label><br>
        <label>$porcentage</label><br>
        <label>$cant</label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_lili_discount#fw_widget_lili_discount">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_lili_discount_dash_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_widget_lili_discount_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_lili_discount_options'] ) ) {
        //Logica save
        set_theme_mod('fw_lili_discount',$_POST['fw_widget_lili_discount_options']['estado']);
        set_theme_mod('fw_lili_discount_categories',$_POST['fw_widget_lili_discount_options']['categories']);
        set_theme_mod('fw_lili_discount_cant',$_POST['fw_widget_lili_discount_options']['cant']);
        set_theme_mod('fw_lili_discount_percentage',$_POST['fw_widget_lili_discount_options']['percentage']);
        set_theme_mod('fw_lili_discount_cupones',$_POST['fw_widget_lili_discount_options']['cupones']);
    }

    $estado=fw_theme_mod('fw_lili_discount')?true:false;
    $estado=$estado?"checked=\"".$estado."\"":"";
    echo "
    <div>
        <label>".__('Status','fastway').': '."<input type=\"checkbox\" name=\"fw_widget_lili_discount_options[estado]\" id=\"estado\" ".$estado." ></label><br>
        <label>".__('Applies to','fastway').': '."<input type=\"text\" name=\"fw_widget_lili_discount_options[categories]\" id=\"categories\" value=\"".fw_theme_mod('fw_lili_discount_categories')."\"><br>
        <label>".__('Allows coupons','fastway').': '."<input type=\"checkbox\" name=\"fw_widget_lili_discount_options[cupones]\" id=\"cupones\" ".fw_theme_mod('fw_lili_discount_cupones')." ></label><br>
        <label>".__('Quantity','fastway').': '."<input type=\"number\" name=\"fw_widget_lili_discount_options[cant]\" id=\"cant\" value=\"".fw_theme_mod('fw_lili_discount_cant')."\"><br>
        <label>".__('Discount (%)','fastway').': '.":<input type=\"number\" name=\"fw_widget_lili_discount_options[percentage]\" id=\"percentage\" value=\"".fw_theme_mod('fw_lili_discount_percentage')."\"><br>
        <small>Instructions:<br>
        1) For categories, it must be entered in the field, the category slug, which can be obtained in <a href='edit-tags.php?taxonomy=product_cat&post_type=product'>categories</a> section (separated with ','). <br> 
        2) Leave empty and it will apply to all categories<br> 
        3) Quantity is the minimum of the ratio. in the case of 3x2 it should be 3, and 2x1 should be 2
        4) Discount always applies only to the cheapiests</small>
        </div><br>";
}


function fw_widget_cuotas_tp_dash(){
    $cuotas =__('Max installments','fastway').':'.fw_theme_mod('fw_cuotas_todopago');
    $cambiar_l=__('Change','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$cuotas</label>
        <a class="iralasopciones" href="index.php?edit=fw_todopago_widget#fw_todopago_widget">$cambiar_l</a>
    </div>
HTML;
}


function fw_widget_cuotas_tp_dash_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_todopago_widget_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_todopago_widget_options'] ) ) {
        # minor validation
         $variable=( $_POST['fw_todopago_widget_options']['max_cuotas'] );
        $arra=get_option( 'woocommerce_todopago_settings' );
        $arra['max_cuotas']=$variable;
        update_option( 'woocommerce_todopago_settings', $arra );
        set_theme_mod('fw_cuotas_todopago',$variable);
    }

    if( !isset( $widget_options['fw_cuotas_todopago'] ) )$widget_options['fw_cuotas_todopago'] = fw_theme_mod('fw_cuotas_todopago');

    echo "
    <div>
        <label>Maximo cuotas sin interes</label>
        <input type=\"text\" name=\"fw_todopago_widget_options[max_cuotas]\" id=\"max_cuotas\" value=\"".fw_theme_mod('fw_cuotas_todopago')."\">
    </div>";
}



add_shortcode('fw_cuotas_general','fw_cuotas_general');
function fw_cuotas_general(){
    return fw_theme_mod('fw_cuotas_general');
}
function fw_widget_cuotas_general_dash(){
    $cuotas =__('Installments','fastway').': '.fw_theme_mod('fw_cuotas_general');
    $cambiar_l=__('Change','fastway');
    
    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$cuotas</label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_cuotas_general#fw_widget_cuotas_general">$cambiar_l</a>
    </div>
HTML;
}

function fw_widget_cuotas_general_dash_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_widget_cuotas_general_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_cuotas_general_options'] ) ) {
        $cuotas=( $_POST['fw_widget_cuotas_general_options']['cuotas'] );
        set_theme_mod('fw_cuotas_general',$cuotas);
    }

    # set defaults  
    if( !isset( $widget_options['fw_cuotas_general'] ) )$widget_options['fw_cuotas_general'] = fw_theme_mod('fw_cuotas_general');

    echo "
    <div>
        <label>".__('Installments','fastway').': '."</label>
        <input type=\"text\" name=\"fw_widget_cuotas_general_options[cuotas]\" id=\"cuotas\" value=\"".fw_theme_mod('fw_cuotas_general')."\">
    </div>";
}



















add_shortcode('fw_mensaje_barra','fw_mensaje_barra');
function fw_mensaje_barra(){
    return fw_theme_mod('fw_general_message');
}
function fw_widget_mensaje_barra_dash(){
    $mensaje =__('Message','fastway').': '.fw_theme_mod('fw_general_message');
    $cambiar_l=__('Change','fastway');
    $submsg='*'.__('This will create a red top bar on the website displaying the message.','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$mensaje</label><br>
        <small>$submsg</small>
        <a class="iralasopciones" href="index.php?edit=fw_widget_mensaje_barra#fw_widget_mensaje_barra">$cambiar_l</a>
    </div>
HTML;
}

function fw_widget_mensaje_barra_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_mensaje_barra_options' ) )$widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_mensaje_barra_options'] ) ) {
        $mensaje=( $_POST['fw_widget_mensaje_barra_options']['mensaje'] );
        set_theme_mod('fw_general_message',$mensaje);
    }

    if( !isset( $widget_options['fw_general_message'] ) )$widget_options['fw_general_message'] = fw_theme_mod('fw_general_message');
    echo "
    <div>
        <label>".__('Message','fastway')."</label>
        <input type=\"text\" name=\"fw_widget_mensaje_barra_options[mensaje]\" id=\"mensaje\" value=\"".fw_theme_mod('fw_general_message')."\">
    </div>";
}





add_shortcode('fw_mensaje_sec','fw_mensaje_sec');
function fw_mensaje_sec(){
    return fw_theme_mod('fw_mensaje_sec');
}
function fw_widget_mensaje_sec_dash(){
    $mensaje =__('Message','fastway').': '.fw_theme_mod('fw_mensaje_sec');
    $cambiar_l=__('Change','fastway');

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>$mensaje</label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_mensaje_sec#fw_widget_mensaje_sec">$cambiar_l</a>
    </div>
HTML;
}

function fw_widget_mensaje_sec_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_mensaje_sec_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_mensaje_sec_options'] ) ) {
        # minor validation
        $mensaje=( $_POST['fw_widget_mensaje_sec_options']['mensaje'] );
        set_theme_mod('fw_mensaje_sec',$mensaje);
    }

    if(!isset( $widget_options['fw_mensaje_sec']))$widget_options['fw_mensaje_sec'] = fw_theme_mod('fw_mensaje_sec');

    echo "
    <div>
        <label>".__('Message','fastway')."</label>
        <input type=\"text\" name=\"fw_widget_mensaje_sec_options[mensaje]\" id=\"mensaje\" value=\"".fw_theme_mod('fw_mensaje_sec')."\">
    </div>";
}




function fw_dash_conversion(){
    echo"<div class='fw_widget_dash'>
    <label>".__('1 equals','fastway').': '.fw_theme_mod('fw_currency_conversion')."</label>
    <a class=\"iralasopciones\" href=\"index.php?edit=fw_currency_widget#fw_currency_widget\">Cambiar</a>
    </div>";
}
function fw_dash_conversion_handler(){
    if( !$widget_options = get_option( 'fw_currency_widget_options' ) ) $widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_currency_widget_options'] ) ) {
         $convers=( $_POST['fw_currency_widget_options']['conversion'] );
        set_theme_mod('fw_currency_conversion',$convers);
    }

    if( !isset( $widget_options['fw_currency_conversion'] ) )$widget_options['fw_currency_conversion'] = fw_theme_mod('fw_currency_conversion');

    echo "
      <div>
        <label>".__('1 equals','fastway').":</label>
        <input type=\"text\" name=\"fw_currency_widget_options[conversion]\" id=\"conversion\" value=\"".fw_theme_mod('fw_currency_conversion')."\">
      </div>";
}


function fw_widget_estado_dash() {
    if( !$widget_options = get_option( 'fw_widget_estado_options' ) ) $widget_options = array();


    $estado=$widget_options['estados'];
    if(!fw_theme_mod("maintainance-mode") && fw_theme_mod("fw_shop_state")=='normal')$output="<label class='labelstatus normal'>".__('All functions enabled','fastway')."</label>";
    else if(fw_theme_mod("maintainance-mode"))$output="<label class='labelstatus mante'>".__('Under maintainance','fastway')."</label>";
    else if(fw_theme_mod("fw_shop_state")=='hidepurchases')$output="<label class='labelstatus hidepurchases'>".__('Show only prices, purchases disabled','fastway')."</label>";
    else if(fw_theme_mod("fw_shop_state")=='hideprices')$output="<label class='labelstatus hideprices' >".__('Hide purchases and prices','fastway')."</label>";
 
    echo "<style>
    .fw_widget_dash .labelstatus{
        padding:10px;
    }
    .fw_widget_dash .normal{
        color:green !important;
    }
    .fw_widget_dash .mante{
        color:red !important;
        text-transform:uppercase !important;
    }
    .fw_widget_dash .hidepurchases{
        color:red !important;
    }
    .fw_widget_dash .hideprices{
        color:orange !important;
    }
    .fw_widget_dash .iralasopciones{
        background:#132E59;
        color:white !important;
        padding:5px;
        display:block;
        border:0px !important;
        width:90px;
        margin:5px ;
        margin-top:15px ;
        text-align:center;
    }
    </style>   
    <div class='fw_widget_dash'>
    <div>$output</div>
    <a class='iralasopciones' href=\"index.php?edit=fw_widget_estado#fw_widget_estado\">".__('Change','fastway')."</a>
    </div>";
    }

function fw_widget_estado_dash_handler(){
    if( !$widget_options = get_option( 'fw_widget_estado_options' ) )$widget_options = array( );
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_estado_options'] ) ) {
         $widget_options['estados'] = ( $_POST['fw_widget_estado_options']['estados'] );
         $estado=$widget_options['estados'];
        if($estado=='normal'){
            set_theme_mod('maintainance-mode',false);
            set_theme_mod('fw_shop_state','normal');
        }else if($estado=='maintainance'){
            set_theme_mod('maintainance-mode',true);
            set_theme_mod('fw_shop_state','normal');
        }else if($estado=='hidepurchases'){
            set_theme_mod('maintainance-mode',false);
            set_theme_mod('fw_shop_state','hidepurchases');
        }else if($estado=='hideprices'){
            set_theme_mod('maintainance-mode',false);
            set_theme_mod('fw_shop_state','hideprices');
        }
        update_option( 'fw_widget_estado_options', $widget_options );
    }

    # set defaults  
    if( !isset( $widget_options['estados'] ) )$widget_options['estados'] = '';

    echo "
      <div class='feature_post_class_wrap'>
        <label>".__('Status','fastway')."</label>
         <select name=\"fw_widget_estado_options[estados]\" id=\"estados\">
         <option value>-".__('Estado','fastway')."-</option> 
            <option value=\"normal\">".__('All functions enabled','fastway')."</option> 
            <option value=\"maintainance\" >".__('Under maintainance','fastway')."</option>
            <option value=\"hidepurchases\">".__('Show only prices, purchases disabled','fastway')."</option>
            <option value=\"hideprices\">".__('Hide purchases and prices','fastway')."</option>
         </select>
      </div>";
}


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 function my_custom_dashboard_widgets() {
     global $wp_meta_boxes;
     if(fw_theme_mod("fw_id_ml"))wp_add_dashboard_widget('custom_help_widget1', 'Mercadolibre', 'custom_ml_help');
     if((fw_theme_mod('fw_id_filesync') && !empty(fw_theme_mod('fw_id_wpallimport'))) || !empty(fw_theme_mod('fw_id_wpallexport')))wp_add_dashboard_widget('fw_actualizar_precios', __('Update prices','fastway'), 'fw_actualizar_precios');
     wp_add_dashboard_widget('custom_dashboard_help', __('Need help','fastway'), 'custom_dashboard_help');
     wp_add_dashboard_widget('fw_ajustes_generales', __('General Settings','fastway'), 'fw_ajustes_generales');
 }
 
 function fw_ajustes_generales() {
    echo '
    <p>
    <span>'.__('Customize emails & texts','fastway').': <a href="options-general.php?page=myplugin" class="btn">'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Shipping Methods','fastway').': <a href="admin.php?page=wc-settings&tab=shipping" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Payment Methods','fastway').': <a href="admin.php?page=wc-settings&tab=checkout" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Export forms','fastway').': <a href="admin.php?page=gf_export" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Export users/orders','fastway').': <a href="admin.php?page=wc_customer_order_csv_export" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Customize menus','fastway').': <a href="nav-menus.php" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Email log','fastway').': <a href="/wp-admin/admin.php?page=email-log" class="btn"  >'.__('open','fastway').'</a></span><br><br>
    <span>'.__('Refresh cache','fastway').': <a href="/wp-admin/?kinsta-cache-cleared=true" class="btn"  >'.__('clean','fastway').'</a></span><br><br>
    </p>' ;
}
function fw_actualizar_precios() {
    if(!empty(fw_theme_mod('fw_id_wpallexport')))echo '<span>Export updated prices <a href="/wp-admin/admin.php?page=pmxe-admin-manage&id='.fw_theme_mod("fw_id_wpallexport").'&action=update" target="_blank">Export</a></span><br><br>';
    if(!empty(fw_theme_mod('fw_id_wpallimport')))echo '<span>Import updated prices <a href="/wp-admin/upload.php?page=enable-media-replace%2Fenable-media-replace.php&action=media_replace&attachment_id='.fw_theme_mod('fw_id_filesync').'" target="_blank">Import</a></span><br><br>' ;
    echo '<span style="color:red">IMPORTANT: Do not modifty coulmns nor its titles, you could damage or lost data. If in doubt , contact support.</span><br>';
}
function custom_dashboard_help() {
    echo '<p>'.__('Send your requirement from our support widget <a href="#" class="btn" onclick="FreshworksWidget(\'open\');" >create ticket</a>','fastway').'
    <br><br>'.__('For more information about the altoweb service <a target="_blank" href="https://www.altoweb.co/tickets/">click here</a>','fastway').'</p>
    '.__('You can also register in the help portal to see tutorials and send us inquiries. <a target="_blank" href="https://altoweb.freshdesk.com/">Go to portal</a>','fastway');
}
function custom_ml_help() {
    echo '<p>'.__('Products will be updated once per day. You can do the process manually the following way: ','fastway').'<br> 
    1) '.__('Update info from mercadolibre with the following link','fastway').': <a href="https://mlsync.altoweb.co/user.php?user='.fw_theme_mod("fw_id_ml").'" target="_blank">'.__('open','fastway').'</a><br>
    2) '.__('Once finished, start the import process with the following link','fastway').': <a href="/wp-admin/admin.php?page=pmxi-admin-manage&id='.fw_theme_mod("fw_id_wpallimport").'&action=update" target="_blank">'.__('open','fastway').'</a>' ;
}
 
 

//Eso acomoda de lugar los widgets
//add_action( 'admin_init', 'set_dashboard_meta_order' );
function set_dashboard_meta_order() {
  $id = get_current_user_id(); //we need to know who we're updating
  $meta_value = array(
    'normal'  => 'woocommerce_dashboard_status,fw_ajustes_generales', //first key/value pair from the above serialized array
    'side' => 'custom_dashboard_help,fw_widget_estado,fw_widget_popup,fw_widget_mensaje_barra,fw_widget_mensaje_sec', //third key/value pair from the above serialized array
    'column3' => 'rg_forms_dashboard,fw_widget_desc_prods,fw_widget_cupones', //last key/value pair from the above serialized array
  );
  update_user_meta( $id, 'meta-box-order_dashboard', $meta_value ); //update the user meta with the user's ID, the meta_key meta-box-order_dashboard, and the new meta_value
}
 
<?php 

if(is_admin())add_action( 'wp_dashboard_setup', 'prefix_add_dashboard_widget' );

function prefix_add_dashboard_widget() {
   
    if(fw_theme_mod('fw_widget_estado')){
        wp_add_dashboard_widget(
            'fw_widget_estado', 
            'Estado del sitio', 
            'fw_widget_estado_dash', 
            'fw_widget_estado_dash_handler'
        );
    }
    if(fw_theme_mod('fw_currency_conversion')){
        wp_add_dashboard_widget(
            'fw_currency_widget', 
            'Conversion de Moneda', 
            'fw_dash_conversion', 
            'fw_dash_conversion_handler'
        );
    }
    if(fw_theme_mod('fw_widget_lili_discount')){
        wp_add_dashboard_widget(
            'fw_widget_lili_discount', 
            'Lili Discount', 
            'fw_widget_lili_discount_dash', 
            'fw_widget_lili_discount_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_desc_prods')){
        wp_add_dashboard_widget(
            'fw_widget_desc_prods', 
            'Descuento productos', 
            'fw_widget_desc_prods_dash', 
            'fw_widget_desc_prods_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_popup')){
        wp_add_dashboard_widget(
            'fw_widget_popup', 
            'Popup', 
            'fw_widget_popup_dash', 
            'fw_widget_popup_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_cupones')){
        wp_add_dashboard_widget(
            'fw_widget_cupones', 
            'Cupones', 
            'fw_widget_cupones_dash', 
            'fw_widget_cupones_dash_handler'
        );
    }
    if(fw_theme_mod('fw_widget_cuotas_tp')){
        wp_add_dashboard_widget(
            'fw_widget_cuotas_tp', 
            'Cuotas Todopago', 
            'fw_widget_cuotas_tp_dash', 
            'fw_widget_cuotas_tp_dash_handler'
        );
    }
}


function fw_widget_popup_dash(){
    $estado=fw_theme_mod('fw_popup_type');
    $color=$estado=='off'?'red':'green';
    if($estado!='off') $estado=($estado=='html')?'Newsletter':'Imagen';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>Estado: $estado</label><br>
        <a class="iralasopciones" href="index.php?edit=fw_widget_popup#fw_widget_popup">Cambiar</a>
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
            <option value=\"off\">Desactivado</option> 
            <option value=\"image\">Imagen</option>
            <option value=\"html\">Newsletter</option>
         </select><br>

        <label>URL img: <input type=\"text\" name=\"fw_widget_popup_options[urlimg]\" id=\"urlimg\" value=\"".fw_theme_mod('fw_popup_img')."\"><br>
        <small>*Copiar la url de la imagen subida previamente a la <a target=\"_blank\" href=\"/wp-admin/upload.php\">galería</a>. Tambien se puede copiar la url de un GIF greado y subido a giphy.</small><br>
        <label>Link destino: <input type=\"text\" name=\"fw_widget_popup_options[link]\" id=\"link\" value=\"".fw_theme_mod('fw_popup_link')."\"><br>
        <small>*Dejar vacío si no redirige a ningun lado</small><br><br>
      </div>";
}






function fw_widget_cupones_dash(){
    $estado=get_option('woocommerce_enable_coupons')==='yes'?"Activo":"Inactivo";
    $color=$estado=='Activo'?'green':'red';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>Estado: $estado</label><br>
        <a class="iralasopciones" href="index.php?edit=fw_widget_cupones#fw_widget_cupones">Cambiar</a>
    </div>
HTML;
}


function fw_widget_cupones_dash_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_widget_cupones_options' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD']/* && isset( $_POST['fw_widget_cupones_options'] )*/) {
        $ess='no';
        if($_POST['fw_widget_cupones_options']) $ess='yes';

        update_option( 'woocommerce_enable_coupons',  $ess);
    }
    
    $estado=get_option('woocommerce_enable_coupons')==='yes'?true:false;
    $estado=$estado?"checked=\"".$estado."\"":"";

    echo "
    <div>
        <label>Estado <input type=\"checkbox\" name=\"fw_widget_cupones_options[estado]\" id=\"estado\" ".$estado." ></label><br>
    </div><br>";
}



function fw_widget_desc_prods_dash(){

    $cates =fw_theme_mod('fw_product_discount_categories')?fw_theme_mod('fw_product_discount_categories'):'Toda la tienda';
    $estado=fw_theme_mod('fw_product_discount')?"Activo":"Inactivo";
    $color=$estado=='Activo'?'green':'red';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';

    $porcentage=floatval(fw_theme_mod('fw_product_discount_percentage'));

    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>Estado: $estado</label><br>
        <label>Aplica a: $cates</label><br>
        <small>*Dejar vacío para que aplique a toda la tienda</small><br><br>
        <label>Descuento(%): $porcentage </label><br><br>
        <small>Para mas información: <a href="https://altoweb.freshdesk.com/a/solutions/articles/36000234206">click aquí</a><br><br>
        <a class="iralasopciones" href="index.php?edit=fw_widget_desc_prods#fw_widget_desc_prods">Cambiar</a>
    </div>
HTML;
}


function fw_widget_desc_prods_dash_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_widget_desc_prods' ) )$widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_desc_prods'] ) ) {
        //Logica save
        set_theme_mod('fw_product_discount',$_POST['fw_widget_desc_prods']['estado']);
        set_theme_mod('fw_product_discount_percentage',$_POST['fw_widget_desc_prods']['percentage']);
        set_theme_mod('fw_product_discount_categories',$_POST['fw_widget_desc_prods']['categories']);
    }

    $estado=fw_theme_mod('fw_product_discount')?true:false;
    $estado=$estado?"checked=\"".$estado."\"":"";
    echo "
    <div>
        <label>Estado <input type=\"checkbox\" name=\"fw_widget_desc_prods[estado]\" id=\"estado\" ".$estado." ></label><br>
        <label>Categorias: <input type=\"text\" name=\"fw_widget_desc_prods[categories]\" id=\"categories\" value=\"".fw_theme_mod('fw_product_discount_categories')."\"><br>
        <label>Descuento (%)<input type=\"number\" name=\"fw_widget_desc_prods[percentage]\" id=\"percentage\" placeholder=\"Ej: 20\" value=\"".fw_theme_mod('fw_product_discount_percentage')."\"><br>
        </div><br>"
}


function fw_widget_lili_discount_dash(){
    $cates =fw_theme_mod('fw_lili_discount_categories')?fw_theme_mod('fw_lili_discount_categories'):'Toda la tienda';
    $cant=fw_theme_mod('fw_lili_discount_cant');
    $cant=$cant."x".($cant-1);
    $estado=fw_theme_mod('fw_lili_discount')?"Activo":"Inactivo";
    $color=$estado=='Activo'?'green':'red';
    $estado='<label style="color:'.$color.'" >'.$estado.'</label>';

    $porcentage=floatval(fw_theme_mod('fw_lili_discount_percentage'));
    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>Estado: $estado</label><br>
        <label>Aplica a: $cates</label><br>
        <label>Descuento: $porcentage % al mas barato</label><br>
        <label>Cantidad: $cant</label>
        <a class="iralasopciones" href="index.php?edit=fw_widget_lili_discount#fw_widget_lili_discount">Cambiar</a>
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
    }

    $estado=fw_theme_mod('fw_lili_discount')?true:false;
    $estado=$estado?"checked=\"".$estado."\"":"";
    echo "
    <div>
        <label>Estado: <input type=\"checkbox\" name=\"fw_widget_lili_discount_options[estado]\" id=\"estado\" ".$estado." ></label><br>
        <label>Categorias: <input type=\"text\" name=\"fw_widget_lili_discount_options[categories]\" id=\"categories\" value=\"".fw_theme_mod('fw_lili_discount_categories')."\"><br>
        <label>Cantidad minima: <input type=\"number\" name=\"fw_widget_lili_discount_options[cant]\" id=\"cant\" value=\"".fw_theme_mod('fw_lili_discount_cant')."\"><br>
        <label>Descuento (%):<input type=\"number\" name=\"fw_widget_lili_discount_options[percentage]\" id=\"percentage\" value=\"".fw_theme_mod('fw_lili_discount_percentage')."\"><br>
        <small>Instrucciones:<br>
        1) Se deben ingresar los slugs de las categorías, se pueden consultar en la url de la tienda, o en la sección  <a href='edit-tags.php?taxonomy=product_cat&post_type=product'>categorías</a> (separados con ','). <br> 
        2) Dejar vacío para aplicar a toda la tienda<br> 
        3) Cantidad minima seria por ejemplo 3 para 3x2 y 2 para 2x1</small>
        4) El descuento siempre aplica solo al mas barato.
        </div><br>";
}


function fw_widget_cuotas_tp_dash(){
    $cuotas =fw_theme_mod('fw_cuotas_todopago');
    echo <<<HTML
    <div class='fw_widget_dash'>
        <label>Maximo cuotas sin interes: $cuotas</label>
        <a class="iralasopciones" href="index.php?edit=fw_todopago_widget#fw_todopago_widget">Cambiar</a>
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

    # set defaults  
    if( !isset( $widget_options['fw_cuotas_todopago'] ) )
        $widget_options['fw_cuotas_todopago'] = fw_theme_mod('fw_cuotas_todopago');

    echo "
    <div>
        <label>Maximo cuotas sin interes</label>
        <input type=\"text\" name=\"fw_todopago_widget_options[max_cuotas]\" id=\"max_cuotas\" value=\"".fw_theme_mod('fw_cuotas_todopago')."\">
    </div>";
}


function fw_dash_conversion(){
    echo"<div class='fw_widget_dash'>
    <label>1 es igual a: ".fw_theme_mod('fw_currency_conversion')."</label>
    <a class=\"iralasopciones\" href=\"index.php?edit=fw_currency_widget#fw_currency_widget\">Cambiar</a>
    </div>";
}
function fw_dash_conversion_handler(){

    # get saved data
    if( !$widget_options = get_option( 'fw_currency_widget_options' ) )
        $widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_currency_widget_options'] ) ) {
        # minor validation
         $convers=( $_POST['fw_currency_widget_options']['conversion'] );
        
        //update_option( 'fw_currency_widget_options', $widget_options );
        set_theme_mod('fw_currency_conversion',$convers);
    }

    # set defaults  
    if( !isset( $widget_options['fw_currency_conversion'] ) )
        $widget_options['fw_currency_conversion'] = fw_theme_mod('fw_currency_conversion');

    echo "
      <div >
        <label>Equivalencia</label>
         <input type=\"text\" name=\"fw_currency_widget_options[conversion]\" id=\"conversion\" value=\"".fw_theme_mod('fw_currency_conversion')."\">
      </div>";
}


function fw_widget_estado_dash() {
    # get saved data
    if( !$widget_options = get_option( 'fw_widget_estado_options' ) ) $widget_options = array( );


    $estado=$widget_options['estados'];
    if(!fw_theme_mod("maintainance-mode") && fw_theme_mod("fw_shop_state")=='normal')$output="<label class='labelstatus normal'>Todas las funciones hablitadas</label>";
    else if(fw_theme_mod("maintainance-mode"))$output="<label class='labelstatus mante'>Sitio En mantenimiento</label>";
    else if(fw_theme_mod("fw_shop_state")=='hidepurchases')$output="<label class='labelstatus hidepurchases'>Solo se muestran los precios, la venta esta desactivada.</label>";
    else if(fw_theme_mod("fw_shop_state")=='hideprices')$output="<label class='labelstatus hideprices' >No se muestran ni los precios ni las compras.</label>";
 
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
    <a class='iralasopciones' href=\"index.php?edit=fw_widget_estado#fw_widget_estado\">Cambiar</a>
    </div>";
    }

function fw_widget_estado_dash_handler()
{
    # get saved data
    if( !$widget_options = get_option( 'fw_widget_estado_options' ) )
        $widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['fw_widget_estado_options'] ) ) {
         # minor validation
         $widget_options['estados'] = ( $_POST['fw_widget_estado_options']['estados'] );
         # save update
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
    if( !isset( $widget_options['estados'] ) )
        $widget_options['estados'] = '';

    echo "
      <div class='feature_post_class_wrap'>
        <label>Estados</label>
         <select name=\"fw_widget_estado_options[estados]\" id=\"estados\">
         <option value>-Estado-</option> 
            <option value=\"normal\">Normal</option> 
            <option value=\"maintainance\" >Mantenimiento</option>
            <option value=\"hidepurchases\">Ocultar compra</option>
            <option value=\"hideprices\">Ocultar precios+compra</option>
         </select>
      </div>";
}


add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
 
 function my_custom_dashboard_widgets() {
     global $wp_meta_boxes;
     if(fw_theme_mod("fw_id_ml"))wp_add_dashboard_widget('custom_help_widget1', 'Soporte', 'custom_ml_help');
     wp_add_dashboard_widget('custom_help_widget2', '¿Necesitas ayuda?', 'custom_dashboard_help');
 }
 
 function custom_dashboard_help() {
     echo '<p>Enviános tu solicitud desde nuestro widget. <a href="#" class="btn" onclick="FreshworksWidget(\'open\');" >Crear ticket</a>
        <br><small>*En el caso que no aparezca nada al apretar crear ticket, refrescar la pagina con CNTRL+SHIFT+R</small>
        <br><br>Para mas información sobre como usar el servicio <a target="_blank" href="https://www.altoweb.co/tickets/">click aquí</a></p>
        Pueden tambien registrarse en portal de ayuda para ver tutoriales y enviarnos consultas. <a target="_blank" href="https://altoweb.freshdesk.com/">Ir al portal</a>
        ' ;
 }
 function custom_ml_help() {
     echo '<p>Las publicaciones se actualizan automaticamente 1 vez por dia. Si no deseas esperar a qeu se actualize automaticamente podes acelerar el proceso: <br> 1) Actualizar publicaciones en el servidor con el siguiente link: <a href="https://mlsync.altoweb.co/user.php?user='.fw_theme_mod("fw_id_ml").'" target="_blank">LINK</a><br><br>2) Una vez que termino de procesarse la obtención de datos, ahora podes indicarle a la web que se actualize en el siguiente proceso: <a href="/wp-admin/admin.php?page=pmxi-admin-manage&id='.fw_theme_mod("fw_id_wpallimport").'&action=update" target="_blank">LINK</a>' ;
 }
 
 
 
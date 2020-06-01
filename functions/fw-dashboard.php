<?php 

if(is_admin())add_action( 'wp_dashboard_setup', 'prefix_add_dashboard_widget' );

function prefix_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'my_dashboard_widget', 
        'Estado del sitio', 
        'prefix_dashboard_widget', 
        'prefix_dashboard_widget_handle'
    );
    if(fw_theme_mod('fw_currency_conversion')){
        wp_add_dashboard_widget(
            'fw_currency_widget', 
            'Conversion de Moneda', 
            'fw_dash_conversion', 
            'fw_dash_conversion_handler'
        );
    }
    if(is_plugin_active('Plugin-WooCommerce-master/index.php')){
        wp_add_dashboard_widget(
            'fw_todopago_widget', 
            'Cuotas Todopago', 
            'fw_todopago_dash', 
            'fw_todopago_dash_handler'
        );
    }
}
function fw_todopago_dash(){
    echo"<div class='fw_widget_dash'>
    <label>Maximo cuotas sin interes: ".fw_theme_mod('fw_cuotas_todopago')."</label>
    <a class=\"iralasopciones\" href=\"index.php?edit=fw_todopago_widget#fw_todopago_widget\">Cambiar</a>
    </div>";
}

function fw_todopago_dash_handler(){

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


function prefix_dashboard_widget() {
    # get saved data
    if( !$widget_options = get_option( 'my_dashboard_widget_options' ) ) $widget_options = array( );


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
    <a class='iralasopciones' href=\"index.php?edit=my_dashboard_widget#my_dashboard_widget\">Cambiar</a>
    </div>";
    }

function prefix_dashboard_widget_handle()
{
    # get saved data
    if( !$widget_options = get_option( 'my_dashboard_widget_options' ) )
        $widget_options = array( );
    # process update
    if( 'POST' == $_SERVER['REQUEST_METHOD'] && isset( $_POST['my_dashboard_widget_options'] ) ) {
         # minor validation
         $widget_options['estados'] = ( $_POST['my_dashboard_widget_options']['estados'] );
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
        update_option( 'my_dashboard_widget_options', $widget_options );
    }

    # set defaults  
    if( !isset( $widget_options['estados'] ) )
        $widget_options['estados'] = '';

    echo "
      <div class='feature_post_class_wrap'>
        <label>Estados</label>
         <select name=\"my_dashboard_widget_options[estados]\" id=\"estados\">
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
     wp_add_dashboard_widget('custom_help_widget2', 'Soporte', 'custom_dashboard_help');
 }
 
 function custom_dashboard_help() {
     echo '<p>Necesitas ayuda? Enviános un ticket desde nuestro portal o desde el widget de ayuda abajo a la derecha en esta pantalla.</p><br><a href="https://altoweb.freshdesk.com/support/tickets/new" target="_blank">Crear ticket</a><br><br>' ;
 }
 function custom_ml_help() {
     echo '<p>Las publicaciones se actualizan automaticamente 1 vez por dia. Si no deseas esperar a qeu se actualize automaticamente podes acelerar el proceso: <br> 1) Actualizar publicaciones en el servidor con el siguiente link: <a href="https://mlsync.altoweb.co/user.php?user='.fw_theme_mod("fw_id_ml").'" target="_blank">LINK</a><br><br>2) Una vez que termino de procesarse la obtención de datos, ahora podes indicarle a la web que se actualize en el siguiente proceso: <a href="/wp-admin/admin.php?page=pmxi-admin-manage&id='.fw_theme_mod("fw_id_wpallimport").'&action=update" target="_blank">LINK</a>' ;
 }
 
 
 
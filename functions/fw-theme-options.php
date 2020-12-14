<?php

function kirki_sidebars_select_example() { 
  	do_action('widgets_init');
 	$sidebars = array(); 
 	if ( isset( $GLOBALS['wp_registered_sidebars'] ) ) { 
 		$sidebars = $GLOBALS['wp_registered_sidebars']; 
 	} 
 	$sidebars_choices = array(); 
 	foreach ( $sidebars as $sidebar ) { 
 		$sidebars_choices[ $sidebar['id'] ] = $sidebar['name']; 
 	}  
 	return $sidebars_choices; 
}  

function urlforimages(){
	$stri=str_replace(site_url(), "", get_template_directory_uri() );
	return $stri;

}
$static_block_args = fastway_get_stblock();

Kirki::add_config( 'theme_config_id', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

Kirki::add_panel( 'panel_fastwaystyle', array(

    'title'       => __( 'Fastway Styling', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

Kirki::add_panel( 'panel_fastwaylayout', array(

    'title'       => __( 'Fastway Layouts', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );

if(is_plugin_active('woocommerce/woocommerce.php')){
	Kirki::add_panel( 'panel_fastwaywoo', array(
		'title'       => __( 'Fastway Woocommerce', 'fastway' ),
	) );
}

Kirki::add_panel( 'panel_fastway', array(

    'title'       => __( 'Fastway Settings', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );
Kirki::add_panel( 'panel_fastway_labels', array(

    'title'       => __( 'Fastway Labels', 'fastway' ),
    //'description' => __( 'My panel description', 'fastway' ),
) );


Kirki::add_section( 'section_general', array(
    'title'          => __( 'General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_email', array(
    'title'          => __( 'Email', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_images', array(
    'title'          => __( 'Images', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_meli', array(
    'title'          => __( 'Mercadolibre', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'preset_section', array(
    'title'          => __( 'Preset', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );


Kirki::add_section( 'section_woo_shop', array(
    'title'          => __( 'Shop Page', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
) );

Kirki::add_section( 'section_popup', array(
    'title'          => __( 'Popup', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );
Kirki::add_section( 'section_scripts', array(
    'title'          => __( 'Scripts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );

Kirki::add_section( 'section_mobile', array(
    'title'          => __( 'Mobile', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );


Kirki::add_section( 'section_seo', array(
    'title'          => __( 'SEO', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_layouts', array(
    'title'          => __( 'Layouts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaystyle',

) );
Kirki::add_section( 'section_buttons', array(
    'title'          => __( 'Buttons', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaystyle',

) );
Kirki::add_section( 'section_colors', array(
    'title'          => __( 'Color Scheme', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaystyle',

) );

Kirki::add_section( 'section_typos', array(
    'title'          => __( 'Typography', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaystyle',

) );

Kirki::add_section( 'section_header', array(
    'title'          => __( 'Header', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );

Kirki::add_section( 'section_mobile_header', array(
    'title'          => __( 'Mobile Header', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );

Kirki::add_section( 'section_email_styles', array(
    'title'          => __( 'Emails', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );

Kirki::add_section( 'section_woo_loop', array(
    'title'          => __( 'Product Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );
Kirki::add_section( 'section_woo_loop_cat', array(
    'title'          => __( 'Category Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );
Kirki::add_section( 'section_woo_single_layout', array(
    'title'          => __( 'Single Product', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );
Kirki::add_section( 'section_woo_loop_brand', array(
    'title'          => __( 'Brand Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );

Kirki::add_section( 'section_woo_loop_blog', array(
    'title'          => __( 'Blog Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );
Kirki::add_section( 'section_woo_loop_review', array(
    'title'          => __( 'Review Loop', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',
  
) );

Kirki::add_section( 'section_footer', array(
    'title'          => __( 'Footer', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );

Kirki::add_section( 'section_layout_others', array(
    'title'          => __( 'Other styles', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );
Kirki::add_section( 'section_layout_others', array(
    'title'          => __( 'CSS Loggedd In', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );
Kirki::add_section( 'section_layout_others', array(
    'title'          => __( 'CSS Admins', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaylayout',

) );


Kirki::add_section( 'section_blog', array(
    'title'          => __( 'Blog', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway',

) );
Kirki::add_section( 'section_labels', array(
    'title'          => __( 'General', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );
Kirki::add_section( 'section_labels_account', array(
    'title'          => __( 'Accounts', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );

Kirki::add_section( 'section_labels_payments', array(
    'title'          => __( 'Payments', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
) );

Kirki::add_section( 'section_labels_single_products', array(
    'title'          => __( 'Single Product', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );

Kirki::add_section( 'section_labels_products', array(
    'title'          => __( 'Products', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );

Kirki::add_section( 'section_labels_cart', array(
    'title'          => __( 'Cart', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );
Kirki::add_section( 'section_labels_shipping', array(
    'title'          => __( 'Shipping', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );
Kirki::add_section( 'section_labels_checkout', array(
    'title'          => __( 'Checkout', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
) );

Kirki::add_section( 'section_labels_thankyou', array(
    'title'          => __( 'Thank you page', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );
Kirki::add_section( 'section_labels_blog', array(
    'title'          => __( 'Blog labels', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastway_labels',
  
) );

if(is_webaltoweb()){
	Kirki::add_section( 'section_actions', array(
		'title'          => __( 'Actions', 'fastway' ),
		//'description'    => __( 'My section description.', 'fastway' ),
		'panel'          => 'panel_fastway',
	
	) );
}


Kirki::add_panel( 'panel_fastwayblog', array(
    'title'       => __( 'Fastway Blog', 'fastway' ),
) );

Kirki::add_section( 'section_blog_general', array(
    'title'          => __( 'General', 'fastway' ),
    'panel'          => 'panel_fastwayblog',

) );
Kirki::add_section( 'section_blog_page', array(
    'title'          => __( 'Post Page', 'fastway' ),
    'panel'          => 'panel_fastwayblog',

) );
Kirki::add_section( 'section_woo', array(
    'title'          => __( 'General', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',

) );



Kirki::add_section( 'section_woo_vars', array(
    'title'          => __( 'Variables', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
) );
Kirki::add_section( 'section_woo_search', array(
    'title'          => __( 'Search Page', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
) );
Kirki::add_section( 'section_woo_payments', array(
    'title'          => __( 'Payment Methods', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

Kirki::add_section( 'section_woo_single', array(
    'title'          => __( 'Single Product', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );
Kirki::add_section( 'section_woo_shippings', array(
    'title'          => __( 'Shipping Methods', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );

Kirki::add_section( 'section_woo_discount', array(
    'title'          => __( 'Discounts', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );


Kirki::add_section( 'section_woo_cart', array(
    'title'          => __( 'Cart ', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
) );



Kirki::add_section( 'section_woo_roles', array(
    'title'          => __( 'Roles', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',

) );
Kirki::add_section( 'section_woo_checkout', array(
    'title'          => __( 'Checkout ', 'fastway' ),
    //'description'    => __( 'My section description.', 'fastway' ),
    'panel'          => 'panel_fastwaywoo',
  
) );


/*LABELs*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_checkout_todopago_label',
	'label'       => __( 'TodoPago Label', 'fastway' ),
	'description'	=>	'Nombre del rol, separados con ",".',
	'section'     => 'section_labels_payments',
	'default'     => 'Tarjeta de crédito y débito',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_checkout_todopago_desc',
	'label'       => __( 'TodoPago Descripción', 'fastway' ),
	'description'=>'Display a messsage on the my account page',
	'section'     => 'section_labels_payments',
	'default' => 'Procesado por todopago'
) );

/*tp*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_checkout_eposnet_label',
	'label'       => __( 'ePosnet Label', 'fastway' ),
	'description'	=>	'Nombre del rol, separados con ",".',
	'section'     => 'section_labels_payments',
	'default'     => 'Tarjeta de crédito y débito',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_checkout_eposnet_desc',
	'label'       => __( 'ePosnet Descripción', 'fastway' ),
	'description'=>'Display a messsage on the my account page',
	'section'     => 'section_labels_payments',
	'default' => 'Paga en 3 CUOTAS SIN INTERÉS. Procesado por e-Posnet'
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'checkout-msg',
	'label'       => __( 'Checkout message', 'fastway' ),
	'description'=>'Display a messsage/notice before checkout',
	'section'     => 'section_labels_checkout',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_order_gift_note_placeholder',
	'label'       => __( 'Dejale un mensaje de regalo', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default' 		=>__('Leave a gift message', 'fastway')
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_order_notes_placeholder',
	'label'       => __( 'Comentarios adicionales (placeholder)', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default' 		=>	'Comentarios adicionales',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_continuar',
	'label'    => __( 'Continuar', 'fastway' ),       
	'section'     => 'section_labels_checkout',
	'default' 		=>	'Continuar',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_aplicar',
	'label'    => __( 'Aplicar', 'fastway' ),       
	'section'     => 'section_labels_checkout',
	'default' 		=>	'Aplicar',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_agregar_mas',
	'label'    => __( 'Agregar más productos', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Agregar más productos',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_no_hay',
	'label'    => __( 'No hay productos', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'No hay productos',
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_terms_acepto',
	'label'    => __( 'Acepto los', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Acepto los',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_terms_name',
	'label'    => __( 'Términos y Condiciones', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Terminos y Condiciones',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_1',
	'label'    => __( 'titulo - Tu cuenta', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Tu cuenta',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_2',
	'label'    => __( 'titulo -  Tus datos', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Tus datos',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_datos_1',
	'label'    => __( 'titulo -  Datos de facturación', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Datos de facturación',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_datos_2',
	'label'    => __( 'titulo -  Datos de envío', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Datos de envío',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_ship_to_other',
	'label'    => __( 'Enviar a otra dirección (checkbox)', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Enviar a otra dirección',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_3',
	'label'    => __( 'titulo - ¿Cómo te entregamos la compra?', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'¿Cómo te entregamos la compra?',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_4',
	'label'    => __( 'titulo - ¿Cómo vas a pagar?', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> '¿Cómo vas a pagar?',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_desc',
	'label'    => __( 'Seleccioná el botón que corresponda.', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> 'Seleccioná el botón que corresponda.',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_init',
	'label'    => __( 'Iniciar sesión', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> 'Iniciar sesión',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_close',
	'label'    => __( 'Cerrar sesión', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> 'Cerrar sesión',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_loading',
	'label'    => __( 'Loading...', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> 'Estamos procesando su pedido...aguarde unos segundos.',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_enter',
	'label'    => __( 'Ingresá a tu cuenta', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> 'Ingresá a tu cuenta',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_already',
	'label'    => __( '¿Ya tenés una cuenta?', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> '¿Ya tenés una cuenta?',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_forgot',
	'label'    => __( '¿Olvidaste tu constraseña?', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> '¿Olvidaste tu constraseña?',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_change',
	'label'    => __( 'modificar', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> 'modificar',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_back',
	'label'    => __( 'Volver', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> 'Volver',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_already_not',
	'label'    => __( '¿Aún no tenés cuenta?', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> '¿Aún no tenés cuenta?',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_checkout_verde_1',
	'label'    => __( 'Compra Segura', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> 'Compra Segura',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_checkout_verde_2',
	'label'    => __( '100% Protegido', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=> '100% Protegido',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_read_more',
	'label'       => esc_attr__( 'Read more label', 'fastway' ),
	'section'     => 'section_labels_blog',
	'description' => 'Si se deja vacio, no aparece',
	'default'     => 'Leer más',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_0',
	'label'    => __( 'Gracias por tu compra', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'	=> 'Gracias por tu compra',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_1',
	'label'    => __( 'El pedido fue registrado con número', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'	=> 'El pedido fue registrado con número',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_2',
	'label'    => __( 'Te enviamos un mail a ', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'	=> 'Te enviamos un mail a',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_3',
	'label'    => __( 'con el detalle y las instrucciones de como seguir.', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'	=> 'con el detalle y las instrucciones de como seguir.',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_checkout_thank_4',
	'label'    => __( 'Seguir comprando', 'fastway' ),
	'section'     => 'section_labels_thankyou',
	'default'	=> 'Seguir comprando',
) );


 
//Layouts

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_general_ratio',
	'label'       => __( 'Default border radius', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 0,
	'choices'     => array(
		'min'  => '0',
		'max'  => '10',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'header-width',
	'label'       => __( 'Header Width', 'fastway' ),
	'section'     => 'section_layouts',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
		'container-small'   => 'Small',
	),
	'default'     => 'container',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'layout-blog',
	'label'       => __( 'Blog Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'container-main',
	'label'       => __( 'Main layout: wide or boxed', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	
	'choices'     => array(
		'container-fluid'   => 'Wide',
		'container-mid'   => 'Medium',
		'container'   => 'Boxed',
		'container-small'   => 'Small',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'layout-main',
	'label'       => __( 'Sidebars Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'container-shop',
	'label'       => __( 'Shop Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
		'container-small'   => 'Small',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'shop-layout',
	'label'       => __( 'Shop Pages Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'left',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );
/*SINGLE*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'product-page-layout',
	'label'       => __( 'Product Page Layout', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'full',
	'choices'     => array(
		'left' => __( 'Left Sidebar', 'fastway' ),
		'right' => __( 'Right Sidebar', 'fastway' ),
		'both' => __( 'Both Sidebars', 'fastway' ),
		'full' => __( 'Full Width', 'fastway' ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'footer-width',
	'label'       => __( 'Footer Width', 'fastway' ),
	'section'     => 'section_layouts',
	'default'     => 'container',
	'choices'     => array(
		'container'   => __( 'Boxed', 'fastway' ),
		'container-mid'   => 'Medium',
		'container-fluid' => __( 'Wide ', 'fastway' ),
		'container-small'   => 'Small',
	),
) );

/*BLOG*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_title_switch',
	'label'       => __( 'Blog title', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'blog-stblock',
	'label'       => __( 'Blog Page Header Section', 'fastway' ),
	'section'     => 'section_blog_general',
	'choices'     => $static_block_args,
	'placeholder' => esc_attr__( 'Select an option', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_sidebar_ratio',
	'label'       => __( 'Sidebar Width', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 3,
	'choices'     => array(
		'min'  => '2',
		'max'  => '4',
		'step' => '1',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_per_page',
	'label'       => esc_attr__( 'News Per Page', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 12,
	'choices'     => array(
		'min'  => '4',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'fw_blog_columns',
	'label'       => esc_attr__( 'Columns', 'fastway' ),
	'section'     => 'section_blog_general',
	'default'     => 3,
	'choices'     => array(
		'min'  => '1',
		'max'  => '5',
		'step' => '1',
	),
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_blog',
	'label'       => __( 'CSS Blog Page ', 'fastway' ),
	'section'     => 'section_blog_general',
	'description' => 'Classes: .fw_post_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


/*BLOG PAGE*/



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_date_switch',
	'label'       => __( 'Date data', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_author_switch',
	'label'       => __( 'Author data', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_featured_switch',
	'label'       => __( 'Featured Image', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_blog_comment_switch',
	'label'       => __( 'Comments', 'fastway' ),
	'section'     => 'section_blog_page',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_blog_page',
	'label'       => __( 'CSS Post Page ', 'fastway' ),
	'section'     => 'section_blog_page',
	'description' => 'Classes: .post_page',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-forms',
	'label'       => __( 'CSS Forms', 'fastway' ),
	'section'     => 'section_forms',
	'description' => 'Css de los gravity forms',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*IMAGES*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'general-logo',
	'label'       => __( 'Logo', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_images',
	'default'     => urlforimages()."/assets/img/logo.svg",
	'transport'=>'postMessage',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_favicon',
	'label'       => __( 'Favicon', 'fastway' ),
	'description' => 'dejar vacio, sino, reemplaza site identity',
	'section'     => 'section_images',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'social_media_image',
	'label'       => __( 'Social Media Image', 'fastway' ),
	'description' => 'Size: 1200x630 <= 1MB',
	'section'     => 'section_images',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'dark-logo',
	'label'       => __( 'Dark Logo', 'fastway' ),
	//'description' => __( 'Description Here.', 'fastway' ),
	'section'     => 'section_images',
	'default'     => urlforimages()."/assets/img/logo.svg"
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_mobile_logo',
	'label'       => __( 'Mobile Logo', 'fastway' ),
	'description' => __( 'Replaces general logo on mobile.', 'fastway' ),
	'section'     => 'section_images'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw-email-logo',
	'label'       => __( 'Email Logo', 'fastway' ),
	'description' => 'Por default es el de la web',
	'section'     => 'section_images',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'mobile-icon',
	'label'       => __( 'Mobile App Icon', 'fastway' ),
	'section'     => 'section_images',
	'default'     => '',
) );



//General

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_seo',
	'label'       => __( 'FW Meta Tags', 'fastway' ),
	'section'     => 'section_seo',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_seo_social',
	'label'       => __( 'FW Social Tags', 'fastway' ),
	'section'     => 'section_seo',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-desc',
	'label'       => __( 'Meta Description', 'fastway' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_seo',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'seo-keywords',
	'label'       => __( 'Keywords', 'fastway' ),
    'description' => 'Max 150 characters',
	'section'     => 'section_seo',
	'default'     => '',
) );



/*HEAADER*/
Kirki::add_field( 'theme_config_id', [
	'type'        => 'select',
	'settings'    => 'color_scheme_radio',
	'label'       => 'Preset Loader',
	'description' => 'It will bring all necesary codes',
	'section'     => 'preset_section',
	'choices'     => builder_labels(),
	'preset'  => presets()
] );

Kirki::add_field( 'theme_config_id', [
	'type'     => 'textarea',
	'settings' => 'preset_field',
	'label'    => esc_html__( 'Textarea Control', 'kirki' ),
	'section'  => 'preset_section',
	'default'  => esc_html__( 'This is a default value', 'kirki' ),
	'priority' => 10,
] );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_header_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_header',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'sticky-menu',
	'label'       => __( 'Deactivate Sticky', 'fastway' ),
	'section'     => 'section_header',
	'default'     => array('fw_header.middle', 'fw_header.bottom'),
	'choices'     => array(
		'fw_header.top' => __( 'Top', 'fastway' ),
		'fw_header.middle' => __( 'Middle', 'fastway' ),
		'fw_header.bottom' => __( 'Bottom', 'fastway' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_floating_trans_header',
	'label'       => __( 'Floating Transparent', 'fastway' ),
	'section'     => 'section_header',
	'description' => 'Solo funciona en la pagina principal.',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header-padding',
	'label'       => __( 'Header Padding', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 1,
	'choices'     => array(
		'0.25'  => 1,
		'0.5'  => 2,
		'1' => 3,
		'1.5' => 4,
		'3' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.desktop',
			'property'	=> 'padding-top',
			'units'=>'rem'
		),
		array(
			'element' => '.fw_header.middle.desktop',
			'property'	=> 'padding-bottom',
			'units'=>'rem'
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'header_icons_size',
	'label'       => __( 'Header Icons Size', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 24,
	'choices'     => array(
		'min'  => 10,
		'max'  => 40,
		'step' => 1,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.desktop .fw-header-icon i',
			'property'	=> 'font-size',
			'units'=>'px'
		),
	
		array(
			'element' => '.desktop .fw-header-icon .header-cart-count-badge',
			'property'	=> 'font-size',
			'value_pattern'   => 'calc($px - 6px)',
			
		),
		
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'logo-width',
	'label'       => __( 'Logo Width', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 180,
	'choices'     => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.desktop .logo img',
			'property'	=> 'width',
			'units'=>'px'
		),
	),
) );
/*MELI*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_ml_on',
	'label'       => __( 'Activar', 'fastway' ),
	'section'     => 'section_meli',
	'description' => 'Pasarle el link al cliente: <a href="'.'https://'.$_SERVER['HTTP_HOST'].'/wp-content/themes/fastway/functions/meli/'.'">LINK</a><br>'.json_encode(get_option('fw_ml_app_'.get_theme_mod('fw_id_ml'))),
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_id_ml',
	'label'       => __( 'ID Mercadolibre ', 'fastway' ),
	'description'	=>	'Sirve tambien para el dashboard help',
	'section'     => 'section_meli',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_ml_appid',
	'label'       => __( 'App Id ', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_meli',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_ml_appsecret',
	'label'       => __( 'App Secret ', 'fastway' ),
	'description'	=>	'',
	'section'     => 'section_meli',
	'default'     => '',
) );



if(is_webaltoweb()){
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'switch',
		'settings'    => 'fw_ml_stock_web_a_ml',
		'label'       => __( 'Descontar stock web->ml (CR)', 'fastway' ),
		'section'     => 'section_meli',
		'default'     => 0,
		'choices' => array(
			'on'  => __( 'Enable', 'fastway' ),
			'off' => __( 'Disable', 'fastway' )
		)
	) );
	Kirki::add_field( 'theme_config_id', array(
		'type'        => 'switch',
		'settings'    => 'fw_ml_stock_ml_a_web',
		'label'       => __( 'Descontar stock ml->web (CR)', 'fastway' ),
		'section'     => 'section_meli',
		'default'     => 0,
		'choices' => array(
			'on'  => __( 'Enable', 'fastway' ),
			'off' => __( 'Disable', 'fastway' )
		)
	) );
}


/*EMAIL*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_woosettings',
	'label'       => __( 'Init Woocommerce', 'fastway' ),
	'section'     => 'section_actions',
	'description' => 'Activar, refrescar y recien ahi toma los cambios. Inicializa woocomerce con nuestros default settings.',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_init_mayorista',
	'label'       => __( 'Init Mayorista', 'fastway' ),
	'section'     => 'section_actions',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_resetmails',
	'label'       => __( 'Reset Mails', 'fastway' ),
	'section'     => 'section_actions',
	'description' => 'Activar, refrescar y recien ahi toma los cambios. Lo que hace es refrescar todo lo que concierne a emails.',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_action_clientimages',
	'label'       => __( 'Client Area Images', 'fastway' ),
	'description' => 'Reinicia imagenes del client area con nuestro branding.',
	'section'     => 'section_actions',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );







Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'my_setting_2',
	'label'       => __( 'INFO', 'textdomain' ),
	'section'     => 'section_email',
	'default'     => '<div style="padding: 10px;background-color: #fff; color:black; border: 1px solid #1E73BE;">
	<h4>VALORES DEFAULT</h4>
	Fijarse que ya hay valores puestos basados en el titulo del sitio y el company data.Si no son diferentes, dejarlos asi vacios. Sino al poner un valor lo va a priorizar.
	</div>',
	'priority'    => 10,
) );


Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_mail_desde_nombre',
	'label'    	=> __( 'Nombre que aparece para mails', 'fastway' ),
	'description' 	=>	'Nombre con el cual les va a llegar a los clientes',
	'section'   => 'section_email',
	'default' => 'Altoweb',
	'input_attrs' => array(
		'placeholder' => get_bloginfo( 'name' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_mail_desde_mails',
	'label'    	=> __( 'Email para recibir notificaciones', 'fastway' ),
	'description' 	=>	' *A que mails se van a enviar todas las notificaciones, separar mails con "," comas.',
	'section'   => 'section_email',
	'default' => '',
	'input_attrs' => array(
		'placeholder' => getMailQueEnvia()
	)
) );



Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_general_from_name',
	'label'    	=> __( 'Desde donde', 'fastway' ),
	'default' => '',
	'description' 	=>	'Nombre de donde salen las notificaciones. No modificar! (Dejar vacio para que tome el campo de arriba de nombre.)',
	'section'   => 'section_email',
	'input_attrs' => array(
		'placeholder' => get_bloginfo( 'name' )
	)
) );



Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_general_from_email',
	'label'    	=> __( 'Desde que mail', 'fastway' ),
	'default' => '',
	'description' 	=>	'Email de donde salen las notificaciones. No modificar! (Dejar vacio para que tome el campo de arriba de nombre, el primero si hay varios con ,)',
	'section'   => 'section_email',
	'input_attrs' => array(
		'placeholder' => getMailQueEnvia()
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'      => 'text',
	'settings'  => 'fw_mail_bcc',
	'label'    	=> __( 'bcc default', 'fastway' ),
	'description' 	=>	' *Todos los mails con copia oculta a un mail.',
	'section'   => 'section_email',
	'default' => '',
) );


/*EMAIL*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_email_logo_width',
	'label'       => __( 'Email Logo Width', 'fastway' ),
	'section'     => 'section_email_styles',
	'default'     => '100%'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-email',
	'label'       => __( 'CSS Mobile', 'fastway' ),
	'section'     => 'section_email_styles',
	'default'     => ''
) );
/*MOBILE*/


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_mheader_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_mobile_header',
	'default'     => '',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'logo-width-mobile',
	'label'       => __( 'Mobile Logo Width', 'fastway' ),
	'section'     => 'section_mobile_header',
	'default'     => 110,
	'choices'     => array(
		'min'  => 0,
		'max'  => 500,
		'step' => 5,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.mobile  .logo img',
			'property'	=> 'width',
			'units'=>'px'
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'header__mobile_icons_size',
	'label'       => __( 'Mobile Header Icons Size', 'fastway' ),
	'section'     => 'section_mobile_header',
	'default'     => 24,
	'choices'     => array(
		'min'  => 10,
		'max'  => 40,
		'step' => 1,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.mobile i',
			'property'	=> 'font-size',
			'units'=>'px'
		),
	
		array(
			'element' => '.fw_header.mobile .header-cart-count-badge',
			'property'	=> 'font-size',
			'value_pattern'   => 'calc($px - 6px)',
			
		),
		
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'header_padding_mobile',
	'label'       => __( 'Header Padding Mobile', 'fastway' ),
	'section'     => 'section_mobile_header',
	'default'     => 1,
	'choices'     => array(
		'0'  => 0,
		'0.25'  => 1,
		'0.5'  => 2,
		'1' => 3,
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.fw_header.middle.mobile',
			'property'	=> 'padding-top',
			'units'=>'rem'
		),
		array(
			'element' => '.fw_header.middle.mobile',
			'property'	=> 'padding-bottom',
			'units'=>'rem'
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'header_mobile_code',
	'label'       => __( 'Header Mobile Code', 'fastway' ),
	'description' => '[fw_m_header id="bottom,top,middle"][fw_logo][fw_m_menu][fw_user_account type="1(only icon)/2(only text)/3(username)][fw_m_search_form][fw_shopping_cart type="1(only icon)/2(only text)/3(username)][/fw_m_header]',
	'section'     => 'section_mobile_header',
	'default'     => '[fw_m_header]<div class="col-3 row align-items-center justify-content-around px-0">
	[fw_m_menu][fw_m_search_form id="3"]
</div>
<div class="col-6 row align-items-center justify-content-center">
	[fw_logo]
</div>
<div class="col-3 row align-items-center justify-content-center">
	[fw_shopping_cart]
</div>[/fw_m_header]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-mobile',
	'label'       => __( 'CSS Mobile', 'fastway' ),
	'description'	=> 'Put everything inside @media',
	'section'     => 'section_mobile_header',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );






Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'mega_menu',
	'label'       => __( 'Mega Menu', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'mega_menu_cols',
	'label'       => __( 'Mega Menu Layout', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 3,
	'choices'     => array(
		6 => __( '2 cols', 'fastway' ),
		4 => __( '3 cols', 'fastway' ),
		3 => __( '4 cols', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'mega_menu_overlay',
	'label'       => __( 'Overlay', 'fastway' ),
	'section'     => 'section_header',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'header_code',
	'label'       => __( 'Header Code', 'fastway' ),
	'description' => '
					[fw_header id="bottom,top,middle"]
					[fw_logo][fw_menu id="XXX/empty for main"][fw_user_account type="1(only icon)/2(only text)/3(username)][fw_search_form id="1"][fw_data type="phone" isli="true" stext="Atencion Telefonica"][fw_shopping_cart]
					[/fw_header]',
	'section'     => 'section_header',
	'default'     => '[fw_header][fw_logo][fw_menu][/fw_header]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-header',
	'label'       => __( 'CSS Header', 'fastway' ),
	'section'     => 'section_header',
	'description' => 'Clases: .fw_header.top,  .fw_header.bottom,  .fw_header.middle,<br> Ids: #header (todo el hader), #fw_menu (agarra el main menu) ,<br>Elementos: .fw_search_form, .fw_logo',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

/*BUTTONS*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_primary_b_color',
	'label'       => __( 'Primary background color', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => 'var(--main)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--primary-background);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--primary-background',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_primary_color',
	'label'       => __( 'Primary color', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--primary-color);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--primary-color',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_primary_b_color_hover',
	'label'       => __( 'Primary background color (hover)', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => 'var(--second)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--primary-background-hover);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--primary-background-hover',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_primary_color_hover',
	'label'       => __( 'Primary color (hover) ', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--primary-color-hover);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--primary-color-hover',
		),
	),
) );





Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_secondary_b_color',
	'label'       => __( 'Secondary background color', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => 'var(--main)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--secondary-background);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--secondary-background',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_secondary_color',
	'label'       => __( 'Secondary color', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--secondary-color);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--secondary-color',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_secondary_b_color_hover',
	'label'       => __( 'Secondary background color (hover)', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--secondary-background-hover);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--secondary-background-hover',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_button_secondary_color_hover',
	'label'       => __( 'Secondary color (hover) ', 'fastway' ),
	'section'     => 'section_buttons',
	'default'     => 'var(--man)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--secondary-color-hover);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--secondary-color-hover',
		),
	),
) );












/*COLOR SCHEME*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-main',
	'label'       => __( 'Main Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#132E59',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--main);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--main',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-second',
	'label'       => __( 'Secondary Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#54AF67',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--second);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--second-color',
		),
		array(
			'element'  => ':root',
			'property' => '--second',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-iconheader',
	'label'       => __( 'Icons', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#132E59',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--icon-header); Its a color for all icons in header. Can be owewritten in css.',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--icon-header',
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-topheader',
	'label'       => __( 'Top Header ', 'fastway' ),
	'section'     => 'section_colorss',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--top-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--top-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-middheader',
	'label'       => __( 'Middle Header ', 'fastway' ),
	'section'     => 'section_colorss',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--middle-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--middle-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'color-sticky-header',
	'label'       => __( 'Header Sticky Color ', 'fastway' ),
	'section'     => 'section_colorss',
	'default'     => '#fff',
	'description'=>' var(--sticky-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--sticky-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-bottheader',
	'label'       => __( 'Bottom Header ', 'fastway' ),
	'section'     => 'section_colorss',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--bottom-header);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--bottom-header',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-bodycolor',
	'label'       => __( 'Body Background', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--body);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--body',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-shopcolor',
	'label'       => __( 'Shop Background ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#ffffff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--shop);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--shop',
		),
	),
	'choices'     =>  array(
		'alpha' => true,
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-footer',
	'label'       => __( 'Footer ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => 'var(--main);',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--footer);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--footer',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'opt-color-copyright',
	'label'       => __( 'Copyright ', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#fff',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--copyright);',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--copyright',
		),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_body_dark_mode',
	'label'       => __( 'Dark Mode Body', 'fastway' ),
	'description'       =>'Black website',
	'section'     => 'section_colors',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
/*MOBILE*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_mobile_dark_mode',
	'label'       => __( 'Menu Dark Mode', 'fastway' ),
	'description'       =>'Automatically adjusts font size to screen',
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'responsive-typo',
	'label'       => __( 'Responsive Typo ', 'fastway' ),
	'description'       =>'Automatically adjusts font size to screen',
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw-quicklinks',
	'label'       => __( 'Quicklinks', 'fastway' ),
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_quickmenu_links',
	'label'       => __( 'Quicklinks', 'fastway' ),
	'section'     => 'section_mobile',
	'default' => 'fb,youtube,whatsapp,ig,email,phone,address'
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw-ctas-switch',
	'label'       => __( 'CTAs', 'fastway' ),
	'section'     => 'section_mobile',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw-ctas',
	'label'       => __( 'CTAs', 'fastway' ),
	'section'     => 'section_mobile',
	'description' => 'Poner none para anular. Default toma num y whatsapp si existe.',
	'default'     => 'fab fa-whatsapp,whatsapp,wp,Consultanos | fal fa-phone,phone,fb,Llamar ahora'
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'mobile-redirect',
	'label'       => __( 'Redirect Mobile', 'fastway' ),
	'description'	=>	'Redirect to other homepage in mobile. Ej. /permalink',
	'section'     => 'section_mobile',
	'default'     => '',
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_is_multitienda',
	'label'       => __( 'Multitienda', 'fastway' ),
	'description'	=> 'Tiene mas de una lista de precios',
	'section'     => 'section_woo',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_hide_cates',
	'label'       => __( 'Hide cates', 'fastway' ),
	'description'	=>	'Categorias a ocultar de la tienda',
	'section'     => 'section_woo',
	'default'     => 'sin-categorizar,sin-categoria,uncategorized',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_shop_state',
	'label'       => __( 'Shop State', 'fastway' ),
	'section'     => 'section_woo',
	'description' => 'Compras off solo oculta el boton comprar<br>Precios off oculta precios y boton de comprar y pone un boton de consultar.',
	'default'     => 'normal',
	'choices'     => array(
		'normal' => __( 'Normal', 'fastway' ),
		'hidepurchases' => __( 'Compras Off', 'fastway' ),
		'hideprices' => __( 'Solo consultas', 'fastway' ),
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_consultar_link',
	'label'    => __( 'Link boton consultar', 'fastway' ),
	'description' => 'Solo se muestra en el caso que esta en "Compras off" ',
	'section'     => 'section_woo',
	'default' => '/contacto'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_min_purchase',
	'label'    => __( 'Min Purchase', 'fastway' ),
	'description' => 'OJO!! SOLO EL NUMERO, SIN SIMBOLOS y el rol entre parentesis separados tipo company data.CONSULTAR '.strtolower(implode(fw_get_all_roles(),", ")),
	'section'     => 'section_woo_cart',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_min_purchase2',
	'description' => 'OJO!! SOLO EL NUMERO, SIN SIMBOLOS y el rol entre parentesis separados tipo company data, CONSULTAR '.strtolower(implode(fw_get_all_roles(),", ")),
	'label'    => __( 'Min Re-Purchase', 'fastway' ),
	'section'     => 'section_woo_cart',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_show_cross_sells',
	'label'       => __( 'Cross Sells', 'fastway' ),
	'description'	=> 'Aaprecen sugierencias de compras en el carrito. Categoria cross-sell para manual',
	'section'     => 'section_woo_cart',
	'default'     => 'simple',
	'choices'     => array(
		'none'   	=> 	'None',
		'auto'   	=> 	'Products',
		'manual'   	=> 	'Category/Manual',
	),
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_price_suffix',
	'label'    => __( 'Price Suffix', 'fastway' ),
	'description' =>'Goes next to the right of the price.',
	'section'     => 'section_woo',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_currency_conversion',
	'label'    => __( 'Currency Conversion', 'fastway' ),
	'description' => 'Al habilitar este campo, al cliente le va a aparecer un widget con un campo para poner la conversion en a la moneda local. Usar punto para decimales, no la coma',
	'section'     => 'section_woo',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_seguircomprando_url',
	'label'    => __( 'Seguir comprando url', 'fastway' ),
	'description' => 'La url del seguir comprando en el carrito como en el thankyou page',
	'default' 	=>	 '/',
	'section'     => 'section_woo',
) );

/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_user_template',
	'label'       => __( 'User Template', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'icon',
	'choices'     => array(
		'icon'   => __( 'Only Icon', 'fastway' ),
		'iconwt' => __( 'Icon With Text ', 'fastway' ),
		'iconwu' => __( 'Icon With Username ', 'fastway' ),
	),
) );*/
/*

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'bread-enabled',
	'label'       => __( 'Breadcrumb', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_prices_visibility',
	'label'       => __( 'Prices', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'show',
	'choices'     => array(
		'show' => __( 'Show', 'fastway' ),
		'logged' => __( 'Logged In', 'fastway' ),
		'hide' => __( 'Hide', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_purchases_visibility',
	'label'       => __( 'Purchases', 'fastway' ),
	'section'     => 'section_woo',
	'default'     => 'show',
	'choices'     => array(
		'show'   => __( 'Show', 'fastway' ),
		'logged' => __( 'Logged In', 'fastway' ),
		'hide' => __( 'Hide', 'fastway' ),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_sell_dni',
	'label'       => __( 'DNI Obligatorio', 'fastway' ),
	'description'	=> 'Pide dni',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_gift_fields',
	'label'       => __( 'Campos Regalo (CR)', 'fastway' ),
	'description'	=> 'Agrega campo mensaje.',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
		0  => __( 'Disable', 'fastway' ),
		1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_terms_required',
	'label'       => __( 'Terminos y condiciones', 'fastway' ),
	'description'	=> 'Aparece el checkbox en el signup. recordar configurar la pagina en los ajustes de woo.',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_sell_to_business',
	'label'       => __( 'Vender a empresas', 'fastway' ),
	'description'	=> 'Pide cuit y nombre de empresa en los campos del checkout',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_checkout_field_address_2',
	'label'       => __( 'Extra campo dirección', 'fastway' ),
	'description'	=> 'Agrega un campo extra que puede ser para altura, piso, etapa, lote, etc. (modificar en labels)',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );

if(is_webaltoweb()){
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_groups',
	'label'       => __( 'Shipping Groups (CR)', 'fastway' ),
	'description'	=> 'Agrupa las sucursales de retiro unicamente',
	'section'     => 'section_woo_checkout',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Disable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );
	}
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_opt_color_checkout',
	'label'       => __( 'Main Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => 'var(--main)',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'var(--checkout); (por default toma el color primario (--main)',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--checkout',
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'color',
	'settings'    => 'fw_opt_color_checkout_back',
	'label'       => __( 'Background Color', 'fastway' ),
	'section'     => 'section_colors',
	'default'     => '#ECECEC',
	'choices'     => array(
		'alpha' => true,
	),
	'description'=>'#ECECEC',
	'transport'   => 'auto',
	'output' => array(
		array(
			'element'  => ':root',
			'property' => '--checkout_back',
		),
	),
) );

/*tp*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_currency_symbol',
	'label'    => __( 'Currency Symbol', 'fastway' ),
	'description' => 'Only affecs main currecy. Leave empty for default.',
	'section'     => 'section_woo_vars',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuotas_todopago',
	'label'    => __( 'Cuotas Todopago', 'fastway' ),
	'section'     => 'section_woo_vars',
	'description' => '',
	'default' => 6
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuotas_general',
	'label'    => __( 'Cuotas General', 'fastway' ),
	'description' => 'Esto sirve para cosas visuales que aparecen en la tienda, como por ejemplo SLM. Genera un shortcode que podemos usar en cualquier lugar [fw_cuotas_general]',
	
	'section'     => 'section_woo_vars',
	'default' => 12
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_general_message',
	'label'       => __( 'General message', 'fastway' ),
	'description'=>'Display a messsage on the top bar for important notificacions',
	'section'     => 'section_woo_vars',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_mensaje_sec',
	'label'       => __( 'Secondary message', 'fastway' ),
	'description'=>'Display a messsage on the top bar for important notificacions',
	'section'     => 'section_woo_vars',
) );




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'textarea',
	'settings'    => 'fw_welcome_msg',
	'label'       => __( 'Welcome message', 'fastway' ),
	'description'=> 'Display a messsage on the my account page',
	'section'     => 'section_woo',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'sold-alone',
	'label'       => __( 'Sold Individually', 'fastway' ),
	'section'     => 'section_woo',
	'description' => 'redirects to checkout directly *redirect to cart has to be activated in woocommerce product options',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );






Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_extra_tax',
	'label'       => __( 'Extra Taxonomias', 'fastway' ),
	'description'	=>	'Nombres de taxonomias. En singular y minuscula Ej: (marca,genero)',
	'section'     => 'section_woo',
	'default'     => '',
) );
/*EMAILS*/




Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'ca_extra_roles',
	'label'       => __( 'Extra roles', 'fastway' ),
	'description'	=>	'Nombre del rol, sin espacios, y separados con ",". Ej: Mayorista',
	'section'     => 'section_woo_roles',
	'default'     => '',
) );
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'multicheck',
	'settings'    => 'ca_roles_css',
	'label'       => esc_attr__( 'CSS Roles', 'fastway' ),
	'description' => 'Roles para editar para tambien el shop_manager.',
	'section'     => 'section_woo_roles',
    'choices'     => fw_getme_roles(),
	'default'     => ''
) );
*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-roles',
	'label'       => __( 'CSS For Roles ', 'fastway' ),
	'section'     => 'section_woo_roles',
	'description' => 'Todos los roles tienen su clase puesta en el body: '.get_role_body_classes(),
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'sidebar-ratio',
	'label'       => __( 'Sidebar Width', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 2,
	'choices'     => array(
		'min'  => '2',
		'max'  => '4',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_per_page',
	'label'       => esc_attr__( 'Products Per Page', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 40,
	'choices'     => array(
		'min'  => '4',
		'max'  => '100',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'shop_columns',
	'label'       => esc_attr__( 'Shop Columns', 'fastway' ),
	'section'     => 'section_woo_shop',
	'default'     => 4,
	'choices'     => array(
		'min'  => '1',
		'max'  => '12',
		'step' => '1',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'fw_shop_stblock_header',
	'label'       => __( 'Shop Page Header Section', 'fastway' ),
	'section'     => 'section_woo_shop',
	'choices'     => $static_block_args,
	'placeholder' => esc_attr__( 'Select an option', 'fastway' ),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor_shop',
	'label'       => __( 'CSS Shop Page ', 'fastway' ),
	'section'     => 'section_woo_shop',
	'description' => 'Classes: .woocommerce-shop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_show_calculator_shipping',
	'label'       => __( 'Show Shipping Calculator', 'fastway' ),
	'section'     => 'section_woo_single',
	'description' => 'Refrescar despues de activar',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
*/
/*PAYMENTS*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_1_on',
	'label'    => __( 'Box 1', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_1_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fad fa-credit-card',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_1_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Tarjeta de Crédito',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_1_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<h3>Pagá Online con MercadoPago</h3>
	<a target="_blank" data-toggle="modal" data-target="#modal_modalmp" class="btn fw_icon_link fancybox">Ver promociones</a>
	<div class="modal modal_modalmp fade" id="modal_modalmp" tabindex="-1" role="dialog" aria-labelledby="modal_modalmpTitle" aria-hidden="true">
	   <div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <div class="modal-body">
				<iframe height="1000" width="100%" frameborder="0" title="Promociones bancarias" scrolling="no" src="https://www.mercadolibre.com.ar/gz/home/payments/methods?modal=true"></iframe>
			 </div>
		  </div>
	   </div>
	</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_2_on',
	'label'    => __( 'Box 2', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_2_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fad fa-hand-holding-usd',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_2_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Efectivo',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_2_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<div class="specs">Podés pagar al contado en nuestras sucursales.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_3_on',
	'label'    => __( 'Box 3', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_3_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fad fa-money-check-alt',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_3_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Depósito / Transferencia',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_3_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<div class="specs">Puede demorar hasta 72hs hábiles en acreditarse.</div>
	<a target="_blank" data-toggle="modal" data-target="#modal_bancos" class="btn fw_icon_link fancybox">Ver datos</a>
	<div class="modal modal_bancos fade" id="modal_bancos" aria-hidden="true">
	   <div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			 <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 <div class="modal-body">
				[altoweb_bancos]
			 </div>
		  </div>
	   </div>
	</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_4_on',
	'label'    => __( 'Box 4', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_4_icon',
	'section'     => 'section_woo_payments',
	'default'     => 'fad fa-barcode-read',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_4_title',
	'section'     => 'section_woo_payments',
	'default'     => 'Cupón de Pago',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_4_desc',
	'section'     => 'section_woo_payments',
	'default'     => '<img stclass="aligncenter" width="60%" src="/wp-content/themes/fastway/assets/img/cupones.png">
	<div class="specs">Imprmí el cupón o copiá el código, vas a RapiPago, Pago Fácil, Provincia Net o Bapro Pago y listo!</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_5_on',
	'label'    => __( 'Box 5', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_5_icon',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_5_title',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_5_desc',
	'section'     => 'section_woo_payments',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_payment_method_6_on',
	'label'    => __( 'Box 6', 'fastway' ),     
	'section'     => 'section_woo_payments',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_6_icon',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_payment_method_6_title',
	'section'     => 'section_woo_payments',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_payment_method_6_desc',
	'section'     => 'section_woo_payments',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_only_mercadoenvios',
	'label'       => __( 'Calculate Only Mercadoenvios', 'fastway' ),
	'section'     => 'section_woo_shippings',
	'description' => 'Refrescar despues de activar',
	'default'     => 0,
	'choices' => array(
		'on'  => __( 'Enable', 'fastway' ),
		'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_define_shipping_default',
	'label'       => __( 'Default shipping paramaters', 'fastway' ),
	'section'     => 'section_woo_shippings',
	'description' => 'Pone default width, height y weight a todos los productos.',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_free_shipping_only_first_order',
	'label'       => __( 'Free Shipping Only First Order', 'fastway' ),
	'section'     => 'section_woo_shippings',
	'description' => 'Hides other options if free shipping is available, it doesnt hide local pickups',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_show_only_free_shipping',
	'label'       => __( 'Show only Free Shipping', 'fastway' ),
	'section'     => 'section_woo_shippings',
	'description' => 'Hides other options if free shipping is available, it doesnt hide local pickups',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_1_on',
	'label'    => __( 'Box 1', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_1_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-motorcycle',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_1_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'En el día, en moto',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_1_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>CABA / GBA consultar costos</h3>
	<div class="specs">Para recibirlo en el día solicitarlo antes de las 13hs, 50% de recargo día de lluvia.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_2_on',
	'label'    => __( 'Box 2', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_2_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-bus',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_2_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Envío a terminal',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_2_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>Despachamos sin cargo</h3><div class="specs">Recibilo de 2 a 5 dias.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_3_on',
	'label'    => __( 'Box 3', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_3_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-shipping-fast',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_3_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Envíos a todo el país',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_3_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<h3>Consulta el costo con tu código postal en el producto a comprar.</h3><div class="specs">Despachamos dentro de las 24hs de realizada la compra. Recibilo de 2 a 5 dias.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_4_on',
	'label'    => __( 'Box 4', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_4_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-truck-container',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_4_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Flete',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_4_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<div class="specs">Fletes a todo el país.</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_5_on',
	'label'    => __( 'Box 5', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_5_icon',
	'section'     => 'section_woo_shippings',
	'default'     => 'fad fa-store',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_5_title',
	'section'     => 'section_woo_shippings',
	'default'     => 'Retiro en el local',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_5_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '<div class="specs">Retiralo en nuestro local [fw_data type="address" only_text="true"]</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_shipping_method_6_on',
	'label'    => __( 'Box 6', 'fastway' ),     
	'section'     => 'section_woo_shippings',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_6_icon',
	'section'     => 'section_woo_shippings',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_method_6_title',
	'section'     => 'section_woo_shippings',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_shipping_method_6_desc',
	'section'     => 'section_woo_shippings',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_single_product_layout',
	'label'       => __( 'Layout', 'fastway' ),
	'section'     => 'section_woo_single_layout',
	'default'     => 'layout1',
	'choices'     => array(
		'layout1'   	=> 	'Default',
		'layout2'   	=> 	'50/50'
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_tab_additional',
	'label'       => __( 'Pestaña especificaciones (medidas)', 'fastway' ),
	'section'     => 'section_woo_single',
	'description' => 'Refrescar despues de activar',
	'default'     => 'off',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_tab_hide_specs',
	'label'       => __( 'Mostrar medidas tabla specs', 'fastway' ),
	'section'     => 'section_woo_single',
	'default'     => 'off',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'slider',
	'settings'    => 'related_columns',
	'label'       => esc_attr__( 'Related Columns', 'fastway' ),
	'section'     => 'section_woo_single',
	'default'     => 6,
	'choices'     => array(
		'min'  => '3',
		'max'  => '12',
		'step' => '1',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_single_code',
	'label'    => __( 'Single Product Code', 'fastway' ),     
	'section'     => 'section_woo_single_layout',
	'description'     => '[fw_single_container]
	[fw_single_gallery]
	[fw_single_summary]
	[fw_single_title]
	[fw_single_price]
	[fw_single_cart]
	[fw_short_desc]
	[fw_single_share]
	[altoweb_financiacion]
	[fw_product_form_cta]
	[/fw_single_summary]
	[fw_single_tabs]
	[/fw_single_container]
	[fw_single_related]
	
	Customer Edits:
	[fw_customer_product_summary]',
	
	'default'     => '[fw_single_container]
	[fw_single_gallery]
	[fw_single_summary]
	[fw_single_title]
	[fw_single_price]
	[fw_single_cart]
	[altoweb_financiacion]
	[/fw_single_summary]
	[fw_single_tabs]
	[/fw_single_container]
	[fw_single_related]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-single',
	'label'       => __( 'CSS Single Product', 'fastway' ), 
	'description' => 'Everything goes inside .fw_single_product',
	'section'     => 'section_woo_single_layout',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
//}
/*FOOTER*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_footer_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_footer',
	'default'     => '',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'select',
	'settings'    => 'footer-stblock',
	'label'       => __( 'Static Block', 'fastway' ),
	'section'     => 'section_footer',
	'choices'     => $static_block_args,
	'placeholder' => esc_attr__( 'Select an option', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-footer',
	'label'       => __( 'CSS Footer', 'fastway' ),
	'description' => 'Everything goes inside #footer',
	'section'     => 'section_footer',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_arrepentimiento_link',
	'label'       => __( 'Link Arrepentimiento', 'fastway' ),
    'description' => 'Link al que redirige el arrepentimiento. ',
	'section'     => 'section_footer',
	'default'     => 'mailto:'.getMailQueRecibe(),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'footer-copyright-switch',
	'label'       => __( 'Show Footer Copyright', 'fastway' ),
	'section'     => 'section_footer',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'footer-copyright-text',
	'label'       => __( 'Footer Copyright HTML', 'fastway' ),
	'description'       => __( 'Not all headers have Header Widget', 'fastway' ),
	'section'     => 'section_footer',
	'default'     => '<div id="fw_footercopy" style="border-top:1px solid #d3d3d3;" class="container-fluid d-flex justify-content-between align-items-center"><div class="izquierda" style="font-size:15px !important;">Powered by <a style="margin-left:5px;" href="https://www.altoweb.ar/es/" target="_blank" rel="noopener"><img class="logofirma"  height="28" src="/wp-content/themes/fastway/assets/img/logo.svg"/></a></div><div class="copyright d-none d-md-block" style="font-size:15px !important;">Copyright ©  [fw_data  type="name" only_text="true" size="15"] | Todos los derechos reservados.</div>  </div>',
	'choices'     => array(
		'language' => 'html',
	),
) );

/*TYPOGRAPHY*/
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fa_pro',
	'label'       => __( 'FontAwesome Pro', 'fastway' ),
	'description' => '*you have to purchase a pro licence and then add your domains.',
	'section'     => 'section_typos',
	'default'     => 0,
	'choices' => array(
	    0  => __( 'Enable', 'fastway' ),
	    1 => __( 'Enable', 'fastway' )
	)
) );*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_icons_style',
	'label'       => 'Font Awesome Pro Styles',
	'section'     => 'section_typos',
	'default'     => 'fad',
	'choices'     => array(
		'fa'   =>  'Regular',
		'fas'  => 'Solid',
		'fad'  => 'Duotone',
		'fal'  => 'Light',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-header',
	'label'       => __( 'Main Navigation', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '20px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => '.navbar-nav li > a',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h1',
	'label'       => __( 'H1', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '40px',
		'line-height'    => '44px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h1',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h2',
	'label'       => __( 'H2', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '32px',
		'line-height'    => '36px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h2',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h3',
	'label'       => __( 'H3', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '25px',
		'line-height'    => '30px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h3',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-h4',
	'label'       => __( 'H4', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '24px',
		'line-height'    => '28px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body h4',
		),
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'typography',
	'settings'    => 'opt-typography-body',
	'label'       => __( 'Body', 'fastway' ),
	'section'     => 'section_typos',
	'default'     => array(
		'font-family'    => 'Rubik',
		'variant'        => 'regular',
		'font-size'      => '16px',
		'line-height'    => '20px',
		'color'     => '#000',
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body a',
		),
		array(
			'element' => 'body p',
		),
		array(
			'element' => 'body div',
		),
		array(
			'element' => 'body span',
		),
		array(
			'element' => 'body li',
		),
		
	),
	'choices'  => array(
		'variant' => array(
			'regular',
			'italic',
			'700',
			'200',
			'300',
			'400',
			'500',
			'600',
			'bold',
			'700italic' 
		),
	),
) );



/*Section CSS*/
/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-general',
	'label'       => __( 'CSS General', 'fastway' ),
	'section'     => 'section_css_general',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-body',
	'label'       => __( 'CSS Body', 'fastway' ),
	'section'     => 'section_css_body',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

*/


/*LOOP*/

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_pl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop',
	'default'     => '',
));

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_code',
	'label'       => __( ' Product Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop',
	'description'     => '[fw_loop_container][fw_loop_image][fw_short_desc][fw_loop_title][fw_if][fw_cuotas cant="X/general"][fw_loop_price][fw_loop_cart][/fw_loop_container][fw_loop_btn type="ajax/link"]',
	'default'     => '[fw_loop_container][fw_loop_image][fw_loop_title][fw_loop_price][/fw_loop_container][fw_loop_btn]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-loop',
	'label'       => __( 'CSS Product Loop', 'fastway' ),
	'section'     => 'section_woo_loop',
	'description' => 'Classes: .fw_product_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_cl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_cat',
	'default'     => '',
));

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_cat_code',
	'label'       => __( ' Category Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_cat',
	'description'     => '[fw_cat_container][fw_cat_image][fw_cat_title][fw_cat_desc][/fw_cat_container]',
	'default'     => '[fw_cat_container][fw_cat_image]<div class="contenedor">[fw_cat_title][fw_cat_desc]</div>[/fw_cat_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_cat',
	'label'       => __( 'CSS Category Loop', 'fastway' ),
	'section'     => 'section_woo_loop_cat',
	'description' => 'Classes: .fw_cat_loop',
	'default'     => '
	.fw_cat_loop .title {
		text-align: center;
		font-size: 22px!important;
		text-transform: uppercase;
		background-color: #F5F5F5;
		border-top: 3px solid var(--main);
		padding: 10px;
	}',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_bl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_blog',
	'default'     => '',
));
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_blog_code',
	'label'       => __( ' Blog Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_blog',
	'description'     => '[fw_blog_container][fw_blog_image][fw_blog_title][fw_blog_desc][fw_blog_logo][fw_blog_url][fw_blog_button][/fw_blog_container]',
	'default'     => '[fw_blog_container][fw_blog_image][fw_blog_title][fw_blog_desc][fw_blog_button][/fw_blog_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_blog',
	'label'       => __( 'CSS Blog Loop', 'fastway' ),
	'section'     => 'section_woo_loop_blog',
	'description' => 'Classes: .fw_post_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_rl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_review',
	'default'     => '',
));

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_review_code',
	'label'       => __( ' Review Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_review',
	'description'     => '[fw_review_container][fw_review_image][fw_review_title]
	[fw_review_desc]
	[fw_review_logo]
	[fw_review_url]
	[fw_review_position]
	[fw_review_company][/fw_review_container]',
	'default'     => '[fw_review_container][fw_review_image][fw_review_title][fw_review_desc][/fw_review_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_review',
	'label'       => __( 'CSS Review Loop', 'fastway' ),
	'section'     => 'section_woo_loop_review',
	'description' => 'Classes: .fw_review_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_builder_brl_class',
	'label'       => __( 'Default class', 'fastway' ),
    'description' => '*playground (beta)',
	'section'     => 'section_woo_loop_brand',
	'default'     => '',
));
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'woo_loop_brand_code',
	'label'       => __( ' Brand Loop Code', 'fastway' ),
	'section'     => 'section_woo_loop_brand',
	'description'     => '[fw_brand_container][fw_brand_image][fw_brand_title][fw_brand_desc][/fw_brand_container]',
	'default'     => '[fw_brand_container][fw_brand_image][fw_brand_title][/fw_brand_container]',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_loop_brand',
	'label'       => __( 'CSS Brand Loop', 'fastway' ),
	'section'     => 'section_woo_loop_brand',
	'description' => 'Classes: .fw_brand_loop',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
/*Company DATA*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'my_setting',
	'label'       => __( 'INFO', 'textdomain' ),
	'section'     => 'section_data',
	'default'     => '<div style="padding: 10px;background-color: #fff; color:black; border: 1px solid #1E73BE;">
	<h4>1- SOLO VALOR</h4>
	Se pone directo el valor y el shortcode va a mostrar algo asi <br>campo:1154999795<br>resultado:<a href="1154999795">1154999795</a> 
	<h4>2- LABEL Y LINK DIFERENCIADOS</h4>
	Se puede especificar los valores poniendo el valor del link entre parentesis para el whatsapp<br>campo:1154999795 (541154999795) <br>resultado: <a href="+5491154999795">1154999795</a> 
	<h4>3- MULTIPLES VALORES</h4>
	Por ejemplo para poner 2 direcciones se puede separar con el simbolo "|" <br>
	ej. Dire 1 (link gmaps) | Dire 2 (link gmaps)<br>
	*En el shortcode despues poner address1 o adress2 o adressX en el type' . '</div>',
	'priority'    => 10,
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyname',
	'label'    => __( 'Company Name', 'fastway' ),
    'description'     => __( '[fw_data type="name"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyphone',
	'label'    => __( 'Company Phone', 'fastway' ),
    'description'     => __( '[fw_data type="phone"]<br>*El tel: se pone solo ', 'fastway' ),            
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyaddress',
	'label'    => __( 'Company Address', 'fastway' ),
    'description'     => __( '[fw_data type="address"] ', 'fastway' ),
	'section'     => 'section_data',
) );

/*
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companygooglemaps',
	'label'    => __( 'Google Maps Url', 'fastway' ),
    'description'     => __( '[fw_companygooglemaps] ', 'fastway' ),
	'section'     => 'section_data',
) );
*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyemail',
	'label'    => __( 'Company Email', 'fastway' ),
    'description'     => __( '[fw_data type="email"]', 'fastway' ),
	'section'     => 'section_data',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyfb',
	'label'    => __( 'Company Facebook', 'fastway' ),
    'description'     => __( '[fw_data type="fb"]', 'fastway' ),
	'section'     => 'section_data',
	'default'     => 'Facebook (#)'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyig',
	'label'    => __( 'Company Instagram', 'fastway' ),
    'description'     => __( '[fw_data type="ig"]', 'fastway' ),            
	'section'     => 'section_data',
	'default'     => 'Instagram (#)'
) );
//Ohojo el. nombre
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companylinkedin',
	'label'    => __( 'Company Linkedin', 'fastway' ),
    'description'     => __( '[fw_data type="linkedin"]', 'fastway' ),            
	'section'     => 'section_data',
	'default'     => 'Linkedin (#)'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companyyoutube',
	'label'    => __( 'Company Youtube', 'fastway' ),
   	'description'     => __( '[fw_data type="youtube"]', 'fastway' ),
	'section'     => 'section_data',
	'default'     => 'Youtube (#)'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'short-fw_companytwitter',
	'label'    => __( 'Company Twitter Url', 'fastway' ),
   	'description'     => __( '[fw_data type="twitter"]', 'fastway' ),
	'section'     => 'section_data',
	'default'     => 'Twitter (#)'
) );
/*Extras*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'maintainance-mode',
	'label'       => __( 'Maintainance Mode', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'number',
	'settings'    => 'fw_max_media_upload',
	'label'    => __( 'Max Media Size Upload (500KB)', 'fastway' ),       
	'section'     => 'section_general',
	'default'	=>	500,
	'description'=>'Tamaño maximo de KB permitido para que los clientes suban a media,asi los obligamos a subidas livianas.'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'maintainance_code',
	'label'       => __( 'Under Maintainance/Construction Html', 'fastway' ),
	'section'     => 'section_general',
	'default'	=>'<div>[fw_logo]<h1>Sitio en mantenimiento.</h1><div><p>Perdone las molestias, volveremos pronto!</p></div></div><br><br><div class="" style="font-size:10px !important;">Este sitio es mantenido por:<br><br>  <a href="https://www.altoweb.ar/es/" target="_blank" rel="noopener"><img class="logofirma"  height="30" src="/wp-content/themes/fastway/assets/img/logo.svg"/></a></div>',
	'choices'     => array(
		'language' => 'html',
	),
) );
//General
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'darklogo_sticky',
	'label'       => __( 'Dark Logo on Sticky', 'fastway' ),
	'section'     => 'section_general',
	'default'     => 0,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fw_popup_type',
	'label'       => __( 'Popup', 'fastway' ),
	'section'     => 'section_popup',
	'default'     => 'off',
	'description' => '<a href="/?testmodal=yes" target="_blank">Test Modal</a>  para probarlo manualmente, sino se muestra una sola vez por dia.',
	'choices'     => array(
		'off' => __( 'Disable', 'fastway' ),
		'image' => __( 'Image', 'fastway' ),
		'html' => __( 'Html', 'fastway' ),
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_popup_html',
	'label'       => __( 'HTML', 'fastway' ),
	'section'     => 'section_popup',
	'default'	=>'<h1>
	Suscribite a nuestro newsletter!
</h1>
<p class="subtitle">
	Enterate de ofertas exclusivas, nuevos lanzamientos y mucho más
</p>
',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'image',
	'settings'    => 'fw_popup_img',
	'label'       => __( 'Popup Img', 'fastway' ),
	'section'     => 'section_popup',

) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_popup_link',
	'label'    => __( 'Link', 'fastway' ),       
	'section'     => 'section_popup',
	'description' => 'Dejar vacio si no hay link'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_popup_form_mode',
	'label'       => __( 'Form', 'fastway' ),
	'section'     => 'section_popup',
	'default'     => 1,
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_pupup_form_id',
	'label'    => __( 'Form ID', 'fastway' ),       
	'section'     => 'section_popup',
	'description' => 'Formulario para el modal',
	'default' => 5
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'popup-size',
	'label'       => __( 'Size', 'fastway' ),
	'section'     => 'section_popup',
	'choices'     => array(
		'modal-sm'   => 'Small',
		'modal-md'   => 'Medium',
		'modal-lg'	 => 'Large',
	),
	'default'     => 'modal-md',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => '404_code',
	'label'       => __( '404 Html', 'fastway' ),
	'section'     => 'section_general',
	'default'	=>'<div class="container">
	<div class="content-detalle row" style="margin:0 auto;margin-top:40px;">
		<div class="col-3">
            <i class="fal fa-debug" style="color:var(--main);font-size:200px;"></i>
		</div>
		<div class="col-9">
			<h1 class="txt-24 t2 tit-pagina" style="font-weight: 400;">No encontramos productos que coincidan con tu búsqueda</h1>
			<br>
			<b>Vamos a afinar tu puntería</b>
			<ul class="t1 txt-16">
				<li>Revisa la ortografía de la palabra</li>
				<li>Usa pocas palabras y más genéricas</li>
				<li>Ayudate con el menú y buscá por categorías</li>
			</ul>
		</div>
	</div>
		<div class="woo" style="margin-top:40px;">
[fw_recent_products title="Lo más buscado esta semana" prodsperrow="6"]</div>
</div>',
	'choices'     => array(
		'language' => 'html',
	),
) );


/*SCRIPTS*/


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_site_verification',
	'label'    => __( 'Google Site Verif. ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'analytics-id',
	'label'    => __( 'Analyitics ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fbpixel_id',
	'label'    => __( 'Facebook Pixel ID', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'gtagmanager_id',
	'label'    => __( 'Google Tag Manager (Global)', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'gtagcheckout_id',
	'label'    => __( ' Tag Manager Conversion ID (Checkout)', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' =>'refresh cache!'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'opt-ace-editor-js',
	'label'       => __( 'JS Code', 'fastway' ),
	'description'       => __( 'Paste your JS code here.', 'fastway' ),
	'section'     => 'section_scripts',
	'default'  => 'jQuery(document).ready(function(){
		
	});',
	'choices'     => array(
		'language' => 'js',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_header_scripts',
	'label'    => __( 'Insert Scripts Header', 'fastway' ),       
	'section'     => 'section_scripts',
	'description' => 'With the script tags',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'fw_footer_scripts',
	'label'    => __( 'Insert Scripts Footer', 'fastway' ),       
	'section'     => 'section_scripts',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'thankyou_insert',
	'label'    => __( 'Thank You Page Code', 'fastway' ),       
	'section'     => 'section_woo',
	'default'     => '',
	'choices'     => array(
		'language' => 'html',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_product_discount',
	'label'       => __( 'Descuento Tienda', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => 'Se aplica a todos los productos',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_percentage',
	'label'    => __( '%', 'fastway' ),
	'description' => 'Porcentage de descuento a toda la tienda, se aplica a nivel producto, no aplica a los que ya tienen descuento',
	'section'     => 'section_woo_discount',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories',
	'label'       => __( 'Categories', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ","'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories_ext',
	'label'       => __( 'Categories Exclude', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ","'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_product_discount_categories_ids_exc',
	'label'       => __( 'Exclude Products', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'El id se obtiene editando el producto, desde la URL, donde dice post=XXXX. IDs separados con ","'
) );

/*LILI1*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount',
	'label'       => __( '1-Lili Discount (Buy X Get X)', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => '(Se aplica al carrito), *refresh devuelta para ver los cambios',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_label',
	'label'       => __( 'Promo Label', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Aparecera este nombre en el carrito',
	'default'     => 'Promo',
	
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_categories',
	'label'       => __( 'Categories Include', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ",", es uno o el otro. Si esta vacio aplica a toda la tienda.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_cant',
	'label'       => __( 'Cantidad minima', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Si hay que comprar 3 para recibir uno gratis, entonces poner 3.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_cupones',
	'label'       => __( 'Admite cupones', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_percentage',
	'label'       => __( 'Porcentage en numeros', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => '100 si es gratis, 50 si es la mitad. Solo aplica al de menor valor.'
) );




/*LILI_2*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_2',
	'label'       => __( '2-Lili Discount (Buy X Get X)', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => '(Se aplica al carrito), *refresh devuelta para ver los cambios',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_label_2',
	'label'       => __( 'Promo Label', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Aparecera este nombre en el carrito',
	'default'     => 'Promo 2',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_categories_2',
	'label'       => __( 'Categories Include', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ",", es uno o el otro. Si esta vacio aplica a toda la tienda.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_cant_2',
	'label'       => __( 'Cantidad minima', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Si hay que comprar 3 para recibir uno gratis, entonces poner 3.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_cupones_2',
	'label'       => __( 'Admite cupones', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_percentage_2',
	'label'       => __( 'Porcentage en numeros', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => '100 si es gratis, 50 si es la mitad. Solo aplica al de menor valor.'
) );


/*LILI_3*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_3',
	'label'       => __( '3-Lili Discount (Buy X Get X)', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,
	'description' => '(Se aplica al carrito), *refresh devuelta para ver los cambios',
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_label_3',
	'label'       => __( 'Promo Label', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Aparecera este nombre en el carrito',
	'default'     => 'Promo 3'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_categories_3',
	'label'       => __( 'Categories Include', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Slugs separados con ",", es uno o el otro. Si esta vacio aplica a toda la tienda.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_cant_3',
	'label'       => __( 'Cantidad minima', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => 'Si hay que comprar 3 para recibir uno gratis, entonces poner 3.'
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_lili_discount_cupones_3',
	'label'       => __( 'Admite cupones', 'fastway' ),
	'section'     => 'section_woo_discount',
	'default'     => 0,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_lili_discount_percentage_3',
	'label'       => __( 'Porcentage en numeros', 'fastway' ),
	'section'     => 'section_woo_discount',
	'description' => '100 si es gratis, 50 si es la mitad. Solo aplica al de menor valor.'
) );





Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_ajax_search',
	'label'       => __( 'Ajax Search', 'fastway' ),
	'section'     => 'section_woo_search',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_search_by_sku',
	'label'       => __( 'Search by sku', 'fastway' ).'(CR)',
	'section'     => 'section_woo_search',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'switch',
	'settings'    => 'fw_search_categorized_only',
	'label'       => __( 'Exclude uncategorized', 'fastway' ),
	'section'     => 'section_woo_search',
	'default'     => 1,//enabled
	'choices' => array(
	    'on'  => __( 'Enable', 'fastway' ),
	    'off' => __( 'Disable', 'fastway' )
	)
) );









Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-logged_in',
	'label'       => __( 'CSS Logged In', 'fastway' ),
	'section'     => 'section_general',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'code',
	'settings'    => 'css_editor-admin',
	'label'       => __( 'CSS Admin', 'fastway' ),
	'section'     => 'section_general',
	'default'     => '',
	'transport'	=> 'postMessage',
	'choices'     => array(
		'language' => 'css',
	),
) );




/*LABELS*/
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_seleccionar_opcion',
	'label'    => 'Seleccionar opción',
	'description'    => 'El alert que aparece cuando no hay prod variable seleccionado',
	'section'     => 'section_labels_products',
	'default'	=>'Seleccionar opción',
));

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'in-stock-text',
	'label'    => 'Producto existente',
	'section'     => 'section_labels_products',
	'default'	=>'En Stock',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_backorder_text',
	'label'    => 'Reservar producto',
	'section'     => 'section_labels_products',
	'default'	=>'Reservar',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'out-of-stock-text',
	'label'    => __( 'Out of Stock Label', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'	=>__( 'Agotado', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_qty_selector_label',
	'label'    => __( 'Selector stock', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'	=>__( 'Seleccionar cantidad', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'add-to-cart-link-text',
	'label'    => __( 'Ver detalle (Loop)', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'	=>__( 'Ver detalle', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'add-to-cart-text',
	'label'    => __( 'Add to cart (Loop)', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'	=>__( 'Agregar al carrito', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_vaciar_carrito',
	'label'    => __( 'Vaciar carrito', 'fastway' ),
	'section'     => 'section_labels_cart',
	'default'	=>'Vaciar carrito',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'proceed-to-checkout-text',
	'label'    => __( 'Boton al checkout', 'fastway' ),
	'section'     => 'section_labels_cart',
	'default'	=>'Comprar',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_free_label',
	'label'    => __( 'Envío gratis', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=>'Sin costo',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_shipping_address_2_label',
	'label'    => __( 'Extra Campo dirección', 'fastway' ),
	'section'     => 'section_labels_checkout',
	'default'	=>'Piso y Departamento',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_envio',
	'label'    => __( 'Envío', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=> 'Envío',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_label_loop_e_gratis',
	'label'    => __( 'Envío gratis (loop label)', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=> 'Envío gratis',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_shipping_grouptitle',
	'label'    => __( 'Retirar en una de nuestras sucursales', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=> 'Retirar en una de nuestras sucursales',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_shipping_groupdesc',
	'label'    => __( 'Ver opciones', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=> 'Ver opciones',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_costos_envio',
	'label'    => __( 'Costos del envío', 'fastway' ),
	'section'     => 'section_labels_shipping',
	'default'	=> 'Costos del envío',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_place_order_text',
	'label'    => __( 'Finalizar Compra', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'	=>'Finalizar',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_ir_carrito',
	'label'    => __( 'Ir al carrito', 'fastway' ),
	'section'     => 'section_labels_products',
	'default'	=>'Ir al carrito',
) );



Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_mi_pedido',
	'label'    => __( 'Mi pedido', 'fastway' ),
	'section'     => 'section_labels',
	'default'	=>'Mi pedido',
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_cuit_label',
	'label'       => 'DNI/CUIT',
	'section'     => 'section_labels_checkout',
	'default'     => __('CDI/VAT','fastway'),
) );


Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_user_text',
	'label'    => __( 'Login Text', 'fastway' ),
	/*'description' => '"username" para que tome el username si inicio',*/
	'section'     => 'section_labels_account',
	'default'	=> 'Ingresar'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_user_myaccount',
	'label'    => __( 'Mi Cuenta ', 'fastway' ),
	'description' => 'Lo que aparece cuando inicia sesión',
	'section'     => 'section_labels_account',
	'default'	=> 'Mi Cuenta'
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_bienvenido',
	'label'    => __( 'BIENVENIDO A', 'fastway' ),
	'section'     => 'section_labels_account',
	'default'	=>'BIENVENIDO A',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_ver_productos',
	'label'    => __( 'VER PRODUCTOS', 'fastway' ),
	'section'     => 'section_labels_account',
	'default'	=>'VER PRODUCTOS',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_related_text',
	'label'    => __( 'Productos Relacionados', 'fastway' ),
	'description' => 'Esto va en la pagina de single products',
	'section'     => 'section_labels_single_products',
	'default'	=>__( 'Quienes vieron este producto también compraron', 'fastway' ),
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_descriptiontab_text',
	'label'    => __( 'Descripción', 'fastway' ),
	'description' => 'Pestaña',
	'section'     => 'section_labels_single_products',
	'default'	=> __( 'Descripción','fastway' )
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_search',
	'label'    => __( 'Search Placeholder', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'¿Que estas buscando?',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_sale',
	'label'    => __( 'Sale Message', 'fastway' ),       
	'section'     => 'section_labels_products',
	'default' 		=>	'¡Oferta!',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_call_now',
	'label'    => __( 'Llamar ahora', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'Llamar ahora',
) );

Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_consultar_price',
	'label'    => __( 'Consultar', 'fastway' ),       
	'section'     => 'section_labels',
	'default' 		=>	'Consultar',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_calcular_cuotas',
	'label'    => __( 'Calcular cuotas', 'fastway' ),       
	'section'     => 'section_labels_products',
	'default' 		=>	'Calculador de cuotas',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_calcular_costo_envio',
	'label'    => __( 'Calcular envio', 'fastway' ),       
	'section'     => 'section_labels_products',
	'default' 		=>	'Calcular costo de envio a domicilio',
) );
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'text',
	'settings'    => 'fw_label_debajo_checkout_message',
	'label'    => __( 'Mensage debajo del boton comprar (checkout)', 'fastway' ),       
	'section'     => 'section_labels_checkout',
	'default' 		=>	'',
) );


add_shortcode('fwcf', 'fwcf');
function fwcf($atts = [], $content = null){
	/*trae a modo shortcode cualquier variable de fw*/
	$atts = shortcode_atts(array('field' => '' ), $atts );
	$custom=fw_theme_mod($atts['field']);
	return $custom;
}

function my_customizer_styles() { ?>
	<style>
	.customize-control-kirki-multicheck ul {
		display:flex;
		flex-wrap: wrap;
	}

	.customize-control-kirki-multicheck ul li {
	  	width: 100%;
	}
	#customize-control-sticky-menu ul li{
		width:33.3%;
	}
	.customize-control-kirki-multicheck ul li label {
		  background: rgba(0, 0, 0, 0.1);
		  border: 1px rgba(0, 0, 0, 0.1);
		  color: #555d66;
		  margin: 0;
		  text-align: center;
		  padding: 0.5em 1em;
		  display: block;
	}

	.customize-control-kirki-multicheck ul li label.checked {
	  	background-color: #00a0d2;
	  	color: rgba(255, 255, 255, 0.8);
	}

	.customize-control-kirki-multicheck ul li input {
	  display: none;
	}
	.CodeMirror {
	  border: 1px solid #eee;
	  height: 400px !important;
	}
	.CodeMirror-gutters, .CodeMirror-gutter-wrapper{
		display:none !important;
	}
	.CodeMirror-sizer{
		margin:0px !important;
	}
	</style>
	<?php
}
add_action( 'customize_controls_print_styles', 'my_customizer_styles', 999 );



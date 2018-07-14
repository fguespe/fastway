<?php
function myplugin_register_settings() {

   add_option( 'sendy_list', 'ID');
   add_option( 'wpallimport_id', '1');
   add_option( 'taxomizerwpai', '0');
   add_option( 'ml_id', '');
   add_option( 'update_plugins', '0');
   add_option( 'redirect_checkout', '0');
   add_option( 'theme_css_shopier', '1');
   add_option( 'nubicommerce_mantenimiento', '0');




   add_option( 'nubicommerce_imagenes_run', '0');
   


   //Cliente
   add_option( 'checkout_message', '');
   add_option( 'cant_catalogo', '20');
   add_option( 'texto_comprar', 'COMPRAR');
   add_option( 'nubicommerce_enstock_label', 'En Stock');
   add_option( 'nubicommerce_sintock_label', 'Sin Stock');
   add_option( 'home_redirect', '');
   

   add_option( 'nubicommerce_menu_tel', '');
   add_option( 'nubicommerce_menu_whats', '');
   add_option( 'briziolabz_defaultoptions', '0');
   add_option( 'nubicommerce_menu_dir', '');
   add_option( 'nubicommerce_menu_insta', '');
   add_option( 'nubicommerce_menu_fb', '');
   add_option( 'nubicommerce_menu_mail', '');


   add_option( 'nubicommerce_banner_superior', '');
   add_option( 'nubicommerce_banner_superior_link', '');
   add_option( 'nubicommerce_checkoutpng', '');
   add_option( 'nubicommerce_checkoutpng_success', '');



   add_option( 'orden_minima', '0');
   add_option( 'orden_minima_segunda', '0');



   //CLIENT OPTIONS

   add_option( 'nubicommerce_destinos_mail', '');
   add_option( 'nubicommerce_desde_nombre', '');

   add_option( 'ihaf_insert_header', '');
   add_option( 'ihaf_insert_footer', '');


   add_option( 'horarios', '');
   add_option( 'nubicommerce_damelosroles', '');


   //MODULOS

   add_option( 'nubicommerce_modulo_500kb', '1');
   add_option( 'nubicommerce_modulo_enquiry', '1');
   add_option( 'nubicommerce_modulo_bulkterms', '0');
   add_option( 'nubicommerce_modulo_enquiry_loggin', '0');
   add_option( 'nubicommerce_modulo_enquiry_redirect', '0');

   register_setting( 'myplugin_options_group', 'nubicommerce_modulo_500kb', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'taxomizerwpai', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'briziolabz_defaultoptions', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_modulo_enquiry', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_modulo_bulkterms', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_modulo_enquiry_loggin', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_modulo_enquiry_redirect', 'myplugin_callback' );




   register_setting( 'myplugin_options_group', 'nubicommerce_damelosroles', 'myplugin_callback' );

   register_setting( 'myplugin_options_group', 'checkout_message', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_mantenimiento', 'myplugin_callback' );



   register_setting( 'myplugin_options_group', 'cant_catalogo', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'ml_id', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'texto_comprar', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'sendy_list', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'update_plugins', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'redirect_checkout', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'wpallimport_id', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'theme_css_shopier', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'home_redirect', 'myplugin_callback' );

   //Colores

   
   
   register_setting( 'myplugin_options_group', 'nubicommerce_banner_superior', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_banner_superior_link', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_checkoutpng', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_checkoutpng_success', 'myplugin_callback' );

   register_setting( 'myplugin_options_group', 'orden_minima', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'orden_minima_segunda', 'myplugin_callback' );

 
   register_setting( 'myplugin_options_group', 'nubicommerce_imagenes_run', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_enstock_label', 'myplugin_callback' );
   register_setting( 'myplugin_options_group', 'nubicommerce_sintock_label', 'myplugin_callback' );
   //Popup
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_popup', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_popup_img', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_popup_link', 'myplugin_callback' );

   //Mails
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_destinos_mail', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_desde_nombre', 'myplugin_callback' );
   //Scrips
   register_setting( 'nubicommerce_ajustes_cliente', 'ihaf_insert_header', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'ihaf_insert_footer', 'myplugin_callback' );


   register_setting( 'nubicommerce_ajustes_cliente', 'horarios', 'myplugin_callback' );
   
   //Menulinks
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_menu_whats', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_menu_tel', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_menu_dir', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_menu_mail', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_menu_insta', 'myplugin_callback' );
   register_setting( 'nubicommerce_ajustes_cliente', 'nubicommerce_menu_fb', 'myplugin_callback' );

   
}
add_action( 'admin_init', 'myplugin_register_settings' );


function myplugin_options_page(){
?>

<div class="paginaopciones">
<style type="text/css">
   input[type="text"]{
      width: 500px !important;
   }
   tr{
text-align:left;
}
</style>


<h2>Opciones Ecommerce</h2>
<form method="post" action="options.php">
<?php settings_fields( 'myplugin_options_group' ); ?>
<table>
<tr valign="top">
<th scope="row"><label for="briziolabz_defaultoptions">Reset Ecommerce Options</label></th>
<td><input type="checkbox" id="briziolabz_defaultoptions" name="briziolabz_defaultoptions" value="1"<?php checked( 1 == get_option('briziolabz_defaultoptions') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="cant_catalogo">Cant Productos Catalogo</label></th>
<td><input type="text" id="cant_catalogo" name="cant_catalogo" value="<?php echo get_option('cant_catalogo'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="texto_comprar">Texto Boton Comprar</label></th>
<td><input type="text" id="texto_comprar" name="texto_comprar" value="<?php echo get_option('texto_comprar'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_sintock_label">Texto Sin Stock</label></th>
<td><input type="text" id="nubicommerce_sintock_label" name="nubicommerce_sintock_label" value="<?php echo get_option('nubicommerce_sintock_label'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_enstock_label">Texto Con Stock</label></th>
<td><input type="text" id="nubicommerce_enstock_label" name="nubicommerce_enstock_label" value="<?php echo get_option('nubicommerce_enstock_label'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="ml_id">ML ID</label></th>
<td><input type="text" id="ml_id" name="ml_id" value="<?php echo get_option('ml_id'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="wpallimport_id">Importer ID</label></th>
<td><input type="text" id="wpallimport_id" name="wpallimport_id" value="<?php echo get_option('wpallimport_id'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="taxomizerwpai">Taxomizer</label></th>
<td>
<input type="checkbox" id="taxomizerwpai" name="taxomizerwpai" value="1"<?php checked( 1 == get_option('taxomizerwpai') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="sendy_list">Sendy List</label></th>
<td>
<input type="text" id="sendy_list" name="sendy_list" value="<?php echo get_option('sendy_list'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="orden_minima">Orden Minima</label></th>
<td>
<input type="text" id="orden_minima" name="orden_minima" value="<?php echo get_option('orden_minima'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="orden_minima_segunda">Orden Minima Segunda</label></th>
<td>
<input type="text" id="orden_minima_segunda" name="orden_minima_segunda" value="<?php echo get_option('orden_minima_segunda'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_banner_superior">Banner superior PNG </label></th>
<td>
<input type="text" id="nubicommerce_banner_superior" name="nubicommerce_banner_superior" value="<?php echo get_option('nubicommerce_banner_superior'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_banner_superior_link">Banner superior link </label></th>
<td>
<input type="text" id="nubicommerce_banner_superior_link" name="nubicommerce_banner_superior_link" value="<?php echo get_option('nubicommerce_banner_superior_link'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="checkout_message">Checkout Message </label></th>
<td>
<input type="text" id="checkout_message" name="checkout_message" value="<?php echo get_option('checkout_message'); ?>" />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_damelosroles">Roles Custom  </label></th>
<td>
<input type="text" id="nubicommerce_damelosroles" name="nubicommerce_damelosroles" value="<?php echo get_option('nubicommerce_damelosroles'); ?>" />
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="theme_css_shopier">CSS Theme</label></th>
<td>
<input type="checkbox" id="theme_css_shopier" name="theme_css_shopier" value="1"<?php checked( 1 == get_option('theme_css_shopier') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="redirect_checkout">Redireccionar Checkout</label></th>
<td>
<input type="checkbox" id="redirect_checkout" name="redirect_checkout" value="1"<?php checked( 1 == get_option('redirect_checkout') ); ?> />
</td>
</tr>

<tr valign="top">
<th scope="row"><label for="nubicommerce_imagenes_run">Fix Imagenes  </label></th>
<td>
<input type="checkbox" id="nubicommerce_imagenes_run" name="nubicommerce_imagenes_run" value="1"<?php checked( 1 == get_option('nubicommerce_imagenes_run') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_mantenimiento">Mantenimiento (refrescar cache luego)</label></th>
<td>
<input type="checkbox" id="nubicommerce_mantenimiento" name="nubicommerce_mantenimiento" value="1"<?php checked( 1 == get_option('nubicommerce_mantenimiento') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_modulo_bulkterms">Bulk Terms </label></th>
<td>
<input type="checkbox" id="nubicommerce_modulo_bulkterms" name="nubicommerce_modulo_bulkterms" value="1"<?php checked( 1 == get_option('nubicommerce_modulo_bulkterms') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_modulo_enquiry">Product Enquiry</label></th>
<td>
<input type="checkbox" id="nubicommerce_modulo_enquiry" name="nubicommerce_modulo_enquiry" value="1"<?php checked( 1 == get_option('nubicommerce_modulo_enquiry') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_modulo_enquiry_loggin">Product Enquiry Logged in</label></th>
<td>
<input type="checkbox" id="nubicommerce_modulo_enquiry_loggin" name="nubicommerce_modulo_enquiry_loggin" value="1"<?php checked( 1 == get_option('nubicommerce_modulo_enquiry_loggin') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_modulo_enquiry_redirect">Product Enquiry Redirect (successform)</label></th>
<td>
<input type="checkbox" id="nubicommerce_modulo_enquiry_redirect" name="nubicommerce_modulo_enquiry_redirect" value="1"<?php checked( 1 == get_option('nubicommerce_modulo_enquiry_redirect') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_modulo_500kb">500kb limite</label></th>
<td>
<input type="checkbox" id="nubicommerce_modulo_500kb" name="nubicommerce_modulo_500kb" value="1"<?php checked( 1 == get_option('nubicommerce_modulo_500kb') ); ?> />
</td>
</tr>
</table>


<?php  submit_button(); ?>
</form>
<h1 AYUDA ></h1>
<textarea width="600px">
<a href="https://www.mercadopago.com.ar/promociones" target="_blank"><img src="/wp-content/plugins/briziolabz-plugin/assets/img/mp.png" class="noborrar"></a>
</textarea><br>
Copiar en mercadopago
<br><br><br>
[horariosshort]
</div>
<?php
} 




function mails_page(){
?>
<div class="paginaopciones">
<style type="text/css">
   input[type="text"]{
      width: 500px !important;
   }
   textarea {
  width: 100%;
  height: 150px;
}
tr{
text-align:left;
}
</style>


<h2>Mails </h2>
<form method="post" action="options.php">
<?php settings_fields( 'nubicommerce_ajustes_cliente' ); ?>
<table>
<tr valign="top">
<th scope="row"><label for="nubicommerce_desde_nombre">Desde Nombre</label></th>
<td>
<input type="text" id="nubicommerce_desde_nombre" name="nubicommerce_desde_nombre" value="<?php echo get_option('nubicommerce_desde_nombre'); ?>" />
*Nombre con el cual les va a llegar a los clientes
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_destinos_mail">Recipiente/s </label></th>
<td>
<input type="text" id="nubicommerce_destinos_mail" name="nubicommerce_destinos_mail" value="<?php echo get_option('nubicommerce_destinos_mail'); ?>"  />
*A que mails se van a enviar todas las notificaciones, separar mails con "," comas.
</td>
</tr>
</table>

<h2>Popup </h2>
<table>
<tr valign="top">
<th scope="row"><label for="nubicommerce_popup">Activar Popup </label></th>
<td>
<input type="checkbox" id="nubicommerce_popup" name="nubicommerce_popup" value="1"<?php checked( 1 == get_option('nubicommerce_popup') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_popup_img">Imagen</label></th>
<td>
<input type="text" id="nubicommerce_popup_img" name="nubicommerce_popup_img" value="<?php echo get_option('nubicommerce_popup_img'); ?>" />
*Formato recomendado 500x500 jpg
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_popup_link">Link</label></th>
<td>
<input type="text" id="nubicommerce_popup_link" name="nubicommerce_popup_link" value="<?php echo get_option('nubicommerce_popup_link'); ?>" />
</td>
</tr>
</table>
<h2>Links Mobile Menu </h2>
<table>
<tr valign="top">
<th scope="row"><label for="nubicommerce_menu_mail">Mail</label></th>
<td>
<input type="text" id="nubicommerce_menu_mail" name="nubicommerce_menu_mail" value="<?php echo get_option('nubicommerce_menu_mail'); ?>"  />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_menu_dir">Dirrección</label></th>
<td>
<input type="text" id="nubicommerce_menu_dir" name="nubicommerce_menu_dir" value="<?php echo get_option('nubicommerce_menu_dir'); ?>"  />
*Link google maps
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_menu_whats">Whatsapp</label></th>
<td>
<input type="text" id="nubicommerce_menu_whats" name="nubicommerce_menu_whats" value="<?php echo get_option('nubicommerce_menu_whats'); ?>"  />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_menu_tel">Teléfono</label></th>
<td>
<input type="text" id="nubicommerce_menu_tel" name="nubicommerce_menu_tel" value="<?php echo get_option('nubicommerce_menu_tel'); ?>"  />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_menu_fb">Link Facebook</label></th>
<td>
<input type="text" id="nubicommerce_menu_fb" name="nubicommerce_menu_fb" value="<?php echo get_option('nubicommerce_menu_fb'); ?>"  />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_menu_insta">Link Instagram</label></th>
<td>
<input type="text" id="nubicommerce_menu_insta" name="nubicommerce_menu_insta" value="<?php echo get_option('nubicommerce_menu_insta'); ?>"  />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="nubicommerce_menu_insta">Horarios de Atención</label></th>
<td>
<input type="text" id="horarios" name="horarios" value="<?php echo get_option('horarios'); ?>" placeholder="" />
</td>
</tr>
</table>
<h2>Integraciónes </h2>
<table width="500">
<tr valign="top" >
<td>
<textarea id="ihaf_insert_header" name="ihaf_insert_header" width="100%"   ><?php echo get_option('ihaf_insert_header'); ?></textarea>
Scripts en el Header (Debajo de < head >)
</td>
</tr>
<tr valign="top">
<td>
<textarea id="ihaf_insert_footer" name="ihaf_insert_footer" width="100%"   ><?php echo get_option('ihaf_insert_footer'); ?></textarea>
Scripts en el Footer (luego de < body >)
</td>
</tr>

</table>

<?php  submit_button(); ?>
</form>
</div>
<?php
} 


function exitofile_page(){
?>
<div class="paginaopciones">
<style type="text/css">
.paginaopciones{
text-align:center;
}
</style>
<img src="<?php echo home_url().'/wp-content/plugins/briziolabz-plugin/assets/img/exitofile.png';?>" width="600">
</div>
<?php
} 

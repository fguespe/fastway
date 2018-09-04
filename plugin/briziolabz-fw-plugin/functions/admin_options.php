<?php
function myplugin_register_settings() {

   add_option( 'sendy_list', 'ID');
   add_option( 'wpallimport_id', '1');
   add_option( 'taxomizerwpai', '0');
   add_option( 'ml_id', '');
   add_option( 'update_plugins', '0');
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
   register_setting( 'myplugin_options_group', 'home_redirect', 'myplugin_callback' );

   //Colores

   
   
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
<th scope="row"><label for="nubicommerce_damelosroles">Roles Custom  </label></th>
<td>
<input type="text" id="nubicommerce_damelosroles" name="nubicommerce_damelosroles" value="<?php echo get_option('nubicommerce_damelosroles'); ?>" />
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

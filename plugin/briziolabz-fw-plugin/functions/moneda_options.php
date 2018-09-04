<?php
function moneda_fields() {
   add_option( 'conversion_usd', '1');
   add_option( 'conversion_eur', '1');
   add_option( 'conversion_ars', '1');
   add_option( 'mostrar_moneda', '0');
   register_setting( 'conversor_moneda_grupo', 'conversion_usd', 'myplugin_callback' );
   register_setting( 'conversor_moneda_grupo', 'conversion_eur', 'myplugin_callback' );
   register_setting( 'conversor_moneda_grupo', 'conversion_ars', 'myplugin_callback' );
   register_setting( 'conversor_moneda_grupo', 'mostrar_moneda', 'myplugin_callback' );
}
add_action( 'admin_init', 'moneda_fields' );


function page_moneda()
{
?>
<div class="paginaopciones">
<style type="text/css">
   input[type="text"]{
      width: 500px !important;
   }
</style>

<h2>Opciones</h2>

<form method="post" action="options.php">
<?php settings_fields( 'conversor_moneda_grupo' ); ?>
<table>
<tr valign="top">
<th scope="row"><label for="briziolabz_defaultoptions">Mostrar Moneda </label></th>
<td><input type="checkbox" id="briziolabz_defaultoptions" name="briziolabz_defaultoptions" value="1"<?php checked( 1 == get_option('briziolabz_defaultoptions') ); ?> />
</td>
</tr>
<tr valign="top">
<th scope="row"><label for="ml_id">ML ID</label></th>
<td><input type="text" id="ml_id" name="ml_id" value="<?php echo get_option('ml_id'); ?>" />
</td>
</tr>
</table>
<?php  submit_button(); ?>
</form>
</div>
<?php
} 



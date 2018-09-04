<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$retrieved_nonce = $_REQUEST['_wpnonce'];
if (wp_verify_nonce($retrieved_nonce, 'my_delete_action' ) ) {
if( isset($_POST['info_update']) ) {
	$new_options = $_POST['wcadata'];
	//echo json_encode($new_options);
	foreach($new_options as $key => $value) {
		$new_options[$key] = htmlentities(stripslashes($value));
	}
	update_option( 'plugin_clientarea_settings', $new_options);
	echo '<div id="message" class="updated fade"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
}if( isset($_POST['reset']) ) {
my_plugin_activation(true);
}
}
?>
<style type="text/css">
	.largos{
		width: 600px !important;
	}
</style>
<div class="wrap">
	<form method="post">
		<?php wp_nonce_field('my_delete_action'); ?>
		<h2>Client Area Options</h2>
		<h3>Default Menu Items</h3>
		<div class="submit">
			<input type="submit" name="reset" value="Reset" />
		</div>
		<fieldset >
			<legend></legend>
			<ul style="list-style-type: none;">
				<?php
				$options2=wca_getmetheoptions("var");
				$ultimo=end($options2);
				foreach ($options2 as $i) {
				?>
				<li id="var_<?=$i?>">
					Active: <select id="var_<?=$i?>_check" name="wcadata[var_<?=$i?>_check]"><option value="on" <?php if(wca::get_checko('var_'.$i.'_check')) echo 'selected="selected"'; ?> >On</option><option value="off"  <?php if(wca::get_checko('var_'.$i.'_check')) echo 'selected="selected"'; ?> >Off</option></select>
					Label: <input type="text" name="wcadata[var_<?=$i?>_label]" placeholder="Label" value="<?php echo wca::get_texto('var_'.$i.'_label'); ?>" id="var_<?=$i?>_label" />
					Font Awesome Icon (content): <input type="text" name="wcadata[var_<?=$i?>_icon]" placeholder="FontIcon" value="<?php echo wca::get_texto('var_'.$i.'_icon'); ?>" id="var_<?=$i?>_icon" />
					Link: <input type="text" name="wcadata[var_<?=$i?>_link]" placeholder="Link url after wp-admin/" value="<?php echo wca::get_texto('var_'.$i.'_link'); ?>" id="var_<?=$i?>_link" />
					<?php if($i>11)echo "<a onclick='borrarfila(".$i.")'>X</a>"; ?>
				</li>
				<?}?>
				<div id="nuevasfilas"></div>
				<button type="button" onclick="agregarfila()">Add</button>
				<script type="text/javascript">
					var ultimo=<?=$ultimo;?>;
					function borrarfila(i){
						jQuery("#var_"+i).remove();
					}
					function agregarfila(){
						ultimo++;
						alert(ultimo);
						jQuery("#nuevasfilas").append('<li id="var_'+ultimo+'">Active: <select id="var_'+ultimo+'_check" name="wcadata[var_'+ultimo+'_check]"><option value="on">On</option><option value="off">Off</option></select> Label: <input type="text" name="wcadata[var_'+ultimo+'_label]" placeholder="Label"  id="var_'+ultimo+'_label" /> Font Awesome Icon (content): <input type="text" name="wcadata[var_'+ultimo+'_icon]" placeholder="FontIcon" id="var_'+ultimo+'_icon" /> Link: <input type="text" name="wcadata[var_'+ultimo+'_link]" placeholder="Link url after wp-admin/"  id="var_'+ultimo+'_link" /><a onclick="borrarfila('+ultimo+')">X</a></li>');
					}
				</script>
				<br><br><h3>Color Settings</h3>
				<li>
					<label>Main Color </label><input type="text" name="wcadata[main_color]" placeholder="Admin Favi" value="<?php echo wca::get_texto('main_color'); ?>" id="main_color" /> Hexa color code
				</li>
				<li>
					<label>Text Color </label><input type="text" name="wcadata[text_color]" placeholder="Admin Favi" value="<?php echo wca::get_texto('text_color'); ?>" id="text_color" /> Hexa color code
				</li>
				<li>
					<label>Icon Color </label><input type="text" name="wcadata[icon_color]" placeholder="Admin Favi" value="<?php echo wca::get_texto('icon_color'); ?>" id="icon_color" /> Hexa color code
				</li>
				

				<br><br><h3>General Settings</h3>
				<li>
					<label>Client Logo </label><input class="largos" type="text" name="wcadata[client_logo]" placeholder="Client Logo" value="<?php echo wca::get_texto('client_logo'); ?>" id="client_logo" /> Url of image
				</li>
				<li>
					<label>Admin Logo </label><input class="largos" type="text" name="wcadata[admin_logo]" placeholder="Admin Logo" value="<?php echo wca::get_texto('admin_logo'); ?>" id="admin_logo" /> Url of image
				</li>
				<li >
					<label>Admin Favicon </label><input class="largos" type="text" name="wcadata[admin_favi]" placeholder="Admin Favi" value="<?php echo wca::get_texto('admin_favi'); ?>" id="admin_favi" /> Url of image
				</li>

				<br><br><h3>Other Settings</h3>
				<li>
					<label>Home Redirect</label><br> Active: <input type="checkbox" name="wcadata[var_<?=$i?>_check]" <?php if(wca::get_checko('home_redirect')) echo 'checked'; ?> id="var_<?=$i?>_check" />  URL:<input class="largos" type="text" name="wcadata[home_redirect]" placeholder="Home redirect url" value="<?php echo wca::get_texto('home_redirect'); ?>" id="home_redirect" /> 
				</li>
				

				<br><br><h3>Metaboxes </h3>
				<?php
				$options2=wca_getmetheoptions("custommetabox");
				$ultimometa=end($options2);
				foreach ($options2 as $i) {
				?>
				<li id="custommetabox_<?=$i?>">
					<label>Name: </label><input type="text" name="wcadata[custommetabox_<?=$i?>_label]" placeholder="Title" value="<?php echo wca::get_texto('custommetabox_'.$i.'_label'); ?>" id="custommetabox_<?=$i?>_label" />
					<textarea cols="150" rows="10" name="wcadata[custommetabox_<?=$i?>_text]" placeholder="Content (HTML CODE)"  id="custommetabox_<?=$i?>_text" ><?php echo wca::get_texto('custommetabox_'.$i.'_text');?></textarea>
				<?php if($i>1) echo '<br><button type="button" onclick="borrarmeta('.$i.')">Remove</button>'?>
				</li>
				<?}?>
				<div id="nuevasmetas"></div>
				<button type="button" onclick="agregarmeta()">Add</button>
				<script type="text/javascript">
					var ultimometa=<?=$ultimometa;?>;
					function borrarmeta(i){
						jQuery("#custommetabox_"+i).remove();
					}
					function agregarmeta(){
						ultimometa++;
						jQuery("#nuevasmetas").append('<li id="custommetabox_'+ultimometa+'"><label>Name: </label><input type="text" name="wcadata[custommetabox_'+ultimometa+'_label]" placeholder="Title" id="custommetabox_'+ultimometa+'_label" /><textarea cols="150" rows="10" name="wcadata[custommetabox_<?=$i?>_text]" placeholder="Content (HTML CODE)"  id="custommetabox_'+ultimometa+'_text" ></textarea><br><button type="button" onclick="borrarmeta('+ultimometa+')">Remove</button></li>');
					}
				</script>


				<br><br><h3>Custom CSS</h3>
				
				<li >
					<textarea cols="150" rows="10" name="wcadata[custom_admin_css]" placeholder="CSS CODE"  id="custom_admin_css" ><?php echo wca::get_texto('custom_admin_css');?></textarea>
				</li>
			</ul>
		</fieldset>
		<div class="submit">
			<input type="submit" name="info_update" value="<?php _e('Update options', 'wca'); ?> &raquo;" />
		</div>
	</form>
</div>
<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', 1);
$new_options = $_POST['wcadata'];
if(isset($new_options["var_11_link"])){
$jaja=$new_options["var_11_link"];	
echo $jaja.'<br>';
echo sanitize_text_field($jaja).'<br>';
echo stripslashes($jaja).'<br>';
echo htmlentities($jaja).'<br>';
echo htmlentities(stripslashes(sanitize_text_field($jaja)));
}
*/


?>

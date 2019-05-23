<?php



//Esto es para la pagina de opciones ,OJO, integrar altoweb.

function display_currency_element(){
	?>
    	<input type="text" name="fw_currency_conversion" id="fw_currency_conversion" value="<?php echo get_option('fw_currency_conversion'); ?>" />
      <span> Usar punto para decimales, no la coma.</span>
    <?php
}

function display_theme_panel_fields()
{
	add_settings_section("section", "All Settings", null, "theme-options");
	
  add_settings_field("conversion_usd", "Conversion USD", "display_currency_element", "theme-options", "section");

  register_setting("section", "fw_currency_conversion");
}

add_action("admin_init", "display_theme_panel_fields");
function theme_settings_page()
{
    ?>
	    <div class="wrap">
	    <h1>Config</h1>
	    <form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		</div>
	<?php
}
function add_theme_menu_item()
{
  add_menu_page("Config", "Config", "manage_options", "theme-panel", "theme_settings_page", null, 99);
}

add_action("admin_menu", "add_theme_menu_item");


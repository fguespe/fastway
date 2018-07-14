<?php
/*
Plugin Name: WooCommerce Category Banner
Plugin URI: http://www.wpbackoffice.com/plugins/woocommerce-category-banner/
Description: Place a custom banner and link at the top of your product category pages. Easily update the image through your product category edit page.
Version: 1.1.2
Author: WP BackOffice
Author URI: http://www.wpbackoffice.com
*/ 

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WCB_Category_Banner' ) ) :

class WCB_Category_Banner {
	
	public function __construct() {

		global $woocommerce;
		global $wp_query;

		// Add Scripts and styles		
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts_and_styles' ) );
		
		// Add the fields to the product cateogry taxonomy 
		add_action( 'product_cat_edit_form_fields', array( $this, 'wcb_product_cat_taxonomy_custom_fields' ), 10, 2 );  
		  
		// Save the changes made on the product category taxonomy 
		add_action( 'edited_product_cat', array( $this, 'wcb_product_cat_save_taxonomy_custom_fields'), 10, 2 );  

		// Add a banner image based on category taxonomy image, only if it's set to auto show (default)
		add_action( 'woocommerce_before_main_content', array( $this, 'wcb_show_category_banner'), 30 );

	}

	/*
	*	Adds necessary admin scripts
	*/
	public function admin_scripts_and_styles() {
		
		// Get current screen attributes
		$screen = get_current_screen();
		
		if ( $screen != null and $screen->id == "edit-product_cat" ) {
			
			// Adds WP Modal Window References			
			wp_enqueue_media();
			
			// Enque the script
			wp_enqueue_script( 'wcb_admin_script',
				plugin_dir_url( __FILE__ ) . 'assets/js/wcb-admin.js',
				array('jquery'), '1.0.0', true
			);
			
			// Add Style
			wp_enqueue_style( 
				'wcb_admin_styles', 
				plugins_url( '/assets/css/wcb-admin.css', __FILE__ )
			);
		}
	}

	/*
	*	Adds default option values
	*/	
	public function wcb_product_cat_taxonomy_custom_fields( $tag ) {

		// Check for existing taxonomy meta for the term you're editing  
	    $t_id = $tag->term_id; // Get the ID of the term you're editing  
	    $term_meta = get_option( "taxonomy_term_$t_id" ); // Do the check  
	    
	    // Get banner image
	    if ( isset( $term_meta['banner_url_id'] ) and $term_meta['banner_url_id'] != '' )
    	    $banner_id = $term_meta['banner_url_id'];
	    else 
    	    $banner_id = null;
    	    
    	// Get banner link 
    	if ( isset( $term_meta['banner_link'] ) and $term_meta['banner_link'] != '' )
    		$banner_link = $term_meta['banner_link'];
    	else 
    	    $banner_link = null;
    	  
    	// Get auto display setting.
		if ( (isset( $term_meta['auto_display_banner']) && $term_meta['auto_display_banner'] == 'on') || !isset( $term_meta['auto_display_banner']) ) {
			$auto_display_banner = true;
		} else {
			$auto_display_banner = false;
		}

	    ?>  
	    
		<tr class="form-field banner_url_form_field">  
		    <th scope="row" valign="top">  
		        <label for="banner_url"><?php _e('Image de encabezado'); ?></label>  
		    </th>  
		    <td>  
		    	<fieldset>
					<a class='wcb_upload_file_button button' uploader_title='Select File' uploader_button_text='Include File'>Cargar</a>
					<a class='wcb_remove_file button'>Eliminar</a>
					<label class='banner_url_label' ><?php if ( $banner_id != null ) echo basename( wp_get_attachment_url( $banner_id ) ) ?></label>
		    	</fieldset>
		    	
		    	<fieldset>				
					<img class="cat_banner_img_admin" src="<?php if ( $banner_id != null ) echo wp_get_attachment_url( $banner_id ) ?>" />
		    	</fieldset>
		    	
				<input type="hidden" class='wcb_image' name='term_meta[banner_url_id]' value='<?php if ( $banner_id != null ) echo $banner_id; ?>' />
			</td>  
		</tr>  
		
		<tr class="form-field banner_link_form_field">  
		    <th scope="row" valign="top">  
		        <label for="banner_link"><?php _e('Link de imagen'); ?></label>  
		    </th>  
		    <td>  
		    	<fieldset>	
					<input type="url" name='term_meta[banner_link]' value='<?php if ( $banner_link != null ) echo $banner_link ?>' />		
					<label class="banner_link_label" for="banner_link"><em>El link a donde llevara a la gente</em></label>		
		    	</fieldset>
			</td>  
		</tr> 
		<!--
		<tr class="form-field auto_display_banner">  
		    <th scope="row" valign="top">  
		        <label for="auto_display_banner"><?php _e('Automatically insert banner above main content'); ?></label>  
		    </th>  
		    <td>  
		    	<fieldset>
		    	<input name="term_meta[auto_display_banner]" type="checkbox" value="on" class="auto_display_banner" <?php if($auto_display_banner) echo " checked "; ?>/>
				<label class="auto_display_banner_label" for="auto_display_banner"><em>If you want to display the banner in a custom spot on your category page, you can deselect this checkbox and use the wcb_show_category_banner() in your category template to dictate where it will appear.</em></label>		
		    	</fieldset>
			</td>  
		</tr> 
	-->
		  
	<?php  
	}
	
	// A callback function to save our extra taxonomy field(s)  
	public function wcb_product_cat_save_taxonomy_custom_fields( $term_id ) {  
	        
	    if ( isset( $_POST['term_meta'] ) ) {  
	        $t_id = $term_id;  
	        $term_meta = get_option( "taxonomy_term_$t_id" );  
	        $posted_term_meta = $_POST['term_meta'];

	        if(!isset($posted_term_meta['auto_display_banner']))
	        	$posted_term_meta['auto_display_banner'] = 'off';

	        $cat_keys = array_keys( $posted_term_meta );  

	        foreach ( $cat_keys as $key ){  
	            if ( isset( $posted_term_meta[$key] ) ){  
	                $term_meta[$key] = $posted_term_meta[$key];  
	            }  
	        }  
	        //save the option array  
	        update_option( "taxonomy_term_$t_id", $term_meta );  
	    }
	}
	
	// Retreives and print the category banner
	public function wcb_show_category_banner() {
		global $woocommerce;
		global $wp_query;

		// Make sure this is a product category page
		if ( is_product_category() ) {
			$cat_id = $wp_query->queried_object->term_id;

			$term_options = get_option( "taxonomy_term_$cat_id" );

			if((isset($term_options['auto_display_banner']) && $term_options['auto_display_banner'] == 'on') || !isset($term_options['auto_display_banner'])) {
				// Get the banner image id
				if ( $term_options['banner_url_id'] != '' )
					$url = wp_get_attachment_url( $term_options['banner_url_id'] ); 

				// Exit if the image url doesn't exist
				if ( !isset( $url ) or $url == false )
					return;

				// Get the banner link if it exists
				if ( $term_options['banner_link'] != '' )
					$link = $term_options['banner_link'];

				// Print Output
				if ( isset( $link ) )
					echo "<a href='" . $link . "'>"; 
			
				if ( $url != false ) 
					echo "<img src='" . $url . "' class='category_banner_image' />";
			
				if ( isset( $link ) )
					echo "</a>";

			}
		}
	}
}

endif;

$WCB_Category_Banner = new WCB_Category_Banner();

//Shortcode function for displaying banner.
function wcb_show_category_banner() {
	global $WCB_Category_Banner;
	$WCB_Category_Banner->wcb_show_category_banner(); //disable the only show for category tag.
}

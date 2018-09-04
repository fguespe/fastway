<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
function wca_custom_admincss() {
echo '<style type="text/css">
:root{
    --main-color: '.get_option('plugin_clientarea_settings')["main_color"].' ;
    --second-color: #F9FAFA;
    --background-color: #F9FAFA;
    --text-color: '.get_option('plugin_clientarea_settings')["text_color"].' ;
    --icon-color: '.get_option('plugin_clientarea_settings')["icon_color"].' ;
}
body{
	background: var(--background-color) !important;
}
/*MENSAJE ERROR*/
.error{
	display: none !important;
}

.estiloiconomenu{
	color: var(--text-color) !important;
}


/*ICONOS*/
.titulo-Logout:before{
	content: "\f08b";
}

.faviconizq{
	background: var(--background-color) !important;
	padding:0px !important;
}
.faviconizq img{
	width:30px !important;
	vertical-align:middle !important;
	padding:0px !important;
}
/*MERCADOLIBRE*/
#jetpack_summary_widget,#woosync_dashboard_widget,#woosync_dashboard_status_widgets,#wp_ml_syncbox{
display:none !important;
}

.paginaopciones{
	margin-left:20px;
}
.woocommerce-BlankState a{
	display: none !important;
	visibility:hidden !important;
}
/*GRAVITY ENTRYES*/
.gf_dashboard_noforms_notice{
	display:none !important;
}
#gf_form_toolbar,#gform_settings_page_title,#form_switcher_arrow,.gf_admin_page_formid{
display:none !important;
}
.gf_dashboard_button{
	display: none !important;
}
.gf_entry_detail_pagination{
display:none !important;
}
/*THEME- NOTICIAS - BLOG . PAGINAS*/
#nth_page_config,#pageparentdiv{
	display: none !important;
}
/*MENU SUPERIOR*/
.estiloiconomenu:before{
	font-family: "FontAwesome" !important;
    color:var(--icon-color) !important;
	text-align:center !important;
	line-height:25px !important;
	font-size:18px !important;
}
.estiloiconomenu:after{
	font-family: "FontAwesome" !important;
    color: var(--second-color)  !important;
	text-align:center !important;
	line-height:25px !important;
	font-size:12px !important;
}
.estiloiconomenu{
	border-right:1px solid white !important;
}

.titulo-:hover{
background: none !important;
}
/*Optiones de Pantalla*/
.cupones #screen-options-link-wrap,.altamayoristas #screen-options-link-wrap,.mnus #screen-options-link-wrap,.escritorio #screen-options-link-wrap,.slider #screen-options-link-wrap,.slider #screen-options-switch-view-wrap{
	display: none !important;
}
/*MAS DEL MENU*/
/*
.menus .page-title-action,.menus .add-new-menu-action,.menus .add-edit-menu-action{
	display: none !important;
}
*/


/*reportes*/
.subsubsub{
margin-top:10px !important;
}
.subsubsub a{
font-size: 15px ;
}

#wpe_dify_news_feed{
display:none !important;
}
/*
.menus .submitdelete{
	display: block !important;
}
*/
.menus .page-title-action{
	display: none;
}
.nth-adv-menu-opts{
	display: none;
}

.description-thin:nth-child(2),.description-thin:nth-child(8),.description-thin:nth-child(9){
	
	display:none;
}
#adv-settings .metabox-prefs:nth-child(2){
	display:none;
}

/*AYUDA*/
#contextual-help-link-wrap{
	display: none;
}

/*CORE*/
.wp-core-ui .button-primary{
	color:white !important;
	background: var(--main-color);
	border:0px !important;
	border-radius:0px;
	text-shadow:none !important;
	box-shadow:none;
}
.wp-core-ui .button-primary.disabled{
	background: var(--second-color) !important;
	color:white !important;
	border:0px !important;
}
.wp-core-ui .button-primary:hover{
	color: black !important;
	background: var(--main-color);
}

#wpbody-content a {
	color: var(--main-color) !important;
}
#wpbody-content a:hover {
	color: var(--main-color) !important;
}


/*TOPBAR*/

#wp-admin-bar-site-name,#wp-admin-bar-gform-forms,#wp-admin-bar-my-account,#wp-admin-bar-itsec_admin_bar_menu,#wp-admin-bar-my-sites,#wp-admin-bar-wp-rocket,#wp-admin-bar-archive,#wp-admin-bar-wp-logo,#wp-admin-bar-comments,#wp-admin-bar-new-content{
	 display: none !important
}
/*EXPORTAR IMPORTAR*/
 .wrap .page-title-action:nth-child(4), .wrap .page-title-action:nth-child(3){
display:none;
}
#wp-admin-bar-updates,#wp-admin-bar-woffice_settings,#wp-admin-bar-tribe-events,#wp-admin-bar-bp-notifications,#wp-admin-bar-updraft_admin_node{
	display: none !important;
}


 /*ADMIN BAR #wp-admin-bar-menu-toggle*/
#wpadminbar,#adminmenumain{
	background-color: var(--main-color);
}
@media (min-width: 782px) {
	#adminmenumain{
		display:none;
	}


}
#adminmenuback,#adminmenuwrap,#adminmenu,#wp-admin-bar-menu-toggle a,#wp-admin-bar-menu-toggle .ab-icon:before,#wp-admin-bar-menu-toggle .ab-icon{
	background-color: var(--main-color) !important;
	color: white !important;
}
.wp-menu-name{
padding-left:0px !important;
margin-left:5px !important;
text-align:left !important;
}
/*
#wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item{
	background:var(--background-color)!important;
	color: var(--second-color) !important;
}
#wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus, #wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item, #wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus{
background:var(--background-color)!important;
	color: var(--second-color) !important;
}
*/
#adminmenu li:not(.menu-icon-generic),.toplevel_page_woocommerce,.dashicons-before,.wp-menu-arrow{
	display:none;
}
#woocommerce_dashboard_status h2,
#woocommerce_dashboard_status button{
display:none !important;
}

/*DASHBOARDS*/
#redux_dashboard_widget,#sendgrid_statistics_widget,#woocommerce_network_orders{
 display:none !important;
}




.fade,.update-nag,.update,.updated,.notice,.woocommerce-BlankState-cta{
display:none !important;
}
.notice-success{
display:block!important;
}

#wpcontent{
margin-left:0px !important;
}



#wpcontent,#wpfooter{
	margin-left: 0px !important;
	padding-left: 0px !important;
	margin: 0px !important;
	padding: 0px !important;

}
#vc_license-activation-notice,.update-nag,.fade{
	display: none;
}
.wrap{
	margin: 10px 20px 0 20px;
}



/*WPALLIMPORT*/
.wpallimport-logo,.wpallimport-title,.wpallimport-links,.wpallimport-section,.wpallimport-created-by,.confirm a,.wpallimport-complete-success,#import_finished a
{
	display:none !important;
}
.wpallimport-ready-to-go h4{
	visibility: hidden !important;
}
form.confirm{
display:none;
}
.wpallimport-content-section form{
	display:block !important;

}

.wpallimport-plugin .wpallimport-wrapper {
    width: 100% !important;
}

.woo-nav-tab-wrapper{
	display:none;
}




/*MENUS*/

.menu-settings,.menus .nav-tab-wrapper{
	display: none !important;
}

.menus h1 a{
	display: none;
}
/*PRODUCTOS*/
#wp-content-editor-tools{
	background-color: none !important;
}
/*SUscRIPCION?*/
._mp_recurring_is_recurrent_field,._mp_recurring_frequency_field ,._mp_recurring_frequency_type_field,._mp_recurring_end_date_field{
	display: none;
}
#wp-content-media-buttons a{
	display:none;
}
/*CLASE ENVIOS*/
#shipping_product_data div:nth-child(2){
	display:none !important;
}

/*PESTAÑAS*/
.nth_custom_tab_options,.wcwl_waitlist_tab,.advanced_options{
	display:none !important;
}

/*ICONITO VIDEO*/
#woocommerce-product-data ul.product_data_tabs li.nth_videos_tab a:before{
	content: "\f1c8" !important;
	font-family: "FontAwesome" !important;

}
/*DESACTIVAR PESTANIA CONSULTA*/
.woocommerce_disable_product_enquiry_field{
	display: none;
}
/*BOTON NUEVO*/
.wrap .page-title-action:hover{
background:white;
border: none;
border-radius:0px;

}


/*PRICES BY USER ROLE*/
.festi-user-role-prices-product-tab {
	display: none !important;
}
/*USUARIOS*/
form#your-profile table:nth-child(6),form#your-profile h2:nth-child(11),form#your-profile h2:nth-child(5),form#your-profile table:nth-child(12){
display:none !important;
}
#adduser{
	display:none;
}
/*YOAST SEO*/
.wpseo-tab-video-container,.wpseo-metabox-buy-premium{
display:none !important;
}
.yoast-seo-score{
display:none;
}

/**FOOTER*/

#footer-upgrade{
	display:none;
}
/*ROCKET*/
.rocket_purge,#rocket_post_exclude{
	display: none !important;
}
/*VIUSAL EN PRODUCTOS*/
.productos .edit_vc,.composer-switch{
	display: none !important;
}
#wp-excerpt-media-buttons a{
	display: none !important;
}
/*REVIEW PRO*/
#tagsdiv-product_review_qualifier{
	display: none !important;
}
/*DESCARGAS*/
._wc_product_documents_title_field,._wc_product_documents_display_field{
	display: none !important;
}

/*UP SELLS*/
#linked_product_data div:nth-child(1) p:nth-child(1){
	display:none;
}


/*DESCRIPCION (TEXTAREA) QUE NO SE USA*/
.categorias .term-description-wrap,.atributos .term-description-wrap,.escritorio .term-description-wrap,.etiquetas .term-description-wrap{
	display:none;
}

.categorias .term-thumbnail-wrap,.categorias #wc_catalog_restrictions{
display:none !important;

}

form#addtag div:nth-child(1),form#addtag div:nth-child(2),form#addtag div:nth-child(3){
display:none !important;
}
form#addtag div:nth-child(11) label,form#addtag div:nth-child(11) hr,form#addtag div:nth-child(11) p{
display:none !important;
}

form#addtag div:nth-child(13),
form#addtag div:nth-child(12){
display:none !important;
}
/*META SLIDER*/

.slider .metaslider-ui-top,
.slider h1,
.slider .metaslider-shortcode,
.slider .delete-slider,
.slider .ms-postbox .metaslider-preview,
.slider .ms-postbox:nth-child(2),
.slider .ms-postbox:nth-child(3),
#metaslider_configuration .inside,
.slider #create_new_tab{
display:none !important;
}

.slider .metaslider-ui .metaslider-inner,.ms-postbox, .metaslider-actions{
background:transparent !important;
border:0px !important;
}
.slider .metaslider-ui .metaslider-inner{
	border: 0px !important;
}
/*QUANTITY RULE*/
.post-type-quantity-rule #wpbo-additional-info,.post-type-quantity-rule #wpqu-company-notice,.post-type-quantity-rule #wpbo-quantity-rule-role{
	display: none;
}';
$options = get_option('plugin_clientarea_settings');
foreach (wca_getmetheoptions("var") as $i) {
	echo '.titulo-'.$i.' a:before{content: "'.$options['var_'.$i.'_icon'].'";}';
}
echo $options["custom_admin_css"];
echo '</style>';
}

?>

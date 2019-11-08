<?php
if(!is_plugin_active('kirki/kirki.php'))return;
?>
<!DOCTYPE html>
<html dir="ltr" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <?php if(fw_theme_mod('fw_seo_social') && !is_plugin_active('wordpress-seo/wp-seo.php')){ ?>
    <!-- FW SEO -->
    <meta name="description" content="<?php echo fw_theme_mod('seo-desc');?>">
    <meta name="keywords" content="<?php echo fw_theme_mod('seo-keywords');?>">
    <meta property="og:title" conten="<?php bloginfo( 'name' ); ?>">
    <meta property="og:description" content="<?php bloginfo( 'description' ); ?>">
    <meta property="og:image" content="<?php echo fw_theme_mod('social_media_image');?>">
    <meta property="og:url" content="<?php echo 'https://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>">
    <meta name="twitter:card" content="summary_large_image">
    <?php } ?>
	
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!-- APPLE -->
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <!--loading -->
    <link rel="apple-touch-startup-image" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <!--barra -->
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    
    <?php wp_head(); ?>

    <!--SOCIAL MEDIA-->
    
    <style type="text/css" id="css_editor-header"><?php echo fw_theme_mod('css_editor-header')?></style>
    <style type="text/css" id="css_editor_shop"><?php echo fw_theme_mod('css_editor_shop')?></style>
    <style type="text/css" id="css_editor_blog"><?php echo fw_theme_mod('css_editor_blog')?></style>
    <style type="text/css" id="css_editor_blog_page"><?php echo fw_theme_mod('css_editor_blog_page')?></style>
    <style type="text/css" id="css_editor-loop"><?php echo fw_theme_mod('css_editor-loop')?></style>
    <style type="text/css" id="css_loop_cat"><?php echo fw_theme_mod('css_loop_cat')?></style>
    <style type="text/css" id="css_editor-single"><?php echo fw_theme_mod('css_editor-single')?></style>
    <style type="text/css" id="css_editor-mobile"><?php echo fw_theme_mod('css_editor-mobile')?></style>
    <style type="text/css" id="css_editor-roles"><?php echo fw_theme_mod('css_editor-roles')?></style>
    <style type="text/css" id="css_loop_brand"><?php echo fw_theme_mod('css_loop_brand')?></style>
    <style type="text/css" id="css_editor-footer"><?php echo fw_theme_mod('css_editor-footer')?></style>
    <style ><?php echo fw_custom_css(); ?></style>
    <style type="text/css" id="css_editor-logged_in"><?php if(is_user_logged_in())echo fw_theme_mod('css_editor-logged_in')?></style>
    <style type="text/css" id="css_editor-admin"><?php if(current_user_can("administrator"))echo fw_theme_mod('css_editor-admin')?></style>
    <style>
        /*FIX SHIPPING*/
.cart_totals .shipping,
.cart_totals .shipping p,
.cart_totals .shipping a,
.cart_totals .shipping span,
.cart_totals .shipping input,
.cart_totals .shipping label {
  font-size: 12px !important;
}

.cart_totals .shipping-calculator-form .button {
  background: var(--main) !important;
  color: white !important;
  border: 0px;
  padding: 3px 10px 3px 10px !important;
}


.woocommerce-shipping-totals,
.woocommerce-shipping-totals  p,
.woocommerce-shipping-totals  a,
.woocommerce-shipping-totals span,
.woocommerce-shipping-totals input,
.woocommerce-shipping-totals label {
text-align:left !important;
  font-size: 11px !important;
}

.woocommerce-shipping-totals .button {
text-align:left !important;
  background: var(--main) !important;
  color: white !important;
  border: 0px;
  padding: 3px 10px 3px 10px !important;
}
</style>
    <?php echo fw_theme_mod('fw_header_scripts');?>
</head>
<body <?php body_class("page-".basename(get_permalink())); ?>>
<style>
/*
centrar menu
.fw_header.bottom.desktop #fw_menu .navbar-nav{
		margin:0 auto;
}
centrar logo o cualquier otro
.logo{
margin:0 auto !important;
}


.fw_header.bottom.desktop #fw_menu .navbar-nav > li > a{ 
padding:8px !important;
}
.fw_header.bottom.desktop #fw_menu{
		width:100%;
}

.fw_header.bottom.desktop #fw_menu .navbar-nav{
  justify-content:space-around;
}
.fw-searchform.desktop{
		width:50%;
}
*/
</style>

<header id="header">
<?php 
if(fw_theme_mod("maintainance-mode")){
    echo '<div class="maintainance-notice" style="background:red;color:white;text-align:center;"> TU WEB ESTA EN MANTENIMIENTO, LOS USUARIOS NO PODRAN VERLA </div>';
}
if(fw_theme_mod("fw_general_message")){
  echo '<div class="maintainance-notice" style="background:red;color:white;text-align:center;">'.fw_theme_mod("fw_general_message").'"</div>';
}

echo fw_header_html();
echo fw_header_html_mobile();
?>
<div class="mobile-menu-overlay d-md-none">&nbsp;</div>
<div class="menu-madre-mobile">
        <div class="sub-menu-mobile"> 
        <div class="telefono-header t1 txt-16 text-left">      
          <?php 
          if(!empty(fw_company_data("phone"))){?>   
          <a href="<?php echo fw_company_data("phone",true)?>" rel="nofollow" title="Llamar" class="btn" style="color:white !important;background:#307BFF;font-size:20px !important;"><i class="fal fa-phone" style="color:white;" aria-hidden="true"></i> <?=fw_theme_mod('fw_call_now')?></a><br>
          <?php
          } 
          if(!empty(fw_company_data("whatsapp"))){?>
          <a href="<?php echo fw_company_data("whatsapp",true)?>" rel="nofollow" title="WhatsApp" class="btn" style="color:white !important;font-size:20px !important;background:#2AD348 !important;"><i class="fab fa-whatsapp" style="color:white !important;"></i> <?=fw_theme_mod('fw_consultar')?></a>
          <?php } ?>
          
        </div>
        <div class="separa-menu-mobile">&nbsp;</div>
   
        <?php 
        echo fw_menu_vertical(array('id' => 'mobile' )); 
        $bottommneu=fw_menu_vertical(array('id' => 'mobile_bottom' )); 
        if(!empty($bottommneu)){
            echo '<div class="separa-menu-mobile">&nbsp;</div>';
            echo '<div class="mobile_bottom">'.$bottommneu.'</div>';
        }
        if(fw_theme_mod('fw-quicklinks'))quicklinks();?>
      </div>
    </div>
    <div class="collapse" id="navbarsExample02">
      <?php echo fw_search_form(3);?>
    </div>
</div>
</header>
<script >
jQuery(window).on('load', function() {
    if(jQuery(document).height()>1400){
        jQuery(window).scroll(function() {
            var sticky = jQuery('header'),
            scroll = jQuery(window).scrollTop();
            if (scroll >= 171) { 
                sticky.addClass('fw_sticky_header'); 
                jQuery('.fw_single_product .summary').addClass('fixed');
                if(<?=fw_theme_mod('darklogo_sticky')?'true':'false'?>  && <?=!empty(fw_theme_mod('dark-logo'))?'true':'false'?>){
                    jQuery('.logo .fastway-image').attr('src','<?=fw_theme_mod('dark-logo')?>');
                }
            }else{ 
                sticky.removeClass('fw_sticky_header');
                jQuery('.fw_single_product .summary').removeClass('fixed');
                if(<?=fw_theme_mod('darklogo_sticky')?'true':'false'?>){
                    jQuery('.logo .fastway-image').attr('src','<?=fw_theme_mod('general-logo')?>');
                }
            }
        });
    }
});
</script>
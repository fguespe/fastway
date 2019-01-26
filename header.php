<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
$js=fw_theme_mod('opt-ace-editor-js');
?>
<!DOCTYPE html>
<html dir="ltr" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="mobile-web-app-capable" content="yes">
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <meta name="description" content="<?php echo fw_theme_mod('seo-desc');?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
   
	<!-- APPLE -->
    <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <!--loading -->
    <link rel="apple-touch-startup-image" href="<?php echo fw_theme_mod('mobile-icon');?>">
    <!--barra -->
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    

    <?php wp_head(); ?>
    <style type="text/css" id="css_editor-general"><? echo fw_theme_mod('css_editor-general')?></style>
    <style type="text/css" id="css_editor-header"><? echo fw_theme_mod('css_editor-header')?></style>
    <style type="text/css" id="css_editor-body"><? echo fw_theme_mod('css_editor-body')?></style>
    <style type="text/css" id="css_editor-footer"><? echo fw_theme_mod('css_editor-footer')?></style>
    <style type="text/css" id="css_editor-sidebarcats"><? echo fw_theme_mod('css_editor-sidebarcats')?></style>
    <style type="text/css" id="css_editor-loop"><? echo fw_theme_mod('css_editor-loop')?></style>
    <style type="text/css" id="css_editor-single"><? echo fw_theme_mod('css_editor-single')?></style>
    <style type="text/css" id="css_editor-mobile"><? echo fw_theme_mod('css_editor-mobile')?></style>
    <style type="text/css" id="css_editor-widget"><? echo fw_theme_mod('css_editor-header-headerwidget')?></style>
    <style ><?php echo fw_custom_css(); ?></style>
    <style type="text/css" id="css_editor-logged_in"><? if(is_user_logged_in())echo fw_theme_mod('css_editor-logged_in')?></style>
    <style type="text/css" id="css_editor-admin"><? if(current_user_can("administrator"))echo fw_theme_mod('css_editor-admin')?></style>
    
</head>

<body <?php body_class("page-".basename(get_permalink())); ?>>
<?php
global $header_main,$header_middle,$header_middle_mobile,$header_bottom,$header_container;
$header_container   = fw_theme_mod('header-width');
$header_middle=" fw_header middle desktop d-none d-md-block ";
$header_bottom=" fw_header bottom desktop d-none d-md-block ";
$header_middle_mobile=" fw_header middle mobile d-md-none navbar ";
if(fw_theme_mod("transparent-header"))$header_middle.=" fw_transparent_top ";
//if(fw_theme_mod('floating-header'){$header_main.=" u-header--floating ";$header_middle.=" u-header--floating__inner ";}
?>
<?php do_action( 'fastway_header_topbanner');?>
<header id="header">
<? 
do_action( 'add_topbar');
do_action( 'fw_get_template_part', fw_theme_mod('header-style'),"header" );
do_action( 'fw_get_template_part', fw_theme_mod('header-mobile-style'),"mobile-header" );?>
</header>
<script >
jQuery(window).on('load', function() {
    if(jQuery(document).height()>1400){
        jQuery(window).scroll(function() {
            var sticky = jQuery('header'),
            scroll = jQuery(window).scrollTop();
            if (scroll >= 171) { sticky.addClass('fw_sticky_top'); }else { sticky.removeClass('fw_sticky_top');}
        });
    }
});
</script>
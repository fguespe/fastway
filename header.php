<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
global $redux_demo;
$js=$redux_demo['opt-ace-editor-js'];
$favi=$redux_demo["general-favi"]['url'];
?>
<!DOCTYPE html>
<html dir="ltr" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="shortcut icon" type="image/png" href="<?php echo $favi;?>"/>
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <meta name="description" content="<?php echo $redux_demo['seo-desc'];?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
   
	<!-- APPLE -->
        <meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="apple-touch-icon" href="<?php echo $favi;?>">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $favi;?>">
        <!--loading -->
        <link rel="apple-touch-startup-image" href="<?php echo $favi;?>">
        <!--barra -->
        <meta name="apple-mobile-web-app-status-bar-style" content="default">
    

    <?php wp_head(); ?>
	<style ><?php echo fw_custom_css(); ?></style>
    
</head>

<body <?php body_class(); ?>>
<?php
global $header_main,$header_middle,$header_middle_mobile,$header_bottom,$header_container;
$header_container   = $redux_demo['header-width'];
$header_middle=" fw_header_middle d-none d-md-flex py-".$redux_demo['header-padding']." ";
$header_bottom=" fw_header_bottom d-none d-md-flex ";
$header_middle_mobile=" fw_header_middle mobile d-md-none navbar";
error_log($redux_demo['header-style']);
//if($redux_demo['floating-header']){$header_main.=" u-header--floating ";$header_middle.=" u-header--floating__inner ";}
?>
<?php do_action( 'fastway_header_topbanner');?>
<header id="header">
<?php do_action( 'add_topbar');?>
<?php do_action( 'fastway_header_init', $redux_demo['header-style'],"header" );?>
<?php do_action( 'fastway_header_init_mobile', $redux_demo['header-mobile-style'],"mobile-header" );?>
</header>
<script >

jQuery(window).scroll(function() {
 if (jQuery(this).scrollTop() > 600){  
    jQuery('header').addClass("fw-sticky-top");
    <?php 	
    if(!empty($redux_demo['sticky-menu'])):
    foreach($redux_demo['sticky-menu'] as $key){
    ?>
	jQuery('.<?=$key?>').attr("style", "display: none !important; ");
    <?}?>
    <?php endif; ?>
	jQuery('.fw_header_top_banner').attr("style", "display: none !important; ");
  }
  else{
    jQuery('header').removeClass("fw-sticky-top");
    <?php
    if(!empty($redux_demo['sticky-menu'])):
    foreach($redux_demo['sticky-menu'] as $key){
    ?>
	jQuery('.<?=$key?>').attr("style", "display: flex;");
    <?}?>
    <?php endif; ?>
	jQuery('.fw_header_top_banner').attr("style", "display: flex ; ");
  }
});
</script>


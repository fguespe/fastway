<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
global $redux_demo;
$container   = $redux_demo['header-width'];
$js=$redux_demo['opt-ace-editor-js'];

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
    <title><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?></title>
    <meta name="description" content="<?php echo $redux_demo['seo-desc'];?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<style type="text/css"><?php include( get_template_directory() . '/assets/css/csstheme.php');?></style>
    
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
global $header_container,$header_main,$header_middle,$header_middle_mobile;
$header_container = $redux_demo['header-width'];
if($redux_demo['sticky-menu'])$header_main.=" u-header--sticky-top ";
$header_middle=" fw_header_middle d-none d-md-block py-".$redux_demo['header-padding'];
$header_middle_mobile=" fw_header_middle header-tablet d-md-none py-".$redux_demo['header-padding'];

//if($redux_demo['floating-header']){$header_main.=" u-header--floating ";$header_middle.=" u-header--floating__inner ";}
?>
<?php do_action( 'fastway_header_init', $redux_demo['header-style'] );?>
<?php do_action( 'fastway_header_init_mobile', $redux_demo['header-mobile-style'] );?>
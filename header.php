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
$hastop   = $redux_demo['top-header'];

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
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<style type="text/css"><?php include( get_template_directory() . '/assets/css/csstheme.php');?></style>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header>
<?php if($hastop):?>
<div class="fw_header_top d-none d-lg-flex">
    <div class="<?php echo esc_attr( $container ); ?>">
        <div>
            <?php
            $sidebar_name = "header-top-widget-area";
            if( is_active_sidebar( $sidebar_name ) ):?>
                <ul class="widgets-sidebar">
                    <?php dynamic_sidebar( $sidebar_name ); ?>
                </ul>
            <?php else:
                esc_html_e( "Please add some widgets here!", 'fastway' );
            endif;?>
        </div>
    </div>
</div>
<?php endif;?>
<?php do_action( 'fastway_header_init', $redux_demo['header-style'] );?>
<?php do_action( 'fastway_header_init_mobile', $redux_demo['header-mobile-style'] );?>
</header>

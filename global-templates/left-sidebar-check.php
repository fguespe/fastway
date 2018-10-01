<?php
// when both sidebars turned on reduce col size to 3 from 4.
$sidebar_pos = fw_theme_mod('layout-main');
$ratio=10;
$ratioboth=8;
if(fw_checkPlugin("woocommerce/woocommerce.php")){
	if(is_shop() || is_product_category())$sidebar_pos = fw_theme_mod('shop-layout');
	else if(is_product())$sidebar_pos = fw_theme_mod('product-page-layout');
	if(is_shop() || is_product_category() || is_product()){
		$ratio=12-fw_theme_mod("sidebar-ratio");
		$ratioboth=$ratio-fw_theme_mod("sidebar-ratio");
	}
}
?>

<?php if ( 'left' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>
	<?php get_sidebar( 'left' ); ?>
<?php endif; ?>

<?php 
$html = '';
if ( 'right' === $sidebar_pos || 'left' === $sidebar_pos ) {?>
	<div class="col-md-<? echo $ratio;?> content-area" id="primary">
<?} elseif ( 'both' === $sidebar_pos ) {?>
	<div class="col-md-<? echo $ratioboth;?> content-area" id="primary">
<?} else {?>
    <div class="col-md-12 content-area" id="primary">
<?}?>


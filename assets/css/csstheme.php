:root{
	--main:<?php echo fw_theme_mod('opt-color-main'); ?>;
  --top-banner:<?php echo fw_theme_mod('opt-color-topheader-banner'); ?>;
  --icon-header:<?php echo fw_theme_mod('opt-color-iconheader'); ?>;
  --second-color:<?php echo fw_theme_mod('opt-color-second'); ?>;
  --top-header:<?php echo fw_theme_mod('opt-color-topheader'); ?>;
  --middle-header:<?php echo fw_theme_mod('opt-color-middheader'); ?>;
  --bottom-header:<?php echo fw_theme_mod('opt-color-bottheader'); ?>;
  --body:<?php echo fw_theme_mod('opt-color-bodycolor'); ?>;
  --footer:<?php echo fw_theme_mod('opt-color-footer'); ?>;
}
<?php
$tipos=array("p","span","div","a","h4","h3","h2","h1");
foreach ($tipos as $key) {
$nombre='opt-typography-'.$key;
if(!isset(fw_theme_mod($nombre))continue;
$font=fw_theme_mod($nombre);
?>
header <?php echo $key;?>,footer <?php echo $key;?>,#page-wrapper <?php echo $key;?>,#woocommerce-wrapper <?php echo $key;?>,#main-nav <?php echo $key;?>{
  font-family: '<?php echo str_replace(",", "','", $font['font-family']);?>' ;
  font-size: <?php echo $font['font-size'];?> ;
  line-height: <?php echo $font['line-height'];?> ;
  color:<?php echo $font['color'];?> ;
  text-transform:<?php echo $font['text-transform'];?> ;
  text-align:<?php echo $font['text-align'];?> ;
}
<?}
if(fw_theme_mod('css-onoff')=="on"){
echo fw_theme_mod('css_editor-general'); 
echo fw_theme_mod('css_editor-header');
echo fw_theme_mod('css_editor-body');
echo fw_theme_mod('css_editor-footer'); 
echo fw_theme_mod('css_editor-loop');
echo fw_theme_mod('css_editor-single'); 
echo fw_theme_mod('css_editor-mobile'); 
}
if(is_child_theme()){
$files=glob(get_stylesheet_directory().'/fonts/*.otf');
$files=array_merge($files,glob(get_stylesheet_directory().'/fonts/*.ttf'));
$files=array_merge($files,glob(get_stylesheet_directory().'/fonts/*.OTF'));
foreach ($files as $path){ 
$nombre=basename($path,".otf");
$nombre=basename($nombre,".ttf");
$nombre=basename($nombre,".OTF");?>
@font-face {
font-family: '<?php echo $nombre;?>';
src:url('<?php echo get_stylesheet_directory_uri().'/fonts/'.basename($path);?>');
}
<?php } ?>
<?php } ?>
<?php  ?>
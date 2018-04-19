<?php
$tipos=array("p","span","div","a","h4","h3","h2","h1");
foreach ($tipos as $key) {
$nombre='opt-typography-'.$key;
if(!isset($redux_demo[$nombre]))continue;
$font=$redux_demo[$nombre];
?>
header <?php echo $key;?>,footer <?php echo $key;?>,#page-wrapper <?php echo $key;?>,#main-nav <?php echo $key;?>{
  font-family: '<?php echo str_replace(",", "','", $font['font-family']);?>' ;
  font-size: <?php echo $font['font-size'];?> ;
  font-weight: <?php echo $font['font-weight'];?> ;
  line-height: <?php echo $font['line-height'];?> ;
  color:<?php echo $font['color'];?> ;
  text-transform:<?php echo $font['text-transform'];?> ;
  text-align:<?php echo $font['text-align'];?> ;
}
<?}?>
.fw_header_top{background:<?php echo $redux_demo['opt-color-topheader']; ?>;}
.fw_header_middle{background:<?php echo $redux_demo['opt-color-middheader']; ?>;}
.fw_header_bottom{background:<?php echo $redux_demo['opt-color-bottheader']; ?>;}
body{background:<?php echo $redux_demo['opt-color-bodycolor']; ?>;}
footer{background:<?php echo $redux_demo['opt-color-footer']; ?>;}
<?php echo $redux_demo['css_editor-general']; ?>
<?php echo $redux_demo['css_editor-header']; ?>
<?php echo $redux_demo['css_editor-body']; ?>
<?php echo $redux_demo['css_editor-footer']; ?>
<?php echo $redux_demo['css_editor-loop']; ?>
<?php echo $redux_demo['css_editor-single']; ?>
<?php
if(is_child_theme()){
$files=glob(get_stylesheet_directory().'/fonts/*.otf');
$files=array_merge($files,glob(get_stylesheet_directory().'/fonts/*.ttf'));
foreach ($files as $path){ 
$nombre=basename($path,".otf");
$nombre=basename($nombre,".ttf");?>
@font-face {
font-family: '<?php echo $nombre;?>';
src:url('<?php echo get_stylesheet_directory_uri().'/fonts/'.basename($path);?>');
}
<?}
}?>

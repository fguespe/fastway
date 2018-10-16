<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */


$js=fw_theme_mod('opt-ace-editor-js');
$container   = fw_theme_mod('footer-width');
$popup = fw_theme_mod('popup-img');
?>

<footer id="footer" class="">
	<div class="<?php echo esc_attr( $container ); ?>">
		<?php do_action( 'fastway_footer_init' ); ?>
	</div>
<?php if(fw_theme_mod('footer-copyright-switch'))echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('footer-copyright-text'))));?>
<style type="text/css" id="css_editor-footer-copywright"><? echo fw_theme_mod('css_editor-footer-copywright')?></style>
<?php wp_footer(); ?>
<script><?php echo $js;?></script>
<?php
if(fw_theme_mod('whats-widget')){?>
<a href="https://api.whatsapp.com/send?phone=<?php echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('short-fw_companywhatsapp'))));?>&amp;text=Hola, tengo una consulta" target="_blank" class="btn-wapp">
    <i class="fa fa-whatsapp"></i>
    <span class="t5">Estamos<br>On-Line!</span>
</a>

</footer>
</body>
<style type="text/css">
  .btn-wapp{
    display: block;
    position: fixed;
    right: 3%;
    bottom: 0%;
    height: 55px;
    z-index: 3000;
    background-color: #0CBC47;
    -webkit-border-radius: 0 0 10px 10px;
    -moz-border-radius: 0 0 10px 10px;
    border-radius: 10px 10px 0 0;
    padding: 8px 1% 0 1%;
}
@media (max-width: 799px) {
.btn-wapp{
        -webkit-border-radius: 10px 0px 0 10px;
        -moz-border-radius: 10px 0px 0 10px;
        border-radius: 10px 0px 0 10px;
        padding: 5%;
        right: 0;
        bottom: 80px;
        width: auto;
        height: auto;
    }
    .btn-wapp span{
      display: none !important;
    }
}
    .btn-wapp span{
        font-size: 18px;
        color: #fff;
        display: inline-block;
        line-height: 18px;
        text-align: left;
        padding-left: 10px;
    }
    .btn-wapp i {
        color: #fff;
        font-size: 40px;
        animation: animaWapp 3s ease-in infinite;    
        transform-origin: 50% 50%;
        display: inline-block;
        text-align: left;
    }
    .btn-wapp:hover{
        background-color: #0D7F2A;
        transition: all 100ms linear 0s;
        text-decoration: none;
    }
@keyframes animaWapp {
  0% {  transform: scale(1) }
  8.33333% {  transform:scale(.9) rotate(-8deg) }
  16.66667% {  transform:scale(.9) rotate(-8deg) }
  25% {  transform:scale(1.3) rotate(8deg) }
  33.33333% {  transform:scale(1.3) rotate(-8deg) }
  41.66667% {  transform:scale(1.3) rotate(8deg) }
  50% {  transform:scale(1.3) rotate(-8deg) }
  58.33333% {  transform:scale(1.3) rotate(8deg) }
  66.66667% {  transform:scale(1) rotate(0) }
  100% {  transform:scale(1) rotate(0) }
}
</style>
<?
}
if(fw_theme_mod("popup-mode")){
?>
<div id="jaja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
          	<img width="100%" src="<?php echo $popup;?>"/>
        </div>
    </div>
  </div>
</div>
</body>
</html>

<script type="text/javascript">
	jQuery(document).ready( function(jQuery) {
		jQuery('#jaja').modal('show'); 
});
</script>
<?
}
?>
<?php
$js=fw_theme_mod('opt-ace-editor-js');
$container   = fw_theme_mod('footer-width');
$popup = fw_theme_mod('popup-img');
$link = fw_theme_mod('popup-link');
?>

<footer id="footer" class="">
	<div class="<?php echo esc_attr( $container ); ?>">
		<?php do_action( 'fastway_footer_init' ); ?>
	</div>
</footer>
<?php get_template_part( 'global-templates/modal_carrito' ); ?>
<?php 
if(fw_theme_mod('footer-copyright-switch'))echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('footer-copyright-text'))));?>
<style type="text/css" id="css_editor-footer-copywright"><?php echo fw_theme_mod('css_editor-footer-copywright')?></style>
<?php wp_footer(); ?>
<script><?php echo $js;?></script>
    <?php echo fw_theme_mod('fw_footer_scripts');?>
<?php  
if(fw_theme_mod('whats-button')!='none')fw_whatsappfooter();
if(!is_plugin_active('Plugin-WooCommerce-master/index.php')){?>
<style>

#todopago-tab{
  display:none !important;
}
</style>

<?php } 
if(fw_theme_mod("popup-mode") && is_front_page()){
?>
<div id="modalpopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered <?=fw_theme_mod('popup-size')?>">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-body" style="padding:0px;">
          	<a class="img" href="<?=$link?>"><img width="100%" src="<?php echo $popup;?>"/></a>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
	jQuery(document).ready( function(jQuery) {
    jQuery('#modalpopup').modal('show'); 
    });
</script>
<?php
}

?>
</body>
</html>
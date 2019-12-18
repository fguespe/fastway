<?php
$js=fw_theme_mod('opt-ace-editor-js');
$container   = fw_theme_mod('footer-width');
?>
<footer id="footer" class="">
	<div class="<?php echo esc_attr( $container ); ?>">
		<?php do_action( 'fastway_footer_init' ); ?>
	</div>
</footer>
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
set_theme_mod('fw_icons_style','fad');
if(is_plugin_active('woocommerce/woocommerce.php'))get_template_part( 'global-templates/modal_carrito' );
if(fw_theme_mod("fw_popup_mode") && is_front_page()){
?>

<div id="modalpopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered <?=fw_theme_mod('popup-size')?>">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-body" style="padding:0px;">
            <?php if(fw_theme_mod('fw_popup_img')){?>
              <a class="img" href="<?=fw_theme_mod('popup-link')?>"><img width="100%" src="<?php echo fw_theme_mod('fw_popup_img');?>"/></a>
            <?php }else if(fw_theme_mod('fw_popup_html')){ ?>
              <?php echo fw_theme_mod('fw_popup_html');?>
            <?php } ?>
            <?php if(fw_theme_mod('fw_pupup_form_id')){?>
              <div class="modal_form"> <?php echo do_shortcode('[gravityform id="'.fw_theme_mod('fw_pupup_form_id').'" description="false" ajax="true"]')?></div>
            <?php } ?>
        </div>
    </div>
  </div>
</div>
<style>
#modalpopup .modal_form{
  padding-left:20px;
  padding-right:20px;
}
#modalpopup .modal_form input{
  border:1px solid var(--main)  !important;
}
</style>
<script type="text/javascript">
	jQuery(document).ready( function(jQuery) {
    
    setTimeout(function(){
      //if (jQuery.cookie('modal_shown') == null) {
        jQuery.cookie('modal_shown', 'yes', { expires: 7, path: '/' });
        jQuery('#modalpopup').modal('show');
      //}
   }, 2000);
    });
</script>
<?php
}

?>
</body>
</html>
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
if(is_plugin_active('woocommerce/woocommerce.php'))get_template_part( 'global-templates/modal_carrito' );
if(fw_theme_mod("fw_popup_mode")!='off' && is_front_page()){
?>

<div id="modalpopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered <?=fw_theme_mod('popup-size')?>">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-body" style="padding:0px;">
            <?php if(fw_theme_mod('fw_popup_mode')=='image' && fw_theme_mod('fw_popup_img')){
              $linkpop=fw_theme_mod('popup-link')?fw_theme_mod('popup-link'):'#';
              ?>
              <a class="img" href="<?=$linkpop?>"><img width="100%" src="<?php echo fw_theme_mod('fw_popup_img');?>"/></a>
            <?php }else if(fw_theme_mod('fw_popup_mode')=='html' && fw_theme_mod('fw_popup_html')){ ?>
              <?php echo fw_theme_mod('fw_popup_html');?>
            <?php } ?>
            <?php if(fw_theme_mod('fw_popup_form_mode')){?>
              <div class="modal_form"> <?php echo do_shortcode('[gravityform id="'.fw_theme_mod('fw_pupup_form_id').'" description="false" title="false" ajax="true"]')?></div>
            <?php } ?>
        </div>
    </div>
  </div>
</div>
<style>
#modalpopup .modal_form {
  padding:0px;
	padding-left: 20px;
	padding-right: 20px;
  text-align:center;
}


#modalpopup h1,
#modalpopup p.subtitle {
  color:#686868;
	text-align: center;
	padding-left: 20px;
	padding-right: 20px;
	padding-top: 10px;
}

#modalpopup .gform_body ul,
#modalpopup .gform_body ul li{
  width:100% !important;
  padding:0px;
}
#modalpopup .gform_body input {
	width: 60% !important;
  display:block !important;
  margin:0 auto !important;
	border: 1px solid var(--main) !important;
  margin:0 auto;
  font-size:12px;
  padding:0px;
  line-height:14px;
  text-align:center;
  margin-bottom:10px!important;
	padding: 0px !important;
}
#modalpopup .fwhorform .gform_body{
  width:100% !important;
}
#modalpopup .gform_footer{
  width:100% !important;
  margin:0 auto !important;
}
#modalpopup  .fwhorform .gform_footer input{
	width: 60% !important;
  display:block !important;
  margin:0 auto !important;
  color: white !important;
	background: #70BBA2;/* var(--second);*/
  margin-top:10px;
  border-radius: 10px;
}

</style>
<script type="text/javascript">
	jQuery(document).ready( function(jQuery) {
    
    setTimeout(function(){
      jQuery('#modalpopup').modal('show');
      if (jQuery.cookie('modal_shown') == null) {
        console.log('no midal')

        jQuery.cookie('modal_shown', 'yes', { expires: 7, path: '/' });
        jQuery('#modalpopup').modal('show');
      }else{
        console.log('no midal')
      }
   }, 2000);
    });
</script>
<?php
}

?>
</body>
</html>
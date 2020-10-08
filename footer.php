<?php
$js=fw_theme_mod('opt-ace-editor-js');
$container   = fw_theme_mod('footer-width');
?>
<footer id="footer" class="<?=fw_theme_mod('fw_builder_footer_class')?>">
	<div class="<?php echo esc_attr( $container ); ?>">
    <?php 
    if(is_plugin_active("woocommerce/woocommerce.php")){
      if(!(is_checkout())){
        do_action( 'fastway_footer_init' );
      }
    }else{
      do_action( 'fastway_footer_init' );
    }
    ?>
	</div>
</footer>

<?php 
if(fw_theme_mod('footer-copyright-switch'))echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('footer-copyright-text'))));?>
<style type="text/css" id="css_editor-footer-copywright"><?php echo fw_theme_mod('css_editor-footer-copywright')?></style>
<?php wp_footer(); ?>
<script><?php echo $js;?></script>
    <?php echo fw_theme_mod('fw_footer_scripts');?>
<?php  
if(usesWhatsapp())fw_whatsappfooter();
if(!is_plugin_active('Plugin-WooCommerce-master/index.php')){?>
<style>
#todopago-tab{
  display:none !important;
}
</style>
<?php } 

if(is_plugin_active('woocommerce/woocommerce.php'))get_template_part( 'global-templates/modals' );
if(fw_theme_mod("fw_popup_type")!='off' && is_front_page()){
?>

<div id="modalpopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered <?=fw_theme_mod('popup-size')?>">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-body" style="padding:0px;">
            <?php if(fw_theme_mod('fw_popup_type')=='image' && fw_theme_mod('fw_popup_img')){
              $linkpop=fw_theme_mod('fw_popup_link')?fw_theme_mod('fw_popup_link'):'#';
              ?>
              <a class="img" href="<?=$linkpop?>"><img width="100%" src="<?php echo fw_theme_mod('fw_popup_img');?>"/></a>
            <?php }else if(fw_theme_mod('fw_popup_type')=='html' && fw_theme_mod('fw_popup_html')){ ?>
              <?php echo fw_theme_mod('fw_popup_html');?>
            <?php } ?>
            <?php if(fw_theme_mod('fw_popup_form_mode')){?>
              <div class="modal_form"> <?php echo do_shortcode('[gravityform id="'.fw_theme_mod('fw_pupup_form_id').'" description="false" title="false" ajax="true"]')?></div>
            <?php } ?>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
jQuery(document).ready( function(jQuery) {
    let searchParams = new URLSearchParams(window.location.search)
    setTimeout(function(){
      if(searchParams.has('testmodal'))jQuery('#modalpopup').modal('show');
      if (jQuery.cookie('modal_shown') == null) {
        jQuery.cookie('modal_shown', 'yes', { expires: 1, path: '/' });
        jQuery('#modalpopup').modal('show');
      }
   }, 2000);
});
</script>
<?php } ?>

<script type="text/javascript">
function check_ga() {
  if (typeof ga === 'function') {
    console.log('Loaded :'+ ga);
    return true
  } else {
    console.log('Not loaded');
    setTimeout(check_ga,500);
  }
}
jQuery( ".btn-wapp" ).click(function() {
  
  console.log('eventAction:whatsapp' );
  let event='Whatsappp'
  if(window.ga)ga('send', {hitType: 'event',eventCategory: 'Contacto',eventAction: 'whatsapp', eventLabel: event});
  if(window.gtag)gtag('send', {hitType: 'event',eventCategory: 'Contacto',eventAction: 'whatsapp', eventLabel: event});
  if(window.dataLayer)window.dataLayer.push({'event': event});
  
  jQuery.get(ajaxurl,{'action': 'register_wp'});
});
jQuery(document).ready( function(jQuery) {
    let searchParams = new URLSearchParams(window.location.search)
    if ( jQuery.cookie('visited') == null || searchParams.has('visited') ){
      jQuery.cookie('visited', 'yes', { expires: 1, path: '/' });
      
      jQuery.get(ajaxurl,{'action': 'register_visit'});
    }
});
</script>
</body>
<style>
 .botonarrepe{
font-size:10px;
color:var(--main);
border:1px solid var(--main);
border-radius:5px;
padding:5px;
}
</style>
</html>



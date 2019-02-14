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
</footer>
<?php 
if(fw_theme_mod('footer-copyright-switch'))echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('footer-copyright-text'))));?>
<style type="text/css" id="css_editor-footer-copywright"><?php echo fw_theme_mod('css_editor-footer-copywright')?></style>
<?php wp_footer(); ?>
<script><?php echo $js;?></script>
<?php  

fw_whatsappfooter();
if(fw_theme_mod("popup-mode")){
?>

<div id="modalpopup" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
          	<img width="100%" src="<?php echo $popup;?>"/>
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
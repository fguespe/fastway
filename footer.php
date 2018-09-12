<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
global $redux_demo;

$js=$redux_demo['opt-ace-editor-js'];
$container   = $redux_demo['footer-width'];
$popup = $redux_demo['popup-img']['url'];
?>
<footer id="footer" class="">
	<div class="<?php echo esc_attr( $container ); ?>">
		<?php do_action( 'fastway_footer_init' ); ?>
	</div>
</footer>
<?php if($redux_demo['footer-copyright-switch'])echo $redux_demo['footer-copyright-text']."<style>".$redux_demo['css_editor-footer-copywright']."</style>";?>
<?php wp_footer(); ?>
<script><?php echo $js;?></script>

<?php

if($redux_demo["popup-mode"]){
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
<?php
$js=fw_theme_mod('opt-ace-editor-js');
$container   = fw_theme_mod('footer-width');
?>
<footer id="footer" class="">
	<div class="<?php echo esc_attr( $container ); ?>">
    <?php 
    if(is_plugin_active("woocommerce/woocommerce.php")){
      if(!(is_checkout() && fw_theme_mod("checkout-minimal"))){
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
if(fw_theme_mod('whats-button')!='none')fw_whatsappfooter();
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
              $linkpop=fw_theme_mod('popup-link')?fw_theme_mod('popup-link'):'#';
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
  if(window.ga){
    console.log('eventAction:whatsapp' );
    ga('send', {hitType: 'event',eventCategory: 'Contacto',eventAction: 'whatsapp', eventLabel: 'Whatsappp'});
  }
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
<script>
jQuery('body').append('<div class="wsw_wrapper wsw_open ng-scope"><button class="wsw_button"> <img src="https://firebasestorage.googleapis.com/v0/b/linckard-1545486188489.appspot.com/o/iso_white.svg?alt=media&token=569ae207-010e-4df5-941d-a0774a5b89bc"> </button> <div class="wsw_card"> <div class="wsw_card_header"> <h4>Abre mi Business Card</h4> <button class="wsw_close"><img src="https://firebasestorage.googleapis.com/v0/b/linckard-1545486188489.appspot.com/o/icon_close.svg?alt=media&token=8d586382-9439-467c-8828-e3d21a1b4fde"></button> </div><div class="wsw_card_body"> <div class="wsw_lc_wrapper"> <div class="wsw_lc_container"> <div class="wsw_lc_inner_wrapper"> <div class="wsw_lc_avatar_wrapper"> <div class="wsw_lc_avatar"> <img src="https://firebasestorage.googleapis.com/v0/b/linckard-1545486188489.appspot.com/o/images%2Fprofile%2Fthumb_vuquh?alt=media&token=cf20c107-abb1-4aa8-a3dd-6b5c3c7dc302" width="100%"> </div></div><div class="wsw_lc_user_info"> <h6 class="wsw_lc_user_name">Roni Grosfeld</h6> <span class="wsw_lc_user_prof">Founder & CEO</span> <a href="https://linkcard.app/inlat/0" target="_blank" class="wsw_lc_url">Ver Linckard</a> </div><div class="wsw_lc_buttons"> <button class="wsw_lc_btn_top wsw_lc_btn_linkcard"><img src="https://firebasestorage.googleapis.com/v0/b/linckard-1545486188489.appspot.com/o/button_linkcard.svg?alt=media&token=d166bccf-f6da-4979-820f-7ea160ac922e"></button> <button class="wsw_lc_btn_bottom"><i class="fas fa-info-circle"></i></button> </div></div></div></div></div></div></div>');
</script>
<style>

/* Website Widget Abril 2020 */

/* Website Widget Abril 2020 */

.ws_wrapper {
	display: inline-block;
	width: 100%;
}

.ws_wrapper .label_special {
	color: #666;
	display: table;
	margin: auto;
}

.ws_wrapper pre {
	background-color: #fff;
	border: solid 1px #ddd;
}

.pv_container {
	background: #fff;
	border: solid 1px #ddd;
	border-radius: 8px;
	display: inline-block;
	width: 100%;
}

.pv_container .pv_header {
	padding: 10px;
	line-height: 0;
	border-bottom: solid 1px #ddd;
}

.pv_container .pv_header .bullet {
	width: 10px;
	height: 10px;
	background-color: #ddd;
	display: inline-block;
	border-radius: 50%;
	margin-right: 10px;
}

.pv_container .pv_body {
	min-height: 200px;
	position: relative;
	overflow: hidden;
}

.wsw_wrapper {
	font-size: 14px;
	position: absolute;
	bottom: 3.57em;
	right: 15px;
	z-index: 3000;
}

.pv_container .wsw_wrapper {
	font-size: 12px;
	right: 15px;
}

.wsw_wrapper a,
.wsw_wrapper button {
	transition: all 0.4s !important;
    -webkit-transition: all 0.4s !important;
    -o-transition: all 0.4s !important;
	-moz-transition: all 0.4s !important;
	text-decoration: none !important;
}

.wsw_wrapper .wsw_button {
	position: relative;
	z-index: 2;
	background: #0090e4;
	border: solid 2px #fff;
	border-radius: 50%;
	width: 50px /*3.57em*/;
	height: 50px /*3.57em*/;
	/*-webkit-box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.15) !important;
    -moz-box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.15) !important;
	box-shadow: 4px 4px 0px 0px rgba(0,0,0,0.15) !important;*/
	cursor: pointer;
	text-align: center;
}

.pv_container .wsw_wrapper .wsw_button {
	width: 38px /*3.21em*/;
	height: 38px /*3.21em*/;
	pointer-events: none;
	animation: clickBounce 5000ms infinite ease !important;
}

@keyframes clickBounce {
	/*2.5% {
		width: 3.05em;
		height: 3.05em;
	}
	5% {
		width: 3.21em;
		height: 3.21em;
	}
	50% {
		width: 3.21em;
		height: 3.21em;
	}
	52.5% {
		width: 3.05em;
		height: 3.05em;
	}
	55% {
		width: 3.21em;
		height: 3.21em;
	}*/

	10% {
		transform: rotate(360deg);
	}
	50% {
		transform: rotate(360deg);
	}
	60% {
		transform: rotate(0deg);
	}



}

.wsw_wrapper .wsw_button:hover {
	background: #0286d4 !important;
}

.wsw_wrapper .wsw_button img {
	width: 70%;
    line-height: 50px;
}

.wsw_card {
	background-color: #0090e4;
	border-radius: 1.07em;
	min-width: 320px;
	position: absolute;
	top: 50%;
	right: 100%;
	transform: translateY(-50%);
	margin-right: .71em;
	transition: all 0.4s !important;
    -webkit-transition: all 0.4s !important;
    -o-transition: all 0.4s !important;
	-moz-transition: all 0.4s !important;
}



.wsw_wrapper.wsw_open .wsw_card {
	animation: wsw_card_In 1000ms ease;
}

.wsw_wrapper.wsw_close .wsw_card {
	animation: wsw_card_Out 1000ms ease;
}

.wsw_wrapper.wsw_open .wsw_button {
	animation: wsw_button_In 400ms ease;
}

.wsw_wrapper.wsw_close .wsw_button {
	animation: wsw_button_Out 400ms ease;
}

.wsw_wrapper.wsw_novisible .wsw_card {
	display: none;
}


@keyframes wsw_card_In {
	from {
		margin-right: -.71em;
		opacity: 0;
    }

	to {
		margin-right: .71em;
		opacity: 1;
	}
}

@keyframes wsw_card_Out {
	from {
		margin-right: .71em;
		opacity: 1;
    }

	to {
		margin-right: -.71em;
		opacity: 0;
	}
}

@keyframes wsw_button_In {
	from {
		transform: rotate(0deg);
    }

	to {
		transform: rotate(360deg);
	}
}

@keyframes wsw_button_Out {
	from {
		transform: rotate(360deg);
    }

	to {
		transform: rotate(0deg);
	}
}

.pv_container .wsw_wrapper .wsw_card {
	min-width: initial;
	animation: fadeInOut 5000ms infinite ease;
}

@keyframes fadeInOut {
    0% {
		margin-right: -.71em;
		opacity: 0;
    }

    25% {
		margin-right: .71em;
		opacity: 1;
	}
		
	50% {
		margin-right: .71em;
		opacity: 1;
	}
		
	75% {
		margin-right: -.71em;
		opacity: 0;
	}
		
	100% {
		margin-right: -.71em;
		opacity: 0;
    }
}



.pv_container .wsw_card a,
.pv_container .wsw_card button {
	pointer-events: none;
}

.wsw_card .wsw_card_header {
	position: relative;
	padding: .71em;
}

.wsw_card .wsw_card_header h4 {
	color: #fff;
    text-transform: uppercase;
    margin: 0;
    font-size: .92em;
	font-weight: 700;
	line-height: 1;
}

.wsw_card .wsw_card_header .wsw_close {
	background: transparent;
	border: none;
	padding: 0;
	position: absolute;
	top: .53em;
	right: .71em;
	cursor: pointer;
}

.wsw_card .wsw_card_header .wsw_close:hover {
	opacity: .6;
}

.wsw_card .wsw_card_header .wsw_close img {
	width: 1em;
}

.wsw_card .wsw_card_body {
	padding: 0 .35em .35em;
}

.wsw_card .wsw_card_body .wsw_lc_wrapper {
	max-width: initial;
	border: none;
	font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    height: auto;
    border-radius: .71em;
    background-color: #fff;
    padding: 0px;
    display: flex;
    width: 100%;
    margin: auto;
    position: relative;
}

.wsw_card .wsw_card_body .wsw_lc_container {
	position: relative;
    width: 100%;
	display: block;
	margin: inherit;
}

.wsw_card .wsw_card_body .wsw_lc_inner_wrapper {
    position: relative;
    display: flex;
    flex-direction: row;
    width: 100%;
    margin: auto;
    min-height: 3.57em;
}

.wsw_card .wsw_card_body .wsw_lc_avatar_wrapper {
    position: absolute;
    width: 4.28em;
	height: 4.28em;
	top: .71em;
    left: .71em;
}

.wsw_card .wsw_card_body .wsw_lc_avatar {
    position: absolute;
    border-radius: 50%;
    overflow: hidden;
    width: 100%;
    height: 100%;
}

.wsw_card .wsw_card_body .wsw_lc_user_info {
	width: 100%;
	width: 18.92em;
    padding: .71em .71em .71em 5.71em;
}

.pv_container .wsw_card .wsw_card_body .wsw_lc_user_info {
	width: 14.92em;
}

.wsw_card .wsw_card_body .wsw_lc_user_name {
    max-width: initial;
	min-height: 1.5em;
	width: 100%;
    white-space: nowrap;
    overflow: hidden;
	text-overflow: ellipsis;
	font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji";
    color: #515151;
    margin: 0;
    font-weight: 600;
	font-size: 1em;
	line-height: 1.4;
}

.wsw_card .wsw_card_body .wsw_lc_user_prof {
    font-size: .64em;
    color: #828282;
	display: block;
	line-height: 1.5;
}

.wsw_card .wsw_card_body .wsw_lc_url {
	display: inline-block;
    line-height: 1;
    text-align: center;
    text-decoration: none !important;
    font-weight: 600;
    font-size: .71em;
    text-transform: uppercase;
    padding: .57em .57em;
    border-radius: .21em;
    margin: .35em 0;
    color: #fff !important;
	background-color: #0090e4;
}

.wsw_card .wsw_card_body .wsw_lc_buttons {
	padding: .71em;
	display: flex;
	flex-direction: column;
	margin: 0 0 0 auto;
}

.wsw_card .wsw_card_body .wsw_lc_buttons button {
    background: transparent;
    padding: 0;
    border: none;
    color: #b2b2b2;
    cursor: pointer;
	margin-left: auto !important;
	font-size: 16px;
	line-height: 1;
}

.wsw_card .wsw_card_body .wsw_lc_buttons button:hover {
    color: #8e8e8e;
}

.wsw_card .wsw_card_body .wsw_lc_buttons button img {
	width: 16px;
}

.wsw_card .wsw_card_body .wsw_lc_buttons .wsw_lc_btn_linkcard img {
	width: 20px;
}

.wsw_card .wsw_card_body .wsw_lc_buttons .wsw_lc_btn_top {
	margin-top: 0;
	margin-bottom: auto;
}

.wsw_card .wsw_card_body .wsw_lc_buttons .wsw_lc_btn_middle {
	margin-top: auto;
	margin-bottom: auto;
}

.wsw_card .wsw_card_body .wsw_lc_buttons .wsw_lc_btn_middle {
	margin-top: auto;
	margin-bottom: 0;
}
@media (max-width: 780px) {

.wsw_card {
    max-width: 270px !important;

}

}
</style>
</body>
</html>
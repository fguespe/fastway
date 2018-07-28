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
?>
<footer id="footer" class="">
	<div class="<?php echo esc_attr( $container ); ?>">
		<?php do_action( 'fastway_footer_init' ); ?>
	</div>
</footer>
<?php if($redux_demo['footer-copyright-switch'])echo $redux_demo['footer-copyright-text']."<style>".$redux_demo['css_editor-footer-copywright']."</style>";?>
<?php wp_footer(); ?>
<script><?php echo $js;?></script>
</body>
<!--<script>
    jQuery(window).on('load', function () {
      // initialization of HSMegaMenu component
      jQuery('.js-mega-menu').HSMegaMenu({
        event: 'hover',
        pageContainer: jQuery('.container'),
        breakpoint: 768,
        hideTimeOut: 0
      });
    });

    jQuery(document).on('ready', function () {
      // initialization of header
      jQuery.HSCore.components.HSHeader.init(jQuery('#header'));
      
      jQuery.HSCore.helpers.HSHamburgers.init('#hamburgerTrigger');
      // initialization of go to
      jQuery.HSCore.components.HSGoTo.init('.js-go-to');
    
      // initialization of header
      jQuery.HSCore.components.HSHeader.init(jQuery('#header'));

      
      // initialization of unfold component
      jQuery.HSCore.components.HSUnfold.init(jQuery('[data-unfold-target]'), {
        afterOpen: function () {
          jQuery(this).find('input[type="search"]').focus();
          // Helper function for accordions in hidden block
          jQuery('#headerSidebarList .u-header-collapse__nav-pointer').on('click', function (e) {
            e.preventDefault();

            var target = jQuery(this).attr('href');

            jQuery('#headerSidebarList .u-header-collapse__submenu-list').collapse('hide');
            jQuery(target).collapse('show');
          });
        },
        beforeClose: function () {
          jQuery('#hamburgerTrigger').removeClass('is-active');
        }
      });


      // initialization of autonomous popups
      jQuery.HSCore.components.HSModalWindow.init('[data-modal-target]', '.js-shopping-cart-window', {
        autonomous: true
      });

      // initialization of malihu scrollbar
      jQuery.HSCore.components.HSMalihuScrollBar.init(jQuery('.js-scrollbar'));

      // initialization of forms
      jQuery.HSCore.helpers.HSFocusState.init();

      // initialization of form validation
      jQuery.HSCore.components.HSValidation.init('.js-validate', {
        rules: {
          confirm_password: {
            equalTo: '#password'
          }
        }
      });

      // initialization of show animations
      //jQuery.HSCore.components.HSShowAnimation.init('.js-animation-link');


      jQuery.HSCore.components.HSGoTo.init('.js-go-to');
      
      jQuery('#sidebarHeaderInvoker').on('click', function(e) {
        jQuery('#headerSidebarList .collapse').collapse('hide');
      });

      jQuery('#sidebarHeader .close').on('click', function(e) {
        jQuery('#headerSidebarList .collapse').collapse('hide');
        jQuery('#hamburgerTrigger').removeClass('is-active');
      });

      jQuery(document).on('keydown', function (e) {
        if (e.keyCode && e.keyCode === 27) {
          jQuery('#headerSidebarList .collapse').collapse('hide');
        }
      });
    });
  </script>-->

</html>


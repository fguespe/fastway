<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
      <div class="row">
        <div class="col-3">
            <?php echo fastway_getLogo();?>
        </div>
        
        <div class="col-5 form-row align-items-center" >
            <?php echo fw_search_form(1);?> 
          </div> 
        <div class="d-flex col-3 align-items-center header-text"><?php fastway_getWidgetHeaderText();?>      </div>
        <div class="col-1 row align-items-center justify-content-end px-4">
            <?php echo fw_shoppingCart();?>
            </table>
        </div>
      </div>
  </div>
</div>
<div class="<?php echo esc_attr( $header_bottom ); ?>">
  <div class="<?php echo esc_attr( $header_container ); ?>">
         <nav class="js-mega-menu  navbar-expand-md u-header__navbar">
          <!-- Logo -->
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'primary',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav ',
                  'fallback_cb'     => '',
                  'menu_id'         => '',
                  'walker'          => new fw_Navwalker('desktop-1'),
                )
            ); 
            ?>
        </nav>
  </div>
</div>
<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
	    <div class="row">
		  <div class="col-3">
          <?php echo fastway_getLogo();?>
			</div>
      
			<div class="col-3 form-row align-items-center" >
          <?php echo fw_search_form(1);?> 
        </div> 
      <div class="d-flex col-5 align-items-center header-text"><?php fw_header_html();?>      </div>
			<div class="col-1 row align-items-center justify-content-end px-4">
          <?php echo fw_shoppingCart();?>
          </table>
			</div>
	        	
        <!-- End Nav -->
      	</div>
  </div>
</div>

<div id="main-nav" class=" <?php echo esc_attr( $header_bottom ); ?> py-2">
  <div  class=" <?php echo esc_attr( $header_container ); ?> ">  
    <div class="row">
    <div class="col-2 row navitemvertical align-items-center">
        <?php wp_nav_menu(
          array(
            'theme_location'  => 'vertical',
            'container_class' => 'collapse navbar-collapse show align-items-center',
            'container_id'    => 'navbarNavDropdown',
            'menu_class'      => 'navbar-nav ml-auto',
            'fallback_cb'     => '',
            'menu_id'         => 'main-menu',
            'depth'           => 2,
            'walker'          => new fw_Navwalker(),
          )
        ); ?>
    </div>
    <div class="col-10 d-flex align-items-center">

        <div class="menu-icon-item">
          <img src="http://demo3.fastway/wp-content/uploads/sites/16/2018/08/0_icon_1.png">
          <span>Ofertas</span>
        </div>
        <div class="menu-icon-item">
          <img src="http://demo3.fastway/wp-content/uploads/sites/16/2018/08/0_icon_2.png">
          <span>Televisores</span>
        </div>
        <div class="menu-icon-item">
          <img src="http://demo3.fastway/wp-content/uploads/sites/16/2018/08/0_icon_3.png">
          <span>Aire Acondicionado</span>
        </div>
        <div class="menu-icon-item">
          <img src="http://demo3.fastway/wp-content/uploads/sites/16/2018/08/0_icon_4.png">
          <span>Ofertas</span>
        </div>
        <div class="menu-icon-item">
          <img src="http://demo3.fastway/wp-content/uploads/sites/16/2018/08/0_icon_5.png">
          <span>Televisores</span>
        </div>
        <div class="menu-icon-item">
          <img src="http://demo3.fastway/wp-content/uploads/sites/16/2018/08/0_icon_6.png">
          <span>Aire Acondicionado</span>
        </div>
    
  </div>
</div>

  </div>
</div>
</div>
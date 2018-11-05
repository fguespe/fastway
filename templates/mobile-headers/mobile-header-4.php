<?php 
global $header_middle_mobile;
?>
<style type="text/css">

  .fw_header_middle.mobile i{
    font-size:24px !important;
}
.fw_header_middle.mobile.navbar{
    padding:0px;
}

  .fw_header_middle.mobile .col-3:nth-child(1){
        padding:0px
    }

</style>
<div class="<?php echo esc_attr( $header_middle_mobile ); ?>  align-items-center">
      <div class="col-3 d-flex justify-content-around">
          <button class="navbar-toggler fw-header-icon toggler" type="button" data-toggle="offcanvas" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
          <button class="navbar-toggler fw-header-icon search" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-search"></i></button>
          
      </div>
      <div class="col-6 text-center align-items-center"><?php echo fastway_getLogo();?></div>
      <div class="col-3 text-right align-items-center"><?php echo fw_shoppingCart();?></div>
      <div class="menu-madre-mobile opened">
<div class="sub-menu-mobile t2"> 
    <div class="telefono-header t1 txt-16 text-left">         
      <a href="tel:08103451102" rel="nofollow" title="Llamar a precio local desde cualquier punto del país" alt="Llamar gratis al 0810 345 1102" class="btn btn-primary"><i class="fa fa-phone" aria-hidden="true"></i> Llamar Ahora</a><br>
      <!--<a href="tel:01152733400" rel="nofollow" title="Llamar desde cualquier punto del país" alt="Llamar  al 011 5273 3400" class="btn btn-primary"><i class="fa fa-phone" aria-hidden="true"></i> Llamar Ahora</a><br />-->
      <a href="whatsapp://send?text=Hola, tengo una consulta&amp;phone=5491162600630&amp;abid=+5491162600630" rel="nofollow" title="Quiero hacer una consulta a Bidcom por WhatsApp" class="btn btn-success"><i class="fab fa-whatsapp"></i> Consultar</a>
    </div>
    <div class="separa-menu-mobile">&nbsp;</div>
                <a href="#" class="item-menu-mobile mobile-btn-menu" onclick="mostrar_submenu(0)">Electro, Audio y Video</a>
                  <a href="#" class="item-menu-mobile mobile-btn-menu" onclick="mostrar_submenu(1)">Hogar y Oficina</a>
                  <a href="#" class="item-menu-mobile mobile-btn-menu" onclick="mostrar_submenu(2)">Deportes y Aire Libre</a>
                  <a href="#" class="item-menu-mobile mobile-btn-menu" onclick="mostrar_submenu(3)">Drones y RC</a>
                  <a href="#" class="item-menu-mobile mobile-btn-menu" onclick="mostrar_submenu(4)">Seguridad y Vigilancia</a>
              <div class="separa-menu-mobile">&nbsp;</div>
      <a href="/donde-estamos" class="item-menu-mobile"><i class="fa fa-map-marker"></i> Sucursal</a>
      <a href="/medios-de-envio" class="item-menu-mobile"><i class="fa fa-truck"></i> Medios de Envío</a>
      <a href="/medios-de-pago" class="item-menu-mobile"><i class="fa fa-credit-card"></i> Medios de Pago</a>        
      <a href="/contacto/?tc=mayorista&amp;_wpcf7=3268&amp;_wpcf7_version=4.4.2&amp;_wpcf7_locale=es_ES&amp;_wpcf7_unit_tag=wpcf7-f3268-p22-o1&amp;_wpnonce=885a2e0ead&amp;your-name&amp;your-email&amp;telefono&amp;your-message&amp;_mc4wp_subscribe_contact-form-7=1" class="item-menu-mobile"><i class="fa fa-tags" aria-hidden="true"></i> Venta Mayorista</a>
      <a href="/contacto" class="item-menu-mobile"><i class="fa fa-envelope"></i> Contacto</a>
      <a href="/soporte" class="item-menu-mobile"><i class="fa fa-comments" aria-hidden="true"></i> Soporte Clientes</a>
    </div>
              <div id="submenu0" class="menu-mobile-layer-1 t2">
            <div class="categoria-menu-mobile">
              <a href="#" class="menu-mobile-back"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><span class="current-layer-menu">Electro, Audio y Video</span>
            </div>
                          <a href="/computacion">Computación</a>
                          <a href="/celulares-y-relojes">Celulares y Relojes</a>
                          <a href="/smart-tv-y-tv-box">TV y Video</a>
                          <a href="/fotografia-y-video/">Fotografía y Video</a>
                          <a href="/audio-bluetooth-y-mp3s/">Audio</a>
                          <a href="https://www.bidcom.com.ar/categorias/electronica-audio-video/electronica-para-el-automovil/">Electrónica para el Automóvil</a>
                    </div>
              <div id="submenu1" class="menu-mobile-layer-1 t2">
            <div class="categoria-menu-mobile">
              <a href="#" class="menu-mobile-back"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><span class="current-layer-menu">Hogar y Oficina</span>
            </div>
                          <a href="/smart-tv-y-tv-box/">TV y Video</a>
                          <a href="/iluminacion/">Iluminación</a>
                          <a href="/pequenos-electrodomesticos/">Pequeños Electrodomésticos</a>
                          <a href="/todo-para-empresas/">Todo para Empresas</a>
                          <a href="/hogar">Hogar</a>
                          <a href="/tecnologia-bebes/">Bebes y Niños</a>
                    </div>
              <div id="submenu2" class="menu-mobile-layer-1 t2">
            <div class="categoria-menu-mobile">
              <a href="#" class="menu-mobile-back"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><span class="current-layer-menu">Deportes y Aire Libre</span>
            </div>
                          <a href="/deportes-y-fitness/">Deportes y Fitness</a>
                          <a href="/miras-telescopicas-binoculares-y-mas/">Miras, Binoculares y Más</a>
                          <a href="/fotografia-y-video">Fotografía y video</a>
                          <a href="/relojes-deportivos/">Relojes Deportivos</a>
                          <a href="/audio-bluetooth-y-mp3s/">Audio</a>
                    </div>
              <div id="submenu3" class="menu-mobile-layer-1 t2">
            <div class="categoria-menu-mobile">
              <a href="#" class="menu-mobile-back"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><span class="current-layer-menu">Drones y RC</span>
            </div>
                          <a href="/autos-rc-electricos/">Autos a Radiocontrol</a>
                          <a href="/helicopteros-radio-control/">Helicópteros</a>
                          <a href="/drones/">Drones y Cuadricopteros</a>
                          <a href="/mini-rc/">Mini Radio Control</a>
                    </div>
              <div id="submenu4" class="menu-mobile-layer-1 t2">
            <div class="categoria-menu-mobile">
              <a href="#" class="menu-mobile-back"><i class="fa fa-arrow-left" aria-hidden="true"></i></a><span class="current-layer-menu">Seguridad y Vigilancia</span>
            </div>
                          <a href="/seguridad-y-vigilancia/">Cámaras de Video</a>
                          <a href="/grabadores-espia-voz-telefonico">Micrófonos GSM / Grabadores</a>
                          <a href="/handies/">Handies / Intercomunicadores</a>
                          <a href="/localizadores-gps/">Rastreadores GPS</a>
                          <a href="/alcoholimetros/">Test de Alcoholemia</a>
                          <a href="/miras-telescopicas-binoculares-y-mas/">Miras, Binoculares y Más</a>
                    </div>
         </div>
         <div class="navbar-collapse offcanvas-collapse right" id="navbarsExample01">
        <nav class="navbar navbar-expand-md u-header__navbar">
          <?php wp_nav_menu(
            array(
                  'theme_location'  => 'mobile',
                  'container_class' => 'navbar-collapse py-0',
                  'container_id'    => 'navBar',
                  'menu_class'      => 'navbar-nav  ml-lg-auto',
                  'fallback_cb'     => '',
                  'menu_id'         => 'main-menu-mobile',
                  'depth'           => 2,
                  'walker'          => new fw_Navwalker(''),
                )
            ); 
            if(fw_theme_mod('fw-quicklinks'))quicklinks();
            ?>
            </nav>
          </div>
      <div class="collapse navbar-collapse" id="navbarsExample02">
          <?php echo fw_search_form(3);?>
      </div>
     
</div>

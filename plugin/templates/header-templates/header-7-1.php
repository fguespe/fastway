<?php 
global $header_middle,$header_bottom;
?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div class="row flex-nowrap">
      <div class="col-4">
        <?php echo fastway_getLogo();?>
      </div>
      <div class="d-flex col-8 align-items-center"><?php fastway_getWidgetHeaderText();?></div>
    </div>
</div>

<div id="main-nav" class="row <?php echo esc_attr( $header_bottom ); ?>">
  <?php wp_nav_menu(
  array(
        'theme_location'  => 'primary',
        'container_class' => 'container d-flex flex-column flex-md-row justify-content-between',
        'container_id'    => '',
        'menu_class'      => 'nav d-flex  container d-flex flex-column flex-md-row justify-content-between',
        'fallback_cb'     => '',
        'menu_id'         => 'main-menu',
        'walker'          => new fw_Navwalker(),
      )
  ); 
  ?>
</div>
</div>

      
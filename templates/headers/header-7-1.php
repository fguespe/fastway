
<?php global $header_container,$header_middle,$header_container,$header_bottom; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
      <div class="row">
      <div class="col-4"><?php echo fw_logo();?></div>
      <div class="col-8 align-items-center d-flex"><?php echo fw_header_html();?></div>
    </div>
  </div>
</div>

<div id="main-nav" class="row <?php echo esc_attr( $header_bottom ); ?>">

<?php echo fw_menu("primary"); ?>
</div>
</div>

      
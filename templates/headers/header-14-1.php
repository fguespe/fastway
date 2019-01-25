<?php global $header_container,$header_middle,$header_container; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
      <div  class="<?php echo esc_attr( $header_container ); ?>">
        <nav class="navbar navbar-expand-md">
          <?php echo fw_logo();?>
          <div class="row d-flex mx-auto leftarriba">
            
            <?php echo fw_header_html();?>

            <?php echo fw_menu("primary"); ?>
        </div>
        </nav>
      </div>
</div>
<?php global $header_middle,$header_container; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div class="<?php echo esc_attr( $header_container ); ?>">
        <div  class="d-flex row justify-content-between <?php echo esc_attr( $header_container ); ?>">
            <?php echo fastway_getLogo();
            fw_mega_menu("primary"); 
            fw_header_html();?>
        </div>
    </div>
</div>
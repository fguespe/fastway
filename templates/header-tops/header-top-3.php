<?php global $header_container,$header_middle; ?>
<div class="<?php echo esc_attr( $header_middle ); ?>">
    <div  class="<?php echo esc_attr( $header_container ); ?>">
        <div class="row">
            <div class="col-4 form-row align-items-center" >
                <?php echo fw_search_form(1);?> 
            </div> 
            <div class="col-4 form-row align-items-center" >
                <?php echo fw_logo();?> 
            </div>       
            <div class="col-4 icons col-3 row align-items-center justify-content-center">
                <table  style="border: grey !important;">
                    <td>
                        <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" class="align-items-center justify-content-center"><?php echo fw_userAccount();?></td>
                    <td>
                        <?php echo fw_shoppingCart();?>
                    </td>
                </table>
            </div>
        </div>
  </div>
</div>

<?php
global $woocommerce_loop;

$columns=4;
$heading_start = '<h3 class="heading-title">'.$title.'</h3>';


?>
<?php if( strlen( $title ) > 0 ):?>
<?php echo $heading_start;?>
<?php endif;?>	

<div id="fwcarousel-cat" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
    <?php
    $i=0;
    echo '<div class="carousel-item active">';
    foreach ($products as $cat) {

        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true ); 

        // get the image URL
        $image = wp_get_attachment_url( $thumbnail_id ); 

        $titlecat=$cat->name;
        // print the IMG HTML
        echo "<div class='product-category product'>
        <img src='".$image."' alt='' width='762' height='365' />
        <span>".$titlecat."</span>
        </div>";

        $i++;
        if ($i % 4 == 0 ){
            if($i>1){
                echo '</div>';
            }
            echo '<div class="carousel-item">';
        }

        
   } ?>
</div>
</div>
<a class="carousel-control-prev d-flex p-2 align-left" href="#fwcarousel-cat" role="button" data-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#fwcarousel-cat" role="button" data-slide="next">
<span class="carousel-control-next-icon " aria-hidden="true"></span>
<span class="sr-only">Next</span>
</a>
</div>
<style type="text/css">

.carousel-control-prev-icon,
.carousel-control-next-icon{
    position: absolute;
    z-index: 2;
    width: 40px !important;
    height: 40px !important;
    border-radius: 50%!important;
    background: #ffffff;
    border: 1px solid #cccccc;
    cursor: pointer;
}

.carousel-control-prev-icon::after,
.carousel-control-next-icon::after{
    position: absolute;
    top: 13px;
    content: '';
    width: 12px;
    height: 12px;
    display: block;
    border-top: 1px solid #000000;
    border-right: 1px solid #000000;
}

.carousel-control-next-icon::after{
    transform: rotate(45deg);
    right: 15px;
}
.carousel-control-prev-icon::after{
    transform: rotate(225deg);
    left: 15px;
}


</style>
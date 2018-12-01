<?php
/**
 * Single Product Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 	3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( 'no' === get_option( 'woocommerce_enable_review_rating' ) ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

$vacia=false;

if ( $rating_count > 0 ) : ?>
	<div class="rating">
		<a href="" data-toggle="modal" data-target="#opiniones" >
			<? for($i=1;$i<=5;$i++){
				//error_log($i." ".$average." ".$avgint);
				if(!$vacia){
					if($i==floor($average) && floor($average)!==$average){
						$clase="-half ";$vacia=true;
					}
					else if($i>=$average)$vacia=true;
					else if($i<$average)$clase="";
					//else $vacia=true;
				}else{
					$clase=" star-vacia ";
				}
				echo '<i class="fa fa-star'.$clase.'" aria-hidden="true"></i>';
				if($i==floor($average) && floor($average)!==$average && $vacia){
					echo '<i class="fa fa-star-half star-vacia" aria-hidden="true"></i>';
				}
			}?>
		</a>
		<a href="" data-toggle="modal" data-target="#opiniones"> (Ver <span itemprop="reviewCount"><?php echo esc_html( $review_count ); ?> </span> opiniones)</a>
	</div>

<?php endif; ?>

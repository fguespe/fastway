<?php
add_filter( 'woocommerce_product_tabs', 'video_tab_f' );
function video_tab_f( $tabs ) {
  global $product;
  $json = get_post_meta($product->id, '_nth_wootabs', true );

  if (strpos($json, 'youtube') || strpos($json, '.mp4') ){

        $tabs['_tab_video'] = array(
          'title'   => __( 'Videos', 'woocommerce' ),
          'priority'  => 50,
          'callback'  => 'video_tab'
        );

  }
  
  return $tabs; 
}


function video_tab() {

  // The new tab content
  global $product;
  $json = get_post_meta($product->id, '_nth_wootabs', true );
  preg_match_all('~(?#!js YouTubeId Rev:20160125_1800)
        # Match non-linked youtube URL in the wild. (Rev:20130823)
        https?://          # Required scheme. Either http or https.
        (?:[0-9A-Z-]+\.)?  # Optional subdomain.
        (?:                # Group host alternatives.
          youtu\.be/       # Either youtu.be,
        | youtube          # or youtube.com or
          (?:-nocookie)?   # youtube-nocookie.com
          \.com            # followed by
          \S*?             # Allow anything up to VIDEO_ID,
          [^\w\s-]         # but char before ID is non-ID char.
        )                  # End host alternatives.
        ([\w-]{11})        # $1: VIDEO_ID is exactly 11 chars.
        (?=[^\w-]|$)       # Assert next char is non-ID or EOS.
        (?!                # Assert URL is not pre-linked.
          [?=&+%\w.-]*     # Allow URL (query) remainder.
          (?:              # Group pre-linked alternatives.
            [\'"][^<>]*>   # Either inside a start tag,
          | </a>           # or inside <a> element text contents.
          )                # End recognized pre-linked alts.
        )                  # End negative lookahead assertion.
        [?=&+%\w.-]*       # Consume any URL (query) remainder.
        ~ix', $json, $coincidencias, PREG_SET_ORDER);

  $urls = $coincidencias[0];
  // go over all links
  foreach($urls as $url) {
    if (strpos($url, 'youtube'))continue;
    
    echo '<div class="container_video"><iframe src="https://www.youtube.com/embed/'.$url.'" frameborder="0" allowfullscreen class="video_frame"></iframe></div>';
  }
}
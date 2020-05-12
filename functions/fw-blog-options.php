<?php

function fw_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'fw_custom_excerpt_length', 999 );
    
add_image_size( 'featured-thumb', 300, 200, true ); // (cropped)
function fw_recentposts_grid() {
    $rPosts = new WP_Query('showposts='.fw_theme_mod('fw_blog_per_page'));
    if(fw_theme_mod('fw_blog_columns')==2)$clase="col-md-6";
    if(fw_theme_mod('fw_blog_columns')==3)$clase="col-md-4";
    else if(fw_theme_mod('fw_blog_columns')==4)$clase="col-md-3";
    else if(fw_theme_mod('fw_blog_columns')==5)$clase="col-md-2";
    ?><div class="fw_blog d-flex flex-wrap flex-row" ><?php 
    while ($rPosts->have_posts()){
      $rPosts->the_post(); 
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumb' ); 
      $image_url = $image[0]; ?>
      <li class="fw_post_loop <?php echo $clase;?> col-sm-6" >
      <a href="<?php echo esc_url( get_permalink($post->ID) )?>">
          <div class="loopimg_container"><img src="<?php echo $image_url; ?>" width="100%"/></div>
        <h4 class="product_title"><?php  the_title();?></h4>
        <p class="excerpt 4"><?php the_excerpt(); ?></p>
        <span class="vermas" target="_blank"><?php echo fw_theme_mod('fw_label_read_more')?> </span>
      </a>
      </li>
    <?php }?>
    
    </div>
    
    <?php  wp_reset_query();
}
add_shortcode('fw_recentposts_grid', 'fw_recentposts_grid');


function fw_recentposts_ver() {
    $rPosts = new WP_Query('post_per_page='.fw_theme_mod('fw_blog_per_page'));
    ?><div class="fw_news" ><?php
    while ($rPosts->have_posts()) { $rPosts->the_post(); ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumb' ); ?>
    <?php $image_url = $image[0]; ?>
       <div class="fw_post_loop ver d-flex flex-row" >
          <div class="col-3 foto">
                <img src="<?php echo $image_url; ?>" />
          </div>
          <div class="col-9">
            <h4 class="title"><?php  the_title();?></h4>
            <p class="excerpt 4"><?php the_excerpt(); ?></p>
              <a href="<?php echo esc_url( get_permalink($post->ID) )?>" class="vermas" target="_blank">Leer más</a>
          </div>
        </div>
  <?php }?>
    </div>
    <?php  wp_reset_query();
};
add_shortcode('fw_recentposts_ver', 'fw_recentposts_ver');

if ( ! function_exists( 'understrap_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function understrap_posted_on() {
  $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
  if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
    $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> </time>';
  }
  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_attr( get_the_modified_date( 'c' ) )
  );
  if(fw_theme_mod('fw_blog_date_switch')){
  $posted_on = sprintf(
    esc_html_x( 'Subido el %s', 'post date', 'fastway' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );
  }

  if(fw_theme_mod('fw_blog_author_switch')){
    $byline = sprintf(
      esc_html_x( '%s', 'fastway' ),
      '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
    );
    echo '<span class="posted-on">' . $posted_on . '</span><span class="author"> por ' . $byline . '</span>'; // WPCS: XSS OK.
  }
}
endif;

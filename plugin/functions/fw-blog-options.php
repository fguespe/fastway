<?

function fw_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'fw_custom_excerpt_length', 999 );
    
add_image_size( 'featured-thumb', 300, 200, true ); // (cropped)
function fw_recentposts_hor() {
    $rPosts = new WP_Query();
    $rPosts->query('showposts=3');
    ?><div class="fw_news d-flex flex-row justify-content-between" ><? 
    while ($rPosts->have_posts()) : $rPosts->the_post(); ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumb' ); ?>
    <?php $image_url = $image[0]; ?>
       <div class="fw_post hor" >
          <div class="foto"><img src="<?php echo $image_url; ?>" width="100%"/></div>
          <h4 class="title"><?php the_title();?></h4>
          <p class="excerpt"><?php the_excerpt(); ?></p>
          <a href="" class="vermas" target="_blank">Leer más</a>
        </div>
        
    <?php endwhile;?>
    </div>
    <?  wp_reset_query();
};
add_shortcode('fw_recentposts_hor', 'fw_recentposts_hor');

function fw_recentposts_ver() {
    $rPosts = new WP_Query();
    $rPosts->query('showposts=3');
    ?><div class="fw_news" ><? 
    while ($rPosts->have_posts()) : $rPosts->the_post(); ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumb' ); ?>
    <?php $image_url = $image[0]; ?>
       <div class="fw_post ver d-flex flex-row" >
          <div class="col-3 foto">
                <img src="<?php echo $image_url; ?>" width="100%"/>
          </div>
          <div class="col-9">
              <h4><?php the_title();?></h4>
              <p><?php the_excerpt(); ?></p>
              <a href="" class="vermas" target="_blank">Leer más</a>
          </div>
        </div>
    <?php endwhile;?>
    </div>
    <?  wp_reset_query();
};
add_shortcode('fw_recentposts_ver', 'fw_recentposts_ver');
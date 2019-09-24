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
      <li class="fw_post <?php echo $clase;?> col-sm-6" >
      <a href="<?php echo esc_url( get_permalink($post->ID) )?>">
          <div class="foto"><img src="<?php echo $image_url; ?>" width="100%"/></div>
          <h4 class="title"><?php the_title();?></h4>
          <p class="excerpt"><?php the_excerpt(); ?></p>
          <span class="vermas" target="_blank"><?php echo fw_theme_mod('fw_label_read_more')?> </span>
      </a>
      </li>
    <?php }?>
    </div>
    <?php  wp_reset_query();
}
add_shortcode('fw_recentposts_grid', 'fw_recentposts_grid');


function fw_recentposts_ver() {
    $rPosts = new WP_Query();
    $rPosts->query('showposts=3');
    ?><div class="fw_news" ><?php
    while ($rPosts->have_posts()) { $rPosts->the_post(); ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'featured-thumb' ); ?>
    <?php $image_url = $image[0]; ?>
       <div class="fw_post ver d-flex flex-row" >
          <div class="col-3 foto">
                <img src="<?php echo $image_url; ?>" width="100%"/>
          </div>
          <div class="col-9">
              <h4><?php the_title();?></h4>
              <p><?php the_excerpt(); ?></p>
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
  $posted_on = sprintf(
    esc_html_x( 'Subido el %s', 'post date', 'fastway' ),
    '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
  );
  $byline = sprintf(
    esc_html_x( '%s', 'fastway' ),
    '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
  );
  echo '<span class="posted-on">' . $posted_on . '</span><span class="author"> por ' . $byline . '</span>'; // WPCS: XSS OK.
}
endif;

if ( ! function_exists( 'understrap_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function understrap_entry_footer() {
  // Hide category and tag text for pages.
  if ( 'post' === get_post_type() ) {
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list( esc_html__( ', ', 'fastway' ) );
    if ( $categories_list && understrap_categorized_blog() ) {
      printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'fastway' ) . '</span>', $categories_list ); // WPCS: XSS OK.
    }
    /* translators: used between list items, there is a space after the comma */
    $tags_list = get_the_tag_list( '', esc_html__( ', ', 'fastway' ) );
    if ( $tags_list ) {
      printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'fastway' ) . '</span>', $tags_list ); // WPCS: XSS OK.
    }
  }
  if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
    echo '<span class="comments-link">';
    comments_popup_link( esc_html__( 'Leave a comment', 'fastway' ), esc_html__( '1 Comment', 'fastway' ), esc_html__( '% Comments', 'fastway' ) );
    echo '</span>';
  }
  edit_post_link(
    sprintf(
      /* translators: %s: Name of current post */
      esc_html__( 'Edit %s', 'fastway' ),
      the_title( '<span class="screen-reader-text">"', '"</span>', false )
    ),
    '<span class="edit-link">',
    '</span>'
  );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function understrap_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'understrap_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
      'fields'     => 'ids',
      'hide_empty' => 1,
      // We only need to know if there is more than one category.
      'number'     => 2,
    ) );
    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );
    set_transient( 'understrap_categories', $all_the_cool_cats );
  }
  if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so components_categorized_blog should return true.
    return true;
  } else {
    // This blog has only 1 category so components_categorized_blog should return false.
    return false;
  }
}

/**
 * Flush out the transients used in understrap_categorized_blog.
 */
function understrap_category_transient_flusher() {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }
  // Like, beat it. Dig?
  delete_transient( 'understrap_categories' );
}
add_action( 'edit_category', 'understrap_category_transient_flusher' );
add_action( 'save_post',     'understrap_category_transient_flusher' );

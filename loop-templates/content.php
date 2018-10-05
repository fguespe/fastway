<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="fw_post vertical d-flex flex-row" >
          <div class="col-3 foto">
                <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
          </div>
          <div class="col-9">
              <h4><?php the_title();?></h4>
              <p><?php the_excerpt(); ?></p>
              <a href="<?php echo get_permalink()?>" class="vermas" target="_blank">Leer más</a>
          </div>
        </div>

</article><!-- #post-## -->

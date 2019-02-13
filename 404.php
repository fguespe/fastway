<?php 
get_header(); 
echo do_shortcode(stripslashes(htmlspecialchars_decode( fw_theme_mod('404_code'))));
get_footer(); ?>
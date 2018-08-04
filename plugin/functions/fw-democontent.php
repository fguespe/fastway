<?php
function ocdi_after_import_setup() {
  // Assign menus to their locations.
  $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
      'main-menu' => $main_menu->term_id,
    )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );

function ocdi_import_files() {
    $url="http://fastway/wp-content/themes/".wp_get_theme()->parent_theme."/demos/";

    return array(
        array(
            'import_file_name'           => 'Ian',
            'categories'                 => array( 'Category 1', 'Category 2' ),
            'import_file_url'            => $url.'demo2/wordpress.xml',
            'import_widget_file_url'     => $url.'demo2/widgets',
            'import_customizer_file_url' => $url.'demo2/customizer.dat',
            'import_redux'               => array(
                array(
                    'file_url'    => $url.'demo2/redux.json',
                    'option_name' => 'redux_demo',
                ),
            ),
            'import_preview_image_url'   => 'http://ian.briziolabz.com/wp-content/uploads/sites/17/2018/06/banner-header-b-1.jpg',
            'import_notice'              => __( 'Fijate de tener activado woocommerce, visual composer, metalslider y gravity forms. Acordarse de ir a ajustes y cambiar la pagina de inicio.', 'your-textdomain' ),
            'preview_url'                => 'http://www.your_domain.com/my-demo-1',
        ),
        array(
            'import_file_name'           => 'Demo Import 2',
            'categories'                 => array( 'New category', 'Old category' ),
            'import_file_url'            => 'http://www.your_domain.com/ocdi/demo-content2.xml',
            'import_widget_file_url'     => 'http://www.your_domain.com/ocdi/widgets2.json',
            'import_customizer_file_url' => 'http://www.your_domain.com/ocdi/customizer2.dat',
            'import_redux'               => array(
                array(
                    'file_url'    => 'http://www.your_domain.com/ocdi/redux.json',
                    'option_name' => 'redux_option_name',
                ),
                array(
                    'file_url'    => 'http://www.your_domain.com/ocdi/redux2.json',
                    'option_name' => 'redux_option_name_2',
                ),
            ),
            'import_preview_image_url'   => 'http://www.your_domain.com/ocdi/preview_import_image2.jpg',
            'import_notice'              => __( 'A special note for this import.', 'your-textdomain' ),
            'preview_url'                => 'http://www.your_domain.com/my-demo-2',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );
?>

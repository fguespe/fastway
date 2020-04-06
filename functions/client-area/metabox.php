<?php
//Adds custom items to menu
function custom_add_menu_meta_box( $object ) {
	add_meta_box( 'custom-menu-metabox', __( 'Fastway Client Area' ), 'custom_menu_meta_box', 'nav-menus', 'side', 'default' );
	return $object;
}
add_filter( 'nav_menu_meta_box_object', 'custom_add_menu_meta_box', 10, 1);

function custom_menu_meta_box(){
	global $nav_menu_selected_id;
	$walker = new Walker_Nav_Menu_Checklist();
	
	$current_tab = 'all';
	$authors = get_users( array( 'orderby' => 'nicename', 'order' => 'ASC', 'who' => 'authors' ) );
	$admins = array();
	if ( isset( $_REQUEST['authorarchive-tab'] ) && 'admins' == $_REQUEST['authorarchive-tab'] ) {
		$current_tab = 'admins';
	}elseif ( isset( $_REQUEST['authorarchive-tab'] ) && 'all' == $_REQUEST['authorarchive-tab'] ) {
		$current_tab = 'all';
	}
	/* set values to required item properties */
	$items=array(
            array(__('Pedidos','fastway'),'credit-card','edit.php?post_type=shop_order'),
            array(__('Reportes','fastway'),'bar-chart','admin.php?page=wc-reports'),
            array(__('Cupones','fastway'),'bullhorn','edit.php?post_type=shop_coupon'),
            array(__('Blog','fastway'),'rss','edit.php'),
            array(__('Productos','fastway'),'shopping-cart','edit.php?post_type=product'),
            array(__('Categorias','fastway'),'tags','edit-tags.php?taxonomy=product_cat&post_type=product'),
            array(__('Atributos','fastway'),'caret-square-o-down','edit.php?post_type=product&page=product_attributes'),
            array(__('Menus','fastway'),'bars','nav-menus.php'),
            array(__('Usuarios','fastway'),'users','users.php'),
            array(__('Media','fastway'),'image','upload.php'),
            array(__('Paginas','fastway'),'file-text','edit.php?post_type=page'),
            array(__('Comentarios','fastway'),'comments','edit-comments.php'),
            array(__('FAQ','fastway'),'question','edit.php?post_type=fw_faq'),
            
		);
	if(fw_theme_mod('fw_id_filesync'))array_push($items, array(__('Importación','fastway'),'upload','upload.php?page=enable-media-replace%2Fenable-media-replace.php&action=media_replace&attachment_id='.fw_theme_mod('fw_id_filesync')));

    $args = array(
        'post_type'         => 'fw_stblock',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'orderby'           => 'title',
        'order'             => 'ASC',
	);
	
    $blocks = get_posts( $args );
    foreach($blocks as $block) {
		count($block->post_name);
		array_push($items, array(__('Block-'.$block->post_name,'fastway'),'edit','post.php?post='.$block->ID.'&action=edit'));
	}
	if(!empty($blocks))array_push($items, array(__('Bloques','fastway'),'edit','edit.php?post_type=fw_stblock'));

	$authors=array();
	foreach ($items as $item) {
		$author=(object)[];
		$author->classes = array($item[1]);
		$author->type = 'custom';
		$author->object_id = $item[0];
		$author->title = $item[0];
		$author->object = 'custom';
		$author->url = $item[2];
		array_push($authors, $author);
	}
	
	$removed_args = array( 'action', 'customlink-tab', 'edit-menu-item', 'menu-item', 'page-tab', '_wpnonce' );
	?>
	<div id="authorarchive" class="categorydiv">
		<ul id="authorarchive-tabs" class="authorarchive-tabs add-menu-item-tabs">
			<li <?php echo ( 'all' == $current_tab ? ' class="tabs"' : '' ); ?>>
				<a class="nav-tab-link" data-type="tabs-panel-authorarchive-all" href="<?php if ( $nav_menu_selected_id ) echo esc_url( add_query_arg( 'authorarchive-tab', 'all', remove_query_arg( $removed_args ) ) ); ?>#tabs-panel-authorarchive-all">
					<?php _e( 'View All' ); ?>
				</a>
			</li><!-- /.tabs -->

			

		</ul>
		
		<div id="tabs-panel-authorarchive-all" class="tabs-panel tabs-panel-view-all <?php echo ( 'all' == $current_tab ? 'tabs-panel-active' : 'tabs-panel-inactive' ); ?>">
			<ul id="authorarchive-checklist-all" class="categorychecklist form-no-clear">
			<?php
				echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $authors), 0, (object) array( 'walker' => $walker) );
			?>
			</ul>
		</div><!-- /.tabs-panel -->

		

		<p class="button-controls wp-clearfix">
			<span class="list-controls">
				<a href="<?php echo esc_url( add_query_arg( array( 'authorarchive-tab' => 'all', 'selectall' => 1, ), remove_query_arg( $removed_args ) )); ?>#authorarchive" class="select-all"><?php _e('Select All'); ?></a>
			</span>
			<span class="add-to-menu">
				<input type="submit"<?php wp_nav_menu_disabled_check( $nav_menu_selected_id ); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-authorarchive-menu-item" id="submit-authorarchive" />
				<span class="spinner"></span>
			</span>
		</p>

	</div><!-- /.categorydiv -->
<?php
}
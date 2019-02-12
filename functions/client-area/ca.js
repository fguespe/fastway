function clasesbody(){
	var url=window.location.href;
	var partes=url.split("wp-admin/");
	var pagina=partes[1];
	var clase="escritorio";
	if(pagina=="index.php"){
		clase="escritorio";
	}else if(pagina=="edit.php?post_type=shop_order"){
		clase="pedidos";
	}else if(pagina=="admin.php?page=wc-reports"){
		clase="reportes";
	}else if(pagina=="edit.php?post_type=shop_coupon"){
		clase="cupones";
	}else if(pagina=="edit.php?post_type=product"){
		clase="productos";
	}else if(pagina=="edit-tags.php?taxonomy=product_cat&post_type=product"){
		clase="categorias";
	}else if(pagina=="edit.php?post_type=product&page=advanced_bulk_edit"){
		clase="edicionmasiva";
	}else if(pagina.includes("nav-menus.php")){
		clase="menus";
	}else if(pagina=="edit.php?post_type=product&page=product_attributes"){
		clase="atributos";
	}else if(pagina.includes("users.php") || pagina.includes("user-new.php")){
		clase="usuarios";
	}else if(pagina.includes('upload.php')){
		clase="importacion";
	}else if(pagina=="edit.php?post_type=faq"){
		clase="faq";
	}else if(pagina=="upload.php"){
		clase="imagenes";
	}else if(pagina=="edit.php"){
		clase="blog";
	}else if(pagina.includes('gf_entries')){
		clase="altamayoristas";
	}
	var agregar=" "+clase;
	document.body.className += agregar;
}

function iconosmenu(){
	var x=document.getElementsByClassName('ab-item');
	for (var i = 0; i < x.length; ++i) {
	    var obj =x[i];  
	    var item=obj.text;  
	    if(item)obj.className+=" estiloiconomenu titulo-"+item.replace(/ /g,'');
	}
}
window.onload = function() {

clasesbody();
iconosmenu();
}

jQuery(document).ready( function(jQuery) {
	jQuery('#wpb_visual_composer h2 span').html('ALTO WEB BUILDER');
});
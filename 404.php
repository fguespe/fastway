<?php get_header(); ?>
<div class="wrapper" id="page-wrapper">
<div class="container" id="content">
    <div class="content-detalle row"  style="margin:0 auto;margin-top:40px;margin-bottom:40px;">
		<div class="col-3">
            <i class="fal fa-debug" style="color:var(--main);font-size:200px;"></i>
        </div>
        <div class="col-9">
        <h1 class="txt-24 t2 tit-pagina" style="font-weight: 400;"><?=get_locale()=='es_ES'?'No encontramos productos que coincidan con tu búsqueda':'Oops! That page can&rsquo;t be found.';?></h1>
        <br>

        <?php if(get_locale()=='es_ES'){ ?>
            <b>Vamos a afinar tu puntería</b>
            <ul class="t1 txt-16">
                <li>Revisa la ortografía de la palabra</li>
                <li>Usa pocas palabras y más genéricas</li>
                <li>Ayudate con el menú y buscá por categorías</li>
            </ul>
        <?php } ?>
        <?php
        if(is_plugin_active('woocommerce/woocommerce.php')){
            do_shortcode('[fw_recent_products title="Lo más buscado esta semana" prodsperrow="6"]');
        }
        ?>
    </div>
    </div>
</div>

<?php  get_footer(); ?>

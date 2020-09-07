<?php get_header(); ?>
<div class="wrapper" id="page-wrapper">
<div class="container" id="content">
    <div class="content-detalle row"  style="margin:0 auto;margin-top:40px;margin-bottom:40px;">
		<div class="col-3">
            <i class="fal fa-debug" style="color:var(--main);font-size:200px;"></i>
        </div>
        <div class="col-9">
        <h1 class="txt-24 t2 tit-pagina" style="font-weight: 400;"><?=__('Oops! That page can&rsquo;t be found.')?></h1>
        <br>

     
        <b><?=__('Let\'s try again')?></b>
        <ul class="t1 txt-16">
            <li><?=__('Check your spelling')?></li>
            <li><?=__('Use fewer words and more common')?></li>
            <li><?=__('Use the menu to navigate the page, also check the url')?></li>
        </ul>
        <?php
        if(is_plugin_active('woocommerce/woocommerce.php')){
            do_shortcode('[fw_recent_products title="Lo más buscado esta semana" prodsperrow="6"]');
        }
        ?>
    </div>
    </div>
</div>

<?php  get_footer(); ?>

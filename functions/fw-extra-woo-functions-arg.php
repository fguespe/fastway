<?php
add_shortcode('altoweb_financiacion','getFinanciacion');
function getFinanciacion(){
global $product;
  $precio=$product->price;
  $cuotas6=floor($precio/6);
  $cuotas3=floor($precio/3);
  $infopopup_cash=do_shortcode('[datos_efectivo_popup]');
  ob_start();
  do_shortcode('[datos_bancarios_popup]');
  $infopopup_banc=ob_get_contents();
  ob_end_flush();
  return <<<HTML
  <div class="modal modalMediosPago fade" id="modalMediosPago" tabindex="-1" role="dialog" aria-labelledby="modalMediosPagoTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="mercadopago-tab" data-toggle="tab" href="#mercadopago" role="tab" aria-controls="mercadopago" aria-selected="true">MERCADOPAGO</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="todopago-tab" data-toggle="tab" href="#todopago" role="tab" aria-controls="todopago" aria-selected="false">TODOPAGO</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="banco-tab" data-toggle="tab" href="#banco" role="tab" aria-controls="banco" aria-selected="false">TRANSFERENCIA BANCARIA</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="efectivo-tab" data-toggle="tab" href="#efectivo" role="tab" aria-controls="efectivo" aria-selected="false">EFECTIVO</a>
               </li>
            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="mercadopago" role="tabpanel" aria-labelledby="mercadopago-tab">
                  <div class="full-width pull-left">
                     <div class="box-title">Tarjetas de crédito</div>
                     <div class="box-container">
                        <div class="pull-left full-width border-box">
                           <div class="installments-container">
                              <h4 class="">
                                 3 cuotas <span class="text-uppercase">sin interés</span> de <b>$ {$cuotas6}</b>
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span class="m-right-quarter"><span>CFT: </span><b>0,00%</b></span>
                                 <span class="m-right-quarter"><span>Total: </span><b>$ {$precio}</b></span>
                                 <span class="m-right-quarter"><span>En 1 pago: </span><b>$ {$precio}</b></span>
                              </div>
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-municipal@2x.png" class="card-img card-img-big" alt="Banco Municipal">
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-coinag@2x.png" class="card-img card-img-big" alt="Banco Coinag">
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia-mp@2x.png" class="card-img card-img-big" alt="Mercado Pago + Banco Patagonia">
                              <div class="divider"></div>
                           </div>
                           <div class="installments-container">
                              <h4 class="">
                                 3  cuotas <span class="text-uppercase">sin interés</span> de <b>$ {$cuotas3}</b>
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span class="m-right-quarter"><span>CFT: </span><b>0,00%</b></span>
                                 <span class="m-right-quarter"><span>Total: </span><b>$ {$precio}</b></span>
                                 <span class="m-right-quarter"><span>En 1 pago: </span><b>$ {$precio}</b></span>
                              </div>
                                <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-ciudad@2x.png" class="card-img card-img-big" alt="Banco Ciudad">
                                <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/fueguina@2x.png" class="card-img card-img-big" alt="Fueguina">
                                <!--<img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comafi@2x.png" class="card-img card-img-big" alt="Comafi Chicas">-->
                              <div class="divider"></div>
                           </div>
                           <div class="installments-container">
                              <h4 class="">
                                 12 cuotas con otras tarjetas
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span>O en 1 pago de: </span><b>$ {$precio}</b>
                              </div>
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/visa@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/mastercard@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/amex@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cabal@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/diners@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/nativa@2x.png" class="card-img card-img-big" alt="Nativa Mastercard">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia-mp@2x.png" class="card-img card-img-big" alt="Mercado Pago + Banco Patagonia">
                           <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-shopping@2x.png" class="card-img card-img-big" alt="Tarjeta Shopping">
                           <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-walmart@2x.png" class="card-img card-img-big" alt="Tarjeta Walmart">
                             
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-shopping@2x.png" class="card-img card-img-big" alt="Tarjeta Shopping">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/itau@2x.png" class="card-img card-img-big" alt="Itau">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia@2x.png" class="card-img card-img-big" alt="Banco Patagonia">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/HSBC@2x.png" class="card-img card-img-big" alt="HSBC">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/galicia@2x.png" class="card-img card-img-big" alt="Banco Galicia">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-hipotecario@2x.png" class="card-img card-img-big" alt="Banco Hipotecario">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/macro@2x.png" class="card-img card-img-big" alt="Macro">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/santander-rio@2x.png" class="card-img card-img-big" alt="Banco Santander Rio S.A.">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/supervielle@2x.png" class="card-img card-img-big" alt="Banco Supervielle">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-frances@2x.png" class="card-img card-img-big" alt="BBVA Frances">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/ICBC@2x.png" class="card-img card-img-big" alt="ICBC">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-industrial@2x.png" class="card-img card-img-big" alt="Banco Industrial">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-nacion@2x.png" class="card-img card-img-big" alt="Banco Nacion">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comafi@2x.png" class="card-img card-img-big" alt="Banco Comafi">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-entre-rios@2x.png" class="card-img card-img-big" alt="Nuevo Banco de Entre Rios">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santa-fe@2x.png" class="card-img card-img-big" alt="Nuevo Banco de Santa Fe">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-santa-cruz@2x.png" class="card-img card-img-big" alt="Banco Santa Cruz">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-sanjuan@2x.png" class="card-img card-img-big" alt="Banco San Juan">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-tucuman@2x.png" class="card-img card-img-big" alt="Tucuman">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-provincia@2x.png" class="card-img card-img-big" alt="Banco Provincia">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-la-pampa@2x.png" class="card-img card-img-big" alt="Banco de La Pampa">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/bica@2x.png" class="card-img card-img-big" alt="Banco Bica">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-columbia@2x.png" class="card-img card-img-big" alt="Banco Columbia">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cencosud@2x.png" class="card-img card-img-big" alt="Cencosud">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/nativa@2x.png" class="card-img card-img-big" alt="Nativa Mastercard">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-walmart@2x.png" class="card-img card-img-big" alt="Tarjeta Walmart">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/carta-automatica@2x.png" class="card-img card-img-big" alt="Carta Automática">
                              <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comercio@2x.png" class="card-img card-img-big" alt="Banco de Comercio">
      
                           </div>
                        </div>
                     </div>
                     <div class="box-title">Tarjeta de débito y efectivo</div>
                     <div class="box-container">
                        <h4 class="">Débito</h4>
                        <div class="h6-xs m-bottom-half">
                           <span>Precio: </span><b> $ {$precio}</b>
                        </div>
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/visadebit@2x.png" class="card-img card-img-big">
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/mastercarddebit@2x.png" class="card-img card-img-big">
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cabaldebit@2x.png" class="card-img card-img-big">
                        <div class="divider"></div>
                        <h4 class="">Efectivo</h4>
                        <div class="h6-xs m-bottom-half">
                           <span>Precio: </span><b> $ {$precio}</b>
                        </div>
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/pagofacil@2x.png" class="card-img card-img-big">
                        <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/rapipago@2x.png" class="card-img card-img-big">
                        <div class="divider"></div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="todopago" role="tabpanel" aria-labelledby="todopago-tab">
                  <div class="full-width pull-left">
                     <div class="box-title">Tarjetas de crédito</div>
                     <div class="box-container">
                        <div class="pull-left full-width border-box">
                           <div class="installments-container">
                              <h4 class="">
                                 3 cuotas <span class="text-uppercase">sin interés</span> de <b>$ $precio</b>
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span class="m-right-quarter"><span>CFT: </span><b>0,00%</b></span>
                                 <span class="m-right-quarter"><span>Total: </span><b>$ {$precio}</b></span>
                                 <span class="m-right-quarter"><span>En 1 pago: </span><b>$ {$precio}</b></span>
                              </div>
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/visa@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/mastercard@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/amex@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/cabal@2x.png" class="card-img card-img-medium">
                            <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/diners@2x.png" class="card-img card-img-medium">
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
               <div class="tab-pane fade" id="banco" role="tabpanel" aria-labelledby="banco-tab">
                  <div class="box-container">
                     <p class="weight-strong m-bottom-half">Cuando termines la compra vas a ver la información de pago en relación a esta opción.</p>
                     <p>{$infopopup_banc}</p>
                     <h4>
                        <span class="m-right-quarter">Total:</span><b>$ {$precio}</b>
                     </h4>
                  </div>
               </div>
               <div class="tab-pane fade" id="efectivo" role="tabpanel" aria-labelledby="efectivo-tab">
                  <div class="box-container">
                     <p class="weight-strong m-bottom-half">Pagá de contado en nuestro local.</p>
                     <p>{$infopopup_cash}</p>
                     <h4>
                        <span class="m-right-quarter">Total:</span><b>$ {$precio}</b>
                     </h4>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
HTML;
}
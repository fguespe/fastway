<?php





function getFinanciacion($product){
  $precio=$product->price;
  return <<<HTML
  <div class="modal modalMediosPago fade" id="modalMediosPago" tabindex="-1" role="dialog" aria-labelledby="modalMediosPagoTitle" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">MERCADOPAGO</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">TODOPAGO</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">A CONVENIR O TRANSFERENCIA BANCARIA</a>
               </li>
            </ul>
            <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="full-width pull-left">
                     <div class="box-title">Tarjetas de crédito</div>
                     <div class="box-container">
                        <div class="pull-left full-width border-box">
                           <div class="installments-container">
                              <h4 class="">
                                 6  cuotas <span class="text-uppercase">sin interés</span> de <b>$ {$precio}</b>
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span class="m-right-quarter"><span>CFT: </span><b>0,00%</b></span>
                                 <span class="m-right-quarter"><span>Total: </span><b>$ {$precio}</b></span>
                                 <span class="m-right-quarter"><span>En 1 pago: </span><b>$ {$precio}</b></span>
                              </div>
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/provencred@2x.png" class="card-img card-img-big" alt="Provencred">
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-municipal@2x.png" class="card-img card-img-big" alt="Banco Municipal">
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/tarjeta-saenz@2x.png" class="card-img card-img-big" alt="Banco Saenz">
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/efectivo-si@2x.png" class="card-img card-img-big" alt="Efectivo Si">
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-coinag@2x.png" class="card-img card-img-big" alt="Banco Coinag">
                             <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-patagonia-mp@2x.png" class="card-img card-img-big" alt="Mercado Pago + Banco Patagonia">
                              <div class="divider"></div>
                           </div>
                           <div class="installments-container">
                              <h4 class="">
                                 6  cuotas <span class="text-uppercase">sin interés</span> de <b>$ {$precio}</b>
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span class="m-right-quarter"><span>CFT: </span><b>0,00%</b></span>
                                 <span class="m-right-quarter"><span>Total: </span><b>$ {$precio}</b></span>
                                 <span class="m-right-quarter"><span>En 1 pago: </span><b>$ {$precio}</b></span>
                              </div>
                                <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-ciudad@2x.png" class="card-img card-img-big" alt="Banco Ciudad">
                                <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/fueguina@2x.png" class="card-img card-img-big" alt="Fueguina">
                                <img src="//d26lpennugtm8s.cloudfront.net/assets/common/img/logos/payment/new_logos_payment/ar/banco-comafi@2x.png" class="card-img card-img-big" alt="Comafi Chicas">
                              <div class="divider"></div>
                           </div>
                           <div class="installments-container">
                              <h4 class="">
                                 12 cuotas con otras tarjetas
                              </h4>
                              <div class="legal-info p-bottom-half">
                                 <span>O en 1 pago de: </span><b>$ {$precio}</b>
                              </div>
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
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="full-width pull-left">
                     <div class="box-title">Tarjetas de crédito</div>
                     <div class="box-container">
                        <div class="pull-left full-width border-box">
                           <div class="installments-container">
                              <h4 class="">
                                 6  cuotas <span class="text-uppercase">sin interés</span> de <b>$ $precio</b>
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
               <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="box-container">
                     <p class="weight-strong m-bottom-half">Cuando termines la compra vas a ver la información de pago en relación a esta opción.</p>
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
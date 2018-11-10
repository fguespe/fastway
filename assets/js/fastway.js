function remove_item_cart(element) {
   
    var product_id = jQuery('#'+element.id).attr("data-product_id"),
        cart_item_key = jQuery('#'+element.id).attr("data-cart_item_key"),
        product_container = jQuery('#'+element.id).parents('.mini_cart_item');
    product_container.attr("style", "display: none !important");
    jQuery("<div class='loading-div'><img style='margin: 7px 0px 0px 0px;' src='/wp-admin/images/spinner-2x.gif' /></div>").insertBefore(product_container);
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        url: wc_add_to_cart_params.ajax_url,
        data: {
            action: "product_remove",
            product_id: product_id,
            cart_item_key: cart_item_key
        },
        success: function(response) {
            if ( ! response || response.error )
                return;
            var fragments = response.fragments;
            // Replace fragments
            if ( fragments ) {
                jQuery.each( fragments, function( key, value ) {
                    jQuery( key ).replaceWith( value );
                });
            }
        }
    });
}
function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
};
function applySearch(tipo){

  var jQuerysearchWrap = jQuery('.search-form-'+tipo),
      jQuerysearchField = jQuery('.search-form-'+tipo+' .search-field'),
      jQueryloadingIcon = jQuery('.search-form-'+tipo+' .loading'),
      termExists = "";

    // Add results container and disable autocomplete on search field
  jQuerysearchWrap.append('<div class="results"></div>');
  var jQuerysearchResults = jQuery('.search-form-'+tipo+' .results');
  jQuerysearchField.attr('autocomplete', 'off');
  
  // Perform search on keyup in search field, hide/show loading icon
  jQuerysearchField.keyup( function() {
    jQueryloadingIcon.css('display', 'block');
    
    // If the search field is not empty, perform the search function
    if( jQuerysearchField.val() !== "" ) {
      termExists = true;
      doSearch();
    } else {
      termExists = false;
      jQuerysearchResults.empty();
      jQueryloadingIcon.css('display', 'none');
    }
  });
  
  // Make search Ajax request every 200 milliseconds, output results
  var doSearch = debounce(function() {
    var query = jQuerysearchField.val();
    jQuery.ajax({
      type: 'POST',
      url: ajaxurl, // ajaxurl comes from the localize_script we added to functions.php
      data: {
        action: 'ajax_search',
        query: query,
      },
      success: function(result) {
        if ( termExists ) {
          // `result` here is what we've specified in ajax-search.php
          jQuerysearchResults.html('<div class="results-list">' + result + '</div>');
        }
      },
      complete: function() {
        // Whether or not results are returned, hide the loading icon once the request is complete
        jQueryloadingIcon.css('display', 'none');
      }
    });
  }, 200);
}
jQuery(document).ready( function(jQuery) {
  applySearch("desktop");
  applySearch("mobile");
  jQuery(document).on('click', '#main-menu .dropdown-menu', function (e) {
    //e.preventDefault();
      e.stopPropagation();
  });
  jQuery(document).on('click', '#main-menu-mobile .dropdown-menu', function (e) {
    //e.preventDefault();
      e.stopPropagation();
  });
  jQuery(document).on('click', '#page-wrapper', function (e) {
      jQuery('.offcanvas-collapse.open').toggleClass('open');
        jQuery('.menu-madre-mobile').removeClass('opened');
  });
  jQuery('[data-toggle="offcanvas"]').on('click', function () {
    jQuery('.offcanvas-collapse').toggleClass('open');
  });
  jQuery('.btn-bars-mobile').click(function(){
      jQuery('.menu-madre-mobile').addClass('opened');
  });    

});

jQuery(document).click(function(e) {
  if ((e.target != jQuery('.offcanvas')[0]) && (e.target != jQuery('.offcanvas-toggle')[0]) && (jQuery('body').hasClass('offcanvas-expanded'))) {
    var li_tags = jQuery(jQuery('.offcanvas')[0]).find('li');
    var a_tags = jQuery(jQuery('.offcanvas')[0]).find('a');
    for (var i = 0; i < li_tags.length; i++) {
      if (e.target == li_tags[i] || e.target == a_tags[i]) {
        return;
      }
    }
    jQuery('.offcanvas-collapse').toggleClass('open');
  }
});
jQuery(document).ready(function() {
    // Run on page load
    window.onload = function () {

        var URLactual = window.location;
        //console.log(URLactual);
        //console.log(URLactual.origin);
        
        //console.log(URLactual.pathname);

        var resultado = URLactual.origin.search("www");

        var urlFinal = URLactual.origin;
        var pathname = URLactual.pathname.split('/');

        if (resultado != -1) {//significa que esta www en la url
            console.log('entre');
            urlFinal = urlFinal.split('www.');
        }else {
            urlFinal = urlFinal.split('//');
        }

        pathname = pathname[1];        
        urlFinal = urlFinal[1]+'*'+pathname;
                
        //console.log(urlFinal); 
        

        var anuncio = getQueryVariable("anuncio-mcrm");
        var anuncionOpcional="/" + 0;

        if (anuncio) {
            
            anuncionOpcional= "/" + anuncio;
       
            //if (sessionStorage.getItem('anuncio-mcrm') == null)
                sessionStorage.setItem('anuncio-mcrm', anuncio);
            var xhttp1 = new XMLHttpRequest();
            xhttp1.onreadystatechange = function () {   
                if (this.readyState == 4 && this.status == 200) {
                    //alert(this.responseText);
                }
            };
            xhttp1.open("GET", "http://leadsnowcrm.com/sumarVisita/" + sessionStorage.getItem('anuncio-mcrm'), true);
            //xhttp1.open("GET", "http://mcrm.doublepoint.com.ar/sumarVisita/" + sessionStorage.getItem('anuncio-mcrm'), true);
            xhttp1.send();
        } 

            const element = document.querySelector('form');
            
            element.addEventListener('submit',function(event){
                event.preventDefault();
            var name = document.getElementById("input_2_1").value;
            var email = document.getElementById("input_2_4").value;
            var mensaje = document.getElementById("input_2_6").value;
            var phone = document.getElementById("input_2_3").value;
           
            if (name != "" && email != "") {
          
                if (mensaje == "" || mensaje == null) {
                    mensaje = "-";
                }
                if (phone == null) {
                    phone = "-";
                }else{
                    if (phone != "") {
                        phone = phone;
                    }else{
                        phone = "-";
                    }
                }
                console.log(name+"/"+email+"/"+phone);
            
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        //alert(this.responseText);
                        //element.submit();
                    }
                };

                var link = "http://leadsnowcrm.com/storFromForm/" + name + "/" + email + anuncionOpcional + "/" + mensaje + "/" + phone + "/" + urlFinal;
                //var link = "http://mcrm.doublepoint.com.ar/storFromForm/" + name + "/" + email + anuncionOpcional + "/" + mensaje + "/" + phone + "/" + urlFinal;
                console.log(link);
                xhttp.open("GET", link, true);
                xhttp.send();
            } else {
              console.log('Los campos Nombre e E-mail son obligatorios');
            }
        });
        

        function getQueryVariable(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (pair[0] == variable) {
                    return pair[1];
                }
            }
        }

    }
});

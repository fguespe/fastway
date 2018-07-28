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

jQuery(document).ready( function(jQuery) {


  // Set up variables for each of the pertinent elements
  var jQuerysearchWrap = jQuery('.search-form'),
      jQuerysearchField = jQuery('.search-form .search-field'),
      jQueryloadingIcon = jQuery('.search-form .loading'),
      termExists = "";
  
  // Debounce function from https://davidwalsh.name/javascript-debounce-function
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
  
  // Add results container and disable autocomplete on search field
  jQuerysearchWrap.append('<div class="results"></div>');
  var jQuerysearchResults = jQuery('.search-form .results');
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
  
});
jQuery(document).ready( function($) {


  // Set up variables for each of the pertinent elements
  var $searchWrap = $('.search-form'),
      $searchField = $('.search-form .search-field'),
      $loadingIcon = $('.search-form .loading'),
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
  $searchWrap.append('<div class="results"></div>');
  var $searchResults = $('.search-form .results');
  $searchField.attr('autocomplete', 'off');
  
  // Perform search on keyup in search field, hide/show loading icon
  $searchField.keyup( function() {
    $loadingIcon.css('display', 'block');
    
    // If the search field is not empty, perform the search function
    if( $searchField.val() !== "" ) {
      termExists = true;
      doSearch();
    } else {
      termExists = false;
      $searchResults.empty();
      $loadingIcon.css('display', 'none');
    }
  });
  
  // Make search Ajax request every 200 milliseconds, output results
  var doSearch = debounce(function() {
    var query = $searchField.val();
    $.ajax({
      type: 'POST',
      url: ajaxurl, // ajaxurl comes from the localize_script we added to functions.php
      data: {
        action: 'ajax_search',
        query: query,
      },
      success: function(result) {
        if ( termExists ) {
          // `result` here is what we've specified in ajax-search.php
          $searchResults.html('<div class="results-list">' + result + '</div>');
        }
      },
      complete: function() {
        // Whether or not results are returned, hide the loading icon once the request is complete
        $loadingIcon.css('display', 'none');
      }
    });
  }, 200);
  
});
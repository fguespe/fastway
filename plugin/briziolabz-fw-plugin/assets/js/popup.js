if ( window.location.pathname == '/'  ||  window.location.pathname == "/wordpress/tiendacira/"){
 jQuery(document).ready( function($) {
  $('body').prepend('<div id="light" class="white_content"><i id="cerrarpopup" class="fa fa-times"/><a href="'+popup.link+'" target="_self"><img src="'+popup.src+'" width="100%"></div><div id="fade" class="black_overlay"></div></a>');
     
  document.getElementById('light').style.display='block';
  document.getElementById('fade').style.display='block';
  $('body').click(function() {
      document.getElementById('light').style.display='none';
      document.getElementById('fade').style.display='none';
  });
  $('#cerrarpopup').click(function() {
      document.getElementById('light').style.display='none';
      document.getElementById('fade').style.display='none';
  });
});
}


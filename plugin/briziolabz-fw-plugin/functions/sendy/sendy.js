(function( $ ) {   
    function newletter(e){
		e.preventDefault(); 
		var email = $('#email_newletter').val()
		$.post(NexThemes.ajax_url, {email:email,action: 'custom_send_newletter'},
		  function(data) {
		      if(data)
		      {
		      	if(data=="Some fields are missing.")
		      	{
			      	$(".newletter_message").text("Error");
                    $(".newletter_message").css("color", "red");
		      	}
		      	else if(data=="Invalid email address.")
		      	{
			      	$(".newletter_message").text("Mail invalido");
                    $(".newletter_message").css("color", "red");
		      	}
		      	else if(data=="Invalid list ID.")
		      	{
			      	$(".newletter_message").text("Lista invalida.");
                    $(".newletter_message").css("color", "red");
		      	}
		      	else if(data=="Already subscribed.")
		      	{
			      	$(".newletter_message").text("Ya estas en la lista!");
                        $(".newletter_message").css("color", "red");
		      	}
		      	else
		      	{
			      	 $(".newletter_message").text("Exito!");
                        $(".newletter_message").css("color", "green");
		      	}
		      }
		      else
		      {
		      	alert("Hubo un error. Intenta mas tarde.");
		      }
		  }
		);
	}
	$("#email_newletter").keypress(function(e) {
		    if(e.keyCode == 13) {
		    	e.preventDefault(); 
				newletter(e);
		    }
		});
	$("#button_newletter").click(function(e){
		e.preventDefault(); 
		newletter(e);
	});
 
})(jQuery);
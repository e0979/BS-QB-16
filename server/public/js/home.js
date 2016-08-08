$(document).ready(function(e) {
	
		//Login
		$('#login').validate({
			rules: {},
					
			submitHandler: function(form) {
						
					$('.send').attr('disabled', 'disabled'); //prevent double send
						
					$.ajax({
					  type: "POST",
					  url: URL+"home/login/",
					  data: $(form).serialize(),
					  timeout: 12000,
					  success: function(response) {
						 console.log('('+response+')');
						 response = (response.trim());
						 switch (response) {
						 	case 'timeout':
							 	
							 	var htmlz = "<div>¿tienes internet? pacere que hay problemas de conexión</div>";
							 	
							 	$('.send').removeAttr("disabled");
							 	$( "#response" ).addClass('alert alert-warning');							 	
							 	$( "#response" ).slideDown(500);
							 	$(htmlz).hide().appendTo("#response").fadeIn(1000).delay(3000).fadeOut( function(){
							 		$( "#response" ).slideUp(500);
							 	});
							 	
						 		break;
						 	
						 	case 'user':
							 	
							 	var htmlz = "<div>Usuario Inválido</div>";
							 	
							 	$('.send').removeAttr("disabled");
							 	$( "#response" ).addClass('alert alert-danger');							 	
							 	$( "#response" ).slideDown(500);
							 	$(htmlz).hide().appendTo("#response").fadeIn(1000).delay(3000).fadeOut( function(){
							 		$( "#response" ).slideUp(500);
							 	});
							 	
						 		break;
						 	
						 
						 		
						 	case 'pass':
						 	
						 		var htmlz = "<div>Clave incorrecta</div>";
						 		
						 		$('.send').removeAttr("disabled");
							 	$( "#response" ).addClass('alert alert-danger');							 	
							 	$( "#response" ).slideDown(500);
							 	$(htmlz).hide().appendTo("#response").fadeIn(1000).delay(3000).fadeOut( function(){
							 		$( "#response" ).slideUp(500);
							 	});
							 	
						 		break;
						 	case 'welcome':
							 	document.location = URL+'home/welcome';					 	
						 		break;

						 	
				              				             
						 }
						 
						 // $('#success').bPopup({ modal: false });
					  },
					  error: function(obj, errorText, exception){
						 console.log(errorText);
						 						 
					  }
					});
					return false;
				}
	});		
});
		
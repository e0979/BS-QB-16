var modo = 'server'//local or server

if (modo === 'local') {
	//var URL = "http://192.168.1.107/Edil/Web/";
	var URL = "http://localhost/niuQuinbi/";
		
	var position = 2;

} else {
	var URL = "http://quinbi.besign.com.ve/";
	
	var position = 1;

}

var f = 'bootstrap3';
//Add Method for URL no http
jQuery.validator.addMethod("web", function(value, element) {
     return this.optional(element) || /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/   .test(value);
    
}, "Introduzca un url válido");

jQuery.validator.addMethod("rifnoguion", function(value, element) {
     return this.optional(element) || /^(V|E|P|J|G)([0-9]{9})$/i.test(value);
    //^(V|E|P|J|G)\d{9}$
    ///^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
    
}, "Sólo letras mayúsculas y números");

jQuery.validator.addMethod("rif", function(value, element) {
     return this.optional(element) || /^(j|J)(-)([0-9]{8})(-)([0-9]{1})$/i.test(value);
    
}, "Introduzca RIF como J-12345678-9");

//Change Validation default Messages
jQuery.extend(jQuery.validator.messages, {
    required: "requerido",
    remote: "Please fix this field.",
    email: "Hay un error con el correo.. revisalo!",
    url: "Esto no parece un URL...",
    date: "Please enter a valid date.",
    dateISO: "Please enter a valid date (ISO).",
    number: "Please enter a valid number.",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "Please enter the same value again.",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Please enter at least {0} characters."),
    rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
    range: jQuery.validator.format("Please enter a value between {0} and {1}."),
    max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
    min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

// Caracteres extraños, acentos y eñes
var normalize = (function() {
	var from = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç",
		  to   = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc",
		  mapping = {};
	 
	  for(var i = 0, j = from.length; i < j; i++ )
		  mapping[ from.charAt( i ) ] = to.charAt( i );
	 
	  return function( str ) {
		  var ret = [];
		  for( var i = 0, j = str.length; i < j; i++ ) {
			  var c = str.charAt( i );
			  if( mapping.hasOwnProperty( str.charAt( i ) ) )
				  ret.push( mapping[ c ] );
			  else
				  ret.push( c );
		  }
		  return ret.join( '' );
	  } 
})();

 


$(document).ready(function(e) {
	
	$.fn.editable.defaults.mode = 'inline';
	//To determine the page then run only certain code
	//var css_flag =  $('body').data('page');	
	//Change URL so user can be Allowed if refresh
	
	function getPage(position){
	
		var pathArray = window.location.pathname.split( '/' );
		var accessToArray = pathArray[position];
		console.log("Access:" + accessToArray)
		return accessToArray;
	
	}
	
	function loadDomains(){
		
		$.post(URL+"dominios/load/all", function(data){
			
			$('#dominios-list-body').hide().html(data).fadeIn('slow');
		});
		
		console.log(URL);
		
		return false;
			
	}
	
	function loadDomainDetails(id) {
		
		
		$.post(URL+"dominios/load/details/"+ id, function(data){
			
			$('#years-details-'+id).hide().html(data).fadeIn('slow');
			initDomainDetails();

		});
			
		
		return false;
	}

	var flag =	getPage(position);								
	
	switch(flag) {
		
		case 'dominios':
			
			
			$('#redireccion').hide();
			
					
			$(".chosen-select").select2( { 
				placeholder: 'Seleccione...',
				width: '100%' 
			});
			
			$('.datepicker').datepicker({});			 			
			
					
			$('#list-results').dataTable( {
				"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
				"sPaginationType": "bootstrap",
			    "iDisplayLength": 5,
				"oLanguage": {
					"sLengthMenu": "_MENU_ items por pag"
				}
			});
			
			$('.closecollapse').click(function() {				
				$('.detalles').collapse('toggle');	
			});
			
			$('select[name=hosting]').change(function(e){
			  if ($('select[name=hosting]').val() == 'redireccionado'){
			    $('#redireccion').show();
			  }else{
			    $('#redireccion').hide();
			  }
			});
			
			$('.details-loader').click(function() {
				var valor =	$(this).attr('href');
				var array  = 	valor.split( '-' );				
				loadDomainDetails(array[1]);
			});
			
			//RENEWALS
			//This shows the renewal financial info but still doesnt create until clear payment 
			 $('[name="renewal"]').change(function(){
					
					var valor 	 =  $(this).val();
			    	//If Renewal YES
			    	if (valor === 'si') {
			    		var group_id =	$(this).attr('id');
			    		var id = group_id.substring(group_id.lastIndexOf("-") + 1, group_id.length);	
			    		//Open slider to show info
			    		loadDomainDetails(id);		    		
			    		setTimeout(function() { 
			    			$('#details-'+id).collapse('show');	
			    			$('#boton-'+id).show(); 
			    		}, 600);   				    		
			    	}	
			 });
			 
			 
			//This button triggers the creation of the renewal
			$('[name="renew"]').change(function(){
					
					var valor 	 =  $(this).attr('id');					
					var renewalArray  = 	valor.split( '-' );
					
					var anio 		= renewalArray[1];
					var id_domain	= renewalArray[2];
					
			    	
			    	$(this).attr('disabled', 'disabled');
			    	  $.ajax({
						type: "POST",
						url: "add/renewal",
						data: { year: anio, domain_id: id_domain },
						timeout: 5000,
						success: function(response) {
							console.log('works'+response);
							//Update 'details-'+id_domain
							loadDomainDetails(id_domain);
						},
						error: function(response) {
							console.log('error: '+response);
							
						}
					});
			    	
			 });
			//RENEWALS
			 
			 
			$(document).on("change", ".form", function(){
			    
			     $.ajax({
					type: "POST",
					url: "update",
					data: $(this).serialize(),
					timeout: 5000,
					success: function(response) {
						console.log('works'+response);
					},
					error: function(response) {
						console.log('error: '+response);
						
					}
				});
				
				
				
			});
			
			
			//Add Domain
			$('#add-domain').validate({
				
				rules: {
				   domain: {
		                web: true,
		                required: true,
		           },
				    domain_creationdate: "required",
				    hosting: "required",
				    registrant: "required",
				    cliente: "required",
				},			
				submitHandler: function(form) {
					$.ajax({
					  type: "POST",
					  url: "add/domain",
					  data: $(form).serialize(),
					  timeout: 5000,
					  success: function(response) {
						  console.log('works'+response);
						   $('#add-domain').closest('form').find("input, textarea, select").val("");						   
						   //$('#add-domain').modal('hide');				  
						   $('#confirm').bPopup({ modal: false });
						// Updates Domain list	   
						   loadDomains();
						   	
					  },
					  error: function(response) {
						  console.log(response);
						  $('#add-domain').animate({opacity: 0, left: "-=300", }, 800);
						  $('#failed').bPopup({ modal: false });
					  }
					});
					return false;
				}
			});
		
			break;
			
			
		default:
			//console.log(flag);
			break;
		
	}	
		
		
    $('#profile').hover(function (){
		$('#profile-icon').toggleClass('animated rotateAlone');
	});
	
	initHome();
	
	
	// Mensaje tipo Tooltip en Botones ".actions"
	$('.actions').hover(function () {
		var mensaje = $(this).attr('id');
		$('.details').toggleClass(mensaje);
	});
	
	
	
	/* Campos Adicionales  en Formulario */
	var phonesDiv = $('#phonenumbers');
    var f = $('#phonenumbers p').size() + 1;
	
	
	var emailsDiv = $('#emailaddresses');
	var g = $('#emailaddresses p').size() + 1;
	
	//TODO unificar funcion de agregar campos
	
	$('.action-icon-add-email').bind('click', function() {
		
		var fieldToAdd = '<div><input type="email" name="tlf' + g +'" placeholder="Otro Email" /><i class="icon-minus-sign action-icon-delete"></i></div>';
		
		$(fieldToAdd).appendTo(emailsDiv);
        g++;
        return false;		
    });
        
		
	
	       
    $('.action-icon-add').bind('click', function() {
		
		var fieldToAdd = '<div><input type="text" name="tlf' + f +'" placeholder="Otro teléfono" /><i class="icon-minus-sign action-icon-delete"></i></div>';
		
		$(fieldToAdd).appendTo(phonesDiv);
		$("[name='tlf"+f+"']").mask("(0999) 999.99.99");
        f++;
        return false;		
    });
        
	 
	$('#container').on('click','.action-icon-delete', function () {
		$(this).parent().remove();
	});
	
	
	
	
	
	/*$(document.documentElement).keydown(function (e) { 
		switch (e.keyCode) {
		case 37:
			//dir = -1;
			e.preventDefault();
			console.log('L');
			break;                
		case 39:
			//dir = 1;
			e.preventDefault();
			console.log('R');
			break;
		}	 
	});*/
	
	/* Incrementers */
	//$("form div").append('<div class="inc button">+</div> <div class="dec button">-</div>');
	$(".increaser").on("click", function() {
	
	  var $button = $(this);
	  var oldValue = $button.parent().find("input").val();
	
	  if ($button.text() == "+") {
		  var newVal = parseFloat(oldValue) + 1;
		} else {
	   // Don't allow decrementing below zero
		if (oldValue > 0) {
		  var newVal = parseFloat(oldValue) - 1;
		} else {
		  newVal = 0;
		}
	  }
	
	  $button.parent().find("input").val(newVal);
	
	});












		
		
});

function initHome() {
	$('.topmenu').css('display','none').delay(700).slideDown("slow");
		
		$('#options').click(function() {
			$('.options').toggle();
		});
	

}

function initDomainDetails () {
	$('.editable').editable({
		url: 'editinline',
	    success: function(response, newValue) {
	    console.log(response);			       
	 	}
	});
			
	$('.select-registrant').editable({
		showbuttons: false, 
		source: [
		              
		            /*  {value: "Alejandro", text: 'Alejandro (Godaddy)'},
					  {value: "Conatel", text: 'Conatel (nic.ve)'},
					  {value: "Caracas Hosting", text: 'Caracas Hosting'},
					  {value: "Marcaria", text: 'Marcaria'},
					  {value: "Godaddy", text: 'Godaddy'},
					  {value: "Cliente", text: 'Lo maneja el cliente'}*/
		              
		]
		,url: 'editinline',
		success: function(response, newValue) {
			console.log(response);
		     // if(response.status == 'error') return response.msg; //msg will be shown in editable form
		}
		        
		        
    });	    
		    
	
		    $('.select-hosting').editable({
		        showbuttons: false, 
		      /*  source: [
		              
		              {value: "NULL", text: "Sólo dominio, no posee hosting"},
					  {value: "redireccionado", text: "Redirecciona a otro dominio"},
				      {value: "Alejandro", text: "Alejandro (Mediatemple)"},
					  {value: "Caracas Hosting", text: "Caracas Hosting"},
					  {value: "Cliente", text: "Lo posee el cliente"}
		              
		           ]
		       ,*/url: 'editinline',
		        success: function(response, newValue) {
		        	console.log(response);			       
			    }
		    });
		    
		     $('.select-mail_server').editable({
		        showbuttons: false, 
		        url: 'editinline',
		        success: function(response, newValue) {
		        	console.log(response);			       
			    }
		    });
}

function validateStep(step){
	
	switch(step) {
		
		case 'presupuestos-delegate-step2':
			console.log('Yay 2!');
			break;
		case 'presupuestos-delegate-step3':
			console.log('Yay 3!');
			break;
		case 'presupuestos-delegate-step4':
			console.log('Yay 4!');
			break;
	}	
}


function presupuestosDelegate() {
	
	var $validator =
		$('#formulario').validate({
			rules: {
			    tipo_trabajo: "required",
			},			
			submitHandler: function(form) {
				$.ajax({
				  type: "POST",
				  url: "petition",
				  data: $(form).serialize(),
				  timeout: 12000,
				  success: function(response) {
					  console.log('works'+response);
					   $('#formulario').animate({opacity: 0, left: "-=300", }, 800);					  
					   $('#confirm').bPopup({ modal: false });
				  },
				  error: function(response) {
					  console.log(response);
					  $('#formulario').animate({opacity: 0, left: "-=300", }, 800);
					  $('#failed').bPopup({ modal: false });
				  }
				});
				return false;
			}
		});
		
	
	//jQuery time
	var current_fs, next_fs, previous_fs; //fieldsets
	var left, opacity, scale; //fieldset properties which we will animate
	var animating; //flag to prevent quick multi-click glitches
	var i = 0;

$(".next").click(function() {
	
	//if(animating) return false;
	//animating = true;
	
	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	
	/* Besign: Validate before going further */
	//find the form to validate
	var formulario = $(this).closest('form');
		
	var $valid = formulario.valid(); 
		if(!$valid) { 
			$validator.focusInvalid();
			return false;
		} //else  continuar!
		//show the next fieldset
		next_fs.show(); 
	/*end Besign */	

	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");	
	
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale current_fs down to 80%
			scale = 1 - (1 - now) * 0.2;
			//2. bring next_fs from the right(50%)
			left = (now * 50)+"%";
			//3. increase opacity of next_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'transform': 'scale('+scale+')'});
			next_fs.css({'left': left, 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
	
});


$(".previous").click(function(){
	if(animating) return false;
	animating = true;
	
	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();
	
	//de-activate current step on progressbar
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	//show the previous fieldset
	previous_fs.show(); 
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now, mx) {
			//as the opacity of current_fs reduces to 0 - stored in "now"
			//1. scale previous_fs from 80% to 100%
			scale = 0.8 + (1 - now) * 0.2;
			//2. take current_fs to the right(50%) - from 0%
			left = ((1-now) * 50)+"%";
			//3. increase opacity of previous_fs to 1 as it moves in
			opacity = 1 - now;
			current_fs.css({'left': left});
			previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
		}, 
		duration: 800, 
		complete: function(){
			current_fs.hide();
			animating = false;
		}, 
		//this comes from the custom easing plugin
		easing: 'easeInOutBack'
	});
});





}
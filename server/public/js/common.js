var modo = 'server'//local or server

var f = 'bootstrap3';

//To Avoid multiple AJAX requests
var isProcessing = false;

if (modo === 'local') {
	//var URL = "http://192.168.1.107/Edil/Web/";
	var URL = "http://localhost/niuQuinbi/";
	var urlCheck = '/niuQuinbi/';
	
		
	var position = 2;

} else {
	var URL = "http://quinbi.besign.com.ve/";
	var urlCheck = '/';
	
	var position = 1;

}

var VALOR_IVA 		= 1.12;
var VALOR_RETENCION = 0.02;

function roundNumber(num){
   return (num.toString().indexOf(".") !== -1) ? num.toFixed(2) : num;
}

jQuery.validator.addMethod("bsformat", function(value, element) {
     return this.optional(element) || /^([0-9]+(\.[0-9][0-9]?)?)$/i.test(value);
    //^(V|E|P|J|G)\d{9}$
    ///^\d*[0-9](|.\d*[0-9]|,\d*[0-9])?$/;
    
}, "Ej 100.00");

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
     return this.optional(element) || /^(j|V|E|P|J|G)(-)([0-9]{8})(-)([0-9]{1})$/i.test(value);
    
}, "Introduzca RIF como J-12345678-9");


//Change Validation default Messages

jQuery.extend(jQuery.validator.messages, {
    required: "requerido",
    email: "Hay un error con el correo.. revisalo!",
    url: "Esto no parece un URL...",
    date: "Please enter a valid date.",
    number: "Sólo números.",
    digits: "Please enter only digits.",
    creditcard: "Please enter a valid credit card number.",
    equalTo: "los campos no coinciden",
    accept: "Please enter a value with a valid extension.",
    maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
    minlength: jQuery.validator.format("Coloca al menos {0} caracteres."),
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

define(['globals','assets/handlebars.min',], function(globals, Handlebars) {
	
	function getPage(position){
		
		var pathArray = window.location.pathname.split( '/' );
		var accessToArray = pathArray[position];
		console.log("Access:" + accessToArray+" ("+position+")");
		return accessToArray;
		
	}
	function uniqId() {
	  return Math.round(new Date().getTime() + (Math.random() * 100));
	}

	function handlebarsHelpers() {	

		Handlebars.registerHelper('formatTime', function(value) {
		    var time = value.split(':');
		    return time[0]+":"+time[1]+ " ";
		});
		Handlebars.registerHelper('scheduleFormat', function(value, value2) {
		    var timeINI = value.split(' ');
		    var timeEND = value2.split(' ');
		    if (timeINI[1] == timeEND[1]) {
		    	return timeINI[0]+"-"+value2;
		    } else {
				return value+"-"+value2;
		    }
		});		

		Handlebars.registerHelper('getOnlyDate', function(value) {
		    var fulldate = value.split('-');
		    return fulldate[2]+"/"+fulldate[1]+ "/"+fulldate[0];
		});
		Handlebars.registerHelper('getDay', function(value) {
		    var fulldate = value.split('-');
		    return fulldate[2];
		});
		Handlebars.registerHelper('getMMYY', function(value) {
		    var fulldate = value.split('-');
		    return fulldate[1]+"/"+fulldate[0][2]+fulldate[0][3];
		});
		Handlebars.registerHelper('getMMYYYY', function(value) {
		    var fulldate = value.split('-');
		    return fulldate[1]+"/"+fulldate[0];
		});

		Handlebars.registerHelper('ifEquals', function(a, b, options) {
		  if (a === b) {
		  	return options.fn(this);
		  }
		  return options.inverse(this);		  
		});
	}


	//TODO Revise the use of these functions in this site --
	//these were imported from other projects
	function roundNumber(num) {
		return (num.toString().indexOf(".") !== -1) ? num.toFixed(2) : num;
	}
	
	function showModal(modalid){		
		//$(modalid).last().modal('show');		
		switch(modalid[0]) {
			
			case "#":
				$('div.view:visible').find(modalid).modal('show');
				break;
			case ".":
				$('div.view:visible').find(modalid).modal('show');	
				break;
			default:
				$('div.view:visible').find('#'+modalid).modal('show');	
			break;
		}
	}
	function closeModal(modalid) {
		
		switch(modalid[0]) {
			
			case "#":
				$(modalid).last().modal('hide');
				break;
			case ".":
				$(modalid).last().modal('hide');
				break;
			default:
				$('#'+modalid).last().modal('hide');
				break;
		}
		
	}
	function pad (str, max) {
	  str = str.toString();
	  return str.length < max ? pad("0" + str, max) : str;
	}

	function getOnlyDate(data) {
		var dateArr = data.split("-");
		removeTime = dateArr[2].split(" ");
		dateStr = removeTime[0] + "/" + dateArr[1] + "/" + dateArr[0];
		return dateStr;
	}

	function moneyFormat(data, decimal = 2, simb = 'Bs. ') {
		var data  = parseFloat(data);
		var Money = data
	       .toFixed(2) // always two decimal digits
	       .replace(".", ",") // replace decimal point character with ,
	       .replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
	      return simb+Money;	
	}
	//Definition for mask

	function initForm() {
		$.mask.definitions['h'] = "[A-za-z0-9_]";
		$('.datetimepicker').datetimepicker({pickTime: false, });
		
		$("[name='phonenumber']").mask("(0999) 999.99.99");
		$("[name='cellphone']").mask("(0999) 999.99.99");
		$("[name='phone']").mask("(0999) 999.99.99");

		$("[name='parent-cellphone']").mask("(0999) 999.99.99");
		$("[name='parent-phonenumber']").mask("(0999) 999.99.99");	
		
		$("[name='parent-cellphone-mother']").mask("(0999) 999.99.99");
		$("[name='parent-phonenumber-mother']").mask("(0999) 999.99.99");
		$("[name='parent-cellphone-father']").mask("(0999) 999.99.99");
		$("[name='parent-phonenumber-father']").mask("(0999) 999.99.99");
		
		
		$("[name='twitter']").mask("@?hhhhhhhhhhhhhhh",{ placeholder:" "});
		$("[name='instagram']").mask("@?hhhhhhhhhhhhhhhhhhhhhhhhhhhhhh",{ placeholder:" "});
		
	}
	return {
      getPage: 		getPage,
      uniqId: 		uniqId,
      roundNumber: 	roundNumber,
      showModal: 	showModal,
      closeModal: 	closeModal,
      pad: 			pad,
      getOnlyDate: 	getOnlyDate,
      initForm: 	initForm,
      moneyFormat: 	moneyFormat,
      handlebarsHelpers: handlebarsHelpers

	}

});




jQuery.validator.addMethod("bsformat", function(value, element) {
	return this.optional(element) || /^([0-9]+(\.[0-9][0-9]?)?)$/i.test(value);
}, "Ej 100.00");

//Add Method for URL no http
jQuery.validator.addMethod("web", function(value, element) {
	return this.optional(element) || /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/.test(value);

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
	required : "requerido",
	email : "Hay un error con el correo.. revisalo!",
	url : "Esto no parece un URL...",
	date : "Please enter a valid date.",
	number : "Sólo números",
	digits : "Sólo números.",
	creditcard : "Please enter a valid credit card number.",
	equalTo : "los campos no coinciden",
	accept : "Please enter a value with a valid extension.",
	maxlength : jQuery.validator.format("Please enter no more than {0} characters."),
	minlength : jQuery.validator.format("Coloca al menos {0} caracteres."),
	rangelength : jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
	range : jQuery.validator.format("Please enter a value between {0} and {1}."),
	max : jQuery.validator.format("Please enter a value less than or equal to {0}."),
	min : jQuery.validator.format("Please enter a value greater than or equal to {0}.")
});

jQuery.validator.addMethod("check_age", function(value, element) {
	//this.optional(element) || /^(V|E|P|J|G)([0-9]{9})$/i.test(value);
	var fulldate = value; //this.optional(element).val();
	var fulldate = fulldate.split("/");
	var day = fulldate[0];
    var month = fulldate[1];
    var year = fulldate[2];
    var age =  18;

    var mydate = new Date();
    mydate.setFullYear(year, month-1, day);

    var currdate = new Date();
    currdate.setFullYear(currdate.getFullYear() - age);

    return currdate > mydate;
    
}, "Debes tener al menos 18 años para registrarte");

// Caracteres extraÃ±os, acentos y eÃ±es

var normalize = (function() {
	var from = "ÃƒÃ€ÃÃ„Ã‚ÃˆÃ‰Ã‹ÃŠÃŒÃÃÃŽÃ’Ã“Ã–Ã”Ã™ÃšÃœÃ›Ã£Ã Ã¡Ã¤Ã¢Ã¨Ã©Ã«ÃªÃ¬Ã­Ã¯Ã®Ã²Ã³Ã¶Ã´Ã¹ÃºÃ¼Ã»Ã‘Ã±Ã‡Ã§", to = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc", mapping = {};

	for (var i = 0, j = from.length; i < j; i++)
		mapping[ from.charAt(i)] = to.charAt(i);

	return function(str) {
		var ret = [];
		for (var i = 0, j = str.length; i < j; i++) {
			var c = str.charAt(i);
			if (mapping.hasOwnProperty(str.charAt(i)))
				ret.push(mapping[c]);
			else
				ret.push(c);
		}
		return ret.join('');
	}
})();



// Datatable vars
language_emptytable = "No hay resultados";
language_processing = "Cargando...";
language_info = "_START_ - _END_ de _TOTAL_";
language_show = "_MENU_ items";
language_search = "Buscar: ";
language_search_placeholder = 'Escriba para filtrar...';
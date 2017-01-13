define(['globals', 'functions', 'assets/handlebars.min'], function(globals, Functions, Handlebars) {
	
	function run() {

		//Agenda
		loadAgendas('cliente');
		loadAgendas('proveedor');	
	}
	
	function getAgendaTemplates(elementIs){
		switch (elementIs) {
			case "cliente": 
				var template_id = '#client-Search-Template';
				var partial_id 	= '#client-Card-Template'; break;
			case "proveedor": 
				var template_id = '#proveedor-Search-Template';
				var partial_id 	= '#proveedor-Card-Template'; break;
		}
		return [template_id, partial_id];
	}

	function loadAgendas(elementIs) {
		
		var elementTemplate = getAgendaTemplates(elementIs);
		$.when(
			$.getJSON(globals.URL+"api/get/json/"+elementIs, function(data) {
				var TemplateScript = $(elementTemplate[0]).html(); 
		        var Template = Handlebars.compile(TemplateScript);
		        Handlebars.registerPartial("cardPartial", $(elementTemplate[1]).html());
				$("#agenda-"+elementIs+" .modal-body").prepend(Template(data)); 
		}, function () {
			    
		})).done( function(){
			$("select.agenda").select2({ maximumSelectionSize: 1, width: '100%' });
			$("#agenda-"+elementIs+" select.agenda").change(function(){
				var id = $(this).select2('val').toString();	
				loadDataCard(elementIs, id);    
			});
		});		
	}

	function loadDataCard(elementIs, id){
		
		var elementTemplate = getAgendaTemplates(elementIs);

		$.when(
			//$('#indicator').show();
			$.getJSON(globals.URL+"api/get/json/"+elementIs+"/id/"+id, function(data) {
				var NewCard = $(elementTemplate[1]).html();
				var Template = Handlebars.compile(NewCard);
				$("#agenda-"+elementIs+" .modal-body .card").html(Template(data)); 
		}, function () {
			    
		})).done( function(){			
			//$('#indicator').hide();
			//$('#agenda-'+elementIs+' #ficha').hide().html(data).fadeIn('slow');
		});
	}	

	function loadDataSelect(elementIs){

		var elementTemplate = "#"+elementIs+"-Select-Template";

		$.when(
			$.getJSON(globals.URL+"api/get/json/"+elementIs, function(data) {
				var TemplateScript = $(elementTemplate).html(); 
			    var Template = Handlebars.compile(TemplateScript);
		    $("select[name='"+elementIs+"']").html(Template(data)); 
		    //$("select#razon_social-select").html(Template(data)); 
		   // console.log(data);
		}, function () {
		    
		})).done( function(){

			//$("#egreso-view").modal('show');
		});
	}

	return {
      run: run,
      loadDataSelect: loadDataSelect,
	}

});
define(['globals', 'functions', 'assets/handlebars.min', 'assets/jquery.dataTables.min'], function(globals, Functions, Handlebars, DataTable) {
	
	function run() {
		loadTableData('comprobantes');
	}

	function loadTableData(elementIs) {

		$('.comprobantes').DataTable({
			//"order": [[0, "desc" ]],
			columns: [
	            { data: "id" },
	            { data: "proveedor_id" },
	            { data: "tipo_egreso" },
	            { data: "numero" },
	            { data: "cheque" },
        	],
		//$('.comprobantes').dataTable({
			//"aaSorting": [[ 0, "desc" ]],
			//"aoColumnDefs": [	{ "bSortable": false, "aTargets": [ 5 ] }, 
			//	            	{ "sClass": "text-right", "aTargets": [ 3 ] },
			//	               	{ "sClass": "text-left", "aTargets": [ 2 ] }
		    // 	   			],
			//"bProcessing": true,
			//"bServerSide": true,
			//"sAjaxSource": globals.URL+"api/get/json/egresos_comprobantes",	
			//"ajax": globals.URL+"public/data/arrays.txt"
			ajax: globals.URL+"api/get/json/egresos_comprobantes/",					
		});
	}

	return {
      run: run,
	}

});
/*
				 
				$('.nominas').dataTable( {
					"aaSorting": [[ 0, "desc" ]],
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": URL+"egresos/get/nominas",									
				});
				
				//Autocalculo de Monto en Retención
				$("#add-retencion-ficha [name='total_factura']").keyup(function() {
					factura_total = $(this).val();
					//Obtener Monto sin IVA
					resultado 	= factura_total / VALOR_IVA;
					//Calcular Retención
					a_retener	= resultado * VALOR_RETENCION;					
					resultado 	= roundNumber(factura_total - a_retener);	
									
					$("[name='monto']").val(resultado);
					
				});
				
				var add_egreso_prov = '#addegreso-proveedor';
				$(add_egreso_prov).validate({				
					rules: {
					   rif:{
		                	"rif": true,
			                remote: {
		                    	url: urlCheck+'entidades/check/proveedor',
		                    	type: 'post',
		                    }
		               },
		               base_imponible: "bsformat",
					   alicuota: "number",					   
					},
					messages: {
		                rif: {
		                    remote:jQuery.format("\"{0}\" ya está registrado, revise la lista")
		                },		                
		            },				
					submitHandler: function(form) {
						$.ajax({
						  type: "POST",
						  url: URL+"egresos/add/egreso/proveedor",
						  data: $(form).serialize(),
						  timeout: 5000,
						  success: function(response) {
						  	console.log(response);
							 	$(add_egreso_prov).closest('form').find("input, textarea").val("");
								$(add_egreso_prov).closest('form').find("select").select2('data', null);								
								
							 	$('#add-egreso-proveedor').modal('hide');
							 	//Create then show 								 	
							 	view('comprobantes',response);							   	
						  },
						  error: function(response) {
							  console.log(response);
							  $(add_egreso_prov).animate({opacity: 0, left: "-=300", }, 800);
							  $('#failed').bPopup({ modal: false });
						  }
						});
						return false;
					}
				});
				
				//Nomina Date range
				
							
				var add_egreso_nom = '#addegreso-nomina';
				$(add_egreso_nom).validate({				
					rules: {
						"empleados[]": {
					    	required: true,        
						},
					    fecha_desde:{
		                	remote: {
		                    	url: urlCheck+'egresos/check/nomina',
		                    	type: 'post',
		                    }
		               },
			        },
			        messages: {
			            fecha_desde: {
		                    remote:jQuery.format("Esta quincena ya fue creada")
		                },		                
		            },	
								
					submitHandler: function(form) {
						$.ajax({
						  type: "POST",
						  url: URL+"egresos/add/egreso/nomina",
						  data: $(form).serialize(),
						  timeout: 5000,
						  success: function(response) {
						  	console.log(response);
							 	$(add_egreso_nom).find("input:text").val("");
							 	$('input:checkbox').attr('checked',false);
							
							 	$('#add-egreso-nomina').modal('hide');
							 	//Create then show 								 	
							 	view('nominas',response);							   	
						  },
						  error: function(response) {
							  console.log(response);
							  $(add_egreso_prov).animate({opacity: 0, left: "-=300", }, 800);
							  $('#failed').bPopup({ modal: false });
						  }
						});
						return false;
					}
				});*/

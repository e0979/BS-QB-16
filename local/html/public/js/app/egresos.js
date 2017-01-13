define(['globals', 'functions', 'assets/handlebars.min', 'assets/jquery.dataTables.min', 'app/tables', 'app/dashboard', 'app/forms'], function(globals, Functions, Handlebars, DataTable, Tables, Dashboard, Forms) {
	
	function run() {

		loadTableData('comprobantes');

		Forms.enhance('egresos'); //TODO enhance aca? o hacer que automaticamente se haga con los modal?
		$('#add-egreso').on('shown.bs.modal', function (e) {
		  Dashboard.loadDataSelect('proveedor');
		  Dashboard.loadDataSelect('banco');
		  add();	  
		});
		
		//temp
		$('#add-egreso').modal('show');

	}
	
	function activeButtons(){
		//View
		$(".comprobantes").on('click', 'button.view', function () {
			var data = $(this).data('element');
			var elementIs = data.split('-')[0];
			var id = data.split('-')[1];
			view(elementIs, id);
		});
		//Edit
		$(".comprobantes").on('click', 'button.edit', function () {
			var data = $(this).data('element');
			var elementIs = data.split('-')[0];
			var id = data.split('-')[1];
			edit(elementIs, id);
		});

	}

	function loadTableData(elementIs) {

		var table = 
		$('.comprobantes').DataTable({
			"order": [[0, "desc" ]],
			"bSortClasses": "bootstrap",
			columns: [
	            { data: "id" },
	            { data: "fecha" },
	            { data: "beneficiario" },
	            { data: "monto" },
	            { data: "elaborador" },
	            { data: "id" },
	        ],
	        columnDefs: [
	        	
	        	{ "targets" : 3, 
	        	  "render" : 
	        	  	function (data){
			        	return Functions.moneyFormat(data);
					}
				},
	        	{ "targets" : 5, 
	        	  "render" : 
	        	  	function (data){
			        	return Tables.buttonRender(["edit", "view"], 'egresos_comprobantes', data);
					}
				},
				{ "targets" : 4, 
	        	  "render" : 
	        	  	function (data){
			        	return '<span class="label label-warning">'+data+'</span>';
					}
				},
	        	{ "orderable"	: false, 		"targets": [ 5 ] },
	        	{ "searchable"	: false, 		"targets": [ 5 ] },
	        	{ "class"		: "text-left",	"targets": [ 2 ] },
	        	{ "class"		: "text-right",	"targets": [ 3 ] },
	        ],
	        processing : true,
	        createdRow: function ( row, data, index ) {

	        },
			//serverSide : true,
			ajax: globals.URL+"api/get/json/egresos_comprobantes/%20/%20/true",
			/*createdCell : 	function (cell, cellData, rowData, rowIndex, colIndex) {
					        	activeButtons(); //$(".showtooltip", cell).tooltip();
					      	}*/	
		});
		activeButtons();
	}

	function edit(what, id){
		view(what, id);
		
		$('.modalbox').on('shown.bs.modal', function () {
			$('.editable').editable({
				url: URL+"api/edit/",
			    success: function(response, newValue) {
			    console.log(response);			       
			 	}
			});
		});
	}

	function view(what,id){
		
		$.when($.getJSON(globals.URL+"api/get/json/"+what+"/id/"+id, function (data) {
		    var TemplateScript = $("#Egreso-Comprobante-Template").html(); 
		    var Template = Handlebars.compile(TemplateScript);
		    //Handlebars.registerPartial("commentsPartial", $("#Comments-Template").html());
			$("#egreso-view .modal-body").html(Template(data)); 
		}, function () {
		    
		})).done( function(){
			$("#egreso-view").modal('show');
		});
		/*switch (what) {
			case 'iva':				var controller = 'impuestos'; 		var element = 'planilla';		break;			
			case 'compras':			var controller = 'impuestos';		var element = 'compra';			break;
			case 'retenciones':		var controller = 'impuestos';		var element = 'retencion';		break;
			case 'comprobantes':	var controller = 'egresos';			var element = 'comprobante';	break;
			case 'nominas':			var controller = 'egresos';			var element = 'nomina';			break;
			case 'nominarecibo':	var controller = 'egresos';			var element = 'nominarecibo';	break;
			case 'facturas':		var controller = 'cobros';			var element = 'factura';		break;
			
		}
		
		$.post(URL+controller+"/"+what+"/load/"+element+"/"+id, function(data){
			console.log (what+id+controller);	
			$('#ver-'+element+' .modal-body').hide().html(data).fadeIn('slow');
			showModal('ver-'+element);
			$('.soloenedit').addClass('hide');
		});
		return false;	
		*/
	}

	
	function add(){

		$('#add-egreso-form').validate({			
			rules: {
			   rif:{
                	"rif": true,
	                remote: {
                    	url: globals.URL+'api/check/proveedor/rif/',
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
				  url: globals.URL+"egresos/add/egreso/proveedor",
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

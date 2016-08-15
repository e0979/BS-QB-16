$(document).ready(function(e) {
	
	$.fn.editable.defaults.mode = 'inline';
	
	var flag =	getPage(position);
	var target = document.location.hash.replace("#", ""); // For links in Modals
	
	$('.money').keypress(function(evt){ 
        if(evt.which==44){
            $(this).val($(this).val()+'.');
            evt.preventDefault();
        }
    });  
   
    $('#print').click(function() {
		//$('#limited-view').removeClass('limited-view');
		$('#printable-area').printArea();
    	return false;
	});	
	$('#print-inner').click(function() {
		//$('#limited-view').removeClass('limited-view');
		$('.area-inner').printArea(/*{ mode: 'popup', popTitle: 'Test'}*/);
    	return false;
	});	
	
	/*$('#id_cliente').on('save', function(e, params) {
   		console.log('Saved value: ' + params.newValue);
	});*/
	
	switch (target) {
		    	
		case 'add-retencion':
		 		showModal("add-retencion");
		  		break;
		    		
		case 'add-compra':
		  		showModal("add-compra");
		    		
		  		break;
		case 'iva-current':
		  		currentPlanilla("iva");
		   		break;
		case 'add-dominio':
		 		showModal("add-dominio")
		  		break;
		case 'add-egreso-proveedor':
		    	showModal("egreso-proveedor")
		   		break;
		case 'add-egreso-nomina':
		    	showModal("add-egreso-nomina")
		   		break;	
		case 'add-factura':
		  		showModal("add-factura");
		   		break;  	
		   		
	}
	
	switch(flag) {
		
		
		
		case 'impuestos':
		
			
		   
		    $('#ver-planilla, #add-planilla').on('hidden.bs.modal', function (e) {
				var element = $(this).data('element');
				updatelist(element);
			});	
			
			
			
		
		    
		    formEnhancement();
			
			/* Form */	
			
			initList('2,3,4');
			
			compras_check();
			
			//ADD Compra
			
			$('#addcompra').validate({				
				rules: {
				   rif:{
	                	"rif": true,
		                remote: {
	                    	url: urlCheck+'entidades/check/proveedor',
	                    	type: 'post',
	                    }
	               },
	               factura:{
	               		required: true,
	                	remote: {
	                    	url: urlCheck+'impuestos/check/compras',
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
	                factura: {
	                    remote:jQuery.format("Parece que esta factura ya fue registrada")
	                }
	            },				
				submitHandler: function(form) {
					$.ajax({
					  type: "POST",
					  url: "add/compras",
					  data: $(form).serialize(),
					  timeout: 5000,
					  success: function(response) {
					  	console.log('works'+response);
						 	$('#addcompra').closest('form').find("input, textarea").val("");
							$('#addcompra').closest('form').find("select").select2('data', null);
							
							
						 	$('#addcompra').modal('hide');
						   						   
						   $('#confirm').bPopup({ modal: false });										   	
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
			
		case 'dominios':
			
			
			initDomain();
			initEdit();
			$('#redireccion').hide();	
						
			$(".chosen-select").select2( { placeholder: 'Seleccione...', width: '100%' });			
			$('.datepicker').datepicker({});
			
			$('#list-results').dataTable( {
				"aaSorting": [[ 0, "asc" ]],
				"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
				"sPaginationType": "bootstrap",
			    "iDisplayLength": 5,
				"oLanguage": {
					"sLengthMenu": "_MENU_ items por pag",
					"sEmptyTable": "No hay datos",
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
			    			$('#boton-'+id).show(); 
			    		}, 500);   				    		
			    	}	
			 });
			 			 
			
			//RENEWALS
			
			//UPDATE Switches
			$(document).on("change", ".domains-form, .alert-domains, .toforgot-domains	", function(){
			    console.log ($(this));
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
			
			//ADD Domain
			
			$('#add-domain').validate({	
				rules: {
	                domain:{
	                	web: true,
		                required: true,
	                	remote: {
	                    	url: urlCheck+'dominios/check',
	                    	type: 'post',
	                    }
	                },
	                domain_creationdate: "required",
				    hosting: "required",
				    registrant: "required",
				    cliente: "required",
	            },
	            messages: {
	                domain: {
	                    remote:jQuery.format("\"{0}\" ya está registrado")
	                }
	            },					
				submitHandler: function(form) {
					$.ajax({
					  type: "POST",
					  url: "add/domain",
					  data: $(form).serialize(),
					  timeout: 5000,
					  success: function(response) {
						  console.log('works'+response);
						   $('#add-domain').closest('form').find("input, textarea").val("");	
						   $('#add-domain').closest('form').find("select").select2('data', null);	
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
		
		case 'presupuestos':
			presupuestosDelegate();
	
			$(".chosen-select").select2( { placeholder: 'Seleccione...', width: '100%' });	
			
			$('#razon_social-select').change(function(){
				console.log('touched');
				$("[name='razon_social']").attr('disabled', 'disabled');
				$("[name='rif']").attr('disabled', 'disabled');
				$("[name='razon_comercial']").attr('disabled', 'disabled');				
				$("[name='direccion']").attr('disabled', 'disabled');
				$("[name='telefono']").attr('disabled', 'disabled');			
			});
			
			/*TODO si qty-secciones_complejas >=1 secciones_complejas required*/
			
			
			//Cargar el chunck html que corresponde segun el tipo de proyecto
			$("#tipo_trabajo").change(function(){
				var valor = $("#tipo_trabajo option:selected").attr('value');
					
					$.post("load/"+ normalize(valor), function(data){
					$("#trabajo_preguntas").html(data);
				});
			});
			
			$('.presupuestos').dataTable( {
					"aaSorting": [[ 0, "desc" ]],
					/*"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 1,2,3 ] }, 
				               		 { "sClass": "text-right", "aTargets": [ 4 ] }
		     	   	],*/
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": URL+"presupuestos/getall",	
					"aoColumnDefs": [ 
				    {   //Buttons     	
				      "aTargets": [ 6 ],
				      "mData":  function (data) {
				        return '<button class="btn btn-xs btn-blue" onclick=edit("presupuesto_detalle",'+data[6]+');><i class=\'glyphicon glyphicon-pencil\'></i> editar</button> <button class="btn btn-xs btn-blue" onclick=edit("presupuesto_detalle",'+data[6]+');><i class=\'glyphicon glyphicon-pencil\'></i> Ver</button> ';
				      }
				    },	 
				    {   //Buttons     	
				      "aTargets": [ 2 ],
				      "mData":  function (data) {
				        return traduce_fecha(data[2]);
				      }
				    },    
	     ],									
				});		
				
				$('.status').dataTable( {
					"aaSorting": [[ 0, "desc" ]],
					/*"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 1,2,3 ] }, 
				               		 { "sClass": "text-right", "aTargets": [ 4 ] }
		     	   	],*/
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": URL+"presupuestos/get",									
				});			
			break;
		
		case 'egresos':
			
		    
		    $('#ver-planilla, #add-planilla').on('hidden.bs.modal', function (e) {
				var element = $(this).data('element');
				updatelist(element);
			});	
			
			formEnhancement(); 
			
			$("#forma_pago").select2( { 
				placeholder: 'Forma de Pago...',
				minimumResultsForSearch: -1,
				width: '55%',
			});
		    
		    $('.comprobantes').dataTable( {
					"aaSorting": [[ 0, "desc" ]],
					"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 5 ] }, 
				               		 { "sClass": "text-right", "aTargets": [ 3 ] },
				               		 { "sClass": "text-left", "aTargets": [ 2 ] }
		     	   	],
					"bProcessing": true,
					"bServerSide": true,
					"sAjaxSource": URL+"egresos/get/comprobantes",
					

				/*	var controller_name = 'zipi';
					"fnDrawCallback": function ( oSettings ) {
                   

                        for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                        {
                            var link = $('&nbsp;<a href="/'+controller_name+'/modifica/id/'+ oSettings.aoData[ oSettings.aiDisplay[i] ]._aData[0]+'">Modifica</a> <a href="/'+controller_name+'/cancella/id/'+ oSettings.aoData[ oSettings.aiDisplay[i] ]._aData[0]+'">Cancella</a>');
                            $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                            $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).append(link);
                        }
                	},*/
					
					
									
				});
				 
				$('.nominas').dataTable( {
					"aaSorting": [[ 0, "desc" ]],
					/*"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 1,2,3 ] }, 
				               		 { "sClass": "text-right", "aTargets": [ 4 ] }
		     	   	],*/
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
				
				/*$('#fecha_desde').datepicker().on('changeDate', function(ev){
					console.log(ev.date.valueOf()+)
				});				
				*/
							
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
				});

			break;
		case 'cobros':
		
			$(".chosen-select").select2( { placeholder: 'Seleccione...', width: '100%' });	
			//formEnhancement();	
			$("#tipo_nota").select2( { 
				placeholder: 'Forma de Pago...',
				minimumResultsForSearch: -1,
				width: '100%',
			});	
			$('.datepicker').datepicker({});
			
			$('.facturas').dataTable( {
				"aaSorting": [[ 0, "desc" ]],
				"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 7 ] }, 
				               		 { "sClass": "text-right", "aTargets": [ 3 ] },
				               		 { "sClass": "text-left", "aTargets": [ 1 ] },
				               		 { "sClass": "format_texts", "aTargets": [ 4,6 ] }
		     	 ],
		     	"fnCreatedRow": function( nRow, aData, iDataIndex ) {
                    //If ANULADO
                    if (aData[6] == "si") {
                        // color rows from 0-7
                        for (var i = 0; i < 8; i++) {
                            $('td:eq('+i+')', nRow).addClass( "anulado" );
                        }
						//Remove "Anulado" button
						$('td:eq(7)', nRow).closest('td').find('.btn-danger').remove();
                    }
                    
               	},
				"bProcessing": true,				
				"bServerSide": true,
				"sAjaxSource": URL+"cobros/get/facturas",									
			});
			
			//TODO actualizar ficha cliente
			$('#razon_social-select').change(function() {
				/*$.post(URL+"/"+what+"/load/"+element+"/"+id, function(data){
					$('#ficha-cliente').hide().html(data).fadeIn('slow');					
				});*/
				//var id = $(this).select2('val').toString();	loadFichaAgenda('cliente', id);
				console.log('actualizar');
				//loadFichaAgenda('cliente', id);
			});
			
			$('#tipo_nota').change(function() {
				var seleccion = $(this).select2('val').toString();	
				if (seleccion != 'factura') {
					$('#facturas_afectadas').removeAttr('disabled');
				} else {
					$('#facturas_afectadas').attr('disabled', 'disabled');		
				}		
				console.log(seleccion);
			});
			
			$('#addfactura').validate({				
				rules: {
					cliente: 'required',			   
				},
				submitHandler: function(form) {
					$.ajax({
					  type: "POST",
					  url: URL+"cobros/add/factura",
					  data: $(form).serialize(),
					  timeout: 5000,
					  success: function(response) {
					  	console.log(response);
						 	$('#add-factura').closest('form').find("input, textarea").val("");
							
						 	$('#add-factura').modal('hide');
						 	//Create then show 								 	
							view('facturas',response);							   	
					  },
					  error: function(response) {
						  console.log(response);
						  $('#failed').bPopup({ modal: false });
					  }
					});
					return false;
				}
			});
			
			break;			
		
		default:
		
			break;		 			
			
	} // end SWITCH
	
	
	
	
	
	
	
	
	// IN ALL PAGES
	
	$('.topmenu').css('display','none').delay(700).slideDown("slow");
	
	$('#profile').hover(function (){
		$('#profile-icon').toggleClass('animated rotateAlone');
	});
	
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
		
		var fieldToAdd = '<div><input type="email" name="telefono' + g +'" placeholder="Otro Email" /><i class="icon-minus-sign action-icon-delete"></i></div>';
		
		$(fieldToAdd).appendTo(emailsDiv);
        g++;
        return false;		
    });
    
    $('.action-icon-add').bind('click', function() {
		
		var fieldToAdd = '<div><input type="text" name="telefono' + f +'" placeholder="Otro teléfono" /><i class="icon-minus-sign action-icon-delete"></i></div>';
		
		$(fieldToAdd).appendTo(phonesDiv);
		$("[name='telefono"+f+"']").mask("(0999) 999.99.99");
        f++;
        return false;		
    });
        
	 
	$('#container').on('click','.action-icon-delete', function () {
		$(this).parent().remove();
	});
	
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
	
	
	/* PERSISTENTS */
	
	/* Agenda */
	
	
	/* ADD proveedor */
	$('#add-proveedor form').validate({				
		rules: {
			rif:{
	        	"rif": true,
		        	remote: {
	                	url: urlCheck+'entidades/check/proveedor',
	                    	type: 'post',
	                    }
	               },
	         },
		messages: {
	        rif: {
	              remote:jQuery.format("\"{0}\" ya está registrado, revise la lista")
	             },
	    },				
		submitHandler: function(form) {
			$.ajax({
				type: "POST",
				url: URL+'entidades/add/proveedor',
				data: $(form).serialize(),
					timeout: 5000,
					success: function(response) {
						console.log('works'+response);
							$('#add-proveedor').closest('form').find("input, textarea").val("");
							$('#add-proveedor').closest('form').find("select").select2('data', null);
							
						 	$('#add-proveedor').modal('hide');
						   						   
							//$('#confirm').bPopup({ modal: false });										   	
					  },
				error: function(response) {
						  console.log(response);
						  $('#failed').bPopup({ modal: false });
					  }
				});
				return false;
		}
	});
	
	$('#add-cliente form').validate({				
		rules: {
			rif:{
	        	"rif": true,
		        	remote: {
	                	url: urlCheck+'entidades/check/cliente',
	                    	type: 'post',
	                    }
	               },
	         },
		messages: {
	        rif: {
	              remote:jQuery.format("\"{0}\" ya está registrado, revise la lista")
	             },
	    },				
		submitHandler: function(form) {
			$.ajax({
				type: "POST",
				url: URL+'entidades/add/cliente',
				data: $(form).serialize(),
					timeout: 5000,
					success: function(response) {
						console.log('works'+response);
							$('#add-cliente').closest('form').find("input, textarea").val("");
							$('#add-cliente').closest('form').find("select").select2('data', null);
							
						 	$('#add-cliente').modal('hide');
						   						   
							//$('#confirm').bPopup({ modal: false });										   	
					  },
				error: function(response) {
						  console.log(response);
						  $('#failed').bPopup({ modal: false });
					  }
				});
				return false;
		}
	});
	
	
	
});

/* END Document Ready */

function formEnhancement() {
	
	$('.modalbox').on('shown.bs.modal', function (e) {
		$("select").select2('data', {});
		$('#razon_social-input').removeAttr('disabled');
		$("[name='rif']").removeAttr('disabled');
		$("[name='direccion']").removeAttr('disabled');
		$("[name='telefono']").removeAttr('disabled');					
	});
			
	/* Form enhancement */
	$(".chosen-select").select2( { placeholder: 'Seleccione...', width: '100%' });	
	$('.datepicker').datepicker({});	
	$("[name='telefono']").mask("(0999) 999.99.99");
	$("[name='rif']").mask("*-99999999-9");
	
	$('#razon_social-select').change(function(){
		$('#razon_social-input').removeAttr('required').attr('disabled', 'disabled');
		$('#razon_comercial').attr('disabled', 'disabled');
		$("[name='rif']").removeAttr('required').attr('disabled', 'disabled');
		$("[name='direccion']").attr('disabled', 'disabled');
		$("[name='telefono']").attr('disabled', 'disabled');			
	});
}
		    

function showModal(modalid){
	
	$('#'+modalid).modal('show');
	
}

function currentPlanilla(impuesto){
	
	$.post(URL+"impuestos/"+impuesto+"/load/current", function(data){
			
		$('#ver-planilla .modal-body').hide().html(data).fadeIn('slow');
		showModal('ver-planilla');
		initPlanillaedit();////$('#compras-list-body').hide().html(data).fadeIn('slow');
	});
		
	return false;	
}
function createfrom(what, from, id) {
	switch(what){
		case 'comprobante': 	var controller = 'egresos'; 		break;
	}
	$.post(URL+controller+"/create/"+what+"/from/"+from+"/"+id, function(data){
		console.log (what+id+from+controller);
			
	});
}



function edit(what,id){
	
	switch (what) {
		case 'iva':				var controller = 'impuestos';		var element = 'planilla';			break;			
		case 'compras':			var controller = 'impuestos';		var element = 'compra';				break;
		case 'retenciones': 	var controller = 'impuestos';		var element = 'retencion'; 			break;
		case 'comprobantes': 	var controller = 'egresos';			var element = 'comprobante'; 		break;
		case 'facturas':		var controller = 'cobros';			var element = 'factura';			break;
		case 'presupuestos':	var controller = '';	var element = 'presupuesto';		break;
		case 'presupuesto_detalle':			var controller = 'presupuestos';		var element = 'detalle';				break;
	}

	$.post(URL+controller+"/"+what+"/edit/"+element+"/"+id, function(data) {			
		$('#ver-'+element+' .modal-body').hide().html(data).fadeIn('slow');
		//console.log ('ver-'+element);	
		showModal('ver-'+element);
		switch (what) {
			case 'iva':				initPlanillaedit();	break;			
			case 'compras':			initEdit(); 		break;
			case 'retenciones':		initEdit(); 		break;
			case 'comprobantes':	initEdit(); 		break;
			case 'facturas':	initEdit(); 		break;
			case 'presupuestos':	initValidate(); 		break;
			case 'presupuesto_detalle':			initEdit(); 		break;
		}
		$('.soloenview').addClass('hide');
		
	});
		
	return false;	
}
function initEdit() {
	$('.editable').editable({
		url: 'editinline',
	    success: function(response, newValue) {
	    console.log(response);			       
	 	}
	});
	
}

function initValidate() {
	
	$('#addstatus').validate({	
				
	           
				submitHandler: function(form) {
					
					$.ajax({
					  type: "POST",
					  url:  URL+'presupuestos/update_status/',
					  data: $(form).serialize(),
					  timeout: 5000,
					  success: function(response) {
						  console.log('pasa'+response);
						  $('.close').click();
						  $('.status').dataTable().fnDraw();	
										   	
					  },
					  error: function(response) {
						  console.log(response);
						 
						  $('#failed').bPopup({ modal: false });
					  }
					});
					return false;
				}
			});
			
}


function compras_check() {
	
	$('.aprobacion').click( function() {		
		$(this).children('i').toggleClass('glyphicon-ok glyphicon-remove');
		//update list?
		change = $(this).children('i').attr('class').split(' ')[1];
		id = $(this).attr('id').split('-')[1];
		console.log(change +' '+id);
		
		$.post(URL+"impuestos/aprobe/"+id+"/"+change, function(data){
			
			//when update, update resume
			$.post(URL+"impuestos/load/current/resumen/", function(data) {			
				$('#resumen').hide().html(data).fadeIn('slow');
				validateResumen();
			});
			
			
		});
	});
	
	
}

function initPlanillaedit() {
	validateResumen();
	$('.editable').editable({
		url: 'editinline',
	    success: function(response, newValue) {
	    console.log(response);			       
	 	}
	});
	
	$('.datepicker').datepicker({});
	
	compras_check();
	
		
	/*$('.select-registrant').editable({
		showbuttons: false, 
		source: [		              
		
		]
		,url: 'editinline',
		success: function(response, newValue) {
			console.log(response);
		     // if(response.status == 'error') return response.msg; //msg will be shown in editable form
		}       
    });	  */
}	

function validateResumen() {
	
	$('.datepicker').datepicker({});
	
	$('#add-iva').validate({				
								
		submitHandler: function(form) {
			$.ajax({
				type: "POST",
				url: URL+'impuestos/add/iva',
				data: $(form).serialize(),
				timeout: 5000,
				success: function(response) {
					console.log('works'+response);
					//	$('#add-proveedor').closest('form').find("input, textarea").val("");
					//	$('#add-proveedor').closest('form').find("select").select2('data', null);
				 	$('#add-proveedor').modal('hide');
					//$('#confirm').bPopup({ modal: false });										   	
			 	},
				error: function(response) {
					 console.log(response);
					$('#failed').bPopup({ modal: false });
				}
			});
			return false;
		}
	});	
}
function updatelist(element){
	$.post(URL+"impuestos/"+element+"/reload", function(data){
			
		$('#list-body-'+element).hide().html(data).fadeIn('slow');
		
	});
	//initList();
	return false;
}

function initList(righty) {
	$('#list-results').dataTable( {
		"sDom": "<'row'<'span6'l><'span6'f>r>t<'row'<'span6'i><'span6'p>>",
		"aaSorting": [[ 0, "desc" ]],
		"aoColumnDefs": [{ "bSortable": false, "aTargets": [ 6 ] }, 
		                { "bSearchable": false, "aTargets": [ 6 ] },
		               { "sClass": "text-right", "aTargets": [ righty ] }
        ],				
	   "sPaginationType": "bootstrap",
	   "iDisplayLength": 10,
		"oLanguage": {
			"sLengthMenu": "_MENU_ por pag",
			"sEmptyTable": "No hay datos",
		}
	});
}	  	

function loadDomains(){
		
	$.post(URL+"dominios/reload", function(data){
			
		$('#dominios-list-body').hide().html(data).fadeIn('slow');
	});
		
	initDomainDetails();
	
	return false;	
}

function loadDomainDetails(id) {
		
	$.post(URL+"dominios/load/details/"+ id, function(data){
			
	$('#years-details-'+id).hide().html(data).fadeIn('slow');
			
		initDomainDetails();
			
		$('#details-'+id).collapse('show');	

	});
			
		
	return false;
}

function initDomain() {
	
	$('.details-loader').click(function() {
		var valor =	$(this).attr('href');
		var array  = 	valor.split( '-' );				
		loadDomainDetails(array[1]);
				
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
		/*  {value: "Alejandro", text: 'Alejandro (Godaddy)'},			{value: "Conatel", text: 'Conatel (nic.ve)'},		{value: "Caracas Hosting", text: 'Caracas Hosting'},
				{value: "Marcaria", text: 'Marcaria'},			 {value: "Godaddy", text: 'Godaddy'},			{value: "Cliente", text: 'Lo maneja el cliente'}*/
		]
		,url: 'editinline',
		success: function(response, newValue) {
			console.log(response);
		     // if(response.status == 'error') return response.msg; //msg will be shown in editable form
		}       
    });	    
		    
	
	 $('.select-hosting').editable({
		showbuttons: false, 
		url: 'editinline',
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
}

function eliminate_notifications(id){
	//console.log(URL+"home/notification_checked/"+id);
	$.post(URL+"home/notification_checked/"+id, function(data) {
		$.post(URL+"home/listNotificaciones/"+id, function(data) {
			$("#notifications-update").html(data);
		});		
		//$('.not'+id).hide();	
	   // console.log('#not'+id);		
		
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

function traduce_fecha(fecha){
	var res = fecha.split("-");
	return res[2]+"/"+res[1]+"/"+res[0];
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
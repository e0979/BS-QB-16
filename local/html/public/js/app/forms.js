define(['globals', 'functions', 'assets/handlebars.min'], function(globals, Functions, Handlebars) {

	function enhance(controller) {
		console.log(controller);
		
		/*$('.modalbox')
	    .on('show.bs.modal', function() {

	        alert('shown baby!');

	    }).modal('show');
	    */
		$('.maodalbox').on('shown.bs.modal', function () {
			//$("select").select2('data', {});
			//$("select").select2();
			console.log("@");
			$(".chosen-select").select2( { placeholder: 'Seleccione...', width: '100%' });
			$('#razon_social-input').removeAttr('disabled');
			$("[name='rif']").removeAttr('disabled');
			$("[name='direccion']").removeAttr('disabled');
			$("[name='telefono']").removeAttr('disabled');					
		});
				
		/* Form enhancement */
		//$(".chosen-select").select2( { placeholder: 'Seleccione...', width: '100%' });	
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
	
	return {
    	enhance : enhance
    }

});
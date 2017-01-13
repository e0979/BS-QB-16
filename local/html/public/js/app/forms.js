define(['globals', 'functions', 'assets/handlebars.min'], function(globals, Functions, Handlebars) {

	function enhance(controller) {

		//console.log("enhance "+controller);
				
		$('.modalbox').on('shown.bs.modal', function (e) {
			$(".modalbox.in .chosen-select").select2( { placeholder: 'Seleccione...', width: '100%' });
			$(".modalbox.in [name='banco']").select2( { placeholder: 'Banco', width: '48%' });
			$(".modalbox.in [name='forma_pago']").select2( { placeholder: 'Forma de pago', width: '48%' });
			

			$('#razon_social-input').removeAttr('disabled');
			$("[name='rif']").removeAttr('disabled');
			$("[name='direccion']").removeAttr('disabled');
			$("[name='telefono']").removeAttr('disabled');	

		});		
		/* Form enhancement */
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
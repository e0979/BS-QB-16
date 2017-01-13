<select data-placeholder="Seleccione Proveedor..." class="chosen-select form" data-what="proveedor" name="proveedor" id="razon_social-select">
	<option></option>	
</select>	  	

<script id="proveedor-Select-Template" type="text/x-handlebars-template">
	{{#if proveedor.length}}
		{{#proveedor}}
			<option value="{{id}}">{{razon_social}} ({{razon_comercial}})</option>
	  	{{/proveedor}}
	{{else}}
		No hay Proveedores registrados
	{{/if}}
</script>

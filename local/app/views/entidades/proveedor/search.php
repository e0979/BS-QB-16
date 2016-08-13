<script id="proveedor-Search-Template" type="text/x-handlebars-template">
	{{#if proveedor.length}}
		<select data-placeholder="¿A quién buscas?" class="chosen-select form agenda" data-what="proveedor" name="search_id" id="search-proveedor" multiple >
			<option></option>					
			{{#proveedor}}
				<option value="{{id}}">{{razon_social}} ({{razon_comercial}})</option>
		  	{{/proveedor}}				  	
		  	</div>
	  	</select>	  	
	{{else}}
		No hay Proveedores registrados
	{{/if}}
</script>	
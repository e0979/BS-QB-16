<script id="client-Search-Template" type="text/x-handlebars-template">
	{{#if cliente.length}}
		<select data-placeholder="¿A quién buscas?" class="chosen-select form agenda" data-what="cliente" name="search_id" id="search-clientes" multiple >
			<option></option>					
			{{#cliente}}
				<option value="{{id}}">{{razon_social}} ({{razon_comercial}})</option>
		  	{{/cliente}}				  	
		  	</div>
	  	</select>	  	
	{{else}}
		No hay Clientes registrados
	{{/if}}
</script>	
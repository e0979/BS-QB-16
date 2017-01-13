<select data-placeholder="Banco" class="chosen-select form" data-what="banco" name="banco" id="banco-select">
	<option></option>	
</select>	  	

<script id="banco-Select-Template" type="text/x-handlebars-template">
	{{#if banco.length}}
		{{#banco}}
			<option value="{{id}}">{{name}}</option>
	  	{{/banco}}
	{{else}}
		No hay Bancos registrados
	{{/if}}
</script>

<select data-placeholder="Seleccione Proveedor..." class="chosen-select form" data-what="proveedor" name="proveedor" id="razon_social-select">
</select>	  	

<script id="proveedor-Select-Template" type="text/x-handlebars-template">
	{{#if proveedor.length}}
		<option></option>
		{{#proveedor}}
			<option value="{{id}}">{{razon_social}} ({{razon_comercial}})</option>
	  	{{/proveedor}}
	{{else}}
		No hay Proveedores registrados
	{{/if}}
</script>
<!-- 
<div class="select2-container chosen-select form" id="s2id_razon_social-select" style="width: 100%;"><a href="javascript:void(0)" onclick="return false;" class="select2-choice" tabindex="-1">   <span class="select2-chosen">undefined</span><abbr class="select2-search-choice-close"></abbr>   <span class="select2-arrow"><b></b></span></a><input class="select2-focusser select2-offscreen" type="text" id="s2id_autogen3"><div class="select2-drop select2-display-none select2-with-searchbox">   <div class="select2-search">       <input type="text" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" class="select2-input">   </div>   <ul class="select2-results">   </ul></div></div> -->		
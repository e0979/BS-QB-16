<form id="searchform" role="form" class="form-inline"  method="post" action="">
	<input name="specialty" class="form-control input-lg" placeholder="Especialidad, Nombre del doctor o Clínica" required>&nbsp;&nbsp;
	<div id="specialty-input" style="position:absolute; width: 500px;"></div>
	<input name="city"		class="form-control input-lg" />&nbsp;&nbsp;

		<input name="city_value" type="hidden">
		<input name="type" type="hidden">
	
	<button class="btn btn-lg btn-green send" id="search_options"><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;BUSCAR</button>

	<div id="search_result"></div>
	
</form>
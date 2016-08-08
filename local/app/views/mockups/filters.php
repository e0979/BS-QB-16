<script id="template-search-filters" type="text/template">
	<div class="search-filters-area">
		<div class="container">
			<span class="filterby"> <i class="glyphicon glyphicon-filter"></i> &nbsp; FILTRAR POR &nbsp;</span>
			
			{{filters}}
			<button type="button" id="filter-term-{{#}}" class="btn btn-default btn-filter">{{term}} <i class="fa fa-close"></i></button>
			{{/filters}}
		</div>
	</div>
</script>
<script id="client-Card-Template" type="text/x-handlebars-template">
	{{#if cliente.length}}
		{{#cliente}}
		<div class="row">
			<div class="col-sm-12 col-md-4 col-lg-4">
				<img src="http://placehold.it/380x500" alt="" class="img-rounded img-responsive" />
			</div>
			<div class="col-sm-12 col-md-8 col-lg-8">
				<h3>{{razon_social}}
					<small><br>({{razon_comercial}})</small>
				</h3>
				{{#if direccion_fiscal}}
				<small><i class="fa fa-map-marker"> </i> <cite>{{direccion_fiscal}}</cite>
				</small>
				{{/if}}
				<p>
				{{#if telefono}}
					<i class="fa fa-phone"></i> {{telefono}}<br />
				{{/if}}
				{{#if telefono2}}	
					<i class="fa fa-phone-alt"></i> {{telefono2}}<br />
				{{/if}}	
				{{#if email}}	
					<i class="fa fa-envelope"></i> {{email}}<br />
				{{/if}}	
				{{#if website}}	
					<i class="fa fa-globe"></i> <a href="{{website}}">{{website}}</a><br />
				{{/if}}	
				{{#if fecha_relacion}}	
					<i class="fa fa-gift"></i>Cliente desde {{fecha_relacion}}<br />
				{{/if}}	
				</p>
			</div>			
		</div>
		{{/cliente}}	  	
		
	{{else}}
		No se ha encontrado este Cliente
	{{/if}}
</script>
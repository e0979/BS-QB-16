<script id="Egreso-Comprobante-Template" type="text/x-handlebars-template">
	{{#if egresos_comprobantes.length}}
		{{#egresos_comprobantes}}
		<table class="table table-condensed">
		  <tbody>
		    <tr>
		      <td class="text-right format_texts">Formulario F­ADM001 | Lenar a Mano o Máquina | Creación 01/05/07 | Ultima Modificación 10/02/14</td>
		    </tr> 
		    <tr>
		    	<td><div class="egreso_numero"><h4>Egreso con <a href="#" id="egreso-{{ id }}" class="editable" data-type="select" data-source="formapago_options" data-pk="egresos_comprobantes-forma_pago-{{ id }}">{{forma_pago}}</a> de Banco (Nº 
		    		<a href="#" id="egreso-{{id}}" class="editable" data-type="text" data-pk="egresos_comprobantes-numero-{{id}}">{{ numero }}</a>) 
		    		<small class="format_texts"> BESIGN, C.A. J­29397290­6        Banco Mercantil (0105­0730­89­1730011306)</small></h4></div>
		    	</td>
		    </tr>      
		  </tbody>
		</table>	
		<table class="table table-bordered table-condensed">
		  <thead>
		    <tr>
		      <th width="15%" class="text-center"><strong>Fecha Emisión</strong></th>
		  	  <th class="text-center"><strong>Beneficiario</strong></th> 
		      <th class="text-center"><strong>{{forma_pago}}</strong></th>
		      <th width="20%" class="text-right"><strong>Monto Bs.</strong></th>
		      <th  class="text-center"><strong>Concepto</strong></th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		    <tr>
		      <td>
		      	<a href="#" id="fecha-{{id}}" class="editable" data-type="text" data-pk="egresos_comprobantes-fecha-{{id}}">
		      	{{ fecha }}</a>
		      </td>
		      <td>
		      	<a href="#" id="beneficiario-{{id}}" class="editable" data-type="select" data-pk="egresos_comprobantes-beneficiario-{{id}}" data-source="providers_texttext">
					{{ beneficiario }}
		      	</a>
		      </td>
		      <td>
		      	<a href="#" id="cheque-{{id}}" class="editable" data-type="text" data-pk="egresos_comprobantes-cheque-{{id}}">
		      	{{ cheque }}
		      	</a></td>
		      <td class="text-right">Bs. 
		      	<a href="#" id="monto-{{id}}" class="editable" data-type="text" data-pk="egresos_comprobantes-monto-{{id}}">
		      	{{ monto }}
		      	<?php //echo dineroFormat($Comprobante['monto'],2, 'nobs'); ?></a></td>
		      <td>
		      	<a href="#" id="concepto-{{id}}" class="editable" data-type="text" data-pk="egresos_comprobantes-concepto-{{id}}">
					{{ concepto }}
		      	</a>
		      </td>
		    </tr>       
		  </tbody>
		</table>
		<table class="table table-bordered table-condensed">
		  <thead>
		    <tr>
		      <th>Elaborado</th>
		  	  <th>Recibido</th>
		    </tr>
		  </thead>
		  <tbody class="text-center">
		    <tr>
		      <td class="area_firma"> <div>
		      	<a href="#" id="elaborador-{{id}}" class="editable" data-type="text" data-pk="egresos_comprobantes-elaborador-{{id}}">
		      		{{ elaborador }}
		      	</a>	
		      	</div></td>
		      <td></td>
		    </tr>  
		    <tr>
		      <td>Fecha: 
		      	<a href="#" id="fecha-{{id}}" class="editable" data-type="text" data-pk="egresos_comprobantes-fecha-{{id}}">
		      	{{ fecha }}
		      	</a></td>
		      <td>Fecha: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;  </td>
		    </tr>       
		  </tbody>
		</table>

		{{/egresos_comprobantes}}	  	
		
	{{else}}
		No se ha encontrado este Egreso
	{{/if}}
</script>

	
<?php //$this -> render("default/modal/nextprev"); ?>

<?php 
    	/*if (!empty($this->has_retencion)){ ?>
    		<div  style="height: 35%"></div>
    	<?php $this -> render("egresos/retenciones_aplicadas/detail");
			//Copia
			$this -> render("egresos/retenciones_aplicadas/detail");
    	}*/ 
?>

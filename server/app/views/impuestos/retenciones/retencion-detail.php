
<?php foreach ($this->retencion as $Retencion) { 
		
		$id = $Retencion['id'];
		$id_cliente = $Retencion['agente_retencion'];
		
?>
<?php $this -> render("default/modal/nextprev");  ?>

<div class="grid_11">
	<div class="well well-sm">
		
		<!-- Ficha cliente -->
		<h4>
			<a href="#" id="agente_retencion-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" class="editable" data-type="select" data-pk="retenciones-agente_retencion-<?php echo $id; ?>" data-source="clients">
			<?php echo $this -> cliente[$id_cliente]; ?>
			</a>
		</h4>
		
		<?php  echo $this -> cliente_details[$id_cliente][0]['rif']; ?><br>
		<small>
			(<a href="#" id="rubro-<?php echo $id_cliente; ?>" class="editable" data-placeholder="Rubro" data-type="text" data-pk="cliente-rubro-<?php echo $id_cliente; ?>">
			<?php  echo $this -> cliente_details[$id_cliente][0]['website']; ?>
			</a>)
		</small><br>
		<a href="#" id="direccion-<?php echo $id_cliente; ?>" class="editable" data-placeholder="Dirección" data-type="text" data-pk="cliente-direccion-<?php echo $id_cliente; ?>">
			<?php  echo $this -> cliente_details[$id_cliente][0]['direccion_fiscal']; ?>
		</a>
		<a href="#" id="telefono-<?php echo $id_cliente; ?>" class="editable" data-placeholder="Teléfono" data-type="text" data-pk="cliente-telefono-<?php echo $id_cliente; ?>"> 
			<?php  echo $this -> cliente_details[$id_cliente][0]['telefono']; ?>
		</a>
		<br>
	</div>
	
	
	
	<div class="grid_11 text-left">Fecha de Emision: 
			<a href="#" id="dia-<?php echo $id; ?>" class="editable" data-type="text" data-pk="retenciones-dia-<?php echo $id; ?>">
				<?php echo zerofill($Retencion['dia'],2); ?>
			</a>/
			<a href="#" id="mes-<?php echo $id; ?>" class="editable" data-type="text" data-pk="retenciones-mes-<?php echo $id; ?>">
				<?php echo zerofill($Retencion['mes'],2); ?>
			</a>/
			<a href="#" id="anio-<?php echo $id; ?>" class="editable" data-type="text" data-pk="retenciones-anio-<?php echo $id; ?>">
				<?php echo zerofill($Retencion['anio'],2); ?>
			</a>
	</div>
	<div class="grid_11 text-left">Factura #&nbsp;
		<a href="#" id="factura-<?php echo $id; ?>" class="editable" data-type="text" data-pk="retenciones-factura-<?php echo $id; ?>">
			<?php echo $Retencion['factura']; ?>
		</a>
	</div>
	<div class="grid_11 dottedline"></div>
	<div class="grid_11 text-left"><br>
		<a href="#" id="concepto-<?php echo $id; ?>" class="editable" data-type="text" data-pk="retenciones-concepto-<?php echo $id; ?>">
			<?php echo $Retencion['comprobante']; ?>
		</a>
		<br><br></div>
	<div class="grid_11 dottedline"></div>
	<div class="grid_5 text-left">Base Imponible:</div>
	<div class="grid_6 text-right">
		<a href="#" id="base_imponible-<?php echo $id; ?>" class="editable" data-type="text" data-pk="retenciones-base_imponible-<?php echo $id; ?>">
			<?php echo dineroFormat($Retencion['base_imponible']); ?>
		</a></div>
	<div class="grid_5 text-left">IVA 
		<a href="#" id="alicuota-<?php echo $id; ?>" class="editable" data-type="text" data-pk="retenciones-alicuota-<?php echo $id; ?>">
			<?php echo $Retencion['alicuota']; ?>
		</a>% :</div>
	<div class="grid_6 text-right">
		<a href="#" id="impuesto-<?php echo $id; ?>" class="editable" data-type="text" data-pk="retenciones-impuesto-<?php echo $id; ?>">
			<?php echo dineroFormat($Retencion['impuesto']); ?>
		</a></div>
	<div class="grid_11 dottedline"></div>
	<div class="grid_5 text-left"><h4>TOTAL</h4></div>
	<div class="grid_6 text-right"><h4><?php echo dineroFormat($Retencion['base_imponible'] + $Retencion['impuesto']); ?></h4></div>
	<div class="grid_11 dottedline"></div>
	<div class="grid_12 well well-sm">
		<i class="glyphicon glyphicon-info-sign"></i> Declarada: 
		<a href="#" id="declarada-<?php echo $id; ?>" class="editable badge" data-type="select" data-pk="retenciones-declarada-<?php echo $id; ?>" data-source="element_options">
			<?php echo $Retencion['declarada']; ?>
		</a>
		 &nbsp;&nbsp;&nbsp;&nbsp;Planilla asociada: 
		 <a href="#" id="planilla_asociada-<?php echo $id; ?>" class="editable badge" data-type="select" data-pk="retenciones-planilla_asociada-<?php echo $id; ?>" data-source="list_planillas">
			<?php echo $Retencion['planilla_asociada']; ?>
		</a>
		
	</div>    
			    
		
		 	
		</a>
		
</div>


</div>
<div class="clear"></div>

			  
	</div>
<?php } ?>

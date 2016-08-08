
<?php foreach ($this->compra as $Compra) { 
		
		$id = $Compra['id'];
		$id_proveedor = $Compra['proveedor_id'];
		
?>

<?php $this -> render("default/modal/nextprev");  ?>

<div class="grid_11">
	<div class="well well-sm">
		
		<!-- Ficha Proveedor -->
		<h4>
			<a href="#" id="proveedor_id-<?php echo $detail_anio['year'] . "-" . $id_domain; ?>" class="editable" data-type="select" data-pk="compras-proveedor_id-<?php echo $id; ?>" data-source="providers">
			<?php echo $this -> proveedor[$id_proveedor]; ?>
			</a>
		</h4>
		
		<?php  echo $this -> proveedor_details[$id_proveedor][0]['rif']; ?><br>
		<small>
			(<a href="#" id="rubro-<?php echo $id_proveedor; ?>" class="editable" data-placeholder="Rubro" data-type="text" data-pk="proveedor-rubro-<?php echo $id_proveedor; ?>">
			<?php  echo $this -> proveedor_details[$id_proveedor][0]['rubro']; ?>
			</a>)
		</small><br>
		<a href="#" id="direccion-<?php echo $id_proveedor; ?>" class="editable" data-placeholder="Dirección" data-type="text" data-pk="proveedor-direccion-<?php echo $id_proveedor; ?>">
			<?php  echo $this -> proveedor_details[$id_proveedor][0]['direccion']; ?>
		</a>
		<a href="#" id="telefono-<?php echo $id_proveedor; ?>" class="editable" data-placeholder="Teléfono" data-type="text" data-pk="proveedor-telefono-<?php echo $id_proveedor; ?>"> 
			<?php  echo $this -> proveedor_details[$id_proveedor][0]['telefono']; ?>
		</a>
		<br>
	</div>
	
	
	
	<div class="grid_11 text-left">Fecha de Emision: 
			<a href="#" id="dia-<?php echo $id; ?>" class="editable" data-type="text" data-pk="compras-dia-<?php echo $id; ?>">
				<?php echo zerofill($Compra['dia'],2); ?>
			</a>/
			<a href="#" id="mes-<?php echo $id; ?>" class="editable" data-type="text" data-pk="compras-mes-<?php echo $id; ?>">
				<?php echo zerofill($Compra['mes'],2); ?>
			</a>/
			<a href="#" id="anio-<?php echo $id; ?>" class="editable" data-type="text" data-pk="compras-anio-<?php echo $id; ?>">
				<?php echo zerofill($Compra['anio'],2); ?>
			</a>
	</div>
	<div class="grid_11 text-left">Factura #&nbsp;
		<a href="#" id="factura-<?php echo $id; ?>" class="editable" data-type="text" data-pk="compras-factura-<?php echo $id; ?>">
			<?php echo $Compra['factura']; ?>
		</a>
	</div>
	<div class="grid_11 dottedline"></div>
	<div class="grid_11 text-left"><br>
		<a href="#" id="concepto-<?php echo $id; ?>" class="editable" data-type="text" data-pk="compras-concepto-<?php echo $id; ?>">
			<?php echo $Compra['concepto']; ?>
		</a>
		<br><br></div>
	<div class="grid_11 dottedline"></div>
	<div class="grid_5 text-left">Base Imponible:</div>
	<div class="grid_6 text-right">
		Bs. <a href="#" id="base_imponible-<?php echo $id; ?>" class="editable" data-type="text" data-pk="compras-base_imponible-<?php echo $id; ?>">
			<?php echo dineroFormat($Compra['base_imponible'],2,'nobs'); ?>
		</a></div>
	<div class="grid_5 text-left">IVA 
		<a href="#" id="alicuota-<?php echo $id; ?>" class="editable" data-type="text" data-pk="compras-alicuota-<?php echo $id; ?>">
			<?php echo $Compra['alicuota']; ?>
		</a>% :</div>
	<div class="grid_6 text-right">
		Bs. <a href="#" id="impuesto-<?php echo $id; ?>" class="editable" data-type="text" data-pk="compras-impuesto-<?php echo $id; ?>">
			<?php echo dineroFormat($Compra['impuesto'],2,'nobs'); ?>
		</a></div>
	<div class="grid_11 dottedline"></div>
	<div class="grid_5 text-left"><h4>TOTAL</h4></div>
	<div class="grid_6 text-right"><h4><?php echo dineroFormat($Compra['base_imponible'] + $Compra['impuesto']); ?></h4></div>
	<div class="grid_11 dottedline"></div>
	<div class="grid_12 well well-sm">
		Aprobada para IVA 
		<a href="#" id="aprobada-<?php echo $id; ?>" class="editable label palette-<?php if ($Compra['aprobada'] === 'no') echo "asbestos"; else echo "turquoise";?>" data-type="select" data-pk="compras-aprobada-<?php echo $id; ?>" data-source="element_options">
			<?php echo $Compra['aprobada']; ?>
		</a>
		 &nbsp;&nbsp;&nbsp;&nbsp; Declarada: 
		<a href="#" id="declarada-<?php echo $id; ?>" class="editable badge" data-type="select" data-pk="compras-declarada-<?php echo $id; ?>" data-source="element_options">
			<?php echo $Compra['declarada']; ?>
		</a>
		 &nbsp;Planilla asociada: 
		 <a href="#" id="planilla_asociada-<?php echo $id; ?>" class="editable badge" data-type="select" data-pk="compras-planilla_asociada-<?php echo $id; ?>" data-source="list_planillas">
			<?php echo $Compra['planilla_asociada']; ?>
		</a>
		
	</div>    
			    
		
		 	
		</a>
		
</div>


</div>
<div class="clear"></div>

			  
	</div>
<?php } ?>

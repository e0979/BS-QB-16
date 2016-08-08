<?php foreach ($this->planilla as $Planilla) { 
		
		$id = $Planilla['id'];
		
?>
<?php $this -> render("default/modal/nextprev");  ?>

	<div class="grid_8">
		<h4>Planilla  <?php echo "(" . $Planilla['mes'] ."/". $Planilla['anio']  ; ?>)
		<br>
			
			</h4>
	</div>
	
	<div class="clear"></div>
	<div id="limited-view" class="limited-view">
					
		
			
			<!--Ventas-->
			<div class="panel panel-default">
			  <div class="palette palette-nephritis">Libro de Ventas</div>
			  <?php if (!empty($this->facturas)) { ?>
			  <table class="table table-hover table-condensed">
				<thead>
		          <tr>
		            <th>#</th>
		            <th class="text-left">Cliente</th>
		            <th>Fecha</th>
		             <th class="text-right">Base Imponible</th>
		             <th class="text-right">IVA</th>
		          </tr>
		        </thead>
		        <tbody>
		        <?php foreach ($this->facturas as $Factura) {
		        	  		 
		        	  	$id_cliente = $Factura['id_cliente'];
		       	?>
					<tr	<?php if ($Factura['anulada'] === 'si') { echo 'class="danger"';} ?>>
				    	<td><?php echo zerofill($Factura['id'],4); ?></td>
				        <td class="text-left"><?php echo $this->cliente[$id_cliente]; ?></td>
				        <td><?php echo $Factura['dia'] . "/". $Factura['mes']. "/". shortyear($Factura['anio']); ?></td>
				        <td class="text-right"><?php echo dineroFormat($Factura['subtotal']); ?></td>
				        <td class="text-right"><?php echo dineroFormat($Factura['impuesto']); ?></td>
				    </tr>
			
			    <?php } ?>
			   		 <tr class="table-striped">
				    	<td></td>
				        <td></td>
				        <td><strong>Total Débito Fiscal</td>
				        <td class="text-right"><strong><?php echo dineroFormat($Planilla['facturas_bi']); ?></strong></td>
				        <td class="text-right"><strong><?php echo dineroFormat($Planilla['facturas_impuesto']); ?></strong></td>
				    </tr>
			    </tbody>
			  </table>
			  
			  
			   <?php } else { echo "No hay Ventas declaradas"; } ?>
			</div>
			
			
			<!--NOTAS DEBITO-->
			<div class="panel panel-default">
			  <div class="palette palette-emerald">Notas de Débito</div>
			  <?php if (!empty($this->notas_debito)) { ?>
			  <table class="table table-hover table-condensed">
				<thead>
		          <tr>
		            <th>#</th>
		            <th class="text-left">Cliente</th>
		            <th>Fecha</th>
		             <th class="text-right">Base Imponible</th>
		             <th class="text-right">IVA</th>
		          </tr>
		        </thead>
		        <tbody>
		        <?php foreach ($this->notas_debito as $NotaDebito) {
		        	  		 
		        	  	$id_cliente = $NotaDebito['id_cliente'];
		       	?>
					<tr	<?php if ($NotaDebito['anulada'] === 'si') { echo 'class="danger"';} ?>>
				    	<td><?php echo zerofill($NotaDebito['id'],4); ?></td>
				        <td class="text-left"><?php echo $this->cliente[$id_cliente]; ?></td>
				        <td><?php echo $NotaDebito['dia'] . "/". $NotaDebito['mes']. "/". shortyear($NotaDebito['anio']); ?></td>
				        <td class="text-right"><?php echo dineroFormat($NotaDebito['subtotal']); ?></td>
				        <td class="text-right"><?php echo dineroFormat($NotaDebito['impuesto']); ?></td>
				    </tr>
			
			    <?php } ?>
			   		 <tr class="table-striped">
				    	<td></td>
				        <td></td>
				        <td><strong>Total Débito Fiscal</td>
				        <td class="text-right"><strong><?php echo dineroFormat($Planilla['ndebitos_bi']); ?></strong></td>
				        <td class="text-right"><strong><?php echo dineroFormat($Planilla['ndebitos_impuesto']); ?></strong></td>
				    </tr>
			    </tbody>
			  </table>
			  
			  
			   <?php } ?>
			</div>
			
			
			
			<!--NOTAS CREDITO-->
			<div class="panel panel-default">
			  <div class="palette palette-peter-river">Notas de Crédito</div>
			  <?php if (!empty($this->notas_credito)) { ?>
			  <table class="table table-hover table-condensed">
				<thead>
		          <tr>
		            <th>#</th>
		            <th class="text-left">Cliente</th>
		            <th>Fecha</th>
		             <th class="text-right">Base Imponible</th>
		             <th class="text-right">IVA</th>
		          </tr>
		        </thead>
		        <tbody>
		        <?php foreach ($this->notas_credito as $NotaCredito) {
		        	  		 
		        	  	$id_cliente = $NotaCredito['id_cliente'];
		       	?>
					<tr	<?php if ($NotaCredito['anulada'] === 'si') { echo 'class="danger"';} ?>>
				    	<td><?php echo zerofill($NotaCredito['id'],4); ?></td>
				        <td class="text-left"><?php echo $this->cliente[$id_cliente]; ?></td>
				        <td><?php echo $NotaCredito['dia'] . "/". $NotaCredito['mes']. "/". shortyear($NotaCredito['anio']); ?></td>
				        <td class="text-right"><?php echo dineroFormat($NotaCredito['subtotal']); ?></td>
				        <td class="text-right"><?php echo dineroFormat($NotaCredito['impuesto']); ?></td>
				    </tr>
			
			    <?php } ?>
			   		 <tr class="table-striped">
				    	<td></td>
				        <td></td>
				        <td><strong>Total Débito Fiscal</td>
				        <td class="text-right"><strong><?php echo dineroFormat($Planilla['ncredito_bi']); ?></strong></td>
				        <td class="text-right"><strong><?php echo dineroFormat($Planilla['ncredito_impuesto']); ?></strong></td>
				    </tr>
			    </tbody>
			  </table>
			  
			  
			   <?php }  ?>
			</div>
			
			<!--Compras-->
			<div class="panel panel-default">
			  <div class="palette palette-pomegranate">Libro de Compras</div>
			  <?php if (!empty($this->compras)) { ?>
			  <table class="table table-hover table-condensed" >
				<thead>
		          <tr>
		            <th>#</th>
		            <th class="text-left">Cliente</th>
		            <th>Fecha</th>
		             <th class="text-right">Base Imponible</th>
		             <th class="text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IVA</th>
		             <th class="soloenedit">para IVA</th>
		          </tr>
		        </thead>
		       <tbody  id="compras-list-body">
					<?php foreach ($this->compras as $Compra) { 
						$id_proveedor = $Compra['proveedor_id'];
						if ($Compra['aprobada'] == 'si' ) {
						 	 $clase = 'ok';
						} else {
						 	$clase = 'remove';
						}
					?>
					<tr>
						<td><?php echo $Compra['factura']; ?></td>
						<td class="text-left"><?php echo $this -> proveedor[$id_proveedor]; ?></td>
						<td><?php echo $Compra['dia'] . "/" . $Compra['mes'] . "/" . shortyear($Compra['anio']); ?></td>
						<td class="text-right"><?php echo dineroFormat($Compra['base_imponible']); ?></td>
						<td class="text-right"><?php echo dineroFormat($Compra['impuesto']); ?></td>
						<td class="soloenedit"> <button id="compra-<?php echo $Compra['id']; ?>" class="btn btn-xs btn-default aprobacion"><i class="glyphicon glyphicon-<?php echo $clase; ?>"></i></button>    	</td>
					</tr>
					<?php } ?>
					<tr>
						<td></td>
						<td colspan="2" class="text-right"><strong>Total Crédito Compras</td>
						<td class="text-right"><strong><?php echo dineroFormat($Planilla['compras_bi']); ?></strong></td>
						<td class="text-right"><strong><?php echo dineroFormat($Planilla['compras_impuesto']); ?></strong></td>
						<td class="soloenedit"></td>
					</tr>
				</tbody>
			  </table>
			  
			   <?php } else { echo "No hay Compras declaradas"; } ?>
			  
			</div>
			
			
			<!--Retenciones-->
			<div class="panel panel-default">
			  <div class="palette palette-pumpkin">Retenciones declaradas</div>
			  <?php if (!empty($this->retenciones)) { ?>
			  <table class="table table-hover table-condensed">
				<thead>
		          <tr>
		            <th>fac afectada</th>
		            <th class="text-left">Agente Retencion</th>
		            <th>Fecha</th>
		             <th class="text-right">Base Imponible</th>
		             <th class="text-right">IVA Retenido</th>
		          </tr>
		        </thead>
		        <tbody>
		        <?php foreach ($this->retenciones as $Retencion) { 
		        		 $id_cliente = $Retencion['agente_retencion'];
		         ?>
					<tr>
				    	<td><?php echo zerofill($Retencion['factura'],4); ?></td>
				        <td class="text-left"><?php echo $this->cliente[$id_cliente]; ?></td>
				        <td><?php echo $Retencion['dia'] . "/". $Retencion['mes']. "/". shortyear($Retencion['anio']); ?></td>
				        <td class="text-right"><?php echo dineroFormat($Retencion['base_imponible']); ?></td>
				        <td class="text-right"><?php echo dineroFormat($Retencion['iva_retenido']); ?></td>
				    </tr>
			
			    <?php } ?>
					 <tr>
				    	<td> </td>
				        <td></td>
				        <td></td>
				        <td><strong>Total Retenciones</strong></td>
				        <td class="text-right">
				        	Bs. <a href="#" id="total_retenciones-<?php echo $id; ?>" class="editable" data-type="text" data-pk="iva_declaracion-total_retenciones-<?php echo $id; ?>">
				        		<?php echo dineroFormat($Planilla['total_retenciones'],2,'nobs'); ?>
				        	</a>
				        </td>
				        
				    </tr>
			    </tbody>
			  </table>
			  
			  
			  
			  <?php } else { echo "No hay Retenciones declaradas"; } ?>
			</div>
			
			
			
			
		
		</div>
		<div class="modal-footer">
			<div class="grid_9 right panel panel-default" id="resumen">
			  	<?php $this->render('impuestos/iva/resumen'); ?>
			</div>
		</div>

<?php } ?>

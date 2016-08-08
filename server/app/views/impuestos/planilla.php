<?php 
	/*if ($this->editing === TRUE) {
		$editclass = " editable";		
	} else { $editclass = ''; } */
?>
<?php foreach ($this->planilla as $Planilla) { 
		
		$id_iva = $Planilla['id'];
?>
<div class="grid_10">
	<h4>Planilla 
	<span class="label label-info">#&nbsp;
	<a href="#" id="planilla-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-planilla-<?php echo $id_iva; ?>">
		<?php echo $Planilla['planilla'] . "</a></span> (" . $Planilla['mes'] ."/". $Planilla['anio']  ; ?>)
	<small>	<br>
	creada: 
		
		<a href="#" id="fecha_creacion-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-fecha_creacion-<?php echo $id_iva; ?>">
		 	<?php echo $Planilla['fecha_creacion']; ?> 
		</a>
		presentada: 
		<a href="#" id="fecha_entrega-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-fecha_entrega-<?php echo $id_iva; ?>">
		 	<?php echo $Planilla['fecha_entrega']; ?> 
		</a>
		elaborada: 
		<a href="#" id="elaborada_por-<?php echo $id_iva; ?>" class="editable label label-warning" data-type="text" data-pk="iva_declaracion-elaborada_por-<?php echo $id_iva; ?>">
		 	<?php echo $Planilla['elaborada_por']; ?> 
		</a></small></h4>
</div>

<div class="grid_1 right">
	<button type="button" class="acciones text-right"><i class="glyphicon glyphicon-new-window"></i>
</button>

</div>
<div class="clear"></div>
<div class="limited-view">
				
	
		
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
		  <table class="table table-hover table-condensed">
			<thead>
	          <tr>
	            <th>#</th>
	            <th class="text-left">Cliente</th>
	            <th>Fecha</th>
	             <th class="text-right">B.Imponible</th>
	             <th class="text-right">IVA</th>
	             <th class="soloenedit">para IVA</th>
	          </tr>
	        </thead>
	        <tbody>
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
			        <td class="text-left"><?php echo $this->proveedor[$id_proveedor]; ?></td>
			        <td><?php echo $Compra['dia'] . "/". $Compra['mes']. "/". shortyear($Compra['anio']); ?></td>
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
	        		 $id_proveedor = $Retencion['agente_retencion'];
	         ?>
				<tr>
			    	<td><?php echo zerofill($Retencion['factura'],4); ?></td>
			        <td class="text-left"><?php echo $this->proveedor[$id_proveedor]; ?></td>
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
			        	<a href="#" id="total_retenciones-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-total_retenciones-<?php echo $id_iva; ?>">
			        		<?php echo dineroFormat($Planilla['total_retenciones']); ?>
			        	</a>
			        </td>
			        
			    </tr>
		    </tbody>
		  </table>
		  
		  
		  
		  <?php } else { echo "No hay Retenciones declaradas"; } ?>
		</div>
		
		
		
		
	
	</div>
	<div class="modal-footer">
		<div class="grid_8 right panel panel-default">
		  <div class="panel-heading">Resumen</div>
		
		  <table class="table table-hover table-condensed">
			
	        <tbody>
	        	<tr><td>Total Débito Fiscal</td>
	        		<td class="text-right">Bs. 
	        			<a href="#" id="total_debitos-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-total_debitos-<?php echo $id_iva; ?>">
	        				<?php echo dineroFormat($Planilla['total_debitos'], 2,'nobs'); ?>
	        			</a>
	        		</td>
			   		<td class="text-right">Bs. 
			   			<a href="#" id="total_iva_debitos-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-total_iva_debitos-<?php echo $id_iva; ?>">
			   				<?php echo dineroFormat($Planilla['total_iva_debitos'], 2,'nobs'); ?>
			   			</a>
			   		</td>
			   	</tr>
			   	<tr><td>Total Crédito Fiscal</td>
	        		<td class="text-right">Bs. 
	        			<a href="#" id="total_creditos-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-total_creditos-<?php echo $id_iva; ?>">
	        				<?php echo dineroFormat($Planilla['total_creditos'], 2,'nobs'); ?>
	        			</a>
	        		</td>
			   		<td class="text-right">Bs. 
			   			<a href="#" id="total_iva_creditos-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-total_iva_creditos-<?php echo $id_iva; ?>">
			   				<?php echo dineroFormat($Planilla['total_iva_creditos'], 2,'nobs'); ?>
			   			</a>
			   		</td>
			   	</tr>
			   	<?php //if ($Planilla['excedente_previo'] != 0.00) { ?>
			   	<tr>
	        		<td colspan="3" class="text-right">Excedente Mes anterior &nbsp;&nbsp;&nbsp;<?php echo dineroFormat($Planilla['excedente_previo']); ?></td>
			   	</tr>
			   	<?php //} ?>
				<tr>
					<td colspan="3" class="text-right"><strong><?php 
					if ($Planilla['total_pagar'] < 0) {
						echo "Credito Fiscal para Mes Siguiente";
					} else {
						echo $Planilla['total_pagar_mensaje'];
					}
					?> &nbsp;&nbsp;&nbsp; Bs.  
					<a href="#" id="total_pagar-<?php echo $id_iva; ?>" class="editable" data-type="text" data-pk="iva_declaracion-total_pagar-<?php echo $id_iva; ?>">
						<?php echo dineroFormat($Planilla['total_pagar'], 2,'nobs'); ?>
					</a>
					</strong></td>
				</tr>
				
		    </tbody>
		  </table>
		  
		</div>
	</div>
<?php } ?>

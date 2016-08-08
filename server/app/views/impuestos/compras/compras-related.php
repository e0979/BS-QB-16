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
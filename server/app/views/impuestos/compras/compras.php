 <?php foreach ($this->compras as $Compra) { 
			        		 $id_proveedor = $Compra['proveedor_id'];
							 if ($Compra['aprobada'] == 'si' ) {
							 	 $clase = 'ok';
							 } else {
							 	$clase = 'remove';
							 }
							
							if ($Compra['declarada'] !== 'si') {
								$declarada_class = SINDECLARAR_CLASS;
								$declarada_badge = SINDECLARAR;
							} else {
								$declarada_class = ''; $declarada_badge = '';
							}
					 ?>
                    	<tr class="<?php echo $declarada_class; ?>">
                    		<td><?php echo $Compra['anio'] . "/". zerofill($Compra['mes'],2). "/". zerofill($Compra['dia'],2); ?></td>
                    		<td class="text-left"><?php echo @$this->proveedor[$id_proveedor]; ?></td>
                    		<td><?php echo $Compra['factura']; ?></td>
					        <td><small><?php echo $Compra['concepto']; ?></small></td>
                    		<td class="text-right">
                    			<?php echo dineroFormat($Compra['base_imponible'] + $Compra['impuesto']); ?>
                    		</td>
					        <td> 
					        	<button id="compra-<?php echo $Compra['id']; ?>" class="btn btn-xs btn-default aprobacion"><i class="glyphicon glyphicon-<?php echo $clase; ?>"></i></button>
					       <?php echo $declarada_badge; ?>
					       <?php if ($Compra['aprobada'] == 'si' && (!is_numeric($Compra['planilla_asociada']) || $Compra['planilla_asociada'] === '0')) {
					       		echo SINASOCIAR;
					       } ?>
					       </td>
					   		 <td>
					   			<button class="btn btn-xs btn-blue" onclick="edit('compras',<?php echo $Compra['id']; ?>);"><i class="glyphicon glyphicon-pencil"></i> editar</button>
					   			<button class="btn btn-xs btn-info" onclick="view('compras',<?php echo $Compra['id']; ?>);"><i class="glyphicon glyphicon-search"></i> ver</button>
					   		</td>	
                    	</tr>		 			
	       			<?php } ?>
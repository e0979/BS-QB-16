<?php foreach ($this->retenciones as $Retencion) { 
			        		 $id_cliente = $Retencion['agente_retencion'];	
			        		 
			        		if ($Retencion['declarada'] !== 'si') {
								$declarada_class = SINDECLARAR_CLASS;
								$declarada_badge = SINDECLARAR;
							} else {
								$declarada_class = ''; $declarada_badge = '';
							}
											 
					 ?>							
                    	<tr class="<?php echo $declarada_class; ?>">
                    		<td><?php echo $Retencion['anio'] . "/". zerofill($Retencion['mes'],2). "/". zerofill($Retencion['dia'],2); ?></td>
                    		<td class="text-left"><?php echo $this->cliente[$id_cliente]; ?></td>
                    		<td><?php echo $Retencion['comprobante']; ?></td>
					        <td><small><?php echo zerofill($Retencion['factura'],4); ?></small></td>
                    		<td class="text-right">
                    			<?php echo dineroFormat($Retencion['iva_retenido']); ?>
                    		</td>
					        <td> 
					        	<?php echo $declarada_badge; 
					        	 if ($Retencion['declarada'] == 'si' && (!is_numeric($Retencion['planilla_asociada']) || $Retencion['planilla_asociada'] === '0')) {
						       		echo SINASOCIAR;
						       } ?>
					       </td>
					   		 <td>
					   		 	
					   			<button class="btn btn-xs btn-blue" onclick="edit('retenciones',<?php echo $Retencion['id']; ?>);"><i class="glyphicon glyphicon-pencil"></i> editar</button>
					   			<button class="btn btn-xs btn-info" onclick="view('retenciones',<?php echo $Retencion['id']; ?>);"><i class="glyphicon glyphicon-search"></i> ver</button>
					   		</td>	
                    	</tr>		 			
	       			<?php } ?>
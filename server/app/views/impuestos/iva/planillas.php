

<?php foreach ($this->planillas as $Planilla) { ?>	
						<tr>
							<th><?php echo $Planilla['anio'] ."/".$Planilla['mes']; ?> </th>
							<th>
	                        	
	                        		
	                        			<?php echo $Planilla['planilla']; ?> 
	                        	
	                        	
	                        </th>
	                        <th><?php echo dineroFormat($Planilla['total_iva_debitos']); ?> </th>
							<th><?php echo dineroFormat($Planilla['total_iva_creditos']); ?> </th>
							<th><strong><?php echo dineroFormat($Planilla['total_pagar']); ?> </strong></th>
							<th><span class="label label-warning"><?php echo $Planilla['elaborador']; ?></span> </th>
							<th>
								<button class="btn btn-xs btn-blue" onclick="edit('iva',<?php echo $Planilla['id']; ?>);"><i class="glyphicon glyphicon-pencil"></i> editar</button>
								<!--button class="btn btn-xs btn-info" data-toggle="modal" data-target="#ver-planilla" id="ver-<?php echo $Planilla['id']; ?>"><i class="glyphicon glyphicon-search"></i> ver</button-->
								<button class="btn btn-xs btn-info" onclick="view('iva',<?php echo $Planilla['id']; ?>);"><i class="glyphicon glyphicon-search"></i> ver</button>
							</th>
	                    </tr>			 			
	       			<?php } ?>
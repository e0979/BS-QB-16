<?php /* foreach ($this->comprobantes as $Planilla) { ?>	
	<tr>
		<th> <?php echo zerofill($Planilla['numero'],5); ?></th>
		<th>
			<?php echo $Planilla['dia'] . "/" . $Planilla['mes']. "/" . $Planilla['anio']; ?> 
	    </th>
	    <th><?php echo $Planilla['beneficiario']; ?> </th>
		<th><?php echo $Planilla['rif']; ?> </th>
		<th><strong><?php echo dineroFormat($Planilla['monto']); ?> </strong></th>
		<th><span class="label label-warning"><?php echo $Planilla['elaborador']; ?></span> </th>
		<th>
			<button class="btn btn-xs btn-blue" onclick="edit('iva',<?php echo $Planilla['id']; ?>);"><i class="glyphicon glyphicon-pencil"></i> editar</button>
			<!--button class="btn btn-xs btn-info" data-toggle="modal" data-target="#ver-planilla" id="ver-<?php echo $Planilla['id']; ?>"><i class="glyphicon glyphicon-search"></i> ver</button-->
			<button class="btn btn-xs btn-info" onclick="view('iva',<?php echo $Planilla['id']; ?>);"><i class="glyphicon glyphicon-search"></i> ver</button>
		</th>
	</tr>			 			
<?php }*/ ?>
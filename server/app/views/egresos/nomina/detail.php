<?php foreach ($this->nomina as $Nomina) {

$id = $Nomina['id'];
?>


<?php $this -> render("default/modal/nextprev"); ?>
<table class="table table-condensed">
      <tbody>
      
        <tr>
        	<td>
        		<h4>Nomina del <a href="#" id="egreso-<?php echo $id; ?>" class="editable" data-type="select" data-source="formapago_options" data-pk="egresos_comprobantes-forma_pago-<?php echo $id; ?>"><?php echo $Nomina['fecha_desde']; ?></a> al
        		<a href="#" id="egreso-<?php echo $id; ?>" class="editable" data-type="text" data-pk="egresos_comprobantes-id-<?php echo $id; ?>"><?php echo $Nomina['fecha_hasta']; ?></a> <br>
        		<small> elaboración <?php echo $Nomina['fecha']; ?> por <?php echo $this->empleado[$Nomina['elaborador']][0]['nombre'] ." ". $this->empleado[$Nomina['elaborador']][0]['apellido']; ?></small></h4>
        	</td>
    	</tr>      
	</tbody>
</table>
<table class=" empleados-list table table-striped table-hover">
	<tbody>	
		<?php foreach ($this->recibos_emitidios as $Recibo) { 
				$cedula = $Recibo['empleado_id'];
			?>
		<tr>
			<td>
				<?php echo $this->empleado[$cedula][0]['nombre'] ." ". $this->empleado[$cedula][0]['apellido']; ?>
			</td>
			<td><?php echo dineroFormat($Recibo['total_pagado'],2); ?> </td>
			<td>
				<button class="btn btn-xs btn-info" onclick="view('nominarecibo',<?php echo $Recibo['id']; ?>);"><i class="glyphicon glyphicon-search"></i> ver recibo</button>
				<?php if($Recibo['comprobante_id'] !=='0') {
						$action = "view('comprobantes',".$Recibo['comprobante_id'].")";
						$action_txt = '<i class="glyphicon glyphicon-search"></i> ver comprobante';
					  } else {
					  	$action = "createfrom('comprobante','nominarecibo',".$Recibo['id'].")";
						
						$action_txt = '<i class="glyphicon glyphicon-file"></i> generar comprobante';
					  }
					 ?>
				<button class="btn btn-xs btn-info" onclick="<?php echo $action; ?>"><?php echo $action_txt; ?></button>				
			</td>
		</tr>
		<?php } ?>							
	</tbody>
</table>

<?php } ?>

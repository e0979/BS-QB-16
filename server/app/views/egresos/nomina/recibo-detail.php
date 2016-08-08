<?php foreach ($this->recibo as $Recibo) {

$id		= $Recibo['id'];
$cedula = $Recibo['empleado_id'];
$salario_diario = $Recibo['salario_base'] / 30;	 

?>


<?php $this -> render("default/modal/nextprev"); ?>
<style> .table-bordered th, .table-bordered td { border: solid 2px #000}</style>
<table class="table table-condensed table80">
	 <tbody>      
        <tr class="format_texts">
        	<td width="50%" colspan="2"><h5>BESIGN, C.A.<br><small><?php echo EMPRESA_RIF; ?><br> Tlf: <?php echo EMPRESA_TLF; ?></small></h5></td>
        	
        	<td class="text-right"><h5>Recibo de Pago <?php echo zerofill($Recibo['id'],4); ?></h5>
        		Fecha de emisión: <?php echo $Recibo['fecha']; ?>
        	</td>
        	
        </tr>
         <tr>
        	<td class="text-left">
        		Nombre del trabajador: <?php echo $this->empleado[$cedula][0]['nombre'] ." ". $this->empleado[$cedula][0]['apellido']; ?>
        		<span class="format_texts"> Cédula: <?php echo $this->empleado[$cedula][0]['cedula'].")"; ?></span><br>
        		Fecha de ingreso:  <?php echo $this->empleado[$cedula][0]['fecha_ingreso']; ?><br>
        		Cargo:  <?php echo $this->empleado_details[$cedula][0]['cargo']; ?><br>
        	</td>
        	<td></td>
        	<td class="text-right">
        		Quincena desde <?php echo $Recibo['fecha_desde']; ?> 
        		<br>al <?php echo $Recibo['fecha_hasta']; ?><br>
        		Salario	base mensual: <?php echo dineroFormat($Recibo['salario_base'],2); ?>
        		 
        	</td>
        </tr>       
     </tbody>
</table>

<table class="table table-condensed table-bordered thickborder table60">
	<thead>
		<tr>
			<th><strong>ASIGNACIONES</strong></th>
			<th class="text-center"><strong>Días Trabajados</strong></th>
			<th class="text-right"><strong>Monto</strong></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class="text-left">Salarios</td>
			<td class="text-center"><?php echo $Recibo['dias_trabajados']; ?></td>
			<td class="text-right"><?php echo dineroFormat($Recibo['salario_diastrabajados'],2); ?></td>
		</tr>
		<tr>
			<td class="text-left">Días Extras</td>
			<td class="text-center"><?php echo $Recibo['dias_extras']; ?></td>
			<td class="text-right"><?php echo dineroFormat($Recibo['dias_extras'] * $salario_diario,2); ?></td>
		</tr>
		<tr>
			<td class="text-left">Bonos de Producción</td>
			<td class="text-center">0</td>
			<td class="text-right">0</td>
		</tr>
		<tr>
			<td class="text-left">Días Cesta Ticket</td>
			<td class="text-center"></td>
			<td class="text-right"></td>
		</tr>
		<tr>
			<td colspan="3" class="text-left"><strong>DEDUCCIONES</strong></td>			
		</tr>

		<tr>
			<td class="text-left">S.S,O, (4%)</td>
			<td class="text-center">0</td>
			<td class="text-right">Bs. 0</td>
		</tr>
		<tr>
			<td class="text-left">SPF (0.5%)</td>
			<td class="text-center">0</td>
			<td class="text-right">Bs. 0</td>
		</tr>
		<tr>
			<td class="text-left">F.A.O.V</td>
			<td class="text-center">0</td>
			<td class="text-right">Bs. 0</td>
		</tr>
		<tr>
			<td class="text-left">Días No laborados</td>
			<td class="text-center"><?php echo $Recibo['dias_notrabajados']; ?></td>
			<td class="text-right"><?php echo dineroFormat($Recibo['dias_notrabajados'] * $salario_diario,2); ?></td>
		</tr>
		<tr>
			<td class="text-left">Otras Deducciones</td>
			<td class="text-center"></td>
			<td class="text-right">Bs. <?php echo $Recibo['otras_deducciones']; ?></td>
		</tr>
		<tr>
			<td class="text-right"><h5>Total Asignaciones</h5></td>
			<td colspan="2" class="text-right"><h5><?php echo dineroFormat($Recibo['total_pagado'],2); ?></h5></td>
		</tr>
	</tbody>
</table>
<table class="table format_texts table60">
	<tbody>
		<tr>
			<td class="text-right">RECIBI CONFORME: </td>
			<td>___________________________ &nbsp;&nbsp;&nbsp; C.I:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha:</td>
		</tr>
	</tbody>
</table>

<?php } ?>
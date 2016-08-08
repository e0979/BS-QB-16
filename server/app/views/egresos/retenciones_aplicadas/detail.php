
<?php foreach ($this->has_retencion as $Retencion) { 
		
		$id = $Retencion['id'];
		$id_proveedor = $Retencion['proveedor_id'];
		
?>

<div class="format_texts">
	<table class="table table-condensed format_texts ">
		<tbody>
			<tr>
				<td><img  src="<?php echo IMG; ?>logobesign.jpg" width="150"></td>
				<td>
					<div><h4>COMPROBANTE DE RETENCIONES VARIAS N° <?php echo zerofill($Retencion['id'], 4); ?></h4></div>
					<table class="table table-condensed table-bordered">
						<thead>
							<tr>
								<td>Fecha</td><td>Agente de Retención Sello y Firma</td>
							</tr>
						</thead>
					<tbody>
						<tr>
							<td><?php echo date('d/m/y'); ?></td><td height="55"></td>
						</tr>
					</tbody>
				</table>

				</td>
			</tr>
		</tbody>
	</table>
	<table class="table table-condensed table-bordered table-small-font">
		<tbody>
			<tr>
				<td>Razón Social del Agente de Retención</td>
				<td>RIF del Agente de Retención</td>
				<td>Tipo de persona del Agente de Retención</td>
			</tr>
			<tr>
				<td>BESIGN, C.A.</td>
				<td>J-29397290-6</td>
				<td>Jurídico</td>
			</tr>
			<tr>
				<td>Teléfono Agente de Retención</td>
				<td colspan="2">Dirección del Agente de Retención</td>
			</tr>
			<tr>
				<td>(0241) 825.10.78</td>
				<td colspan="2">Calle 152 c/c Calle 104, #102-183, Urb. La Alegría. Valencia, Edo. Carabobo</td>
			</tr>
			<tr>
				<td>Razón Social del Sujeto Retenido</td>
				<td>RIF del Sujeto Retenido</td>
				<td>Tipo de persona del Sujeto Retenido</td>
			</tr>
			<tr>
				<td><?php echo $this -> proveedor_details[$id_proveedor][0]['razon_social']; ?></td>
				<td><?php echo $this -> proveedor_details[$id_proveedor][0]['rif']; ?></td>
				<td>Jurídico</td>
			</tr>
			<tr>
				<td>Teléfono del Sujeto Retenido</td>
				<td colspan="2">Dirección del Sujeto Retenido</td>
			</tr>
			<tr>
				<td><?php echo $this -> proveedor_details[$id_proveedor][0]['telefono']; ?></td>
				<td colspan="2"><?php echo $this -> proveedor_details[$id_proveedor][0]['direccion']; ?></td>
			</tr>
		</tbody>
	</table>
	<table class="table table-condensed table-bordered table-small-font">
		<tbody>
			<tr>
				<td>Monto Pagado</td>
				<td>Monto Objeto de Retencion</td>
				<td>%</td>
				<td>Impuesto Retenido</td>
				<td>Fecha Pago</td>
				<td>Número Documento</td>
				<td>Sujeto Retenido Sello y Firma</td>
			</tr>
			<tr>
				
				<td><?php echo dineroFormat($Retencion['monto_pagado'],2,'nobs'); ?></td>
				<td><?php echo dineroFormat($Retencion['monto_retencion'],2,'nobs'); ?></td>
				<td><?php echo $Retencion['porcentaje']; ?></td>
				<td><?php echo dineroFormat($Retencion['impuesto_retenido'],2,'nobs'); ?></td>
				<td><?php echo $Retencion['fecha']; ?></td>
				<td><?php echo $Retencion['factura']; ?></td>
				<td height="60"></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="clear"></div>

<?php } ?>

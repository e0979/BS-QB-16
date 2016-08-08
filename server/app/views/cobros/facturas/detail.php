<?php foreach ($this->factura as $Factura) {

$id = $Factura['id'];
$id_cliente = $Factura['id_cliente'];
?>

<?php $this -> render("default/modal/nextprev"); ?>

<table width="100%" class="table-factura" id="datos_head">
	<tbody>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td class="text-right">Cliente:&nbsp;</td>
			<td colspan="3">
			<a href="#" id="id_cliente" class="editable" data-type="select" data-source="clients" data-pk="factura-id_cliente-<?php echo $id; ?>">
				<?php echo $this->cliente_details[$id_cliente][0]['razon_social']; ?>
			</a>
			</td>
			<td></td>
			<td class="format_texts" width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td class="text-right">Dirección:&nbsp;</td>
			<td colspan="3"><?php echo $Factura['direccion']; ?></td>
			<td width="15%" class="text-right"><h5>
				<a href="#" id="tipo_nota-<?php echo $id; ?>" class="editable" data-type="select" data-source="tiponota_options" data-pk="factura-tipo_nota-<?php echo $id; ?>">
					<?php echo strtoupper(field_diccionario($Factura['tipo_nota'])); ?>
				</a>
					<br>Nº <?php echo zerofill($Factura['id'],4); ?></h5></td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td class="text-right">RIF:&nbsp;</td>
			<td colspan="3"><?php echo $this->cliente_details[$id_cliente][0]['rif']; ?> &nbsp;&nbsp;&nbsp;Tlf:&nbsp;<?php echo $this->cliente_details[$id_cliente][0]['telefono']; ?></td>
			<td class="text-right">Fecha: 
				<a href="#" id="fecha-<?php echo $id; ?>" class="editable" data-type="text" data-pk="factura-fecha-<?php echo $id; ?>">
					<?php echo $Factura['fecha']; ?>
				</a>
			</td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>

		<tr>
			<td class="format_texts" width="26%"></th>
			<td class="table-liner"><strong>CANT</strong></th>
			<td colspan="2" class="table-liner text-center"><strong>DESCRIPCIÓN&nbsp;&nbsp;</strong></td>	
			<td class="text-right table-liner" width="12%"><strong>P/U&nbsp;&nbsp;</strong></td>
			<td class="text-right  table-liner" width="12%"><strong>TOTAL&nbsp;&nbsp;</strong></td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>	
	
		<?php		
			foreach ($this->factura_fields as $key => $Factura_campos) {
				$key = $key + 1;
				
				if (!empty($Factura_campos)) {
						
					if (($Factura_campos[0]['cantidad'] != '0')) {
			?>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td class="text-center table-line">
				<a href="#" id="cantidad-<?php echo $id; ?>" class="editable" data-type="text" data-pk="fcampo_<?php echo $key; ?>-cantidad-<?php echo $id; ?>-parent_id">
					<?php echo zerofill($Factura_campos[0]['cantidad'],2); ?>
				</a>
			</td>
			<td colspan="2" width="50%" class="text-left table-line">
				<a href="#" id="descripcion-<?php echo $id; ?>" class="editable" data-type="text" data-pk="fcampo_<?php echo $key; ?>-descripcion-<?php echo $id; ?>-parent_id">
					<?php echo $Factura_campos[0]['descripcion']; ?>
				</a>
			</td>
			<td width="12%" class="text-right table-line">Bs. 
				<a href="#" id="precio_unitario-<?php echo $id; ?>" class="editable" data-type="text" data-pk="fcampo_<?php echo $key; ?>-precio_unitario-<?php echo $id; ?>-parent_id">
					<?php echo dineroFormat($Factura_campos[0]['precio_unitario'],2,'nobs'); ?>
				</a>
			</td>
			<td width="12%" class="text-right table-line">Bs. 
				<a href="#" id="precio_total-<?php echo $id; ?>" class="editable" data-type="text" data-pk="fcampo_<?php echo $key; ?>-precio_total-<?php echo $id; ?>-parent_id">
					<?php echo dineroFormat($Factura_campos[0]['precio_total'],2,'nobs'); ?>
				</a>
				</td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>
		<?php } }
		} ?>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td>&nbsp;</td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td></td>
			<td colspan="2" class="text-center table-liner"><strong>FORMA DE PAGO</strong></td>
			<td width="12%" class="text-right">SUBTOTAL&nbsp;</td>
			<td class="text-right" width="12%">Bs.<a href="#" id="fecha-<?php echo $id; ?>" class="editable" data-type="text" data-pk="factura-subtotal-<?php echo $id; ?>">
				<?php echo dineroFormat($Factura['subtotal'],2,'nobs'); ?></a></td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>
		
		<tr>
			<td class="format_texts" width="26%"></td>
			<td></td>
			<td></td>
			<td class="text-left">Efectivo:</td>
			<td width="12%" class="text-right">AJUSTES&nbsp;</td>
			<td width="12%"></td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td></td>
			<td></td>
			<td class="text-left">Cheque:</td>
			<td width="12%" class="text-right">IVA <?php echo $Factura['iva']; ?>&nbsp;</td>
			<td class="text-right" width="12%">Bs. 
				<a href="#" id="impuesto-<?php echo $id; ?>" class="editable" data-type="text" data-pk="factura-impuesto-<?php echo $id; ?>">
				<?php echo dineroFormat($Factura['impuesto'],2,'nobs'); ?></a></td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>
		<tr>
			<td class="format_texts" width="26%"></td>
			<td></td><td></td>
			<td class="text-left">T.Débito / T.Crédito:</td>
			<td width="12%" class="text-right"><strong>TOTAL A PAGAR</strong>&nbsp;</td>
			<td class="text-right" width="12%"><strong>Bs. <?php echo dineroFormat(($Factura['impuesto']+ $Factura['subtotal']),2,'nobs'); ?></strong></td>
			<td class="format_texts" width="4%">&nbsp;</td>
		</tr>
		
	</tbody>
</table>



<?php } ?>
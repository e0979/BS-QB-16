<div class="panel-heading" >Resumen</div>
<form id="add-iva">	
	<input type="hidden" name="mes" id="mes" value="<?php echo $this->planilla[0]['mes']; ?>"/>	
	<input type="hidden" name="anio" id="anio" value="<?php echo $this->planilla[0]['anio']; ?>"/>
	<input type="hidden" name="id" id="id" value="<?php echo $this->planilla[0]['id']; ?>"/>	
	<table class="table table-hover table-condensed">
		<tbody>
			<tr>
				<td>Total Débito Fiscal</td>
				<td class="text-right">
					<input type="hidden" name="total_debitos" id="total_debitos" value="<?php echo $this->planilla[0]['total_debitos']; ?>"/>					
					<?php echo dineroFormat($this->planilla[0]['total_debitos'], 2); ?>
				</td>
				<td class="text-right">
					<input type="hidden" name="total_iva_debitos" id="total_iva_debitos" value="<?php echo $this->planilla[0]['total_iva_debitos']; ?>"/>	
					<?php echo dineroFormat($this->planilla[0]['total_iva_debitos'], 2); ?> 
				</td>
			</tr>
			<tr>
				<td>Total Crédito Fiscal</td>
				<td class="text-right">
					<input type="hidden" name="total_creditos" id="total_creditos" value="<?php echo $this->planilla[0]['total_creditos']; ?>"/>	
					<?php echo dineroFormat($this->planilla[0]['total_creditos'], 2); ?>
				</td>
				<td class="text-right">
					<input type="hidden" name="total_iva_creditos" id="total_iva_creditos" value="<?php echo $this->planilla[0]['total_iva_creditos']; ?>"/>	
					<?php echo dineroFormat($this->planilla[0]['total_iva_creditos'], 2); ?>
				</td>
			</tr>
			<tr>
				<td colspan="3" class="text-right">Excedente Mes anterior &nbsp;&nbsp;&nbsp;
				<?php echo dineroFormat($this->planilla[0]['excedente_previo']); ?> </td>
			</tr>
			<tr>
				<td colspan="3" class="text-right"><strong><?php
				$monto = $this->planilla[0]['total_pagar'];
				
				if ($this->planilla[0]['total_pagar'] < 0) {
					$this->planilla[0]['total_pagar'] = 0;
					echo "Credito Fiscal para Mes Siguiente";
				} else {
					echo $this->planilla[0]['total_pagar_mensaje'];
				}
			?>
				&nbsp;&nbsp;&nbsp;
				<input type="hidden" name="excedente" id="excedente" value="<?php echo $this->planilla[0]['excedente']; ?>"/>
				<input type="hidden" name="excedente_retenciones" id="excedente_retenciones" value="<?php echo $this->planilla[0]['excedente_retenciones']; ?>"/>
				<input type="hidden" name="total_pagar" id="total_pagar" value="<?php echo $this->planilla[0]['total_pagar']; ?>"/>
				<?php echo dineroFormat($monto, 2); ?> </strong>
				
				</td>
				
			</tr>
			<tr>
				<td colspan="3">
					<input type="text" name="planilla" id="planilla" required="required" placeholder="# de planilla" />
					<input id="fecha_entrega" name="fecha_entrega" required="required" class="datepicker" data-date-format="dd/mm/yyyy" placeholder="presentada el...">
					<input type="submit" name="submit" class="btn btn-success" value="Crear" />
				</td>
			</tr>
		</tbody>
	</table>
</form>
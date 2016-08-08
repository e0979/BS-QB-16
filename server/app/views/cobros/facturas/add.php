<div class="modal fade modalbox" id="add-factura" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header modalhead head-facturas">
				<div class="left">
					<h3>Crear Factura</h3>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
			</div>
			<div class="modal-body">
				<form id="addfactura" action="" method="get">
					
					<div class="grid_9" style="margin: 0 12%; text-align: center">
						<?php $this -> render('entidades/clientes/select'); ?>
						<div class="separador"></div>
						<div id="ficha-cliente">
							datos
						</div>						
					</div>
					<div>
					<div class="grid_3">
						<input id="fecha" name="fecha" class="datepicker left" data-date-format="dd/mm/yyyy" placeholder="Fecha" required="required">
					</div>
					<div class="grid_5">
						<select class="tipo_nota" name="tipo_nota" id="tipo_nota" required >
							<option value="factura" selected="selected">Factura</option>
							<option value="debito" >Nota de Débito</option>
							<option value="credito">Nota de Crédito</option>
						</select>
					</div>
					<div class="grid_3">
						<input id="facturas_afectadas" name="facturas_afectadas" type="text" class="left" placeholder="Facturas Afectadas" required="required" disabled="disabled">
					</div>
						
						
							
						
					</div>
					
					<div class="clear"></div>
					<div class="separador"></div>
					<div class="grid_1">&nbsp;</div>
					
					<div id="add-fcampo1" class="grid_10">
						<div class="grid_1">
							<input name="fcampo_1-cantidad" type="text" class="left" placeholder="cantidad" size="4" required="required">&nbsp;
						</div>
						<div class="grid_6">
							<textarea placeholder="liste separando por comas" name="fcampo_1-descripcion" required="required"></textarea>
						</div>
						<div class="grid_2">
							<input name="fcampo_1-precio_unitario" type="text" class="left" placeholder="P.U." size="8" required="required">&nbsp;&nbsp;
						</div>
						<div class="grid_2">
							<input name="fcampo_1-precio_total" type="text" class="left" placeholder="total" size="9" required="required">
						</div>
						<div class="clear"></div>
					</div>	
					<!--campos-->
					<?php for($i = 2; $i <=5; $i++) { ?>
						<div class="grid_1">
							<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#add-fcampo<?php echo $i; ?>">
								<i class="glyphicon glyphicon-plus-sign"></i>
							</button>
						</div>						
						<div id="add-fcampo<?php echo $i; ?>" class="collapse grid_10">
							 
							<div class="grid_1">
								<input name="fcampo_<?php echo $i; ?>-cantidad" type="text" class="left" size="4">
							</div>
							<div class="grid_6">
								<textarea name="fcampo_<?php echo $i; ?>-descripcion"></textarea>
							</div>
							<div class="grid_2">
								<input name="fcampo_<?php echo $i; ?>-precio_unitario" type="text" class="left" size="8">
							</div>
							<div class="grid_2">
								<input name="fcampo_<?php echo $i; ?>-precio_total" type="text" class="left" size="9">
							</div>
							
							<div class="separador"></div>
						
						</div>
						
						<div class="clear"></div>
					<?php } ?>
					
					
					
					<div class="modal-footer">
						<br>
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Cancelar
						</button>
						<button type="submit" name="submit"class="btn btn-success">
							Crear Factura
						</button>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</div>
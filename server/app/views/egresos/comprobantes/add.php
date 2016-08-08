<div class="modal fade modalbox" id="add-egreso-proveedor" role="dialog" aria-hidden="true" data-element ="egresos">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header modalhead head-egresos">
				<div class="left"><h3>Egreso a Proveedor</h3></div> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>

			</div>
			<div class="modal-body">
				




				<form id="addegreso-proveedor" action="" method="get">
				
					
				
					<div class="grid_9" style="margin: 0 12%; text-align: center">
						<?php $this -> render('entidades/proveedores/select'); ?>
							
						<div class="info">...ó si el Proveedor no está registrado, 
							<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#add-proveedor-ficha">
							<i class="glyphicon glyphicon-book"></i> Registrar</button> </div>
						
						<div id="add-proveedor-ficha" class="collapse">
							<?php $this -> render('entidades/proveedores/add'); ?>
						</div>
						
	                	
	                	<div class="separador"></div>
						
						
				<div class="info">¿Incluir Retencion de ISLR para el proveedor? 
						<button type="button" class="btn btn-default" data-toggle="collapse" data-target="#add-retencion-ficha">
						<i class="glyphicon glyphicon-plus-sign"></i> Crear Retención</button> 
					</div>
             		<div id="add-retencion-ficha" class="collapse">
						<?php $this -> render('impuestos/islr/crear'); ?>
						
					</div>
				<div class="clear"></div>
				
						<input class="left fullinput" type="text" name="concepto" placeholder="Concepto del Egreso" required="required" />
						
						<select class="nosearch" data-placeholder="Forma de Pago...." name="forma_pago" id="forma_pago" required>
                			<option value=""></option>
			            	<option value="Efectivo">Efectivo</option>
			              	<option value="Cheque" selected="selected">Cheque</option>
			              	<option value="Transferencia">Transferencia</option>
			            </select>
			            
							<input id="fecha" name="fecha" class="datepicker mediuminput left" data-date-format="dd/mm/yyyy" placeholder="Fecha">
							<input class="left money mediuminput" type="text" name="monto" placeholder="Monto Bs" required="required" />
							<input class="left money mediuminput" type="text" name="cheque" placeholder="N&ordm; Cheque"required="required" />
							
						
				
						<div class="clear"></div>
					</div>
					<div class="modal-footer">
						<br>
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Cancelar
						</button>
						<button type="submit" name="submit"class="btn btn-success">Agregar</button>
					</div>
				</form>










			</div>
		</div>
	</div>	
</div>
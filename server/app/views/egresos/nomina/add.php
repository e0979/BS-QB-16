<div class="modal fade modalbox" id="add-egreso-nomina" role="dialog" aria-hidden="true" data-element ="egresos">
	<div class="modal-dialog">
		<div class="modal-content">
		
			<div class="modal-header modalhead head-egresos">
				<div class="left"><h3>Egreso Nómina</h3></div> 
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>

			</div>
			<div class="modal-body">
				




				<form id="addegreso-nomina" action="" method="get">
					<div class="text-left">
						Seleccione los empleados: 
		
					<table class=" empleados-list table table-striped table-hover">
						<tbody>	
						<?php foreach ($this->empleadosList as $Empleado) { 
								if ($Empleado['status'] == 'activo') { 
							?>
							<tr>
								<td><h4><small><input name="empleados[]" class="element" type="checkbox" value="<?php echo $Empleado['cedula']; ?>" >
				             &nbsp;&nbsp;<?php echo $Empleado['nombre']." ".$Empleado['apellido']; ?></small></h4>
				             	</td>
								<td><h5><small>Días Extras: <input type="text" size="3" maxlength="2" name="empleado-dias_extras-<?php echo $Empleado['cedula']; ?>" /></small></h5></td>
								<td><h5><small>Ausencias:	<input type="text" size="3" maxlength="2" name="empleado-dias_notrabajados-<?php echo $Empleado['cedula']; ?>" /></small></h5></td>
								</tr>
							<?php }
							} ?>							
						</tbody>
					</table>
					</div>
					<div>
						<label for="from">Quincena</label> 
						<input id="fecha_desde" name="fecha_desde" class="datepicker" data-date-format="dd/mm/yyyy" placeholder="desde" required="required"> 
						<label for="to">al</label> 
						<input id="fecha_hasta" name="fecha_hasta" class="datepicker" data-date-format="dd/mm/yyyy" required="required">
						 
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
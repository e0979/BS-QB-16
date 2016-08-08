<div class="modal fade modalbox" id="add-compra" role="dialog" aria-hidden="true" data-element ="compras">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>

			</div>
			<div class="modal-body">
				




				<form id="addcompra" action="" method="get">
				
					<div class="seccion">
						<h3>Registrar Compra</h3>
					</div>
				
					<div class="grid_9" style="margin: 0 12%; text-align: center">
						<?php $this -> render('entidades/proveedores/select'); ?>
							
						<div class="info">...ó si el Proveedor no está registrado, 
							<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#add-proveedor-ficha">
							<i class="glyphicon glyphicon-book"></i> Registrar</button> </div>
						
						<div id="add-proveedor-ficha" class="collapse">
							<?php $this -> render('entidades/proveedores/add'); ?>
						</div>
						
	                	
	                	<div class="separador"></div>
						
						
				
				
				
						<input class="left mediuminput" type="text" name="factura" placeholder="# de Factura" />
						<input id="fecha" name="fecha" class="datepicker left" data-date-format="dd/mm/yyyy" placeholder="Fecha de Compra">
						
						<input class="left fullinput" type="text" name="concepto" placeholder="Concepto de la compra" required="required" />
						
							<input class="left money" type="text" name="base_imponible" placeholder="Base Imponible Bs" required="required" />
							<input class="left money" type="text" name="alicuota" value="<?php echo ALICUOTA; ?>" placeholder="IVA %"  size="6" required="required" />
							
						
						
				
             
              
              
              
				
				
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
	<?php  $this->render('default/notifications'); ?>
</div>







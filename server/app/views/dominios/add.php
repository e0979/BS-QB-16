<div class="modal fade modalbox" id="add-dominio" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<!--h4 class="modal-title" id="myModalLabel">Agregar </h4-->
			</div>
			<div class="modal-body">
				
					 <form id="add-domain" action="" method="get">

					<div class="seccion">
						<h3>Datos del Dominio</h3>
					</div>

					<div class="grid_9" style="margin: 0 12%; text-align: center">
						<input class="left fullinput" type="text" name="domain" placeholder="www.dominio.com" required="required" />

						<?php $this -> render('dominios/select-registrant'); ?>
						
						<input id="domain_creationdate" name="domain_creationdate" class="datepicker fullinput left" data-date-format="dd/mm/yyyy" placeholder="Fecha de Creacion">

						<?php $this -> render('dominios/select-hosting'); ?>
						<div id="redireccion">
							<input class="left fullinput" type="text" name="redirects_to" id="redirects_to" placeholder="www.dominio.com" required="required" />
													
						</div>
						<input id="hosting_creationdate" name="hosting_creationdate" class="datepicker fullinput left" data-date-format="dd/mm/yyyy" placeholder="Fecha de Creacion Hosting">
						<div class="spacer"></div>
						<div class="text-right">
							 Proxima renovación &nbsp; <i class="glyphicon glyphicon-calendar"></i> <input id="renewal_date" name="renewal_date" class="datepicker" data-date-format="dd/mm/yyyy" placeholder="Próxima renovación">
						</div>
						
						<?php 
						/*TODO
						redireccion
						y Otro
						 * */
						?>
						

						<div class="spacer"></div>

						el dominio está asociado a:
						<?php $this -> render("entidades/clientes/select"); ?>
						<div class="clear"></div>
					</div>
					<div class="modal-footer"><br>
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Cancelar
						</button>
						<input type="submit" name="submit" class="btn btn-success" value="Crear" />
					</div>
				</form>
			</div>
			
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
	<?php $this->render('default/notifications');?>
</div><!-- /.modal -->
		
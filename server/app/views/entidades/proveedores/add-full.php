<div class="modal fade modalbox" id="add-proveedor" role="dialog" aria-hidden="true" data-element="proveedor">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header add-header">
				<h4>Agregar Proveedor
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				</h4>
			</div>
			<div class="modal-body">

				<form action="" method="get">

					<?php $this -> render('entidades/proveedores/add'); ?>

					<div class="clear"></div>
			</div>
			<?php $this -> render('default/modal/footer'); ?>
			</form>

		</div>
	</div>
</div>
<?php  $this -> render('default/notifications'); ?>
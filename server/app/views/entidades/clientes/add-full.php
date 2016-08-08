<div class="modal fade modalbox" id="add-cliente" role="dialog" aria-hidden="true" data-element="cliente">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header add-header">
				<h4>Agregar Cliente
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				</h4>
			</div>
			<div class="modal-body">

				<form action="" method="get">

					<?php $this -> render('entidades/clientes/add'); ?>

					<div class="clear"></div>
			</div>
			<?php $this -> render('default/modal/footer'); ?>
			</form>

		</div>
	</div>
</div>
<?php  $this -> render('default/notifications'); ?>
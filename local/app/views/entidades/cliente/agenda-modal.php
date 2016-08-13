<div id="agenda-cliente" class="modal fade agenda" role="dialog" aria-hidden="true" data-element="cliente">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Clientes
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>				
			</div>
			<div class="modal-body">				
				<div class="clear"></div>
				<div class="card">
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->render('entidades/cliente/search');?>
<?php $this->render('entidades/cliente/card');?>
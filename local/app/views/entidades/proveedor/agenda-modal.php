<div id="agenda-proveedor" class="modal fade agenda" role="dialog" aria-hidden="true" data-element="proveedor">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				Proveedores
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

<?php $this->render('entidades/proveedor/search');?>
<?php $this->render('entidades/proveedor/card');?>
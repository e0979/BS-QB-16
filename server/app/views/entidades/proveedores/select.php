<select data-placeholder="Seleccione Proveedor..." class="chosen-select form" name="proveedor" id="razon_social-select">
	<option></option>
    <?php foreach($this->proveedoresList as $key => $Proveedor) { ?>
	<option value="<?php echo $Proveedor['id']; ?>"><?php echo $Proveedor['razon_social']; ?></option>
	<?php } ?>
</select>
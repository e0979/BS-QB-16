<select data-placeholder="Seleccione Cliente..." class="chosen-select form" name="cliente" id="razon_social-select">
	<option></option>
    <?php foreach($this->clientesList as $key => $Cliente) { ?>
	<option value="<?php echo $Cliente['id']; ?>"><?php echo $Cliente['razon_social']; ?></option>
	<?php } ?>
</select>
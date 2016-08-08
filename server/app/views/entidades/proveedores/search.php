<select data-placeholder="¿A quién buscas?" class="chosen-select form" name="search_id" id="search_id" multiple>
	<option></option>
    <?php foreach($this->proveedoresList as $key => $Proveedor) { ?>
	<option value="<?php echo $Proveedor['id']; ?>"><?php echo $Proveedor['razon_social']; ?> 
		<?php if (!empty($Proveedor['razon_comercial']) && $Proveedor['razon_comercial'] !== $Proveedor['razon_social']) {
			echo "(".$Proveedor['razon_comercial']. ")"; ?>
		<?php } ?>
	</option>
	<?php } ?>
</select>
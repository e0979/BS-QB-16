<select data-placeholder="¿A quién buscas?" class="chosen-select form" name="search_id" id="search_id" multiple>
	<option></option>
    <?php foreach($this->clientesList as $key => $Cliente) { ?>
	<option value="<?php echo $Cliente['id']; ?>"><?php echo $Cliente['razon_social']; ?> 
		<?php if (!empty($Cliente['razon_comercial']) && $Cliente['razon_comercial'] !== $Cliente['razon_social']) {
			echo "(".$Cliente['razon_comercial']. ")"; ?>
		<?php } ?>
	</option>
	<?php } ?>
</select>
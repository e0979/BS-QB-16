<form id="addstatus">
	<div class="grid_5">
		Estatus
		<select class="status_presupuesto" name="status_presupuesto" id="status_presupuesto" required >
			
			<option value="revision" >Revisión</option>
			<option value="revisado" >Revisado</option>
			<option value="enviado">Enviado</option>

		</select>
		<br>

		Numero de Presuepueto
		<input name="presupuesto" id="presupuesto" type="text" value="<?php echo $this->presupuesto; ?>" required>
		<br>
		<input name="id" id="id" type="hidden" value="<?php echo $this->id; ?>" required>
		<button type="submit" name="submit"class="btn btn-success">
			Agregar
		</button>
	</div>
</form>
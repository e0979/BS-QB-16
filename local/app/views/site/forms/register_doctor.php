<div id="register_doctor">
	 <form id="register_doctor_form">
	<div class="form-group">
		<label for="name" class="hidden-xs col-sm-3 control-label"><? echo NAME; ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
		</div>
	</div>
	<div class="form-group">
		<label for="id_card" class="hidden-xs col-sm-3 control-label"><? echo ID_CARD; ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="id_card" name="id_card" placeholder="id_card" required>
		</div>
	</div>
	<div class="form-group">
		<label for="birth" class="hidden-xs col-sm-3 control-label"> <? echo BIRTH; ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="birth" name="birth" placeholder="birth" required>
		</div>
	</div>
	<div class="form-group">
		<label for="sex" class="hidden-xs col-sm-3 control-label"><? echo SEX; ?></label>
		<div class="col-sm-9">
			<input type="radio" class="form-control" id="sex" name="sex" placeholder="sex"  value="F" required>Femenino
			<input type="radio" class="form-control" id="sex" name="sex" placeholder="sex"  value="M" required>Masculino
		</div>
	</div>
	<div class="form-group">
		<label for="phone" class="hidden-xs col-sm-3 control-label"><? echo PHONE; ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="phone" name="phone" placeholder="phone" required>
		</div>
	</div>
	
<div class="form-group">
		<label for="mail" class="hidden-xs col-sm-3 control-label"><? echo EMAIL; ?></label>
		<div class="col-sm-9">
			<input type="text" class="form-control" id="email" name="email" placeholder="email" required>
		</div>
	</div>
	<div class="form-group">
		<label for="mail" class="hidden-xs col-sm-3 control-label"><? echo SPECIALTY; ?></label>
		<div class="col-sm-9">
	
				<select class="form-control" id="specialty" name="specialty" placeholder="specialty" required>
					<?  foreach ($this->specialty as $specialty){ ?>
					<option value="<? echo $speciality["id"]; ?>"><? echo $specialty["name"];?></option>
				<? } ?>	
			</select>
		</div>
	</div>
	<input type="hidden"  id="role" name="role" placeholder="role" value="doctor" required>
	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Save changes</button>
      </div>
</form>
</div>
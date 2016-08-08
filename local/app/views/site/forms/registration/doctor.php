<div id="registration-doctor">		
	<form id="form-registration-doctor" action="" novalidate="novalidate" method="post">
		
		<div class="field-wrapper col-sm-12 col-lg-12">
			<label for="name" class="placeholder"><?php echo SITE__FORM_NAME; ?></label>
			<input type="text" name="name" placeholder="<?php echo SITE__FORM_NAME; ?>" required="required" class="form-control input-lg signinput">
		</div>
		<div class="field-wrapper col-sm-12 col-lg-12">
			<label for="lastname" class="placeholder"><?php echo SITE__FORM_LASTNAME; ?></label>
			<input type="text" name="lastname" placeholder="<?php echo SITE__FORM_LASTNAME; ?>" required="required" class="form-control input-lg signinput">
		</div>
		<div class="col-sm-12 col-lg-12 inner-addon left-addon field-wrapper">
			<label for="email" class="placeholder"><?php echo SITE__FORM_EMAIL; ?></label>
		    <i class="glyphicon glyphicon-envelope"></i>
		    <input type="text" name="email" placeholder="<?php echo SITE__FORM_EMAIL; ?>" required="required" class="form-control input-lg signinput">
		</div>
		<div class="col-sm-12 col-lg-12 inner-addon left-addon field-wrapper">
			<label for="birth" class="placeholder"><?php echo SITE__FORM_BIRTH; ?></label>
		    <i class="glyphicon glyphicon-calendar"></i>
			<input type="text" name="birth" placeholder="<?php echo SITE__FORM_BIRTH; ?>" data-date-format="DD/MM/YYYY" required class="signinput form-control input-lg datetimepicker left"/>
			
		</div>
		<!--extra system vars-->
		<input type="hidden"  id="role" name="role" placeholder="role" value="doctor" required>
		
		<div class="col-sm-12 col-lg-12">
			<button type="submit" class="btn-full btn btn-success btn-lg register-send">
				<?php echo SITE__SIGN_IN; ?> <i class="fa fa-check"></i>
			</button>
		</div>
		
	</form>
</div>
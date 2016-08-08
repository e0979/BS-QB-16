<div class="modal fade" id="signin" tabindex="-1" role="dialog" data-color="green">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4>&nbsp;</h4>
      </div>
      <div class="modal-body">
      	
      	<div id="response-registration" class=" text-center col-lg-12 col-md-12">      		
      	</div>
      	<div id="registration-panels" class="wraper">
      		<div id="registration-forms" class="mask">
      			<!--Choose Option-->
				<div id="register-who" class="masked-item">
					<div class="col-lg-6 col-md-6 text-center">
						<a id="register_who_doctor" href="#register-select-doctor" name="doctor" class="regist_title">
							<img src="<?php echo IMG; ?>default-male.png" class="img-responsive smaller-img">
							<h2><?php echo SITE__SIGN_IN_WHO_DOCTOR; ?></h2>
						</a>
					</div>
					<div class="col-lg-6 col-md-6 text-center">
						<a id="register_who_patient" href="#register-select-patient" name="patient" class="regist_title">
							<img src="<?php echo IMG; ?>default-male.png" class="img-responsive smaller-img">
							<h2><?php echo SITE__SIGN_IN_WHO_PATIENT; ?></h2>
						</a>
					</div>		      					      				
	      		</div>
	      		<!--Options Doctor-->
				<div id="register-select-doctor" class="masked-item">					
					<div class="col-lg-2 col-md-2">
						<div class="back-close">												
							<a href="#register-who" class="back"><i class="fa fa-chevron-left"></i> </a>	
						</div>
					</div>
					<div class="col-lg-8 col-md-8 text-center">
						<div class="logo-square">
							<img src="<?php echo IMG; ?>okidoc-logo-main-square-white.png" class="img-responsive" />							
						</div>
					</div>
					<div class="col-lg-2 col-md-2"></div>
						
					<div class="col-lg-12 col-md-12 text-center">
						<a class="btn btn-lg btn-email register_with_email"  href="#form-email-doctor">
							<i class="fa fa-envelope"></i> <?php echo SITE__SIGN_IN_WITH_EMAIL; ?>
						</a>
		      			<hr><?php echo SITE__SIGN_IN_CHOOSE; ?>	
					</div>
					<div class="col-lg-12 col-md-12 text-center">
							
						<a class="btn btn-lg  btn-facebook more-margin" id="register_with_facebook" onclick="facebookLogin('doctor')">
							<i class="fa fa-facebook"></i> <?php echo SITE__SIGN_IN_WITH_FACEBOOK; ?>
						</a>
						<button id="registerGoogleDoctor" name="doctor"  class="btn btn-lg btn-google"><i class="fa fa-google-plus"></i><?php echo SITE__SIGN_IN_WITH_GOOGLE; ?></button>
					</div>
				</div>
				<!--Options Patient-->
				<div id="register-select-patient" class="masked-item">					
					<div class="col-lg-2 col-md-2">
						<div class="back-close">												
							<a href="#register-who" class="back"><i class="fa fa-chevron-left"></i> </a>	
						</div>
					</div>
					<div class="col-lg-8 col-md-8 text-center">
						<div class="logo-square">
							<img src="<?php echo IMG; ?>okidoc-logo-main-square-white.png" class="img-responsive" />							
						</div>
					</div>
					<div class="col-lg-2 col-md-2"></div>
						
					<div class="col-lg-12 col-md-12 text-center">
						<a class="btn btn-lg btn-email register_with_email" href="#form-email-patient">
							<i class="fa fa-envelope"></i> <?php echo SITE__SIGN_IN_WITH_EMAIL; ?>
						</a>
		      			<hr><?php echo SITE__SIGN_IN_CHOOSE; ?>	
					</div>
					<div class="col-lg-12 col-md-12 text-center">
							
						<a class="btn btn-lg  btn-facebook more-margin" id="register_with_facebook" onclick="facebookLogin('patient')">
							<i class="fa fa-facebook"></i> <?php echo SITE__SIGN_IN_WITH_FACEBOOK; ?>
						</a>
						<button id="registerGooglePatient" name="patient"  class="btn btn-lg btn-google"><i class="fa fa-google-plus"></i><?php echo SITE__SIGN_IN_WITH_GOOGLE; ?></button>
					</div>
				</div>
				<!--Register with Email Patient-->
				<div id="form-email-patient" class="masked-item form-register">	
					<div class="col-lg-2 col-md-2">
						<div class="back-close">
							<a href="#register-select-patient" class="back"><i class="fa fa-chevron-left"></i></a>	
						</div>
					</div>	
					<div class="col-lg-10 col-md-10">
						<?php $this -> render('site/forms/registration/patient'); ?>
					</div>
				</div>
				<!--Register with Email Doctor-->
				<div id="form-email-doctor" class="masked-item form-register">	
					<div class="col-lg-2 col-md-2">
						<div class="back-close">
							<a href="#register-select-doctor" class="back"><i class="fa fa-chevron-left"></i></a>	
						</div>
					</div>	
					<div class="col-lg-10 col-md-10">
						<?php $this -> render('site/forms/registration/doctor'); ?>
					</div>
				</div>
				
	      		
	      		
	      		
      		</div><!--registration-forms-->
      		
      	</div><!--registration-panels"-->       	   	
	      
	      							
					
            		
			
      </div>
      
    </div>
  </div>
</div>
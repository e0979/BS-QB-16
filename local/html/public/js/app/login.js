define(['globals'], function(globals) {
	
	function signin() {
		console.log("Login");

		$('#form-login').validate({

			submitHandler : function(form) {
				$('#form-login .send').attr('disabled', 'disabled');
				//prevent double send
				$.ajax({
					type : "POST",
					url : globals.URL + "account/login",
					data : $(form).serialize(),
					timeout : 25000,
					success : function(response) {
							var response = JSON.parse(response);
							var responseDiv = "#response";
							$('.send').removeAttr("disabled");
							var mensaje = response.response;
							console.log(response);	

							switch (response.success) {						
								case 0: //TODO ERROR
									
									$(responseDiv).addClass('warning-response alert alert-danger');
									$(responseDiv).fadeIn(500);
									
									$("<div>"+mensaje+"</div>").hide().appendTo(responseDiv).fadeIn(1000).delay(3000).fadeOut(function() {
										$(responseDiv).fadeOut(500);
									});
									break;							
								case 1: //if continue	
								 	//Form is in  site/login
								 	document.location = response.redirection;								 									
									break;
							}

					},
					error : function(obj, errorText, exception) {
						console.log(errorText);

					}
				});
				return false;
			}
		});

		recover();

		$('#signin').on('hidden.bs.modal', function (e) {
			console.log('hidden');
			functions.showModal('password-recovery');
		});

	}
	function recover() {
		$('#password-recovery form').validate({
			submitHandler : function(form) {
				$('.recovery-send').attr('disabled', 'disabled');
				$('#recovery-response').html('');
				$.ajax({
					type : "POST",
					url : URL + "account/recover/",
					data : $(form).serialize(),
					timeout : 12000,
					success : function(response) {
						console.log('(' + response + ')');
						$('.recovery-send').removeAttr('disabled');
						$('#recovery-response').html(response).fadeIn('fast');
					},
					error : function(obj, errorText, exception) {
						$('.recovery-send').removeAttr('disabled');
						console.log(errorText);	
					}
				});
				return false;
			}
		});
	}


	return {
      signin: signin,
      recover: recover    
	}

});
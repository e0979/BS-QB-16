$(document).ready(function(e) {

	var $validator = $('#password-update').validate({
		rules : {
			password_old : "required",
			password : {
				minlength : 6
			},
			password_confirm : {
				minlength : 6,
				equalTo : "#password"
			},

		},

		submitHandler : function(form) {

			$('#send').attr('disabled', 'disabled');
			//prevent double send

			$.ajax({
				type : "POST",
				url : URL + "settings/update/password/",
				data : $(form).serialize(),
				timeout : 25000,
				success : function(response) {
					//console.log('('+response+')');

					switch (response) {
						case 'success':

							break;

						default:

							$('#send').removeAttr("disabled");

							break;

					}
					$('#response').html(response);
					$('#msg').bPopup({
						modal : false
					});

				},
				error : function(obj, errorText, exception) {
					console.log(errorText);

				}
			});
			return false;
		}
	});

}); 
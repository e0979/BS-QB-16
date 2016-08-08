<?php
//TODO This varss should be distribuited to different files




define('SYSTEM_EMAIL_BGCOLOR', '#34AAAD');
	define('SYSTEM_EMAIL_HEADCOLOR', '#FFF');
	define('SYSTEM_EMAIL_BUTTONSCOLOR', '#5CB85C');
	
	define('SETTINGS_EMAIL_BGCOLOR', '#9BD2D2');
	define('SETTINGS_EMAIL_HEADCOLOR', '#FFF');
	define('SETTINGS_EMAIL_BUTTONSCOLOR', '#5CB85C');
	
	define('REGISTRATION_EMAIL_BGCOLOR', '#FF0099');
	define('REGISTRATION_EMAIL_HEADCOLOR', '#FFF');
	
	define('NEWSLETTER_EMAIL_BGCOLOR', '#B4F9FF');
	define('NEWSLETTER_EMAIL_HEADCOLOR', '#FFF');	
	define ('ACTIVATION_USER_SUBJECT', 'Activación de Usuario en ' . SITE_NAME );
	
define('SYSTEM_SIMPLE_EMAIL_HEAD', '<table width="100%" height="100%" cellpadding="0" bgcolor="'.SYSTEM_EMAIL_BGCOLOR.'" style="font-size:medium;font-family:Arial,Helvetica,sans-serif;padding:0px">
		<tbody><tr align="center"><td>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="'.SYSTEM_EMAIL_HEADCOLOR.'" style="font-family:Arial,Helvetica,sans-serif;padding:10px 15px 0px 15px;margin:40px 0px 0px;border-top-left-radius:6px;border-top-right-radius:6px">
				<tbody><tr><td><span style="font-family:Raleway,Arial,Helvetica,sans-serif;color:#FFFFFF"><img src="'.URL_EMAIL.'img/logos/puntolaser100x50-color.png" alt="'.SITE_NAME.'"></font></td>
					</tr></tbody></table>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 20px">
				<tbody><tr><td width="575px"  style="padding:20px 0px;margin-top:20px"><span style="letter-spacing:-0.5px;line-height:23px;font-family:Raleway,
				Arial,Helvetica,sans-serif;font-weight:normal;font-size:15px;color:#2c2d25">');
				
	define('SYSTEM_SIMPLE_EMAIL_FOOTER', '</td></tr><tr><td style="padding-top:0px;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;">
							</td></tr></tbody></table><table width="575px" height="20px" bgcolor="#FFF" style="padding-top:20px;margin-bottom:40px;border-bottom-left-radius: 
							6px;border-bottom-right-radius: 6px;"><tbody></tr></tbody></table></td></tr></tbody></table>');
		
							
	define('SYSTEM_EMAIL__PASSWORD_CHANGE', 'Este email es para notificarte que hubo un cambio en tu contraseña.<br><br>
					Si no solicitaste este cambio, contacta al administrador de la página<br><br>
					<table cellspacing="0" cellpadding="0"> <tr> 
					<td align="center" width="130" height="40" bgcolor="'.SYSTEM_EMAIL_BUTTONSCOLOR.'" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
					<a href="'.URL .'" style="color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">Ir al Sistema</a>
					</td></tr></table>');
	
	
	
	//EMAIL USER ACTIVATION
	define('SYSTEM_EMAIL__USER_ACTIVATION_MESSAGE_PART1', '<h2>Bienvenido al sistema '. SITE_NAME.'</h2>Se ha generado un usuario para su acceso al sistema.<br>						
						Para continuar y aprobar el proceso de activación debe hacer click en el siguiente link<br><br>' );

	define('SYSTEM_EMAIL__USER_ACTIVATION_MESSAGE_PART2', '<table cellspacing="0" cellpadding="0"> <tr><td align="center" width="130" height="40" bgcolor="'.SYSTEM_EMAIL_BUTTONSCOLOR.'" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">');
	define('SYSTEM_EMAIL__USER_ACTIVATION_MESSAGE_PART3', '</td></tr></table>');
	
	
	//Sistem EMAILS
	define('SETTINGS_EMAIL_HEAD', '
	<table width="100%" height="100%" cellpadding="0" bgcolor="'.SETTINGS_EMAIL_BGCOLOR.'" style="font-size:medium;font-family:Arial,Helvetica,sans-serif;padding:0px">
	<tbody>
		<tr align="center">
			<td>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#2c9b9c" style="font-family:Arial,Helvetica,sans-serif;padding:20px 45px;margin:40px 0px 0px;border-top-left-radius:6px;border-top-right-radius:6px">
				<tbody>
					<tr>
						<td><span style="font-family:Open Sans,Arial,Helvetica,sans-serif;color:#FFFFFF"><img src="'.URL_EMAIL.'img/logos/puntolaser100x50.png" alt="Punto Láser"></font></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="'.SETTINGS_EMAIL_HEADCOLOR.'" style="font-family:Arial,Helvetica,sans-serif;padding:0px 20px">
				<tbody>
					<tr>
						<td width="575px"  style="padding:20px 0px;margin-top:20px"><span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-weight:normal;font-size:18px;color:#2c2d25">');
	define('SETTINGS_EMAIL_FOOTER', '</td></tr>
						<tr>
							<td style="padding-top:20px;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;">
							</td>
						</tr>
					</tbody>
				</table><table width="575px" height="20px" bgcolor="#FFF" style="padding-top:20px;margin-bottom:40px;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;"><tbody>
		</tr></tbody>
	</table></td>
			</tr>
		</tbody>
	</table>
	
	
');
	define('SYSTEM_EMAIL_HEAD', '<div bgcolor="#999" style="margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;min-width:100%!important;width:100%!important">
	<span style="display:none!important;font-size:0;line-height:0"></span>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eaeaea" style="border-collapse:collapse;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;width:100%!important">
		<tbody>
			<tr>
				<td style="padding-top:0;padding-bottom:25px;padding-right:0;padding-left:0"><p>&nbsp;</p>
				<table width="620" border="0" cellpadding="0" cellspacing="0" align="center" style="border-collapse:collapse;border-width:1px;border-style:solid;border-color:#eeeeee">
					<tbody>
						<tr>
							<td bgcolor="#3a3a3a" width="100%" style="padding-top:22px;padding-bottom:20px;padding-right:30px;padding-left:30px">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" style="width:100%!important;border-collapse:collapse">
								<tbody>
									<tr>
										<td width="55%" style="color:#aeaeae;font-family:Arial,sans-serif;font-size:16px;font-weight:bold;padding-top:1px;padding-bottom:0;padding-right:0;padding-left:0"><a href="http://www.puntolaser.net" style="color:#aeaeae!important;text-decoration:none" target="_blank"><img src="http://puntolaser.net/public/img/maillogo.jpg"></font></a></td>
										<td width="45%" align="right" style="text-align:right!important;font-family:Arial,sans-serif;color:#aeaeae;font-size:14px"><font face=" Arial, sans-serif;"> <font color="#FFF">Mensaje del Sistema EDIL</font></td>
									</tr>
								</tbody>
							</table></td>
						</tr>
						<tr>
							<td bgcolor="#FFF" valign="top" style="padding-top:30px;padding-bottom:35px;padding-right:30px;padding-left:30px;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#eeeeee">');
	define('SYSTEM_EMAIL_FOOTER', '</td></tr>
						<tr>
							<td bgcolor="#3a3a3a" style="padding-top:30px;padding-bottom:0;padding-right:80px;padding-left:30px">
							</td>
						</tr>
					</tbody>
				</table></td>
			</tr>
		</tbody>
	</table>
	
</div>');

	define('PASSWORD_RECOVERY_SUCCESS_RESPONSE', '<br><div class="alert alert-success">Hemos enviado un email con instrucciones para el cambio de su contraseña</div>');
	define('PASSWORD_RECOVERY_SUBJECT','Recuperación de Contraseña');
	define('PASSWORD_RECOVERY_MESSAGE_PART1', '<h2>Has solicitado recuperar tu contraseña</h2> Para generar una nueva contraseña debes hacer click en el siguiente link<br><br>' );
	define('PASSWORD_RECOVERY_MESSAGE_PART2', '<table cellspacing="0" cellpadding="0"> <tr><td align="center" width="160" height="40" bgcolor="'.SYSTEM_EMAIL_BUTTONSCOLOR.'" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">');
	define('PASSWORD_RECOVERY_MESSAGE_PART3', '</td></tr></table>' );
	
	define('REGISTRATION_MESSAGE_SUCCESS', '<div class="alert alert-success"><h3>¡Felicidades! te has registrado con éxito</h3><br> <h4>Revisa tu bandeja de correo y sigue las instrucciones que te hemos enviado para poder entrar al sistema</h4></div>');
	
	
?>
<?php
	//Sistem messages
	define ('ERROR_AUTHENTICATE_MESSAGE', 'Ha ocurrido un error. La cuenta no ha podido activarse. Por favor contacte al administrador' );
	define ('SYSTEM_EMAIL__YOUR_USER_IS_MESSAGE', 'Su usuario es: '); 
	define ('ACTIVATION_USER_SUBJECT', 'Activación de Usuario en ' . SITE_NAME );
	
		
	define ('SYSTEM_INVALID_PASSWORD','Contraseña incorrecta');
	define ('SYSTEM_PASSWORD_CHANGE','Cambio de Password realizado');
	
	
	//EMAIL Head & Footer
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
		
	
	
	//EMAIL USER ACTIVATION
	define('SYSTEM_EMAIL__USER_ACTIVATION_MESSAGE_PART1', '<h2>Bienvenido al sistema '. SITE_NAME.'</h2>Se ha generado un usuario para su acceso al sistema.<br>						
						Para continuar y aprobar el proceso de activación debe hacer click en el siguiente link<br><br>' );

	define('SYSTEM_EMAIL__USER_ACTIVATION_MESSAGE_PART2', '<table cellspacing="0" cellpadding="0"> <tr><td align="center" width="130" height="40" bgcolor="'.SYSTEM_EMAIL_BUTTONSCOLOR.'" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">');
	define('SYSTEM_EMAIL__USER_ACTIVATION_MESSAGE_PART3', '</td></tr></table>');
	
	
	
	//EMAIL PASSWORD CHANGE				
	define('SYSTEM_EMAIL__PASSWORD_CHANGE', 'Este email es para notificarte que hubo un cambio en tu contraseña.<br><br>
					Si no solicitaste este cambio, contacta al administrador de la página<br><br>
					<table cellspacing="0" cellpadding="0"> <tr> 
					<td align="center" width="130" height="40" bgcolor="'.SYSTEM_EMAIL_BUTTONSCOLOR.'" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
					<a href="'.URL .'" style="color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">Ir al Sistema</a>
					</td></tr></table>');
?>
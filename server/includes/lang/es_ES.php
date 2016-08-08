<?php
	//badges
	define('EMPRESA_RAZONSOCIAL','Besign, C.A.');
	define('EMPRESA_RIF', 'J-29397290-6');
	define('EMPRESA_TLF', '(0241) 825.10.78');
	define('EMPRESA_DIRECCION', 'Urb. La Alegría. Valencia - Edo.Carabobo');
	define('PORPAGAR', '<span class="badge badge-warning">por pagar proveedor</span>');
	
	define('ALICUOTA', '12');	define('VALOR_IVA', '1.12');
	define('ALICUOTA_RETENCIONES', '2');	define('VALOR_RETENCION', '0.02');
	define('BANCO_NOMBRE', 'Mercantil');
	define('BANCO_CUENTA', '');
	
	define('SINASOCIAR', '<span class="badge badge-warning">sin asociar</span>');
	
	define('SINDECLARAR', '<span class="badge">sin declarar</span>');
	define('SINDECLARAR_CLASS', 'alert-info');
	//Sistem messages
	define ('SYSTEM_INVALID_PASSWORD','Contraseña incorrecta');
	define ('SYSTEM_PASSWORD_CHANGE','Cambio de Contraseña realizado');
	define ('PRIVATE_USER_EXIST', '<strong class="text-warning">Usted ya posee un usuario registrado</strong> <br>Puede regenerar su contraseña<br> ó ponerse en contacto con el administrador del sistema'); 
	//define ( 'PRIVATE_REGISTRY_SUCCESS_DISTRIBUIDORES', '<h4 class="text-success">¡Bienvenido a la Zona de Distribuidores!</h4>  Sus credenciales han sido creadas. <br>Haga Click aquí para iniciar sesión');
	define ( 'SETTINGS_UPDATE_SUCCESS', '<h4 class="text-success">¡Todo Listo!</h4>   <br>Haga Click aquí para continuar');
	
	//Sistem EMAILS
	define('SETTINGS_EMAIL_HEAD', '
	<table width="100%" height="100%" cellpadding="0" background="http://quinbi.besign.com.ve/public/img/bg4.jpg" style="font-size:medium;font-family:Arial,Helvetica,sans-serif;padding:0px">
	<tbody>
		<tr align="center">
			<td>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#2a3d4e" style="font-family:Arial,Helvetica,sans-serif;padding:20px 45px;margin:40px 0px 0px;border-top-left-radius:6px;border-top-right-radius:6px">
				<tbody>
					<tr>
						<td><span style="font-family:Open Sans,Arial,Helvetica,sans-serif;color:rgb(255,255,255)">Mensaje del sistema</font></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 20px">
				<tbody>
					<tr>
						<td width="575px"  style="padding:20px 0px;margin-top:20px"><span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-weight:bold;font-size:18px;color:rgb(42,61,78)">');
	define('SETTINGS_EMAIL_FOOTER', '</td></tr>
						<tr>
							<td style="padding-top:20px;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;">
							</td>
						</tr>
					</tbody>
				</table><table width="575px" height="20px" bgcolor="#FFF" style="padding-top:20px;margin-bottom:40px;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;"><tbody>
		</tr></tbody>
	</table>></td>
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
										<td width="55%" style="color:#aeaeae;font-family:Arial,sans-serif;font-size:16px;font-weight:bold;padding-top:1px;padding-bottom:0;padding-right:0;padding-left:0"><a href="http://www.edil.com" style="color:#aeaeae!important;text-decoration:none" target="_blank"><img src="http://ah000384.ferozo.com/private/img/logoEdil-tiny.png"></font></a></td>
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
	define ('USER_INACTIVE_MESSAGE', 'Estuvo inactivo por más de 5 min.\nPor favor, inicie sesión de nuevo');

?>
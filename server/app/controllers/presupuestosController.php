<?php

	class PresupuestosController extends Controller {
		
		public function __construct() {
			
			parent::__construct();
			Auth::handleLogin();	
			
		}
		
		function index() {
										
			$this->all();
		}
		
		function delegate() {
				
			$this->view->userdata = $this->user->getUserdata();
			
			$this->view->titulo = SITE_NAME. ' | Delegar Presupuestos ';
						
			//Models
			$this->view->condicionesList = $this->model->listCondiciones();
			
			$this->loadModel('proyectos');						
			$this->view->proyectosList = proyectosModel::$this->model->TipoProyectos();
			$this->view->partesPagoList = proyectosModel::$this->model->PlanesPago();
			$this->view->tiemposEntregaList = proyectosModel::$this->model->TiemposEntrega();
	
			$this->loadModel('entidades');
			$this->view->clientesList = entidadesModel::$this->model->listClients();
			
			//Page
			$this->view->buildpage('presupuestos/delegate');
			
				
			
		}
		
		function load($value) {
			// Carga tipo de trabajo con un llamado del Select
			$this->view->render('presupuestos/tipo_trabajo/'.$value);
		
		}
		
					
		function petition() {
			
			$userdata = $this->user->getUserdata();
							
			$fields = '';
			$values = '';
			$descripcion ='';
			
			// 1. Process $_POST to $variables	
			foreach ($_POST as $key => $value) {
								
				if($value === '') { //empty fields
									
				} else {
								
					$campo = escape_value($key);
					$valor = escape_value($value);
					
					switch ($key) {
						
						case 'condiciones':
						
							@$tipo_trabajo = escape_value($_POST['tipo_trabajo']);
							$pieces = explode("*", $value);
							
							$condiciones_group = '<strong>Condiciones: </strong>';
							
							foreach ( $pieces as $piece ) {
								//TODO pasar esto al Model o Helper...
								$findmatch = $this->model->findMatch($piece);
								//DB::query("SELECT * FROM ". DB_PREFIX ."presupuesto_condiciones where nota =%s LIMIT 1", $piece);
								
								if (empty($findmatch)) { // Si la 'condicion' no existe, agregar 
								
									$query_tipo_trabajo = $this->helper->tellmebyName('tipo_trabajo', $tipo_trabajo);							
										
									//TODO pasar esto al Model o Helper...
									$insert = DB::insert( DB_PREFIX ."presupuesto_condiciones", array(
									  'id' => '',
									  'tipo_trabajo' => $query_tipo_trabajo[0]['id'],
									  'nota' => $piece
									));
									
								}
								$condiciones_group.= "<br>- ".$piece;
							}// end foreach
						
						
							break;
						
						case 'qty-secciones':
							$descripcion .= "".$valor . " seccion(es)<br>"; 							
							break;
						case 'secciones':
							$descripcion .= $valor . "<br>"; 							
							break;
						case 'qty-secciones_complejas':
							$descripcion .= $valor . " seccion(es) compleja(s)<br>"; 							
							break;
						case 'secciones_complejas':
							$descripcion .= $valor . "<br>"; 							
							break;

						
						
						case 'cliente':	// si es un cliente existente, buscarlo por nombre					
						
							// 2. Ask to a Model for Client Name Value with id
							$cliente = $this->helper->tellmebyID('cliente', $value);
							$razon_social = $cliente[0]['razon_social'];
							$razon_comercial = '('.$cliente[0]['razon_comercial'].')';	
							
							$rif = '';
							$direccion = '';
							if (empty ($_POST['email-extra'])) {							
								$email = '<br>'.$cliente[0]['email'].' ';							
							} else {
								$email = '<br>'.escape_value($_POST['email-extra']).' ';	
							}
							$telefono = $cliente[0]['telefono'];
								
							break;
						
						case 'submit':
							break;
						
						default:
						
							// turn to $variables
							$data = "\$" . $campo . "='" . $valor . "<br>';"; 
							eval($data);						
							
						
					}
							
				}	
			}
			
			
			$recibe = 'administracion@besign.com.ve';
			$cc 	= 'emarquez@besign.com.ve';
			$asunto = 'Solicitud de Presupuesto';
	
			$body = '<table width="100%" height="100%" cellpadding="0" background="http://quinbi.besign.com.ve/public/img/bg4.jpg" style="font-size:medium;font-family:Arial,Helvetica,sans-serif;padding:0px">
	<tbody>
		<tr align="center">
			<td>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#2a3d4e" style="font-family:Arial,Helvetica,sans-serif;padding:20px 45px;margin:20px 0px 0px;border-top-left-radius:6px;border-top-right-radius:6px">
				<tbody>
					<tr>
						<td><span style="font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:12px;color:rgb(255,255,255)"><strong>'.shortName($userdata[0]['name']).'</strong> ha solicitado la elaboración de un presupuesto con la siguiente información:</span><font face="Open Sans, Arial, sans-serif;"></font></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 20px">
				<tbody>
					<tr>
						<td width="75px"  style="padding:20px 5px 0px 0px;vertical-align:top"><img src="http://quinbi.besign.com.ve/public/img/mailbi/cliente.jpg" width="60px" height="60px" alt="WWW" border="0"></td><td width="475px"  style="padding:20px 0px;margin-top:20px"><span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-weight:bold;font-size:18px;color:rgb(42,61,78)">Datos del Cliente:</span>
						<br>
						<span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-weight:bold;font-size:16px;color:rgb(42,61,78);margin:0px;padding:0px">Cliente:</span>&nbsp;<span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:12px;color:rgb(42,61,78);margin:0px 0px 0px 5px;padding:0px">
						'.$razon_social.'
						'.$razon_comercial.'
						'.$rif.'
						'.$direccion.'
						'.$email.'
						'.$telefono.'
						 </span></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="5px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 0px 20px">
				<tbody>
					<tr>
						<td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(234,234,234)"></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 5px 0px 20px">
				<tbody>
					<tr>
						<td width="75px"  style="padding:20px 5px 0px 0px;vertical-align:top"><img src="http://quinbi.besign.com.ve/public/img/mailbi/tipo_trabajo.jpg" width="60px" height="60px" alt="WWW" border="0"></td>
						<td width="475px"  style="padding:20px 0px;margin-top:20px"><span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-weight:bold;font-size:18px;color:rgb(42,61,78)">Tipo de Proyecto:</span>
						<br>
						<span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:13px;color:rgb(42,61,78);margin:0px 0px 0px 5px;padding:0px">'.$tipo_trabajo.'<br>						
						'.$descripcion.'
						</span>
						<font face="Open Sans, Arial, sans-serif;"></font></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="5px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 0px 5px">
				<tbody>
					<tr>
						<td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(234,234,234)"></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 5px 0px 20px">
				<tbody>
					<tr>
						<td width="75px"  style="padding:20px 5px 0px 0px;vertical-align:top"><img src="http://quinbi.besign.com.ve/public/img/mailbi/tiempo_entrega.jpg" width="60px" height="60px" alt="WWW" border="0"></td>
						<td width="475px"  style="padding:20px 0px;margin-top:20px"><span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-weight:bold;font-size:18px;color:rgb(42,61,78)">Ejecución y Consideración:</span>
						<br>
						<span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:12px;color:rgb(42,61,78);margin:0px 0px 0px 5px;padding:0px"><strong>Tiempo de Entrega:</strong>'.$tiempo_entrega.'						<strong>Prioridad:</strong> '.$prioridad.'
						<strong>Plan de Pago:</strong> '.$plan_pago.'
						</span>
						<font face="Open Sans, Arial, sans-serif;"></font></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="5px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 0px 5px">
				<tbody>
					<tr>
						<td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(234,234,234)"></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 5px 0px 20px">
				<tbody>
					<tr>
						<td width="75px"  style="padding:20px 5px 0px 0px;vertical-align:top"><img src="http://quinbi.besign.com.ve/public/img/mailbi/peticion.jpg" width="60px" height="60px" alt="WWW" border="0"></td><td width="475px"  style="padding:20px 0px;margin-top:20px"><span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-weight:bold;font-size:18px;color:rgb(42,61,78)">Comentarios Adicionales:</span>
						<br>
						
						<span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:12px;color:rgb(42,61,78);margin:0px 0px 0px 5px;padding:0px"><strong>Peticiones :</strong> '.$peticiones.'
						<strong>Referencias :</strong> '.$referencias.'
						</span>
						
						<font face="Open Sans, Arial, sans-serif;"></font></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="5px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 0px 5px">
				<tbody>
					<tr>
						<td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(234,234,234)"></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="40px" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" style="font-family:Arial,Helvetica,sans-serif;padding:0px 5px 0px 20px">
				<tbody>
					<tr>
						<td width="75px"  style="padding:20px 5px 0px 0px;vertical-align:top"><img src="http://quinbi.besign.com.ve/public/img/mailbi/condiciones.jpg" width="60px" height="60px" alt="WWW" border="0"></td>
						<td width="475px"  style="padding:20px 0px;margin-top:20px"><span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-weight:bold;font-size:18px;color:rgb(42,61,78)">Condiciones:</span>
						<br>
						<span style="letter-spacing:-0.5px;line-height:23px;font-family:Open Sans,Arial,Helvetica,sans-serif;font-size:12px;color:rgb(42,61,78);margin:0px 0px 0px 5px;padding:0px">'.$condiciones_group.'</span>
						
						<font face="Open Sans, Arial, sans-serif;"></font></td>
					</tr>
				</tbody>
			</table>
			<table width="575px" height="0px" cellpadding="0" cellspacing="0" bgcolor="#2a3d4e" style="font-family:Arial,Helvetica,sans-serif;padding:12px 0px 20px;margin-bottom: 40px;border-bottom-left-radius:6px;border-bottom-right-radius:6px">
				<tbody>
					<tr>
						<td width="475px" height="10px" style="padding:6px 0px 0px 65px" align="right">
						<table cellspacing="0" cellpadding="0"> <tbody><tr> 
<td align="center" width="170" height="40" bgcolor="#5cb85c" style="border-radius:5px;color:#ffffff;display:block; margin-right:20px">
<a href="http://quinbi.besign.com.ve" style="color:#ffffff;font-size:16px;font-weight:bold;font-family:Helvetica,Arial,sans-serif;text-decoration:none;line-height:40px;width:100%;display:inline-block" target="_blank">Crear Presupuesto</a>
</td> 
</tr> </tbody></table>
						</td>
					</tr>
				</tbody>
			</table></td>
		</tr>
	</tbody>
</table>';
			
			$this->email->sendMailwithCC($recibe, SYSTEM_EMAIL, $asunto, $body, $cc);
			
			return true;
			
		}
		
		function petition_old() {
			//Model
			$this->model->sendPetition();
			
			
//			$this->view->proyectosList = proyectosModel::$this->model->TipoProyectos();
			//$this->model->entidades->clientesList = entidadesModel::$this->model->listClients();
		}
		
		function all() {
			
			$this->view->userdata = $this->user->getUserdata();
		
			$this->view->titulo = SITE_NAME. ' | Lista de Presupuestos ';
						
			//Models
			$this->view->presupuestos = $this->model->getAllPresupuestos();
			$this->listClientes_Array();
			//$this->view->condicionesList = $this->model->listCondiciones();
		
			//Page
			$this->view->buildpage('presupuestos/list');
		}
		
		function listClientes_Array () {
			
			//Clientes
			$this->loadModel('entidades');
			$clientes = entidadesModel::$this->model->listClients();
			foreach ($clientes as $arrayClientes) {
								
				$new_id   = $arrayClientes['id'];
						
				$this->view->cliente[$new_id] = $arrayClientes['razon_social'];
								
			}
			/*//Proveedores
			$proveedores = entidadesModel::$this->model->listProveedores();
			foreach ($proveedores as $arrayProveedores) {
								
				$new2_id   = $arrayProveedores['id'];
					
				$this->view->proveedor[$new2_id] = $arrayProveedores['razon_social'];
				
				$this->view->proveedor_details[$new2_id] = entidadesModel::$this->model->getProveedorId($new2_id);
						
								
			}*/
		}
		
		function clients() {
			
			$this->loadModel('entidades');
			$groups = entidadesModel::$this->model->listClientes_json();
			
			echo json_encode($groups); 	
		}
			
	}

?>
<?php

	class PresupuestosController extends Controller {
		
		public function __construct() {
			
			parent::__construct();
			Auth::handleLogin();	
			
		}
		
		function index() {
								
			$this->all();
		}
		
		function editinline () {
			print_r($_POST);
			$pk = escape_value($_POST['pk']);
			$value = escape_value($_POST['value']);
			
			$parts = explode( '-', $pk );
			$tablename = $parts[0];
			$fieldname = $parts[1];
			$id = $parts[2];
			
			$arrayModificacion = array();
									
			$arrayModificacion[$fieldname] = $value;
			
			$insert = $this->helper->update($tablename, $id, $arrayModificacion);
			
			print_r($insert);
			
			
		}
		
		function delegate() {
					
			$this->view->userdata = $this->user->getUserdata();
			
			$this->view->titulo = SITE_NAME. ' | Delegar Presupuestos ';
						
			//Models
			//$this->loadModel('presupuestos');		
			$this->view->condicionesList = $this->model->listCondiciones();
			$this->listNotificaciones();	
			
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
		
		function update_status(){
			//actualiza estado de presupuesto y crea las notificaciones
			$status=$_POST["status_presupuesto"];
			$presupuesto=$_POST["presupuesto"];
			$id=$_POST["id"];
			$array_update["status"]=$status;
			$info=$this->model->InfoStatus($id);
			//var_dump($info);
		if ($status=='revision'){
			$array_update["parent_id"]=$presupuesto;
			$this->helper->update('presupuesto_status',$id, $array_update);
			$array_notificacion["text"]='Pendiente Revision de  Presupuesto <a href=""> '.$presupuesto.'</a>';
			$array_notificacion["created"]=date('Y-m-d');
			$array_notificacion["rif"]=$info[0]["aprueba"];
			$this->helper->insert('notifications', $array_notificacion);
			$mail=$this->model->getMail($info[0]["aprueba"]);
			$this->email->sendMailwithCC($mail, SYSTEM_EMAIL, "Actualizacion Estatus", $array_notificacion["text"]);
		}
		if ($status=='revisado'){
			
			$this->helper->update('presupuesto_status',$id, $array_update);
			$array_notificacion["text"]='Pendiente Envio de  Presupuesto <a href="">'.$presupuesto.'</a>';
			$array_notificacion["created"]=date('Y-m-d');
			$array_notificacion["rif"]=$info[0]["recibe"];
			$mail=$this->model->getMail($info[0]["recibe"]);
			$this->helper->insert('notifications', $array_notificacion);
			$this->email->sendMailwithCC($mail, SYSTEM_EMAIL, "Actualizacion Estatus", $array_notificacion["text"]);
		}
		if ($status=='enviado'){
			 $user = DB::queryOneColumn('envia', "SELECT * FROM presupuesto_status where id=%i",$id);
			echo $user[0];
			$this->helper->update('presupuesto_status',$id, $array_update);
			echo $mail=$this->model->getMail($user);
			$this->email->sendMailwithCC($mail, SYSTEM_EMAIL, "Actualizacion Estatus", "La Solicitud de  presupuesto $presupuesto fue enviada" );
			
		}
		
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
							$array_presupuesto["tipo_trabajo"]=$tipo_trabajo;
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
								$array_presupuesto["condiciones_group"]=$condiciones_group;
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
							$array_presupuesto["razon_social"]=$razon_social;
							$razon_comercial = '('.$cliente[0]['razon_comercial'].')';	
							$array_presupuesto["razon_comercial"]=$razon_comercial;
							$rif = '';
							$direccion = '';
							if (empty ($_POST['email-extra'])) {							
								$email = '<br>'.$cliente[0]['email'].' ';							
							} else {
								$email = '<br>'.escape_value($_POST['email-extra']).' ';	
							}
							$telefono = $cliente[0]['telefono'];
							$array_presupuesto["email"]=$email;
							$array_presupuesto["telefono"]=$telefono;		
							break;
						
						case 'submit':
							break;
						
						default:
						
							// turn to $variables
							$data = "\$" . $campo . "='" . $valor . "<br>';"; 
							eval($data);						
							
						
					}
					$array_presupuesto["descripcion"]=$descripcion;
							
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
			
			//$this->email->sendMailwithCC($recibe, SYSTEM_EMAIL, $asunto, $body, $cc);
			
			//$this->email->sendMailwithCC('cferrer@besign.com.ve', SYSTEM_EMAIL, $asunto, $body);
			$envia = $userdata[0]["rif"];
			$recibe = '18360415';
			$aprueba = '15869947';
			//$recibe = '15860984';
			//$aprueba = '15860984';
			
			$array_insert["data"]=json_encode($array_presupuesto);
			$array_insert["status"]="pendiente";
			$array_insert["client_id"]=$cliente[0]['id'];
			$array_insert["temp_name"]=$razon_social;			
			$userdata = $this->user->getUserdata();
			
			$array_insert["envia"]= $envia;
			$array_insert["recibe"]=$recibe;
			$array_insert["aprueba"]=$aprueba;
			$this->helper->insert('presupuesto_status', $array_insert);
			
			$array_notificacion["text"]= $razon_social." ha solicitado un presupuesto (".date('d/m/Y').")";
			$array_notificacion["created"]=date('Y-m-d h:i');
			$array_notificacion["rif"]= $recibe;
			$array_notificacion["goto"]= 'presupuestos/all#add-presupuesto';
			$this->helper->insert('notifications', $array_notificacion);
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
			$this->listNotificaciones();
			//Page
			$this->view->buildpage('presupuestos/list');
		}
		
		
		function add() {
			
		}
		
		
		function status() {
			
			$this->view->userdata = $this->user->getUserdata();
	
			$this->view->titulo = SITE_NAME. ' | Lista de Presupuestos ';
						
			//Models
			$this->view->presupuestos = $this->model->getPresupuestosStatus();
			$this->listNotificaciones();	
			//Page
			$this->view->buildpage('presupuestos/list_status');
		}
		
		function get () {
			$tablename = 'presupuesto_status';
			$fields = array('id','client_id','temp_name','status','parent_id','id');
			$where = "";
			$data = $this->helper->getJSONtables($tablename, $fields,'presupuestos');
					//echo $data;
		}
		
		function getall () {
			$tablename = 'presupuesto';
			$fields = array('id','razon_social','fecha','tipo','titulo','tiempo','id');
			$where = "";
			$data = $this->helper->getJSONtables_advanced($tablename, $fields,'','presupuestos');
					//echo $data;
		}
		
		function edit($what,$id) {
			$userdata = $this->user->getUserdata();
			
			switch($what){
				case 'presupuesto':
					$this->view->id=$id;
					$datos=$this->model->InfoStatus($id);
					$this->view->presupuesto=$datos[0]["parent_id"];
					$this->view->render('presupuestos/detail');
					break;
					
				
			}
		}
		
		function presupuesto_detalle ($what,$band,$id) {
			$this->view->id=$id;
			$this->view->presupuesto=$this->model->getPresupuesto($id);
			for ($i =1;$i<=10;$i++){
				$this->view->campo[$i]=$this->model->getPresupuestoCampo($id,$i);
			}
			$this->view->plan_pago=$this->model->getPresupuestoPlanPago($this->view->presupuesto[0]["pago"]);
			$this->view->tipo_entrega=$this->model->getPresupuestoTipoEntrega($this->view->presupuesto[0]["tiempo"]);
			$this->view->render("presupuestos/presupuesto_detail");
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
		function planes_pago() {
			
			//$this->loadModel('entidades');
			$groups = entidadesModel::$this->model->listClientes_json();
		
			echo json_encode($groups); 	
		}
		
			
		function listNotificaciones () {
			$userdata = $this->user->getUserdata();
			$rif=$userdata[0]['rif'];
			$this->loadModel('home');
			$notificaciones = homeModel::$this->model->listNotificaciones($rif);
			$this->view->notificaciones = $notificaciones;			
		}
	}


?>
<?php
	
	class EgresosController extends Controller {
			
		public function __construct() {
				
			parent::__construct();
			Auth::handleLogin();			
			
		}
		
		function index() {
						
			$this->view->titulo = 'Egresos';
			$this->view->userdata = $this->user->getUserdata();
							
			$this->load('comprobantes');
			
		}
		
		function comprobantes ($action = 'all', $second_action = '', $id = '') {

			$this->view->userdata = $this->user->getUserdata();
			
			$this->view->titulo = 'Egresos ';
			
			switch ($action) {
				case 'all':
					$this->load('comprobantes');
					break;
				
				case 'load':
					$this->load($second_action, $id); //comprobante, id
					break;
				
				case 'edit':
					$this->view->editing = TRUE;					
					$this->load($second_action, $id);
					break;

				/*case 'reload':
					$this->load('all', 'data');
					break;*/
			}
		}
		
		function nominas ($action = 'all', $second_action = '', $id = '') {
			
			$this->view->userdata = $this->user->getUserdata();			
			$this->view->titulo = 'Nomina';
			switch ($action) {
				case 'all':
					$this->load('nominas');
					break;
				
				case 'load':
					$this->load($second_action, $id); //comprobante, id
					break;
				
				case 'edit':
					$this->view->editing = TRUE;					
					$this->load($second_action, $id);
					break;
			}
			
		}
		function nominarecibo ($action = 'all', $second_action = '', $id = '') {
		//	$this->view->userdata = $this->user->getUserdata();			
		//	$this->view->titulo = 'Nomina';
			switch ($action) {
				//case 'all':
				//	$this->load('nominas');
				//	break;
				
				case 'load':
					$this->load($second_action, $id); //comprobante, id
					break;
				
				case 'edit':
					$this->view->editing = TRUE;					
					$this->load($second_action, $id);
					break;
			}
		}
		
		function load($what, $id ='') {
			
			switch ($what) {
				
				case 'nominas':
					//se carga a través de Javascript get()
					$this->listEmpleados_Array();
			
					$this->view->buildpage('egresos/nomina/list');
					
					break;
				
				case 'nomina':
					
					$this->view->nomina = $this->model->nominabyId($id);
					
					$database = 'egresos_nomina';
					$this->view->nextp	 	= $this->model->nextElement($id,$database);
					$this->view->prevp		= $this->model->prevElement($id,$database);
					$this->view->whatnext	= 'nominas';
					$this->view->curent		= $this->view->nomina[0]['id'];
					
					//Check for Recibos associated
					$this->view->recibos_emitidios = $this->model->getnominaRecibosby('parent_id', $id);
					
					$this->listEmpleados_Array();
					//$this->listClientes_Proveedores_Array(); //Clientes
					$this->view->render('egresos/nomina/detail');
					
					break;
				case 'nominarecibo':
					
					$this->view->recibo = $this->model->getnominaRecibosby('id',$id);
					
					$database = 'egresos_nomina_recibos';
					$this->view->nextp	 	= $this->model->nextElement($id,$database);
					$this->view->prevp		= $this->model->prevElement($id,$database);
					$this->view->whatnext	= 'nominarecibo';
					$this->view->curent		= $this->view->recibo[0]['id'];
					
									
					$this->listEmpleados_Array();
					$this->view->render('egresos/nomina/recibo-detail');
					//Copia
					$this->view->render('egresos/nomina/recibo-detail-copia');
					
					break;
				
				case 'comprobantes':
					
					$this->view->comprobantes = $this->model->listComprobantesEgreso();
					$this->listClientes_Proveedores_Array();
					$this->listEmpleados_Array('nomodel');
					
					if ($id !== 'data') {
			
						$this->view->buildpage('egresos/comprobantes/list');
						
						
					} else {
						$this->view->render('egresos/comprobantes/comprobantes');
											
					}
										
					break;
				
				case 'comprobante': 
					
					$this->view->comprobante = $this->model->getComprobanteby($id);
					
					$database = 'egresos_comprobantes';
					$this->view->nextp	 	= $this->model->nextElement($id,$database);
					$this->view->prevp		= $this->model->prevElement($id,$database);
					$this->view->whatnext	= 'comprobantes';
					$this->view->curent		= $this->view->comprobante[0]['id'];
					
					//Check for Retencion associated
					$this->view->has_retencion = $this->model->getRetencionby('parent_id', $id);
					
					
					$this->listClientes_Proveedores_Array(); //Clientes
					$this->view->render('egresos/comprobantes/detail');
					
					break;
				
				default:
					
					break;
			}
			
		}
		
		function add($what, $kind) {
			
			$userdata = $this->user->getUserdata();
			
			$fields = '';
			$values = '';
			//Iniciar Array for insert
			$array_datos = array();
			
			switch ($what) {
					
				case 'egreso':
					
					switch ($kind) {
							
						case 'nominas':
							print_r($_POST);
							break;
						case 'nomina':
							
							//1 Crear nomina
							$nomina_id = $this->model->listNominas();
							if (empty($nomina_id)) {
								$nomina_id[0]['id'] = 0;
							}
							$nomina_id = $nomina_id[0]['id'] + 1;
							
							$fecha_desde = escape_value($_POST['fecha_desde']);
							$fecha_hasta = escape_value($_POST['fecha_hasta']);
							
														//Dias Trabajados						
							$ini_date = explode( '/', $fecha_desde );
							$ini_date = strtotime($ini_date[2]."-".$ini_date[1]."-".$ini_date[0]);
							$end_date = explode( '/', $fecha_hasta );
							$end_date = strtotime($end_date[2]."-".$end_date[1]."-".$end_date[0]);							
						    $datediff = $end_date - $ini_date;
						    $dias_trabajados = floor($datediff/(60*60*24))+1;
							
							if($dias_trabajados < 15 && $end_date[1] == '02') {
								$dias_trabajados = 15;
							} 
							if($dias_trabajados == 16) {
								$dias_trabajados = 15;
							}
							
							//Crear Nomina
							$arrayNomina = array();
							$arrayNomina['id'] = $nomina_id;
							$arrayNomina['numero'] = $nomina_id;
							$arrayNomina['fecha_desde'] = $fecha_desde;
							$arrayNomina['fecha_hasta'] = $fecha_hasta;
							$arrayNomina['elaborador'] 	= $userdata[0]['rif'];
							
							//Crear Nomina Recibo por empleado
							$arrayNominaRecibo = array();							
							
							$this->listEmpleados_Array();
														
							foreach ($_POST['empleados'] as $key_e => $value_e) {
								if($value_e !== '') {
									$cedula = escape_value($value_e);
									$arrayNominaRecibo[$cedula]['id'] 	= '';
									$arrayNominaRecibo[$cedula]['parent_id'] 	= $nomina_id;
									$arrayNominaRecibo[$cedula]['empleado_id'] 	= $cedula;
									$arrayNominaRecibo[$cedula]['fecha'] 		= date('d/m/Y');
									$arrayNominaRecibo[$cedula]['fecha_desde'] 	= $fecha_desde;
									$arrayNominaRecibo[$cedula]['fecha_hasta'] 	= $fecha_hasta;
									$arrayNominaRecibo[$cedula]['salario_base'] = $this->view->empleado_details[$cedula][0]['sueldo'];
									$arrayNominaRecibo[$cedula]['dias_trabajados'] = $dias_trabajados;
									
									
									
									
									foreach ($_POST as $key => $value) {
										
										if($value !== '') {
											if ($key === 'empleados') {
												//skip
											} else {
												$valor = escape_value($value);									
												$parts = explode( '-', $key );
												
												$tablename = $parts[0];
												
												if ($parts[0] === 'empleado') {
														
													$campo = $parts[1];	
													$index = $parts[2];									
													$arrayNominaRecibo[$index][$campo] = $valor;
													
												}
											}	
											
										}
									}
									//ver dias y calculos por empleado
									$salario_base = $this->view->empleado_details[$cedula][0]['sueldo'];
									//$salario_diario = ($salario_base * 12) / 365;
									$salario_diario = $salario_base / 30;
									$arrayNominaRecibo[$cedula]['salario_diastrabajados'] = $arrayNominaRecibo[$cedula]['dias_trabajados'] * $salario_diario;
									@$arrayNominaRecibo[$cedula]['total_asignaciones'] = ($arrayNominaRecibo[$cedula]['dias_extras'] * $salario_diario)+ $arrayNominaRecibo[$cedula]['salario_diastrabajados'];
									@$arrayNominaRecibo[$cedula]['total_deducciones']  = ($arrayNominaRecibo[$cedula]['dias_notrabajados'] * $salario_diario);
									$arrayNominaRecibo[$cedula]['total_pagado'] 	  = $arrayNominaRecibo[$cedula]['total_asignaciones'] - $arrayNominaRecibo[$cedula]['total_deducciones'];
									
									$insert_recibos = $this->helper->insert('egresos_nomina_recibos', $arrayNominaRecibo[$cedula]);
								}								
								//crear registros								
							}
							$insert = $this->helper->insert('egresos_nomina', $arrayNomina);
							//print_r($arrayNominaRecibo);
							
							echo $nomina_id;
							break;
							
						case 'proveedor':
							
							$comprobante_id = $this->model->listComprobantesEgreso();
							$array_datos['id'] = $comprobante_id[0]['id']+1;
							$array_datos['numero'] = $array_datos['id'];
							$array_datos['tipo_egreso'] = 'pagos';
							$array_datos['banco'] = BANCO_NOMBRE;
							$array_datos['banco'] = BANCO_CUENTA;
							$array_datos['elaborador'] = $userdata[0]['name'];
							
							foreach ($_POST as $key => $value) {
										
								if($value === '') { //empty fields
												
								} else {
								
									$campo = escape_value($key);
									$valor = escape_value($value);
									
									switch ($campo) {
										case 'submit': //omitir campo
											break;																		
										case 'rif':									
											break;
										case 'direccion':									
											break;
										case 'telefono':									
											break;
										case 'razon_comercial':									
											break;
										case 'rubro':									
											break;
										
										case 'proveedor':
											
											if (!empty($value)) {
												$array_datos['proveedor_id'] = $value;												
												$proveedor = $this->helper->tellmebyID('proveedor', $value);
												$array_datos['beneficiario'] = $proveedor[0]['razon_social'];
												$array_datos['rif'] = $proveedor[0]['rif'];	
												
											}
											break;							
											
											
										case 'razon_social':	// si es un cliente existente, buscarlo por nombre					
								
											// 2. Ask to a Model for Client Name Value with id
											$proveedor = $this->helper->tellmebyID('proveedor', $value);
											
											if (empty($proveedor)) {
													
												//Register Proveedor
												$proveedor = $this->helper->tellmeLast('proveedor');
												$proveedor_id = $proveedor[0]['id']+1;
												
												$array_proveedor = array();
												$array_proveedor['id'] = $proveedor_id;
												$array_proveedor['razon_social'] = escape_value($_POST['razon_social']);
												$array_proveedor['razon_comercial'] = escape_value($_POST['razon_comercial']);	
												$array_proveedor['rubro'] = escape_value($_POST['rubro']);										
												$array_proveedor['rif'] = escape_value(strtoupper($_POST['rif']));
												$array_proveedor['direccion'] = escape_value($_POST['direccion']);
												$array_proveedor['telefono'] = escape_value($_POST['telefono']);
												$array_proveedor['fecha_relacion'] = escape_value($_POST['date']);
												$array_proveedor['status'] = 'activo';
												
												
												$insert = $this->helper->insert('proveedor', $array_proveedor);
																						
												$array_datos['proveedor_id'] = $proveedor_id;
												$proveedor = $this->helper->tellmebyID('proveedor', $proveedor_id);
												$array_datos['beneficiario'] = $proveedor[0]['razon_social'];
												$array_datos['rif'] = $proveedor[0]['rif'];
												
													
											} else {
												
												$proveedor = $proveedor[0]['razon_social'];	
												$array_datos['proveedor_id'] = $proveedor;
												$array_datos['proveedor_id'] = $proveedor[0]['rif'];
											}
											break;
											
										/*case 'date':
										
											$date = explode('/',$valor);
											$array_datos['dia']  = $date[0];
											$array_datos['mes']  = $date[1];
											$array_datos['anio'] = $date[2];
											
											break;*/
										
										case 'factura':											
											$array_retencion['factura'] = $value;	
											break;
											
										case 'total_factura':											
											$total_factura = $value;	
											break;
											
										default:
											//push to array  for insert
											$array_datos[$campo] = $valor;
											break;
											// turn to $variables
											$data = "\$" . $campo . "='" . $valor . "<br>';"; 
											eval($data);	
									}
								}
							}
						
//							print_r($array_datos);
							
							$insert = $this->helper->insert('egresos_comprobantes', $array_datos);
							//Si hay Retención, registrar
							if (!empty($total_factura)) {
								
								//$array_retencion['dia'] = 				$array_datos['dia'];
								//$array_retencion['mes'] = 				$array_datos['mes'];
								//$array_retencion['anio'] = 				$array_datos['anio'];
								$array_retencion['proveedor_id'] = 		$array_datos['proveedor_id'];								
								$array_retencion['monto_pagado'] = 		$total_factura;								
								$array_retencion['impuesto_retenido'] = $total_factura - $array_datos['monto'];
								$array_retencion['monto_retencion'] = 	$total_factura / VALOR_IVA;
								
								$array_retencion['porcentaje'] = 		ALICUOTA_RETENCIONES;
								$array_retencion['fecha_pago'] = 		$array_datos['fecha'];//$array_datos['dia']."/".$array_datos['mes']."/".$array_datos['anio'];
								$array_retencion['parent_id'] = 		$array_datos['id'];	
								
								//print_r($array_retencion);
								$insert = $this->helper->insert('egresos_retenciones', $array_retencion);
								
							}
							//return inserted ID for printing
							echo $array_datos['id'];								
							
							break;
						
					}
					
			}				
					
		}

		function create ($what, $from, $id) {
			//FROM
			switch ($from) {
				case 'nominarecibo':
					$tablename = 'egreso_recibo_nomina';
					break;				
			}
			//WHAT
			switch ($what) {
				case 'comprobante':
					$this->model->getbyID($tablename, $id);
					break;
			}
			
		}
		
		
		function editinline () {
			
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
		
		//Opciones declarada y aprobada
		function formapago_options() {
			$groups = array(
						array('value' => 'Transferencia', 'text' => 'Transferencia'),
						array('value' => 'Cheque', 'text' => 'Cheque'),
						array('value' => 'Efectivo', 'text' => 'Efectivo')
					);				
		
			echo json_encode($groups); 
			
		}
		
		function providers() {
			
			$this->loadModel('entidades');
			$groups = entidadesModel::$this->model->listProveedores_json();
			
			echo json_encode($groups); 	
		}
		function providers_texttext() {
			
			$this->loadModel('entidades');
			$groups = entidadesModel::$this->model->listProveedores_json('text');
			
			echo json_encode($groups); 
		}

		function clients() {
			
			$this->loadModel('entidades');
			$groups = entidadesModel::$this->model->listClientes_json();
			
			echo json_encode($groups); 	
		}
		
		
		
		function get($what) { //Get Tables list Data
			
			switch ($what) {
				case 'comprobantes':
					$tablename = 'egresos_comprobantes';
					$fields = array( 'numero', 'fecha', 'beneficiario', 'monto', 'elaborador','id');
					$element = 'comprobantes'; //for action buttons
					break;
				
				case 'nominas':
					$tablename = 'egresos_nomina';
					$fields = array( 'id', 'fecha_desde', 'fecha_hasta','elaborador', 'id');
					$element = 'nominas'; //for action button
					
					break;
			}
						
			$data = $this->helper->getJSONtables($tablename, $fields, $element);
				
			echo $data;
		}
		
		
		
		
		/*TODO corregir este DRY*/
		
		function listClientes_Proveedores_Array () {
			
			//Clientes
			$this->loadModel('entidades');
			$clientes = entidadesModel::$this->model->listClients();
			$this->view->clientesList = $clientes;
			
			foreach ($clientes as $arrayClientes) {
								
				$new_id   = $arrayClientes['id'];
						
				$this->view->cliente[$new_id] = $arrayClientes['razon_social'];
				$this->view->cliente_details[$new_id] = entidadesModel::$this->model->getClienteId($new_id);
			}
			//Proveedores
			$proveedores = entidadesModel::$this->model->listProveedores();
			$this->view->proveedoresList = $proveedores;
			foreach ($proveedores as $arrayProveedores) {
								
				$new2_id   = $arrayProveedores['id'];
					
				$this->view->proveedor[$new2_id] = $arrayProveedores['razon_social'];
				
				$this->view->proveedor_details[$new2_id] = entidadesModel::$this->model->getProveedorId($new2_id);
						
								
			}
		}

		function listEmpleados_Array ($loadmodel='') {
			
			if($loadmodel === '') {
				$this->loadModel('entidades');
			}
						
			$empleados = entidadesModel::$this->model->listEmpleados();
			$this->view->empleadosList = $empleados;
			
			foreach ($empleados as $arrayEmpleados) {
								
				$new_id   = $arrayEmpleados['cedula'];
						
				$this->view->empleado[$new_id] = entidadesModel::$this->model->getEmpleadobyId($new_id);//$arrayEmpleados['nombre'] . " ". $arrayEmpleados['apellido'];
				$this->view->empleado_details[$new_id] = entidadesModel::$this->model->getEmpleadoProfile($new_id);
			}
			
		}
		
		function check($what, $value = '') {
			switch ($what) {
				case 'nomina':
					if ($value == '') {
						$value = escape_value($_POST['fecha_desde']);
					}
					
					$response = $this->model->nominabyDate($value);
					break;	
			}
			
			if (!empty($response)) {				
				echo 'false';
			} else {
				echo 'true';
			}
						
		}
		
		
	}

?>
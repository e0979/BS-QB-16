<?php
	
	class ImpuestosController extends Controller {
			
		public function __construct() {
				
			parent::__construct();
			Auth::handleLogin();			
			
		}
		
		function index() {
						
			$this->view->titulo = 'Impuestos';				
			//Page
			$this->iva();
			
		}
		
		function iva ($action = 'all', $second_action = '', $id = '') {

			$this->view->userdata = $this->user->getUserdata();
			
			$this->view->titulo = 'Impuestos ';
			
			switch ($action) {
				case 'all':
					$this->load('all');
					break;
				
				case 'load':
					$this->load($second_action, $id); //planilla, id
					break;
				
				case 'edit':
					$this->view->editing = TRUE;					
					$this->load($second_action, $id);
					break;

				case 'reload':
					$this->load('all', 'data');
					break;
			}			
			
			
		}
		
		function compras ($action = 'all', $second_action = '', $id = '') {
				
			$this->view->userdata = $this->user->getUserdata();
			
			$this->view->titulo = 'Compras';
			
			switch ($action) {
				
				case 'load':
					$this->load($second_action, $id); //planilla, id
					break;
					
				case 'reload':
					$this->load('compras', 'data');
					break;
					
				case 'edit':
					//$this->view->editing = TRUE;					
					$this->load($second_action, $id);
					break;
					
				default :
					$this->load('compras');
					break;
			}
			
		}
		
		function retenciones ($action = 'all', $second_action = '', $id ='') {

			$this->view->userdata = $this->user->getUserdata();
			$this->view->titulo = 'Retenciones de Clientes';
			
			switch ($action) {
				case 'load':
					$this->load($second_action, $id); 
					break;
					
				case 'reload':
					$this->load('retenciones', 'data');
					break;
					
				case 'edit':			
					$this->load($second_action, $id);	
					break;
					
				default :
					$this->load('retenciones');
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
		
		
		function add($what) {
			
			$fields = '';
			$values = '';
			//Iniciar Array for insert
			$array_datos = array();
			
			switch ($what) {
					
				case 'retenciones':
					
					break;
					
				case 'iva':
				
					//$array_datos['id'] = '';
					$array_datos['fecha_creacion'] = date('d/m/Y');
					$array_datos['elaborador'] = $_SESSION['username'];
					//print_r($_POST);
					foreach ($_POST as $key => $value) {
										
						if($value === '') { //empty fields
											
						} else {
										
							$campo = escape_value($key);
							$valor = escape_value($value);
		
							switch ($campo) {
												
								case 'submit': //omitir campo
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
					
					print_r($array_datos);
					//Crear Planilla
					$insert = $this->helper->insert('iva_declaracion', $array_datos);
					
					//Declarar y Asociar Retenciones & Compras
					$retenciones = $this->model->getRetencionesporDeclarar($array_datos['mes'], $array_datos['anio']);
					$compras = $this->model->getComprasporDeclarar($array_datos['mes'], $array_datos['anio']);
					
					$arrayModificacion = array();
					$arrayModificacion['declarada'] = 'si';
					$arrayModificacion['planilla_asociada'] = $array_datos['id'];
					
					foreach ($retenciones as $retencion) {
						$id = $retencion['id'];
						$update = $this->helper->update('retenciones', $id, $arrayModificacion);
					}
					foreach ($compras as $compra) {
						$id = $compra['id']; 
						if ($compra['aprobada'] !== 'no') {
							$update = $this->helper->update('compras', $id, $arrayModificacion);
						}						
					}
					
					
					
					//Asociar compras y declararlas
						//Asociar Retenciones				
					
					break;
					
				case 'compras':
					
					$array_datos['id'] = '';
					$array_datos['comprador'] = '';
					
					print_r($_POST);
					// 1. Process $_POST to $variables	
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
										
											
									} else {
										
										$proveedor = $proveedor[0]['razon_social'];	
										$array_datos['proveedor_id'] = $proveedor;
									}
									break;
									
								
									
								case 'fecha':

									$date = explode('/',$valor);
									$array_datos['dia']  = $date[0];
									$array_datos['mes']  = $date[1];
									$array_datos['anio'] = $date[2];
									$array_datos['fecha'] = $valor;
									
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
					//Calculo del IVA
					$array_datos['impuesto'] = ($array_datos['alicuota'] / 100) * $array_datos['base_imponible'] ;
					
					print_r($array_datos);
										
					$insert = $this->helper->insert('compras', $array_datos);

			}
					
				
					
					
					
		}


		
		function load ($what, $id ='') {
			switch ($what) {
				
				case 'retenciones':
					
					$this->view->retenciones = $this->model->getRetenciones();				
					$this->listClientes_Proveedores_Array();			//Proveedores	
					if ($id !== 'data') {
						$this->view->buildpage('impuestos/retenciones/list');
						
					} else {
						$this->view->render('impuestos/retenciones/retenciones');
											
					}	
					break;
					
				case 'compras':
					
					$this->view->compras = $this->model->getCompras();				
					$this->listClientes_Proveedores_Array();			//Proveedores		
					if ($id !== 'data') {
						$this->view->buildpage('impuestos/compras/list');
						
					} else {
						$this->view->render('impuestos/compras/compras');
											
					}					
					break;
				
				case 'all':
					
					$this->view->planillas = $this->model->listPlanillasIVA();
					$this->listClientes_Proveedores_Array();				//Proveedores
					
					if ($id !== 'data') {
						$this->view->buildpage('impuestos/list');
						
					} else {
						$this->view->render('impuestos/iva/planillas');
											
					}
										
					break;
				
				
					
				case 'current':
					// Figure next
					$planillas = $this->model->listPlanillasIVA();
					
					$anio = $planillas[0]['anio'];
					$mes = $planillas[0]['mes']+1;
					$nuevo_id = $planillas[0]['id']+1;
					//excedente fiscal del mes anterior:
					$excedente_anterior = $planillas[0]['excedente'];
					$excedente_anterior_retenciones = $planillas[0]['excedente_retenciones'];
					
					if ($mes === 13) {
						$mes = 1;
						$anio = $anio+1;	
					}
					
					
					//Retenciones
					$this->view->retenciones = $this->model->getRetencionesporDeclarar($mes, $anio);
					
					//Libro de Compras
					$this->view->compras = $this->model->getComprasporDeclarar($mes, $anio);
					
					//Libro de Ventas
					$this->loadModel('facturas');
					$this->view->facturas = facturasModel::$this->model->getFacturasbyDate($mes, $anio);
					$this->view->notas_debito = facturasModel::$this->model->getNotasDebito($mes, $anio);
					$this->view->notas_credito = facturasModel::$this->model->getNotasCredito($mes, $anio);
					
					$Facturas_basei 	= 0;					$Facturas_impuesto  = 0;
					$NDebito_basei		= 0;					$NDebito_impuesto	= 0;
					$NCredito_basei		= 0;					$NCredito_impuesto	= 0;
					$Compra_basei		= 0;					$Compra_impuesto	= 0;
					$excedente 			= 0;					$Retencion_impuesto = 0;
			
					//DEBITOS
					foreach ($this->view->notas_debito as $notadebito) {
							
						if ($notadebito['anulada'] !== 'si') {							
							$NDebito_basei 	= $NDebito_basei+$notadebito['subtotal'];
							$NDebito_impuesto 	= $NDebito_impuesto+$notadebito['impuesto'];
						}
					}
					
					foreach ($this->view->facturas as $factura) {
					
						if ($factura['anulada'] !== 'si') {
							$Facturas_basei 	= $Facturas_basei+$factura['subtotal'];
							$Facturas_impuesto 	= $Facturas_impuesto+$factura['impuesto'];
						}						
					}
					//CREDITOS
					foreach ($this->view->notas_credito as $notacredito) {
							
						if ($notacredito['anulada'] !== 'si') {							
							$NCredito_basei 	= $NCredito_basei+$notacredito['subtotal'];
							$NCredito_impuesto 	= $NCredito_impuesto+$notacredito['impuesto'];
						}
					}
					
					foreach ($this->view->compras as $compra) {
					
						if ($compra['aprobada'] !== 'no') {
							$Compra_basei 	 = $Compra_basei+$compra['base_imponible'];
							$Compra_impuesto = $Compra_impuesto+$compra['impuesto'];
						}						
					}
					
					foreach ($this->view->retenciones as $retencion) {
					
						$Retencion_impuesto = $Retencion_impuesto+$retencion['iva_retenido'];
												
					}
					
					//Totales
					$total_debitos 		= $Facturas_basei + $NDebito_basei;
					$total_iva_debitos	= $Facturas_impuesto + $NDebito_impuesto;
					
					$total_creditos		= $Compra_basei + $NCredito_basei;
					$total_iva_creditos	= $Compra_impuesto + $NCredito_impuesto + $Retencion_impuesto;
					
					$total_pagar 		= 	$total_iva_debitos - $total_iva_creditos;
					
					//$calculo_excedente
					$excedente_mes_anterior = $excedente_anterior + $excedente_anterior_retenciones;
					$total_pagar 		= 	$total_pagar - $excedente_mes_anterior;
					
					if ($total_pagar < 0) {
						//Excedente
						$excedente = $total_pagar;
						
					}
					//Planilla
					$this->view->planilla = array ( 
												array(  'id' => $nuevo_id,
														'planilla' => '',
														'mes' => $mes,
														'anio' => $anio,
														'fecha_creacion' => '',
														'fecha_entrega' => '',
														'total_debitos' => $total_debitos,
														'total_iva_debitos' => $total_iva_debitos,
														'total_creditos' => $total_creditos,
														'total_iva_creditos' => $total_iva_creditos,
														'total_retenciones' => $Retencion_impuesto,
														'por_descontar' => '0',
														'total_pagar' => $total_pagar,
														'excedente' => $excedente,
														'excedente_retenciones' => '0',
														'elaborador' => $_SESSION['username'],
														//Adicionales para reporte
														'facturas_bi'		=> $Facturas_basei,
														'facturas_impuesto' => $Facturas_impuesto,	
														'ndebitos_bi'		=> $NDebito_basei,
														'ndebitos_impuesto' => $NDebito_impuesto,	
														'ncredito_bi'		=> $NCredito_basei,
														'ncredito_impuesto' => $NCredito_impuesto,
														'compras_bi'		=> $Compra_basei,
														'compras_impuesto'  => $Compra_impuesto,
														'excedente_previo' 	=> $excedente_mes_anterior,
														'total_pagar_mensaje' 	=> 'Total a Pagar',
											));
					
					$this->listClientes_Proveedores_Array();
					//Page
					if ($id === 'resumen') {
						$this->view->render('impuestos/iva/resumen');	
					} else {
						$this->view->render('impuestos/iva/planilla-actual');
					}
					
					break;

					
				case 'retencion':
					$this->view->retencion = $this->model->getRetencionby($id);
					$database = 'retenciones';
					$this->view->nextp	 	= $this->model->nextElement($id,$database);
					$this->view->prevp		= $this->model->prevElement($id,$database);
					$this->view->whatnext	= 'retenciones';
					$this->view->curent		= $this->view->retencion[0]['id'];
					
					$declaraciones = $this->model->listPlanillas_json();	
					$id_planilla_asociada = $this->view->retencion[0]['planilla_asociada'];
					$search = $this->model->getPlanillaIVA($id_planilla_asociada);
					@$this->view->retencion[0]['planilla_asociada'] = $search[0]['mes']."/".$search[0]['anio']." (".$search[0]['planilla'].")";	
					
					$this->listClientes_Proveedores_Array(); //Clientes
					$this->view->render('impuestos/retenciones/retencion-detail');
					break;
					
				case 'compra':
					
					$this->view->compra = $this->model->getCompraby($id);
					$database = 'compras';
					$this->view->nextp	 	= $this->model->nextElement($id,$database);
					$this->view->prevp		= $this->model->prevElement($id,$database);
					$this->view->whatnext	= 'compras';
					$this->view->curent		= $this->view->compra[0]['id'];
					
					$declaraciones = $this->model->listPlanillas_json();	
					$id_planilla_asociada = $this->view->compra[0]['planilla_asociada'];
					$search = $this->model->getPlanillaIVA($id_planilla_asociada);
					@$this->view->compra[0]['planilla_asociada'] = $search[0]['mes']."/".$search[0]['anio']." (".$search[0]['planilla'].")";	
									
					$this->listClientes_Proveedores_Array(); //Proveedor
					
					
//					
					$this->view->render('impuestos/compras/compra-detail');
					
					break;
					
				case 'planilla':
					
					$this->view->planilla 	= $this->model->getPlanillaIVA($id);
					$database = 'iva_declaracion';
					$this->view->nextp	 	= $this->model->nextElement($id, $database);
					$this->view->prevp		= $this->model->prevElement($id, $database);
					$this->view->whatnext	= 'iva';
					$this->view->curent		= $this->view->planilla[0]['id'];
					
					$fecha_declaracion = $this->view->planilla[0]['fecha_entrega']; 
					$id_declaracion = $this->view->planilla[0]['id']; 
					$mes = $this->view->planilla[0]['mes']; 
					$anio = $this->view->planilla[0]['anio'];
					
					//INFO Planilla Previa
					$mes_planillaprevia = $mes - 1;
					$anio_planillaprevia = $anio;
					if ($mes_planillaprevia === 0) {
						$mes_planillaprevia = 1;
						$anio_planillaprevia = $anio_planillaprevia-1;	
					}					
					$planilla_previa =  $this->model->getPlanillaIVAbyDate($mes_planillaprevia,$anio_planillaprevia);
					$excedente_mes_anterior 		= $planilla_previa[0]['excedente'];	
					$excedente_anterior_retenciones = $planilla_previa[0]['excedente_retenciones'];
					$excedente_previo = $excedente_mes_anterior + $excedente_anterior_retenciones;
					
					// end INFO Planilla Previa
					
					//Retenciones
					$this->view->retenciones = $this->model->getRetencionesRelated($id_declaracion);
					
					//Libro de Compras
					$this->view->compras = $this->model->getComprasRelated($id_declaracion);
					
					
					//Libro de Ventas
					$this->loadModel('facturas');
					$this->view->facturas = facturasModel::$this->model->getFacturasbyDate($mes, $anio);
					$this->view->notas_debito = facturasModel::$this->model->getNotasDebito($mes, $anio);
					$this->view->notas_credito = facturasModel::$this->model->getNotasCredito($mes, $anio);
					
					
					
					
					//SUMAS
					$Facturas_basei 	= 0;					$Facturas_impuesto  = 0;
					$NDebito_basei		= 0;					$NDebito_impuesto	= 0;
					$NCredito_basei		= 0;					$NCredito_impuesto	= 0;
					$Compra_basei		= 0;					$Compra_impuesto	= 0;
					$Retencion_impuesto = 0;
			
				//DEBITOS
					foreach ($this->view->notas_debito as $notadebito) {
							
						if ($notadebito['anulada'] !== 'si') {							
							$NDebito_basei 	= $NDebito_basei+$notadebito['subtotal'];
							$NDebito_impuesto 	= $NDebito_impuesto+$notadebito['impuesto'];
						}
						
					}
					
					foreach ($this->view->facturas as $factura) {
					
						if ($factura['anulada'] !== 'si') {
							$Facturas_basei 	= $Facturas_basei+$factura['subtotal'];
							$Facturas_impuesto 	= $Facturas_impuesto+$factura['impuesto'];
						}						
					}
					//CREDITOS
					foreach ($this->view->notas_credito as $notacredito) {
							
						if ($notacredito['anulada'] !== 'si') {							
							$NCredito_basei 	= $NCredito_basei+$notacredito['subtotal'];
							$NCredito_impuesto 	= $NCredito_impuesto+$notacredito['impuesto'];
						}
					}
					
					foreach ($this->view->compras as $compra) {
					
						if ($compra['aprobada'] !== 'no') {
							$Compra_basei 	 = $Compra_basei+$compra['base_imponible'];
							$Compra_impuesto = $Compra_impuesto+$compra['impuesto'];
						}						
					}
					
					
					//Totales
					$total_debitos 		= $Facturas_basei + $NDebito_basei;
					$total_iva_debitos	= $Facturas_impuesto + $NDebito_impuesto;
					
					$total_creditos		= $Compra_basei + $NCredito_basei;
					$total_iva_creditos	= $Compra_impuesto + $NCredito_impuesto;
					
				//CALCULR DE MES ANTERIOR	$excedente_previo	= $this->view->planilla[0]['excedente'] + $this->view->planilla[0]['excedente_retenciones'];  
					
					$this->view->planilla[0]['facturas_bi'] = $Facturas_basei;
					$this->view->planilla[0]['facturas_impuesto'] = $Facturas_impuesto;
					$this->view->planilla[0]['ndebitos_bi'] = $NDebito_basei;
					$this->view->planilla[0]['ndebitos_impuesto'] = $NDebito_impuesto;
					$this->view->planilla[0]['ncreditos_bi'] = $NCredito_basei;
					$this->view->planilla[0]['ncreditos_impuesto'] = $NCredito_impuesto;
					$this->view->planilla[0]['compras_bi'] = $Compra_basei;
					$this->view->planilla[0]['compras_impuesto'] = $Compra_impuesto;
					$this->view->planilla[0]['excedente_previo'] = $excedente_previo;
					$this->view->planilla[0]['total_pagar_mensaje'] = 'Total Pagado';
					
					
					//Clientes
					$this->listClientes_Proveedores_Array();
					
					//Page
					$this->view->render('impuestos/iva/planilla');
					break;
					
			
			}
			
		}
		
		
		
		
		
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
		
		
		/*function fusion () {
			$comprobantes = $this->model->getCompras();
			
			$tablename = 'compras';
			
			foreach ($comprobantes as $Comprobante) {
					
				$arrayModificacion = array();
				
				$id = $Comprobante['id']; 				
			//	$arrayModificacion['fecha'] = zerofill($Comprobante['dia'],2)	."/". zerofill($Comprobante['mes'],2)	."/".$Comprobante['anio'];
				$fecha  = $Comprobante['fecha'];
				$parts = explode( '/', $fecha );
				$arrayModificacion['dia'] = $parts[0];
				$arrayModificacion['mes'] = $parts[1];
				$arrayModificacion['anio'] = $parts[2];
				$insert = $this->helper->update($tablename, $id, $arrayModificacion);
						
			}
			
		}*/
 		function aprobe($id, $answer) { //Aprobar compras para la lista del IVA
 			
 			switch ($answer) {
				case 'glyphicon-ok':
				 	$value = 'si';
				 			break;
				 
				case 'glyphicon-remove':
					 $value = 'no';
				break;
			}
			
			$arrayModificacion = array();
			$arrayModificacion['aprobada'] = $value;
			$insert = $this->helper->update('compras', $id, $arrayModificacion);
			
 		}
		
 		function check($what) {
 				
 			switch ($what) {
				
				case 'compras':						
					$value = escape_value($_POST['factura']);
					$response = $this->model->getCompraby($value, 'factura');					
					break;					
			}
			
			if (!empty($response)) {				
			    echo 'false';
			}
			else {
			    echo 'true';
			}
						
		}
		
		//Opciones declarada y aprobada
		function element_options() {

			$groups = array(
						array('value' => 'si', 'text' => 'si'),
						array('value' => 'no', 'text' => 'no')
					);					
		
			echo json_encode($groups); 
			
		}
		function providers() {
			
			$this->loadModel('entidades');
			$groups = entidadesModel::$this->model->listProveedores_json();
			
			echo json_encode($groups); 	
		}
		function clients() {
			
			$this->loadModel('entidades');
			$groups = entidadesModel::$this->model->listClientes_json();
			
			echo json_encode($groups); 	
		}
		
		function list_planillas() {
			
			$groups = $this->model->listPlanillas_json();
			
			echo json_encode($groups);
			
		}

	}
?>
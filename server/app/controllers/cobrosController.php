<?php
	
	class CobrosController extends Controller {
			
		public function __construct() {
				
			parent::__construct();
			Auth::handleLogin();			
			
		}
		
		function index() {
			
			$this->facturas();	
		}
		
		function facturas($action = 'all', $second_action = '', $id = '') {
		
			$this->view->titulo = 'Facturas';
			$this->view->userdata = $this->user->getUserdata();
			
			switch ($action) {
				case 'all':
					$this->load('facturas');
					break;
				
				case 'load':
					$this->load($second_action, $id);
					break;
				
				case 'edit':
					$this->view->editing = TRUE;					
					$this->load($second_action, $id);
					break;
				//redirecciones
				case 'tiponota_options':
					$this->tiponota_options();
					break;
				case 'editinline':
					$this->editinline();
					break;
				case 'clients':
					$this->clients();
					break;
			}
		}
		
		function load($what, $id ='') {
			
			switch ($what) {
				
				case 'facturas':
					//se carga a través de Javascript get()
					$this->listClientes_Proveedores_Array(); //Clientes
					
					$this->view->buildpage('cobros/facturas/list');
					
					break;
				case 'factura':
					//se carga a través de Javascript get()
					$this->view->factura = $this->model->facturabyId($id);
					$this->view->factura_fields = $this->model->camposFactura($id);
					
					
					$database = 'factura';
					$this->view->nextp	 	= $this->model->nextElement($id,$database);
					$this->view->prevp		= $this->model->prevElement($id,$database);
					$this->view->whatnext	= 'facturas';
					$this->view->curent		= $this->view->factura[0]['id'];
					
					//Check for Recibos associated
					//$this->view->recibos_emitidios = $this->model->getnominaRecibosby('parent_id', $id);
					
					
					$this->listClientes_Proveedores_Array(); //Clientes
					$this->view->render('cobros/facturas/detail');
					
					break;
						
			}
		}
		
		
		function add($what) {
			
			$userdata = $this->user->getUserdata();
			
			$fields = '';
			$values = '';
			//Iniciar Array for insert
			$array_datos = array();
			
			switch ($what) {
					
				case 'factura':
					$facturas = $this->model->listFacturas();
					$id = $facturas[0]['id']+1;
					$precio_total = '';
					$iva = ALICUOTA;
					foreach ($_POST as $key => $value) {
							
						if($value === '') { // skip empty fields
												
						} else {
							
							$campo = escape_value($key);
							$valor = escape_value($value);
							$parts = explode( '-', escape_value($key) ); 
							
							if (!empty($parts[1])) {
								//All fcampo fields
								$tablename = $parts[0];
								$fieldname = $parts[1];
								
								$by = 'parent_id';
								
								$array_campos[$tablename]['parent_id'] = $id;
								
								
								switch ($fieldname) {
									case 'precio_total':
										$array_campos[$tablename][$fieldname] = $valor;
										$precio_total += $valor;
										break;
									default:
										$array_campos[$tablename][$fieldname] = $valor;
										break;
								}
								
								//$insert = $this->helper->update($tablename, $id, $arrayModificacion, $by);
							} else {
								
								//Campos para factura
								switch ($campo) {
									case 'submit':
										break;
									case 'cliente':
										$array_factura['id_cliente'] = $valor;
										$cliente = $this->helper->tellmebyID('cliente', $value);
										$array_factura['direccion'] = $cliente[0]['direccion_fiscal'];
										$array_factura['tlf'] = $cliente[0]['telefono'];										
										break;
									
									case 'fecha':

										$date = explode('/',$valor);
										$array_factura['dia']  = $date[0];
										$array_factura['mes']  = $date[1];
										$array_factura['anio'] = $date[2];
										$array_factura['fecha'] = $valor;
										break;
										
									default:
										$array_factura[$campo] = $valor;
										break;									
								}
							
							}
							
							$array_factura['id'] = $id;
							$array_factura['subtotal'] = $precio_total;
							$array_factura['iva'] = $iva;
							$array_factura['impuesto'] = ($precio_total * $iva) / 100;
						}
					}
					//Crear Factura ppal
					$insert = $this->helper->insert('factura', $array_factura);
					//Crear campos
					foreach($array_campos as $key => $value) {
						
						$insert = $this->helper->insert($key, $array_campos[$key]);
					}
					echo $id;
					
					break;					
				
			}
		}
		
		function get($what) { //Get Tables list Data
			
			switch ($what) {
				
				case 'facturas':
					$tablename = 'factura';
					$fields = array( 'id','id_cliente', 'fecha', 'subtotal', 'impuesto', 'pagada','anulada', 'id');
					$element = 'facturas'; //for action buttons
					break;				
			}
						
			$data = $this->helper->getJSONtables($tablename, $fields, $element);
				
			echo $data;
		}
		
		/*function fusion () {
			$comprobantes = $this->model->listFacturas();
			
			$tablename = 'factura';
			
			foreach ($comprobantes as $Comprobante) {
					
				$arrayModificacion = array();
				
				$id = $Comprobante['id']; 				
				$arrayModificacion['fecha'] = zerofill($Comprobante['dia'],2)	."/". zerofill($Comprobante['mes'],2)	."/".$Comprobante['anio'];
				
				$insert = $this->helper->update($tablename, $id, $arrayModificacion);
						
			}
			
		}*/
		
		function editinline () {
			
			$pk = escape_value($_POST['pk']);
			$value = escape_value($_POST['value']);
			
			$parts = explode( '-', $pk );
			$tablename = $parts[0];
			$fieldname = $parts[1];
			$id = $parts[2];
			//if not by ID, something else
			@$by = $parts[3];			
			
			$arrayModificacion = array();
									
			$arrayModificacion[$fieldname] = $value;
			
			if (!empty($by)) {
				$insert = $this->helper->update($tablename, $id, $arrayModificacion, $by);
			} else {
				$insert = $this->helper->update($tablename, $id, $arrayModificacion);			
			}			
			print_r($insert);
			
			
		}
		
		//Opciones declarada y aprobada
		function tiponota_options() {
			$groups = array(
						array('value' => 'factura', 'text' => 'FACTURA'),
						array('value' => 'debito', 'text' => 'NOTA DE DEBITO'),
						array('value' => 'credito', 'text' => 'NOTA DE CREDITO')
					);				
		
			echo json_encode($groups); 
			
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
		
		function clients() {
			
			$this->loadModel('entidades');
			$groups = entidadesModel::$this->model->listClientes_json();
			
			echo json_encode($groups); 	
		}
		
	
	}

?>
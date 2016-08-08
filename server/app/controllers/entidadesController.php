<?php

	class EntidadesController extends Controller {
		
		public function __construct() {
			
			parent::__construct();
			Auth::handleLogin();	
		
		}
		
		function listarClientes() {
						
			$this->view->clientesList = $this->model->listClients();
					
		}
		
		function agenda($what, $id ='') {
			switch ($what) {
				case 'cliente':
					$this->view->info = $this->model->getClienteId($id);
					$this->view->render('entidades/clientes/ficha');
					
					break;
				
				case 'proveedor':
					$this->view->info = $this->model->getProveedorId($id);
					$this->view->render('entidades/proveedores/ficha');
					
					break;
			}
			if ($id === '') {
				
			}
		}
		
		function check($what, $value = '') {
				
			if ($value == '') {
				$value = escape_value($_POST['rif']);
			}
			
			$response = $this->model->tellmebyRIF($what, $value);
			if (!empty($response)) {				
			    echo 'false';
			}
			else {
			    echo 'true';
			}
						
		}
		
		function add($what){
			
			if($what == 'proveedor' || $what == 'cliente') {
				
				$array_datos = array();
				$array_datos['id'] = '';	
			
			foreach ($_POST as $key => $value) {
										
				if($value === '') { //empty fields
											
				} else {
										
					$campo = escape_value($key);
					$valor = escape_value($value);
		
					switch ($campo) {
												
						case 'submit': //omitir campo
							break;
						case 'rif': //omitir campo
							$array_datos['rif'] = escape_value(strtoupper($_POST['rif']));
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
				$array_datos['fecha_relacion'] = date('d/m/Y');
				$array_datos['status'] = 'activo';
				
				
				$insert = $this->helper->insert($what, $array_datos);
				print_r($array_datos);
				
			}
			
		}
		
			
	}

?>
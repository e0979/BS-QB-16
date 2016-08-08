<?php

	class DominiosController extends Controller {
			
		public function __construct() {
				
			parent::__construct();
			Auth::handleLogin();			
			
		}
		
		function index() {
						
			$this->view->titulo = 'Dominios ';
				
			//Page
			$this->view->buildpage('dominios/index');
			
		}
		
		private function userinfo () {
			$user = $this->user->get('username');
			$role = $this->user->get('role');
			$rif = $this->user->get('rif');
			$this->view->userdata = $this->user->getUserdata($role, $rif);
		}
		
		function all () {
			
			$this->userinfo();
			
			$this->view->titulo = 'Dominios ';

			//Page
			$this->load('expiring', 'data');
			$this->load('all', 'data');
			
			$this->view->buildpage('dominios/list');
			
			
		}
		function reload () {
		
		 	$this->load('expiring');
			$this->load('all');
		}
		

		function load ($what, $id ='') {
			switch ($what) {
				case 'details':
					
					$this->view->id_domain = $id;
					
					$field_groups =  $this->model->getYearGroups($id);
						
					//Crear Grupos de campos en un array por año
					$i = 0;
					foreach ($field_groups as $anio) {
								
							$fields = $this->model->getDomainFields($id, $anio['year']);
		
							$this->view->fields_group[$id][$i]['year'] = $anio['year'];
		
							foreach ($fields as $campos) {
									
								$campo = $campos['field'];
								$valor = $campos['value'];
									
								$this->view->fields_group[$id][$i][$campo] = $valor;
									
									
							}
								
						$i++;
					}
					
					//Page
					$this->view->render('dominios/domain-details');
					
					break;
				
				case 'expiring':   //Listar Dominios a vencer en los proximos 3 meses y vencidos			
					
					// obtener la fecha actual, calclar 60 dias
					$today = strtotime('today');
					$vencimiento = strtotime('+ 60 days');
					$vencimiento_anio = date('Y');
					
					$array_renovaciones = array();
					
					//Listar dominios					
					$dominios = $this->model->getAllDomains();
			
					foreach ($dominios as $arrayDominios) {
												
						//Obtener las fechas de renovación
						$dominio_a_renovar = $this->model->getDomainRenewal($arrayDominios['id']);
						
						
						foreach ($dominio_a_renovar as $renovacion) {
							
							//fecha del renovacion del dominio
							$renewal_date = explode('/', $renovacion['value']);	
							$reverse_date_for_eval = strtotime($renewal_date[2]."/".$renewal_date[1]."/".$renewal_date[0]);
							
							//Analisis para Próximo Vencimiento 2 meses
							$difference = $vencimiento - $reverse_date_for_eval;
							//Analisis para Fechas vencidas
							$difference_pastdate = $reverse_date_for_eval - $today;
							
							//Convierte resultado en dias
							$upcoming_expiration = floor($difference/(60*60*24));
							$past_expiration	 = floor($difference_pastdate/(60*60*24));
							
							//descartar los dominios que NO se renovarán
							$answer = $this->model->getDomainRenewalAnswer($arrayDominios['id'], $renovacion['year']);
							
							if ($upcoming_expiration >= 0 && $upcoming_expiration <= 60) {	//Próximos a vencerse
								
								if ($answer[0]['value'] !== 'no') {
									//push to array  for insert									
									$domain_byid = $this->model->getDomain($renovacion['domain_id']);										
									$array_renovaciones[] = $domain_byid[0];
								}
																		
							} else if ($past_expiration <= 0) {	//Verificar si ya se pasó la fecha	
									
								if ($answer[0]['value'] !== 'no') {		
									//push to array  for insert									
									$domain_byid = $this->model->getDomain($renovacion['domain_id']);										
									$array_renovaciones[] = $domain_byid[0];						
								}
							}	/*end evaluation dates*/						
							
						} 
					}
					// Array final
					$this->view->dominiosexpiring = $array_renovaciones;
					
					
				
					foreach ($this->view->dominiosexpiring as $arrayDominios) {
							
						$search_domainid   = $arrayDominios['id'];
						
						$field_groups =  $this->model->getYearGroups($search_domainid);
						
						//Crear Grupos de campos en un array por año
						$i = 0;
						foreach ($field_groups as $anio) {
								
								$fields = $this->model->getDomainFields($search_domainid, $anio['year']);
		
								$this->view->fields_group[$search_domainid][$i]['year'] = $anio['year'];
		
								foreach ($fields as $campos) {
									
									$campo = $campos['field'];
									$valor = $campos['value'];
									
									$this->view->fields_group[$search_domainid][$i][$campo] = $valor;
									
									
									
								}
								
							$i++;
						}
						
				
					}
					
					if ($id !== 'data') {
						$this->loadModel('entidades');
						$this->view->clientesList = entidadesModel::$this->model->listClients();
						
						$clientes = entidadesModel::$this->model->listClients();
						
						foreach ($clientes as $arrayClientes) {
									
							$new_id   = $arrayClientes['id'];
							
							$this->view->cliente[$new_id] = $arrayClientes['razon_social'];
									
						}
						$this->view->render('dominios/domains');
						
					}
					
					
					break;
				
				case 'all':
					
					$this->view->dominios = $this->model->getAllDomains('domain');
			
					foreach ($this->view->dominios as $key => $arrayDominios) {
						
						$exist = '';						
						
						foreach ($this->view->dominiosexpiring as $listaprevia) {
								
							if ($listaprevia['id'] == $arrayDominios['id']) {
						    	$exist = TRUE;
							
								$id_repetida = $arrayDominios['id'];
							}
						} 
						
						if ($exist === TRUE) {	
							//Remove already listen in Expiring list
							unset($this->view->dominios[$key]);
							
						} else {
							
							$search_domainid   = $arrayDominios['id'];
						
							$field_groups =  $this->model->getYearGroups($search_domainid);
							
							//Crear Grupos de campos en un array por año
							$i = 0;
							foreach ($field_groups as $anio) {
									
									$fields = $this->model->getDomainFields($search_domainid, $anio['year']);
			
									$this->view->fields_group[$search_domainid][$i]['year'] = $anio['year'];
			
									foreach ($fields as $campos) {
										
										$campo = $campos['field'];
										$valor = $campos['value'];
										
										$this->view->fields_group[$search_domainid][$i][$campo] = $valor;
										
										
										
									}
									
								$i++;
							}
						}
							
				
					}
					
					
					$this->loadModel('entidades');
					$this->view->clientesList = entidadesModel::$this->model->listClients();
					
					$clientes = entidadesModel::$this->model->listClients();
					
					foreach ($clientes as $arrayClientes) {
								
						$new_id   = $arrayClientes['id'];
						
						$this->view->cliente[$new_id] = $arrayClientes['razon_social'];
								
					}
			
					if ($id !== 'data') {
						$this->view->render('dominios/domains');
					}
					
					break;
			}
			
		}
		
		function add($what) {
				
			$fields = '';
			$values = '';
			//Iniciar Array for insert
			$array_datos = array();
			
			switch ($what) {
				
				case 'domain':
					
					$this_id = $this->model->getAllDomains('id','DESC');
					
					$array_datos['id'] = $this_id[0]['id']+1;
					$redirects_to = '';
					// 1. Process $_POST to $variables	
					foreach ($_POST as $key => $value) {
										
						if($value === '') { //empty fields
											
						} else {
										
							$campo = escape_value($key);
							$valor = escape_value($value);
		
							switch ($key) {
												
								case 'submit': //omitir campo
									break;
								
								case 'renewal_date':
									$renewal_date = $valor;
									$year = substr($renewal_date, -4);
									$year = $year-1;
									
									break;
								
								case 'redirects_to' :
									$redirects_to = $valor;
									break;
									
								default:
								
									//push to array  for insert
									$array_datos[$campo] = $valor;
									break;
							}
									
						}	
					}
					
					//Registrar el mensaje en DB
					$insert = $this->helper->insert('dominios', $array_datos);
					
					//Crear fields para renovacion
					if (!isset($renewal_date)) {
						//Si no se definió fecha, obtenerla a partir de la fecha de creacion	
						if ($array_datos['domain_creationdate'] !== '') {					
							$parafecha = $array_datos['domain_creationdate'];
						} else {
							$parafecha = $array_datos['hosting_creationdate'];
						}
						
						$year = substr($parafecha, -4);	
					
					
						$renewal_date = substr($parafecha, -4);
						$next_year = $renewal_date + 1;
						$renewal_date =	substr($parafecha, 0, 6);
						$renewal_date =	$renewal_date . $next_year;
						
					} 
					
					//Runs function to create insert
					$this->buildYear($array_datos['id'], $year, $array_datos['registrant'], $array_datos['hosting'], $redirects_to);
					$this->buildRenewal($array_datos['id'], $year, $renewal_date);
					
					
					
					if ($insert === false ) {
						return true;
					} else {
						echo "error";
					}
					break;
				
				case 'renewal':
					

					$old_year = escape_value($_POST['year']);
					$id = escape_value($_POST['domain_id']);
							
					//Builds, based on previous current year
					$prev_renewal_date = $this->model->getDomainField($id , $old_year, "'renewal_date'");
					$prev_registrant = $this->model->getDomainField($id , $old_year, "'dominio'");
					$prev_hosting = $this->model->getDomainField($id , $old_year, "'hosting'");
								
					//New date
					$year = $old_year + 1;
					
					$parafecha = $prev_renewal_date[0]['value'];
								
					$renewal_date = substr($parafecha, -4);
					$next_year = $renewal_date + 1;
					$renewal_date =	substr($parafecha, 0, 6);
					$renewal_date =	$renewal_date . $next_year;								
					
										
					//Search for previously created Data
					$search = $this->model->getDomainField($id, $year, "'dominio'");
								
					if(empty($search)) {
									
						
						//Insert Year & Renewal
						$this->buildRenewal($id, $year, $renewal_date);
						$this->buildYear($id, $year, $prev_registrant[0]['value'], $prev_hosting[0]['value']);
					
					}
					
					
					//TODO validar
							
							
					break;
			
			
			}			
			
		}
		
		function update() {
			
			$fields = '';	$values = '';			
			$array_datos = array();
		
			
			//Build Array
			foreach ($_POST as $key => $value) {
								
				if($value === '') { //empty fields
									
				} else {
								
					$campo = escape_value($key);
					$valor = escape_value($value);

					switch ($key) {
										
						case 'submit': //omitir campo
							break;
							
						default:
						
							//push to array  for insert
							$array_datos[$campo] = $valor;
							break;	
					}
							
				}	
			}
			
			//Insert each modification
			foreach ($array_datos as $modificacion => $value ) {
				
				switch ($modificacion) {
					
					case 'domain_id':
						break;
						
					case 'year':
						break;
						
					default:
						
						$search = $this->model->getDomainField($array_datos['domain_id'], $array_datos['year'], "'".$modificacion."'");
						
						$arrayModificacion = array();
						
						$arrayModificacion['id'] = $search[0]['id'];
						$arrayModificacion['field'] = $modificacion;
						$arrayModificacion['value'] = $value;
						
						
						if(!empty($search)) {
							$insert = $this->helper->update('dominios_fields',  $arrayModificacion['id'], $arrayModificacion);
						}
						
						
						
						if ($modificacion === 'renewal') {
							
							if ($value === 'si') {

								$id 	= $array_datos['domain_id'];
								$year	= $array_datos['year']+1;
								
								/*
								 * //Search for previously created Data
								$search = $this->model->getDomainField($array_datos['domain_id'], $year, "'dominio'");
								
								if(empty($search)) {
									
									//Builds, based on previous current year
									$prev_renewal_date = $this->model->getDomainField($id , $array_datos['year'], "'renewal_date'");
									$prev_registrant = $this->model->getDomainField($id , $array_datos['year'], "'dominio'");
									$prev_hosting = $this->model->getDomainField($id , $array_datos['year'], "'hosting'");
								
									//New date
									$parafecha = $prev_renewal_date[0]['value'];
								
									$renewal_date = substr($parafecha, -4);
									$next_year = $renewal_date + 1;
									$renewal_date =	substr($parafecha, 0, 6);
									$renewal_date =	$renewal_date . $next_year;
								
									//Insert Renewal
									$this->buildYear($id, $year, $prev_registrant[0]['value'], $prev_hosting[0]['value']);
								}
								 * */
						
															
							}
						}
						
						break;
				}
				
				
			} 
			//print_r($array_datos);
			
			
			
		}
		
		
		function editinline () {
				
			$pk = escape_value($_POST['pk']);
			$value = escape_value($_POST['value']);
			
			$parts = explode( '-', $pk );
			
			if ($parts[0] === 'field') {
					
				$search = $this->model->getDomainField($parts[3], $parts[2], "'".$parts[1]."'");
				
				if(!empty($search)) {
				
					$arrayModificacion = array();
							
					$arrayModificacion['id'] = $search[0]['id'];
					$arrayModificacion['field'] = $parts[1];
					$arrayModificacion['value'] = $value;
							
					$insert = $this->helper->update('dominios_fields',  $arrayModificacion['id'], $arrayModificacion);
					print_r($arrayModificacion);
							
				} else {
					//create record?
					$insert = $this->helper->insert('dominios_fields', $arrayModificacion);	
				}
			
			} else {
				//Method igual a todos los "editinline"			
				$tablename = $parts[0];
				$fieldname = $parts[1];
				$id = $parts[2];
				
				$arrayModificacion = array();
									
				$arrayModificacion[$fieldname] = $value;
			
				$insert = $this->helper->update($tablename, $id, $arrayModificacion);
				
				print_r($arrayModificacion);
			}
			  
			
		}
		

	   
		
		function buildYear($id, $year, $registrant, $hosting, $redirect = '') {
				
			$array_fields = array();
			
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'dominio',
				'value' => $registrant,//$array_datos['registrant'],
			);
				
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'hosting',
				'value' => $hosting,
			);
			//extras
			if ($redirect != '') {
				
				$array_fields[] = array (
					'id' => '',
					'domain_id' => $id,
					'year' => $year,
					'field' => 'redirects_to',
					'value' => $redirect,
				);
			}
				
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'mail_server',
				'value' => '', 
			);
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'payment_dominio',
				'value' => '',
			);
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'payment_hosting',
				'value' => '', 
			);
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'payment_cliente',
				'value' => '',
			);
				
				
			$insert_fields = $this->helper->insert('dominios_fields', $array_fields);
			
							
		}

		function buildRenewal($id, $year, $renewal_date) {
			
			$array_fields = array();
			
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'renewal_date',
				'value' => $renewal_date,
			);
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'notification_email',
				'value' => '',
			);
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'notification_phone',
				'value' => '',
			);
			
			$array_fields[] = array (
				'id' => '',
				'domain_id' => $id,
				'year' => $year,
				'field' => 'renewal',
				'value' => '',
			);
			
			$insert_fields = $this->helper->insert('dominios_fields', $array_fields);
		
		}

		function test (){
			$this->view->buildpage('dominios/test');
		}
		/*
		 * function check(){
			$registered_email = array( 'john@doe.com', 'jonhy@doe.com' );
			
			$requested_email  = $_POST['emailo'];
			
			if( in_array($requested_email, $registered_email) ){
			    echo 'false';
			}
			else{
			    echo 'true';
			}*/
		function check(){
			
			$requested_email  = escape_value($_POST ['domain']);
			$registered_email = $this->model->checkRegistered($requested_email);
			
			if (!empty($registered_email)) {
			    echo 'false';
			}
			else {
			    echo 'true';
			}
			
		}

		//Lista de Proveedores
		function provider_registrant() {

			$groups = $this->model->provider_registrant();			
			echo json_encode($groups); 
			
		}
		
		function provider_hosting() {

			$groups = $this->model->provider_hosting();			
			echo json_encode($groups); 
			
		}
		
		function provider_mailserver() {

			$groups = $this->model->provider_mailserver();			
			echo json_encode($groups); 
			
		}
		
		function clients() {
			
			$this->loadModel('entidades');
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
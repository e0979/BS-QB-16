<?php

	class HomeController extends Controller {
		
		public function __construct() {
			
			parent::__construct();	
			Auth::handleLogin();
		
		}
		
		function index() {
			
			$this->loginscreen();						
			
		}
		
		function notification_checked($id) {
				$array_update["checked"]=1;
				$this->helper->update('notifications',$id, $array_update);
				
			
		}
		
		function welcome() {
				
			$this->view->userdata = $this->user->getUserdata();
		
			User::checkSession();
			
			
			
			$who = shortName($this->view->userdata[0]['name']);
			
			$saludos = array(
			    '¡Hola, '.$who.'!',
			    '¡Buen día '.$who.' :) !',
			    '¡Bienvenid@ '.$who.'!',
			    '¿Cómo andas, '.$who.'?' ,
			    '¿Qué es de tu vida '.$who.'?' ,
			);
			
			$key = array_rand($saludos);
			
			$this->view->saludo = $saludos[$key];
			
			$this->listNotificaciones();
			$this->listClientes_Proveedores_Array();
			
			$this->view->titulo = SITE_NAME. ' | Home ';
			
			
			$this->view->render('default/head');
			$this->view->render('home');
			$this->view->render('default/footer');						
			
		}
		
		function loginscreen() {
			
			$this->view->titulo = SITE_NAME. ' | login ';		
			$this->view->render('login');

		}
		
		
		function login() {
			
			$fields = '';
			$values = '';
			
			//Iniciar Array for insert
			$array_datos = array();			
			
			foreach ($_POST as $key => $value) {
					
				if($value === '') { //empty fields
																		
				} else {
								
					$campo = escape_value($key);
					$valor = escape_value($value);
				}
					
				$data = "\$" . $campo . "='" . escape_value($valor) . "';";						
				eval($data);
						
			}
			
			$validUser = $this->user->validateUsername($rif);
			
			if(empty($validUser)){
						
				echo "user";				
				
			} else {
				
				$validPass = $this->user->validatePassword($rif, $password);
					
					if(empty($validPass)){
						echo "pass";
					
					} else {
							
						$role = escape_value($validUser[0]['role']);
						$username = escape_value($validUser[0]['username']);
						
						$this->user->init();
			            $this->user->set('role', $role);
						$this->user->set('rif', $validUser[0]['rif']);
			            $this->user->set('loggedIn', true);
			            $this->user->set('username', $username);
			           
						echo 'welcome';					
						exit;
					}
				
				
			}
			
			
		
		}


		function listNotificaciones () {
			
			//Clientes
		/*	$this->loadModel('home');*/
			$this->view->userdata = $this->user->getUserdata();
			//var_dump($this->user->getUserdata());
			$username=$this->view->userdata[0]['email'];
			//$this->loadModel('home');
			$notificaciones = homeModel::$this->model->listNotificaciones($username);
			$this->view->notificaciones = $notificaciones;
			$this->view->render('default/menu-notifications');		
			
						
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
		
		
		
			
	}

	
?>
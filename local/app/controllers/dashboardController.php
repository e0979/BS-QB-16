<?php

	class dashboardController extends Controller {
		
		public function __construct() {
			
			parent::__construct();	
			Auth::handleLogin();
			$this->view->userdata = $this->user->getUserdata();
		}

		function index() {			
			$this->welcome();
		}

		function welcome() {

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
			
			//$this->listNotificaciones('no');
			
			$this->view->title = makeTitle('Home');

		
			
			$this->view->render('default/head');
			$this->view->render('dashboard');
			$this->view->render('default/footer');	






			
			/*$this->loadModel('permissions');
			
			$permisos = $this->model->rolePermissions($this->view->userdata[0]['role'];
			
			$permisos = json_decode($permisos[0]['permissions'], TRUE);
			
			foreach ($permisos as $key => $value) 
			{
				//Check if Menu is authorized for user role
				if ($value == 1) { 
					$menu = $this->model->getMenu($key);
					if (!empty($menu)){
						$permissions_menu[] = $menu[0];	
					}							
				}
			}

			foreach ($permissions_menu as $item) {
				
				if($item['level'] != '1'){					
					$new_id = $item['parent'];
					$this->view->menu[$new_id]['children'][] = $item;					
				} else {					
					$new_id = $item['id'];
					$this->view->menu[$new_id] = $item;
				}				
			}*/					
			
		}
	}
?>
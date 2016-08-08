<?php

	class SettingsController extends Controller {

		
		public function __construct() {
			
			parent::__construct();
						
		}
		
		public function index() {
						
			$this->profile();	
				
		}
		
		function logout() {
			
			$this->user->destroy();
			header('location: '. URL .'home');
		}
		
		
		public function profile() {
				
			$_role = User::get('role');	
			Auth::handleLogin($_role);
						
			$this->view->page = "";			 			
			$this->view->titulo = "Configuración | Mi perfil";
			
			
			$username 	= $this->user->get('username');
			$role 		= $this->user->get('role');
			
			$this->view->userdata = $this->user->getUserdata($role, $username);

			//Page
			$this->view->buildAdminPage("settings", "settings/profile");
		}
		
		public function firstlogin() {

			$this->edit('password');
			
		} 
		
		public function edit ($what){
			
			$this->view->userdata = $this->user->getUserdata();
				
			$_role = User::get('role');	
			Auth::handleLogin($_role);
			
			$this->view->page = "";

			switch ($what) {
				case 'password':
					
					$this->view->titulo = "Configuración | Clave";											
					$this->view->buildAdminPage("settings", "settings/password-change");
					
					break;				
				
			}
		}
		
		public function update($what){
			//No Auth this method
								
			$username 	= $this->user->get('username');
			$role 		= $this->user->get('role');
			
			$userdata 	= $this->user->getUserdata($role, $username);
			$email 		= $userdata[0]['email'];
								

			$fields = '';
			$values = '';
			$array_datos = array();	
			$array_datos['username'] = $username;
			
			foreach ($_POST as $key => $value) {
							
				if ($value === '') { // skips empty fields
								
				} else {
							
					$campo = escape_value($key);
					$valor = escape_value($value);
					
					switch ($key) {
										
						case 'submit': //omitir campo
							break;
							
						case 'password_confirm': //omitir campo
							break;

						default:
						
						//Convert to $variables every filled field		
					
						$data = "\$" . $campo . "='" . $valor . "';";						
						eval($data);
				
						$array_datos[$campo] = $valor;
					
					}
							
				}
								
			}				
					
			switch ($what) {
					
				case 'password':
					
					//Validate Data
					$validPass = $this->user->validatePassword($username, $password_old);
					
					if(empty($validPass)){
							
						echo SYSTEM_INVALID_PASSWORD;					
					
					} else {
							
						//Previous Password Approved, move on						
						$array_datos['pass_hash'] = $this->user->create_hash($password);
						
						//remove extra $_POST;
						unset($array_datos['password_old'], $array_datos['password']);
						 
						//Update Data
						$this->helper->update('users', $username, $array_datos, 'username', 1);
						$updated_data = DB::affectedRows();
						
						if($updated_data !== 0)  {
							
							//Notificacion 
							$message = 'Este email es para notificarle que hubo un cambio en su contraseña, realizado por usuario.<br><br>
							Si usted no solicitó este cambio, contacte al administrador de la página<br><br>
							<table cellspacing="0" cellpadding="0"> <tr> 
							<td align="center" width="130" height="40" bgcolor="#5cb85c" style="-webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; color: #ffffff; display: block;">
							<a href="'.URL .'" style="color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">Ir al Sistema</a>
							</td> </tr> </table>';
			
							$bodyuser = $this->email->buildNiceEmail('settings', SYSTEM_PASSWORD_CHANGE, $message);
									
							//Notificar registro
							$this->email->sendMail($email, SYSTEM_EMAIL , SYSTEM_PASSWORD_CHANGE, $bodyuser);
							
							// Insertar registro de Session
							
							echo SYSTEM_PASSWORD_CHANGE;
							
							User::logSession($username);						
							
							//Redirect
							
							//echo ("<script>window.location.replace('". URL . "home/welcome');</script>");
							echo ("<script>window..history.back();</script>");

						} 
						
											
						
					}				
					
					
					break;
				
				default:
					echo "def";
					break;
			}
		
		}

		
		
		
	}
?>
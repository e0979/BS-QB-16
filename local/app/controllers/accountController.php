<?php 
	/**
	 * AccountController handles:
	 * - Creating users accounts
	 * - Login & Sign Up
	 * - Identifies users and redirects to proper site initialization
	 * - First time login 
	 */
	class accountController extends Controller {

		public function __construct() {
			parent::__construct();	
		}
		
		public function index() {
							
			$this->signin();		
		}
		// LOGIN: Method called by login form, process the form and returns authorization response from server
		
		public function login() {

			$array_datos = array();	
			foreach ($_POST as $key => $value) {
				$campo = escape_value($key);
				$valor = escape_value($value);
				
				$data = "\$" . $campo . "='" . escape_value($valor) . "';";						
				eval($data);
			}
			$username = $username;
			$validUser = $this->user->validateUsername($username);
			
			if(empty($validUser)){						
				//echo "error";				
				$response["tag"] = "login";
				$response["success"] = 0;
				$response["error"] = 1;	
	            $response["response"] = LOGIN_MESSAGE_ERROR;				
				echo json_encode($response);
				
			} else {
				
				$validPass = $this->user->validatePassword($username, $password);
				
				if(empty($validPass)){
					//echo "error";
					$response["tag"] = "login";
					$response["success"] = 0;
					$response["error"] = 1;	
		            $response["response"] = LOGIN_MESSAGE_ERROR;	
					echo json_encode($response);
				} else {
					$role = escape_value($validUser[0]['role']);
					$username = escape_value($validUser[0]['username']);
					
					$profile = $this->model->getAccount($role, $validUser[0]['id']);
					
					$this->user->init();
			        $this->user->set('role', $role);
					$this->user->set('loggedIn', true);
			        $this->user->set('username', $username);
			        $this->user->set('rif', $validUser[0]['rif']);
					
					//Check session in here
					User::checkSession();
					$redirection = User::gotoMainArea(TRUE); //redirection will be done via JavaScript


					$response["tag"] = "login";
					$response["success"] = 1;
					$response["error"] = 0;	
					$response["response"] = "welcome";
					$response["redirection"] = $redirection."/#";		
					$response["user"]["role"] = $role;
					$response["user"]["uid"] = $validUser[0]['id'];
					$response["user"]["name"] = $profile[0]['name'];
		            $response["user"]["email"] = $username;						
											
					echo json_encode($response);
									
					exit;
				}
			}
		}
		/*
		// SIGNIN: verifies if User already logged in, if not shows login screen
		public function signin() {
			
			 $already_loggedin = User::get('role');
			
			if (empty($already_loggedin)) {
				
				$this->view->title = SITE_NAME. " | " .SITE_NAME__SIGN_IN ;						
				$this->view->render('login/index');
				
			} else {	
				//Redirect		
				$this->identify();
			}
		}
		// AUTHENTICATE: Method called when user is verified via Email -after registration-, and is logging in for the first time	
		public function authenticate($temp_password, $username) {
			
			$username = escape_value($username);
			$password = escape_value($temp_password);			
			
			$validUser = $this->user->validateUsername($username);
			
			if(empty($validUser)){	//Wrong User					
			
				echo ERROR_AUTHENTICATE_MESSAGE;
				exit;
								
			} else {
				$validPass = $this->user->validatePassword($username, $password);
				
				if(empty($validPass)){ //Wrong Password
				
					echo ERROR_AUTHENTICATE_MESSAGE;
					exit;				
					
				} else {
					$role = escape_value($validUser[0]['role']);
					$username = escape_value($validUser[0]['username']);
					$this->user->init();
			        $this->user->set('role', $role);
					$this->user->set('loggedIn', true);
			        $this->user->set('username', $username);
			           
					// Welcome
					$this->firstlogin($password);					
					exit;
				}
			}
			
		} 
		
		// IDENTIFY: verifies which session corresponds to user, and redirects them to appropiate area
		public function identify () {
				
			User::checkSession();
			//Auth::handleLogin('account');
			User::gotoMainArea();			
			
		}
		
		// LOGOUT: kills session and redirects user to home
		public function logout() {			
			
			$this->user->destroy();
			header('location: '. URL);	
		} 
		
		
		
		//
		// USER CREATION
		//
		 
		// SEARCHREGISTERED: Method called by form RECOVERY, to async check if user is in fact registered
		function searchregistered($field, $data){
			$result = $this->model->getAccount($data, $field);
			echo json_encode($result);
		}
		
		// CHECKREGISTERED: Method called by form REGISTRATION, to async check if user is already registered
		function checkregistered($what) {
			
			//Check if already exist in User database
			switch (escape_value($what)) {
				case 'username':
					$requested_data = escape_value($_POST['email']);					
					$already_registered =	$this->model->getAccount("", $requested_data, "username");
					
					if (!empty($already_registered)){
						if ($already_registered[0]['status'] === 'sleep') {
							$already_registered = '';
						}	
					}					
					
					break;
					
				//TODO Change if need to check by other field
				//case 'rif':
					//$requested_data = escape_value($_POST['rifletter']).escape_value($_POST['rif']);
					//$already_registered =	$this->model->getAccount($requested_data, 'rif'); 
					//break;
			}
			
			if (empty($already_registered)) {
			    echo 'true'; //good to go
			}
			else {
			    echo 'false';
			}
		}
		
		// RECAPTCHA: Method called by form to check if valid captcha was provided
		function recaptcha() {
			
			$resp = recaptcha_check_answer (RECAPTCHA_PRIVATEKEY,
			                                $_SERVER["REMOTE_ADDR"],
			                                $_POST["recaptcha_challenge_field"],
			                                $_POST["recaptcha_response_field"]);
			
			if (!$resp->is_valid) {
			 	// die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." . "(reCAPTCHA said: " . $resp->error . ")");
				// echo 'false'; 
				echo 'true';
			} else {
			    echo 'true';
			}

		}
		
		
		// PROCESS: Method called by form REGISTRATION, to process vars and create user
		function process() {
			
			$array_data = array();	
			
			foreach ($_POST as $key => $value) {
				$field = escape_value($key);
				$field_data = escape_value($value);				
				$array_data[$field] = $field_data;
			}
			
			
			unset($array_data['recaptcha_challenge_field']);
			unset($array_data['recaptcha_response_field']);			
			
			
			// 1 -Creates User&Profile and Sends Authentication Link
			$array_user['username'] 	= $array_data['email'];
			$array_user['role'] 		= $array_data['role'];
			$array_user['status'] 		= 'active';
			//Data for Profile
			$array_user['name'] 		= $array_data['name'];
			$array_user['email'] 		= $array_data['email'];
			$array_user['phone'] 		= $array_data['phone'];
			//TODO Users registration will be a process of steps
			//TODO REFACTOR Should 'sex' and 'birth' be located in fields or should they go to a json field DATA?
			//$array_user['id_card'] 		= $array_data['id_card'];
			//$array_profile['birth'] 		= $array_data['birth'];		
			//$array_profile['sex'] 		= $array_data['v'];
			
			
			//Facebook
			
			//if (isset($array_data['facebook'])){
			if ($array_data['socialnetwork'] == 'facebook'){
				
				$array_user['name'] 		= $array_data['first_name'];
				$array_user['lastname'] 	= $array_data['last_name'];								
				
				$array_user['data']['facebook_id'] = $array_data['id'];
				unset($array_data['id']);
				
				$array_user['gender'] 		= strtoupper( substr($array_data['gender'], 0, 1) ); //just first leter
				$array_user['birth'] 		= $array_data['birthday'];
				
				$array_user['data']['locale'] = $array_data['locale'];
				$array_data['data']['location'] = $array_data['location']['name'];
				
				//Picture
				$image_data=file_get_contents($array_data['fbpicture']['data']['url']);
				$encoded_image=base64_encode($image_data);
				//print_r($encoded_image);
				$array_user['avatar'] 		= $encoded_image;
				
						
			} else	
					
			//Google			
			//if (isset($array_data['google'])){
			if ($array_data['socialnetwork'] == 'google'){
				$array_user['name'] 		= $array_data['given_name'];
				$array_user['lastname'] 	= $array_data['family_name'];	
				$array_user['gender'] 		= strtoupper( substr($array_data['gender'], 0, 1) ); //just first leter			
				
				//Google picture
				$image_data=file_get_contents($array_data['picture']);
				$encoded_image=base64_encode($image_data);
				$array_user['avatar'] 		= $encoded_image;							
				//Google data
				$array_user['data']['google_id'] = $array_data['id'];
				$array_user['data']['locale'] = $array_data['locale'];	
								
			
			}
					
			$array_user['data']['creationdate'] = date("Y-m-d h:i:s");
			
			$array_user['data'] = json_encode($array_user['data']);
			
			
			//Check if already exist in User database
			$already_registered =	$this->model->getAccount("",$array_data['email'], 'username');
			
			if(!empty($already_registered)){
					
				if ($already_registered[0]['status'] === 'sleep'){
					//si está sleep ->
					$array_user['wakeup'] 	= $already_registered[0]['id'];
					//Register User				
					require_once('usersController.php');	
					$users = new usersController;	
					$create_user = $users->create($array_user);	
						
				}
				
			} else if (empty($already_registered)) {
					
				//Register User				
				require_once('usersController.php');	
				$users = new usersController;	
				$create_user = $users->create($array_user);	
			}
			
			if ($create_user > 0) {								
				echo REGISTRATION_MESSAGE_SUCCESS;		
			} else {
				echo REGISTRATION_MESSAGE_ERROR;
			}
			
			
		}
		
		
		
		
		//
		// SETTINGS methods
		//
		 
		// FIRSTLOGIN: takes user to inmediately set a password ( when coming from AUTHENTICATE from mail he doesn't have one);
		public function firstlogin($old_password= '') {
			
			if (!empty($this->user->get('socialnetwork'))) {
				// Insertar registro de Session				
				$username 	= $this->user->get('username');
				User::logSession($username);
				
				$this->view->redirect_link = URL .'account/identify';
				$this->view->render('redirect');
				
			} else {
				$this->edit('password', $old_password);
			}			
			
			
		}
		// PROFILE: shows main Account area
		public function profile () {
			$this->edit('profile');

		}
		
		// RECOVER: Method called by form, checks user and triggers recovery by email password process
		function recover($what='password'){
			
			$username = escape_value($_POST['recover-password']);
			//Check for username in Database
			
			$already_registered =	$this->model->getAccount('',$username, 'username');
			
			
			if (empty($already_registered)) {
				echo SYSTEM_USERNAME_NOT_EXISTS;
			} else {
				$temp_key = uniqid(rand(), true);	
				$array_user['pass_hash'] = $this->user->create_hash($temp_key);
				$insert = $this->helper->update('users', $already_registered[0]["id"], $array_user);
				//Send Passwrod change email
				$message =  SETTINGS_EMAIL_HEAD;								
				$message .= PASSWORD_RECOVERY_MESSAGE_PART1;
				$message .= PASSWORD_RECOVERY_MESSAGE_PART2;
				$message .= '<a href="'.URL.'account/authenticate/'.$temp_key.'/'.$username.'" style="color: #ffffff; font-size:16px; font-weight: bold; font-family: Helvetica, Arial, sans-serif; text-decoration: none; line-height:40px; width:100%; display:inline-block">Cambiar Password</a>';				
				$message .= PASSWORD_RECOVERY_MESSAGE_PART3;
				$message .= SETTINGS_EMAIL_FOOTER;
					
				$this->email->sendMail($username, SYSTEM_EMAIL, PASSWORD_RECOVERY_SUBJECT , $message);
				
				echo PASSWORD_RECOVERY_SUCCESS_RESPONSE;
			}
		}
		
		// EDIT: Views to edit Password or Profile
		public function edit ($what, $old_password = ''){
			
			$this->view->userdata = $this->user->getUserdata();
				
			Auth::handleLogin('account');
			
			$this->view->page = "";

			switch ($what) {
				case 'password':
					
					$this->view->title = "Configuración | Clave";
					$this->view->old_password =		$old_password;									
					$this->view->buildpage('settings/password-change','settings');
					break;
					
				case 'profile':
							 			
					$this->view->title = "Configuración | Mi perfil";
					
					$username 	= $this->user->get('username');
					$role 		= $this->user->get('role');
					$this->view->userdata = $this->user->getUserdata($role, $username);
		
					//Page
					$this->view->buildpage('settings/profile','settings');
				
					break;	
				case 'notifications':

					//$this->view->title = "Configuración | Mi perfil";
					//$username 	= $this->user->get('username');
					//$role 		= $this->user->get('role');
					//$this->view->userdata = $this->user->getUserdata($role, $username);
					//Page
					$this->view->buildpage('settings/notifications','settings');

					break;
				case 'preferences':					
					$this->view->buildpage('settings/preferences','settings');
					break;
				
			}			
			
		}
		

		
		public function update($what) {
				
			switch ($what) {
				case 'data':
					//comes from $_POST						
					$array_datos = array();	
					foreach ($_POST as $key => $value) {
						$field = escape_value($key);
						$field_data = escape_value($value);				
						$array_datos[$field] = $field_data;
					}
					//DB::debugMode(true);
					$current_user = $this->model->getAccount($array_user['role'], $array_datos['email'], 'username');
					
					//get previous stored field 'data'
					$data = $current_user[0]['data'];
					$data_temp = json_decode($data,true);
					//use as array
					foreach ($data_temp as $key => $value) {
						$array_fb['data'][$key] = $value;
					}
					
					//UPDATE Facebook					
					if ($array_datos['socialnetwork'] == 'facebook'){						
						
						$array_user['name'] 			= $array_datos['first_name'];
						$array_user['lastname'] 		= $array_datos['last_name'];
						$array_user['gender'] 			= strtoupper( substr($array_datos['gender'], 0, 1));
						
						//Location Facebook
						$array_fb['data']['timezone']	= $array_datos['timezone'];
						$array_fb['data']['locale']		= $array_datos['locale'];
						$array_fb['data']['location'] 	= $array_datos['location']['name'];
						
						//Picture
						$image_data						=	file_get_contents($array_datos['data']['url']);
						//$encoded_image					=	base64_encode($image_data);
						$array_user['avatar'] 			= $encoded_image;
						
						$role 								= $array_datos['role']; 
						
						$array_fb['data']['birthday'] 		=	$array_datos['birthday'];
						$array_fb['data']['lastupdatedata']	= date("Y-m-d h:i:s");
					}
					
					//UPDATE Google
					if ($array_datos['socialnetwork'] == 'google'){							
						
						$array_user['name'] 			= $array_datos['given_name'];
						$array_user['lastname'] 		= $array_datos['family_name'];
						$array_user['gender'] 			= strtoupper( substr($array_data['gender'], 0, 1) );
						
						//Location 
						$array_fb['data']['locale'] 	= $array_datos['locale'];
						$array_fb['data']['location'] 	= $array_datos['location']['name'];
						
						// picture
						//Google picture
						$image_data=file_get_contents($array_datos['picture']);
						$encoded_image=base64_encode($image_data);
						$array_user['avatar'] 			= $encoded_image;
						$role 							= $array_datos['role']; 
						
						$array_fb['data']['birthday'] 	=	$array_datos['birthday'];
						$array_fb['data']['lastupdatedata'] 	= date("Y-m-d h:i:s");
					}
					
										
					$array_user['data'] 	= json_encode($array_fb['data'] );
					
					unset($array_user['role']);
					
					$updated_data = $this->helper->update($role, $array_datos['email'], $array_user, 'username');
					
					if ($updated_data > 0){
						echo "true"; // updated
					} else {
						echo "false"; /// Maybe they were the same, nothing changed.
					}
					
					break;
					
				case 'password':
					//comes from controller call -->
					
					$username 	= $this->user->get('username');
					$role 		= $this->user->get('role');
					
					$userdata 	= $this->user->getUserdata($role, $username);
					
					if (empty($userdata)) {
						exit;
						
					} else {
						
						$email 	= $userdata[0]['email'];
								
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
								$message = SYSTEM_EMAIL__PASSWORD_CHANGE;
				
								$bodyuser = $this->email->buildNiceEmail('settings', SYSTEM_PASSWORD_CHANGE, $message);
										
								//Notificar registro
								$this->email->sendMail($email, SYSTEM_EMAIL , SYSTEM_PASSWORD_CHANGE, $bodyuser);
								
								// Insertar registro de Session
								User::logSession($username);						
								
								//Redirect	
								$this->view->redirect_link = URL .'account/identify';
								$this->view->response = SYSTEM_PASSWORD_CHANGE;
								$this->view->render('redirect');						
								
							} 
						}
						
						
						
					}
					
					break;
			}		
		
		}
		*/
	}
?>
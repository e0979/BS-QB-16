<?php
	
	//This is Session

	class User extends Hash {
		
		public function __construct() {
			
		}
		
		public static function init() {
			@session_start();
		}
		
		public static function set($key, $value) {
			
			if ($key === 'loggedIn') {
				$_SESSION['loggedIn'] = time();
				$_SESSION['randomkey'] = uniqid(rand(), true); //random session id 
				
			} else {	
				$_SESSION[$key] = $value;
			}
		}
		
		
		public static function get($key) {
			
			if (isset($_SESSION[$key])) {
				
      			return escape_value($_SESSION[$key]);
				
			} else {
			//	echo "no setted	". $key.'<br>';
				return false;
			}
					
		}
		
		public static function destroy() {
				
			@session_destroy();			
			
		}
		
		/* Model Login */
		
		public function validatePassword($username, $data) {
				
			//retrieve hash from database
			
			$hash = $this->getHash($username);
			$hash = $hash[0]['pass_hash'];
			
		   	$result = $this->validate_password($data, $hash);
		   
		   	return $result;
		   
		}
		
		public function validateRole($username, $area) {
				
			$role = $this->validateUsername($username);
			
			$role = $role[0]['role'];
			
			switch ($role) {

				case 'admin':
					
					return true;
					break;
			
								
				default:
					
					if($role === $area) {
						return true;
					
					} else {
						return false;
					}
					
					break;
			
			}
					   
		}
		
		public function getUserdata(){
		
			$user = $this->get('username');
			$role = $this->get('role');
			$data = $this->get('rif');
			
			$table = 'user_profile';
			$field = 'rif';
								
			return DB::query("SELECT * FROM ". DB_PREFIX . $table ." WHERE ". $field ."=%s LIMIT 1", $data);
					
		}
		
		
		static function checkSession(){
				
			$data  = User::get('username');	//escape_value($data);
			$role  = User::get('rif');			
			
			//Check if user valid
			$usr = new User();
			$check_uservalid = $usr->validateUsername($data);
			//Check if user is loggin first time
			$check_firsttime_session = DB::query("SELECT * FROM ". DB_PREFIX . "user_session WHERE username=%s LIMIT 1", $data);
			//Check if active session from User is already registered
			$check_previous_session = User::check_session_inDB($data);
			
			
			//El usuario no existe, existía una sesión vieja iniciada tal vez
		 	if(empty($check_uservalid)) {
		 		
				User::destroy();
				header('location: '.URL . 'home');
				exit;	
		 	} else {
		 		
				//User exists, not fake session, do everything then
				User::activeSession();
			
				if(empty($check_firsttime_session)) {
					
						//requieres Password Change First time	
						header('location: '.URL.'settings/firstlogin/');
						exit;
						
					
				} else {
					//Not first Session, so log and move on
					
					if(empty($check_session)) { //if session not registered, log
						User::logSession($data);
					}
					
					
				}
				
		 	}
		
		}

		static private function activeSession() {
			//TODO change to cookies??
			
			$session_limit = SESSION_LIMIT; // 5 minutes
			//$role = User::get('role');
			$role = 'home';
			
			$session_analysis = time() - $_SESSION['loggedIn'];
			
			if ($session_analysis < $session_limit) {
				//renew time 	
				$_SESSION['loggedIn'] = time();
				
			} else {
				//echo("<script>alert('".USER_INACTIVE_MESSAGE."');window.location.replace('". URL . $role ."');</script>");
				User::destroy();
			}
						
		
		}

		static function logSession($username) {
			
			$check_previous_session = User::check_session_inDB($username);
			
			if (empty($check_previous_session)) {
				
				$array_session = array();
				$array_session['username'] 	 = $username;
				$array_session['session_randomkey'] = escape_value($_SESSION['randomkey']);
				$array_session['url_in'] = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
				$array_session['ip_address'] = Helper::getIpAddress();				
				
				Helper::insert('user_session', $array_session ,1);
			}
			
		}
		
		public function profile () {
			
			$view = new View();
			
			$view->titulo = "Configuración | Perfil";
			
			$view->render("settings/head");
			$view->render("settings/nav");
			$view->render("settings/password-change");
			$view->render("settings/footer");
			
		}
		
		//MODEL DATABASE
		
		public function validateUsername($data) {
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."users WHERE username=%s LIMIT 1", $data);
		
		}
		private function getHash($username) {
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."users WHERE username=%s LIMIT 1", $username);
			
		}
		
		static private function check_session_inDB ($username) {
				
			$randomkey = User::get('randomkey');			
			$check_session = DB::query("SELECT * FROM ". DB_PREFIX . "user_session WHERE username=%s AND session_randomkey='".$randomkey."' ORDER BY timestamp DESC LIMIT 1", $username);
			
			return $check_session;
		}
		
	
	}
	
?>
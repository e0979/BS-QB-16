<?php

	class Auth {
		
		public static function handleLogin() {
			
			$area = 'home';
			
			@session_start();
			
			if (isset($_SESSION['loggedIn']	)) {
				
				//User is logged			
				$logged = $_SESSION['loggedIn'];
				
				$role 	  = $_SESSION['role'];
				$username = $_SESSION['username'];
				
				
				//validar tipo de session y redirect if needed
				$currentpage = Auth::getCurrentArea();
				
				switch ($currentpage[0]) {
			
					case 'settings':
						
						if ($currentpage[1] !== 'firstlogin') {
							User::checkSession();
						
						}
						
						break;
					
					case 'home':
						//redirect if already logged in
						if ($currentpage[1] == '') {
							header('location: '. URL .'home/welcome/' );
						}
				
				}
				
				
				
			} else {
			// If No sessions	
			//Check if in Login Page
			$currentpage = Auth::getCurrentPage();	
			
			 switch ($currentpage[0]) {
				
				case 'url='.$area:
					break;
					
				case 'login':
					break;
					
				case 'register':
					break;
										
				default:
					if (!isset($logged)) {
						
						header('location: '. URL .$area);			
						
					}
					break;
					
			}
			}
			
		
		}
		
	
		static function getCurrentPage() {
			
			$currentpage = $_SERVER['QUERY_STRING']; //$_SERVER['REQUEST_URI'];
			$currentpage = explode('/', $currentpage);
			
			if(isset($currentpage[1])){
				$currentpage[0] = $currentpage[1];
			}
		//	$currentpage = $currentpage[count($currentpage) - 1]; //Last segment of array
		//	$currentpage = $currentpage[1];
			//print_r($currentpage);	
			return $currentpage;
		}
		
		static function getCurrentArea() {
			
			$currentpage = $_SERVER['QUERY_STRING']; 
			$currentpage = explode('/', $currentpage);		
			
			//remove "url=" string in server's response
			$currentpage = str_replace("url=","", $currentpage);
			
			return $currentpage;
		}
		
	}

?>
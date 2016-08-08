<?php

	class Bootstrap {
		
		private $_url = null;
		
		private $_controller = null;
		private $_helper = null;
		
		private $_controllerPath = 'app/controllers/';
		private $_modelPath = 'app/models/';
		private $_errorFile = 'error.php';
		private $_defaultFile = 'homeController';
		
		
		public function init(){
			//sets the $_url
			$this->_getUrl();
			
			@$this->_loadController($this->_url[0]);
			$this->_getControllerMethod();
				
				
				
			
		}
		
				
		private function _getUrl() { //accesed ONLY from this class, that's why it' private
		
			$url = isset($_GET['url']) ? $_GET['url'] : null ; //isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : null ;
			$url = rtrim($url, '/');
			$url = filter_var( $url, FILTER_SANITIZE_URL );
			
			$this->_url = explode('/', $url); //or $_SERVER['QUERY_STRING']??
			
			//TEST print_r(array_filter($this->_url));
								
									
		}
		
		/*private function _loadHelper() {
			
			require_once( 'Helper.php');
			$this->_helper = new Helper;
		
		}*/
		
		private function _loadDefaultController() {
			
			//TEST echo "<h5>2- Loads Default Controller <em>init()</em></h5><br>"; //DEVELOPMENT REMOVE
	
			require_once($this->_controllerPath . $this->_defaultFile . '.php');
			$this->_controller = new $this->_defaultFile;
		
		}
		
		
		private function _loadController($who) { // change to name: _getController
		
				
			//	echo "<h5>2-a Will Load REQUESTED Controller <em>init()</em></h5><br>"; //DEVELOPMENT REMOVE
			
				if (empty($this->_url[0])) {
					$who = 'home';
					//TEST echo $who;
					
				} else {
					$who =  $this->_url[0];
					//TEST echo $this->_url[0];
					
				}
				$controller = $who  . 'Controller'; 	//indexController
				$controllerFile =$this->_controllerPath . $controller . '.php'; 	//indexController.php
				
				// Check if file exists
				if (is_readable($controllerFile)) { //or file_exists
					
					require_once($controllerFile);					
					$this->_controller = new $controller;
					//load Model
					
					$this->_controller->loadModel($who, $this->_modelPath);
					
					
										
				} else {
					
					$this->_error($controllerFile);
					
				}
		
		}
		
			private function _getControllerMethod() { // change to name: _getMethod
			
				$length = count($this->_url);
				//TEST echo "L:".$length;
								
				switch ($length) {
										
					case 2:
					//Controller -> Method 
					//TEST echo "<h4>Case: Mehtod only</h4>";
					if(!method_exists($this->_controller, $this->_url[1])) {
						$this->_error($this->_url[1]);
					} else {
						$this->_controller->{$this->_url[1]}();
					}
					break;
					
					case 3: 
					//Controller -> Method -> (Param1)
					//TEST echo "<h4>Case: 1 Param </h4>";
					$this->_controller->{$this->_url[1]}($this->_url[2]);
					break;
					
					case 4: 
					//Controller -> Method -> (Param1, Param2)
					//TEST echo "<h4>Case: 2 Param </h4>";
					$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3]);
					break;
					
					case 5: 
					//Controller -> Method -> (Param1, Param2, Param 3)
					//TEST echo "<h4>Case: 3 Param </h4>";
					$this->_controller->{$this->_url[1]}($this->_url[2], $this->_url[3], $this->_url[4]);
					break;
									
					default:
					//Controller -> Method  IF NO MATCHING PARAMETER -> INDEX? o ERROR
					//TEST echo "<h4>Case: Controller but No Method, so default</h4>";
					$this->_controller->index();
					break;
				
				}
			
			}
			
			
			private function _getControllerMethodArgs() { // change to name: _getArgs
			
			}
		
		
		
		private function _error($vars) {
			
			echo "<hr>Call for an Error. No <strong><em>'" . $vars . "'</em></strong> File or Method found <hr>"; //DEVELOPMENT REMOVE
			exit;
		
		}
		
		
		
	
	}

?>
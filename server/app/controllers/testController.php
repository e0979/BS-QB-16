<?php

	class TestController extends Controller {
		
		public function __construct() {
			
			parent::__construct();	
		
		}
		
		
		function index() {
						
											
			$this->view->titulo = SITE_NAME. ' | TEST ';	

			/*$this->view->js_head = '<script type="text/javascript" src="' . PUBLIC_PATH . 'js/slidedeck.jquery.lite.js"></script>';
			
			//$this->view->loadFunctions = 'onLoad="load()"';*/
			
				   
			//$this->view->render('default/head');			
			//$this->view->render('default/header');
			$this->view->render('test');
			//$this->view->render('default/footer');
					
		}
					
	
	}

?>
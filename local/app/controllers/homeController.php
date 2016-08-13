<?php

	class HomeController extends Controller {
		
		public function __construct() {
			
			parent::__construct();	
			//Auth::handleLogin();
		
		}

		function index() {
			$this->loginscreen();			
		}

		function loginscreen() {
			
			$this->view->titulo = SITE_NAME. ' | login ';		

			$this->view->render('default/head-login');			
			$this->view->render('login');			
			$this->view->render('default/footer');

		}
	}
?>
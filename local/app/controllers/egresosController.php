<?php

	class egresosController extends Controller {
		
		public function __construct() {
			
			parent::__construct();	
			Auth::handleLogin();
			$this->view->userdata = $this->user->getUserdata();
		}

		function index() {	
			$this->comprobantes();
		}

		function comprobantes() {	

			User::checkSession();
			$this->view->title = makeTitle('Egresos');
			$this->view->render('egresos/list');
			
		}


	}
?>
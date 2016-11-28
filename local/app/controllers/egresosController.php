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
			$this->view->title 	= makeTitle('Egresos');
			$this->view->h3 	= 'Comprobantes de Egreso';
			$this->view->class 	= 'comprobantes';

			//Template info			
			$ruta = 'egresos/comprobantes/';
			$this->view->navpills	= $ruta.'menu';
			$this->view->head		= $ruta.'head';

			$this->makeList();
		}

		function nominas() {	

			User::checkSession();
			$this->view->title 	= makeTitle('Nóminas');
			$this->view->h3 	= 'Nóminas emitidas';
			$this->view->class 	= 'nominas';

			//Template info			
			$ruta = 'egresos/nominas/';
			$this->view->navpills	= $ruta.'menu';
			$this->view->head	= $ruta.'head';

			$this->makeList();			
		}

		function makeList(){
			$this->view->render('egresos/list');
		}

	}
?>
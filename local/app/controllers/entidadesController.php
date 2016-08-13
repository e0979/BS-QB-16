<?php

	class EntidadesController extends Controller {
		
		public function __construct() {
			
			parent::__construct();
			Auth::handleLogin();	
		
		}

		/*function agenda($what, $id ='') {
			switch ($what) {
				case 'cliente':
					$this->view->info = $this->model->getClienteId($id);
					$this->view->render('entidades/clientes/ficha');
					
					break;
				
				case 'proveedor':
					$this->view->info = $this->model->getProveedorId($id);
					$this->view->render('entidades/proveedores/ficha');
					
					break;
			}
			if ($id === '') {
				
			}
		}*/

	}

?>
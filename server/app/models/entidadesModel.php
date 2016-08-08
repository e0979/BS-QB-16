<?php

	class entidadesModel extends Model {
	
		
		public function __construct() {
			
			parent::__construct();
		}
	
		public function listClients() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."cliente ORDER BY razon_social");	
			
	    }
		
		public function listClientsbyId() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."cliente ORDER BY id ASC");	
			
	    }
		
		public function listProveedores() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."proveedor ORDER BY razon_social"	);	
			
	    }
		
		public function getClienteId($id) {

			$id = escape_value($id);

			return DB::query("SELECT * FROM ". DB_PREFIX ."cliente WHERE id=%s LIMIT 1", $id);	
			
	    }
		
		public function getProveedorId($id) {

			$id = escape_value($id);

			return DB::query("SELECT * FROM ". DB_PREFIX ."proveedor WHERE id=%s LIMIT 1", $id);	
			
	    }
		
		public function tellmebyRIF($tablename, $data) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."$tablename WHERE rif=%s", $data);	
			
	    }
		
		
		// For Lists JSON
		public function listProveedores_json($text ='') {
			
			$groups = DB::query("SELECT * FROM ". DB_PREFIX ."proveedor ORDER BY razon_social ASC");
			
			$final_list = array();
			
			if ($text !== '') {
				
				foreach ($groups as $proveedor) {				
					$final_list[] = array('value' => $proveedor['razon_social']	, 'text' => $proveedor['razon_social']);					
				}
				
			} else {
				
				foreach ($groups as $proveedor) {				
					$final_list[] = array('value' => $proveedor['id']	, 'text' => $proveedor['razon_social']);					
				}
			}
			
			return $final_list;			
			
		}
		
		public function listClientes_json($text ='') {
			
			$groups = DB::query("SELECT * FROM ". DB_PREFIX ."cliente ORDER BY razon_social ASC");
			
			$final_list = array();
			
			if ($text !== '') {
				
				foreach ($groups as $proveedor) {				
					$final_list[] = array('value' => $client['razon_social']	, 'text' => $client['razon_social']);					
				}
				
			} else {
							
				foreach ($groups as $client) {
					
					$final_list[] = array('value' => $client['id']	, 'text' => $client['razon_social']);
						
				}
			}
			return $final_list;			
			
		}
		
		/* EMPLEADOS */
		public function listEmpleados() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."empleados ORDER BY nombre");	
			
	    }
		
		public function getEmpleadobyId($id) {

			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."empleados WHERE cedula=%s LIMIT 1", $id);
			
	    }
		
		public function getEmpleadoProfile($id) {
			
			return DB::query("SELECT * FROM ". DB_PREFIX . "empleados_profile WHERE cedula=%s ORDER by id DESC LIMIT 1", $id);
		
		}
		
		
		
				
		
	
	}
?>	
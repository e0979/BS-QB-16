<?php

	class egresosModel extends Model {
	
		public function __construct() {
			
			parent::__construct();
		}
	
				
		public function listComprobantesEgreso() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."egresos_comprobantes ORDER BY id DESC");	
	    }
		public function listRetenciones(){
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."egresos_retenciones ORDER BY id DESC");
			
		}
		
		public function getComprobanteby($id, $by = 'id'){
			
			$id = escape_value($id);			
			return DB::query("SELECT * FROM ". DB_PREFIX ."egresos_comprobantes WHERE $by = $id LIMIT 1");
			
		}
		
		public function getRetencionby($id, $by = 'id'){
			
			$id = escape_value($id);			
			return DB::query("SELECT * FROM ". DB_PREFIX ."egresos_retenciones WHERE $by = $id LIMIT 1");
			
		}
		
		public function nextElement($id, $database) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."$database WHERE id = (select min(id) from ". DB_PREFIX ."$database where id > $id)");
		}
		
		public function prevElement($id, $database) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."$database WHERE id = (select max(id) from ". DB_PREFIX ."$database where id < $id)");
		}
		
		 
		 /* Nomina Related */		
		public function listNominas() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."egresos_nomina ORDER BY id DESC");	
	    }
		
		public function nominabyDate($data) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."egresos_nomina WHERE fecha_desde=%s", $data);	
			
	    }
	    public function nominabyId($data) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."egresos_nomina WHERE id=%s", $data);	
		}
		
		public function getnominaRecibosby($id, $by = 'id'){
			
			$id = escape_value($id);			
			return DB::query("SELECT * FROM ". DB_PREFIX ."egresos_nomina_recibos WHERE $by = $id");
			
		}
		
		public function getbyID($tablename, $id){
			
			$id = escape_value($id);			
			return DB::query("SELECT * FROM ". DB_PREFIX ."$tablename WHERE id = $id LIMIT 1");
			
		}
				

	}

?>
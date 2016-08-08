<?php

	class cobrosModel extends Model {
	
		public function __construct() {
			
			parent::__construct();
		}
		
		public function listFacturas() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."factura ORDER BY id DESC");	
			
	    }
		
		public function facturabyId($id) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."factura WHERE id =%s", $id);	
			
	    }
		public function camposFactura($parent_id) {
			
			$arrayCampos = array();
			
			$arrayCampos[0] = DB::query("SELECT * FROM ". DB_PREFIX ."fcampo_1  WHERE parent_id =%s", $parent_id);
			$arrayCampos[1] = DB::query("SELECT * FROM ". DB_PREFIX ."fcampo_2  WHERE parent_id =%s", $parent_id);
			$arrayCampos[2] = DB::query("SELECT * FROM ". DB_PREFIX ."fcampo_3  WHERE parent_id =%s", $parent_id);
			$arrayCampos[3] = DB::query("SELECT * FROM ". DB_PREFIX ."fcampo_4  WHERE parent_id =%s", $parent_id);
			$arrayCampos[4] = DB::query("SELECT * FROM ". DB_PREFIX ."fcampo_5  WHERE parent_id =%s", $parent_id);
			
			return $arrayCampos;	
			
	    }
		
		public function nextElement($id, $database) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."$database WHERE id = (select min(id) from ". DB_PREFIX ."$database where id > $id)");
		}
		
		public function prevElement($id, $database) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."$database WHERE id = (select max(id) from ". DB_PREFIX ."$database where id < $id)");
		}

	}

?>
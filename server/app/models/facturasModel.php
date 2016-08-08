<?php

	class facturasModel extends Model {
	
		
		public function __construct() {
			
			parent::__construct();
		}
	
		/*public function listClients() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."cliente WHERE status=%s ORDER BY razon_social", "activo");	
			
	    }
		
		public function listClientsbyId() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."cliente WHERE status=%s ORDER BY id ASC", "activo");	
			
	    }
		*/
		
		public function getFacturasbyDate($month, $year) {
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."factura WHERE mes=%s AND anio = %s AND tipo_nota ='factura' ORDER BY id  DESC", $month, $year);	
			
	    }
		public function getNotasDebito($month, $year) {
				
			return DB::query("SELECT * FROM ". DB_PREFIX ."factura WHERE mes=%s AND anio = %s AND tipo_nota ='debito' ORDER BY id  DESC", $month, $year);	
			
	    }
		public function getNotasCredito($month, $year) {
				
			return DB::query("SELECT * FROM ". DB_PREFIX ."factura WHERE mes=%s AND anio = %s AND tipo_nota ='credito' ORDER BY id  DESC", $month, $year);	
			
	    }
		
	}
?>	
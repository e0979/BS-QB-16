<?php

	class proyectosModel extends Model {
	
		
		public function __construct() {
			
			parent::__construct();
		}
	
		public function TipoProyectos() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."tipo_trabajo ORDER BY nombre");	
	    }
		
		public function PlanesPago() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."planes_pago ORDER BY nombre");	
	    }
		
		public function TiemposEntrega() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."tipo_entrega ORDER BY nombre");	
	    }		
		
	
	}
?>	
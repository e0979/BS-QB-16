<?php

	class impuestosModel extends Model {
	
		public function __construct() {
			
			parent::__construct();
		}
	
				
		public function listPlanillasIVA() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."iva_declaracion ORDER BY id DESC");	
	    }
		
		public function getPlanillaIVA($id) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."iva_declaracion WHERE id = %s", $id);
			
		}
		
		public function nextElement($id, $database) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."$database WHERE id = (select min(id) from ". DB_PREFIX ."$database where id > $id)");
		}
		
		public function prevElement($id, $database) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."$database WHERE id = (select max(id) from ". DB_PREFIX ."$database where id < $id)");
		}
		
		public function getPlanillaIVAbyDate($month, $year) {
						
			return DB::query("SELECT * FROM ". DB_PREFIX ."iva_declaracion WHERE mes = %s AND anio = %s", $month, $year);
			
		}
		
		public function getCompras() {
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."compras ORDER BY anio DESC, mes DESC, dia DESC");
			
		}
		
		public function getComprasRelated($id) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."compras WHERE planilla_asociada = %s AND declarada = 'si' AND aprobada !='no'", $id);
			
		}
		public function getComprasporDeclarar($month, $year) {
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."compras WHERE mes <= %s AND anio <= %s AND declarada = 'no' ORDER BY mes ASC, dia ASC", $month, $year);
		}
		
		public function getCompraby($id, $by = 'id'){
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."compras WHERE $by = $id LIMIT 1");
			
		}
		
		// Retenciones que Besign Recibió //
		public function getRetenciones() {
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."retenciones ORDER BY id DESC, anio DESC, mes DESC, dia DESC");
			
		}
		public function getRetencionby($id, $by = 'id'){
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."retenciones WHERE $by = $id LIMIT 1");
			
		}
		
		public function getRetencionesRelated($id) {
			
			$id = escape_value($id);
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."retenciones WHERE planilla_asociada = %s AND declarada = 'si'", $id);
			
		}
		
		public function getRetencionesporDeclarar($month, $year) {
			
			return DB::query("SELECT * FROM ". DB_PREFIX ."retenciones WHERE mes <= %s AND anio <= %s AND declarada != 'si' ORDER BY id DESC", $month, $year);
		}
		
		public function findMatch($string) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."presupuesto_condiciones where nota =%s LIMIT 1", $string);
	    }
		
		// For Lists JSON
		public function listPlanillas_json() {
			
			$groups = DB::query("SELECT * FROM ". DB_PREFIX ."iva_declaracion ORDER BY id DESC");
			
			$final_list = array();
						
			foreach ($groups as $planilla) {
				
				$text = $planilla['mes'] ."/".$planilla['anio']." (". $planilla['planilla'].")";
				
				$final_list[] = array('value' => $planilla['id']	, 'text' => $text);
					
			}
			return $final_list;			
			
		}
		
		
	
	}
?>	
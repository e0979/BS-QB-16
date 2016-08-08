<?php

	class presupuestosModel extends Model {
	
		public function __construct() {
			
			parent::__construct();
		}
	
				
		public function getAllPresupuestos($orderby = 'id', $asc = 'ASC') {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."presupuesto ORDER BY $orderby $asc");
		}
		
		public function listCondiciones() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."presupuesto_condiciones ORDER BY nota");	
	    }
		
		public function findMatch($string) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."presupuesto_condiciones where nota =%s LIMIT 1", $string);
	    }
		
		public function getPresupuestosStatus() {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."presupuesto_status ");
			
		}
		
		public function InfoStatus($id) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."presupuesto_status where id=%i",$id);
		}
		
		public function getPresupuesto($id) {
		
			return DB::query("SELECT presupuesto.*,cliente.rif,cliente.razon_social,
								cliente.direccion_fisica,cliente.telefono FROM ". DB_PREFIX ."presupuesto
								inner join ". DB_PREFIX ."cliente on ". DB_PREFIX ."cliente.id=". DB_PREFIX ."presupuesto.id_cliente
								 where ". DB_PREFIX ."presupuesto.id=%i",$id);
		}
		
		public function getPresupuestoCampo($id,$campo) {
				return DB::query("SELECT ". DB_PREFIX ."campo_$campo.* FROM ". DB_PREFIX ."campo_$campo 
				inner join ". DB_PREFIX ."presupuesto on ". DB_PREFIX ."presupuesto.id=". DB_PREFIX ."campo_$campo.parent_id and presupuesto.id=%i",$id);
		}
		public function getPresupuestoPlanPago($id) {
			return DB::query("SELECT * FROM ". DB_PREFIX ."planes_pago where id=%i",$id);
		}
		public function getPresupuestoTipoEntrega($id) {
			return DB::query("SELECT * FROM ". DB_PREFIX ."tipo_entrega where id=%i",$id);
		}
		
		public function getMail($rif) {
			//$rif="18062516";
			return DB::queryOneField("email","SELECT * FROM ". DB_PREFIX ."user_profile where rif=%s",$rif);
		}
		
	}
?>	
<?php

	class dominiosModel extends Model {
	
		public function __construct() {
			
			parent::__construct();
		}
	
				
		public function getAllDomains($orderby = 'id', $asc = 'ASC') {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."dominios ORDER BY $orderby $asc");
					
						
	    }
		public function getDomain($id) {
			
			$id = escape_value($id);		
			return DB::query("SELECT * FROM ". DB_PREFIX ."dominios WHERE id = $id LIMIT 1");			
						
	    }
		
		public function getDomainFieldsExpiring($date) {
			
				return DB::query("SELECT * FROM ". DB_PREFIX ."dominios_fields WHERE field = 'renewal_date' AND value LIKE '%$date%' ORDER BY id DESC");	
				
	    }
		
		
		public function getDomainRenewal($domain_id) {
				
			return DB::query("SELECT * FROM ". DB_PREFIX ."dominios_fields WHERE domain_id = $domain_id AND field = 'renewal_date' ORDER BY id DESC LIMIT 1");	
		
		}
		
		public function getDomainRenewalAnswer($domain_id, $year) {
				
			return DB::query("SELECT * FROM ". DB_PREFIX ."dominios_fields WHERE domain_id = $domain_id AND field = 'renewal' AND year = $year LIMIT 1");	
		
		}
		
		
		public function checkRegistered($value) {
			
			//$value = escape_value($value);		
			return DB::query("SELECT * FROM ". DB_PREFIX ."dominios WHERE domain LIKE '%$value'");			
						
	    }
		
		/*
		 * public function getDomainFields($id, $orderby = 'id', $asc = 'DESC') {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."dominios_fields WHERE domain_id = $id GROUP BY year ORDER BY $orderby $asc");	
			
			//SELECT * FROM dominios_fields GROUP BY year	
				
				
			//	SELECT DISTINCT year FROM dominios_fields GROUP BY year LIMIT 0 , 30		
	    }
		*/
		
		public function getYearGroups($id, $orderby = 'id', $asc = 'DESC') {
		
			return DB::query("SELECT DISTINCT year FROM ". DB_PREFIX ."dominios_fields WHERE domain_id = $id GROUP BY year ORDER BY $orderby $asc");	
			
			
	    }
		
		//By year
		public function getDomainFields($id, $year) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."dominios_fields WHERE domain_id = $id AND year = $year ORDER BY id DESC");	
				
	    }
		
		public function getDomainField($id, $year, $field) {
		
			return DB::query("SELECT * FROM ". DB_PREFIX ."dominios_fields WHERE domain_id = $id AND year = $year AND field = $field ORDER BY id DESC");	
				
	    }
		
		public function provider_registrant() {
			
			$groups = DB::query("SELECT * FROM ". DB_PREFIX ."dominios_provider_registrant ORDER BY id DESC");
			
			$final_list = array();
			
			$final_list[] = array('value' => 'Cliente'	, 'text' => 'Lo maneja el cliente');
			
						
			foreach ($groups as $proveedor) {
				
				$final_list[] = array('value' => $proveedor['publicname']	, 'text' => $proveedor['publicname']);
					
			}
			return $final_list;			
			
		}
		
		public function provider_hosting() {
			
			$groups = DB::query("SELECT * FROM ". DB_PREFIX ."dominios_provider_hosting ORDER BY id DESC");
			
			$final_list = array();
			$final_list[] = array('value' => 'Cliente'	, 'text' => 'Lo maneja el cliente');
			$final_list[] = array('value' => 'NULL'	, 'text' => 'Sólo dominio, no posee hosting');
			$final_list[] = array('value' => 'redireccionado'	, 'text' => 'Redirecciona a otro dominio');
			
			foreach ($groups as $proveedor) {
				
				$final_list[] = array('value' => $proveedor['publicname']	, 'text' => $proveedor['publicname']);
					
			}
			
			
			return $final_list;			
			
		}
		public function provider_mailserver() {
			
			$groups = DB::query("SELECT * FROM ". DB_PREFIX ."dominios_provider_mailserver ORDER BY id DESC");
			
			$final_list = array();
			
			foreach ($groups as $proveedor) {
				
				$final_list[] = array('value' => $proveedor['fieldname']	, 'text' => $proveedor['publicname']);
					
			}			
			
			return $final_list;			
			
		}
		
		
		
		
	
	}
?>	
<?php
	class ApiQuery {
		//Modelo
		
		public function __construct() {
			
	
		}
		
	
		public function autocomplete($what="all", $string){
			
			switch ($what) {
				case 'practices':		
								
					return DB::query("	SELECT * FROM  (
										
					 					SELECT clinic.name AS label, clinic.id AS id_value, 'clinic_name' AS type FROM clinic UNION 
					 					SELECT clinic.address AS label, clinic.id AS id_value, 'clinic_address' AS type FROM clinic
					 					) AS autocomplete_table  WHERE label LIKE '%$string%';
					 			");
							
					break;		
							
				case 'all':
					
					return DB::query("	SELECT * FROM  (
										SELECT doctor.name AS label, 'doctor_name' AS type FROM doctor UNION 
										SELECT doctor.lastname AS label, 'doctor_name' AS type FROM doctor UNION 
					 					SELECT clinic.name AS label, 'clinic_name' FROM clinic UNION 
					 					SELECT clinic.address AS label, 'clinic_address' FROM clinic UNION
					 					SELECT specialty.name AS label, 'doctor_specialty' FROM specialty
					 					)AS autocomplete_table  WHERE label LIKE '%$string%';
					 			");
								
					break;
			}
	
			
		}
	
		public function search($string){
	
			return DB::query("	SELECT * FROM  (
									 SELECT id, doctor.name AS term, 'doctor' AS in_table FROM doctor UNION 
									 SELECT id, doctor.lastname AS term, 'doctor' AS in_table FROM doctor UNION 
				 					 SELECT id, clinic.name AS term, 'clinic' FROM clinic UNION 
				 					 SELECT id, clinic.address AS term, 'clinic' FROM clinic UNION
				 					 SELECT id, specialty.name AS term, 'specialty' FROM specialty
				 					 ) AS autocomplete_table " . $string . " ORDER BY in_table;
				 				 ");
		}
		
		
	
		
		//************ ENTIDADES ///		
		public function get($what, $param = "", $id = ""){
			$what = escape_value($what);
			$param = escape_value($param);
			$id = escape_value($id);
			$limit = "";

			if (!empty($param)){
				$limit = "LIMIT 1";
				$where = "WHERE $what.$param=$id";
			}
			
			if ($what == 'egresos_comprobantes'){
				
				return DB::query("SELECT proveedor.razon_social, 
										 proveedor.id,
										 egresos_comprobantes.*
					FROM egresos_comprobantes 
					INNER JOIN proveedor ON proveedor.id= egresos_comprobantes.proveedor_id $where $limit");
				

			} else {
				if ($param == "") {				
					// Get ALL
					return DB::query("SELECT * FROM " . DB_PREFIX . "$what ");
				} else {
					if (is_numeric($id)) {
						// Get By A Parameter
						return DB::query("SELECT * FROM " . DB_PREFIX . "$what WHERE $param=%i $limit", $id);
					} else {
						// Get By A Parameter
						return DB::query("SELECT * FROM " . DB_PREFIX . "$what WHERE $param=%s $limit", $id);
					}
									
				}
			}


		}

		


		
		
		

	}
?>
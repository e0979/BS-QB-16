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

			DB::debugMode(TRUE);
			if ($what == 'egresos_comprobantes'){
				//return DB::query("SELECT ". DB_PREFIX . "egresos_comprobantes.*, " . DB_PREFIX . "proveedor.razon_social AS razonsocial  FROM " . DB_PREFIX . "egresos_comprobantes INNER JOIN " . DB_PREFIX . "proveedor ON " . DB_PREFIX . "proveedor.id" . DB_PREFIX . "egresos_comprobantes.proveedor_id WHERE $by LIKE '%".$param."%' ORDER BY $by $order");
				
				//return DB::query("SELECT doctor_practice.id, doctor_practice.id_doctor, doctor_practice.id_clinic, clinic.name, clinic.address FROM " . DB_PREFIX . "doctor_practice INNER JOIN clinic ON id_clinic=clinic.id WHERE doctor_practice.id_clinic=%i", $id);
				
				//return DB::query("SELECT * egresos_comprobantes.*, proveedor.id, proveedor.razon_social FROM egresos_comprobantes INNER JOIN proveedor ON proveedor_id=proveedor.id");

				/*return DB::query("SELECT * FROM (
						SELECT id, razon_social AS razonsocial, 'prove' AS in_table FROM proveedor UNION
					) AS comprobantes_table ORDER BY in_table");
*/
				/*return DB::query("SELECT egresos_comprobantes.id, egresos_comprobantes.proveedor_id, proveedor.razon_social, proveedor.id
					FROM egresos_comprobantes
					   JOIN proveedor 
					      ON proveedor.id = egresos_comprobantes.proveedor_id
					ORDER BY proveedor.razon_social ASC LIMIT 2
					");*/
				/*return DB::query("SELECT task.id, task.razon_social, proj.id, proj.proveedor_id
FROM proveedor task, egresos_comprobantes proj
WHERE proj.proveedor_id=task.id LIMIT 2");*/

				return DB::query("SELECT
								    egresos_comprobantes.proveedor_id,
								    proveedor.razon_social AS XName,
								    proveedor.id AS YName
								FROM egresos_comprobantes AS egresos_comprobantes
								    INNER JOIN proveedor AS proveedorY ON proveedorY.id = egresos_comprobantes.proveedor_id LIMIT 2"); 
				/*
					select
    T1.somedata,
    T1.somedata1,
    T2X.name as XName,
    T2Y.name as YName
from T1 as T1
    inner join T2 as T2X on T2X.id = T1.X
    inner join T2 as T2Y on T2Y.id = T1.Y
				*/

			} else {

				if ($param == "") {				
					// Get ALL
					return DB::query("SELECT * FROM " . DB_PREFIX . "$what ");
				} else {
					// Get By A Parameter
					return DB::query("SELECT * FROM " . DB_PREFIX . "$what WHERE $param=%i LIMIT 1", $id);				
				}
			}


		}


		
		
		

	}
?>
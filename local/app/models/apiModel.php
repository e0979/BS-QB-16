<?
	class apiModel extends Model {
	
		public function __construct() {
	
			parent::__construct();
		}
		
		public function search_list($special_param, $name="", $city="", $order='ASC'){	
			return DB::query("SELECT * FROM " . DB_PREFIX . "doctor
			inner join " . DB_PREFIX . "doctor_practice on doctor." . DB_PREFIX . "id_doctor=" . DB_PREFIX . "doctor_practice.id_doctor
			inner join " . DB_PREFIX . "clinic on " . DB_PREFIX . "clinic.id=" . DB_PREFIX . "doctor_practice.id_clinic
			inner join " . DB_PREFIX . "specialty on " . DB_PREFIX . "specialty.id= " . DB_PREFIX . "doctor.specialty
			where " . DB_PREFIX . "specialty like '%%s%'  and id_city=%s and " . DB_PREFIX . "doctor.name like '%%s%'
			ORDER BY $by $order",$specialty,$city,$specialty);
		}
		
		
		/*public function autocomplete($string){
			
			return DB::query("	SELECT * FROM  (
								SELECT doctor.name AS label, 'doctor_name' AS type FROM doctor UNION 
			 					SELECT clinic.name AS label, 'clinic_name' FROM clinic UNION 
			 					SELECT clinic.address AS label, 'clinic_address' FROM clinic UNION
			 					SELECT specialty.name AS label, 'doctor_specialty' FROM specialty
			 					)AS autocomplete_table  WHERE label LIKE '%$string%';
			 				");			
		}
		public function search($string) {
			
			return DB::query("SELECT * FROM  (
								SELECT id, doctor.name AS term, 'doctor' AS in_table FROM doctor UNION 
			 					SELECT id, clinic.name AS term, 'clinic' FROM clinic UNION 
			 					SELECT id, clinic.address AS term, 'clinic' FROM clinic UNION
			 					SELECT id, specialty.name AS term, 'specialty' FROM specialty
			 					) AS autocomplete_table ".$string." ORDER BY in_table;
			 				");
		}*/
	}
?>
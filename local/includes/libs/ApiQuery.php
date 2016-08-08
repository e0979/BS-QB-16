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
		
		
	
		
		//************ PATIENT ///
		public function getPatientBy($param = "id", $id){
			
			$param = escape_value($param);
			$id = escape_value($id);
			return DB::query("SELECT * FROM " . DB_PREFIX . "patient WHERE id=%s",$id);
		}
	// ***** 
		
		public function checkFreeDay($practice_schedule,$date){
			 DB::query("SELECT * FROM " .DB_PREFIX . "appointments
			where date_appointment =%s and id_practice_schedule=%i",$date,$practice_schedule);
			 return$counter = DB::count();
		}
		//
		public function getAppointments($by="id_doctor", $param="", $order="ASC") {
						return DB::query("SELECT * FROM ". DB_PREFIX . "appointments WHERE $by =$param ORDER BY id $order");
		}
		public function getAppointmentsDate($by="id_doctor", $param="", $order="ASC") {
			return DB::query("SELECT date FROM ". DB_PREFIX . "appointments WHERE $by =$param GROUP BY date ORDER BY date $order");
		}
		public function getAppointmentsByDate($id, $date, $id_clinic) {
			return DB::query("SELECT * FROM ". DB_PREFIX . "appointments WHERE id_doctor = $id AND date = '".$date."' AND id_clinic ='".$id_clinic."'  ORDER BY id ASC" );
		}
		public function getAppointment($id) {
			return DB::query("SELECT * FROM ". DB_PREFIX . "appointments WHERE id='$id'");
		}
		
		
		public function listSpecialty($by='name', $order='ASC') {	
			return DB::query("SELECT * FROM " . DB_PREFIX . "specialty ORDER BY $by $order");
		}
		
		public function list_avaliable_days($practice){
			return DB::query("SELECT * FROM " . DB_PREFIX . "doctor_practice_schedule where id_practice=%i",$practice);
		}
	
	public function listPracticeDate($practice,$date) {
			return DB::queryFirstRow("SELECT * FROM " . DB_PREFIX . "doctor_practice_schedule 
			where day =DATE_FORMAT(%s,'%W') and id_practice=%i",$date,$practice);			
		}	
		public function listCenterName($id) {
			
			return DB::queryFirstRow("select name,address from  " . DB_PREFIX . "clinic where id=%i",$id);
		}
		
		public function getPractice($id_practice) {
			return DB::query("SELECT * FROM " . DB_PREFIX . "doctor_practice WHERE id=%i", $id_practice);
		}
		//***************************//		
		//Reformuladas:
		
		public function getDoctors($by="name", $param="", $order="ASC") {
			return DB::query("SELECT ". DB_PREFIX . "doctor.*, " . DB_PREFIX . "specialty.name AS specialty  FROM " . DB_PREFIX . "doctor INNER JOIN " . DB_PREFIX . "specialty ON " . DB_PREFIX . "specialty.id=" . DB_PREFIX . "doctor.specialty WHERE $by LIKE '%".$param."%' ORDER BY $by $order");
		
		}
		public function getDoctorPracticesFULL($id) {
			return DB::query("SELECT * FROM " . DB_PREFIX . "doctor_practice INNER JOIN " . DB_PREFIX . "doctor_practice_schedule ON " . DB_PREFIX . "doctor_practice.id=id_practice INNER JOIN clinic ON id_clinic=clinic.id WHERE id_doctor=%i", $id);
		}
		  
		public function getDoctorPractices($id) {
			return DB::query("SELECT doctor_practice.id, 
							doctor_practice.id_doctor, 
							doctor_practice.id_clinic, 
							clinic.name, 
							clinic.address FROM " . DB_PREFIX . "doctor_practice 
							INNER JOIN clinic ON id_clinic=clinic.id WHERE doctor_practice.id_doctor=%i", $id);
		}
		public function getDoctorPractice($id, $id_clinic) {
			return DB::query("SELECT doctor_practice.id, doctor_practice.id_doctor, doctor_practice.id_clinic, clinic.name, clinic.address FROM " . DB_PREFIX . "doctor_practice INNER JOIN clinic ON id_clinic=clinic.id WHERE doctor_practice.id_doctor=%i AND doctor_practice.id_clinic=%i", $id, $id_clinic);
		}
		
		public function getDoctorPracticesSchedule($id_practice) {
			return DB::query("SELECT * FROM " . DB_PREFIX . "doctor_practice_schedule WHERE id_practice=%i", $id_practice);
		}
		public function getDoctorPracticesScheduleExceptions($id_practice) {
			return DB::query("SELECT * FROM " . DB_PREFIX . "doctor_practice_schedule_exceptions WHERE id_practice=%i", $id_practice);
		}
		
		
		
		//***************************//
		//Search by
		public function getDoctorsByPractice($id) {
			return DB::query("SELECT doctor_practice.id, doctor_practice.id_doctor, doctor_practice.id_clinic, clinic.name, clinic.address FROM " . DB_PREFIX . "doctor_practice INNER JOIN clinic ON id_clinic=clinic.id WHERE doctor_practice.id_clinic=%i", $id);
		
		}
		public function getDoctorsBy($param, $id) {
			$param= escape_value($param);
			$id = escape_value($id);
			return DB::query("SELECT ". DB_PREFIX . "doctor.*, " . DB_PREFIX . "specialty.name AS specialty  FROM " . DB_PREFIX . "doctor INNER JOIN " . DB_PREFIX . "specialty ON " . DB_PREFIX . "specialty.id=" . DB_PREFIX . "doctor.specialty WHERE ".$param."=". $id);
		
//			return DB::query("SELECT * FROM doctor WHERE id=
		}
	
		// public function listUsers($by = 'username', $order = '') {
			// return DB::query("SELECT * FROM " . DB_PREFIX . "users ORDER BY $by $order");
		// }
// 	
		// public function getUser($id, $by = 'username') {
			// return DB::query("SELECT * FROM " . DB_PREFIX . "users WHERE $by=%s LIMIT 1", $id);
		// }
// 	
		// public function getUserProfile($table, $id, $by = 'username') {
			// return DB::query("SELECT * FROM " . DB_PREFIX . "$table WHERE $by=%s LIMIT 1", $id);
		// }


	}
?>
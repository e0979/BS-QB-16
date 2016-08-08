<?php
	class apiController extends Controller {
		public function __construct() {
	
			parent::__construct();
		}
		// AUTOCOMPLETE: This function is invoked when user is writing fields related to : Doctor's name, Clinics, Addresses and Doctor's Speciality
		public function autocomplete($print="json", $what="all") {
			
			
			$string = trim($_GET['term']);	
			
			//TODO escape values	
			$this -> api -> autocomplete($print, $what, $string);
		}
		// SEARCH: Main search processing is done with this function
		public function search($type = "other", $terms, $location = "VE") {

			$this -> api -> search($type, $terms, $location);
		}
		//PATIENT/$ID
		public function patient	( $print="json", $id) {
			$this->api->patient($print, $id);
		}
		
		
		//DOCTOR/$ID
		public function doctor($print="json", $id ) {
			$this -> api -> doctor($print, $id);
		}
		
		public function doctors( $print="json", $type, $value, $location = "VE"){
			$this -> api -> doctors($print , $type, $value);
		}
		
		//DOCTOR/$ID/PRACTICES/$ID
		public function practices ($print = "json", $parameter = "doctor", $id) {
			$this->api->practices ($print, $parameter, $id);
		}
				
		
		public function appointments($print="json", $by = "doctor", $id, $second_parameter = "", $practice_id = "", $for_date = "", $to_date = ""){
			//TODO definir el envio del 1er parametro
			$this -> api -> appointments($print, $by, $id);
		}
		
		//APPOINTMENTS/DOCTOR/$ID/RANGE : To Get Latest Doctor's Appointments grouped by day?
		// public function appointments ($by = "doctor", $id, $second_parameter ="", $practice_id="", $for_date="", $to_date="") {
		//
		// $id= escape_value($id);
		//
		// if (!empty($second_parameter)) {
		// $second_parameter	= escape_value($second_parameter);
		// $practice_id		= escape_value($practice_id);
		// $for_date			= escape_value($for_date);
		// $to_date			= escape_value($to_date);
		//
		// $this->loadModel('appointments');
		// $array_appointments = appointmentsModel::getAppointmentsByDate( $id, $for_date, $practice_id);
		// $this->loadModel('doctor');
		// $array_practices = doctorModel::getDoctorPractice($id, $practice_id);
		// $practiceFields = DB::columnList('clinic');
		// $this->loadModel('patient');
		// $array_final["empty"] = 0;
		// $array_final['dates'][0]['date_string'] = $for_date;
		//
		// foreach ($practiceFields as $practicefield) {
		// $array_final['dates'][0]['practice'][0][$practicefield] = $array_practices[0][$practicefield];
		// }
		//
		// $a=0;
		// foreach ($array_appointments as $appointment) {
		// $array_patient_data = patientModel::getPatientBy("id", $appointment['id_patient']);
		// $appointment['patient_data'] = $array_patient_data;
		// $array_final['dates'][0]['practice'][0]['appointments'][$a] = $appointment;
		// $a++;
		// }
		// echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
		//
		// } else {
		// $this->loadModel('doctor');
		// $array_practices = doctorModel::getDoctorPractices($id);
		// $practiceFields = DB::columnList('clinic');
		// //print_r($array_practices);
		// $this->loadModel('appointments');
		// $array_dates = appointmentsModel::getAppointmentsDate("id_doctor", $id, "ASC");
		// //Later use inside
		// $this->loadModel('patient');
		//
		// if(empty($array_dates)){
		// $response["tag"] = "appointments";
		// $response["empty"] = 1;
		// $response["response"] = NO_APPOINTMENTS_DATE;
		// echo json_encode($response);
		//
		// } else {
		//
		// $i=0;
		// $array_final["empty"] = 0;
		// foreach ($array_dates as $date) {
		//
		// $date_array['date_string'] = $date["date"];
		// //$array_final['appointments'][$i]['date'] = $date_array;
		// $array_final['dates'][$i] = $date_array;
		//
		// $p=0;
		// foreach ($array_practices as $practice) {
		// $array_appointments = appointmentsModel::getAppointmentsByDate( $id, $date["date"], $practice["id"]);
		//
		//
		// foreach ($practiceFields as $practicefield) {
		// $array_final['dates'][$i]['practice'][$p][$practicefield] = $practice[$practicefield];
		// //$array_final['appointments'][$i]['date']['practice'][$p][$practicefield] = $practice[$practicefield];
		// }
		//
		//
		// //	$array_final['appointments'][$i]['date']['practice'][$p]['practice_id'] = $practice['id'];
		// //$array_final['appointments'][$i]['date'][$date["date"]]['practice'][$practice['id']] = $date["date"];
		// $a=0;
		// foreach ($array_appointments as $appointment) {
		//
		//
		//
		// $array_patient_data = ApiQuery::getPatientBy("id", $appointment['id_patient']);
		// $appointment['patient_data'] = $array_patient_data;
		//
		// $array_final['dates'][$i]['practice'][$p]['appointments'][$a] = $appointment;
		//
		// $a++;
		// }
		// $p++;
		// }
		// $i++;
		// }
		//
		// echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
		// }
		// } //end if emtpy second parameter
		//
		// }
		//Appointments/doctor/22/practice/11/2014-02-09
	
		/*public function appointment ($by = "doctor", $id, $second_parameter ="", $practice_id="", $for_date="", $to_date="") {
	
		 $id					= escape_value($id);
		 $second_parameter	= escape_value($second_parameter);
		 $practice_id		= escape_value($practice_id);
		 $for_date			= escape_value($for_date);
		 $to_date			= escape_value($to_date);
	
		 $this->loadModel('appointments');
		 $array_appointments = appointmentsModel::getAppointmentsByDate( $id, $for_date, $practice_id);
		 $this->loadModel('doctor');
		 $array_practices = doctorModel::getDoctorPractice($id, $practice_id);
		 $practiceFields = DB::columnList('clinic');
		 $this->loadModel('patient');
		 $array_final["empty"] = 0;
		 $array_final['dates'][0]['date_string'] = $for_date;
	
		 foreach ($practiceFields as $practicefield) {
		 $array_final['dates'][0]['practice'][0][$practicefield] = $array_practices[0][$practicefield];
		 }
	
		 $a=0;
		 foreach ($array_appointments as $appointment) {
		 $array_patient_data = patientModel::getPatientBy("id", $appointment['id_patient']);
		 $appointment['patient_data'] = $array_patient_data;
		 $array_final['dates'][0]['practice'][0]['appointments'][$a] = $appointment;
		 $a++;
		 }
		 echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
		 }*/
	
		//DOCTOR/$ID/: To get the object for 1 doctor
	
		/*	public function doctor ($id) {
	
		 $id = escape_value($id);
	
		 $this->loadModel('doctor');
		 $array_doctors = doctorModel::getDoctors('doctor.id', $id);
		 //get all columns from Table
		 $profileFields = DB::columnList('doctor');
		 $practiceFields = DB::columnList('clinic');
	
		 $i=0;
		 foreach($array_doctors as $doctor) {
	
		 foreach ($profileFields as $field) {
		 $array_final['doctors'][$i][$field] = $doctor[$field];
		 }
	
		 $array_practices = doctorModel::getDoctorPractices($doctor["id"]);
	
		 $p=0;
		 foreach ($array_practices as $practice) {
	
		 foreach ($practiceFields as $practicefield) {
		 $array_final['doctors'][$i]['practice'][$p][$practicefield] = $practice[$practicefield];
		 }
		 $array_schedules = doctorModel::getDoctorPracticesSchedule($practice["id"]);
		 //$array_final['doctors'][$i]['practice'][$p]	= $practice;
		 $s=0;
		 foreach ($array_schedules as $schedule) {
	
		 $array_final['doctors'][$i]['practice'][$p]['schedule'][$s]	= $schedule;
		 $schedule['day'] = substr($schedule['day'], 0, -2);
		 $array_final['doctors'][$i]['practice'][$p]['schedule'][$s]['day']	= $schedule['day'];
	
		 $ini_schedule = substr($schedule['ini_schedule'], 0, 2);
	
		 if ($ini_schedule > 01 &&  $ini_schedule < 13 ) {
		 $icon = '<i class="fa fa-sun-o"></i> ';
		 } else {
		 $icon = '<i class="fa fa-moon-o"></i> ';
		 }
	
		 $schedule['ini_schedule'] = $icon. $schedule['ini_schedule'];
		 $array_final['doctors'][$i]['practice'][$p]['schedule'][$s]['ini_schedule']	= $schedule['ini_schedule'];
	
		 $s++;
		 }
		 $p++;
		 }
		 $i++;
		 }
	
		 echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
	
		 } */
	
		//This function is likely to be deleted
	
		/*public function doctors ($type, $value, $location = "VE") {
	
		 $this->loadModel('doctor');
		 $array_doctors = doctorModel::getDoctors('doctor.name', $value);
		 //get all columns from Table
		 $profileFields = DB::columnList('doctor');
		 $practiceFields = DB::columnList('clinic');
	
		 $i=0;
		 foreach($array_doctors as $doctor) {
	
		 foreach ($profileFields as $field) {
		 $array_final['doctors'][$i][$field] = $doctor[$field];
		 }
	
		 $array_practices = doctorModel::getDoctorPractices($doctor["id"]);
	
		 $p=0;
		 foreach ($array_practices as $practice) {
	
		 foreach ($practiceFields as $practicefield) {
		 $array_final['doctors'][$i]['practice'][$p][$practicefield] = $practice[$practicefield];
		 }
		 $array_schedules = doctorModel::getDoctorPracticesSchedule($practice["id"]);
		 //$array_final['doctors'][$i]['practice'][$p]	= $practice;
		 $s=0;
		 foreach ($array_schedules as $schedule) {
	
		 $array_final['doctors'][$i]['practice'][$p]['schedule'][$s]	= $schedule;
		 $schedule['day'] = substr($schedule['day'], 0, -2);
		 $array_final['doctors'][$i]['practice'][$p]['schedule'][$s]['day']	= $schedule['day'];
	
		 $ini_schedule = substr($schedule['ini_schedule'], 0, 2);
	
		 if ($ini_schedule > 01 &&  $ini_schedule < 13 ) {
		 $icon = '<i class="fa fa-sun-o"></i> ';
		 } else {
		 $icon = '<i class="fa fa-moon-o"></i> ';
		 }
	
		 $schedule['ini_schedule'] = $icon. $schedule['ini_schedule'];
		 $array_final['doctors'][$i]['practice'][$p]['schedule'][$s]['ini_schedule']	= $schedule['ini_schedule'];
	
		 $s++;
		 }
		 $p++;
		 }
		 $i++;
		 }
		 echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
		 }*/
	}
?>
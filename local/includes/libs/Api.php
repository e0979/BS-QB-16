<?php
class Api extends ApiQuery {

	public function __construct() {

	}

	

	// AUTOCOMPLETE: This function is invoked when user is writing fields related to : Doctor's name, Clinics, Addresses and Doctor's Speciality
	public function autocomplete($print = "json", $what="all", $string) {

		//	$string = trim($_GET['term']);
		/*switch ($what) {
			case 'practices':
				$query = ApiQuery::autocomplete($what, $string);
				break;
			
			case "all":
				$query = ApiQuery::autocomplete($string);
				break;
		}*/
		$query = ApiQuery::autocomplete($what, $string);
		
		if ($print == 'json') {
			echo json_encode($query, JSON_UNESCAPED_UNICODE);
		} else {//modo "array"
			return $array_final;
		}

	}

	

	
	
	
	public function get($print = "json", $what, $param, $id, $data = "false") {
	
		$what = escape_value($what);
		$id = escape_value($id);
		$param = escape_value($param);

		$array_entity = ApiQuery::get($what, $param, $id);
		$profileFields = DB::columnList($what);

		$i = 0;
		if ($data == "true") {
			//This would be used for jquery.DataTable to convert array to 'data'
			$what = "data"; 
		} 
		foreach ($array_entity as $Entity) {
			foreach ($profileFields as $field) {
				$array_final[$what][$i][$field] = $Entity[$field];
				
			}
			$i++;
		}

		if ($print == 'json') {
			echo json_encode($array_final, JSON_UNESCAPED_UNICODE);
		} else {//modo "array"
			return $array_final;
		}
	}
	
}
?>
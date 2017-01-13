<?php
	class apiController extends Controller {
		public function __construct() {
	
			parent::__construct();
		}
		// AUTOCOMPLETE: This function is invoked when user is writing fields related to : Doctor's name, Clinics, Addresses and Doctor's Speciality
		/*public function autocomplete($print="json", $what="all") {
			
			
			$string = trim($_GET['term']);	
			
			//TODO escape values	
			$this -> api -> autocomplete($print, $what, $string);
		}
		// SEARCH: Main search processing is done with this function
		public function search($type = "other", $terms, $location = "VE") {

			$this -> api -> search($type, $terms, $location);
		}*/

		public function get($print = "json", $what, $param, $id, $data = "false") {
			//For Get All, leave $param and $id empty
			$this->api->get($print, $what, $param, $id, $data);
		}


		public function edit(){

			$pk = escape_value($_POST['pk']);
			$value = escape_value($_POST['value']);
			
			$parts = explode( '-', $pk );
			$tablename =escape_value($parts[0]);
			$fieldname = escape_value($parts[1]);
			$id = escape_value($parts[2]);
			//if not by ID, something else
			if (empty($parts[3])) {
				$by = 'id';			
			} else {
				$by = escape_value($parts[3]);
			}

			$vars = array(); //arrayModificacion
			$vars[$fieldname] = $value;
				
			$insert = DB::update( DB_PREFIX . $tablename, $vars, $by."=%s", $id);	

			return $insert;
		}

		public function check ($what, $param = "") {
			
			$value = escape_value($_POST['rif']);			
			$response = ApiQuery::get($what, $param, $value);
			
			if (empty($response)) {				
			    echo 'true';
			}
			else {
			    echo 'false';
			}			

		}
		
	}
?>
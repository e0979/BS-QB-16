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


		
		
	}
?>
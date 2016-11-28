<?php
	//Main anti XSS function
	function escape_value($data) {
		/*if (ini_get('magic_quotes_gpc')) {
			$data = stripslashes($data);
		}
		$data = strip_tags($data, '<p><a><br>');
		//use this if local
		return mysql_real_escape_string($data);
		//use this for server
		//return mysql_escape_string($data); 
		*/
		return $data;
	}
	
	function create_slug($data) {
		$search = explode(',','&iacute;,&eacute;,&aacute;,&oacute;,&uacute;,&ntilde;,&aacute;,Á,É,Í,Ó,Ú,á,é,í,ó,ú,ñ,#,.,@, ,');
		$replace = explode(",","i,e,a,o,u,n,a,A,E,I,O,U,a,e,i,o,u,n,,_,_,-");
		$data = str_replace($search, $replace, $data);
		return $data;
	}
	
	//Replace commas with dot, for numerical Values
	function pointforcomma($data){
		$data = str_replace(",", ".", $data);
		return $data;	
	}
	
	function email($value){
		if (required($value)){	
			$valid=filter_var($value,FILTER_VALIDATE_EMAIL);
			return $valid;
		}else{
			return false;
		 }
	}
	
	function integer($value){
		if (required($value)){
			return	$valid=is_int(intval($value) );
		}else{
			return false;
		 }
		
	}
	
	function required($value){
		$valid=!empty($value);
		return $valid;
	}
	
	function getPage() {
		$current = explode("/",$_SERVER['REQUEST_URI']);
		if (end($current) == "") {
			return "dashboard";
		} else {
			return end($current);	
		}
	}

	
	function stringDate($date)
	{	if (required($date)){
	    	$d = DateTime::createFromFormat('Y-m-d', $date);
	    	return $d && $d->format('Y-m-d') == $date;
		}else{
			return false;
		 }
	}

	/*
	 * Builds array with Hours Range
	 * http://stackoverflow.com/questions/3903317/how-can-i-make-an-array-of-times-with-half-hour-intervals
	 * EXAMPLE: 
	 * Every 15 Minutes, All Day Long
	 * $range = hoursRange( 0, 86400, 60 * 15 );
	 * 
	 * EXAMPLE 2: 
	 * Every 30 Minutes from 8 AM - 5 PM, using Custom Time Format
	 * $range2 = hoursRange( 28800, 61200, 60 * 30, 'h:i a' );
	 */
	 function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
		$times = array();
			
		if ( empty( $format ) ) {
			$format = 'g:i a';
		}
			
		foreach ( range( $lower, $upper, $step ) as $increment ) {
			$increment = gmdate( 'H:i', $increment );
			
			list( $hour, $minutes ) = explode( ':', $increment );
			
			$date = new DateTime( $hour . ':' . $minutes );
			
			$times[(string) $increment] = $date->format( $format );
		}
		return $times;
	}

	/* Quinbi */
	function shortName($data) {
		$data = explode( ' ', $data );
		return $data[0];
	}

	function shortdate($data) {
		//turns data that comes dd/mm/yyyy	 to dd/mm/yy
		$year = substr($data, -2);
		$rest =	substr($data, 0, 6);
		$data =	$rest . $year;
		return $data;	
	}

	function shortyear($data) {
		//turns data that comes dd/mm/yyyy	 to dd/mm/yy
		//$data = substr($data, -2);
		$data =	substr($data, -2);
		//$data =	$rest . $year;
		return $data;		
	}

	function makeTitle($data = "") {
		$data = escape_value($data);
		if ($data == "") {
			$conector = "";
		} else {
			$conector = " | ";
		}
		$data = SITE_NAME.$conector.$data;
		return $data;
	}

	

?>
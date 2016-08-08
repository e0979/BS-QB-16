<?php

class HomeModel extends Model {	
		
		public function __construct() {
			
			parent::__construct();
		}
	
		
		public function listNotificaciones($user) {
			
			$user = escape_value($user);		
			return DB::query("SELECT * FROM ". DB_PREFIX ."notifications where rif=%s and checked=0 ORDER BY created ASC", $user);	
			
	    }
	}
?>
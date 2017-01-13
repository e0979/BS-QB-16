<?php

	class EntidadesController extends Controller {
		
		public function __construct() {
			
			parent::__construct();
			Auth::handleLogin();	
		
		}

	}

?>
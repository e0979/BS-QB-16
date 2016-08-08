<?php
	
	
	class errorController extends Controller{
		
		public function index(){
			
			echo "error INDEx";	
		
		}

	
		public function error($message = 'No information about the error'){

			echo '<pre>'.print_r($message,1).'</pre>';	

		}

	}

?>
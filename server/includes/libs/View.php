<?php

class View {

    function __construct() {
        //echo 'this is the view';
    }

    public function render($name, $chunk = false) //$noInclude = false)
    {
		if ($chunk !== false) {
			$extra = '?go=' . $chunk;			
		} else {
			$extra = '';
		}
				
        require 'app/views/' . $name . '.php' . $extra;    
    }
	
	public function buildpage($content = 'index'){
		
		$this->render('default/head');			
		$this->render('default/header');
		
		$this->render($content);
		
		$this->render('default/footer');
	
	}
	
	
	public function buildAdminPage($adminarea = 'settings', $content = 'index'){
		
		switch ($adminarea) {
			
			/*case 'miweb':
				
				$head 	= 'miweb/default/head';
				$nav 	= 'miweb/default/nav';
				$footer = 'miweb/default/footer';
				break;*/
			
			case 'settings':
				
				$head 	= "settings/default/head";
				$nav 	= "settings/default/nav";
				$footer = "default/footer";
				break;			
				
				
		}
		
		$this->render($head);			
		$this->render($nav);		
		$this->render($content);		
		$this->render($footer);
	
	}
	
	//Redirects from all Controllers to Settings Controller
	public function settings ($method = 'index', $param1 ='', $param2 ='',$param3 ='') { //Added 27-10-13
		
		$out = '';
		
		if ($param1 !== '') {
				$method .= '/'.$param1;
				$out 	.= '../';
			}
			if ($param2 !== '') {
				$method .=  '/'.$param2;
				$out 	.= '../';
			}
			if ($param3 !== '') {
				$method .= '/'.$param3;
				$out 	.= '../';
			}			
			
			header('location:../../'.$out.'settings/'.$method);
	}

}
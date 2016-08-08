<?php
	
	error_reporting(E_ALL);
	
	require_once ('includes/config/config.php');
	
	
	function __autoload($class) {
			
		require ( LIBS . $class. '.php');
		
		//echo "<i> Loaded: " . $class . ' Class</i></br>';
		//Todo: Verificar si el file existe y lanzar error si llama a una clase que no existe
	}
	require ( LIBS . 'functions.php');
	require ( LANG . DEFAULT_LANGUAGE .'.php');
	
	$app = new Bootstrap();
	
	$app->init();	
	
?>
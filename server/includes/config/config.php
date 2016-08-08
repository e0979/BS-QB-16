<?php

	//Paths Variables
	$modo = 'server'; //$_GET['modo']; //local or server

	if ($modo === 'local') {		
		define ('URL', "http://localhost/niuQuinbi/"); 
		define ( 'DB_SERVER', 'localhost');
		define ( 'DB_HOST', 'localhost');
		define ( 'DB_ENCODE', 'UTF8');
		define ( 'USER_IP', '190.142.16.246');
		define ( 'JQUERY_LINK', URL .'public/js/jquery.min.js');
		define ('SESSION_LIMIT', '+180 minutes');
		
		
	} else {
		define ('URL', "http://quinbi.besign.com.ve/");
		define ( 'DB_SERVER', 'internal-db.s23550.gridserver.com');
		define ( 'DB_HOST', 'internal-db.s23550.gridserver.com');
		define ( 'DB_ENCODE', 'UTF8'); 
		define ( 'USER_IP', '');
		define ( 'JQUERY_LINK', '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js');
		define ('SESSION_LIMIT', '30000');
	}
	
	//Current Language
	define ('DEFAULT_LANGUAGE', 'es_ES');
	
	date_default_timezone_set('America/Caracas');	
	define ('SITE_PATH', dirname(dirname(realpath(__FILE__))).'/'); 
	define('SITE_NAME', "QUINBI");
	define ('PUBLIC_PATH', URL . 'public/');
	define ('CSS', URL . 'public/css/'); 
	define ('IMG', URL . 'public/img/'); 
	define ('ICONS', URL . 'public/img/icons/'); 
	define ('IMAGES', URL . 'public/images/'); 
	define ('JS', URL . 'public/js/'); 
	define ('LIBS', SITE_PATH . 'libs/');
	define ('LANG', SITE_PATH . 'lang/');  
	define ('SIDEBARS', SITE_PATH . '/app/views/sidebars/'); 
	
	define('SEPARADOR', '*');
	define('SYSTEM_EMAIL', 'quinbi@besign.com.ve');
	define('SYSTEM_FOOTER', 'footer-');
	define ( 'MAIL_SERVER', 'smtp.gmail.com');
	define ( 'MAIL_HOST', 'mail.besign.com.ve');
	define ( 'MAIL_PORT', 587);
	
	define ( 'MAIL_PASSWORD', '$20BeE13$');
	define ('MAIL_SECURE','tls'); //antes ssl	
	
	//Hash definitions
	define("PBKDF2_HASH_ALGORITHM", "sha256");
	define("PBKDF2_ITERATIONS", 1000);
	define("PBKDF2_SALT_BYTE_SIZE", 24);
	define("PBKDF2_HASH_BYTE_SIZE", 24);
	
	define("HASH_SECTIONS", 4);
	define("HASH_ALGORITHM_INDEX", 0);
	define("HASH_ITERATION_INDEX", 1);
	define("HASH_SALT_INDEX", 2);
	define("HASH_PBKDF2_INDEX", 3);
	//Hash definitions
	
	
	//Database Connection
	define ( 'DB_TYPE', 'mysql');
	
	define ( 'DB_USER', 'db23550_besign');
	define ( 'DB_PASSWORD', 'SbejaA1220#');
	define ( 'DB_PASS', 'SbejaA1220#');
	define ( 'DB_NAME', 'db23550_queenbee'); 
	define ( 'DB_PREFIX', ''); //edilweb_
	
	
	
	
	
	
	
	/* Meekro Config  meekrodb.2.1.class */
	DB::$user = DB_USER;
	DB::$password = DB_PASSWORD;
	DB::$dbName = DB_NAME;
	DB::$host = DB_HOST;
	DB::$encoding = 'UTF8';	
	
	
	//Define new error_handler/success functions for MeekroDB
	
	DB::$error_handler = 'my_error_handler'; 
	function my_error_handler($params) {
	   echo "Error: " . $params['error'] . "Query: " . $params['query'] . "<br>\n";
	 die; 
	//  echo "false";
	}	 
	DB::$success_handler = 'my_success_handler'; // If Success
	function my_success_handler($params) {
	  return true;
	}
	

	//String mix for password hash
	
	
?>
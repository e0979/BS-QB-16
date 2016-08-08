<?php 

	//Current Language
	define ('DEFAULT_LANGUAGE', 'es_ES');
	
	date_default_timezone_set('America/Caracas');	
	//Path info
	define ('SITE_PATH', dirname(dirname(realpath(__FILE__))).'/'); 
	define ('SITE_NAME', "OKIDOC");
	define ('PUBLIC_PATH', URL . 'public/');
	define ('CSS', URL . 'public/css/'); 
	define ('IMG', URL . 'public/img/'); 
	define ('ICONS', URL . 'public/img/icons/'); 
	define ('IMAGES', URL . 'public/images/'); 
	define ('JS', URL . 'public/js/'); 
	define ('LIBS', SITE_PATH . 'libs/');
	define ('LANG', SITE_PATH . 'lang/'); 
	define ('SIDEBARS', SITE_PATH . '/app/views/sidebars/'); 
	define ('DATA', SITE_PATH . '../html/public/data/'); 
	
	//Email Configuration
	define ('SYSTEM_EMAIL', 'hello@okidoctor.com');
	define ('MAIL_SERVER', 'smtp.zoho.com');
	define ('MAIL_HOST', 'smtp.zoho.com');
	define ('MAIL_PORT', 465);	
	define ( 'MAIL_PASSWORD', 'Ker$wr543');
	define ('MAIL_SECURE','ssl');
	
	define('GOOGLE_APIKEY', 'AIzaSyCZrOa5K7mow_tX5KP253wPifIs7qQ4y3k');
	
	define('FACEBOOK_APP_ID','1545942492291033'); //App ID
	define('FACEBOOK_APP_SECRET','8ddb38447c288996c5efe5e03c6dbcfa');
	
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
	
	define("COUNTRY","ve");
	
	
	//TODO	//String mix for password hash
	
	//Database Meekro Class Config
	DB::$user = DB_USER;
	DB::$password = DB_PASSWORD;
	DB::$dbName = DB_NAME;
	DB::$host = DB_HOST;
	DB::$encoding = 'UTF8';	
	
	DB::$error_handler = 'my_error_handler'; 
	
	function my_error_handler($params) {
	   echo "Error: " . $params['error'] . "Query: " . $params['query'] . "<br>\n";
	   die; 
	}	 
	DB::$success_handler = 'my_success_handler'; // If Success
	function my_success_handler($params) {
	  return true;
	}
	
?>
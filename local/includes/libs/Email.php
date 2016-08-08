<?php
require_once ( LIBS . 'PHPMailer/class.phpmailer.php');
require_once ( LIBS . 'PHPMailer/class.smtp.php');

class Email extends PHPMailer{
	
    function __construct() {	
		
		$this->IsSMTP(); 
		$this->Host       = MAIL_HOST; 
		$this->SMTPDebug  = 0;         
		$this->SMTPAuth   = true;      
		$this->SMTPSecure = MAIL_SECURE;     
		$this->Host       = MAIL_SERVER; 
		$this->Port       = MAIL_PORT;
		$this->IsHTML(true);		
		$this->Password   = MAIL_PASSWORD;   
		$this->CharSet	  = EMAIL_ENCODE;
		
		 
    }
	
	public function sendMail($to, $from = SYSTEM_EMAIL, $subject = '', $body = '') {
			  
			  $this->Username  = $from;
			  $this->AddReplyTo($from); //('dlarez@besign.com.ve', 'First Last');
			  $this->AddAddress($to);
			  $this->SetFrom($from);
			  $this->Subject = $subject;
			  //$this->AltBody =  strip_tags($contenido); //Contenido para servidores que no aceptan HTML
			  $this->MsgHTML($body);
			 // $this->MsgHTML(file_get_contents('http://quinbi.besign.com.ve/test.html'));
			  //$mail->AddAttachment('http://quinbi.besign.com.ve/public/img/phpmailer.png');      // attachment
			  $this->Send();
			  /*if($this->Send()) {
				  echo "true";
			  } else {
				  echo "false" . $this->ErrorInfo;
			  }*/
		
   	}
	
	public function sendMailwithCC ($to, $from = SYSTEM_EMAIL, $subject = '', $body = '', $toCC1 ='', $toCC2 ='',$toCC3 ='' ) {
		
			  $this->Username  = $from;
			  $this->AddReplyTo($from);
			  $this->AddAddress($to);
			  if ($toCC1 !== '') {
			  	$this->AddCC($toCC1);
			  }
			  if ($toCC2 !== '') {
			  	$this->AddCC($toCC2);
			  }
			  if ($toCC3 !== '') {
			  	$this->AddCC($toCC3);
			  }
			  $this->SetFrom($from);
			  $this->Subject = $subject;
			  $this->MsgHTML($body);
			  $this->Send();
			 
		
	}
	
	public function buildNiceEmail ($format, $title, $message) {
		
		switch ($format) {
			case 'settings':
				
				$head 	= SETTINGS_EMAIL_HEAD;
				$footer	= SETTINGS_EMAIL_FOOTER;
				
				break;
			
			case 'registration':
				
				$head 	= REGISTRATION_EMAIL_HEAD;
				$footer	= REGISTRATION_EMAIL_FOOTER;
				
				break;
				
			case 'newsletter':
				
				$head 	= NEWSLETTER_EMAIL_HEAD;
				$footer	= NEWSLETTER_EMAIL_FOOTER;
				
				break;
			
			default:
				
				$head 	= SYSTEM_EMAIL_HEAD;				
				$footer	= SYSTEM_EMAIL_FOOTER;
				
				break;
		}
		
		
		//Email Formated 			
		$body  = $head;		
		$body .= "<h2>". escape_value($title)."</h2><br>";
		$body .= $message;			
		$body .= $footer;			
		
		return $body;
		
	}
}
?>

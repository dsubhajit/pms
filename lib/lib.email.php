<?php
$current_file_path= dirname(__FILE__);

class send_mail {
	protected $user_id;
	protected $pass;
	protected $from;
	protected $smtp_Server;
	protected $smtp_port;
	
	protected $to;
	protected $body;
	protected $subject;
	
	function __construct() {
		$this->init_vars();
	}
	
	function setTo($recipent) {
		$this->to = $recipent;
	}
	
	function setBody($body){			
		$this->body = $body;
	}
	
	function setSubject($subject) {
		$this->subject = $subject;
	}
	
	function init_vars(){
		require_once dirname(__FILE__).'/../config.php';
		
		$this->user_id = EMAIL_USER_ID; 
		$this->pass = EMAIL_PASSWORD;
		$this->from =  EMAIL_FROM;
		$this->smtp_port = EMAIL_SMTP_PORT;
		$this->smtp_Server = EMAIL_SMTP_SERVER;
	}
	
	function send() {
		require_once(dirname(__FILE__).'/../class/class.phpmailer.php');
		
		$mail = new PHPMailer();
		
		$mail->IsSMTP(); 
		$mail->Host = $this->smtp_Server;
		$mail->SMTPDebug  = 2;                     	// enables SMTP debug information (for testing)
													// 1 = errors and messages
													// 2 = messages only
		$mail->SMTPAuth   = true;                 	// enable SMTP authentication
		$mail->Username   = $this->user_id; 		// SMTP account username
		$mail->Password   = $this->pass;  		    // SMTP account password
		
		$mail->SetFrom($this->user_id,$this->from);
		$mail->Port = $this->smtp_port;
		$address = $this->to;
		$mail->AddAddress($address, $this->from);
		
		$mail->Subject    = $this->subject;
		
		$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		
		$mail->MsgHTML($this->body);
		
		if(!$mail->Send()) {
			return false;
		}
		else {
			return true;
		}
	}
		
}

?>
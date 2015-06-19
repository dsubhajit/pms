<?php
require_once(dirname(__FILE__).'/../config.php');
require(dirname(__FILE__).'/../vendor/autoload.php');
use Mailgun\Mailgun;

class mailgun_mail {    
    protected $from;
    protected $from_name;
    protected $to;
    protected $subject;
    protected $body;


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
            $this->from = MAIL_GUN_EMAIL_FROM;
            $this->from_name = MAIL_GUN_EMAIL_FROM_NAME;
    }

    function send_mail() {
        $mgClient = new Mailgun(MAIL_GUN_API_KEY);
        $domain = MAIL_GUN_DOMAIN;
        $result = $mgClient->sendMessage("".MAIL_GUN_DOMAIN."",
                  array('from'    => $this->from_name.'<'.$this->from.'>',
                        'to'      => $this->to,
                        'subject' => $this->subject,
                        'text'    => $this->body));
        return $result;
    }
    
}

?>

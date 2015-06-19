<?php
$current_file_path = dirname(__FILE__);
include($current_file_path.'/../lib/log4php/Logger.php');
Logger::configure($current_file_path.'/../lib/log4php/config.xml');

class mylog
{
   
    private $log;
 
   
    public function __construct(){       
        $this->log = Logger::getLogger(__CLASS__);
    }
 
    
    public function error($str){
        $this->log->error($str);
    }
    
    public function debug($str){
        $this->log->debug($str);
    }
    
    public function info($str){
        $this->log->info($str);
    }
}
?>
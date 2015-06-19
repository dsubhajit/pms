<?php 
$current_file_path = dirname(__FILE__);
require_once $current_file_path.'/../lib/lib.dbmanager.php';
require_once $current_file_path.'/../lib/lib.logger.php';
require_once $current_file_path.'/../config.php';

class DB {
    private $db_conn;
    private $log;
    function __construct(){
        $db_credential = array();
        $db_credential['username'] = APP_DB_USERNAME;
        $db_credential['password'] = APP_DB_PASSWORD;
        $db_credential['hostname'] = APP_DB_HOST;
        $db_credential['database'] = APP_DB_NAME;
        $this->log = new mylog();
        $this->db_conn = new DB_Manager($db_credential);
        if(!$this->db_conn->is_active()){
            exit("failed to connect db.");	
        }
    }

    public function get_connection() {
        return $this->db_conn->conn_id;
    }	

    public function execute_query($query){
        //$this->log->debug($query);
        $result =  mysql_query($query,$this->get_connection());
        if(!$result){
            $this->log->error(mysql_error());
        }
        return $result;
    }

    public function close_connection(){
        if($this->db_conn->is_active()){
                $this->db_conn->close_db();
        }
    }
}
?>
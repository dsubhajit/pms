<?php 
class DB_Manager {
	var $username;
	var $password;
	var $database;
	var $hostname;
	var $conn_id = FALSE;
	
	function __construct($params){
            if(is_array($params)){
                foreach($params as $key => $val){
                    $this->$key = $val;				
                }
            }
            $this->conn_id = $this->connect_db();
            if(!$this->is_active()){
                    die("Failed to Connect DB.");
            }
            if($this->select_db()===FALSE){
                    die("Failed to Select DB.");
            }
	}
	
	function connect_db(){
		$conn_id = mysql_connect($this->hostname, $this->username, $this->password, TRUE);
		//echo ($conn_id === TRUE)?"true bothe":"pond mara";
		return $conn_id;
	}
	
	function close_db(){
		mysql_close($this->conn_id);
	}
	
	function select_db(){
		return mysql_select_db($this->database, $this->conn_id);
	}
	
	function is_active(){
		if( !is_resource($this->conn_id) ) return FALSE;
		if (mysql_ping($this->conn_id) === FALSE){
			$this->conn_id = FALSE;	
			return FALSE;
		}
		else return TRUE;
	}
}
?>
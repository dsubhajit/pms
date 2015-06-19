<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-04-30 06:59:47  
*/

class user_type{
	protected $type_id;
	protected $type_name;


	function __construct($type_id_arg=null,$type_name_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->type_id=$type_id_arg;
			$this->type_name=$type_name_arg;
		}
	}


	public function getType_id(){
		return $this->type_id;
	}

	public function getType_name(){
		return $this->type_name;
	}

	public function setType_id($type_id){
		$this->type_id=$type_id;
	}

	public function setType_name($type_name){
		$this->type_name=$type_name;
	}

	public function gentype_id(){
		
		$db = new DB();
		$sql="select max(type_id) from user_type";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$type_id1=$this->getType_id();
		$type_name1=$this->getType_name();
		$sql="insert into `user_type` (`type_id`,`type_name`) values('$type_id1','$type_name1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->settype_id($type_id1);
			return true;
		}
		else return false;
	}
	public function findOnType_id($type_id){
		
		$db = new DB();
		$sql="select * from user_type where type_id='$type_id'";
		$result=$db->execute_query($sql);
		list($this->type_id,$this->type_name)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateType_name($type_name1,$type_id1){
		
		$db = new DB();
		$sql="update user_type set type_name='$type_name1' where type_id='$type_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllUser_type($type_id1){
		
		$db = new DB();
		$type_name1=$this->gettype_name();
		$sql="update `user_type` set `type_name`='$type_name1' where type_id='$type_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($type_id1){
		
		$db = new DB();
		$sql="delete from user_type where type_id='$type_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnUser_type($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from user_type where $str2";
		$result=$db->execute_query($sql);
		$res=Array();
		if($result){
			$i=0;
			while($row = mysql_fetch_array($result, MYSQL_NUM)){
				$res[$i++]=$row;
			}
		}
		$db->close_connection();
		return $res;
	}

	public static function getAllUser_type($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from user_type';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new user_type();
			list($tmp[$i]->type_id,$tmp[$i]->type_name)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

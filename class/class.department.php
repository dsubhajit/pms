<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-21 07:06:20  
*/

class department{
	protected $dep_id;
	protected $dep_name;


	function __construct($dep_id_arg=null,$dep_name_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->dep_id=$dep_id_arg;
			$this->dep_name=$dep_name_arg;
		}
	}


	public function getDep_id(){
		return $this->dep_id;
	}

	public function getDep_name(){
		return $this->dep_name;
	}

	public function setDep_id($dep_id){
		$this->dep_id=$dep_id;
	}

	public function setDep_name($dep_name){
		$this->dep_name=$dep_name;
	}

	public function genDep_id(){
		
		$db = new DB();
		$sql="select max(dep_id) from department";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$dep_id1=$this->genDep_id();
		$dep_name1=$this->getDep_name();
		$sql="insert into `department` (`dep_id`,`dep_name`) values('$dep_id1','$dep_name1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setdep_id($dep_id1);
			return true;
		}
		else return false;
	}
	public function findOnDep_id($dep_id){
		
		$db = new DB();
		$sql="select * from department where dep_id='$dep_id'";
		$result=$db->execute_query($sql);
		list($this->dep_id,$this->dep_name)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateDep_name($dep_name1,$dep_id1){
		
		$db = new DB();
		$sql="update department set dep_name='$dep_name1' where dep_id='$dep_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllDepartment($dep_id1){
		
		$db = new DB();
		$dep_name1=$this->getdep_name();
		$sql="update `department` set `dep_name`='$dep_name1' where dep_id='$dep_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($dep_id1){
		
		$db = new DB();
		$sql="delete from department where dep_id='$dep_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnDepartment($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from department where $str2";
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

	public static function getAllDepartment($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from department';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new department();
			list($tmp[$i]->dep_id,$tmp[$i]->dep_name)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
        
        public static function getDepIdFromName($dep_name){
		
		$db = new DB();
		$sql="select * from department where LOWER(dep_name)='$dep_name'";
                //echo $sql;
		$result=$db->execute_query($sql);
                $tmp =new department();
		list($tmp->dep_id,$tmp->dep_name)=mysql_fetch_array($result);
		$db->close_connection();
                return $tmp;
	}
}
?>

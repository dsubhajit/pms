<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-21 07:17:21  
*/

class branch{
	protected $branch_id;
	protected $branch_name;
	protected $dep_id;


	function __construct($branch_id_arg=null,$branch_name_arg=null,$dep_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->branch_id=$branch_id_arg;
			$this->branch_name=$branch_name_arg;
			$this->dep_id=$dep_id_arg;
		}
	}


	public function getBranch_id(){
		return $this->branch_id;
	}

	public function getBranch_name(){
		return $this->branch_name;
	}

	public function getDep_id(){
		return $this->dep_id;
	}

	public function setBranch_id($branch_id){
		$this->branch_id=$branch_id;
	}

	public function setBranch_name($branch_name){
		$this->branch_name=$branch_name;
	}

	public function setDep_id($dep_id){
		$this->dep_id=$dep_id;
	}

	public function genBranch_id(){
		
		$db = new DB();
		$sql="select max(branch_id) from branch";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$branch_id1=$this->genBranch_id();
		$branch_name1=$this->getBranch_name();
		$dep_id1=$this->getDep_id();
		$sql="insert into `branch` (`branch_id`,`branch_name`,`dep_id`) values('$branch_id1','$branch_name1','$dep_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setbranch_id($branch_id1);
			return true;
		}
		else return false;
	}
	public function findOnBranch_id($branch_id){
		
		$db = new DB();
		$sql="select * from branch where branch_id='$branch_id'";
		$result=$db->execute_query($sql);
		list($this->branch_id,$this->branch_name,$this->dep_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateBranch_name($branch_name1,$branch_id1){
		
		$db = new DB();
		$sql="update branch set branch_name='$branch_name1' where branch_id='$branch_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDep_id($dep_id1,$branch_id1){
		
		$db = new DB();
		$sql="update branch set dep_id='$dep_id1' where branch_id='$branch_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllBranch($branch_id1){
		
		$db = new DB();
		$branch_name1=$this->getbranch_name();
		$dep_id1=$this->getdep_id();
		$sql="update `branch` set `branch_name`='$branch_name1',`dep_id`='$dep_id1' where branch_id='$branch_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($branch_id1){
		
		$db = new DB();
		$sql="delete from branch where branch_id='$branch_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnBranch($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from branch where $str2";
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

	public static function getAllBranch($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from branch';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new branch();
			list($tmp[$i]->branch_id,$tmp[$i]->branch_name,$tmp[$i]->dep_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
        
        public static function getBranchIdFromName($branch_name){
		
		$db = new DB();
		$sql="select * from branch where LOWER(branch_id)='".strtolower($branch_name)."'";
		$result=$db->execute_query($sql);
                $tmp = new branch();
		list($tmp->branch_id,$tmp->branch_name,$tmp->dep_id)=mysql_fetch_array($result);
		$db->close_connection();
                return $tmp;
	}
}
?>

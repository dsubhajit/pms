<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-04-30 06:59:44  
*/

class students_tech{
	protected $tech_id;
	protected $tech_langs;
	protected $tech_tools;
	protected $tech_frameworks;


	function __construct($tech_id_arg=null,$tech_langs_arg=null,$tech_tools_arg=null,$tech_frameworks_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->tech_id=$tech_id_arg;
			$this->tech_langs=$tech_langs_arg;
			$this->tech_tools=$tech_tools_arg;
			$this->tech_frameworks=$tech_frameworks_arg;
		}
	}


	public function getTech_id(){
		return $this->tech_id;
	}

	public function getTech_langs(){
		return $this->tech_langs;
	}

	public function getTech_tools(){
		return $this->tech_tools;
	}

	public function getTech_frameworks(){
		return $this->tech_frameworks;
	}

	public function setTech_id($tech_id){
		$this->tech_id=$tech_id;
	}

	public function setTech_langs($tech_langs){
		$this->tech_langs=$tech_langs;
	}

	public function setTech_tools($tech_tools){
		$this->tech_tools=$tech_tools;
	}

	public function setTech_frameworks($tech_frameworks){
		$this->tech_frameworks=$tech_frameworks;
	}

	public function genTech_id(){
		
		$db = new DB();
		$sql="select max(tech_id) from students_tech";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$tech_id1=$this->genTech_id();
		$tech_langs1=$this->getTech_langs();
		$tech_tools1=$this->getTech_tools();
		$tech_frameworks1=$this->getTech_frameworks();
		$sql="insert into `students_tech` (`tech_id`,`tech_langs`,`tech_tools`,`tech_frameworks`) values('$tech_id1','$tech_langs1','$tech_tools1','$tech_frameworks1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->settech_id($tech_id1);
			return true;
		}
		else return false;
	}
	public function findOnTech_id($tech_id){
		
		$db = new DB();
		$sql="select * from students_tech where tech_id='$tech_id'";
		$result=$db->execute_query($sql);
		list($this->tech_id,$this->tech_langs,$this->tech_tools,$this->tech_frameworks)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateTech_langs($tech_langs1,$tech_id1){
		
		$db = new DB();
		$sql="update students_tech set tech_langs='$tech_langs1' where tech_id='$tech_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateTech_tools($tech_tools1,$tech_id1){
		
		$db = new DB();
		$sql="update students_tech set tech_tools='$tech_tools1' where tech_id='$tech_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateTech_frameworks($tech_frameworks1,$tech_id1){
		
		$db = new DB();
		$sql="update students_tech set tech_frameworks='$tech_frameworks1' where tech_id='$tech_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_tech($tech_id1){
		
		$db = new DB();
		$tech_langs1=$this->gettech_langs();
		$tech_tools1=$this->gettech_tools();
		$tech_frameworks1=$this->gettech_frameworks();
		$sql="update `students_tech` set `tech_langs`='$tech_langs1',`tech_tools`='$tech_tools1',`tech_frameworks`='$tech_frameworks1' where tech_id='$tech_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($tech_id1){
		
		$db = new DB();
		$sql="delete from students_tech where tech_id='$tech_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_tech($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_tech where $str2";
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

	public static function getAllStudents_tech($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_tech';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_tech();
			list($tmp[$i]->tech_id,$tmp[$i]->tech_langs,$tmp[$i]->tech_tools,$tmp[$i]->tech_frameworks)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

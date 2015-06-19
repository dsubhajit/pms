<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-01 20:01:32  
*/

class students_projects{
	protected $pj_id;
	protected $pj_name;
	protected $pj_from;
	protected $pj_to;
	protected $pj_working;
	protected $pj_desc;
	protected $pj_skills;
	protected $profile_id;


	function __construct($pj_id_arg=null,$pj_name_arg=null,$pj_from_arg=null,$pj_to_arg=null,$pj_working_arg=null,$pj_desc_arg=null,$pj_skills_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->pj_id=$pj_id_arg;
			$this->pj_name=$pj_name_arg;
			$this->pj_from=$pj_from_arg;
			$this->pj_to=$pj_to_arg;
			$this->pj_working=$pj_working_arg;
			$this->pj_desc=$pj_desc_arg;
			$this->pj_skills=$pj_skills_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getPj_id(){
		return $this->pj_id;
	}

	public function getPj_name(){
		return $this->pj_name;
	}

	public function getPj_from(){
		return $this->pj_from;
	}

	public function getPj_to(){
		return $this->pj_to;
	}

	public function getPj_working(){
		return $this->pj_working;
	}

	public function getPj_desc(){
		return $this->pj_desc;
	}

	public function getPj_skills(){
		return $this->pj_skills;
	}

	public function getProfile_id(){
		return $this->profile_id;
	}

	public function setPj_id($pj_id){
		$this->pj_id=$pj_id;
	}

	public function setPj_name($pj_name){
		$this->pj_name=$pj_name;
	}

	public function setPj_from($pj_from){
		$this->pj_from=$pj_from;
	}

	public function setPj_to($pj_to){
		$this->pj_to=$pj_to;
	}

	public function setPj_working($pj_working){
		$this->pj_working=$pj_working;
	}

	public function setPj_desc($pj_desc){
		$this->pj_desc=$pj_desc;
	}

	public function setPj_skills($pj_skills){
		$this->pj_skills=$pj_skills;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function genPj_id(){
		
		$db = new DB();
		$sql="select max(pj_id) from students_projects";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$pj_id1=$this->genPj_id();
		$pj_name1=$this->getPj_name();
		$pj_from1=$this->getPj_from();
		$pj_to1=$this->getPj_to();
		$pj_working1=$this->getPj_working();
		$pj_desc1=$this->getPj_desc();
		$pj_skills1=$this->getPj_skills();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `students_projects` (`pj_id`,`pj_name`,`pj_from`,`pj_to`,`pj_working`,`pj_desc`,`pj_skills`,`profile_id`) values('$pj_id1','$pj_name1','$pj_from1','$pj_to1','$pj_working1','$pj_desc1','$pj_skills1','$profile_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setpj_id($pj_id1);
			return true;
		}
		else return false;
	}
	public function findOnPj_id($pj_id){
		
		$db = new DB();
		$sql="select * from students_projects where pj_id='$pj_id'";
		$result=$db->execute_query($sql);
		list($this->pj_id,$this->pj_name,$this->pj_from,$this->pj_to,$this->pj_working,$this->pj_desc,$this->pj_skills,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updatePj_name($pj_name1,$pj_id1){
		
		$db = new DB();
		$sql="update students_projects set pj_name='$pj_name1' where pj_id='$pj_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePj_from($pj_from1,$pj_id1){
		
		$db = new DB();
		$sql="update students_projects set pj_from='$pj_from1' where pj_id='$pj_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePj_to($pj_to1,$pj_id1){
		
		$db = new DB();
		$sql="update students_projects set pj_to='$pj_to1' where pj_id='$pj_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePj_working($pj_working1,$pj_id1){
		
		$db = new DB();
		$sql="update students_projects set pj_working='$pj_working1' where pj_id='$pj_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePj_desc($pj_desc1,$pj_id1){
		
		$db = new DB();
		$sql="update students_projects set pj_desc='$pj_desc1' where pj_id='$pj_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePj_skills($pj_skills1,$pj_id1){
		
		$db = new DB();
		$sql="update students_projects set pj_skills='$pj_skills1' where pj_id='$pj_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$pj_id1){
		
		$db = new DB();
		$sql="update students_projects set profile_id='$profile_id1' where pj_id='$pj_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_projects($pj_id1){
		
		$db = new DB();
		$pj_name1=$this->getpj_name();
		$pj_from1=$this->getpj_from();
		$pj_to1=$this->getpj_to();
		$pj_working1=$this->getpj_working();
		$pj_desc1=$this->getpj_desc();
		$pj_skills1=$this->getpj_skills();
		$profile_id1=$this->getprofile_id();
		$sql="update `students_projects` set `pj_name`='$pj_name1',`pj_from`='$pj_from1',`pj_to`='$pj_to1',`pj_working`='$pj_working1',`pj_desc`='$pj_desc1',`pj_skills`='$pj_skills1',`profile_id`='$profile_id1' where pj_id='$pj_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($pj_id1){
		
		$db = new DB();
		$sql="delete from students_projects where pj_id='$pj_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_projects($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_projects where $str2";
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

	public static function getAllStudents_projects($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_projects';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_projects();
			list($tmp[$i]->pj_id,$tmp[$i]->pj_name,$tmp[$i]->pj_from,$tmp[$i]->pj_to,$tmp[$i]->pj_working,$tmp[$i]->pj_desc,$tmp[$i]->pj_skills,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

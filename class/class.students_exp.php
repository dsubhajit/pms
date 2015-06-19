<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-23 11:20:46  
*/

class students_exp{
	protected $exp_id;
	protected $exp_type;
	protected $designation;
	protected $organization;
	protected $start_date;
	protected $end_date;
	protected $description;
	protected $profile_id;


	function __construct($exp_id_arg=null,$exp_type_arg=null,$designation_arg=null,$organization_arg=null,$start_date_arg=null,$end_date_arg=null,$description_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->exp_id=$exp_id_arg;
			$this->exp_type=$exp_type_arg;
			$this->designation=$designation_arg;
			$this->organization=$organization_arg;
			$this->start_date=$start_date_arg;
			$this->end_date=$end_date_arg;
			$this->description=$description_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getExp_id(){
		return $this->exp_id;
	}

	public function getExp_type(){
		return $this->exp_type;
	}

	public function getDesignation(){
		return $this->designation;
	}

	public function getOrganization(){
		return $this->organization;
	}

	public function getStart_date(){
		return $this->start_date;
	}

	public function getEnd_date(){
		return $this->end_date;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getProfile_id(){
		return $this->profile_id;
	}

	public function setExp_id($exp_id){
		$this->exp_id=$exp_id;
	}

	public function setExp_type($exp_type){
		$this->exp_type=$exp_type;
	}

	public function setDesignation($designation){
		$this->designation=$designation;
	}

	public function setOrganization($organization){
		$this->organization=$organization;
	}

	public function setStart_date($start_date){
		$this->start_date=$start_date;
	}

	public function setEnd_date($end_date){
		$this->end_date=$end_date;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function genExp_id(){
		
		$db = new DB();
		$sql="select max(exp_id) from students_exp";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$exp_id1=$this->genExp_id();
		$exp_type1=$this->getExp_type();
		$designation1=$this->getDesignation();
		$organization1=$this->getOrganization();
		$start_date1=$this->getStart_date();
		$end_date1=$this->getEnd_date();
		$description1=$this->getDescription();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `students_exp` (`exp_id`,`exp_type`,`designation`,`organization`,`start_date`,`end_date`,`description`,`profile_id`) values('$exp_id1','$exp_type1','$designation1','$organization1','$start_date1','$end_date1','$description1','$profile_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setexp_id($exp_id1);
			return true;
		}
		else return false;
	}
	public function findOnExp_id($exp_id){
		
		$db = new DB();
		$sql="select * from students_exp where exp_id='$exp_id'";
		$result=$db->execute_query($sql);
		list($this->exp_id,$this->exp_type,$this->designation,$this->organization,$this->start_date,$this->end_date,$this->description,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateExp_type($exp_type1,$exp_id1){
		
		$db = new DB();
		$sql="update students_exp set exp_type='$exp_type1' where exp_id='$exp_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDesignation($designation1,$exp_id1){
		
		$db = new DB();
		$sql="update students_exp set designation='$designation1' where exp_id='$exp_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateOrganization($organization1,$exp_id1){
		
		$db = new DB();
		$sql="update students_exp set organization='$organization1' where exp_id='$exp_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateStart_date($start_date1,$exp_id1){
		
		$db = new DB();
		$sql="update students_exp set start_date='$start_date1' where exp_id='$exp_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEnd_date($end_date1,$exp_id1){
		
		$db = new DB();
		$sql="update students_exp set end_date='$end_date1' where exp_id='$exp_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDescription($description1,$exp_id1){
		
		$db = new DB();
		$sql="update students_exp set description='$description1' where exp_id='$exp_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$exp_id1){
		
		$db = new DB();
		$sql="update students_exp set profile_id='$profile_id1' where exp_id='$exp_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_exp($exp_id1){
		
		$db = new DB();
		$exp_type1=$this->getexp_type();
		$designation1=$this->getdesignation();
		$organization1=$this->getorganization();
		$start_date1=$this->getstart_date();
		$end_date1=$this->getend_date();
		$description1=$this->getdescription();
		$profile_id1=$this->getprofile_id();
		$sql="update `students_exp` set `exp_type`='$exp_type1',`designation`='$designation1',`organization`='$organization1',`start_date`='$start_date1',`end_date`='$end_date1',`description`='$description1',`profile_id`='$profile_id1' where exp_id='$exp_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($exp_id1){
		
		$db = new DB();
		$sql="delete from students_exp where exp_id='$exp_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_exp($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_exp where $str2";
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

	public static function getAllStudents_exp($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_exp';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_exp();
			list($tmp[$i]->exp_id,$tmp[$i]->exp_type,$tmp[$i]->designation,$tmp[$i]->organization,$tmp[$i]->start_date,$tmp[$i]->end_date,$tmp[$i]->description,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

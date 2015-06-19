<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-04-30 06:59:16  
*/

class students_edu{
	protected $edu_id;
	protected $edu_inst_name;
	protected $edu_degree;
	protected $edu_major;
	protected $edu_date_form;
	protected $edu_date_to;
	protected $edu_percentage;
	protected $edu_cgpa;
	protected $edu_desc;
	protected $edu_skill;
	protected $edu_courses;
	protected $profile_id;


	function __construct($edu_id_arg=null,$edu_inst_name_arg=null,$edu_degree_arg=null,$edu_major_arg=null,$edu_date_form_arg=null,$edu_date_to_arg=null,$edu_percentage_arg=null,$edu_cgpa_arg=null,$edu_desc_arg=null,$edu_skill_arg=null,$edu_courses_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->edu_id=$edu_id_arg;
			$this->edu_inst_name=$edu_inst_name_arg;
			$this->edu_degree=$edu_degree_arg;
			$this->edu_major=$edu_major_arg;
			$this->edu_date_form=$edu_date_form_arg;
			$this->edu_date_to=$edu_date_to_arg;
			$this->edu_percentage=$edu_percentage_arg;
			$this->edu_cgpa=$edu_cgpa_arg;
			$this->edu_desc=$edu_desc_arg;
			$this->edu_skill=$edu_skill_arg;
			$this->edu_courses=$edu_courses_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getEdu_id(){
		return $this->edu_id;
	}

	public function getEdu_inst_name(){
		return $this->edu_inst_name;
	}

	public function getEdu_degree(){
		return $this->edu_degree;
	}

	public function getEdu_major(){
		return $this->edu_major;
	}

	public function getEdu_date_form(){
		return $this->edu_date_form;
	}

	public function getEdu_date_to(){
		return $this->edu_date_to;
	}

	public function getEdu_percentage(){
		return $this->edu_percentage;
	}

	public function getEdu_cgpa(){
		return $this->edu_cgpa;
	}

	public function getEdu_desc(){
		return $this->edu_desc;
	}

	public function getEdu_skill(){
		return $this->edu_skill;
	}

	public function getEdu_courses(){
		return $this->edu_courses;
	}

	public function getProfile_id(){
		return $this->profile_id;
	}

	public function setEdu_id($edu_id){
		$this->edu_id=$edu_id;
	}

	public function setEdu_inst_name($edu_inst_name){
		$this->edu_inst_name=$edu_inst_name;
	}

	public function setEdu_degree($edu_degree){
		$this->edu_degree=$edu_degree;
	}

	public function setEdu_major($edu_major){
		$this->edu_major=$edu_major;
	}

	public function setEdu_date_form($edu_date_form){
		$this->edu_date_form=$edu_date_form;
	}

	public function setEdu_date_to($edu_date_to){
		$this->edu_date_to=$edu_date_to;
	}

	public function setEdu_percentage($edu_percentage){
		$this->edu_percentage=$edu_percentage;
	}

	public function setEdu_cgpa($edu_cgpa){
		$this->edu_cgpa=$edu_cgpa;
	}

	public function setEdu_desc($edu_desc){
		$this->edu_desc=$edu_desc;
	}

	public function setEdu_skill($edu_skill){
		$this->edu_skill=$edu_skill;
	}

	public function setEdu_courses($edu_courses){
		$this->edu_courses=$edu_courses;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function genEdu_id(){
		
		$db = new DB();
		$sql="select max(edu_id) from students_edu";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$edu_id1=$this->genEdu_id();
		$edu_inst_name1=$this->getEdu_inst_name();
		$edu_degree1=$this->getEdu_degree();
		$edu_major1=$this->getEdu_major();
		$edu_date_form1=$this->getEdu_date_form();
		$edu_date_to1=$this->getEdu_date_to();
		$edu_percentage1=$this->getEdu_percentage();
		$edu_cgpa1=$this->getEdu_cgpa();
		$edu_desc1=$this->getEdu_desc();
		$edu_skill1=$this->getEdu_skill();
		$edu_courses1=$this->getEdu_courses();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `students_edu` (`edu_id`,`edu_inst_name`,`edu_degree`,`edu_major`,`edu_date_form`,`edu_date_to`,`edu_percentage`,`edu_cgpa`,`edu_desc`,`edu_skill`,`edu_courses`,`profile_id`) values('$edu_id1','$edu_inst_name1','$edu_degree1','$edu_major1','$edu_date_form1','$edu_date_to1','$edu_percentage1','$edu_cgpa1','$edu_desc1','$edu_skill1','$edu_courses1','$profile_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setedu_id($edu_id1);
			return true;
		}
		else return false;
	}
	public function findOnEdu_id($edu_id){
		
		$db = new DB();
		$sql="select * from students_edu where edu_id='$edu_id'";
		$result=$db->execute_query($sql);
		list($this->edu_id,$this->edu_inst_name,$this->edu_degree,$this->edu_major,$this->edu_date_form,$this->edu_date_to,$this->edu_percentage,$this->edu_cgpa,$this->edu_desc,$this->edu_skill,$this->edu_courses,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateEdu_inst_name($edu_inst_name1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_inst_name='$edu_inst_name1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_degree($edu_degree1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_degree='$edu_degree1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_major($edu_major1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_major='$edu_major1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_date_form($edu_date_form1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_date_form='$edu_date_form1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_date_to($edu_date_to1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_date_to='$edu_date_to1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_percentage($edu_percentage1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_percentage='$edu_percentage1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_cgpa($edu_cgpa1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_cgpa='$edu_cgpa1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_desc($edu_desc1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_desc='$edu_desc1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_skill($edu_skill1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_skill='$edu_skill1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEdu_courses($edu_courses1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set edu_courses='$edu_courses1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$edu_id1){
		
		$db = new DB();
		$sql="update students_edu set profile_id='$profile_id1' where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_edu($edu_id1){
		
		$db = new DB();
		$edu_inst_name1=$this->getedu_inst_name();
		$edu_degree1=$this->getedu_degree();
		$edu_major1=$this->getedu_major();
		$edu_date_form1=$this->getedu_date_form();
		$edu_date_to1=$this->getedu_date_to();
		$edu_percentage1=$this->getedu_percentage();
		$edu_cgpa1=$this->getedu_cgpa();
		$edu_desc1=$this->getedu_desc();
		$edu_skill1=$this->getedu_skill();
		$edu_courses1=$this->getedu_courses();
		$profile_id1=$this->getprofile_id();
		$sql="update `students_edu` set `edu_inst_name`='$edu_inst_name1',`edu_degree`='$edu_degree1',`edu_major`='$edu_major1',`edu_date_form`='$edu_date_form1',`edu_date_to`='$edu_date_to1',`edu_percentage`='$edu_percentage1',`edu_cgpa`='$edu_cgpa1',`edu_desc`='$edu_desc1',`edu_skill`='$edu_skill1',`edu_courses`='$edu_courses1',`profile_id`='$profile_id1' where edu_id='$edu_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($edu_id1){
		
		$db = new DB();
		$sql="delete from students_edu where edu_id='$edu_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_edu($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_edu where $str2";
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

	public static function getAllStudents_edu($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_edu';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_edu();
			list($tmp[$i]->edu_id,$tmp[$i]->edu_inst_name,$tmp[$i]->edu_degree,$tmp[$i]->edu_major,$tmp[$i]->edu_date_form,$tmp[$i]->edu_date_to,$tmp[$i]->edu_percentage,$tmp[$i]->edu_cgpa,$tmp[$i]->edu_desc,$tmp[$i]->edu_skill,$tmp[$i]->edu_courses,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

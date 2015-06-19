<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-23 11:20:51  
*/

class students_leadership{
	protected $id;
	protected $designation;
	protected $organization;
	protected $start_date;
	protected $end_date;
	protected $description;
	protected $profile_id;


	function __construct($id_arg=null,$designation_arg=null,$organization_arg=null,$start_date_arg=null,$end_date_arg=null,$description_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->id=$id_arg;
			$this->designation=$designation_arg;
			$this->organization=$organization_arg;
			$this->start_date=$start_date_arg;
			$this->end_date=$end_date_arg;
			$this->description=$description_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getId(){
		return $this->id;
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

	public function setId($id){
		$this->id=$id;
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

	public function genId(){
		
		$db = new DB();
		$sql="select max(id) from students_leadership";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$id1=$this->genId();
		$designation1=$this->getDesignation();
		$organization1=$this->getOrganization();
		$start_date1=$this->getStart_date();
		$end_date1=$this->getEnd_date();
		$description1=$this->getDescription();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `students_leadership` (`id`,`designation`,`organization`,`start_date`,`end_date`,`description`,`profile_id`) values('$id1','$designation1','$organization1','$start_date1','$end_date1','$description1','$profile_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setid($id1);
			return true;
		}
		else return false;
	}
	public function findOnId($id){
		
		$db = new DB();
		$sql="select * from students_leadership where id='$id'";
		$result=$db->execute_query($sql);
		list($this->id,$this->designation,$this->organization,$this->start_date,$this->end_date,$this->description,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateDesignation($designation1,$id1){
		
		$db = new DB();
		$sql="update students_leadership set designation='$designation1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateOrganization($organization1,$id1){
		
		$db = new DB();
		$sql="update students_leadership set organization='$organization1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateStart_date($start_date1,$id1){
		
		$db = new DB();
		$sql="update students_leadership set start_date='$start_date1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEnd_date($end_date1,$id1){
		
		$db = new DB();
		$sql="update students_leadership set end_date='$end_date1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDescription($description1,$id1){
		
		$db = new DB();
		$sql="update students_leadership set description='$description1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$id1){
		
		$db = new DB();
		$sql="update students_leadership set profile_id='$profile_id1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_leadership($id1){
		
		$db = new DB();
		$designation1=$this->getdesignation();
		$organization1=$this->getorganization();
		$start_date1=$this->getstart_date();
		$end_date1=$this->getend_date();
		$description1=$this->getdescription();
		$profile_id1=$this->getprofile_id();
		$sql="update `students_leadership` set `designation`='$designation1',`organization`='$organization1',`start_date`='$start_date1',`end_date`='$end_date1',`description`='$description1',`profile_id`='$profile_id1' where id='$id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($id1){
		
		$db = new DB();
		$sql="delete from students_leadership where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_leadership($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_leadership where $str2";
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

	public static function getAllStudents_leadership($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_leadership';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_leadership();
			list($tmp[$i]->id,$tmp[$i]->designation,$tmp[$i]->organization,$tmp[$i]->start_date,$tmp[$i]->end_date,$tmp[$i]->description,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

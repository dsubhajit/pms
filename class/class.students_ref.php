<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-24 03:30:24  
*/

class students_ref{
	protected $id;
	protected $ref_name;
	protected $designation;
	protected $organization;
	protected $email;
	protected $phone;
	protected $profile_id;


	function __construct($id_arg=null,$ref_name_arg=null,$designation_arg=null,$organization_arg=null,$email_arg=null,$phone_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->id=$id_arg;
			$this->ref_name=$ref_name_arg;
			$this->designation=$designation_arg;
			$this->organization=$organization_arg;
			$this->email=$email_arg;
			$this->phone=$phone_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getId(){
		return $this->id;
	}

	public function getRef_name(){
		return $this->ref_name;
	}

	public function getDesignation(){
		return $this->designation;
	}

	public function getOrganization(){
		return $this->organization;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function getProfile_id(){
		return $this->profile_id;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setRef_name($ref_name){
		$this->ref_name=$ref_name;
	}

	public function setDesignation($designation){
		$this->designation=$designation;
	}

	public function setOrganization($organization){
		$this->organization=$organization;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setPhone($phone){
		$this->phone=$phone;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function genId(){
		
		$db = new DB();
		$sql="select max(id) from students_ref";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$id1=$this->genId();
		$ref_name1=$this->getRef_name();
		$designation1=$this->getDesignation();
		$organization1=$this->getOrganization();
		$email1=$this->getEmail();
		$phone1=$this->getPhone();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `students_ref` (`id`,`ref_name`,`designation`,`organization`,`email`,`phone`,`profile_id`) values('$id1','$ref_name1','$designation1','$organization1','$email1','$phone1','$profile_id1')";
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
		$sql="select * from students_ref where id='$id'";
		$result=$db->execute_query($sql);
		list($this->id,$this->ref_name,$this->designation,$this->organization,$this->email,$this->phone,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateRef_name($ref_name1,$id1){
		
		$db = new DB();
		$sql="update students_ref set ref_name='$ref_name1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDesignation($designation1,$id1){
		
		$db = new DB();
		$sql="update students_ref set designation='$designation1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateOrganization($organization1,$id1){
		
		$db = new DB();
		$sql="update students_ref set organization='$organization1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEmail($email1,$id1){
		
		$db = new DB();
		$sql="update students_ref set email='$email1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePhone($phone1,$id1){
		
		$db = new DB();
		$sql="update students_ref set phone='$phone1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$id1){
		
		$db = new DB();
		$sql="update students_ref set profile_id='$profile_id1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_ref($id1){
		
		$db = new DB();
		$ref_name1=$this->getref_name();
		$designation1=$this->getdesignation();
		$organization1=$this->getorganization();
		$email1=$this->getemail();
		$phone1=$this->getphone();
		$profile_id1=$this->getprofile_id();
		$sql="update `students_ref` set `ref_name`='$ref_name1',`designation`='$designation1',`organization`='$organization1',`email`='$email1',`phone`='$phone1',`profile_id`='$profile_id1' where id='$id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($id1){
		
		$db = new DB();
		$sql="delete from students_ref where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_ref($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_ref where $str2";
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

	public static function getAllStudents_ref($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_ref';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_ref();
			list($tmp[$i]->id,$tmp[$i]->ref_name,$tmp[$i]->designation,$tmp[$i]->organization,$tmp[$i]->email,$tmp[$i]->phone,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

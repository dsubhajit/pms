<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-01 20:01:38  
*/

class students_pubs{
	protected $pub_id;
	protected $pub_title;
	protected $pub_date;
	protected $pub_name;
	protected $pub_desc;
	protected $pub_skills;
	protected $profile_id;


	function __construct($pub_id_arg=null,$pub_title_arg=null,$pub_date_arg=null,$pub_name_arg=null,$pub_desc_arg=null,$pub_skills_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->pub_id=$pub_id_arg;
			$this->pub_title=$pub_title_arg;
			$this->pub_date=$pub_date_arg;
			$this->pub_name=$pub_name_arg;
			$this->pub_desc=$pub_desc_arg;
			$this->pub_skills=$pub_skills_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getPub_id(){
		return $this->pub_id;
	}

	public function getPub_title(){
		return $this->pub_title;
	}

	public function getPub_date(){
		return $this->pub_date;
	}

	public function getPub_name(){
		return $this->pub_name;
	}

	public function getPub_desc(){
		return $this->pub_desc;
	}

	public function getPub_skills(){
		return $this->pub_skills;
	}

	public function getProfile_id(){
		return $this->profile_id;
	}

	public function setPub_id($pub_id){
		$this->pub_id=$pub_id;
	}

	public function setPub_title($pub_title){
		$this->pub_title=$pub_title;
	}

	public function setPub_date($pub_date){
		$this->pub_date=$pub_date;
	}

	public function setPub_name($pub_name){
		$this->pub_name=$pub_name;
	}

	public function setPub_desc($pub_desc){
		$this->pub_desc=$pub_desc;
	}

	public function setPub_skills($pub_skills){
		$this->pub_skills=$pub_skills;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function genPub_id(){
		
		$db = new DB();
		$sql="select max(pub_id) from students_pubs";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$pub_id1=$this->genPub_id();
		$pub_title1=$this->getPub_title();
		$pub_date1=$this->getPub_date();
		$pub_name1=$this->getPub_name();
		$pub_desc1=$this->getPub_desc();
		$pub_skills1=$this->getPub_skills();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `students_pubs` (`pub_id`,`pub_title`,`pub_date`,`pub_name`,`pub_desc`,`pub_skills`,`profile_id`) values('$pub_id1','$pub_title1','$pub_date1','$pub_name1','$pub_desc1','$pub_skills1','$profile_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setpub_id($pub_id1);
			return true;
		}
		else return false;
	}
	public function findOnPub_id($pub_id){
		
		$db = new DB();
		$sql="select * from students_pubs where pub_id='$pub_id'";
		$result=$db->execute_query($sql);
		list($this->pub_id,$this->pub_title,$this->pub_date,$this->pub_name,$this->pub_desc,$this->pub_skills,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updatePub_title($pub_title1,$pub_id1){
		
		$db = new DB();
		$sql="update students_pubs set pub_title='$pub_title1' where pub_id='$pub_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePub_date($pub_date1,$pub_id1){
		
		$db = new DB();
		$sql="update students_pubs set pub_date='$pub_date1' where pub_id='$pub_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePub_name($pub_name1,$pub_id1){
		
		$db = new DB();
		$sql="update students_pubs set pub_name='$pub_name1' where pub_id='$pub_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePub_desc($pub_desc1,$pub_id1){
		
		$db = new DB();
		$sql="update students_pubs set pub_desc='$pub_desc1' where pub_id='$pub_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePub_skills($pub_skills1,$pub_id1){
		
		$db = new DB();
		$sql="update students_pubs set pub_skills='$pub_skills1' where pub_id='$pub_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$pub_id1){
		
		$db = new DB();
		$sql="update students_pubs set profile_id='$profile_id1' where pub_id='$pub_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_pubs($pub_id1){
		
		$db = new DB();
		$pub_title1=$this->getpub_title();
		$pub_date1=$this->getpub_date();
		$pub_name1=$this->getpub_name();
		$pub_desc1=$this->getpub_desc();
		$pub_skills1=$this->getpub_skills();
		$profile_id1=$this->getprofile_id();
		$sql="update `students_pubs` set `pub_title`='$pub_title1',`pub_date`='$pub_date1',`pub_name`='$pub_name1',`pub_desc`='$pub_desc1',`pub_skills`='$pub_skills1',`profile_id`='$profile_id1' where pub_id='$pub_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($pub_id1){
		
		$db = new DB();
		$sql="delete from students_pubs where pub_id='$pub_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_pubs($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_pubs where $str2";
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

	public static function getAllStudents_pubs($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_pubs';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_pubs();
			list($tmp[$i]->pub_id,$tmp[$i]->pub_title,$tmp[$i]->pub_date,$tmp[$i]->pub_name,$tmp[$i]->pub_desc,$tmp[$i]->pub_skills,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-04-30 06:59:12  
*/

class achievements{
	protected $achiev_id;
	protected $achiev_title;
	protected $achiev_date;
	protected $achiev_description;
	protected $profile_id;


	function __construct($achiev_id_arg=null,$achiev_title_arg=null,$achiev_date_arg=null,$achiev_description_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->achiev_id=$achiev_id_arg;
			$this->achiev_title=$achiev_title_arg;
			$this->achiev_date=$achiev_date_arg;
			$this->achiev_description=$achiev_description_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getAchiev_id(){
		return $this->achiev_id;
	}

	public function getAchiev_title(){
		return $this->achiev_title;
	}

	public function getAchiev_date(){
		return $this->achiev_date;
	}

	public function getAchiev_description(){
		return $this->achiev_description;
	}

	public function getProfile_id(){
		return $this->profile_id;
	}

	public function setAchiev_id($achiev_id){
		$this->achiev_id=$achiev_id;
	}

	public function setAchiev_title($achiev_title){
		$this->achiev_title=$achiev_title;
	}

	public function setAchiev_date($achiev_date){
		$this->achiev_date=$achiev_date;
	}

	public function setAchiev_description($achiev_description){
		$this->achiev_description=$achiev_description;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function genAchiev_id(){
		
		$db = new DB();
		$sql="select max(achiev_id) from achievements";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$achiev_id1=$this->genAchiev_id();
		$achiev_title1=$this->getAchiev_title();
		$achiev_date1=$this->getAchiev_date();
		$achiev_description1=$this->getAchiev_description();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `achievements` (`achiev_id`,`achiev_title`,`achiev_date`,`achiev_description`,`profile_id`) values('$achiev_id1','$achiev_title1','$achiev_date1','$achiev_description1','$profile_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setachiev_id($achiev_id1);
			return true;
		}
		else return false;
	}
	public function findOnAchiev_id($achiev_id){
		
		$db = new DB();
		$sql="select * from achievements where achiev_id='$achiev_id'";
		$result=$db->execute_query($sql);
		list($this->achiev_id,$this->achiev_title,$this->achiev_date,$this->achiev_description,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateAchiev_title($achiev_title1,$achiev_id1){
		
		$db = new DB();
		$sql="update achievements set achiev_title='$achiev_title1' where achiev_id='$achiev_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAchiev_date($achiev_date1,$achiev_id1){
		
		$db = new DB();
		$sql="update achievements set achiev_date='$achiev_date1' where achiev_id='$achiev_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAchiev_description($achiev_description1,$achiev_id1){
		
		$db = new DB();
		$sql="update achievements set achiev_description='$achiev_description1' where achiev_id='$achiev_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$achiev_id1){
		
		$db = new DB();
		$sql="update achievements set profile_id='$profile_id1' where achiev_id='$achiev_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllAchievements($achiev_id1){
		
		$db = new DB();
		$achiev_title1=$this->getachiev_title();
		$achiev_date1=$this->getachiev_date();
		$achiev_description1=$this->getachiev_description();
		$profile_id1=$this->getprofile_id();
		$sql="update `achievements` set `achiev_title`='$achiev_title1',`achiev_date`='$achiev_date1',`achiev_description`='$achiev_description1',`profile_id`='$profile_id1' where achiev_id='$achiev_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($achiev_id1){
		
		$db = new DB();
		$sql="delete from achievements where achiev_id='$achiev_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnAchievements($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from achievements where $str2";
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

	public static function getAllAchievements($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from achievements';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new achievements();
			list($tmp[$i]->achiev_id,$tmp[$i]->achiev_title,$tmp[$i]->achiev_date,$tmp[$i]->achiev_description,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-23 11:20:56  
*/

class students_prof_dev{
	protected $id;
	protected $dev_type;
	protected $dev_name;
	protected $start_date;
	protected $end_date;
	protected $description;
	protected $profile_id;


	function __construct($id_arg=null,$dev_type_arg=null,$dev_name_arg=null,$start_date_arg=null,$end_date_arg=null,$description_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->id=$id_arg;
			$this->dev_type=$dev_type_arg;
			$this->dev_name=$dev_name_arg;
			$this->start_date=$start_date_arg;
			$this->end_date=$end_date_arg;
			$this->description=$description_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getId(){
		return $this->id;
	}

	public function getDev_type(){
		return $this->dev_type;
	}

	public function getDev_name(){
		return $this->dev_name;
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

	public function setDev_type($dev_type){
		$this->dev_type=$dev_type;
	}

	public function setDev_name($dev_name){
		$this->dev_name=$dev_name;
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
		$sql="select max(id) from students_prof_dev";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$id1=$this->genId();
		$dev_type1=$this->getDev_type();
		$dev_name1=$this->getDev_name();
		$start_date1=$this->getStart_date();
		$end_date1=$this->getEnd_date();
		$description1=$this->getDescription();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `students_prof_dev` (`id`,`dev_type`,`dev_name`,`start_date`,`end_date`,`description`,`profile_id`) values('$id1','$dev_type1','$dev_name1','$start_date1','$end_date1','$description1','$profile_id1')";
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
		$sql="select * from students_prof_dev where id='$id'";
		$result=$db->execute_query($sql);
		list($this->id,$this->dev_type,$this->dev_name,$this->start_date,$this->end_date,$this->description,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateDev_type($dev_type1,$id1){
		
		$db = new DB();
		$sql="update students_prof_dev set dev_type='$dev_type1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDev_name($dev_name1,$id1){
		
		$db = new DB();
		$sql="update students_prof_dev set dev_name='$dev_name1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateStart_date($start_date1,$id1){
		
		$db = new DB();
		$sql="update students_prof_dev set start_date='$start_date1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEnd_date($end_date1,$id1){
		
		$db = new DB();
		$sql="update students_prof_dev set end_date='$end_date1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDescription($description1,$id1){
		
		$db = new DB();
		$sql="update students_prof_dev set description='$description1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$id1){
		
		$db = new DB();
		$sql="update students_prof_dev set profile_id='$profile_id1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_prof_dev($id1){
		
		$db = new DB();
		$dev_type1=$this->getdev_type();
		$dev_name1=$this->getdev_name();
		$start_date1=$this->getstart_date();
		$end_date1=$this->getend_date();
		$description1=$this->getdescription();
		$profile_id1=$this->getprofile_id();
		$sql="update `students_prof_dev` set `dev_type`='$dev_type1',`dev_name`='$dev_name1',`start_date`='$start_date1',`end_date`='$end_date1',`description`='$description1',`profile_id`='$profile_id1' where id='$id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($id1){
		
		$db = new DB();
		$sql="delete from students_prof_dev where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_prof_dev($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_prof_dev where $str2";
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

	public static function getAllStudents_prof_dev($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_prof_dev';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_prof_dev();
			list($tmp[$i]->id,$tmp[$i]->dev_type,$tmp[$i]->dev_name,$tmp[$i]->start_date,$tmp[$i]->end_date,$tmp[$i]->description,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-30 21:04:26  
*/

class job_offer{
	protected $id;
	protected $job_id;
	protected $student_id;
	protected $status;
	protected $offered_text;


	function __construct($id_arg=null,$job_id_arg=null,$student_id_arg=null,$status_arg=null,$offered_text_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->id=$id_arg;
			$this->job_id=$job_id_arg;
			$this->student_id=$student_id_arg;
			$this->status=$status_arg;
			$this->offered_text=$offered_text_arg;
		}
	}


	public function getId(){
		return $this->id;
	}

	public function getJob_id(){
		return $this->job_id;
	}

	public function getStudent_id(){
		return $this->student_id;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getOffered_text(){
		return $this->offered_text;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setJob_id($job_id){
		$this->job_id=$job_id;
	}

	public function setStudent_id($student_id){
		$this->student_id=$student_id;
	}

	public function setStatus($status){
		$this->status=$status;
	}

	public function setOffered_text($offered_text){
		$this->offered_text=$offered_text;
	}

	public function genid(){
		
		$db = new DB();
		$sql="select max(id) from job_offer";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$id1=$this->getId();
		$job_id1=$this->getJob_id();
		$student_id1=$this->getStudent_id();
		$status1=$this->getStatus();
		$offered_text1=$this->getOffered_text();
		$sql="insert into `job_offer` (`id`,`job_id`,`student_id`,`status`,`offered_text`) values('$id1','$job_id1','$student_id1','$status1','$offered_text1')";
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
		$sql="select * from job_offer where id='$id'";
		$result=$db->execute_query($sql);
		list($this->id,$this->job_id,$this->student_id,$this->status,$this->offered_text)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateJob_id($job_id1,$id1){
		
		$db = new DB();
		$sql="update job_offer set job_id='$job_id1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateStudent_id($student_id1,$id1){
		
		$db = new DB();
		$sql="update job_offer set student_id='$student_id1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateStatus($status1,$id1){
		
		$db = new DB();
		$sql="update job_offer set status='$status1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateOffered_text($offered_text1,$id1){
		
		$db = new DB();
		$sql="update job_offer set offered_text='$offered_text1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllJob_offer($id1){
		
		$db = new DB();
		$job_id1=$this->getjob_id();
		$student_id1=$this->getstudent_id();
		$status1=$this->getstatus();
		$offered_text1=$this->getoffered_text();
		$sql="update `job_offer` set `job_id`='$job_id1',`student_id`='$student_id1',`status`='$status1',`offered_text`='$offered_text1' where id='$id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($id1){
		
		$db = new DB();
		$sql="delete from job_offer where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnJob_offer($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from job_offer where $str2";
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

	public static function getAllJob_offer($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from job_offer';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new job_offer();
			list($tmp[$i]->id,$tmp[$i]->job_id,$tmp[$i]->student_id,$tmp[$i]->status,$tmp[$i]->offered_text)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

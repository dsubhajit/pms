<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-05 14:06:10  
*/

class job_application{
	protected $job_app_id;
	protected $job_id;
	protected $student_profile_id;
	protected $company_profile_id;
	protected $application_status;
	protected $doa;


	function __construct($job_app_id_arg=null,$job_id_arg=null,$student_profile_id_arg=null,$company_profile_id_arg=null,$application_status_arg=null,$doa_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->job_app_id=$job_app_id_arg;
			$this->job_id=$job_id_arg;
			$this->student_profile_id=$student_profile_id_arg;
			$this->company_profile_id=$company_profile_id_arg;
			$this->application_status=$application_status_arg;
			$this->doa=$doa_arg;
		}
	}


	public function getJob_app_id(){
		return $this->job_app_id;
	}

	public function getJob_id(){
		return $this->job_id;
	}

	public function getStudent_profile_id(){
		return $this->student_profile_id;
	}

	public function getCompany_profile_id(){
		return $this->company_profile_id;
	}

	public function getApplication_status(){
		return $this->application_status;
	}

	public function getDoa(){
		return $this->doa;
	}

	public function setJob_app_id($job_app_id){
		$this->job_app_id=$job_app_id;
	}

	public function setJob_id($job_id){
		$this->job_id=$job_id;
	}

	public function setStudent_profile_id($student_profile_id){
		$this->student_profile_id=$student_profile_id;
	}

	public function setCompany_profile_id($company_profile_id){
		$this->company_profile_id=$company_profile_id;
	}

	public function setApplication_status($application_status){
		$this->application_status=$application_status;
	}

	public function setDoa($doa){
		$this->doa=$doa;
	}

	public function genJob_app_id(){
		
		$db = new DB();
		$sql="select max(job_app_id) from job_application";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$job_app_id1=$this->genJob_app_id();
		$job_id1=$this->getJob_id();
		$student_profile_id1=$this->getStudent_profile_id();
		$company_profile_id1=$this->getCompany_profile_id();
		$application_status1=$this->getApplication_status();
		$doa1=$this->getDoa();
		$sql="insert into `job_application` (`job_app_id`,`job_id`,`student_profile_id`,`company_profile_id`,`application_status`,`doa`) values('$job_app_id1','$job_id1','$student_profile_id1','$company_profile_id1','$application_status1','$doa1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setjob_app_id($job_app_id1);
			return true;
		}
		else return false;
	}
	public function findOnJob_app_id($job_app_id){
		
		$db = new DB();
		$sql="select * from job_application where job_app_id='$job_app_id'";
		$result=$db->execute_query($sql);
		list($this->job_app_id,$this->job_id,$this->student_profile_id,$this->company_profile_id,$this->application_status,$this->doa)=mysql_fetch_array($result);
		$db->close_connection();
	}
        
        public function findOnJob_app_idAndUser_id($job_id,$student_profile_id){
		
		$db = new DB();
		$sql="select * from job_application where job_id='$job_id' and student_profile_id='$student_profile_id'";
		$result=$db->execute_query($sql);
                //echo $sql;
		list($this->job_app_id,$this->job_id,$this->student_profile_id,$this->company_profile_id,$this->application_status,$this->doa)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateJob_id($job_id1,$job_app_id1){
		
		$db = new DB();
		$sql="update job_application set job_id='$job_id1' where job_app_id='$job_app_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateStudent_profile_id($student_profile_id1,$job_app_id1){
		
		$db = new DB();
		$sql="update job_application set student_profile_id='$student_profile_id1' where job_app_id='$job_app_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCompany_profile_id($company_profile_id1,$job_app_id1){
		
		$db = new DB();
		$sql="update job_application set company_profile_id='$company_profile_id1' where job_app_id='$job_app_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateApplication_status($application_status1,$job_app_id1){
		
		$db = new DB();
		$sql="update job_application set application_status='$application_status1' where job_app_id='$job_app_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDoa($doa1,$job_app_id1){
		
		$db = new DB();
		$sql="update job_application set doa='$doa1' where job_app_id='$job_app_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllJob_application($job_app_id1){
		
		$db = new DB();
		$job_id1=$this->getjob_id();
		$student_profile_id1=$this->getstudent_profile_id();
		$company_profile_id1=$this->getcompany_profile_id();
		$application_status1=$this->getapplication_status();
		$doa1=$this->getdoa();
		$sql="update `job_application` set `job_id`='$job_id1',`student_profile_id`='$student_profile_id1',`company_profile_id`='$company_profile_id1',`application_status`='$application_status1',`doa`='$doa1' where job_app_id='$job_app_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($job_app_id1){
		
		$db = new DB();
		$sql="delete from job_application where job_app_id='$job_app_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnJob_application($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from job_application where $str2";
		$result=$db->execute_query($sql);
		$res=Array();
                //echo $sql;
		if($result){
                    $i=0;
                    while($row = mysql_fetch_array($result, MYSQL_NUM)){
                            $res[$i++]=$row;
                    }
		}
		$db->close_connection();
		return $res;
	}

	public static function getAllJob_application($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from job_application';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
                if($result){
                    while($row = mysql_fetch_array($result, MYSQL_NUM)){
                            $tmp[++$i] = new job_application();
                            list($tmp[$i]->job_app_id,$tmp[$i]->job_id,$tmp[$i]->student_profile_id,$tmp[$i]->company_profile_id,$tmp[$i]->application_status,$tmp[$i]->doa)=$row;
                    }
                }
		$db->close_connection();
		return $tmp;
	}
}
?>

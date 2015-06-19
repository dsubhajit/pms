<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-04 19:13:25  
*/

class job_list{
	protected $job_id;
	protected $job_serial;
	protected $job_title;
	protected $degree;
	protected $branches;
	protected $job_desc;
	protected $package;
	protected $create_date;
	protected $last_date;
	protected $profile_id;
	protected $verified;
	protected $publish;


	function __construct($job_id_arg=null,$job_serial_arg=null,$job_title_arg=null,$degree_arg=null,$branches_arg=null,$job_desc_arg=null,$package_arg=null,$create_date_arg=null,$last_date_arg=null,$profile_id_arg=null,$verified_arg=null,$publish_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->job_id=$job_id_arg;
			$this->job_serial=$job_serial_arg;
			$this->job_title=$job_title_arg;
			$this->degree=$degree_arg;
			$this->branches=$branches_arg;
			$this->job_desc=$job_desc_arg;
			$this->package=$package_arg;
			$this->create_date=$create_date_arg;
			$this->last_date=$last_date_arg;
			$this->profile_id=$profile_id_arg;
			$this->verified=$verified_arg;
			$this->publish=$publish_arg;
		}
	}


	public function getJob_id(){
		return $this->job_id;
	}

	public function getJob_serial(){
		return $this->job_serial;
	}

	public function getJob_title(){
		return $this->job_title;
	}

	public function getDegree(){
		return $this->degree;
	}

	public function getBranches(){
		return $this->branches;
	}

	public function getJob_desc(){
		return $this->job_desc;
	}

	public function getPackage(){
		return $this->package;
	}

	public function getCreate_date(){
		return $this->create_date;
	}

	public function getLast_date(){
		return $this->last_date;
	}

	public function getProfile_id(){
		return $this->profile_id;
	}

	public function getVerified(){
		return $this->verified;
	}

	public function getPublish(){
		return $this->publish;
	}

	public function setJob_id($job_id){
		$this->job_id=$job_id;
	}

	public function setJob_serial($job_serial){
		$this->job_serial=$job_serial;
	}

	public function setJob_title($job_title){
		$this->job_title=$job_title;
	}

	public function setDegree($degree){
		$this->degree=$degree;
	}

	public function setBranches($branches){
		$this->branches=$branches;
	}

	public function setJob_desc($job_desc){
		$this->job_desc=$job_desc;
	}

	public function setPackage($package){
		$this->package=$package;
	}

	public function setCreate_date($create_date){
		$this->create_date=$create_date;
	}

	public function setLast_date($last_date){
		$this->last_date=$last_date;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function setVerified($verified){
		$this->verified=$verified;
	}

	public function setPublish($publish){
		$this->publish=$publish;
	}

	public function genJob_id(){
		
		$db = new DB();
		$sql="select max(job_id) from job_list";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$job_id1=$this->genJob_id();
		$job_serial1=$this->getJob_serial();
		$job_title1=$this->getJob_title();
		$degree1=$this->getDegree();
		$branches1=$this->getBranches();
		$job_desc1=$this->getJob_desc();
		$package1=$this->getPackage();
		$create_date1=$this->getCreate_date();
		$last_date1=$this->getLast_date();
		$profile_id1=$this->getProfile_id();
		$verified1=$this->getVerified();
		$publish1=$this->getPublish();
		$sql="insert into `job_list` (`job_id`,`job_serial`,`job_title`,`degree`,`branches`,`job_desc`,`package`,`create_date`,`last_date`,`profile_id`,`verified`,`publish`) values('$job_id1','$job_serial1','$job_title1','$degree1','$branches1','$job_desc1','$package1','$create_date1','$last_date1','$profile_id1','$verified1','$publish1')";
                
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
                    $this->setjob_id($job_id1);
                    return true;
		}
		else return false;
	}
	public function findOnJob_id($job_id){		
            $db = new DB();
            $sql="select * from job_list where job_id='$job_id'";
            $result=$db->execute_query($sql);
            list($this->job_id,$this->job_serial,$this->job_title,$this->degree,$this->branches,$this->job_desc,$this->package,$this->create_date,$this->last_date,$this->profile_id,$this->verified,$this->publish)=mysql_fetch_array($result);
            $db->close_connection();
	}

	public function updateJob_serial($job_serial1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set job_serial='$job_serial1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateJob_title($job_title1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set job_title='$job_title1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDegree($degree1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set degree='$degree1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateBranches($branches1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set branches='$branches1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateJob_desc($job_desc1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set job_desc='$job_desc1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePackage($package1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set package='$package1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCreate_date($create_date1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set create_date='$create_date1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateLast_date($last_date1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set last_date='$last_date1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set profile_id='$profile_id1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateVerified($verified1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set verified='$verified1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePublish($publish1,$job_id1){
		
		$db = new DB();
		$sql="update job_list set publish='$publish1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllJob_list($job_id1){
		
		$db = new DB();
		$job_serial1=$this->getjob_serial();
		$job_title1=$this->getjob_title();
		$degree1=$this->getdegree();
		$branches1=$this->getbranches();
		$job_desc1=$this->getjob_desc();
		$package1=$this->getpackage();
		$create_date1=$this->getcreate_date();
		$last_date1=$this->getlast_date();
		$profile_id1=$this->getprofile_id();
		$verified1=$this->getverified();
		$publish1=$this->getpublish();
		$sql="update `job_list` set `job_serial`='$job_serial1',`job_title`='$job_title1',`degree`='$degree1',`branches`='$branches1',`job_desc`='$job_desc1',`package`='$package1',`create_date`='$create_date1',`last_date`='$last_date1',`profile_id`='$profile_id1',`verified`='$verified1',`publish`='$publish1' where job_id='$job_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($job_id1){
		
		$db = new DB();
		$sql="delete from job_list where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnJob_list($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from job_list where $str2";
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

	public static function getAllJob_list($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from job_list';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
                //echo $sql;
		if($result){
			while($row = mysql_fetch_array($result, MYSQL_NUM)){
				$tmp[++$i] = new job_list();
				list($tmp[$i]->job_id,$tmp[$i]->job_serial,$tmp[$i]->job_title,$tmp[$i]->degree,$tmp[$i]->branches,$tmp[$i]->job_desc,$tmp[$i]->package,$tmp[$i]->create_date,$tmp[$i]->last_date,$tmp[$i]->profile_id,$tmp[$i]->verified,$tmp[$i]->publish)=$row;
			}
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

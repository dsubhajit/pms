<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-29 22:45:36  
*/

class jobs{
	protected $job_id;
	protected $desg;
	protected $description;
	protected $loc;
	protected $num_of_off;
	protected $num_rounds;
	protected $criteria;
	protected $degree;
	protected $department;
	protected $branch;
	protected $create_date;
	protected $last_date;
	protected $profile_id;
	protected $verified;
	protected $publish;


	function __construct($job_id_arg=null,$desg_arg=null,$description_arg=null,$loc_arg=null,$num_of_off_arg=null,$num_rounds_arg=null,$criteria_arg=null,$degree_arg=null,$department_arg=null,$branch_arg=null,$create_date_arg=null,$last_date_arg=null,$profile_id_arg=null,$verified_arg=null,$publish_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->job_id=$job_id_arg;
			$this->desg=$desg_arg;
			$this->description=$description_arg;
			$this->loc=$loc_arg;
			$this->num_of_off=$num_of_off_arg;
			$this->num_rounds=$num_rounds_arg;
			$this->criteria=$criteria_arg;
			$this->degree=$degree_arg;
			$this->department=$department_arg;
			$this->branch=$branch_arg;
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

	public function getDesg(){
		return $this->desg;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getLoc(){
		return $this->loc;
	}

	public function getNum_of_off(){
		return $this->num_of_off;
	}

	public function getNum_rounds(){
		return $this->num_rounds;
	}

	public function getCriteria(){
		return $this->criteria;
	}

	public function getDegree(){
		return $this->degree;
	}

	public function getDepartment(){
		return $this->department;
	}

	public function getBranch(){
		return $this->branch;
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

	public function setDesg($desg){
		$this->desg=$desg;
	}

	public function setDescription($description){
		$this->description=$description;
	}

	public function setLoc($loc){
		$this->loc=$loc;
	}

	public function setNum_of_off($num_of_off){
		$this->num_of_off=$num_of_off;
	}

	public function setNum_rounds($num_rounds){
		$this->num_rounds=$num_rounds;
	}

	public function setCriteria($criteria){
		$this->criteria=$criteria;
	}

	public function setDegree($degree){
		$this->degree=$degree;
	}

	public function setDepartment($department){
		$this->department=$department;
	}

	public function setBranch($branch){
		$this->branch=$branch;
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
		$sql="select max(job_id) from jobs";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$job_id1=$this->genJob_id();
		$desg1=$this->getDesg();
		$description1=$this->getDescription();
		$loc1=$this->getLoc();
		$num_of_off1=$this->getNum_of_off();
		$num_rounds1=$this->getNum_rounds();
		$criteria1=$this->getCriteria();
		$degree1=$this->getDegree();
		$department1=$this->getDepartment();
		$branch1=$this->getBranch();
		$create_date1=$this->getCreate_date();
		$last_date1=$this->getLast_date();
		$profile_id1=$this->getProfile_id();
		$verified1=$this->getVerified();
		$publish1=$this->getPublish();
		$sql="insert into `jobs` (`job_id`,`desg`,`description`,`loc`,`num_of_off`,`num_rounds`,`criteria`,`degree`,`department`,`branch`,`create_date`,`last_date`,`profile_id`,`verified`,`publish`) values('$job_id1','$desg1','$description1','$loc1','$num_of_off1','$num_rounds1','$criteria1','$degree1','$department1','$branch1','$create_date1','$last_date1','$profile_id1','$verified1','$publish1')";
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
		$sql="select * from jobs where job_id='$job_id'";
		$result=$db->execute_query($sql);
		list($this->job_id,$this->desg,$this->description,$this->loc,$this->num_of_off,$this->num_rounds,$this->criteria,$this->degree,$this->department,$this->branch,$this->create_date,$this->last_date,$this->profile_id,$this->verified,$this->publish)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateDesg($desg1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set desg='$desg1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDescription($description1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set description='$description1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateLoc($loc1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set loc='$loc1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateNum_of_off($num_of_off1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set num_of_off='$num_of_off1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateNum_rounds($num_rounds1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set num_rounds='$num_rounds1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCriteria($criteria1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set criteria='$criteria1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDegree($degree1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set degree='$degree1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDepartment($department1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set department='$department1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateBranch($branch1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set branch='$branch1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCreate_date($create_date1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set create_date='$create_date1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateLast_date($last_date1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set last_date='$last_date1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set profile_id='$profile_id1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateVerified($verified1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set verified='$verified1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePublish($publish1,$job_id1){
		
		$db = new DB();
		$sql="update jobs set publish='$publish1' where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllJobs($job_id1){
		
		$db = new DB();
		$desg1=$this->getdesg();
		$description1=$this->getdescription();
		$loc1=$this->getloc();
		$num_of_off1=$this->getnum_of_off();
		$num_rounds1=$this->getnum_rounds();
		$criteria1=$this->getcriteria();
		$degree1=$this->getdegree();
		$department1=$this->getdepartment();
		$branch1=$this->getbranch();
		$create_date1=$this->getcreate_date();
		$last_date1=$this->getlast_date();
		$profile_id1=$this->getprofile_id();
		$verified1=$this->getverified();
		$publish1=$this->getpublish();
		$sql="update `jobs` set `desg`='$desg1',`description`='$description1',`loc`='$loc1',`num_of_off`='$num_of_off1',`num_rounds`='$num_rounds1',`criteria`='$criteria1',`degree`='$degree1',`department`='$department1',`branch`='$branch1',`create_date`='$create_date1',`last_date`='$last_date1',`profile_id`='$profile_id1',`verified`='$verified1',`publish`='$publish1' where job_id='$job_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($job_id1){
		
		$db = new DB();
		$sql="delete from jobs where job_id='$job_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnJobs($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from jobs where $str2";
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

	public static function getAllJobs($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from jobs';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
                //echo $sql;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new jobs();
			list($tmp[$i]->job_id,$tmp[$i]->desg,$tmp[$i]->description,$tmp[$i]->loc,$tmp[$i]->num_of_off,$tmp[$i]->num_rounds,$tmp[$i]->criteria,$tmp[$i]->degree,$tmp[$i]->department,$tmp[$i]->branch,$tmp[$i]->create_date,$tmp[$i]->last_date,$tmp[$i]->profile_id,$tmp[$i]->verified,$tmp[$i]->publish)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

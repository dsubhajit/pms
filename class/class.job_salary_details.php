<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-29 22:45:39  
*/

class job_salary_details{
	protected $sd_id;
	protected $degree;
	protected $ctc;
	protected $gross;
	protected $bonus;
	protected $bond;
	protected $job_id;


	function __construct($sd_id_arg=null,$degree_arg=null,$ctc_arg=null,$gross_arg=null,$bonus_arg=null,$bond_arg=null,$job_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->sd_id=$sd_id_arg;
			$this->degree=$degree_arg;
			$this->ctc=$ctc_arg;
			$this->gross=$gross_arg;
			$this->bonus=$bonus_arg;
			$this->bond=$bond_arg;
			$this->job_id=$job_id_arg;
		}
	}


	public function getSd_id(){
		return $this->sd_id;
	}

	public function getDegree(){
		return $this->degree;
	}

	public function getCtc(){
		return $this->ctc;
	}

	public function getGross(){
		return $this->gross;
	}

	public function getBonus(){
		return $this->bonus;
	}

	public function getBond(){
		return $this->bond;
	}

	public function getJob_id(){
		return $this->job_id;
	}

	public function setSd_id($sd_id){
		$this->sd_id=$sd_id;
	}

	public function setDegree($degree){
		$this->degree=$degree;
	}

	public function setCtc($ctc){
		$this->ctc=$ctc;
	}

	public function setGross($gross){
		$this->gross=$gross;
	}

	public function setBonus($bonus){
		$this->bonus=$bonus;
	}

	public function setBond($bond){
		$this->bond=$bond;
	}

	public function setJob_id($job_id){
		$this->job_id=$job_id;
	}

	public function genSd_id(){
		
		$db = new DB();
		$sql="select max(sd_id) from job_salary_details";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$sd_id1=$this->genSd_id();
		$degree1=$this->getDegree();
		$ctc1=$this->getCtc();
		$gross1=$this->getGross();
		$bonus1=$this->getBonus();
		$bond1=$this->getBond();
		$job_id1=$this->getJob_id();
		$sql="insert into `job_salary_details` (`sd_id`,`degree`,`ctc`,`gross`,`bonus`,`bond`,`job_id`) values('$sd_id1','$degree1','$ctc1','$gross1','$bonus1','$bond1','$job_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setsd_id($sd_id1);
			return true;
		}
		else return false;
	}
	public function findOnSd_id($sd_id){
		
		$db = new DB();
		$sql="select * from job_salary_details where sd_id='$sd_id'";
		$result=$db->execute_query($sql);
		list($this->sd_id,$this->degree,$this->ctc,$this->gross,$this->bonus,$this->bond,$this->job_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateDegree($degree1,$sd_id1){
		
		$db = new DB();
		$sql="update job_salary_details set degree='$degree1' where sd_id='$sd_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCtc($ctc1,$sd_id1){
		
		$db = new DB();
		$sql="update job_salary_details set ctc='$ctc1' where sd_id='$sd_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateGross($gross1,$sd_id1){
		
		$db = new DB();
		$sql="update job_salary_details set gross='$gross1' where sd_id='$sd_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateBonus($bonus1,$sd_id1){
		
		$db = new DB();
		$sql="update job_salary_details set bonus='$bonus1' where sd_id='$sd_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateBond($bond1,$sd_id1){
		
		$db = new DB();
		$sql="update job_salary_details set bond='$bond1' where sd_id='$sd_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateJob_id($job_id1,$sd_id1){
		
		$db = new DB();
		$sql="update job_salary_details set job_id='$job_id1' where sd_id='$sd_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllJob_salary_details($sd_id1){
		
		$db = new DB();
		$degree1=$this->getdegree();
		$ctc1=$this->getctc();
		$gross1=$this->getgross();
		$bonus1=$this->getbonus();
		$bond1=$this->getbond();
		$job_id1=$this->getjob_id();
		$sql="update `job_salary_details` set `degree`='$degree1',`ctc`='$ctc1',`gross`='$gross1',`bonus`='$bonus1',`bond`='$bond1',`job_id`='$job_id1' where sd_id='$sd_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($sd_id1){
		
		$db = new DB();
		$sql="delete from job_salary_details where sd_id='$sd_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnJob_salary_details($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from job_salary_details where $str2";
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

	public static function getAllJob_salary_details($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from job_salary_details';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new job_salary_details();
			list($tmp[$i]->sd_id,$tmp[$i]->degree,$tmp[$i]->ctc,$tmp[$i]->gross,$tmp[$i]->bonus,$tmp[$i]->bond,$tmp[$i]->job_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

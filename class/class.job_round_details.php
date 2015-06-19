<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-29 22:45:44  
*/

class job_round_details{
	protected $round_id;
	protected $round_name;
	protected $round_details;
	protected $job_id;


	function __construct($round_id_arg=null,$round_name_arg=null,$round_details_arg=null,$job_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->round_id=$round_id_arg;
			$this->round_name=$round_name_arg;
			$this->round_details=$round_details_arg;
			$this->job_id=$job_id_arg;
		}
	}


	public function getRound_id(){
		return $this->round_id;
	}

	public function getRound_name(){
		return $this->round_name;
	}

	public function getRound_details(){
		return $this->round_details;
	}

	public function getJob_id(){
		return $this->job_id;
	}

	public function setRound_id($round_id){
		$this->round_id=$round_id;
	}

	public function setRound_name($round_name){
		$this->round_name=$round_name;
	}

	public function setRound_details($round_details){
		$this->round_details=$round_details;
	}

	public function setJob_id($job_id){
		$this->job_id=$job_id;
	}

	public function genRound_id(){
		
		$db = new DB();
		$sql="select max(round_id) from job_round_details";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$round_id1=$this->genRound_id();
		$round_name1=$this->getRound_name();
		$round_details1=$this->getRound_details();
		$job_id1=$this->getJob_id();
		$sql="insert into `job_round_details` (`round_id`,`round_name`,`round_details`,`job_id`) values('$round_id1','$round_name1','$round_details1','$job_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setround_id($round_id1);
			return true;
		}
		else return false;
	}
	public function findOnRound_id($round_id){
		
		$db = new DB();
		$sql="select * from job_round_details where round_id='$round_id'";
		$result=$db->execute_query($sql);
		list($this->round_id,$this->round_name,$this->round_details,$this->job_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateRound_name($round_name1,$round_id1){
		
		$db = new DB();
		$sql="update job_round_details set round_name='$round_name1' where round_id='$round_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateRound_details($round_details1,$round_id1){
		
		$db = new DB();
		$sql="update job_round_details set round_details='$round_details1' where round_id='$round_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateJob_id($job_id1,$round_id1){
		
		$db = new DB();
		$sql="update job_round_details set job_id='$job_id1' where round_id='$round_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllJob_round_details($round_id1){
		
		$db = new DB();
		$round_name1=$this->getround_name();
		$round_details1=$this->getround_details();
		$job_id1=$this->getjob_id();
		$sql="update `job_round_details` set `round_name`='$round_name1',`round_details`='$round_details1',`job_id`='$job_id1' where round_id='$round_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($round_id1){
		
		$db = new DB();
		$sql="delete from job_round_details where round_id='$round_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnJob_round_details($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from job_round_details where $str2";
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

	public static function getAllJob_round_details($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from job_round_details';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new job_round_details();
			list($tmp[$i]->round_id,$tmp[$i]->round_name,$tmp[$i]->round_details,$tmp[$i]->job_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

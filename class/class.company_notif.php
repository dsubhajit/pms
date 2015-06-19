<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-23 03:54:14  
*/

class company_notif{
	protected $notif_id;
	protected $notif_title;
	protected $notif_desc;
	protected $notif_date;
	protected $severity;


	function __construct($notif_id_arg=null,$notif_title_arg=null,$notif_desc_arg=null,$notif_date_arg=null,$severity_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->notif_id=$notif_id_arg;
			$this->notif_title=$notif_title_arg;
			$this->notif_desc=$notif_desc_arg;
			$this->notif_date=$notif_date_arg;
			$this->severity=$severity_arg;
		}
	}


	public function getNotif_id(){
		return $this->notif_id;
	}

	public function getNotif_title(){
		return $this->notif_title;
	}

	public function getNotif_desc(){
		return $this->notif_desc;
	}

	public function getNotif_date(){
		return $this->notif_date;
	}

	public function getSeverity(){
		return $this->severity;
	}

	public function setNotif_id($notif_id){
		$this->notif_id=$notif_id;
	}

	public function setNotif_title($notif_title){
		$this->notif_title=$notif_title;
	}

	public function setNotif_desc($notif_desc){
		$this->notif_desc=$notif_desc;
	}

	public function setNotif_date($notif_date){
		$this->notif_date=$notif_date;
	}

	public function setSeverity($severity){
		$this->severity=$severity;
	}

	public function genNotif_id(){		
		$db = new DB();
		$sql="select max(notif_id) from company_notif";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$notif_id1=$this->genNotif_id();
		$notif_title1=$this->getNotif_title();
		$notif_desc1=$this->getNotif_desc();
		$notif_date1=$this->getNotif_date();
		$severity1=$this->getSeverity();
		$sql="insert into `company_notif` (`notif_id`,`notif_title`,`notif_desc`,`notif_date`,`severity`) values('$notif_id1','$notif_title1','$notif_desc1','$notif_date1','$severity1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setnotif_id($notif_id1);
			return true;
		}
		else return false;
	}
	public function findOnNotif_id($notif_id){
		
		$db = new DB();
		$sql="select * from company_notif where notif_id='$notif_id'";
		$result=$db->execute_query($sql);
		list($this->notif_id,$this->notif_title,$this->notif_desc,$this->notif_date,$this->severity)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateNotif_title($notif_title1,$notif_id1){
		
		$db = new DB();
		$sql="update company_notif set notif_title='$notif_title1' where notif_id='$notif_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateNotif_desc($notif_desc1,$notif_id1){
		
		$db = new DB();
		$sql="update company_notif set notif_desc='$notif_desc1' where notif_id='$notif_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateNotif_date($notif_date1,$notif_id1){
		
		$db = new DB();
		$sql="update company_notif set notif_date='$notif_date1' where notif_id='$notif_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateSeverity($severity1,$notif_id1){
		
		$db = new DB();
		$sql="update company_notif set severity='$severity1' where notif_id='$notif_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllCompany_notif($notif_id1){
		
		$db = new DB();
		$notif_title1=$this->getnotif_title();
		$notif_desc1=$this->getnotif_desc();
		$notif_date1=$this->getnotif_date();
		$severity1=$this->getseverity();
		$sql="update `company_notif` set `notif_title`='$notif_title1',`notif_desc`='$notif_desc1',`notif_date`='$notif_date1',`severity`='$severity1' where notif_id='$notif_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($notif_id1){
		
		$db = new DB();
		$sql="delete from company_notif where notif_id='$notif_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnCompany_notif($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from company_notif where $str2";
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

	public static function getAllCompany_notif($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from company_notif';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new company_notif();
			list($tmp[$i]->notif_id,$tmp[$i]->notif_title,$tmp[$i]->notif_desc,$tmp[$i]->notif_date,$tmp[$i]->severity)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
        
        
}
?>

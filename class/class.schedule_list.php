<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-30 21:04:31  
*/

class schedule_list{
	protected $id;
	protected $company_id;
	protected $start_date;
	protected $end_date;
	protected $status;
	protected $num_of_mem;
	protected $num_of_rooms;
	protected $req;


	function __construct($id_arg=null,$company_id_arg=null,$start_date_arg=null,$end_date_arg=null,$status_arg=null,$num_of_mem_arg=null,$num_of_rooms_arg=null,$req_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->id=$id_arg;
			$this->company_id=$company_id_arg;
			$this->start_date=$start_date_arg;
			$this->end_date=$end_date_arg;
			$this->status=$status_arg;
			$this->num_of_mem=$num_of_mem_arg;
			$this->num_of_rooms=$num_of_rooms_arg;
			$this->req=$req_arg;
		}
	}


	public function getId(){
		return $this->id;
	}

	public function getCompany_id(){
		return $this->company_id;
	}

	public function getStart_date(){
		return $this->start_date;
	}

	public function getEnd_date(){
		return $this->end_date;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getNum_of_mem(){
		return $this->num_of_mem;
	}

	public function getNum_of_rooms(){
		return $this->num_of_rooms;
	}

	public function getReq(){
		return $this->req;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setCompany_id($company_id){
		$this->company_id=$company_id;
	}

	public function setStart_date($start_date){
		$this->start_date=$start_date;
	}

	public function setEnd_date($end_date){
		$this->end_date=$end_date;
	}

	public function setStatus($status){
		$this->status=$status;
	}

	public function setNum_of_mem($num_of_mem){
		$this->num_of_mem=$num_of_mem;
	}

	public function setNum_of_rooms($num_of_rooms){
		$this->num_of_rooms=$num_of_rooms;
	}

	public function setReq($req){
		$this->req=$req;
	}

	public function genId(){
		
		$db = new DB();
		$sql="select max(id) from schedule_list";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$id1=$this->genId();
		$company_id1=$this->getCompany_id();
		$start_date1=$this->getStart_date();
		$end_date1=$this->getEnd_date();
		$status1=$this->getStatus();
		$num_of_mem1=$this->getNum_of_mem();
		$num_of_rooms1=$this->getNum_of_rooms();
		$req1=$this->getReq();
		$sql="insert into `schedule_list` (`id`,`company_id`,`start_date`,`end_date`,`status`,`num_of_mem`,`num_of_rooms`,`req`) values('$id1','$company_id1','$start_date1','$end_date1','$status1','$num_of_mem1','$num_of_rooms1','$req1')";
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
		$sql="select * from schedule_list where id='$id'";
		$result=$db->execute_query($sql);
		list($this->id,$this->company_id,$this->start_date,$this->end_date,$this->status,$this->num_of_mem,$this->num_of_rooms,$this->req)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateCompany_id($company_id1,$id1){
		
		$db = new DB();
		$sql="update schedule_list set company_id='$company_id1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateStart_date($start_date1,$id1){
		
		$db = new DB();
		$sql="update schedule_list set start_date='$start_date1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEnd_date($end_date1,$id1){
		
		$db = new DB();
		$sql="update schedule_list set end_date='$end_date1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateStatus($status1,$id1){
		
		$db = new DB();
		$sql="update schedule_list set status='$status1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateNum_of_mem($num_of_mem1,$id1){
		
		$db = new DB();
		$sql="update schedule_list set num_of_mem='$num_of_mem1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateNum_of_rooms($num_of_rooms1,$id1){
		
		$db = new DB();
		$sql="update schedule_list set num_of_rooms='$num_of_rooms1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateReq($req1,$id1){
		
		$db = new DB();
		$sql="update schedule_list set req='$req1' where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllSchedule_list($id1){
		
		$db = new DB();
		$company_id1=$this->getcompany_id();
		$start_date1=$this->getstart_date();
		$end_date1=$this->getend_date();
		$status1=$this->getstatus();
		$num_of_mem1=$this->getnum_of_mem();
		$num_of_rooms1=$this->getnum_of_rooms();
		$req1=$this->getreq();
		$sql="update `schedule_list` set `company_id`='$company_id1',`start_date`='$start_date1',`end_date`='$end_date1',`status`='$status1',`num_of_mem`='$num_of_mem1',`num_of_rooms`='$num_of_rooms1',`req`='$req1' where id='$id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($id1){
		
		$db = new DB();
		$sql="delete from schedule_list where id='$id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnSchedule_list($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from schedule_list where $str2";
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

	public static function getAllSchedule_list($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from schedule_list';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new schedule_list();
			list($tmp[$i]->id,$tmp[$i]->company_id,$tmp[$i]->start_date,$tmp[$i]->end_date,$tmp[$i]->status,$tmp[$i]->num_of_mem,$tmp[$i]->num_of_rooms,$tmp[$i]->req)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
        
        public static function checkAvailability($start,$end){
                $db = new DB();
		$sql="select * from schedule_list where (( start_date>='".$start."' and end_date <= '".$end."') or (start_date>='".$start."' and start_date <= '".$end."') or (end_date>='".$start."' and end_date <= '".$end."') or ( start_date<'".$start."' and end_date >'".$end."'));";
		$result=$db->execute_query($sql);
		$res=Array();
                //echo $sql;
		if($result){
                    if(mysql_num_rows($result) > 0 ) return false;
                    else return true;
		}
		$db->close_connection();
		return false;
        }
}
?>

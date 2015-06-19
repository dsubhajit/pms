<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-05 09:37:41  
*/

class degree{
	protected $degree_id;
	protected $degree_name;


	function __construct($degree_id_arg=null,$degree_name_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->degree_id=$degree_id_arg;
			$this->degree_name=$degree_name_arg;
		}
	}


	public function getDegree_id(){
		return $this->degree_id;
	}

	public function getDegree_name(){
		return $this->degree_name;
	}

	public function setDegree_id($degree_id){
		$this->degree_id=$degree_id;
	}

	public function setDegree_name($degree_name){
		$this->degree_name=$degree_name;
	}

	public function genDegree_id(){
		
		$db = new DB();
		$sql="select max(degree_id) from degree";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$degree_id1=$this->genDegree_id();
		$degree_name1=$this->getDegree_name();
		$sql="insert into `degree` (`degree_id`,`degree_name`) values('$degree_id1','$degree_name1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setdegree_id($degree_id1);
			return true;
		}
		else return false;
	}
	public function findOnDegree_id($degree_id){
		
		$db = new DB();
		$sql="select * from degree where degree_id='$degree_id'";
		$result=$db->execute_query($sql);
		list($this->degree_id,$this->degree_name)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateDegree_name($degree_name1,$degree_id1){
		
		$db = new DB();
		$sql="update degree set degree_name='$degree_name1' where degree_id='$degree_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllDegree($degree_id1){
		
		$db = new DB();
		$degree_name1=$this->getdegree_name();
		$sql="update `degree` set `degree_name`='$degree_name1' where degree_id='$degree_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($degree_id1){
		
		$db = new DB();
		$sql="delete from degree where degree_id='$degree_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnDegree($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from degree where $str2";
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

	public static function getAllDegree($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from degree';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new degree();
			list($tmp[$i]->degree_id,$tmp[$i]->degree_name)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
        
        
        public static function getDegreeIdFromName($degree){
                $db=new DB();
		$sql="select * from degree where LOWER(degree_name)='".strtolower($degree)."';";
		//echo $sql;
		$result = $db->execute_query($sql);
                $tmp = new degree();
		list($tmp->degree_id,$tmp->degree_name)=mysql_fetch_array($result);
		$db->close_connection();
		return $tmp;
        }
        
        public static function getDegreeNameFromId($arr){
            $d = new degree();
            foreach ($arr as $d){
                if($d->getDegree_id() == $id){
                    return $d->getDegree_name();
                }
            }
            return "";
        }
}
?>

<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-04-30 06:59:25  
*/

class students_login{
	protected $user_id;
	protected $username;
	protected $password;
	protected $verified;
	protected $activated;
	protected $iscordinator;
	protected $profile_id;


	function __construct($user_id_arg=null,$username_arg=null,$password_arg=null,$verified_arg=null,$activated_arg=null,$iscordinator_arg=null,$profile_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->user_id=$user_id_arg;
			$this->username=$username_arg;
			$this->password=$password_arg;
			$this->verified=$verified_arg;
			$this->activated=$activated_arg;
			$this->iscordinator=$iscordinator_arg;
			$this->profile_id=$profile_id_arg;
		}
	}


	public function getUser_id(){
		return $this->user_id;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getVerified(){
		return $this->verified;
	}

	public function getActivated(){
		return $this->activated;
	}

	public function getIscordinator(){
		return $this->iscordinator;
	}

	public function getProfile_id(){
		return $this->profile_id;
	}

	public function setUser_id($user_id){
		$this->user_id=$user_id;
	}

	public function setUsername($username){
		$this->username=$username;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function setVerified($verified){
		$this->verified=$verified;
	}

	public function setActivated($activated){
		$this->activated=$activated;
	}

	public function setIscordinator($iscordinator){
		$this->iscordinator=$iscordinator;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function genUser_id(){
		
		$db = new DB();
		$sql="select max(user_id) from students_login";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$user_id1=$this->genUser_id();
		$username1=$this->getUsername();
		$password1=$this->getPassword();
		$verified1=$this->getVerified();
		$activated1=$this->getActivated();
		$iscordinator1=$this->getIscordinator();
		$profile_id1=$this->getProfile_id();
		$sql="insert into `students_login` (`user_id`,`username`,`password`,`verified`,`activated`,`iscordinator`,`profile_id`) values('$user_id1','$username1','$password1','$verified1','$activated1','$iscordinator1','$profile_id1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setuser_id($user_id1);
			return true;
		}
		else return false;
	}
	public function findOnUser_id($user_id){
		
		$db = new DB();
		$sql="select * from students_login where user_id='$user_id'";
		$result=$db->execute_query($sql);
		list($this->user_id,$this->username,$this->password,$this->verified,$this->activated,$this->iscordinator,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}
        
        public function findOnUserName($username){
		
		$db = new DB();
		$sql="select * from students_login where username='$username'";
                //echo $sql;
		$result=$db->execute_query($sql);
		list($this->user_id,$this->username,$this->password,$this->verified,$this->activated,$this->iscordinator,$this->profile_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateUsername($username1,$user_id1){
		
		$db = new DB();
		$sql="update students_login set username='$username1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePassword($password1,$user_id1){
		
		$db = new DB();
		$sql="update students_login set password='$password1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateVerified($verified1,$user_id1){
		
		$db = new DB();
		$sql="update students_login set verified='$verified1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateActivated($activated1,$user_id1){
		
		$db = new DB();
		$sql="update students_login set activated='$activated1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateIscordinator($iscordinator1,$user_id1){
		
		$db = new DB();
		$sql="update students_login set iscordinator='$iscordinator1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProfile_id($profile_id1,$user_id1){
		
		$db = new DB();
		$sql="update students_login set profile_id='$profile_id1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_login($user_id1){
		
		$db = new DB();
		$username1=$this->getusername();
		$password1=$this->getpassword();
		$verified1=$this->getverified();
		$activated1=$this->getactivated();
		$iscordinator1=$this->getiscordinator();
		$profile_id1=$this->getprofile_id();
		$sql="update `students_login` set `username`='$username1',`password`='$password1',`verified`='$verified1',`activated`='$activated1',`iscordinator`='$iscordinator1',`profile_id`='$profile_id1' where user_id='$user_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($user_id1){
		
		$db = new DB();
		$sql="delete from students_login where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_login($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_login where $str2";
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

	public static function getAllStudents_login($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_login';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_login();
			list($tmp[$i]->user_id,$tmp[$i]->username,$tmp[$i]->password,$tmp[$i]->verified,$tmp[$i]->activated,$tmp[$i]->iscordinator,$tmp[$i]->profile_id)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
        
        public static function checkLogin($username,$password){     
            $db=new DB();
            if($username!=NULL && $password!=NULL){                        
                $result=  $db->execute_query("select * from students_login where username='$username' and password='".  md5($password)."';");
                if(mysql_num_rows($result) > 0){
                    return TRUE;
                }               
                else return FALSE;
            }
            else return FALSE;
        }
        
        public static function checkUsernameExists($username){     
            $db=new DB();
            if($username!=NULL){        
                $result=  $db->execute_query("select * from students_login where username='$username' ;");                
                if(mysql_num_rows($result) > 0){
                    return FALSE;
                }               
                else return TRUE;
            }
            else return FALSE;
        }
}
?>

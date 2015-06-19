<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-05 09:37:51  
*/

class admin{
	protected $user_id;
	protected $username;
	protected $password;
	protected $fullname;
	protected $email;
	protected $phone;


	function __construct($user_id_arg=null,$username_arg=null,$password_arg=null,$fullname_arg=null,$email_arg=null,$phone_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->user_id=$user_id_arg;
			$this->username=$username_arg;
			$this->password=$password_arg;
			$this->fullname=$fullname_arg;
			$this->email=$email_arg;
			$this->phone=$phone_arg;
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

	public function getFullname(){
		return $this->fullname;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPhone(){
		return $this->phone;
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

	public function setFullname($fullname){
		$this->fullname=$fullname;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setPhone($phone){
		$this->phone=$phone;
	}

	public function genuser_id(){
		
		$db = new DB();
		$sql="select max(user_id) from admin";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$user_id1=$this->getUser_id();
		$username1=$this->getUsername();
		$password1=$this->getPassword();
		$fullname1=$this->getFullname();
		$email1=$this->getEmail();
		$phone1=$this->getPhone();
		$sql="insert into `admin` (`user_id`,`username`,`password`,`fullname`,`email`,`phone`) values('$user_id1','$username1','$password1','$fullname1','$email1','$phone1')";
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
		$sql="select * from admin where user_id='$user_id'";
		$result=$db->execute_query($sql);
		list($this->user_id,$this->username,$this->password,$this->fullname,$this->email,$this->phone)=mysql_fetch_array($result);
		$db->close_connection();
	}
        
        public function findOnUserName($username){
		
		$db = new DB();
		$sql="select * from admin where username='$username'";
		$result=$db->execute_query($sql);
                if($result){
                    list($this->user_id,$this->username,$this->password,$this->fullname,$this->email,$this->phone)=mysql_fetch_array($result);
                }
		$db->close_connection();
	}

	public function updateUsername($username1,$user_id1){
		
		$db = new DB();
		$sql="update admin set username='$username1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePassword($password1,$user_id1){
		
		$db = new DB();
		$sql="update admin set password='$password1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateFullname($fullname1,$user_id1){
		
		$db = new DB();
		$sql="update admin set fullname='$fullname1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEmail($email1,$user_id1){
		
		$db = new DB();
		$sql="update admin set email='$email1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePhone($phone1,$user_id1){
		
		$db = new DB();
		$sql="update admin set phone='$phone1' where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllAdmin($user_id1){
		
		$db = new DB();
		$username1=$this->getusername();
		$password1=$this->getpassword();
		$fullname1=$this->getfullname();
		$email1=$this->getemail();
		$phone1=$this->getphone();
		$sql="update `admin` set `username`='$username1',`password`='$password1',`fullname`='$fullname1',`email`='$email1',`phone`='$phone1' where user_id='$user_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($user_id1){
		
		$db = new DB();
		$sql="delete from admin where user_id='$user_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnAdmin($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from admin where $str2";
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

	public static function getAllAdmin($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from admin';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new admin();
			list($tmp[$i]->user_id,$tmp[$i]->username,$tmp[$i]->password,$tmp[$i]->fullname,$tmp[$i]->email,$tmp[$i]->phone)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
        
        public static function checkLogin($username,$password){     
            $db=new DB();
            if($username!=NULL && $password!=NULL){                        
                $result=  $db->execute_query("select * from admin where username='$username' and password='".  md5($password)."';");
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
                $result=  $db->execute_query("select * from admin where username='$username' ;");
                if(mysql_num_rows($result) > 0){
                    return FALSE;
                }               
                else return TRUE;
            }
            else return FALSE;
        }
}
?>

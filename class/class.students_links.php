<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-04-30 06:59:19  
*/

class students_links{
	protected $link_id;
	protected $fb;
	protected $linkedin;
	protected $tweeter;
	protected $github;
	protected $blog;
	protected $website;


	function __construct($link_id_arg=null,$fb_arg=null,$linkedin_arg=null,$tweeter_arg=null,$github_arg=null,$blog_arg=null,$website_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->link_id=$link_id_arg;
			$this->fb=$fb_arg;
			$this->linkedin=$linkedin_arg;
			$this->tweeter=$tweeter_arg;
			$this->github=$github_arg;
			$this->blog=$blog_arg;
			$this->website=$website_arg;
		}
	}


	public function getLink_id(){
		return $this->link_id;
	}

	public function getFb(){
		return $this->fb;
	}

	public function getLinkedin(){
		return $this->linkedin;
	}

	public function getTweeter(){
		return $this->tweeter;
	}

	public function getGithub(){
		return $this->github;
	}

	public function getBlog(){
		return $this->blog;
	}

	public function getWebsite(){
		return $this->website;
	}

	public function setLink_id($link_id){
		$this->link_id=$link_id;
	}

	public function setFb($fb){
		$this->fb=$fb;
	}

	public function setLinkedin($linkedin){
		$this->linkedin=$linkedin;
	}

	public function setTweeter($tweeter){
		$this->tweeter=$tweeter;
	}

	public function setGithub($github){
		$this->github=$github;
	}

	public function setBlog($blog){
		$this->blog=$blog;
	}

	public function setWebsite($website){
		$this->website=$website;
	}

	public function genlink_id(){
		
		$db = new DB();
		$sql="select max(link_id) from students_links";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$link_id1=$this->getLink_id();
		$fb1=$this->getFb();
		$linkedin1=$this->getLinkedin();
		$tweeter1=$this->getTweeter();
		$github1=$this->getGithub();
		$blog1=$this->getBlog();
		$website1=$this->getWebsite();
		$sql="insert into `students_links` (`link_id`,`fb`,`linkedin`,`tweeter`,`github`,`blog`,`website`) values('$link_id1','$fb1','$linkedin1','$tweeter1','$github1','$blog1','$website1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setlink_id($link_id1);
			return true;
		}
		else return false;
	}
	public function findOnLink_id($link_id){
		
		$db = new DB();
		$sql="select * from students_links where link_id='$link_id'";
		$result=$db->execute_query($sql);
		list($this->link_id,$this->fb,$this->linkedin,$this->tweeter,$this->github,$this->blog,$this->website)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateFb($fb1,$link_id1){
		
		$db = new DB();
		$sql="update students_links set fb='$fb1' where link_id='$link_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateLinkedin($linkedin1,$link_id1){
		
		$db = new DB();
		$sql="update students_links set linkedin='$linkedin1' where link_id='$link_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateTweeter($tweeter1,$link_id1){
		
		$db = new DB();
		$sql="update students_links set tweeter='$tweeter1' where link_id='$link_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateGithub($github1,$link_id1){
		
		$db = new DB();
		$sql="update students_links set github='$github1' where link_id='$link_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateBlog($blog1,$link_id1){
		
		$db = new DB();
		$sql="update students_links set blog='$blog1' where link_id='$link_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateWebsite($website1,$link_id1){
		
		$db = new DB();
		$sql="update students_links set website='$website1' where link_id='$link_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_links($link_id1){
		
		$db = new DB();
		$fb1=$this->getfb();
		$linkedin1=$this->getlinkedin();
		$tweeter1=$this->gettweeter();
		$github1=$this->getgithub();
		$blog1=$this->getblog();
		$website1=$this->getwebsite();
		$sql="update `students_links` set `fb`='$fb1',`linkedin`='$linkedin1',`tweeter`='$tweeter1',`github`='$github1',`blog`='$blog1',`website`='$website1' where link_id='$link_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($link_id1){
		
		$db = new DB();
		$sql="delete from students_links where link_id='$link_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_links($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_links where $str2";
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

	public static function getAllStudents_links($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_links';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new students_links();
			list($tmp[$i]->link_id,$tmp[$i]->fb,$tmp[$i]->linkedin,$tmp[$i]->tweeter,$tmp[$i]->github,$tmp[$i]->blog,$tmp[$i]->website)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
}
?>

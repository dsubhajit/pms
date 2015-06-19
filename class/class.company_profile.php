<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-02 07:28:26  
*/

class company_profile{
	protected $profile_id;
	protected $company_name;
	protected $company_website;
	protected $cp_name;
	protected $cp_email;
	protected $cp_phone;
	protected $cp_desg;
	protected $post_add;
	protected $cmp_type;
	protected $about;
	protected $mission;
	protected $culture;
	protected $banner;


	function __construct($profile_id_arg=null,$company_name_arg=null,$company_website_arg=null,$cp_name_arg=null,$cp_email_arg=null,$cp_phone_arg=null,$cp_desg_arg=null,$post_add_arg=null,$cmp_type_arg=null,$about_arg=null,$mission_arg=null,$culture_arg=null,$banner_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->profile_id=$profile_id_arg;
			$this->company_name=$company_name_arg;
			$this->company_website=$company_website_arg;
			$this->cp_name=$cp_name_arg;
			$this->cp_email=$cp_email_arg;
			$this->cp_phone=$cp_phone_arg;
			$this->cp_desg=$cp_desg_arg;
			$this->post_add=$post_add_arg;
			$this->cmp_type=$cmp_type_arg;
			$this->about=$about_arg;
			$this->mission=$mission_arg;
			$this->culture=$culture_arg;
			$this->banner=$banner_arg;
		}
	}


	public function getProfile_id(){
		return $this->profile_id;
	}

	public function getCompany_name(){
		return $this->company_name;
	}

	public function getCompany_website(){
		return $this->company_website;
	}

	public function getCp_name(){
		return $this->cp_name;
	}

	public function getCp_email(){
		return $this->cp_email;
	}

	public function getCp_phone(){
		return $this->cp_phone;
	}

	public function getCp_desg(){
		return $this->cp_desg;
	}

	public function getPost_add(){
		return $this->post_add;
	}

	public function getCmp_type(){
		return $this->cmp_type;
	}

	public function getAbout(){
		return $this->about;
	}

	public function getMission(){
		return $this->mission;
	}

	public function getCulture(){
		return $this->culture;
	}

	public function getBanner(){
		return $this->banner;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function setCompany_name($company_name){
		$this->company_name=$company_name;
	}

	public function setCompany_website($company_website){
		$this->company_website=$company_website;
	}

	public function setCp_name($cp_name){
		$this->cp_name=$cp_name;
	}

	public function setCp_email($cp_email){
		$this->cp_email=$cp_email;
	}

	public function setCp_phone($cp_phone){
		$this->cp_phone=$cp_phone;
	}

	public function setCp_desg($cp_desg){
		$this->cp_desg=$cp_desg;
	}

	public function setPost_add($post_add){
		$this->post_add=$post_add;
	}

	public function setCmp_type($cmp_type){
		$this->cmp_type=$cmp_type;
	}

	public function setAbout($about){
		$this->about=$about;
	}

	public function setMission($mission){
		$this->mission=$mission;
	}

	public function setCulture($culture){
		$this->culture=$culture;
	}

	public function setBanner($banner){
		$this->banner=$banner;
	}

	public function genProfile_id(){
		
		$db = new DB();
		$sql="select max(profile_id) from company_profile";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
        
	public function insert(){
		
		$db = new DB();
		$profile_id1=$this->genProfile_id();
		$company_name1=$this->getCompany_name();
		$company_website1=$this->getCompany_website();
		$cp_name1=$this->getCp_name();
		$cp_email1=$this->getCp_email();
		$cp_phone1=$this->getCp_phone();
		$cp_desg1=$this->getCp_desg();
		$post_add1=$this->getPost_add();
		$cmp_type1=$this->getCmp_type();
		$about1=$this->getAbout();
		$mission1=$this->getMission();
		$culture1=$this->getCulture();
		$banner1=$this->getBanner();
		$sql="insert into `company_profile` (`profile_id`,`company_name`,`company_website`,`cp_name`,`cp_email`,`cp_phone`,`cp_desg`,`post_add`,`cmp_type`,`about`,`mission`,`culture`,`banner`) values('$profile_id1','$company_name1','$company_website1','$cp_name1','$cp_email1','$cp_phone1','$cp_desg1','$post_add1','$cmp_type1','$about1','$mission1','$culture1','$banner1')";
		$result=$db->execute_query($sql);
		$db->close_connection();
		if($result==1){
			$this->setprofile_id($profile_id1);
			return true;
		}
		else return false;
	}
	public function findOnProfile_id($profile_id){
		
		$db = new DB();
		$sql="select * from company_profile where profile_id='$profile_id'";
		$result=$db->execute_query($sql);
		list($this->profile_id,$this->company_name,$this->company_website,$this->cp_name,$this->cp_email,$this->cp_phone,$this->cp_desg,$this->post_add,$this->cmp_type,$this->about,$this->mission,$this->culture,$this->banner)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateCompany_name($company_name1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set company_name='$company_name1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCompany_website($company_website1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set company_website='$company_website1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCp_name($cp_name1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set cp_name='$cp_name1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCp_email($cp_email1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set cp_email='$cp_email1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCp_phone($cp_phone1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set cp_phone='$cp_phone1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCp_desg($cp_desg1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set cp_desg='$cp_desg1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePost_add($post_add1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set post_add='$post_add1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCmp_type($cmp_type1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set cmp_type='$cmp_type1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAbout($about1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set about='$about1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateMission($mission1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set mission='$mission1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCulture($culture1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set culture='$culture1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateBanner($banner1,$profile_id1){
		
		$db = new DB();
		$sql="update company_profile set banner='$banner1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllCompany_profile($profile_id1){
		
		$db = new DB();
		$company_name1=$this->getcompany_name();
		$company_website1=$this->getcompany_website();
		$cp_name1=$this->getcp_name();
		$cp_email1=$this->getcp_email();
		$cp_phone1=$this->getcp_phone();
		$cp_desg1=$this->getcp_desg();
		$post_add1=$this->getpost_add();
		$cmp_type1=$this->getcmp_type();
		$about1=$this->getabout();
		$mission1=$this->getmission();
		$culture1=$this->getculture();
		$banner1=$this->getbanner();
		$sql="update `company_profile` set `company_name`='$company_name1',`company_website`='$company_website1',`cp_name`='$cp_name1',`cp_email`='$cp_email1',`cp_phone`='$cp_phone1',`cp_desg`='$cp_desg1',`post_add`='$post_add1',`cmp_type`='$cmp_type1',`about`='$about1',`mission`='$mission1',`culture`='$culture1',`banner`='$banner1' where profile_id='$profile_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($profile_id1){
		
		$db = new DB();
		$sql="delete from company_profile where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnCompany_profile($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from company_profile where $str2";
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

	public static function getAllCompany_profile($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from company_profile';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
		while($row = mysql_fetch_array($result, MYSQL_NUM)){
			$tmp[++$i] = new company_profile();
			list($tmp[$i]->profile_id,$tmp[$i]->company_name,$tmp[$i]->company_website,$tmp[$i]->cp_name,$tmp[$i]->cp_email,$tmp[$i]->cp_phone,$tmp[$i]->cp_desg,$tmp[$i]->post_add,$tmp[$i]->cmp_type,$tmp[$i]->about,$tmp[$i]->mission,$tmp[$i]->culture,$tmp[$i]->banner)=$row;
		}
		$db->close_connection();
		return $tmp;
	}
        
        public static function getAllCompanyEmail(){
		$db=new DB();
		$sql='select cp_email from company_profile';
		
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
                
		$i=-1;
                if($result){
                    while($row = mysql_fetch_array($result, MYSQL_NUM)){
                            
                            list($tmp[++$i])=$row;
                    }
                }
		$db->close_connection();
		return $tmp;
	}
}
?>

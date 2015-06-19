<?php
include_once 'class.dbutils.php';

/*
	 Created: Subhajit Dey 
	 Created on : 2015-05-21 07:06:30  
*/

class students_profile{
	protected $profile_id;
	protected $enroll_no;
	protected $name;
	protected $email;
	protected $phone;
	protected $add1;
	protected $add2;
	protected $city;
	protected $pin;
	protected $c_state;
	protected $deparment;
	protected $branch;
	protected $degree;
	protected $adm_yr_start;
	protected $adm_yr_end;
	protected $cgpa;
	protected $job_status;
	protected $job_id;
	protected $multiple_job_allow;
	protected $father_name;
	protected $dob;
	protected $hobbies;
	protected $about;
	protected $pic;
	protected $prof_interest;
	protected $languages;
	protected $tech_id;
	protected $link_id;


	function __construct($profile_id_arg=null,$enroll_no_arg=null,$name_arg=null,$email_arg=null,$phone_arg=null,$add1_arg=null,$add2_arg=null,$city_arg=null,$pin_arg=null,$c_state_arg=null,$deparment_arg=null,$branch_arg=null,$degree_arg=null,$adm_yr_start_arg=null,$adm_yr_end_arg=null,$cgpa_arg=null,$job_status_arg=null,$job_id_arg=null,$multiple_job_allow_arg=null,$father_name_arg=null,$dob_arg=null,$hobbies_arg=null,$about_arg=null,$pic_arg=null,$prof_interest_arg=null,$languages_arg=null,$tech_id_arg=null,$link_id_arg=null){
		$args = func_num_args();
		if($args>0){
			$this->profile_id=$profile_id_arg;
			$this->enroll_no=$enroll_no_arg;
			$this->name=$name_arg;
			$this->email=$email_arg;
			$this->phone=$phone_arg;
			$this->add1=$add1_arg;
			$this->add2=$add2_arg;
			$this->city=$city_arg;
			$this->pin=$pin_arg;
			$this->c_state=$c_state_arg;
			$this->deparment=$deparment_arg;
			$this->branch=$branch_arg;
			$this->degree=$degree_arg;
			$this->adm_yr_start=$adm_yr_start_arg;
			$this->adm_yr_end=$adm_yr_end_arg;
			$this->cgpa=$cgpa_arg;
			$this->job_status=$job_status_arg;
			$this->job_id=$job_id_arg;
			$this->multiple_job_allow=$multiple_job_allow_arg;
			$this->father_name=$father_name_arg;
			$this->dob=$dob_arg;
			$this->hobbies=$hobbies_arg;
			$this->about=$about_arg;
			$this->pic=$pic_arg;
			$this->prof_interest=$prof_interest_arg;
			$this->languages=$languages_arg;
			$this->tech_id=$tech_id_arg;
			$this->link_id=$link_id_arg;
		}
	}


	public function getProfile_id(){
		return $this->profile_id;
	}

	public function getEnroll_no(){
		return $this->enroll_no;
	}

	public function getName(){
		return $this->name;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getPhone(){
		return $this->phone;
	}

	public function getAdd1(){
		return $this->add1;
	}

	public function getAdd2(){
		return $this->add2;
	}

	public function getCity(){
		return $this->city;
	}

	public function getPin(){
		return $this->pin;
	}

	public function getC_state(){
		return $this->c_state;
	}

	public function getDeparment(){
		return $this->deparment;
	}

	public function getBranch(){
		return $this->branch;
	}

	public function getDegree(){
		return $this->degree;
	}

	public function getAdm_yr_start(){
		return $this->adm_yr_start;
	}

	public function getAdm_yr_end(){
		return $this->adm_yr_end;
	}

	public function getCgpa(){
		return $this->cgpa;
	}

	public function getJob_status(){
		return $this->job_status;
	}

	public function getJob_id(){
		return $this->job_id;
	}

	public function getMultiple_job_allow(){
		return $this->multiple_job_allow;
	}

	public function getFather_name(){
		return $this->father_name;
	}

	public function getDob(){
		return $this->dob;
	}

	public function getHobbies(){
		return $this->hobbies;
	}

	public function getAbout(){
		return $this->about;
	}

	public function getPic(){
		return $this->pic;
	}

	public function getProf_interest(){
		return $this->prof_interest;
	}

	public function getLanguages(){
		return $this->languages;
	}

	public function getTech_id(){
		return $this->tech_id;
	}

	public function getLink_id(){
		return $this->link_id;
	}

	public function setProfile_id($profile_id){
		$this->profile_id=$profile_id;
	}

	public function setEnroll_no($enroll_no){
		$this->enroll_no=$enroll_no;
	}

	public function setName($name){
		$this->name=$name;
	}

	public function setEmail($email){
		$this->email=$email;
	}

	public function setPhone($phone){
		$this->phone=$phone;
	}

	public function setAdd1($add1){
		$this->add1=$add1;
	}

	public function setAdd2($add2){
		$this->add2=$add2;
	}

	public function setCity($city){
		$this->city=$city;
	}

	public function setPin($pin){
		$this->pin=$pin;
	}

	public function setC_state($c_state){
		$this->c_state=$c_state;
	}

	public function setDeparment($deparment){
		$this->deparment=$deparment;
	}

	public function setBranch($branch){
		$this->branch=$branch;
	}

	public function setDegree($degree){
		$this->degree=$degree;
	}

	public function setAdm_yr_start($adm_yr_start){
		$this->adm_yr_start=$adm_yr_start;
	}

	public function setAdm_yr_end($adm_yr_end){
		$this->adm_yr_end=$adm_yr_end;
	}

	public function setCgpa($cgpa){
		$this->cgpa=$cgpa;
	}

	public function setJob_status($job_status){
		$this->job_status=$job_status;
	}

	public function setJob_id($job_id){
		$this->job_id=$job_id;
	}

	public function setMultiple_job_allow($multiple_job_allow){
		$this->multiple_job_allow=$multiple_job_allow;
	}

	public function setFather_name($father_name){
		$this->father_name=$father_name;
	}

	public function setDob($dob){
		$this->dob=$dob;
	}

	public function setHobbies($hobbies){
		$this->hobbies=$hobbies;
	}

	public function setAbout($about){
		$this->about=$about;
	}

	public function setPic($pic){
		$this->pic=$pic;
	}

	public function setProf_interest($prof_interest){
		$this->prof_interest=$prof_interest;
	}

	public function setLanguages($languages){
		$this->languages=$languages;
	}

	public function setTech_id($tech_id){
		$this->tech_id=$tech_id;
	}

	public function setLink_id($link_id){
		$this->link_id=$link_id;
	}

	public function genProfile_id(){
		
		$db = new DB();
		$sql="select max(profile_id) from students_profile";
		$result=$db->execute_query($sql);
		list($id)=mysql_fetch_array($result);
		$db->close_connection();
		return $id+1;
	}
	public function insert(){
		
		$db = new DB();
		$profile_id1=$this->genProfile_id();
		$enroll_no1=$this->getEnroll_no();
		$name1=$this->getName();
		$email1=$this->getEmail();
		$phone1=$this->getPhone();
		$add11=$this->getAdd1();
		$add21=$this->getAdd2();
		$city1=$this->getCity();
		$pin1=$this->getPin();
		$c_state1=$this->getC_state();
		$deparment1=$this->getDeparment();
		$branch1=$this->getBranch();
		$degree1=$this->getDegree();
		$adm_yr_start1=$this->getAdm_yr_start();
		$adm_yr_end1=$this->getAdm_yr_end();
		$cgpa1=$this->getCgpa();
		$job_status1=$this->getJob_status();
		$job_id1=$this->getJob_id();
		$multiple_job_allow1=$this->getMultiple_job_allow();
		$father_name1=$this->getFather_name();
		$dob1=$this->getDob();
		$hobbies1=$this->getHobbies();
		$about1=$this->getAbout();
		$pic1=$this->getPic();
		$prof_interest1=$this->getProf_interest();
		$languages1=$this->getLanguages();
		$tech_id1=$this->getTech_id();
		$link_id1=$this->getLink_id();
		$sql="insert into `students_profile` (`profile_id`,`enroll_no`,`name`,`email`,`phone`,`add1`,`add2`,`city`,`pin`,`c_state`,`deparment`,`branch`,`degree`,`adm_yr_start`,`adm_yr_end`,`cgpa`,`job_status`,`job_id`,`multiple_job_allow`,`father_name`,`dob`,`hobbies`,`about`,`pic`,`prof_interest`,`languages`,`tech_id`,`link_id`) values('$profile_id1','$enroll_no1','$name1','$email1','$phone1','$add11','$add21','$city1','$pin1','$c_state1','$deparment1','$branch1','$degree1','$adm_yr_start1','$adm_yr_end1','$cgpa1','$job_status1','$job_id1','$multiple_job_allow1','$father_name1','$dob1','$hobbies1','$about1','$pic1','$prof_interest1','$languages1','$tech_id1','$link_id1')";
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
		$sql="select * from students_profile where profile_id='$profile_id'";
		$result=$db->execute_query($sql);
		list($this->profile_id,$this->enroll_no,$this->name,$this->email,$this->phone,$this->add1,$this->add2,$this->city,$this->pin,$this->c_state,$this->deparment,$this->branch,$this->degree,$this->adm_yr_start,$this->adm_yr_end,$this->cgpa,$this->job_status,$this->job_id,$this->multiple_job_allow,$this->father_name,$this->dob,$this->hobbies,$this->about,$this->pic,$this->prof_interest,$this->languages,$this->tech_id,$this->link_id)=mysql_fetch_array($result);
		$db->close_connection();
	}

	public function updateEnroll_no($enroll_no1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set enroll_no='$enroll_no1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateName($name1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set name='$name1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateEmail($email1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set email='$email1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePhone($phone1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set phone='$phone1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAdd1($add11,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set add1='$add11' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAdd2($add21,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set add2='$add21' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCity($city1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set city='$city1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePin($pin1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set pin='$pin1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateC_state($c_state1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set c_state='$c_state1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDeparment($deparment1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set deparment='$deparment1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateBranch($branch1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set branch='$branch1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDegree($degree1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set degree='$degree1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAdm_yr_start($adm_yr_start1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set adm_yr_start='$adm_yr_start1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAdm_yr_end($adm_yr_end1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set adm_yr_end='$adm_yr_end1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateCgpa($cgpa1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set cgpa='$cgpa1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateJob_status($job_status1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set job_status='$job_status1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateJob_id($job_id1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set job_id='$job_id1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateMultiple_job_allow($multiple_job_allow1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set multiple_job_allow='$multiple_job_allow1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateFather_name($father_name1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set father_name='$father_name1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateDob($dob1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set dob='$dob1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateHobbies($hobbies1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set hobbies='$hobbies1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAbout($about1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set about='$about1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updatePic($pic1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set pic='$pic1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateProf_interest($prof_interest1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set prof_interest='$prof_interest1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateLanguages($languages1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set languages='$languages1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateTech_id($tech_id1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set tech_id='$tech_id1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateLink_id($link_id1,$profile_id1){
		
		$db = new DB();
		$sql="update students_profile set link_id='$link_id1' where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function updateAllStudents_profile($profile_id1){
		
		$db = new DB();
		$enroll_no1=$this->getenroll_no();
		$name1=$this->getname();
		$email1=$this->getemail();
		$phone1=$this->getphone();
		$add11=$this->getadd1();
		$add21=$this->getadd2();
		$city1=$this->getcity();
		$pin1=$this->getpin();
		$c_state1=$this->getc_state();
		$deparment1=$this->getdeparment();
		$branch1=$this->getbranch();
		$degree1=$this->getdegree();
		$adm_yr_start1=$this->getadm_yr_start();
		$adm_yr_end1=$this->getadm_yr_end();
		$cgpa1=$this->getcgpa();
		$job_status1=$this->getjob_status();
		$job_id1=$this->getjob_id();
		$multiple_job_allow1=$this->getmultiple_job_allow();
		$father_name1=$this->getfather_name();
		$dob1=$this->getdob();
		$hobbies1=$this->gethobbies();
		$about1=$this->getabout();
		$pic1=$this->getpic();
		$prof_interest1=$this->getprof_interest();
		$languages1=$this->getlanguages();
		$tech_id1=$this->gettech_id();
		$link_id1=$this->getlink_id();
		$sql="update `students_profile` set `enroll_no`='$enroll_no1',`name`='$name1',`email`='$email1',`phone`='$phone1',`add1`='$add11',`add2`='$add21',`city`='$city1',`pin`='$pin1',`c_state`='$c_state1',`deparment`='$deparment1',`branch`='$branch1',`degree`='$degree1',`adm_yr_start`='$adm_yr_start1',`adm_yr_end`='$adm_yr_end1',`cgpa`='$cgpa1',`job_status`='$job_status1',`job_id`='$job_id1',`multiple_job_allow`='$multiple_job_allow1',`father_name`='$father_name1',`dob`='$dob1',`hobbies`='$hobbies1',`about`='$about1',`pic`='$pic1',`prof_interest`='$prof_interest1',`languages`='$languages1',`tech_id`='$tech_id1',`link_id`='$link_id1' where profile_id='$profile_id1';";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}


	public function delete($profile_id1){
		
		$db = new DB();
		$sql="delete from students_profile where profile_id='$profile_id1'";
		$result=$db->execute_query($sql);
		$db->close_connection();
		return $result;
	}

	public function findOnStudents_profile($str1,$str2){
		
		$db = new DB();
		$sql="select $str1 from students_profile where $str2";
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

	public static function getAllStudents_profile($qry_str='',$res_limit=0){
		$db=new DB();
		$sql='select * from students_profile';
		if(strlen($qry_str)>0) $sql.= ' where '.$qry_str;
		if($res_limit>0) $sql.=' limit '.$res_limit;
		$sql.=';';
                //echo $sql;
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=-1;
                if($result){
                    while($row = mysql_fetch_array($result, MYSQL_NUM)){
                            $tmp[++$i] = new students_profile();
                            list($tmp[$i]->profile_id,$tmp[$i]->enroll_no,$tmp[$i]->name,$tmp[$i]->email,$tmp[$i]->phone,$tmp[$i]->add1,$tmp[$i]->add2,$tmp[$i]->city,$tmp[$i]->pin,$tmp[$i]->c_state,$tmp[$i]->deparment,$tmp[$i]->branch,$tmp[$i]->degree,$tmp[$i]->adm_yr_start,$tmp[$i]->adm_yr_end,$tmp[$i]->cgpa,$tmp[$i]->job_status,$tmp[$i]->job_id,$tmp[$i]->multiple_job_allow,$tmp[$i]->father_name,$tmp[$i]->dob,$tmp[$i]->hobbies,$tmp[$i]->about,$tmp[$i]->pic,$tmp[$i]->prof_interest,$tmp[$i]->languages,$tmp[$i]->tech_id,$tmp[$i]->link_id)=$row;
                    }
                }
		$db->close_connection();
		return $tmp;
	}
        
        public static function getStudentsEmail($degree,$deps,$branch){
                $db=new DB();
		$sql='select email from students_profile where adm_yr_end = 2015';
		if($degree!=NULL && !in_array('0',$degree) ){                    
                    $sql.= ' and degree in ('.implode(',',$degree).')';                    
                }
                if($deps!=NULL && !in_array('0',$deps) ){                    
                    $sql.= ' and deparment in ('.implode(',',$deps).')';                    
                }
                if($branch!= NULL && !in_array('0',$branch) ){                    
                    $sql.= ' and branch in ('.implode(',',$branch).')';                    
                }
                
                
		$sql.=';';
		$result = $db->execute_query($sql);
		$tmp=array();
		$i=0;
                //echo $sql;
                if($result) {
                    while($row = mysql_fetch_array($result, MYSQL_NUM)){                            
                        list($tmp[$i])=$row;
                        $i++;
                    }
                }
		$db->close_connection();
		return $tmp;
        }
}
?>

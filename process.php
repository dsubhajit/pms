<?php
ob_start();
require_once 'includes/assign-access.php';
var_dump($_SESSION['USER_AUTH']);
require_once 'lib/lib.utils.php';
require_once 'class/include_all_class.php';

if($_SERVER['REQUEST_METHOD']=='POST' || $_SERVER['REQUEST_METHOD']=="GET"){
    if(isset($_REQUEST['job'])){
        $job =  real_escape_string($_REQUEST['job']);
    }
    else {
        header('location:logout.php');
    }
    if(USER_TYPE==STUDENT){        
        if($job==1){
            $s = new students_profile();
            if($s->updateAbout(real_escape_string($_REQUEST['about']),USER_PROFILE)){
                $_SESSION['STATUS']='About Updated';
            }
            else $_SESSION['ERROR']='Failed to update about.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==2){
            $edu = new students_edu();
            $edu->setEdu_cgpa(real_escape_string($_REQUEST['cgpa']));
            $edu->setEdu_inst_name(real_escape_string($_REQUEST['inst_name']));
            //$edu->setEdu_courses(real_escape_string($_REQUEST['cgpa']));
            $edu->setEdu_date_form(real_escape_string($_REQUEST['from_date']));
            $edu->setEdu_date_to(real_escape_string($_REQUEST['to_date']));
            $edu->setEdu_degree(real_escape_string($_REQUEST['degree']));
            $edu->setEdu_desc(real_escape_string($_REQUEST['desc']));
            $edu->setEdu_major(real_escape_string($_REQUEST['major']));
            $edu->setEdu_percentage(real_escape_string($_REQUEST['percentage']));
            $edu->setEdu_skill(real_escape_string($_REQUEST['skill']));
            $edu->setProfile_id(USER_PROFILE);
            
            
            if($edu->insert()){
                $_SESSION['STATUS']='Education Added.';
            }
            else $_SESSION['ERROR']='Failed to add new education.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==3){
            $pj = new students_projects();
            
            $pj->setPj_name(real_escape_string($_REQUEST['pj_name']));
            //$edu->setEdu_courses(real_escape_string($_REQUEST['cgpa']));
            $pj->setPj_from(real_escape_string($_REQUEST['from_date']));
            $pj->setPj_to(real_escape_string($_REQUEST['to_date']));            
            $pj->setPj_desc(real_escape_string($_REQUEST['desc']));            
            $pj->setPj_skills(real_escape_string($_REQUEST['skill']));
            if(isset($_REQUEST['pj_status'])){
                $pj->setPj_working(1);
            }
            else $pj->setPj_working(0);            
            $pj->setProfile_id(USER_PROFILE);
            
            
            if($pj->insert()){
                $_SESSION['STATUS']='Project Added.';
            }
            else $_SESSION['ERROR']='Failed to add new project.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==4){
            $p = new students_pubs();
            
            $p->setPub_title(real_escape_string($_REQUEST['p_title']));
            $p->setPub_name(real_escape_string($_REQUEST['p_name']));
            $p->setPub_date(real_escape_string($_REQUEST['from_date']));
                     
            $p->setPub_desc(real_escape_string($_REQUEST['desc']));            
            $p->setPub_skills(real_escape_string($_REQUEST['skill']));
            
            $p->setProfile_id(USER_PROFILE);
            
            
            if($p->insert()){
                $_SESSION['STATUS']='Publication Added.';
            }
            else $_SESSION['ERROR']='Failed to add new publication.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==5){
            $t = new students_tech();
            if(isset($_REQUEST['tech_id'])){
                $t->findOnTech_id($_REQUEST['tech_id']);
            }
            
            $t->setTech_langs(real_escape_string($_REQUEST['langs']));
            $t->setTech_frameworks(real_escape_string($_REQUEST['fworks']));
            $t->setTech_tools(real_escape_string($_REQUEST['tools']));
            
            if($t->getTech_id()==NULL){            
                if($t->insert()){
                    $p = new students_profile();                    
                    $p->updateTech_id($t->getTech_id(), USER_PROFILE);
                    $_SESSION['STATUS']='Tech Skills Updated.';
                }
                else $_SESSION['ERROR']='Failed to update tech skills.';
            }
            else {                
                if($t->updateAllStudents_tech($_REQUEST['tech_id'])){
                    $_SESSION['STATUS']='Tech Skills Updated.';
                }
                else $_SESSION['ERROR']='Failed to update tech skills.';
            }
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==12){
            $sd = new students_login();
            if($sd->updateVerified(2,USER_ID)){
                $_SESSION['STATUS']='Account verification request sent to placement co-ordinator';
            }
            else $_SESSION['ERROR']='Failed to send account verification request';
            header('location:home.php'); 
        }
        if($job==20){                        
            $p = new students_profile();
            $p->findOnProfile_id(USER_PROFILE);
            $p->setName(real_escape_string($_REQUEST['std_name']));
            $p->setAdd1(real_escape_string($_REQUEST['std_add1']));
            $p->setAdd2(real_escape_string($_REQUEST['std_add2']));
            $p->setProf_interest(real_escape_string($_REQUEST['std_pi']));
            $p->setLanguages(real_escape_string($_REQUEST['std_lang']));
            $p->setHobbies(real_escape_string($_REQUEST['std_hobbies']));
            //$p->setC_state(real_escape_string($_REQUEST['std_state']));
            //$p->setCity(real_escape_string($_REQUEST['std_city']));
            $p->setDob(real_escape_string($_REQUEST['std_dob']));            
            //$p->setPin(real_escape_string($_REQUEST['std_pin']));
            $p->setPhone(real_escape_string($_REQUEST['std_phone']));
            //$p->setDegree(real_escape_string($_REQUEST['std_degree']));
            //$p->setDeparment(real_escape_string($_REQUEST['std_branch']));
            //$p->setAdm_yr_start(real_escape_string($_REQUEST['std_start_year']));
            //$p->setAdm_yr_end(real_escape_string($_REQUEST['std_end_year']));
            if($p->updateAllStudents_profile(USER_PROFILE)){
                $_SESSION['STATUS']='Details updated.';
            }
            else $_SESSION['ERROR']='Failed to update details.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==27){
            $as = new job_application();
            $j = new jobs();
            $j->findOnJob_id(real_escape_string($_REQUEST['id']));
            
            $as->setStudent_profile_id(USER_PROFILE);
            $as->setDoa(date("Y-m-d"));
            $as->setJob_id($j->getJob_id());
            $as->setApplication_status(2);            
            $as->setCompany_profile_id($j->getProfile_id());
            if($as->insert()){
                $_SESSION['STATUS']='Job Application sent';
            }
            else $_SESSION['ERROR']='Failed to send job application.';
            header('location:home.php?page_id=2');
        }
        if($job==31){
            $edu = new students_edu();
            $edu->findOnEdu_id($_REQUEST['edu_id']);
            $edu->setEdu_cgpa(real_escape_string($_REQUEST['cgpa']));
            $edu->setEdu_inst_name(real_escape_string($_REQUEST['inst_name']));
            //$edu->setEdu_courses(real_escape_string($_REQUEST['cgpa']));
            $edu->setEdu_date_form(real_escape_string($_REQUEST['from_date']));
            $edu->setEdu_date_to(real_escape_string($_REQUEST['to_date']));
            $edu->setEdu_degree(real_escape_string($_REQUEST['degree']));
            $edu->setEdu_desc(real_escape_string($_REQUEST['desc']));
            $edu->setEdu_major(real_escape_string($_REQUEST['major']));
            $edu->setEdu_percentage(real_escape_string($_REQUEST['percentage']));
            $edu->setEdu_skill(real_escape_string($_REQUEST['skill']));
            $edu->setProfile_id(USER_PROFILE);
            
            
            if($edu->updateAllStudents_edu($_REQUEST['edu_id'])){
                $_SESSION['STATUS']='Education Updated.';
            }
            else $_SESSION['ERROR']='Failed to update education.';
            header('location:home.php?page_id=1');
        }
        if($job==32){
            $pj = new students_projects();
            
            $pj->findOnPj_id($_REQUEST['p_id']);
            
            $pj->setPj_name(real_escape_string($_REQUEST['pj_name']));            
            $pj->setPj_from(real_escape_string($_REQUEST['from_date']));
            $pj->setPj_to(real_escape_string($_REQUEST['to_date']));            
            $pj->setPj_desc(real_escape_string($_REQUEST['desc']));            
            $pj->setPj_skills(real_escape_string($_REQUEST['skill']));
            if(isset($_REQUEST['pj_status'])){
                $pj->setPj_working(1);
            }
            else $pj->setPj_working(0);            
            $pj->setProfile_id(USER_PROFILE);
            
            
            if($pj->updateAllStudents_projects($_REQUEST['p_id'])){
                $_SESSION['STATUS']='Project Updated.';
            }
            else $_SESSION['ERROR']='Failed to update project.';
            header('location:home.php?page_id=1');
        }
        if($job==33){
            $a= new achievements();
            $a->setAchiev_title(real_escape_string($_REQUEST['title']));
            $a->setAchiev_date($_REQUEST['date']);
            $a->setAchiev_description($_REQUEST['desc']);
            $a->setProfile_id(USER_PROFILE);
            if($a->insert()){
                $_SESSION['STATUS']='Achievement added.';
            }
            else $_SESSION['ERROR']='Failed to add achievement.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==34){
            $a= new achievements();
            $a->findOnAchiev_id($_REQUEST['ach_id']);
            $a->setAchiev_title(real_escape_string($_REQUEST['title']));
            $a->setAchiev_date($_REQUEST['date']);
            $a->setAchiev_description($_REQUEST['desc']);
            $a->setProfile_id(USER_PROFILE);
            if($a->updateAllAchievements($_REQUEST['ach_id'])){
                $_SESSION['STATUS']='Achievement Updated.';
            }
            else $_SESSION['ERROR']='Failed to update achievement.';
            header('location:home.php?page_id=1');
        }
        if($job==35){
            $e= new students_exp();
            $e->setDescription(real_escape_string($_REQUEST['desc']));
            $e->setDesignation(real_escape_string($_REQUEST['desg']));
            $e->setExp_type(real_escape_string($_REQUEST['type']));
            $e->setStart_date($_REQUEST['from_date']);
            $e->setEnd_date($_REQUEST['to_date']);
            $e->setOrganization(real_escape_string($_REQUEST['org']));
            $e->setProfile_id(USER_PROFILE);
            if($e->insert()){
                $_SESSION['STATUS']='Experience added.';
            }
            else $_SESSION['ERROR']='Failed to add experience.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==36){
            $e= new students_exp();
            $e->setDescription(real_escape_string($_REQUEST['desc']));
            $e->setDesignation(real_escape_string($_REQUEST['desg']));
            $e->setOrganization(real_escape_string($_REQUEST['org']));
            $e->setExp_type(real_escape_string($_REQUEST['type']));
            $e->setStart_date($_REQUEST['from_date']);
            $e->setEnd_date($_REQUEST['to_date']);
            $e->setProfile_id(USER_PROFILE);
            if($e->updateAllStudents_exp($_REQUEST['exp_id'])){
                $_SESSION['STATUS']='Experience Updated.';
            }
            else $_SESSION['ERROR']='Failed to update experience.';
            header('location:home.php?page_id=1');
        }
        if($job==37) {
            $p = new students_prof_dev();
            $p->setDev_name(real_escape_string($_REQUEST['name']));
            $p->setDev_type(real_escape_string($_REQUEST['type']));
            $p->setDescription($_REQUEST['desc']);
            $p->setStart_date(real_escape_string($_REQUEST['from_date']));
            $p->setEnd_date(real_escape_string($_REQUEST['to_date']));
            $p->setProfile_id(USER_PROFILE);
            if($p->insert()){
                $_SESSION['STATUS']='Professional Development added.';
            }
            else $_SESSION['ERROR']='Failed to add Professional Development.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==38) {
            $p = new students_prof_dev();
            $p->setDev_name(real_escape_string($_REQUEST['name']));
            $p->setDev_type(real_escape_string($_REQUEST['type']));
            $p->setDescription($_REQUEST['desc']);
            $p->setStart_date(real_escape_string($_REQUEST['from_date']));
            $p->setEnd_date(real_escape_string($_REQUEST['to_date']));
            $p->setProfile_id(USER_PROFILE);
            if($p->updateAllStudents_prof_dev($_REQUEST['prof_id'])){
                $_SESSION['STATUS']='Professional Development updated.';
            }
            else $_SESSION['ERROR']='Failed to update Professional Development.';
            header('location:home.php?page_id=1');
        }
        if($job==39){
            $e= new students_leadership();
            $e->setDescription(real_escape_string($_REQUEST['desc']));
            $e->setDesignation(real_escape_string($_REQUEST['desg']));            
            $e->setStart_date($_REQUEST['from_date']);
            $e->setEnd_date($_REQUEST['to_date']);
            $e->setOrganization(real_escape_string($_REQUEST['org']));
            $e->setProfile_id(USER_PROFILE);
            if($e->insert()){
                $_SESSION['STATUS']='Leadership Experience added.';
            }
            else $_SESSION['ERROR']='Failed to add leadership experience.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==40){
            $e= new students_leadership();
            $e->setDescription(real_escape_string($_REQUEST['desc']));
            $e->setDesignation(real_escape_string($_REQUEST['desg']));            
            $e->setStart_date($_REQUEST['from_date']);
            $e->setEnd_date($_REQUEST['to_date']);
            $e->setOrganization(real_escape_string($_REQUEST['org']));
            $e->setProfile_id(USER_PROFILE);
            if($e->updateAllStudents_leadership($_REQUEST['lexp_id'])){
                $_SESSION['STATUS']='Leadership Experience updated.';
            }
            else $_SESSION['ERROR']='Failed to update leadership experience.';
            header('location:home.php?page_id=1');
        }
        if($job==41){            
            $ref = new students_ref();
            $ref->setRef_name(real_escape_string($_REQUEST['name']));
            $ref->setPhone(real_escape_string($_REQUEST['phone']));
            $ref->setEmail(real_escape_string($_REQUEST['email']));
            $ref->setOrganization(real_escape_string($_REQUEST['org']));
            $ref->setProfile_id(USER_PROFILE);
            $ref->setDesignation(real_escape_string($_REQUEST['desg']));
            if($ref->insert()){
                $_SESSION['STATUS']='Reference added.';
            }
            else $_SESSION['ERROR']='Failed to add reference.';
            header('location:'.$_REQUEST['redirectUrl']);
        } 
        if($job==42){            
            $ref = new students_ref();
            $ref->findOnId($_REQUEST['ref_id']);
            $ref->setRef_name(real_escape_string($_REQUEST['name']));
            $ref->setPhone(real_escape_string($_REQUEST['phone']));
            $ref->setEmail(real_escape_string($_REQUEST['email']));
            $ref->setOrganization(real_escape_string($_REQUEST['org']));
            $ref->setDesignation(real_escape_string($_REQUEST['desg']));
            if($ref->updateAllStudents_ref($_REQUEST['ref_id'])){
                $_SESSION['STATUS']='Reference Updated.';
            }
            else $_SESSION['ERROR']='Failed to update reference.';
            header('location:home.php?page_id=1');
        } 
        if($job==49){
            $jo = new job_offer();
            $jo->findOnId( real_escape_string($_REQUEST['jo_id']));
            if($jo->updateStatus(JOB_ACCEPTED,  real_escape_string($_REQUEST['jo_id']))){
                $_SESSION['STATUS']='Job acceptance information sent.';
                $std = new students_profile();
                $std->updateJob_id($jo->getJob_id(), USER_PROFILE);
                $std->updateJob_status(1, USER_PROFILE);
            }
            else $_SESSION['ERROR']='Failed to send job acceptance information.';
            header('location:home.php');
        }
        if($job==50){
            $jo = new job_offer();
            if($jo->updateStatus(JOB_REJECTED,  real_escape_string($_REQUEST['jo_id']))){
                $_SESSION['STATUS']='Job reject information sent.';
            }
            else $_SESSION['ERROR']='Failed to send job reject information.';
            header('location:home.php');
        }
    }
    if(USER_TYPE==COMPANY){
        if($job==6){
            $cp = new company_profile();
            if($cp->updateAbout($_REQUEST['about'], USER_PROFILE)){
                $_SESSION['STATUS']='About details updated.';
            }
            else $_SESSION['ERROR']='Failed to update about details.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==7){
            $cp = new company_profile();
            if($cp->updateMission($_REQUEST['mission'], USER_PROFILE)){
                $_SESSION['STATUS']='Mission details updated.';
            }
            else $_SESSION['ERROR']='Failed to update mission details.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==8){
            $cp = new company_profile();
            if($cp->updateCulture($_REQUEST['culture'], USER_PROFILE)){
                $_SESSION['STATUS']='Culture details updated.';
            }
            else $_SESSION['ERROR']='Failed to update culture details.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==9){
            $j = new jobs();
            $j->setCriteria(real_escape_string($_REQUEST['criteria']));
            $j->setDegree(real_escape_string(implode(',',$_REQUEST['degree'])));
            $j->setBranch(real_escape_string(implode(',',$_REQUEST['branch'])));
            $j->setDepartment(real_escape_string(implode(',',$_REQUEST['dep'])));
            $j->setDesg(real_escape_string($_REQUEST['desg']));
            $j->setDescription(real_escape_string($_REQUEST['desc']));
            $j->setLoc(real_escape_string($_REQUEST['loc']));
            $j->setNum_of_off(real_escape_string($_REQUEST['nof']));
            $j->setNum_rounds(real_escape_string($_REQUEST['round_num']));
            $j->setProfile_id(USER_PROFILE);
            $j->setCreate_date(sql_timestamp());
            
            $sal_count = real_escape_string($_REQUEST['sal_count']);
            
            if($j->insert()){
                for($i=0;$i<$sal_count;$i++){
                    $sal_d = new job_salary_details();
                    $sal_d->setBond(real_escape_string($_REQUEST['bond'.$i]));
                    $sal_d->setBonus(real_escape_string($_REQUEST['bonus'.$i]));
                    $sal_d->setCtc(real_escape_string($_REQUEST['ctc'.$i]));
                    $sal_d->setDegree(real_escape_string($_REQUEST['degree'.$i]));
                    $sal_d->setGross(real_escape_string($_REQUEST['gross'.$i]));
                    $sal_d->setJob_id($j->getJob_id());
                    $sal_d->insert();
                }            
                
                for($i=0;$i<$j->getNum_rounds();$i++){
                    $r = new job_round_details();
                    $r->setRound_name(real_escape_string($_REQUEST['round_name'.$i]));
                    $r->setRound_details(real_escape_string($_REQUEST['round_details'.$i]));
                    $r->setJob_id($j->getJob_id());
                    $r->insert();
                }
                
            }
            $_SESSION['STATUS']='New job added.';            
            header('location:'.$_REQUEST['redirectUrl']);            
        }
        if($job==10) {
            $j = new jobs();
            if($j->updateVerified(2, real_escape_string($_REQUEST['id']))){
                $_SESSION['STATUS']='Job approval request sent to college placement admin.';
            }
            else $_SESSION['ERROR']='Failed to send request.';
            header('location:home.php?page_id=2'); 
        }
        if($job==11) {
            $j = new jobs();
            if($j->delete(real_escape_string($_REQUEST['id']))){
                $_SESSION['STATUS']='Job Deleted';
            }
            else $_SESSION['ERROR']='Failed to delete job.';
            header('location:home.php?page_id=2'); 
        }
        if($job==13){
            $cmp = new company_login();
            if($cmp->updateVerified(2,USER_ID)){
                $_SESSION['STATUS']='Account verification request sent to administrator';
            }
            else $_SESSION['ERROR']='Failed to send account verification request';
            header('location:home.php'); 
        }
        if($job==29){
           $ja = new job_application();
           if($ja->updateApplication_status(1,  real_escape_string($_REQUEST['id']))){
                $_SESSION['STATUS']='Application accepted information sent.';
           }
           else $_SESSION['ERROR']='Failed to send accept info to student.';
           header('location:home.php?page_id=12&job_id='.$_REQUEST['job_id']);
        }
        if($job==30){
           $ja = new job_application();
           if($ja->updateApplication_status(3,  real_escape_string($_REQUEST['id']))){
                $_SESSION['STATUS']='Application rejected information sent.';
           }
           else $_SESSION['ERROR']='Failed to send reject info to student.';
           header('location:home.php?page_id=12&job_id='.$_REQUEST['job_id']);
        }
        if($job==44) {            
            $name = real_escape_string($_REQUEST['cmp_name']);
            $c_name = real_escape_string($_REQUEST['c_name']);            
            $phone = real_escape_string($_REQUEST['cmp_phone']);
            $desg = real_escape_string($_REQUEST['cmp_desg']);
            $website = real_escape_string($_REQUEST['cmp_website']);
            

            $cp = new company_profile();
            $cp->findOnProfile_id(USER_PROFILE);
            $cp->setCompany_name($name);
            $cp->setCompany_website($website);            
            $cp->setCp_name($c_name);
            $cp->setCp_phone($phone);
            $cp->setCp_desg($desg);
            $cp->setCmp_type(implode(',',$_REQUEST['cmp_type']));
            $cp->setPost_add(real_escape_string($_REQUEST['cmp_add']));
            if($cp->updateAllCompany_profile(USER_PROFILE)){
                $_SESSION['STATUS']='Details Updated.';
            }
            else $_SESSION['ERROR']='Failed to update details.';
            header('location:home.php?page_id=1');  
        }
        if($job == 45){
            $sl= new schedule_list();
            $sl->setStart_date(real_escape_string($_REQUEST['start']));
            $sl->setEnd_date(real_escape_string($_REQUEST['end']));
            $sl->setNum_of_mem(real_escape_string($_REQUEST['mem']));
            $sl->setNum_of_rooms(real_escape_string($_REQUEST['room']));
            $sl->setReq(real_escape_string($_REQUEST['req']));
            $sl->setCompany_id(USER_PROFILE);
            if(schedule_list::checkAvailability($sl->getStart_date(), $sl->getEnd_date())){
                if($sl->insert()){
                    $_SESSION['STATUS']='Schedule added. Waiting for approval from admin';
                }
                else $_SESSION['ERROR']='Failed to sdd schedule.';                
            }
            else $_SESSION['ERROR']='Wrong dates!';  
            header('location:'.$_REQUEST['redirectUrl']);     
        }
        if($job == 46){
            $sl = new schedule_list();
            if($sl->delete(real_escape_string($_REQUEST['id']))){
                $_SESSION['STATUS']='Schedule deleted';
            }
            else $_SESSION['ERROR']='Failed to delete schedule.';
            header('location:home.php?page_id=16');     
        }
        if($job==48){
            foreach ($_REQUEST['std_id'] as $sid){
                $ja = new job_offer();
                $ja->setStatus(0);
                $ja->setStudent_id($sid);
                $ja->setJob_id($_REQUEST['job_id']);
                $ja->setOffered_text(real_escape_string($_REQUEST['off_text']));
                $ja->insert();
            }
            $_SESSION['STATUS']='Job Offer Sent';            
            header('location:home.php?page_id=17');     
        }
        
    }
    if(USER_TYPE==ADMIN){
        if($job==14) {
            $adm = new admin();
            $adm->findOnUser_id(USER_ID);
            $adm->setEmail(real_escape_string($_REQUEST['adm_email']));
            $adm->setFullname(real_escape_string($_REQUEST['adm_name']));
            $adm->setPhone(real_escape_string($_REQUEST['adm_phone']));
            if($adm->updateAllAdmin(USER_ID)){
                $_SESSION['STATUS']='Details updated.';
            }
            else $_SESSION['ERROR']='Failed to updatedetails';
            header('location:home.php'); 
        }
        if($job==15) {
            $deg = new degree();
            $deg->setDegree_name(real_escape_string($_REQUEST['degree']));
            if($deg->insert()){
                $_SESSION['STATUS']='New degree added.';
            }
            else $_SESSION['ERROR']='Failed to add degree.';
            header('location:'.$_REQUEST['redirectUrl']);   
        }
        if($job==16) {
            $dep = new department();
            $dep->setDep_name(real_escape_string($_REQUEST['dep']));
            if($dep->insert()){        
                $_SESSION['STATUS']='New Department added.';
            }
            else $_SESSION['ERROR']='Failed to add department.';
            header('location:'.$_REQUEST['redirectUrl']);   
        }
        if($job==17){
            $cmp = new company_login();
            if($cmp->updateVerified(VERIFIED,  real_escape_string($_REQUEST['cmp_id']))){
                $_SESSION['STATUS']='Company status set to verified and approved.';
            }
            else $_SESSION['ERROR']='Failed to set  company status.';
            header('location:home.php');
        }
        if($job==18){
            $cmp = new company_login();
            if($cmp->updateVerified(REJECTED,  real_escape_string($_REQUEST['cmp_id']))){
                $_SESSION['STATUS']='Company status set to rejected.';
            }
            else $_SESSION['ERROR']='Failed to set company status.';
            header('location:home.php');
        }
        if($job==19){
            if(isset($_REQUEST['notif_type'])){
                print_r($_REQUEST);
                if($_REQUEST['notif_type'] == STUDENT){
                    $ntf =  new students_notif();
                    $ntf->setNotif_date(sql_timestamp());
                    $ntf->setNotif_desc(real_escape_string($_REQUEST['desc']));
                    $ntf->setNotif_title(real_escape_string($_REQUEST['notif_title']));
                    $ntf->setSeverity(real_escape_string($_REQUEST['notif_severity']));   
                    $dep = array();
                    $degree = array();
                    $branch = array();
                    
                    if(isset($_REQUEST['degree'])){
                        $degree = $_REQUEST['degree'];
                        $ntf->setDegree(implode(',',$degree));
                    }
                    else $ntf->setDegree(0);
                    if(isset($_REQUEST['dep'])){
                        $dep = $_REQUEST['dep'];
                        $ntf->setDepartment(implode(',',$dep));
                                             
                    }
                    else $ntf->setDepartment(0);
                    
                    if(isset($_REQUEST['branch'])){
                        $branch = $_REQUEST['branch'];
                        $ntf->setBranch(implode(',',$branch));   
                    }
                    else $ntf->setBranch(0);   
                    
                    $emails = students_profile::getStudentsEmail($degree,$dep,$branch);
                    if(USE_MAIL_GUN){
                        require_once 'lib/lib.mailgun_mail.php';
                        require_once 'lib/email-templates.php';
                        
                        $mail = new mailgun_mail();
                        $mail->setSubject($ntf->getNotif_title());
                        $mail->setBody(admin_notif_template_students(strip_tags($ntf->getNotif_desc())));
                        $mail->setTo(implode(',',$emails));
                        $res = $mail->send_mail();
                    }
                    
                    
                    if($ntf->insert()) {
                        $_SESSION['STATUS']='Notification sent.';
                    }
                    else $_SESSION['ERROR']='Failed to send notification';
                    
                    
                }
                if($_REQUEST['notif_type'] == COMPANY){
                    $nt = new company_notif();                    
                    $nt->setNotif_date(sql_timestamp());
                    $nt->setNotif_desc(real_escape_string($_REQUEST['desc']));
                    $nt->setNotif_title(real_escape_string($_REQUEST['notif_title']));
                    $nt->setSeverity(real_escape_string($_REQUEST['notif_severity']));
                    if($nt->insert()) {
                        if(USE_MAIL_GUN){
                            require_once 'lib/lib.mailgun_mail.php';
                            require_once 'lib/email-templates.php';
                            $emails = company_profile::getAllCompanyEmail();
                            $mail = new mailgun_mail();
                            $mail->setSubject($nt->getNotif_title());
                            $mail->setBody(admin_notif_template_company(str_replace('&nbsp;',' ',str_replace('\n','',str_replace('\r','',strip_tags($nt->getNotif_desc()))))));
                            $mail->setTo(implode(',',$emails));
                            $res = $mail->send_mail();
                        }
                        $_SESSION['STATUS']='Notification sent.';
                    }
                    else $_SESSION['ERROR']='Failed to send notification';
                }
            }
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==21) {
            $j = new jobs();
            if($j->updateVerified(1,real_escape_string($_REQUEST['id']))){
                $_SESSION['STATUS']='Job Approved.';
            }
            else $_SESSION['ERROR']='Failed to approve job.';
            header('location:home.php?page_id=2');
        }
        if($job==22) {
            $j = new job_list();
            if($j->updateVerified(3,real_escape_string($_REQUEST['id']))){
                $_SESSION['STATUS']='Job Rejected.';
            }
            else $_SESSION['ERROR']='Failed to reject job.';
            header('location:home.php?page_id=2');
        }
        
        if($job==24) {
            $s = new students_login();
            if($s->updateIscordinator(1,  real_escape_string($_REQUEST['std_id']))){
                $_SESSION['STATUS']='Student assigned as placement co-ordinator';
            }
            else $_SESSION['ERROR']='Failed to assign as placement co-ordinator';
            header('location:home.php?page_id=10');
        }
        
        if($job==26) {
            $s = new students_login();
            if($s->updateIscordinator(0,  real_escape_string($_REQUEST['std_id']))){
                $_SESSION['STATUS']='Student removed from placement co-ordinator';
            }
            else $_SESSION['ERROR']='Failed to remove student from placement co-ordinator';
            header('location:home.php?page_id=10');
        }   
        if($job==28) {
            $b = new branch();
            $b->setBranch_name(real_escape_string($_REQUEST['branch_name']));
            $b->setDep_id(real_escape_string($_REQUEST['dep']));
            if($b->insert()){
                $_SESSION['STATUS']='New branch added.';
            }
            else $_SESSION['ERROR']='Failed to add branch.';
            header('location:'.$_REQUEST['redirectUrl']);
        }
        if($job==51){
            $std = new students_profile();
            if($std->updateMultiple_job_allow(1,$_REQUEST['std_id'])){
                $_SESSION['STATUS']='Multiple job allowed';
            }
            else $_SESSION['ERROR']='Failed to allow multiple job';
            header('location:home.php?page_id=9');
        }
        if($job==52){
            $std = new students_profile();
            if($std->updateMultiple_job_allow(0,$_REQUEST['std_id'])){
                $_SESSION['STATUS']='Multiple job disallowed';
            }
            else $_SESSION['ERROR']='Failed to disallow multiple job';
            header('location:home.php?page_id=9');
        }
    }
    if(USER_TYPE==ADMIN || USER_PRIV==TRUE){
        if($job==23) {
            $s = new students_login();
            if($s->updateVerified(1,  real_escape_string($_REQUEST['std_id']))){
                $_SESSION['STATUS']='Student Approved.';
            }
            else $_SESSION['ERROR']='Failed to approve student.';
            header('location:home.php?page_id=10');
        }
        if($job==25) {
            $s = new students_login();
            if($s->updateVerified(3,  real_escape_string($_REQUEST['std_id']))){
                $_SESSION['STATUS']='Student approval rejected.';
            }
            else $_SESSION['ERROR']='Failed to reject student approval.';
            header('location:home.php?page_id=10');
        }
        if($job==43) {
            $sl = new students_login();
            $sl->findOnUser_id($_REQUEST['std_id']);
            $s = new students_profile();
            if($s->delete($sl->getProfile_id())){
                $sl->delete($_REQUEST['std_id']);
                $_SESSION['STATUS']='Student deleted.';
            }
            else $_SESSION['ERROR']='Failed to delete student.';
            header('location:home.php?page_id=9');
        }
        if($job==47){
            $sl = new schedule_list();
            if($sl->updateStatus($_REQUEST['type'], $_REQUEST['id'])){
                $_SESSION['STATUS']='Schedule Status Updated';
            }
            else $_SESSION['ERROR']='Failed to update schedule status.';
            header('location:home.php?page_id=16');     
        }
        
    }
    if($job==100){
        if($_REQUEST['r_n_pass'] == $_REQUEST['n_pass']){
            if(USER_TYPE==ADMIN){
                $adm = new admin();
                $adm->findOnUser_id(USER_ID);
                if(md5($_REQUEST['o_pass']) == $adm->getPassword()){
                    if($adm->updatePassword(md5($_REQUEST['n_pass']), USER_ID)){
                        $_SESSION['STATUS']='Password changed.';
                    }
                    else $_SESSION['ERROR']='Failed to change password';
                }
                else $_SESSION['ERROR']='Old password not matched.';
            }
            else if(USER_TYPE==STUDENT){
                $std = new students_login();
                $std->findOnUser_id(USER_ID);
                if(md5($_REQUEST['o_pass']) == $std->getPassword()){
                    if($std->updatePassword(md5($_REQUEST['n_pass']), USER_ID)){
                        $_SESSION['STATUS']='Password changed.';
                    }
                    else $_SESSION['ERROR']='Failed to change password';
                }
                else $_SESSION['ERROR']='Old password not matched.';
            }
            else if(USER_TYPE==COMPANY){
                $cmp = new company_login();
                $cmp->findOnCmp_id(USER_ID);
                if(md5($_REQUEST['o_pass']) == $cmp->getPassword()){
                    if($cmp->updatePassword(md5($_REQUEST['n_pass']), USER_ID)){
                        $_SESSION['STATUS']='Password changed.';
                    }
                    else $_SESSION['ERROR']='Failed to change password';
                }
                else $_SESSION['ERROR']='Old password not matched.';
            }
            else $_SESSION['ERROR']='Unknown user type';
        }
        else $_SESSION['ERROR']='New password not matched.';
        header('location:'.$_REQUEST['redirectUrl']);
    }
}
?>

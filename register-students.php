<?php
session_start();
require_once 'config.php';
require_once 'lib/lib.utils.php';
require_once 'class/class.students_login.php';
require_once 'class/class.students_profile.php';

function validate($data){
    $enrol_no = real_escape_string($data['std_enr_no']);
    $email = real_escape_string($data['std_email']);
    $name = real_escape_string($data['std_name']);
    $pass = real_escape_string($data['std_pass']);
    $rpass = real_escape_string($data['std_r_pass']);
    /*
    $add1 = real_escape_string($data['std_add1']);
    $add2 = real_escape_string($data['std_add2']);
     */
    $phone = real_escape_string($data['std_phone']);
    /*
    $city = real_escape_string($data['std_city']);
    $state = real_escape_string($data['std_state']);
    $country = real_escape_string($data['std_country']);
    $dob=real_escape_string($data['std_dob']);
    $pin = real_escape_string($data['std_pin']);
    */
    
    $degree = real_escape_string($data['std_degree']);
    $dep = real_escape_string($data['std_dep']);
    $branch = real_escape_string($data['std_branch']);
    
    $res = array();
    
    $res['status'] = TRUE;
    $res['text'] = '';
    
    if(strlen(trim($name))==0){
        $res['status'] = FALSE;
        $res['text'] = 'Please enter valid name.';
        return $res;
    } 
    
    if(strlen(trim($email))==0){
        $res['status'] = FALSE;
        $res['text'] = 'Please enter valid email.';
        return $res;
    } 
    
    
    if(!students_login::checkUsernameExists($enrol_no)){
        $res['status'] = FALSE;
        $res['text'] = 'User already registered.';
        return $res;
    }   
    
    if($pass != $rpass){
        $res['status'] = FALSE;
        $res['text'] = 'Password not matched.';
        return $res;
    }
    
    if($degree <= 0 ) {
        $res['status'] = FALSE;
        $res['text'] = 'Please select a valid degree';
        return $res;
    }
    
    if($dep <= 0 ) {
        $res['status'] = FALSE;
        $res['text'] = 'Please select a valid department';
        return $res;
    }
    
    
    return $res;    
    
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $enrl = real_escape_string($_REQUEST['std_enr_no']);
    $email = real_escape_string($_REQUEST['std_email']);
    $name = real_escape_string($_REQUEST['std_name']);
    $pass = real_escape_string($_REQUEST['std_pass']);
    $rpass = real_escape_string($_REQUEST['std_r_pass']);
    /*
    $add1 = real_escape_string($_REQUEST['std_add1']);
    $add2 = real_escape_string($_REQUEST['std_add2']);
     */
    $phone = real_escape_string($_REQUEST['std_phone']);
    /*
    $city = real_escape_string($_REQUEST['std_city']);
    $state = real_escape_string($_REQUEST['std_state']);
    $country = real_escape_string($_REQUEST['std_country']);
    $dob=real_escape_string($_REQUEST['std_dob']);
    $pin = real_escape_string($_REQUEST['std_pin']);
    */
    
    $degree = real_escape_string($_REQUEST['std_degree']);
    $dep = real_escape_string($_REQUEST['std_dep']);
    $branch = real_escape_string($_REQUEST['std_branch']);
    
    $result = validate($_REQUEST);
    if($result['status']){
        $p = new students_profile();
        $p->setName($name);
        /*
        $p->setAdd1($add1);
        $p->setAdd2($add2);
        $p->setC_state($state);
        $p->setCity($city);
        $p->setDob($dob);
         */
        
        $p->setEmail($email);
        //$p->setPin($pin);
        $p->setPhone($phone);
        $p->setEnroll_no($enrl);
        $p->setDegree($degree);
        $p->setDeparment($dep);
        $p->setBranch($branch);
        $p->setCgpa(real_escape_string($_REQUEST['std_cgpa']));
        $p->setAdm_yr_start(real_escape_string($_REQUEST['std_yr_enr']));
        $p->setAdm_yr_end(real_escape_string($_REQUEST['std_yr_pass']));
        if($p->insert()){
            $s = new students_login();
            $s->setUsername($enrl);
            $s->setPassword(md5($pass));
            $s->setProfile_id($p->getProfile_id());
            if($s->insert()){
                if(USE_MAIL_GUN){
                    require_once 'lib/lib.mailgun_mail.php';
                    require_once 'lib/email-templates.php';

                    $mail = new mailgun_mail();
                    $mail->setBody(students_add_email_template($name,APP_URL,$pass));
                    $mail->setSubject("Placement Cell Registration");
                    $mail->setTo($email);

                    if($mail->send_mail()){                    
                        $result['status']=TRUE;
                        $result['text'] = "Student registered.";
                    }
                    else {
                        $result['status']=FALSE;
                        $result['text'] = "Student registered but failed to send registration mail.";
                    }
                }
                else {
                    $result['status']=TRUE;
                    $result['text'] = "Student registered.";
                }
                              
            }
            else {
                $p->delete($p->getProfile_id());
                $result['status']=FALSE;
                $result['text']='Failed to insert in db.';
            }
        }
        else {
            $result['status']=FALSE;
            $result['text']='Failed to insert in db.';
        }
    }
    
    echo json_encode($result);
}

?>


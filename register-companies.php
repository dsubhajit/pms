<?php
session_start();
require_once 'config.php';
require_once 'lib/lib.utils.php';
require_once 'class/class.company_profile.php';
require_once 'class/class.company_login.php';

function validate($data){
    $email = real_escape_string($data['cmp_email']);
    $name = real_escape_string($data['cmp_name']);
    $c_name = real_escape_string($data['c_name']);
    $pass = real_escape_string($data['cmp_pass']);
    $rpass = real_escape_string($data['cmp_r_pass']);
    $phone = real_escape_string($data['cmp_phone']);
    $desg = real_escape_string($data['cmp_desg']);
    
    $res = array();
    
    $res['status'] = TRUE;
    $res['text'] = '';
    
    if(strlen(trim($name))==0){
        $res['status'] = FALSE;
        $res['text'] = 'Please enter valid company name.';
        return $res;
    }
    
    if(strlen(trim($c_name))==0){
        $res['status'] = FALSE;
        $res['text'] = 'Please enter your valid name.';
        return $res;
    }
    
    if(!company_login::checkUsernameExists($email)){
        $res['status'] = FALSE;
        $res['text'] = 'Email Id already registered.';
        return $res;
    }   
    
    if($pass != $rpass){
        $res['status'] = FALSE;
        $res['text'] = 'Password not matched.';
        return $res;
    }
    
    return $res;    
    
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $email = real_escape_string($_REQUEST['cmp_email']);
    $name = real_escape_string($_REQUEST['cmp_name']);
    $c_name = real_escape_string($_REQUEST['c_name']);
    $pass = real_escape_string($_REQUEST['cmp_pass']);
    $rpass = real_escape_string($_REQUEST['cmp_r_pass']);
    $phone = real_escape_string($_REQUEST['cmp_phone']);
    $desg = real_escape_string($_REQUEST['cmp_desg']);
    $website = real_escape_string($_REQUEST['cmp_website']);
    
    
    $cp = new company_profile();
    
    $cp->setCompany_name($name);
    $cp->setCompany_website($website);
    $cp->setCp_email($email);
    $cp->setCp_name($c_name);
    $cp->setCp_phone($phone);
    $cp->setCp_desg($desg);
    
    $result = validate($_REQUEST);
    if($result['status']){
        if($cp->insert()){            
            $c = new company_login();
            
            $c->setUsername($email);
            $c->setPassword(md5($pass));
            $c->setProfile_id($cp->getProfile_id());
            if($c->insert()){
                session_regenerate_id();
                $_SESSION['REG']['NAME']=$name;
                $_SESSION['REG']['STATUS']=TRUE;
                $_SESSION['REG']['TYPE']=COMPANY;
                //$c->setActivated(1);
                session_write_close();
                $result['status']=TRUE;
                $result['url']=APP_URL.'/registration-success.php';                
            }
            else {
                $cp->delete($cp->getProfile_id());
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


<?php
session_start();
require_once 'config.php';
require_once 'lib/lib.utils.php';

if($_SERVER['REQUEST_METHOD']=="POST"){
    $username = real_escape_string($_REQUEST['username']);
    $password = real_escape_string($_REQUEST['password']);
    
    $data = array();
    
    $error=FALSE;
    
    if(strlen($password) == 0 || strlen($username) == 0){
        $error = TRUE;
        $data['error'] = 'Please enter valid username or password';
        $data['status'] = "Failed";
    }
    
    if(!$error) {
        require_once 'class/class.company_login.php';
        if(company_login::checkLogin($username, $password)){
            $cl = new company_login();
            $cl->findOnUserName($username);
            
            session_regenerate_id();
                $_SESSION['USER_AUTH']['ID']=$cl->getCmp_id();
                $_SESSION['USER_AUTH']['PID']=$cl->getProfile_id();
                $_SESSION['USER_AUTH']['TYPE']=COMPANY;                
            session_write_close();
            $data['url']=APP_URL."/home.php";
            $data['status']="Success";            
        }
        else {
            $data['status']="Failed";
            $data['error'] = "Please enter valid username or password";
        }
    }
    echo json_encode($data);
}
?>

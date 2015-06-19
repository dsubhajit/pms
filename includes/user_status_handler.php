<?php 
require_once 'lib/lib.alert.php';
//var_dump($_SESSION['USER_AUTH']);
if(USER_TYPE==STUDENT){
    require_once 'class/class.students_login.php';
    $std = new students_login();
    $std->findOnUser_id(USER_ID);
    //echo $std->getVerified();
    if($std->getVerified()==0){
        echo error('<b>Your account is not verified yet.</b> Please complete your profile and click <a href="process.php?job=12" class="btn btn-danger" >Verify</a>' );
    }
    else if($std->getVerified()==2){
        echo warn('<b>Your account verfication is pending.</b> you won\'t be able see notifications or apply for jobs till your placement co-ordinator verify your account.');
    }
    else if($std->getVerified() == REJECTED){
        echo error('<b>Your account is rejected by administrator.</b> Please complete your profile and then click <a href="process.php?job=12" class="btn btn-danger" >Verify</a>' );
    }
}
elseif(USER_TYPE==COMPANY){
    require_once 'class/class.company_login.php';
    $cmp = new company_login();
    $cmp->findOnCmp_id(USER_ID);
    
    if($cmp->getVerified() == 0){
        echo error('<b>Your account is not verified yet.</b> Please complete your profile and click <a href="process.php?job=13" class="btn btn-danger" >Verify</a>' );
    }
    else if($cmp->getVerified() == 2){
        echo warn('<b>Your account verfication is pending.</b> you won\'t be able to post jobs till administrator verify your account.');
    }
}
    
?>
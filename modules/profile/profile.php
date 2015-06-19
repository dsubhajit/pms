<?php
    if(USER_TYPE==STUDENT){
        include_once 'modules/profile/student-profile.php';
    }
    else if(USER_TYPE==COMPANY){
        include_once 'modules/profile/company-profile.php';
    }
    else if(USER_TYPE==ADMIN){
        include_once 'modules/profile/admin-profile.php';
    }
?>

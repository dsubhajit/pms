<?php
    if(USER_TYPE==STUDENT){
        include_once 'modules/dashboard/student-dashboard.php';
    }
    if(USER_TYPE==ADMIN){
        include_once 'modules/dashboard/admin/admin-dashboard.php';
    }
    if(USER_TYPE==COMPANY){
        include_once 'modules/dashboard/company/company_dashboard.php';
    }
?>

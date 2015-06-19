<?php
    if(USER_TYPE==ADMIN || USER_PRIV==TRUE){
        include_once 'modules/notifications/admin/admin-notification-main.php';
    }
    if(USER_TYPE==COMPANY){                
        include_once 'modules/notifications/company/company_notif.php';
    }
    if(USER_TYPE==STUDENT && USER_PRIV==FALSE){
        include_once 'modules/notifications/students/students_notif.php';
    }
?>
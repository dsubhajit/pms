<?php 

require_once 'includes/assign-access.php';
include_once "includes/header.php";
include_once "includes/nav.php";

?>
<div class="container-fluid">
    <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <?php 
        include_once 'includes/left-nav.php';
        ?>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        
        <?php require_once 'includes/user_status_handler.php';  ?>
        <?php require_once 'includes/app_status_handler.php';  ?>
        <?php 
        
        //var_dump($_SESSION['USER_AUTH']);
        $page = 0;
        if(isset($_REQUEST['page_id'])){
            $page = $_REQUEST['page_id'];
        }
        //$page = $_REQUEST['page_id'];
        switch($page){
            case 1: include_once 'modules/profile/profile.php';break;
            case 2: include_once 'modules/jobs/jobs.php';break;
            case 4: if(USER_TYPE==ADMIN){
                        include_once 'modules/configuration/configuration.php';
                    }
                    else {
                        echo error ("Access Denied!");
                    }
                    break;
            case 5: include_once 'modules/notifications/notifications.php';break;
            case 6: include_once 'modules/view/company_details.php';break;
            
            case 7: if(USER_TYPE==ADMIN || USER_TYPE==STUDENT){
                        include_once 'modules/view/list_of_companies.php';
                    }
                    else echo error ("Access Denied!");
                    break;
            case 8: if(USER_TYPE==ADMIN || USER_TYPE==STUDENT){
                        include_once 'modules/view/students_notif_details.php';break;
                    }
                    else echo error ("Access Denied!");
            case 9: if(USER_TYPE==ADMIN || USER_PRIV==TRUE){
                        include_once 'modules/view/list_of_students.php';
                    }
                    else echo error ("Access Denied!");
                    break;
            case 10: if(USER_TYPE==ADMIN || USER_PRIV==true){
                        include_once 'modules/configuration/students_approval_list.php';
                    }
                    else echo error ("Access Denied!");
                    break;
            case 11: include_once 'modules/view/student_details.php';break;
            case 12: include_once 'modules/view/application_list.php';break;
            case 13: if(USER_TYPE==ADMIN || USER_PRIV==TRUE){
                        include_once 'modules/configuration/students_configuration.php';
                    }
                    else echo error ("Access Denied!");
                    break;
            case 14: include_once 'modules/settings/change_password.php';break;
            case 15: if(USER_TYPE==ADMIN || USER_TYPE==COMPANY){
                        include_once 'modules/view/company_notif_details.php';break;
                    }
                    else echo error ("Access Denied!");
            case 16: include_once 'modules/schedule/schedule_main.php';break;
            case 17: if(USER_TYPE==COMPANY){
                        include_once 'modules/jobs/offer/main.php';break;
                     }   
                     else echo error ("Access Denied!");
            default: include_once 'modules/dashboard/dashboard.php';break;
        }
        
        ?>
        <?php 
            if(USER_TYPE==ADMIN){
                include 'modules/profile/admin/admin-details.php';
            }
        ?>
    </div>
    </div>
</div>

    
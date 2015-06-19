<?php
    if(USER_TYPE==STUDENT){
        include_once 'modules/jobs/students/students-job.php';
    }
    if(USER_TYPE==COMPANY){                
        include_once 'modules/jobs/company-jobs.php';
    }
    if(USER_TYPE==ADMIN){
        include_once 'modules/jobs/admin/list_of_job_admin.php';
    }
?>

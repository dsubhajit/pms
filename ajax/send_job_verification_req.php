<?php
require_once "config.php";
require_once "includes/assign-access.php";
require_once 'lib/lib.utils.php';
if(USER_TYPE==COMPANY){
    $req_id = real_escape_string($_REQUEST['id']);
    require_once 'class/class.job_list.php';
    
}
?>

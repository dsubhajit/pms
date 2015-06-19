<?php
if(USER_TYPE==COMPANY){
    include_once 'modules/schedule/company/main.php';
}
if(USER_TYPE==ADMIN || USER_PRIV==TRUE){
    include_once 'modules/schedule/admin/main.php';
}
?>

<?php 
session_start();
require_once dirname(__FILE__).'/../app.init.php';

if(!isset($_SESSION['USER_AUTH'])){
    header('location:index.php');
}
    
define('USER_ID',$_SESSION['USER_AUTH']['ID']);
define('USER_TYPE',$_SESSION['USER_AUTH']['TYPE']);
define('USER_PROFILE',$_SESSION['USER_AUTH']['PID']);
if(USER_TYPE!=ADMIN && isset($_SESSION['USER_AUTH']['STATUS'])){
    define('USER_STATUS',$_SESSION['USER_AUTH']['STATUS']);
}
else {
    define('USER_STATUS',1);
}
if(isset($_SESSION['USER_AUTH']['PRIV'])){
    define('USER_PRIV',$_SESSION['USER_AUTH']['PRIV']);
}
else define('USER_PRIV',false);


?>

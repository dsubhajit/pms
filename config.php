<?php
require_once 'app.init.php';


/*
 * Created By Subhajit Dey
 */

/* Institute Name */ 

define("INST_NAME","NIT XXXX") ;
 
/* Config Your Application */


define("APP_NAME","Placement Management System");
define("APP_URL","http://localhost/pms");

/*Placement Season Start Date */

define('PLACEMENT_START','2014-03-10');
define('PLACEMENT_END','2015-09-10');

/* Database Details */

define("APP_DB_USERNAME","root");
define("APP_DB_PASSWORD","");
define("APP_DB_HOST","127.0.0.1");
define("APP_DB_NAME","placement");


/* Email Notification  */

define("EMAIL_NOTIFICATION",TRUE);

/* Default Student Password */

define("DEF_STUD_PASS","Asdfg#123");

/* Use this one ... because smtp mail not going from localhost. Try to register and add the config */
/* MailGun Configuration for email notification */
define("USE_MAIL_GUN",TRUE);
define("MAIL_GUN_API_KEY","XXXXX");
define("MAIL_GUN_DOMAIN","sXXXXXXXX");
define("MAIL_GUN_EMAIL_FROM_NAME",INST_NAME." Placement Cell");
define("MAIL_GUN_EMAIL_FROM","XXXXX");



/* SMTP EMAIL SERVER SETTINGS*/
define("EMAIL_USER_ID","subhajitctm@gamil.com");
define("EMAIL_PASSWORD","*********");
define("EMAIL_FROM",INST_NAME." Placement Cell");
define("EMAIL_SMTP_PORT","465");
define("EMAIL_SMTP_SERVER","smtp.gmail.com")

        
        
        

?>

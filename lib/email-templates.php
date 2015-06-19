<?php
require_once (dirname(__FILE__).'/../config.php');
function students_add_email_template($name,$link,$pass){
    $str = "Hi ".$name."\n\n";
    $str.= "You have been registerd by your placement cell. Please visit this link $link to access your placement account.\n";
    $str.= "Username: Your EnrolmentNo. and Password: ".$pass;
    $str .= "\nBy\n".INST_NAME." Placement Cell";
    return $str;
}

function students_bulk_add_email_template($name,$link,$pass){
    $str = "Dear ".$name."\n\n";
    $str.= "You have been registerd by your placement cell. Please visit this link $link to access your placement account.\n";
    $str.= "Username: Your EnrolmentNo. and Password: ".$pass;
    $str .= "\nBy\n".INST_NAME." Placement Cell";
    return $str;
}

function admin_notif_template_students($text){
    $str = "Dear Students \n\n";
    $str.= $text;
    $str .= "\nBy\n".INST_NAME." Placement Cell";
    return $str;
}

function admin_notif_template_company($text){
    $str = "Hi Sir,\n\n";
    $str.= $text;
    $str .= "\nBy\n".INST_NAME." Placement Cell";
    return $str;
}

?>

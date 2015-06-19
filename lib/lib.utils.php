<?php
$current_file_path = dirname(__FILE__);
require_once $current_file_path.'/../class/class.dbutils.php';
require_once $current_file_path.'/../lib/lib.alert.php';

function curPageURL() {
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } 
    else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

function sql_timestamp(){
    return date("Y-m-d H:i:s");
}

function real_escape_string($str) {
    $db = new DB();
    $tmp = mysql_real_escape_string($str,$db->get_connection());
    $db->close_connection();
    return $tmp;
}

function mysql_escape_mimic($inp) { 
    if(is_array($inp)) 
        return array_map(__METHOD__, $inp); 

    if(!empty($inp) && is_string($inp)) { 
        return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp); 
    } 

    return $inp; 
} 

function getPageStatus($str,$val,$val2=0){
    if($val2==0){        
        if(isset($str) && $str==$val) return "in";
        echo "here";
    }
    else if($val2 > 0){
        if(($str <= $val2) && ($str >= $val)) return "in";
    }
    else "";
}

function getExtension($str) {
    $i = strrpos($str,".");
    if (!$i) { return ""; }
    $l = strlen($str) - $i;
    $ext = substr($str,$i+1,$l);
    return $ext;
}
    
function crop($str,$path,$width1,$height1){
    $image =$str["name"];
    $uploadedfile = $str['tmp_name'];
    if ($image){ 	
        $filename = stripslashes($str['name']); 	
        $extension = getExtension($filename);
        $extension = strtolower($extension);

        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){		
            $change='<div class="msgdiv">Unknown Image extension </div> ';
            $errors=1;
        }
        else{
            $size=filesize($str['tmp_name']);
            if($extension=="jpg" || $extension=="jpeg" ){
                $uploadedfile = $str['tmp_name'];
                $src = imagecreatefromjpeg($uploadedfile);
            }
            else if($extension=="png"){
                $uploadedfile = $str['tmp_name'];
                $src = imagecreatefrompng($uploadedfile);
            }
            else {
                $src = imagecreatefromgif($uploadedfile);
            }
            list($width,$height)=getimagesize($uploadedfile);
            $newwidth=$width1;
            $newheight=$height1;
            $tmp=imagecreatetruecolor($newwidth,$newheight);
            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
            $name = $str['name'];
            list($txt, $ext) = explode(".", $name);

            $actual_image_name = time().str_replace(".","_",str_replace(" ", "_", $txt)).".".$extension;                
            $filename = $path.$actual_image_name;
            //echo $filename;
            if(imagejpeg($tmp,$filename,100)){
                imagedestroy($src);
                imagedestroy($tmp);
                return $actual_image_name;
            }
            else return false;
        }
    }
}

function crop2($str,$path,$width1,$height1,$width2,$height2){
    $image =$str["name"];
    $uploadedfile = $str['tmp_name'];
    if ($image){ 	
        $filename = mysql_escape_mimic(stripslashes($str['name'])); 	
        $extension = getExtension($filename);
        $extension = strtolower($extension);

        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){		
            $change='<div class="msgdiv">Unknown Image extension </div> ';
            $errors=1;
        }
        else{
            $size=filesize($str['tmp_name']);
            if($extension=="jpg" || $extension=="jpeg" ){
                $uploadedfile = $str['tmp_name'];
                $src = imagecreatefromjpeg($uploadedfile);
            }
            else if($extension=="png"){
                $uploadedfile = $str['tmp_name'];
                $src = imagecreatefrompng($uploadedfile);
            }
            else {
                $src = imagecreatefromgif($uploadedfile);
            }
            list($width,$height)=getimagesize($uploadedfile);
            $newwidth=$width1;
            $newheight=$height1;
            $tmp=imagecreatetruecolor($newwidth,$newheight);
            $tmp2=imagecreatetruecolor($width2,$height2);
            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
            imagecopyresampled($tmp2,$src,0,0,0,0,$width2,$height2,$width,$height);
            $name = $str['name'];
            list($txt, $ext) = explode(".", $name);

            $actual_image_name = time().  mysql_escape_mimic(str_replace(".","_",str_replace(" ", "_", $txt))).".".$extension;                
            $filename = $path.$actual_image_name;
            $filename2= $path."small_".$actual_image_name;
            if(imagejpeg($tmp,$filename,100) && imagejpeg($tmp2,$filename2,100) ){
                imagedestroy($src);
                imagedestroy($tmp);
                imagedestroy($tmp2);
                return $actual_image_name;
            }
            else return false;
        }
    }
}

function checkImg($str){
    if($str==NULL || strlen($str)==0) return 'img_not_found.jpg';
    else return $str;
}

function getImageLink($path){
    if($path!=null){
        return $path;
    }
    else {
        return 'not-found.jpg';
    }
}


function checkPageActive($p,$page){
    if(!isset($p)) return "";
    if($p==$page) return "class=\"active\"";
    else "";
}

function image_crop($str,$path,$width1,$width2){
    $resp = array();
    $resp["status"] = FALSE;
    $resp["text"] = 'Image not found.';
    
    $image =$str["name"];
    $uploadedfile = $str['tmp_name'];
    
    if ($image){
        $filename = stripslashes($str['name']); 	
        $extension = getExtension($filename);
        $extension = strtolower($extension);

        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")){		
            $resp["status"]=FALSE;
            $resp["text"]="File format unkown. Expected (jpg/jpeg/gif/png)";
        }
        else {
            
            if($extension=="jpg" || $extension=="jpeg" ){
                $uploadedfile = $str['tmp_name'];
                $src = imagecreatefromjpeg($uploadedfile);
            }
            else if($extension=="png"){
                $uploadedfile = $str['tmp_name'];
                $src = imagecreatefrompng($uploadedfile);
            }
            else {
                $src = imagecreatefromgif($uploadedfile);
            }
            list($orig_width,$orig_height)=getimagesize($uploadedfile);
            $ratio = $orig_width / $orig_height;
            
            
            $newwidth=$width1;
            $newwidth2=$width2;
            
            $newheight = $newwidth/$ratio;
            $newheight2 = $newwidth2/$ratio;
            
            $tmp=imagecreatetruecolor($newwidth,$newheight);
            $tmp2=imagecreatetruecolor($newwidth2,$newheight2);
            
            imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$orig_width,$orig_height);
            imagecopyresampled($tmp2,$src,0,0,0,0,$newwidth2,$newheight2,$orig_width,$orig_height);
            $name = $str['name'];
            list($txt, $ext) = explode(".", $name);

            $actual_image_name = mysql_escape_mimic(str_replace(".","_",str_replace(" ", "_", $txt))).time().".".$extension;                
            $filename = $path.$actual_image_name;
            $filename2= $path."small_".$actual_image_name;
            if(imagejpeg($tmp,$filename,100) && imagejpeg($tmp2,$filename2,100) ){
                imagedestroy($src);
                imagedestroy($tmp);
                imagedestroy($tmp2);
                $resp["filename"]=$actual_image_name;
                $resp["status"]=TRUE;
                $resp["text"]="";
            }
            else {
                $resp["status"]=FALSE;
                $resp["text"]="Failed to upload image.";
            }
        }
    }
    return $resp;
}



function getEmailHtml($from,$email,$query) {
	$str = '<table cellpadding="5" cellspacing="5" border"2" style="background:#faebd7;" ><tr><td>From:</td><td>'.$from.'</td></td>';
	$str.= '<tr><td>Email:</td><td>'.$email.'</td></tr>';
	$str.='<tr><td>Query:</td><td>'.$query.'</td></tr></table>';
	return $str;
	
}

function getStatus($v) {
    switch($v){
        case 0: return '<span class="badge" >Not Verified</span>';
        case 1: return '<span class="badge" >Approved</span>';
        case 2: return '<span class="badge" >Pending</span>';
        case 3: return '<span class="badge" >Rejected</span>';
        default: return '<span class="badge" >Unknown</span>';
    }
}
function getStatusClass($v) {
    switch($v){
        case 0: return 'info';
        case 1: return 'success';
        case 2: return 'warning';
        case 3: return 'danger';
        default: return '';
    }
}

function getNotifSeverity($var){
    if($var==MAJOR) return "Major";
    else if($var==MINOR) return "Minor";
    else if($var==ORDINARY) return "Ordinary";
    else if($var==URGENT) return "Urgent";
    else return "Unknown";
        
}

function getApplicationStatus($v) {
    switch($v){
        case 0: return 'Not Applied';
        case 1: return 'Accepted';
        case 2: return 'Pending';
        case 3: return 'Rejected';
        default: return '';
    }
}
function getJobOfferStatus($v) {
    switch($v){
        case 0: return '<span class="badge" >Pending</span>';
        case 1: return '<span class="badge" >Accepted</span>';
        case 2: return '<span class="badge" >Rejected</span>';
        
        default: return '';
    }
}

function getJobStatusClass($v) {
    switch($v){
        case 0: return 'warning';
        case 1: return 'success';
        case 2: return 'danger';
        
        default: return '';
    }
}

function vImplode($delimeter,$a_array){
    $d = array();
    foreach($a_array as $a){
        array_push($d, $a[0]);
    }
    return implode($delimeter, $d);
}


?>
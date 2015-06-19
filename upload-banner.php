<?php
require_once 'app.init.php';
require_once 'includes/assign-access.php';
if(USER_TYPE == COMPANY){
    if($_SERVER['REQUEST_METHOD']=="POST"){
        require_once 'class/class.company_profile.php';
        require_once 'lib/lib.utils.php';


        $resp = image_crop($_FILES["file"],'banners/',1024,200);

        if($resp["status"]){
            $cp = new company_profile();
            
            
            if($cp->updateBanner($resp["filename"],USER_PROFILE)){
                $resp["status"]=TRUE;            
            }
            else {
                $resp["status"]=FALSE;   
                $resp["text"]="Failed to insert in db.";
            }
        }
        echo json_encode($resp);
    }
}
?>

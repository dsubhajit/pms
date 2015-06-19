<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once 'lib/lib.excel_reader.php';
require_once 'lib/lib.utils.php';
require_once 'class/class.degree.php';
require_once 'class/class.department.php';
require_once 'class/class.branch.php';
require_once 'class/class.students_profile.php';
require_once 'class/class.students_login.php';






function validateData($data){
    $res['status'] = FALSE;
    $res['text'] = '';
    
    if(strlen(trim($data[1]))==0){
        $res['status'] = FALSE;
        $res['text'] = 'Not a valid Name.';
        return $res;
    } 
    
    if(strlen(trim($data[8]))==0){
        $res['status'] = FALSE;
        $res['text'] = 'Not a valid email.';
        return $res;
    }     
    
    if(!students_login::checkUsernameExists(trim($data[0]))){
        $res['status'] = FALSE;
        $res['text'] = 'Already registered.';
        return $res;
    }   
    
    if(degree::getDegreeIdFromName(trim($data[3]))->getDegree_id()==NULL){
        $res['status'] = FALSE;
        $res['text'] = 'Unknown degree name.';
        return $res;
    }
    if(strlen(trim($data[4])) > 0) {
        if(branch::getBranchIdFromName(trim($data[4]))->getBranch_id()==NULL){
            $res['status'] = FALSE;
            $res['text'] = 'Unknown branch name.';
            return $res;
        }
        
    }
    if(department::getDepIdFromName(trim($data[2]))->getDep_id()==NULL){
        $res['status'] = FALSE;
        $res['text'] = 'Unknown department name.';
        return $res;
    }
    
    $res['status'] = TRUE;        
    return $res;
    
}


$result['text'] = "";
$result['enrl_no'] = "";


if($_SERVER['REQUEST_METHOD']=="POST"){
    $email = array();
    
    if($_FILES['data_file']!=null){
        $filename = $_FILES['data_file']['name'];
        $ext = getExtension($filename);
        $newfilename = time();
        
        if($ext == 'xls'){
        
            move_uploaded_file($_FILES['data_file']['tmp_name'], 'dumps/'.$newfilename.'.'.$ext);
            $data = new Spreadsheet_Excel_Reader('dumps/'.$newfilename.'.'.$ext);           
            
            if($data->rowcount() > 1){
                $dataArrayDump = $data->dumptoarray();
                //print_r($dataArrayDump);
                $r['data'] = array();
                $result = array();
                for($i = 1 ;$i<$data->rowcount();$i++){
                    //print_r($dataArrayDump[$i]);
                    
                    //$res = validateData(excel_dump_data_to_array($data, $i));
                    
                    //print_r($dataArrayDump[$i]);
                    
                    $res = validateData($dataArrayDump[$i]);
                    //var_dump($res);
                    
                    
                    if($res['status']) {
                        $p = new students_profile();
                        $p->setName($data->val($i+1,2));               
                        $p->setEmail($data->val($i+1, 9));                   
                        $p->setPhone($data->val($i+1, 10));
                        $p->setEnroll_no($data->val($i+1, 1));
                            
                        $p->setDegree(degree::getDegreeIdFromName($data->val($i+1,4))->getDegree_id());
                        $p->setDeparment(department::getDepIdFromName($data->val($i+1, 3))->getDep_id());
                        $p->setBranch(branch::getBranchIdFromName($data->val($i+1, 5))->getBranch_id());
                        
                        $p->setCgpa(real_escape_string($data->val($i+1,6)));
                        $p->setAdm_yr_start(real_escape_string($data->val($i+1,7)));
                        $p->setAdm_yr_end(real_escape_string($data->val($i+1,8)));
                        
                        //print_r($p);
                        
                        if($p->insert()){
                            $s = new students_login();
                            $s->setUsername($p->getEnroll_no());
                            $s->setPassword(md5(DEF_STUD_PASS));
                            $s->setProfile_id($p->getProfile_id());
                            if($s->insert()){                                
                                $result['text'] = $res['text'];
                                $result['status'] = 'Success';
                                $result['enrl_no'] = $p->getEnroll_no(); 
                                
                                array_push($email,$p->getEmail());
                            }
                        }
                         
                    }
                    else {
                        $result['text'] = $res['text'];
                        $result['status'] = 'Failed';
                        $result['enrl_no'] = $data->val($i+1, 1);
                    }
                    array_push($r['data'],$result);
                     
                }
                
                $r["status"] = TRUE;
                
                
                if(!USE_MAIL_GUN){
                    require_once 'lib/lib.mailgun_mail.php';
                    require_once 'lib/email-templates.php';
                    $mail = new mailgun_mail();
                    $mail->setBody(students_bulk_add_email_template("Student",APP_URL,DEF_STUD_PASS));
                    $mail->setSubject("Placement Cell Registration");
                    $mail->setTo(implode(',',$email));                    
                    $resp = $mail->send_mail();      
                    //print_r($resp);
                }                                              
            }     
        }
        else {
            $r["status"] = FALSE;
            $r["text"] = "Unknown  file format.";
        }
    }    
    else {
        $r["status"] = FALSE;
        $r["text"] = "Please select a xls file.";
        
    }
    echo json_encode($r);
}
?>

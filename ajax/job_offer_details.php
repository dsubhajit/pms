<?php
require_once "../config.php";
require_once "../includes/assign-access.php";
require_once '../lib/lib.utils.php';
//var_dump($_SESSION['USER_AUTH']);
if(isset($_REQUEST['id'])){
    require_once '../class/class.job_offer.php';
    require_once '../class/class.job_salary_details.php';
    require_once '../class/class.jobs.php';
    require_once '../class/class.company_profile.php';
    require_once '../class/class.students_profile.php';
    $std = new students_profile();
    $std->findOnProfile_id(USER_PROFILE);
    
    $jo = new job_offer();
    $jo->findOnId(real_escape_string($_REQUEST['id']));
    $j = new jobs();
    $j->findOnJob_id($jo->getJob_id());
    $cmp = new company_profile();
    $cmp->findOnProfile_id($j->getProfile_id());
    $js = new job_salary_details();
    $ctc = $js->findOnJob_salary_details("ctc", " job_id=".$j->getJob_id()." and (degree=0 or find_in_set('".$std->getDegree()."',degree) <> 0)");
?>
<table class="table table-bordered table-hovered" >
    <tr>
        <td class="active" >Designation</td><td><?=$j->getDesg() ?></td>        
    </tr>
    <tr>
        <td class="active" >Description</td><td><?=$j->getDescription() ?></td>        
    </tr>
    <tr>
        <td class="active" >Company</td><td><?=$cmp->getCompany_name() ?></td>        
    </tr>
    <tr>
        <td class="active" >CTC</td><td><?=  vImplode(',',$ctc) ?></td>        
    </tr>
    <tr>
        <td colspan="2">
            <?=nl2br($jo->getOffered_text()) ?>
        </td> 
    </tr>
</table>
<div class="row" >
    <div class="col-md-3" >
        <a href="process.php?jo_id=<?=$jo->getId() ?>&job=49" class="btn btn-success btn-lg btn-block" > <span class="glyphicon glyphicon-ok-sign"></span> Accept Offer</a>
    </div>
    <div class="col-md-6" ></div>
    <div class="col-md-3" >
        <a href="process.php?jo_id=<?=$jo->getId() ?>&job=50" class="btn btn-danger btn-lg btn-block" > <span class="glyphicon glyphicon-remove-sign"></span> Reject Offer</a>
    </div>
</div>    
<?php
}
?>

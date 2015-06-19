<?php
require_once "../config.php";
require_once "../includes/assign-access.php";
require_once '../lib/lib.utils.php';
//var_dump($_SESSION['USER_AUTH']);
if(isset($_REQUEST['id'])){
    $job_id = real_escape_string($_REQUEST['id']);
    require_once '../class/class.jobs.php';
    require_once '../class/class.job_application.php';
    $as = new job_application();
    require_once '../class/class.company_profile.php';
    require_once '../class/class.degree.php';
    require_once '../class/class.department.php';
    require_once '../class/class.branch.php';
    $j= new jobs();
    $j->findOnJob_id($job_id);  
    $cmp=new company_profile();
    $cmp->findOnProfile_id($j->getProfile_id());
    
?>
<style>
    .jobdet .table tr.active td{
        background-color: #000!important;
        color:#fff!important;
    }
</style>
<div class="row jobdet" > 
    <div class="col-md-12" >
        
        <div class="well well-sm" style="background-color:#FFFFCC" >
            <h3>About</h3>                    
            <div class="row">                        
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Job Designation:</label>
                        <?=$j->getDesg() ?>
                    </div>
                    <div class="form-group">
                        <label>Job Location(s):</label> <?=$j->getLoc() ?>
                    </div>
                    <div class="form-group">
                        <label>Minimum no. of offers you intend to make :</label> <?=$j->getNum_of_off() ?>
                    </div>

                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Job Description: </label><?=$j->getDescription() ?>
                    </div> 
                </div>
            </div>
        </div>
        <div class="well well-sm" style="background-color:#FFFFCC" >
            <h3>Salary Details</h3>
            <div class="row" >                
                <div class="col-md-12" >
                    <h4>Added Details</h4>
                    <table class="table table-bordered" id="details_table" style="background-color:#FFF" >
                        <tr class="active" >
                            <td>Degree</td>
                            <td>CTC</td>
                            <td>Gross</td>
                            <td>Bonus/Perks/Incentives</td>
                            <td>Service Contract/Bond</td>                            
                        </tr>
                        <?php 
                        require_once '../class/class.job_salary_details.php';
                        $jsd = job_salary_details::getAllJob_salary_details(' job_id = '.$j->getJob_id());                        
                        $deg = new degree();
                        
                        $i =0;
                        
                        foreach ($jsd as $sd) {
                            $deg_names = $deg->findOnDegree('degree_name', ' degree_id in ('.$sd->getDegree().')');
                        ?>
                        <tr id="tr<?=$i ?>">
                            <td><?=  vImplode(',',$deg_names) ?><input type="hidden" name="degree<?=$i ?>" value="<?=$sd->getDegree() ?>" /></td>
                            <td><?=$sd->getCtc() ?><input type="hidden" class="field_<?=$i ?>" name="degree<?=$i ?>" value="<?=$sd->getCtc() ?>" /></td>
                            <td><?=$sd->getGross() ?><input type="hidden" class="field_<?=$i ?>" name="ctc<?=$i ?>" value="<?=$sd->getGross() ?>" /></td>
                            <td><?=$sd->getBonus() ?><input type="hidden" class="field_<?=$i ?>" name="bonus<?=$i ?>" value="<?=$sd->getBonus() ?>" /></td>
                            <td><?=$sd->getBond() ?><input type="hidden" class="field_<?=$i ?>" name="bond<?=$i ?>" value="<?=$sd->getBond() ?>" /></td>
                            
                        </tr>
                        <?php 
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="well well-sm" style="background-color:#FFFFCC" >
            <h3>Selection Process</h3>
            <div class="row" >
                <div class="col-md-4 " >
                    <div class="form-group">
                        <label>Numbers of rounds: </label>
                        <?=$j->getNum_rounds() ?>
                    </div>
                </div>
                <div class="col-md-8 " ></div>
                <div class="col-md-12" >
                    <table class="table table-bordered" id="round_details" style="background-color:#FFF"  >
                        <tr class="active" >
                            <td>Round Name</td>
                            <td>Round Details</td>
                        </tr>
                        <?php 
                        require_once '../class/class.job_round_details.php';
                        $job_rounds = job_round_details::getAllJob_round_details(' job_id = '.$j->getJob_id());
                        foreach($job_rounds as $r){
                        ?>
                        <tr>
                            <td><?=$r->getRound_name() ?></td>
                            <td><?=$r->getRound_details() ?></td>
                            
                        </tr>
                        <?php 
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="well well-sm" style="background-color:#FFFFCC">
            <h3>Eligibility Criteria</h3>
            <?php 
            $deg = new degree();
            $deg_names = $deg->findOnDegree('degree_name', ' degree_id in ('.$j->getDegree().')');
            $dep = new department();                        
            $dep_names = $dep->findOnDepartment('dep_name',' dep_id in('.$j->getDepartment().')' );
            $b = new branch();
            $b_names = $b->findOnBranch('branch_name',' branch_id in ('.$j->getBranch().')');
            ?>
            <div class="row" >
                <div class="col-md-12 " >
                    <div class="form-group" >
                        <label>Degree : </label>
                        <?=  vImplode(',',$deg_names) ?>
                    </div>
                </div>
                <div class="col-md-12 " >
                    <div class="form-group" >                        
                        <label>Department : </label>
                        <?=  vImplode(',',$dep_names) ?>
                    </div>
                </div>
                <div class="col-md-12 " >
                    <div class="form-group">
                        <label>Branch : </label>
                        <?=  vImplode(',',$b_names) ?>
                    </div>
                </div>
                <div class="col-md-12" >
                    <div class="form-group">
                        <label>Criteria : </label>
                        <?=$j->getCriteria() ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        if(USER_TYPE==STUDENT){
            $as->findOnJob_app_idAndUser_id($j->getJob_id(),USER_PROFILE);
            if($as->getJob_app_id()==NULL){
        ?>
        <div class="col-md-4 col-md-offset-4" >
            <a href="process.php?job=27&id=<?=$j->getJob_id() ?>" class="btn btn-primary btn-lg btn-block" >Apply</a>
        </div>
        <?php 
            }
        }
        ?>
    </div>
</div> 
<?php
        
}
?>

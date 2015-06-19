<?php
require_once "../config.php";
require_once "../includes/assign-access.php";
require_once '../lib/lib.utils.php';
//var_dump($_SESSION['USER_AUTH']);
if(USER_TYPE==COMPANY){
    $job_id = real_escape_string($_REQUEST['id']);
    require_once '../class/class.jobs.php';
    $j= new jobs();
    $j->findOnJob_id($job_id);
    if($j->getProfile_id() == USER_PROFILE){
?>
<div class="row" >  
    <div class="col-md-12">
        <div class="well well-sm">
            <h3>About</h3>                    
            <div class="row">                        
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Job Designation</label>
                        <input type="text" class="form-control" name="desg" value="<?=$j->getDesg() ?>" placeholder="Enter job designation">
                    </div>
                    <div class="form-group">
                        <label>Job Location(s)</label>
                        <input type="text" class="form-control" value="<?=$j->getLoc() ?>" name="loc" placeholder="Enter job location(s)">
                    </div>
                    <div class="form-group">
                        <label>Minimum no. of offers you intend to make</label>
                        <input type="text" class="form-control" value="<?=$j->getNum_of_off() ?>" name="nof" placeholder="">
                    </div>

                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Job Description</label>
                        <textarea class="form-control" rows="8" name="desc" ><?=$j->getDescription() ?></textarea>
                    </div> 
                </div>
            </div>
        </div>
        <div class="well well-sm" >
            <h3>Salary Details</h3>
            <div class="row" >
                <div class="col-md-4" >
                    <div class="form-group" >
                        <label>Degree</label>
                        <select class="form-control" id="degree" multiple="multiple" >                                    
                            <?php 
                                require_once '../class/class.degree.php';
                                $deg = degree::getAllDegree();
                                foreach ($deg as $d){
                                    echo '<option value="'.$d->getDegree_id().'" >'.$d->getDegree_name().'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>CTC</label>
                        <input type="text" class="form-control" id="ctc" name="job_ctc" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Gross</label>
                        <input type="text" class="form-control" id="gross" name="job_gross" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Bonus/Perks/Incentives</label>
                        <input type="text" class="form-control" id="bonus" name="job_bonus" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Service Contract/Bond</label>
                        <input type="text" class="form-control" id="bond" name="job_bond" placeholder="">
                    </div>
                    <buttonn class="btn btn-primary" onclick="addDetails()" type="button" ><span class="glyphicon glyphicon-plus"></span> Add</buttonn>
                </div>
                <div class="col-md-8" >
                    <h4>Added Details</h4>
                    <table class="table table-bordered" id="details_table" >
                        <tr>
                            <td>Degree</td>
                            <td>CTC</td>
                            <td>Gross</td>
                            <td>Bonus/Perks/Incentives</td>
                            <td>Service Contract/Bond</td>
                            <td>Option</td>
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
                            <td><a class="btn btn-danger btn-xs" href="javascript:remove(<?=$i++ ?>)" ><span aria-hidden="true">&times;</span></a></td>
                        </tr>
                        <?php 
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="well well-sm" >
            <h3>Selection Process</h3>
            <div class="row" >
                <div class="col-md-4 " >
                    <div class="form-group">
                        <label>Numbers of round</label>
                        <select class="form-control" onchange="addRounds(this)" name="round_num" >
                            <?php 
                            for($i = 1;$i<=10;$i++) {
                                echo '<option value="'.$i.'" >'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 " ></div>
                <div class="col-md-12" >
                    <table class="table table-bordered" id="round_details" >

                    </table>
                </div>
            </div>
        </div>
        <div class="well well-sm">
            <h3>Eligibility Criteria</h3>
            <div class="row" >
                <div class="col-md-4 " >
                    <div class="form-group" >
                        <label>Degree</label>
                        <select class="form-control" name="degree[]" id="degree" multiple="multiple" >                                    
                            <?php 
                                require_once 'class/class.degree.php';
                                $deg = degree::getAllDegree();
                                foreach ($deg as $d){
                                    echo '<option value="'.$d->getDegree_id().'" >'.$d->getDegree_name().'</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 " >
                    <div class="form-group" >
                        <?php 
                        require_once "class/class.department.php";
                        $d = department::getAllDepartment();
                        ?>
                        <label>Department</label>
                        <select name="dep[]" class="form-control" id="dep"  multiple="multiple">
                            <option value="0" >All</option>
                            <?php
                            foreach ($d as $dp){
                            ?>
                            <option value="<?=$dp->getDep_id() ?>" <?=(isset($_REQUEST['dep']) && $_REQUEST['dep']==$dp->getDep_id())?"selected":"" ?>><?=$dp->getDep_name() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 " >
                    <div class="form-group">
                        <label>Branch</label>
                        <select name="branch[]" class="form-control" id="branch"  multiple="multiple">
                            <option value="0" >All</option>
                            <?php                                    
                                require_once 'class/class.branch.php';
                                require_once 'class/class.department.php';
                                $d = department::getAllDepartment();
                                foreach ($d as $dp){
                            ?>
                            <optgroup label="<?=$dp->getDep_name() ?>" >
                            <?php
                                    $bran = branch::getAllBranch(' dep_id='.$dp->getDep_id());
                                    foreach ($bran as $b){
                            ?>
                                <option value="<?=$b->getBranch_id() ?>" <?=(isset($_REQUEST['branch']) && $_REQUEST['branch']==$b->getBranch_id())?"selected":"" ?>><?=$b->getBranch_name() ?></option>
                            <?php            
                                    }
                            ?>
                            </optgroup>    
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12" >
                    <div class="form-group">
                        <label>Criteria</label>
                        <textarea class="form-control" name="criteria" ></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" name="job" value="9" />
<input type="hidden" name="job_id" value="<?=$j->getJob_id() ?>" />
<input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
<?php
    }
    else{
        echo error("<strong>Access Denied!</strong> You have no permission to modifty this job");
    }    
}
?>

<?php 
if(isset($_REQUEST['job_id'])){
    require_once 'class/class.jobs.php';
    $jl = new jobs();
    $jl->findOnJob_id(real_escape_string($_REQUEST['job_id']));
?>
<section class="content-header" >    
    <h1 class="page-header text-info">List of Applicant</h1>    
    <p><b>Job Title:</b> <?=$jl->getDesg() ?> | <?=$jl->getDescription() ?></p>
</section>
<section class="content-element" >    
    <div class="panel panel-default" >
        <div class="panel-heading" >
            Applicant List 
            
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-primary dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
                    <span class="glyphicon glyphicon-download-alt" ></span> Download <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a target="_blank" href="download_students_list_for_job.php?job_id=<?=$jl->getJob_id() ?>&type=0">All</a></li>
                    <li><a target="_blank" href="download_students_list_for_job.php?job_id=<?=$jl->getJob_id() ?>&type=<?=APP_ACCEPTED ?>">Accepted List</a></li>
                    <li><a target="_blank" href="download_students_list_for_job.php?job_id=<?=$jl->getJob_id() ?>&type=<?=APP_REJECTED ?>">Rejected List</a></li>                    
                </ul>
            </div>
            
        </div>
        <table class="table table-bordered table-hovered" >
            <tr class="active" >
                <td>Student Name</td>
                <td>Degree</td>
                <td>Department</td>
                <td>Branch</td>
                <td>Email</td>
                <td>Phone</td>  
                <td>Application Status</td>
                <td>Option</td>      
            </tr>
            <?php 
            require_once 'class/class.job_application.php';
            require_once 'class/class.students_profile.php';
            require_once 'class/class.degree.php';
            require_once 'class/class.branch.php';
            require_once 'class/class.department.php';
            $d = new degree();
            $b = new branch();
            $dep = new department();
            $ja = job_application::getAllJob_application(" job_id=".  real_escape_string($_REQUEST['job_id'])); 
            $s = new students_profile();
            
            
            
            foreach ($ja as $j){
                $s->findOnProfile_id($j->getStudent_profile_id());
                $d->findOnDegree_id($s->getDegree());
                $b->findOnBranch_id($s->getBranch());
                $dep->findOnDep_id($s->getDeparment());
            ?>
            <tr>
                <td><?=$s->getName() ?></td>
                <td><?=$d->getDegree_name() ?></td>
                <td><?=$dep->getDep_name() ?></td>
                <td><?=$b->getBranch_name() ?></td>
                <td><?=$s->getEmail() ?></td>
                <td><?=$s->getPhone() ?></td>     
                <td><span class="badge" ><?=getApplicationStatus($j->getApplication_status()) ?></span></td>
                <td>
                    <a href="?page_id=11&std_id=<?=$s->getProfile_id() ?>" class="btn btn-primary btn-xs" title="View Details"  ><span class="glyphicon glyphicon-check"></span></a>                    
                    <?php 
                    if(USER_TYPE==COMPANY){
                    ?>
                    <a href="process.php?job=29&job_id=<?=$_REQUEST['job_id'] ?>&id=<?=$j->getJob_app_id() ?>" class="btn btn-success btn-xs" title="Accept Application"  ><span class="glyphicon glyphicon-ok-sign"></span></a>                    
                    <a href="process.php?job=30&job_id=<?=$_REQUEST['job_id'] ?>&id=<?=$j->getJob_app_id() ?>" class="btn btn-danger btn-xs" title="Reject Application"  ><span class="glyphicon glyphicon-remove-sign"></span></a>                    
                    <?php 
                    }
                    ?>
                </td>
            </tr>
            <?php 
            }
            ?>

        </table>
    </div>
</section>
<?php 
}
?>


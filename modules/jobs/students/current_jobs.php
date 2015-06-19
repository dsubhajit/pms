<?php 
if(USER_STATUS==VERIFIED){
?>          
<div class="panel panel-default" >
    <div class="panel-heading" >Current Jobs</div>
    <table class="table table-bordered table-hovered" >
        <tr class="active" >                       
            <td>Company Name</td>
            <td>Job Designation</td>                        
            <td>Degree</td>
            <td>Department</td> 
            <td>Application Status</td>
            <td>Options</td>
        </tr>
        <?php 
        require_once 'class/class.jobs.php';
        require_once 'class/class.company_profile.php';
        require_once 'class/class.job_application.php';
        require_once 'class/class.students_profile.php';
        require_once 'class/class.degree.php';
        require_once 'class/class.department.php';
        require_once 'class/class.branch.php';
        $std = new students_profile();
        $std->findOnProfile_id(USER_PROFILE);
        $cmp = new company_profile();
        $as = new job_application();
        $i=1;
        if($std->getJob_status() !=1 || $std->getMultiple_job_allow() == 1 ){
            $jobs = jobs::getAllJobs(" YEAR(create_date)>=".date("Y")."  and verified=1 and (degree=0 or find_in_set('".$std->getDegree()."',degree) <> 0) and (department=0 or find_in_set('".$std->getDeparment()."',department) <> 0) and (branch=0 or find_in_set('".$std->getBranch()."',branch) <> 0) order by job_id desc");
            foreach ($jobs as $j){
                $cmp->findOnProfile_id($j->getProfile_id());
                $as->findOnJob_app_idAndUser_id($j->getJob_id(),USER_PROFILE);
                $deg = new degree();
                $deg_names = $deg->findOnDegree('degree_name', ' degree_id in ('.$j->getDegree().')');
                $dep = new department();                        
                $dep_names = $dep->findOnDepartment('dep_name',' dep_id in('.$j->getDepartment().')' );
                $b = new branch();
                $b_names = $b->findOnBranch('branch_name',' branch_id in ('.$j->getBranch().')');
                //var_dump($as);
            ?>
            <tr class="<?=getStatusClass($j->getVerified()) ?>" >            
                <td><?=$cmp->getCompany_name() ?></td>
                <td><?=$j->getDesg() ?></td>

                <td><?=  vImplode(',', $deg_names) ?></td>
                <td><?=  vImplode(',', $dep_names) ?></td>

                <td><span class="badge" >
                    <?php 
                    if($as->getJob_app_id()!==NULL){
                        echo getApplicationStatus($as->getApplication_status());
                    }
                    else {
                        echo "Not Applied Yet.";
                    }
                    ?>
                    </span>
                </td>

                <td>
                    <a href="#" class="btn btn-info btn-xs" title="View Details" data-toggle="modal" data-id="<?=$j->getJob_id() ?>" data-target="#ajaxModal" ><span class="glyphicon glyphicon-folder-open" ></span></a>                            
                    <?php 
                    if($as->getJob_app_id()==NULL){
                    ?>
                    <a href="process.php?job=27&id=<?=$j->getJob_id() ?>" class="btn btn-info btn-xs" title="Apply for this job"  ><span class="glyphicon glyphicon glyphicon-share-alt" ></span></a>                            
                    <?php 
                    }
                    ?>
                </td>
            </tr>
            <?php    
            }
        }
        else {
            echo '<tr><td colspan="9" ><div class="alert alert-info" >You already got a job. So you wouldn\'t  able to apply for another job.</div></td></tr>';
        }
        ?>
    </table>

</div>
        
<?php 

include 'includes/ajax-modal.php';
?>
<script>
    $('#ajaxModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Job Details');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax/job-details.php?id='+id,
           type:'post',
           dataType:'html',
           success:function(html){               
               
               modal.find('.modal-body').html(html);
               modal.find('.modal-footer').remove();
           }
        });
    });
</script>
<?php 
}
?>
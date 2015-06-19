
<section class="content-header" >
    <h1 class="page-header text-info">Job List</h1>    
</section>
<section class="content-element" >
    <div class="row" >        
        <div class="col-sm-12" >            
            <div class="panel panel-default" >
                <div class="panel-heading" >All Jobs</div>
                <table class="table table-bordered table-hovered" style="font-size:12px;" >
                    <tr class="active" >
                        <td>Sl.No.</td>
                        <td>Company Name</td>
                        <td>Job Designation</td>                        
                        <td>Degree</td>
                        <td>Department</td>                        
                        <td>Date</td>
                        <td>Status</td>
                        <td>Options</td>
                    </tr>
                    <?php 
                    require_once 'class/class.jobs.php';
                    require_once 'class/class.company_profile.php';
                    require_once 'class/class.degree.php';
                    require_once 'class/class.department.php';
                    require_once 'class/class.branch.php';
                    $cmp = new company_profile();
                    $i=1;
                    $jobs = jobs::getAllJobs(" YEAR(create_date)>=".date("Y")."  and verified!=0 order by job_id desc");
                    foreach ($jobs as $j){
                        $cmp->findOnProfile_id($j->getProfile_id());
                        $deg = new degree();
                        $deg_names = $deg->findOnDegree('degree_name', ' degree_id in ('.$j->getDegree().')');
                        $dep = new department();                        
                        $dep_names = $dep->findOnDepartment('dep_name',' dep_id in('.$j->getDepartment().')' );
                        $b = new branch();
                        $b_names = $b->findOnBranch('branch_name',' branch_id in ('.$j->getBranch().')');
                    ?>
                    <tr class="<?=getStatusClass($j->getVerified()) ?>" >
                        <td><?=$i++ ?></td>
                        <td><?=$cmp->getCompany_name() ?></td>
                        <td><?=$j->getDesg() ?></td>
                        
                        
                        <td><?=vImplode(',',$deg_names) ?></td>
                        <td><?=vImplode(',', $dep_names) ?></td>
                        
                        <td><?=$j->getCreate_date() ?></td>
                        <td><?=getStatus($j->getVerified()) ?></td>
                        <td>
                            <a href="#" class="btn btn-info btn-xs" title="View Details" data-toggle="modal" data-id="<?=$j->getJob_id() ?>" data-target="#ajaxModal" ><span class="glyphicon glyphicon-folder-open" ></span></a>
                            <a href="process.php?job=21&id=<?=$j->getJob_id() ?>" class="btn btn-success btn-xs" ><span class="glyphicon glyphicon-ok-sign" title="Approve this job" ></span></a>                            
                            <a href="process.php?job=22&id=<?=$j->getJob_id() ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove-sign" title="Reject It" ></span></a>
                        </td>
                    </tr>
                    <?php    
                    }
                    ?>
                </table>
                
            </div>
        </div>
        <div class="col-sm-6" >
            
        </div>
    </div>
    
    
    
</section>
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
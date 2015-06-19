
<section class="content-header" >
    <h1 class="page-header text-info">Job List</h1>    
</section>
<section class="content-element" >
    <div class="row" >
        <div class="col-md-12" style="margin-bottom: 10px;" >
            
            <?php 
            require_once 'class/class.company_login.php';
            $cl = new company_login();
            $cl->findOnCmp_id(USER_ID);
            if($cl->getVerified()==VERIFIED){
            ?>
            <a href="#"  data-toggle="modal" data-target="#addJobModal" class="btn btn-primary" ><span class="glyphicon glyphicon-plus" ></span> Add Job</a>
            
            <?php
            }
            ?>
            
        </div>
        <div class="col-sm-12" >            
            <div class="panel panel-default" >
                <div class="panel-heading" >All Jobs</div>
                <table class="table table-bordered table-hovered" style="font-size:12px;" >
                    <tr class="active" >
                        <td>Sl.No.</td>
                        <td>Job Designation</td>
                        <td>Job Description</td>
                        <td>Degree</td>
                        <td>Department</td>
                        <td>Branches</td>
                        <td>Date</td>
                        <td>Status</td>
                        <td>Options</td>
                    </tr>
                    <?php 
                    require_once 'class/class.jobs.php';
                    require_once 'class/class.degree.php';
                    require_once 'class/class.department.php';
                    require_once 'class/class.branch.php';
                    
                    $i=1;
                    $jobs = jobs::getAllJobs(" profile_id=".USER_PROFILE." order by job_id desc");
                    foreach ($jobs as $j){                        
                        $deg = new degree();
                        $deg_names = $deg->findOnDegree('degree_name', ' degree_id in ('.$j->getDegree().')');
                        $dep = new department();                        
                        $dep_names = $dep->findOnDepartment('dep_name',' dep_id in('.$j->getDepartment().')' );
                        $b = new branch();
                        $b_names = $b->findOnBranch('branch_name',' branch_id in ('.$j->getBranch().')');
                        
                    ?>
                    <tr class="<?=getStatusClass($j->getVerified()) ?>" >
                        <td><?=$i++ ?></td>
                        <td><?=$j->getDesg() ?></td>
                        <td><?=$j->getDescription() ?></td>
                        
                        <td><?=vImplode(',',$deg_names) ?></td>
                        <td><?=vImplode(',', $dep_names) ?></td>
                        <td><?=vImplode(',', $b_names) ?></td>
                        <td><?=$j->getCreate_date() ?></td>
                        <td><?=getStatus($j->getVerified()) ?></td>
                        <?php 
                        if($cl->getVerified()==VERIFIED){
                        ?>
                        <td>                            
                            <a href="process.php?job=10&id=<?=$j->getJob_id() ?>" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-ok-sign" title="Send for verification" ></span></a>
                            <!--
                            <a href="#" data-toggle="modal" data-id="<?=$j->getJob_id() ?>" data-target="#ajaxModal" class="btn btn-primary btn-xs" ><span class="glyphicon glyphicon-edit" title="Edit" ></span></a>
                            -->
                            <a href="process.php?job=11&id=<?=$j->getJob_id() ?>" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash" title="Delete" ></span></a>
                            <a href="?page_id=12&job_id=<?=$j->getJob_id() ?>" class="btn btn-warning btn-xs" title="Application List" ><span class="glyphicon glyphicon-list-alt" ></span></a> 
                            <a href="?page_id=17&job_id=<?=$j->getJob_id() ?>" class="btn btn-info btn-xs" title="Create Job Offer" ><span class="glyphicon glyphicon-briefcase" ></span></a>
                         </td>
                        <?php 
                        }
                        else echo "<td></td>";
                        ?>
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
include 'modules/jobs/company/create_job.php';
include 'includes/ajax-modal.php';
?>
<script>
    $('#ajaxModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit Job');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_job_details.php?id='+id,
           type:'post',
           dataType:'html',
           success:function(html){               
               removeCKEditorInstance();     
               modal.find('.modal-body').html(html);
               createEditor();     
           }
        });
    });
</script>
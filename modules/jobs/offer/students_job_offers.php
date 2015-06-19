<div class="panel panel-danger" >
    <div class="panel-heading" >
        <span class="glyphicon glyphicon-pushpin" ></span> Job Offers
    </div>
    <div class="panel-body" >
        <table class="table table-bordered table-hovered" >
            <tr class="info" >
                <td>#</td>
                <td>Job Designation</td>
                <td>Company Name</td>
                <td>CTC</td>
                <td>Description</td>
                <td>Status</td>
                <td>
                    Options
                </td>
            </tr>
            <?php 
            require_once 'class/class.job_offer.php';
            require_once 'class/class.job_salary_details.php';
            require_once 'class/class.jobs.php';
            require_once 'class/class.company_profile.php';
            require_once 'class/class.students_profile.php';
            $std = new students_profile();
            $std->findOnProfile_id(USER_PROFILE);
            
            $job_offers =  job_offer::getAllJob_offer(' status!='.JOB_REJECTED.' and student_id='.USER_PROFILE);
            $i=1;
            foreach ($job_offers as $jo){
                $j = new jobs();
                $j->findOnJob_id($jo->getJob_id());
                $cmp = new company_profile();
                $cmp->findOnProfile_id($j->getProfile_id());
                $js = new job_salary_details();
                $ctc = $js->findOnJob_salary_details("ctc", " job_id=".$j->getJob_id()." and (degree=0 or find_in_set('".$std->getDegree()."',degree) <> 0)");
                //print_r($jo);
            ?>
            <tr>
                <td><?=$i++ ?></td>
                <td><?=$j->getDesg() ?></td>
                <td><?=$cmp->getCompany_name() ?></td>
                <td><?=  vImplode(',',$ctc) ?></td>
                <td><?=$j->getDescription() ?></td>
                <td><?=getJobOfferStatus($jo->getStatus()) ?></td>
                <td>
                    <?php 
                    if($jo->getStatus() == JOB_PENDING ){
                    ?>
                    <a href="" class="btn btn-primary btn-xs" title="View Offer" data-toggle="modal" data-id="<?=$jo->getId() ?>" data-target="#viewOfferModal"   >
                        <span class="glyphicon glyphicon-check" ></span>
                    </a>
                    <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-id="<?=$j->getJob_id() ?>" data-target="#ajaxModal" title="View Job Details" >
                        <span class="glyphicon glyphicon-briefcase" ></span>
                    </a>
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
</div>
<?php 
$modal_name='viewOfferModal';
include 'includes/sample_modal2.php';
?>
<script>
$('#viewOfferModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-title').text('Job Offer Details');

    var recipient = button.data('id') ;
    $.ajax({
        url:'ajax/job_offer_details.php?id='+id,
        type:'post',
        dataType:'html',
        success:function(html){               
            //removeCKEditorInstance();     
            modal.find('.modal-body').html(html);
            //createEditor();     
        }
    });
});
</script>
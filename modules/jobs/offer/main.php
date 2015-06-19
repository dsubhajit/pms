
<section class="content-header" >
    <h1 class="page-header text-info">Job Offers</h1>    
</section>
<section class="content-element" >
    <div class="row" >
        <div class="col-md-12" style="margin-bottom: 10px;"  >
            <a href="#" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#createOfferModal" ><span class="glyphicon glyphicon-plus" ></span> Create Offer</a>
        </div>
        <div class="col-md-6" >
            <table class="table table-bordered table-hovered" >
                <tr class="active" >
                    <td>Sl.No.</td>
                    <td>Enrollment No.</td>
                    <td>Student Name</td>
                    <td>Status</td>
                    
                </tr>
                <?php 
                require_once 'class/class.job_offer.php';
                require_once 'class/class.jobs.php';    
                require_once 'class/class.students_profile.php';
                $job_offer = job_offer::getAllJob_offer();
                
                $i=1;
                foreach ($job_offer as $jo){
                    $std = new students_profile();
                    $std->findOnProfile_id($jo->getStudent_id());
                    //$j = new jobs();
                    //$j->findOnJob_id($jo->getJob_id())
                ?>
                <tr class="<?=  getJobStatusClass($jo->getStatus()) ?>" >
                    <td>
                     <?=$i ?>   
                    </td>
                    <td><a href="?page_id=11&std_id=<?=$std->getProfile_id() ?>" ><?=$std->getEnroll_no() ?></a></td>
                    <td><a href="?page_id=11&std_id=<?=$std->getProfile_id() ?>" ><?=$std->getName() ?></a></td>                    
                    <td><?=getJobOfferStatus($jo->getStatus()) ?></td>                    
                </tr>
                <?php 
                    $i++;
                }    
                ?>

            </table>
        </div>
        <div class="col-md-6" >  
            
        </div>
    </div>
    
    
    
</section>
<?php 
require_once 'modules/jobs/offer/create_offer.php';
?>
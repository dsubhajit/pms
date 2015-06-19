
<section class="content-header" >
    <h1 class="page-header text-info">Dashboard</h1>
    
</section>
<section class="content-element" >
    <div class="row" >
        <?php 
        if(USER_PRIV==TRUE){
        ?>
        <div class="col-md-6" >
        <?php include_once 'modules/dashboard/students/students_approval_req_list.php'; ?>    
        </div>
        <?php 
        }
        ?>
        <div class="col-sm-12" >
            <?php include_once 'modules/jobs/offer/students_job_offers.php'; ?>   
        </div>
        <div class="col-sm-12" >
            <?php include_once 'modules/jobs/students/current_jobs.php'; ?>   
        </div>
        <div class="col-md-12" >
            <?php 
            if(USER_STATUS==VERIFIED){
            ?>
            <div class="panel panel-warning" >
                <div class="panel-heading" >Notifications</div>
                <div class="body" style="height: 300px;overflow:auto;overflow-y: auto;" >
                    <ul class="list-group">                        
                        <?php 
                        require_once 'class/class.students_notif.php';

                        $notif = students_notif::getAllStudents_notif(" 1 order by notif_id desc");
                        $i= count($notif);
                        foreach ($notif as $n){
                        ?>
                        <li class="list-group-item"><?=$n->getNotif_title() ?> | <b>Date : </b> <?=$n->getNotif_date() ?> | <b>Severity :</b> <?=getNotifSeverity($n->getSeverity()) ?><a href="?page_id=8&std_notif_id=<?=$n->getNotif_id() ?>" class="btn btn-primary btn-xs pull-right" title="View Details"  ><span class="glyphicon glyphicon-check"></span></a></li>                                                
                        <?php 
                        }    
                        ?>
                    </ul>
                </div>
            </div>
            <?php 
            }
            ?>
        </div>
        
    </div>
    
    
    
</section>

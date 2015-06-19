<?php 
if(isset($_REQUEST['cmp_id'])&& $_REQUEST['cmp_id']!=NULL){
?>
<?php 
    require_once 'class/class.company_profile.php';
    require_once 'class/class.company_login.php';
    $cmp = new company_login();
    $cmp->findOnCmp_id(real_escape_string($_REQUEST['cmp_id']));
    if($cmp->getCmp_id()!=NULL){
    $cp = new company_profile();
    $cp->findOnProfile_id(real_escape_string($cmp->getProfile_id()));
?>
<section class="content-header" >
    
    <h1 class="page-header text-info"><?=$cp->getCompany_name() ?></h1>
    <p class="text-muted" >
        <span class="glyphicon glyphicon-user" ></span> <?=$cp->getCp_name() ?> 
        <span class="glyphicon glyphicon-envelope" ></span> <?=$cp->getCp_email() ?>
        <span class="glyphicon glyphicon-phone" ></span> <?=$cp->getCp_phone() ?>
        <span class="glyphicon glyphicon-briefcase" ></span> <?=$cp->getCp_desg() ?>     
    </p>
    <div class="row" >
        <div class="col-md-6" >
            <p><b><span class="glyphicon glyphicon-map-marker" ></span>  Address</b></p>
            <?=  nl2br($cp->getPost_add()) ?>
        </div>
        <div class="col-md-6" >
            <p><b>Company Type</b></p>
            <?=$cp->getCmp_type() ?>
        </div>
    </div>
    
</section>
<section class="content-element" >
    <?php 
        if(USER_TYPE==ADMIN && $cmp->getVerified()==2){
    ?>
    <div class="row" style="margin-bottom:20px;" >
        <div class="col-md-12" >
            <a href="process.php?job=17&cmp_id=<?=$cmp->getCmp_id() ?>" class="btn btn-primary " title="Verify"  ><span class="glyphicon glyphicon-ok-sign"></span> Verify</a>
            <a href="process.php?job=18&cmp_id=<?=$cmp->getCmp_id() ?>" class="btn btn-danger " title="Reject"  ><span class="glyphicon glyphicon-remove-sign"></span> Reject</a>
        </div>
    </div>
    <?php
        }
    ?>
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-circle-arrow-right" ></span> About
            
        </div>
        <div class="panel-body" id="about-user-data" >
            <?=$cp->getAbout() ?>
        </div>
    </div>
     
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-pushpin" ></span> Industry Sector
            
        </div>
        <div class="panel-body" id="about-user-data" >
            <?php 
                echo $cp->getMission();
            ?>
        </div>
    </div>
    <?php 
    /*
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-pushpin" ></span> Culture
            
        </div>
        <div class="panel-body" id="about-user-data" >
            <?php 
                echo $cp->getCulture();
            ?>
        </div>
    </div>
     * 
     */
    ?>
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-briefcase" ></span> Posted Jobs
            
        </div>
        
        <table class="table table-bordered table-hovered" >
            <tr class="active" >
                <td>Sl.No.</td>
                <td>Job Title</td>
                <td>Job Code</td>
                <td>Degree</td>
                <td>Branches</td>
                <td>Last Date</td>
                <td>Status</td>                    
            </tr>
            <?php 
            require_once 'class/class.job_list.php';
            $i=1;
            $jobs = job_list::getAllJob_list(' where profile_id='+$cp->getProfile_id()+" order by job_id desc");
            foreach ($jobs as $j){
            ?>
            <tr class="<?=getStatusClass($j->getVerified()) ?>" >
                <td><?=$i++ ?></td>
                <td><?=$j->getJob_title() ?></td>
                <td><?=$j->getJob_serial() ?></td>
                <td><?=$j->getDegree() ?></td>
                <td><?=$j->getBranches() ?></td>
                <td><?=$j->getLast_date() ?></td>
                <td><?=getStatus($j->getVerified()) ?></td>                    
            </tr>
            <?php    
            }
            ?>
        </table>
        
    </div>
    
</section>

<?php 
    }
} 
?>


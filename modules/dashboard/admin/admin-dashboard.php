
<section class="content-header" >
    <h1 class="page-header text-info">Dashboard</h1>
    
</section>
<section class="content-element" >
    <div class="row" >
        <div class="col-md-8" >
            <div class="panel panel-default" >
                <div class="panel-heading" >
                    Company Verification Requests
                </div>
                <table class="table table-bordered table-hovered" >
                    <tr class="active" >
                        <td>Company Name</td>
                        <td>Contact Name</td>
                        <td>Phone</td>
                        <td>Email</td>
                        <td>Options</td>
                    </tr>
                    <?php
                        require_once 'class/class.company_login.php';
                        require_once 'class/class.company_profile.php';
                        
                        $cmp = company_login::getAllCompany_login(" verified=2 order by cmp_id desc");
                        foreach ($cmp as $cp){
                            $c= new company_profile();
                            $c->findOnProfile_id($cp->getProfile_id());
                   ?>
                   <tr>
                       <td><?=$c->getCompany_name() ?></td>
                       <td><?=$c->getCp_name() ?></td>
                       <td><?=$c->getCp_phone() ?></td>
                       <td><?=$c->getCp_email() ?></td>
                       <td>
                           <a href="?page_id=6&cmp_id=<?=$cp->getCmp_id() ?>" class="btn btn-primary btn-xs" title="View Details"  ><span class="glyphicon glyphicon-check"></span></a>
                           <a href="process.php?job=17&cmp_id=<?=$cp->getCmp_id() ?>" class="btn btn-primary btn-xs" title="Verify"  ><span class="glyphicon glyphicon-ok-sign"></span></a>
                           <a href="process.php?job=18&cmp_id=<?=$cp->getCmp_id() ?>" class="btn btn-danger btn-xs" title="Reject"  ><span class="glyphicon glyphicon-remove-sign"></span></a>
                       </td>
                   </tr> 
                   <?php
                        }
                    ?>
                    
                </table>
            </div>
        </div>
        <div class="col-md-4" >            
            <div class="panel panel-warning" >
                <div class="panel-heading" >Application Statistics</div>
                <div class="body" style="height: 300px;overflow:auto;overflow-y: auto;" >
                    <ul class="list-group">                        
                        <?php 
                        require_once 'class/class.job_application.php';
                        require_once 'class/class.jobs.php';
                        
                        $ja = new job_application();
                        
                        $res = $ja->findOnJob_application('job_id,count(job_app_id)','1 group by job_id order by job_id');
                        //var_dump($res);
                        foreach ($res as $r){
                            $j = new jobs();
                            $j->findOnJob_id($r[0]);
                        ?>
                        <li class="list-group-item"><?=$j->getDesg() ?> <span class="badge pull-right" title="Number of application" ><?=$r[1] ?></span></li>                                                
                        <?php 
                        }    
                        ?>
                    </ul>
                </div>
            </div>
        
        </div>
    </div>    
    
</section>

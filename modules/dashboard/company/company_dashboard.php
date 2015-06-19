
<section class="content-header" >
    <h1 class="page-header text-info">Dashboard</h1>
    
</section>
<section class="content-element" >
    <div class="row" >
        
        <div class="col-md-6" >
            <div class="panel panel-warning" >
                <div class="panel-heading" >Notifications</div>
                <div class="body" style="height: 300px;overflow:auto;overflow-y: auto;" >
                    <ul class="list-group">                        
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6" >
            <div class="panel panel-warning" >
                <div class="panel-heading" >Application Statistics</div>
                <div class="body" style="height: 300px;overflow:auto;overflow-y: auto;" >
                    <ul class="list-group">                        
                        <?php 
                        require_once 'class/class.job_application.php';
                        require_once 'class/class.jobs.php';
                        require_once 'class/class.company_profile.php';
                        
                        $ja = new job_application();
                        
                        $res = $ja->findOnJob_application('job_id,count(job_app_id)',' company_profile_id='.USER_PROFILE.' group by job_id order by job_id');
                        //var_dump($res);
                        foreach ($res as $r){
                            
                            $j = new jobs();
                            $j->findOnJob_id($r[0]);
                            
                        ?>
                        <li class="list-group-item"> <?=$j->getDesg() ?> <span class="badge pull-right" title="Number of application" ><?=$r[1] ?></span></li>                                                
                        <?php 
                        }    
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    
    
</section>

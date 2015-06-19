<?php 
if(isset($_REQUEST['std_id'])){ 
    require_once 'class/class.students_profile.php';
    require_once 'class/class.students_login.php';
    require_once 'class/class.degree.php';
    require_once 'class/class.department.php';
    require_once 'class/class.branch.php';
    $d = new degree();
    $b = new branch();
    $stud = new students_profile();
    $stud->findOnProfile_id($_REQUEST['std_id']);
    $d->findOnDegree_id($stud->getDegree());
    $b->findOnBranch_id($stud->getDeparment());
    $dep = new department();
    $dep->findOnDep_id($stud->getDeparment());
?>
<section class="content-header" >
    <h1 class="page-header text-info"><?=$stud->getName() ?>
        <a target="_blank" href="download_studentcv.php?std-prof_id=<?=$stud->getProfile_id() ?>" class="btn btn-primary pull-right btn-xs"  style="margin-right:10px"  ><span class="glyphicon glyphicon-download-alt" ></span> Download CV</a>&nbsp;
    </h1>
    <p class="text-muted" ><span class="glyphicon glyphicon-envelope" ></span> <?=$stud->getEmail() ?> <span class="glyphicon glyphicon-earphone" ></span> <?=$stud->getPhone() ?></p>
    <h5><b>Enrolment No.: </b><?=$stud->getEnroll_no() ?> <b>Degree:</b> <?=$d->getDegree_name() ?> <b>Department:</b> <?=$dep->getDep_name() ?> <b>Reg.Year:</b> <?=$stud->getAdm_yr_start() ?> - <?=$stud->getAdm_yr_end() ?></h5>
    <p><b>Languages:</b> <?=$stud->getLanguages() ?></p>
    <p><b>Hobbies:</b> <?=$stud->getHobbies() ?> </p>
    <fieldset style="margin-bottom:10px;" >
        <legend></legend>        
        <div class="col-md-6" ><span class="glyphicon glyphicon-map-marker" ></span> <b>Current Address</b><br /><span><?=$stud->getAdd1() ?></span></div>
        <div class="col-md-6" ><span class="glyphicon glyphicon-map-marker" ></span> <b>Permanent Address</b><br /><span><?=$stud->getAdd2() ?></span></div>
    </fieldset>    
    
</section>
<section class="content-element" >
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-circle-arrow-right" ></span> Objective
            
        </div>
        <div class="panel-body" id="about-user-data" >
            <?=$stud->getAbout() ?>
        </div>
    </div>
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-circle-arrow-right" ></span> Professional Interest
            
        </div>
        <div class="panel-body" id="about-user-data" >
            <?=$stud->getProf_interest() ?>
        </div>
    </div>
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-pushpin" ></span> Technical Skills
            
        </div>
        <div class="panel-body" id="about-user-data" >
            <?php 
            require_once 'class/class.students_tech.php';
            $t = new students_tech();
            $t->findOnTech_id($stud->getTech_id());
            if($t->getTech_id()!=NULL){
            ?>
            <p><strong>Languages: </strong><?=$t->getTech_langs() ?></p>
            <p><strong>Frameworks: </strong><?=$t->getTech_frameworks() ?></p>
            <p><strong>Tools: </strong><?=$t->getTech_tools() ?></p>
            <?php 
            }
            ?>
        </div>
    </div>
    <div class="row" >
        <div class="col-sm-6" >
            <div class="panel panel-default" >
                <div class="panel-heading clearfix" >
                    <span class="glyphicon glyphicon-star" ></span> Experience
                    
                </div>
                <div class="panel-body" >
                    <?php 
                    require_once 'class/class.students_exp.php';
                    $exp = students_exp::getAllStudents_exp(' profile_id='.$_REQUEST['std_id']);
                    foreach ($exp as $ex){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$ex->getExp_type() ?>
                            
                        </h4>
                        <p><?=$ex->getStart_date() ?> - <?=$ex->getEnd_date() ?></p>
                        <p class="text-muted">Designation: <?=$ex->getDesignation() ?></p>                        
                        <p class="text-muted">Organization: <?=$ex->getOrganization() ?></p>  
                        <p class="text-muted"><?=$ex->getDescription() ?></p>  
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="panel panel-default" >
                <div class="panel-heading clearfix" >
                    <span class="glyphicon glyphicon-star" ></span> Leadership Experience
                    
                </div>
                <div class="panel-body" >
                    <?php 
                    require_once 'class/class.students_leadership.php';
                    $lexp = students_leadership::getAllStudents_leadership(' profile_id='.$_REQUEST['std_id']);
                    foreach ($lexp as $lex){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$lex->getDesignation() ?>
                            
                        </h4>
                        <p><?=$lex->getStart_date() ?> - <?=$lex->getEnd_date() ?></p>                                               
                        <p class="text-muted">Organization: <?=$lex->getOrganization() ?></p>  
                        <p class="text-muted"><?=$lex->getDescription() ?></p>  
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="panel panel-default" >
                <div class="panel-heading clearfix" >
                    <span class="glyphicon glyphicon-education" ></span> Education
                    
                </div>
                <div class="panel-body" >
                    
                    <div class="edu_details_conatiner" >
                        <h4>
                            <?=INST_NAME ?> 
                            
                        </h4>
                        <p><?=$d->getDegree_name() ?> <?=$dep->getDep_name(); ?></p>
                        <p class="text-muted"><?=$stud->getAdm_yr_start() ?> - <?=$stud->getAdm_yr_end() ?></p>
                        <p class="text-muted"><?=$b->getBranch_name() ?></p>
                        <p class="text-muted"></p>
                        <p class="text-muted"><strong>CGPA:</strong> <?=$stud->getCgpa() ?></p>
                    </div>
                    <?php 
                    require_once 'class/class.students_edu.php';
                    $edu = students_edu::getAllStudents_edu(' profile_id='.$_REQUEST['std_id']);
                    foreach ($edu as $e){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$e->getEdu_inst_name() ?>
                            
                        </h4>
                        <p><?=$e->getEdu_degree() ?> <?=$e->getEdu_major() ?></p>
                        <p class="text-muted"><?=$e->getEdu_date_form() ?> - <?=$e->getEdu_date_to() ?></p>
                        <p class="text-muted"><?=$e->getEdu_desc() ?></p>
                        <p class="text-muted"><?=$e->getEdu_skill() ?></p>
                        <p class="text-muted"><strong>Percentage:</strong> <?=$e->getEdu_percentage() ?> <strong>CGPA:</strong><?=$e->getEdu_cgpa() ?></p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="panel panel-default" >
                <div class="panel-heading clearfix" >
                    <span class="glyphicon glyphicon-star" ></span> Achievements
                    
                </div>
                <div class="panel-body" >
                    <?php 
                    require_once 'class/class.achievements.php';
                    $achv = achievements::getAllAchievements(' profile_id='.$_REQUEST['std_id']);
                    foreach ($achv as $a){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$a->getAchiev_title() ?>
                            
                        </h4>
                        <p><?=$a->getAchiev_date() ?></p>
                        <p class="text-muted"><?=$a->getAchiev_description() ?></p>                        
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="col-sm-6" >
            <div class="panel panel-default" >
                <div class="panel-heading clearfix" >
                    <span class="glyphicon glyphicon-briefcase" ></span> Professional Developments
                    
                </div>
                <div class="panel-body"  >
                    <?php 
                    require_once 'class/class.students_prof_dev.php';
                    $profd = students_prof_dev::getAllStudents_prof_dev(' profile_id='.$_REQUEST['std_id']);
                    
                    foreach ($profd as $pd){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$pd->getDev_name() ?>
                            
                        </h4>     
                        <p class="text-muted" ><?=$pd->getDev_type() ?></p>
                        <p class="text-muted"><?=$pd->getStart_date() ?> - <?=$pd->getEnd_date() ?></p>
                        <p class="text-muted"><?=$pd->getDescription() ?></p>
                        
                        
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="panel panel-default" >
                <div class="panel-heading clearfix" >
                    <span class="glyphicon glyphicon-briefcase" ></span> Projects
                    
                </div>
                <div class="panel-body"  >
                    <?php 
                    require_once 'class/class.students_projects.php';
                    $proj = students_projects::getAllStudents_projects(' profile_id='.$_REQUEST['std_id']);
                    
                    foreach ($proj as $p){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$p->getPj_name() ?>
                            
                        </h4>                        
                        <p class="text-muted"><?=$p->getPj_from() ?> - <?=$p->getPj_to() ?></p>
                        <p class="text-muted"><?=$p->getPj_desc() ?></p>
                        <p class="text-muted"><?=$p->getPj_skills() ?></p>
                        <p class="text-muted"><?=($p->getPj_working()==1)?"Still Working.":"" ?></p>
                        
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="panel panel-default" >
                <div class="panel-heading clearfix" >
                    <span class="glyphicon glyphicon-book" ></span> Publications
                    
                </div>
                <div class="panel-body" >
                    <?php 
                        require_once 'class/class.students_pubs.php';
                        $pubs = students_pubs::getAllStudents_pubs(' profile_id='.$_REQUEST['std_id']);
                        foreach($pubs as $pb){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$pb->getPub_title()?></h4>                        
                        <p class="text-muted"><strong>Publisher: </strong><?=$pb->getPub_name() ?></p>
                        <p class="text-muted"><?=$pb->getPub_date() ?></p>
                        <p class="text-muted"><?=$pb->getPub_desc() ?></p>
                        <p class="text-muted"><?=$pb->getPub_skills() ?></p>
                        
                        
                    </div>    
                    <?php 
                        }
                    ?>
                </div>
            </div>
            <div class="panel panel-default" >
                <div class="panel-heading clearfix" >
                    <span class="glyphicon glyphicon-user" ></span> References
                    
                </div>
                <div class="panel-body"  >
                    <?php 
                    require_once 'class/class.students_ref.php';
                    $ref = students_ref::getAllStudents_ref(' profile_id='.$_REQUEST['std_id']);
                    
                    foreach ($ref as $sr){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$sr->getRef_name() ?>
                            
                        </h4>     
                        <p class="text-muted" >Phone: <?=$sr->getPhone() ?> Email: <?=$sr->getEmail() ?></p>
                        <p class="text-muted">Designation: <?=$sr->getDesignation() ?></p>
                        <p class="text-muted">Organization <?=$sr->getOrganization() ?></p>
                        
                        
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>    
    
    
</section>
<?php
}
?>
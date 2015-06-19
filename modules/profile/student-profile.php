<?php 
    require_once 'class/class.students_profile.php';
    require_once 'class/class.students_login.php';
    require_once 'class/class.degree.php';
    require_once 'class/class.department.php';
    require_once 'class/class.branch.php';
    $d = new degree();
    $b = new branch();
    $stud = new students_profile();
    $stud->findOnProfile_id(USER_PROFILE);
    $d->findOnDegree_id($stud->getDegree());
    $b->findOnBranch_id($stud->getDeparment());
    $dep = new department();
    $dep->findOnDep_id($stud->getDeparment());
?>
<section class="content-header" >
    <h1 class="page-header text-info"><?=$stud->getName() ?>
        <a href="#" class="btn btn-primary pull-right btn-xs" data-toggle="modal" data-target="#editInfoModal" ><span class="glyphicon glyphicon-edit" ></span> Edit</a> &nbsp;
        <a target="_blank" href="download_cv.php" class="btn btn-primary pull-right btn-xs"  style="margin-right:10px"  ><span class="glyphicon glyphicon-download-alt" ></span> Download CV</a>&nbsp;
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
            <button class="btn btn-primary btn-xs pull-right" id="edit_about" data-toggle="modal" data-target="#editAboutModal" ><span class="glyphicon glyphicon-edit" ></span> Edit</button>
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
            <button class="btn btn-primary btn-xs pull-right" id="edit_about" data-toggle="modal" data-target="#editTechModal" ><span class="glyphicon glyphicon-edit" ></span> Edit</button>
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
                    <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addExpModal" ><span class="glyphicon glyphicon-plus" ></span> Add</button>
                </div>
                <div class="panel-body" >
                    <?php 
                    require_once 'class/class.students_exp.php';
                    $exp = students_exp::getAllStudents_exp(' profile_id='.USER_PROFILE);
                    foreach ($exp as $ex){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$ex->getExp_type() ?>
                            <a href="#" class="pull-right" style="font-size:12px;" data-id="<?=$ex->getExp_id() ?>" data-toggle="modal" data-target="#editExpModal" ><span class="glyphicon glyphicon-pencil" ></span> Edit</a>
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
                    <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addLExpModal" ><span class="glyphicon glyphicon-plus" ></span> Add</button>
                </div>
                <div class="panel-body" >
                    <?php 
                    require_once 'class/class.students_leadership.php';
                    $lexp = students_leadership::getAllStudents_leadership(' profile_id='.USER_PROFILE);
                    foreach ($lexp as $lex){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$lex->getDesignation() ?>
                            <a href="#" class="pull-right" style="font-size:12px;" data-id="<?=$lex->getId() ?>" data-toggle="modal" data-target="#editLExpModal" ><span class="glyphicon glyphicon-pencil" ></span> Edit</a>
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
                    <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addEducationModal" ><span class="glyphicon glyphicon-plus" ></span> Add</button>
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
                    $edu = students_edu::getAllStudents_edu(' profile_id='.USER_PROFILE);
                    foreach ($edu as $e){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$e->getEdu_inst_name() ?>
                            <a href="#" class="pull-right" style="font-size:12px;" data-id="<?=$e->getEdu_id() ?>" data-toggle="modal" data-target="#ajaxModal" ><span class="glyphicon glyphicon-pencil" ></span> Edit</a>
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
                    <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addAchievModal" ><span class="glyphicon glyphicon-plus" ></span> Add</button>
                </div>
                <div class="panel-body" >
                    <?php 
                    require_once 'class/class.achievements.php';
                    $achv = achievements::getAllAchievements(' profile_id='.USER_PROFILE);
                    foreach ($achv as $a){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$a->getAchiev_title() ?>
                            <a href="#" class="pull-right" style="font-size:12px;" data-id="<?=$a->getAchiev_id() ?>" data-toggle="modal" data-target="#editAchievModal" ><span class="glyphicon glyphicon-pencil" ></span> Edit</a>
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
                    <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addProfDevModal" ><span class="glyphicon glyphicon-plus" ></span> Add</button>
                </div>
                <div class="panel-body"  >
                    <?php 
                    require_once 'class/class.students_prof_dev.php';
                    $profd = students_prof_dev::getAllStudents_prof_dev(' profile_id='.USER_PROFILE);
                    
                    foreach ($profd as $pd){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$pd->getDev_name() ?>
                            <a href="#" class="pull-right" style="font-size:12px;" data-id="<?=$pd->getId() ?>" data-toggle="modal" data-target="#editProfDevModal" ><span class="glyphicon glyphicon-pencil" ></span> Edit</a>
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
                    <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addProjectsModal" ><span class="glyphicon glyphicon-plus" ></span> Add</button>
                </div>
                <div class="panel-body"  >
                    <?php 
                    require_once 'class/class.students_projects.php';
                    $proj = students_projects::getAllStudents_projects(' profile_id='.USER_PROFILE);
                    
                    foreach ($proj as $p){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$p->getPj_name() ?>
                            <a href="#" class="pull-right" style="font-size:12px;" data-id="<?=$p->getPj_id() ?>" data-toggle="modal" data-target="#editProjModal" ><span class="glyphicon glyphicon-pencil" ></span> Edit</a>
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
                    <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addPubModal" ><span class="glyphicon glyphicon-plus" ></span> Add</button>
                </div>
                <div class="panel-body" >
                    <?php 
                        require_once 'class/class.students_pubs.php';
                        $pubs = students_pubs::getAllStudents_pubs(' profile_id='.USER_PROFILE);
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
                    <button class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addRefModal" ><span class="glyphicon glyphicon-plus" ></span> Add</button>
                </div>
                <div class="panel-body"  >
                    <?php 
                    require_once 'class/class.students_ref.php';
                    $ref = students_ref::getAllStudents_ref(' profile_id='.USER_PROFILE);
                    
                    foreach ($ref as $sr){
                    ?>
                    <div class="edu_details_conatiner" >
                        <h4><?=$sr->getRef_name() ?>
                            <a href="#" class="pull-right" style="font-size:12px;" data-id="<?=$sr->getId() ?>" data-toggle="modal" data-target="#editRefModal" ><span class="glyphicon glyphicon-pencil" ></span> Edit</a>
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
    include_once 'modules/profile/student/edit-about.php';
    include_once 'modules/profile/student/add-education.php';
    include_once 'modules/profile/student/add-achievments.php';
    include_once 'modules/profile/student/add-projects.php';
    include_once 'modules/profile/student/add-publications.php';
    include_once 'modules/profile/student/edit_tech.php';
    include_once 'modules/profile/student/add-exp.php';
    include_once 'modules/profile/student/edit_information.php';
    include_once 'modules/profile/student/add_prof_dev.php';
    include_once 'modules/profile/student/add_leadership.php';
    include_once 'modules/profile/student/add_ref.php';
?>
<?php 
include 'modules/jobs/company/create_job.php';
include 'includes/ajax-modal.php';
$modal_name='editProjModal';
include 'includes/sample_modal.php';
$modal_name='editAchievModal';
include 'includes/sample_modal.php';
$modal_name='editExpModal';
include 'includes/sample_modal.php';
$modal_name='editProfDevModal';
include 'includes/sample_modal.php';
$modal_name='editLExpModal';
include 'includes/sample_modal.php';
$modal_name='editRefModal';
include 'includes/sample_modal.php';
?>
<script>
    $('#ajaxModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit Education');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_edu_details.php?id='+id,
           type:'post',
           dataType:'html',
           success:function(html){               
               removeCKEditorInstance();     
               modal.find('.modal-body').html(html);
               createEditor();     
           }
        });
    });
    $('#editProjModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit Project');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_project_details.php?id='+id,
           type:'post',
           dataType:'html',
           success:function(html){               
               removeCKEditorInstance();     
               modal.find('.modal-body').html(html);
               createEditor();     
           }
        });
    });
    $('#editAchievModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit Achievements');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_achiev_details.php?id='+id,
           type:'post',
           dataType:'html',
           success:function(html){               
               removeCKEditorInstance();     
               modal.find('.modal-body').html(html);
               createEditor();     
           }
        });
    });
    $('#editExpModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit Achievements');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_exp_details.php?id='+id,
           type:'post',
           dataType:'html',
           success:function(html){               
               removeCKEditorInstance();     
               modal.find('.modal-body').html(html);
               createEditor();     
           }
        });
    });
    $('#editProfDevModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit Professional Developments');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_prof_dev_details.php?id='+id,
           type:'post',
           dataType:'html',
           success:function(html){               
               removeCKEditorInstance();     
               modal.find('.modal-body').html(html);
               createEditor();     
           }
        });
    });
    $('#editLExpModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit Leadership Experience');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_l_exp_details.php?id='+id,
           type:'post',
           dataType:'html',
           success:function(html){               
               removeCKEditorInstance();     
               modal.find('.modal-body').html(html);
               createEditor();     
           }
        });
    });
    $('#editRefModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit References');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_ref_details.php?id='+id,
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
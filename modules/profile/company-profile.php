<?php 
    require_once 'class/class.company_profile.php';
    require_once 'class/class.company_login.php';
    $cp = new company_profile();
    $cp->findOnProfile_id(USER_PROFILE);
?>
<section class="content-header" >    
    <h1 class="page-header text-info"><?=$cp->getCompany_name() ?>
        <a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#editCmpDetailsModal"  ><span class="glyphicon glyphicon-edit" ></span> Edit</a>
    </h1>
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
   
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-circle-arrow-right" ></span> About
            <button class="btn btn-primary btn-xs pull-right" id="edit_about" data-toggle="modal" data-target="#editAboutModal" ><span class="glyphicon glyphicon-edit" ></span> Edit</button>
        </div>
        <div class="panel-body" id="about-user-data" >
            <?=$cp->getAbout() ?>
        </div>
    </div>
     
    <div class="panel panel-default" >
        <div class="panel-heading clearfix" ><span class="glyphicon glyphicon-pushpin" ></span> Industry Sector
            <button class="btn btn-primary btn-xs pull-right" id="edit_mission" data-toggle="modal" data-target="#editMissionModal" ><span class="glyphicon glyphicon-edit" ></span> Edit</button>
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
            <button class="btn btn-primary btn-xs pull-right" id="edit_culture" data-toggle="modal" data-target="#editCultureModal" ><span class="glyphicon glyphicon-edit" ></span> Edit</button>
        </div>
        <div class="panel-body" id="about-user-data" >
            <?php 
                echo $cp->getCulture();
            ?>
        </div>
    </div>
     * 
     */ ?>
    
</section>
<?php 
include 'modules/profile/company/edit_about.php';
include 'modules/profile/company/edit_mission.php';
include 'modules/profile/company/edit_culture.php';
include 'modules/profile/company/edit_details.php';

?>
<script type="text/javascript">
    function addProgress(id){
        var str = '<div class="div-bar-'+id+'" >'
            +'<div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0%">'
            +'<span class="progress-text">0% Complete</span>'+'</div></div></div>';
        return str;
    }
    
    $(document).ready(function(){
        $('#drag-and-drop-zone').dmUploader({
            url: 'upload-banner.php',
            dataType: 'text',
            allowedTypes: 'image/*',
            onInit: function(){
            console.log('Plugin initialized correctly');
            },
            onNewFile: function(id, file){
                $('.cover').css("display","visible");
                $('.cover').html(addProgress(id));
            },
            onUploadProgress: function(id, percent){          
                $('.bar'+id).find('.progress-bar').css("width",percent+'%');
                $('.bar'+id).find('.progress-text').html(percent+'% Complete');
            },        
            onComplete: function(){
                $('.cover').hide();
            }
        });
    });
    
    
    
    
</script>
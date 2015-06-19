<?php 
session_start();
if(!isset($_SESSION['REG'])){
    header('lcoation:index.php');
}
    require_once 'config.php';
    require_once 'includes/header.php';
?>
<style>
    body {
        padding-top: 60px!important;
        background: url('img/1-bg.png');
    }
    .info-container {
        padding:20px;
        margin-top: 20px;
        border-top: 5px solid #2aabd2;
        background: #fbfbfb;
        -webkit-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.75);
        margin-bottom: 50px;
    }
</style>

    <?php 
    include_once 'includes/nav2.php';
    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="info-container" >
                    <?php
                        if($_SESSION['REG']['TYPE']==STUDENT){
                    ?>
                    <h1 class="page-heading" >Congratulation !!! <?=$_SESSION['REG']['NAME'] ?></h1> 
                    <h3 class="page-heading" >Your registration has been successful!  </h3>                    
                    <p>You can access your account.</p>
                    <p><a href="<?=APP_URL ?>">Click Here</a> to Login.</p>
                    <?php 
                        }
                    ?>
                    <?php
                        if($_SESSION['REG']['TYPE']==COMPANY){
                    ?>
                    <h1 class="page-heading" >Congratulation !!! <?=$_SESSION['REG']['NAME'] ?></h1> 
                    <h3 class="page-heading" >Your registration has been successful!  </h3>                    
                    <p>You can access your account.</p>
                    <p><a href="<?=APP_URL ?>/company.php">Click Here</a> to Login.</p>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php 
include_once 'includes/footer.php';
?>
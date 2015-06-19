<?php 
session_start();
if(isset($_SESSION['REG'])){
    unset($_SESSION['REG']);
}
if(isset($_SESSION['USER_AUTH'])){
    unset($_SESSION['USER_AUTH']);
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
                    <h3 class="page-heading" >Your have logout successfully.  </h3>                    
                    
                </div>
            </div>
        </div>
    </div>

<?php 
include_once 'includes/footer.php';
?>
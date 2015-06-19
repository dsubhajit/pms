<?php 
if(USER_TYPE !=COMPANY && USER_TYPE!=ADMIN){
?>

<?php 
}
if(USER_TYPE==ADMIN){
?>
<a href="#" data-toggle="modal" data-target="#editAdminDetailsModal" class="btn btn-primary" >Edit Details</a>
<?php
    
    require_once 'class/class.admin.php';
    $adm = new admin();
    $adm->findOnUser_id(USER_ID);
    echo "<h4 style='color:#fff;' >".$adm->getFullname()."</h4>";
    echo "<p style='color:#fff;font-size:12px;' >Phone: ".$adm->getPhone()."</p>";
    echo "<p style='color:#fff;font-size:12px;' >Email: ".$adm->getEmail()."</p>";
}
?>

<ul class="nav nav-sidebar">
    <li <?=(isset($_REQUEST['page_id']))?"":"class=\"active\"" ?>><a href="home.php">Dashboard</span></a></li>
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==1)?"class=\"active\"":"" ?>><a href="?page_id=1">Profile</a></li>
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==2)?"class=\"active\"":"" ?>><a href="?page_id=2">Jobs</a></li>
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==5)?"class=\"active\"":"" ?>><a href="?page_id=5">Notifications</a></li>
    <?php 
    
    if(USER_TYPE==COMPANY && FALSE){
    ?>
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==17)?"class=\"active\"":"" ?>><a href="?page_id=17">Job Offer</a></li>
    <?php 
    }
    if(USER_TYPE==ADMIN || USER_PRIV==TRUE){
    ?>
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==10)?"class=\"active\"":"" ?>><a href="?page_id=10">Students Approval</a></li>    
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==4)?"class=\"active\"":"" ?>><a href="?page_id=4">Configuration</a></li>
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==7)?"class=\"active\"":"" ?>><a href="?page_id=7">List of Companies</a></li>
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==9)?"class=\"active\"":"" ?>><a href="?page_id=9">List of Students</a></li>    
    <?php 
    }
    if((USER_TYPE==ADMIN || USER_TYPE==COMPANY) || USER_PRIV){
    ?>
    <li <?=(isset($_REQUEST['page_id']) && $_REQUEST['page_id']==16)?"class=\"active\"":"" ?>><a href="?page_id=16">Visit Schedule</a></li>
    <?php    
    }
    
    ?>
</ul>

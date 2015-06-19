<?php 
if(isset($_REQUEST['std_notif_id'])&& $_REQUEST['std_notif_id']!=NULL){
?>
<?php 
    require_once 'class/class.students_notif.php';
    $n = new students_notif();
    $n->findOnNotif_id(real_escape_string($_REQUEST['std_notif_id']));
    if($n->getNotif_id()!=NULL){
?>
<section class="content-header" >    
    <h1 class="page-header text-info"><?=$n->getNotif_title() ?></h1>    
    <p class="text-muted">Date: <?=$n->getNotif_date() ?> Severity: <?=getNotifSeverity($n->getSeverity()) ?></p>
</section>
<section class="content-element" >    
    <?=$n->getNotif_desc() ?>
</section>

<?php 
    }
   
} 
?>


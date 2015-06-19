<?php 
if(isset($_REQUEST['cmp_notif_id'])&& $_REQUEST['cmp_notif_id']!=NULL){
?>
<?php 
    require_once 'class/class.company_notif.php';
    $n = new company_notif();
    $n->findOnNotif_id(real_escape_string($_REQUEST['cmp_notif_id']));
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


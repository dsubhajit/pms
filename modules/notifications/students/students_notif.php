
<?php
require_once 'class/class.students_profile.php';
$std = new students_profile();
$std->findOnProfile_id(USER_PROFILE);
?>
<section class="content-header" >
    <h1 class="page-header text-info">Notifications</h1>    
</section>
<section class="content-element" >
    <div class="row" >
        
        <div class="col-md-12" >            
            <div class="panel panel-default" >
                <div class="panel-heading" >Notifications from placement officer & co-ordinator</div>
                <table class="table table-bordered table-hovered" >
                    <tr class="active" >
                        <td>Sl.No.</td>
                        <td>Notification Title</td>
                        <td>Date</td>
                        <td>Severity</td>
                        <td>Options</td>                        
                    </tr>
                    <?php 
                    require_once 'class/class.students_notif.php';
                    
                    $notif = students_notif::getAllStudents_notif(" (degree=0 or find_in_set('".$std->getDegree()."',degree) <> 0) and (department=0 or find_in_set('".$std->getDeparment()."',department) <> 0) and (branch=0 or find_in_set('".$std->getBranch()."',branch) <> 0) order by notif_id desc");
                    $i= count($notif);
                    foreach ($notif as $n){
                    ?>
                    <tr>
                        <td><?=$i-- ?></td>
                        <td><?=$n->getNotif_title() ?></td>
                        <td><?=$n->getNotif_date() ?></td>
                        <td><?=getNotifSeverity($n->getSeverity()) ?></td>
                        <td>
                            <a href="?page_id=8&std_notif_id=<?=$n->getNotif_id() ?>" class="btn btn-primary btn-xs" title="View Details"  ><span class="glyphicon glyphicon-check"></span></a>                    
                        </td>                        
                    </tr>
                    <?php 
                    }    
                    ?>
                    
                </table>
                
            </div>
        </div>
        
    </div>
    
    
    
</section>
<?php 
include 'modules/notifications/admin/create_notif.php';
include 'includes/ajax-modal.php';
?>
<script>
    $('#ajaxModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); 
        var id = button.data('id');
        var modal = $(this);
        modal.find('.modal-title').text('Edit Job');
        
        var recipient = button.data('id') ;
        $.ajax({
           url:'ajax-forms/edit_job_details.php?id='+id,
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
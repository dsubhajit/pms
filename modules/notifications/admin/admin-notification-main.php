
<section class="content-header" >
    <h1 class="page-header text-info">Notifications</h1>    
</section>
<section class="content-element" >
    <div class="row" >
        <div class="col-md-12" style="margin-bottom: 10px;" >
            <a href="#"  data-toggle="modal" data-target="#createStdNotifModal" class="btn btn-primary" ><span class="glyphicon glyphicon-plus" ></span> Create </a>
            
        </div>
        <div class="col-md-12" >            
            <div role="tabpanel">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist" >
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Students</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Company</a></li>
                    
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
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

                            $notif = students_notif::getAllStudents_notif(" 1 order by notif_id desc");
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
                    <div role="tabpanel" class="tab-pane" id="profile">
                        <table class="table table-bordered table-hovered" >
                            <tr class="active" >
                                <td>Sl.No.</td>
                                <td>Notification Title</td>
                                <td>Date</td>
                                <td>Severity</td>
                                <td>Options</td>                        
                            </tr>
                            <?php 
                            require_once 'class/class.company_notif.php';

                            $notif = company_notif::getAllCompany_notif(" 1 order by notif_id desc");
                            $i= count($notif);
                            foreach ($notif as $n){
                            ?>
                            <tr>
                                <td><?=$i-- ?></td>
                                <td><?=$n->getNotif_title() ?></td>
                                <td><?=$n->getNotif_date() ?></td>
                                <td><?=getNotifSeverity($n->getSeverity()) ?></td>
                                <td>
                                    <a href="?page_id=15&cmp_notif_id=<?=$n->getNotif_id() ?>" class="btn btn-primary btn-xs" title="View Details"  ><span class="glyphicon glyphicon-check"></span></a>                    
                                </td>                        
                            </tr>
                            <?php 
                            }    
                            ?>

                        </table>
                    </div>                    
                </div>

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
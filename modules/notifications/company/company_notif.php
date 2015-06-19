
<section class="content-header" >
    <h1 class="page-header text-info">Notifications</h1>    
</section>
<section class="content-element" >
    <div class="row" >
        <div class="col-md-12" style="margin-bottom: 10px;" >
            
            
        </div>
        <div class="col-md-12" >            
            
                
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
    
    
    
</section>

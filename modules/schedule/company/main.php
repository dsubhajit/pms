<script src="dist/vis.js"></script>
<link href="dist/vis.css" rel="stylesheet" type="text/css" />
<section class="content-header" >
    <h1 class="page-header text-info">Visit Schedule</h1>    
</section>
<section class="content-element" >
    <div class="col-md-12" >
        <h3>Slot Timeline
            <a href="#" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#addScheduleModal"  ><span class="glyphicon glyphicon-plus" ></span> Add</a>
        </h3>
        <div id="visualization"></div>
    </div>
    
    <div class="col-md-12"  style="margin-top: 10px;" >
        <h3>Your Schedule</h3>
        <table class="table table-bordered" >
            <tr class="active" >
                <td>#</td>
                <td>Start Date</td>
                <td>End Date</td>
                <td>Number of members</td>
                <td>Number of rooms</td>
                <td>Other Requirement</td>
                <td>Status</td>
                <td>
                    Options
                </td>
            </tr>
            <?php 
                require_once 'class/class.schedule_list.php';
                $s_list = schedule_list::getAllSchedule_list(' company_id='.USER_PROFILE);
                $i=1;
                foreach ($s_list as $s){
                ?>
            <tr>
                <td><?=$i++ ?></td>
                <td><?=$s->getStart_date() ?></td>
                <td><?=$s->getEnd_date() ?></td>
                <td><?=$s->getNum_of_mem() ?></td>
                <td><?=$s->getNum_of_rooms() ?></td>
                <td><?=$s->getReq() ?></td>
                <td><?=getStatus($s->getStatus()) ?></td>
                <td>
                    <a href="process.php?job_id=46&sch_id=<?=$s->getId() ?>" class="btn btn-danger btn-xs" >
                        <span class="glyphicon glyphicon-trash" ></span>
                    </a>
                </td>
            </tr>
                <?php
                }
            ?>
        </table>
    </div>
</section>
<?php 
    include 'modules/schedule/company/add_schedule.php';
?>
<script type="text/javascript">
// DOM element where the Timeline will be attached
var container = document.getElementById('visualization');

// Create a DataSet (allows two way data-binding)
var items = new vis.DataSet(
    <?php
    $s_list = schedule_list::getAllSchedule_list();
    $i=0;
    $data = array();
    foreach ($s_list as $s){
        $dataItem  = array();
        $dataItem['id']=$i++;
        $dataItem['content']='Booked';
        $dataItem['start']=$s->getStart_date();
        if($s->getEnd_date() != $s->getStart_date()){
            $dataItem['end'] = date('Y-m-d',  strtotime($s->getEnd_date().'+ 1 days'));
        }
        array_push($data, $dataItem);
    }    
    echo json_encode($data);
    ?>
);

// Configuration for the Timeline
var options = {
    max:'<?=PLACEMENT_END ?>',
    min:'<?=PLACEMENT_START ?>'
};



// Create a Timeline
var timeline = new vis.Timeline(container, items, options);
</script> 
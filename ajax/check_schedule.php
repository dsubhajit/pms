<?php
require_once "../config.php";
require_once "../includes/assign-access.php";
require_once '../lib/lib.utils.php';

require_once '../class/class.schedule_list.php';
if(strlen($_REQUEST['start']) > 0 && strlen($_REQUEST['end']) >0){
if(schedule_list::checkAvailability($_REQUEST['start'],$_REQUEST['end'])){
    echo '<span class="text-success" >Slot Avaialable</span>';
}
else {
    echo '<span class="text-danger" >Slot Not Avaialable</span>';
}
}
else  echo '<span class="text-danger" >Wrong dates!!</span>';
?>

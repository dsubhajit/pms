<!-- Modal -->
<?php 
require_once '../lib/lib.utils.php';
require_once '../class/class.achievements.php';
$a = new achievements();
$a->findOnAchiev_id($_REQUEST['id']);
?>

      
<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" value="<?=$a->getAchiev_title() ?>" name="title" placeholder="Enter Title">
</div>            

<div class="form-group">
    <label>Date</label>
    <input type="text" class="form-control" value="<?=$a->getAchiev_date() ?>" id="fromdate25" name="date" >
</div>

<div class="form-group">
    <label>Description</label>
    <textarea rows="10" class="form-control" name="desc" ><?=$a->getAchiev_description() ?></textarea>
</div> 

<input type="hidden" name="job" value="34" />
<input type="hidden" name="ach_id" value="<?=$a->getAchiev_id() ?>" />
<input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
    
<script>
    $('#fromdate25').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#todate').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
</script>
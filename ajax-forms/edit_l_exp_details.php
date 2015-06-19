<!-- Modal -->
<?php 
require_once '../lib/lib.utils.php';
require_once '../class/class.students_leadership.php';
$e = new students_leadership();
$e->findOnId($_REQUEST['id']);
?>


<div class="form-group">
    <label>Designation</label>
    <input type="text" class="form-control" name="desg" value="<?=$e->getDesignation() ?>" placeholder="Enter Designation">
</div> 
<div class="form-group">
    <label>Organization</label>
    <input type="text" class="form-control" value="<?=$e->getOrganization() ?>" name="org" placeholder="Enter Organization">
</div> 
<div class="row" >                
    <div class="col-sm-6" >
        <div class="form-group">
            <label>Start Date</label>
            <input type="text" class="form-control" value="<?=$e->getStart_date() ?>" id="fromdate51a" name="from_date" >
        </div>
    </div>
    <div class="col-sm-6" >
        <div class="form-group">
            <label>End Date</label>
            <input type="text" class="form-control" value="<?=$e->getEnd_date() ?>" id="fromdate61a" name="to_date" >
        </div>
    </div>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" rows="5" name="desc" ><?=$e->getDescription() ?></textarea>
</div> 
<input type="hidden" name="job" value="40" />
<input type="hidden" name="lexp_id" value="<?=$e->getId() ?>" />
<input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
<script>
    $('#fromdate51a').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#todate61a').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
</script>
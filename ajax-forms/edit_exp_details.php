<!-- Modal -->
<?php 
require_once '../lib/lib.utils.php';
require_once '../class/class.students_exp.php';
$e = new students_exp;
$e->findOnExp_id($_REQUEST['id']);
?>

<div class="form-group">
    <label>Type</label>
    <select name="type" class="form-control">
        <option value="Training" <?=($e->getExp_type() == "Training")?"selected":"" ?>>Training</option>
        <option value="Internship" <?=($e->getExp_type() == "Internship")?"selected":"" ?>>Internship</option>
    </select>
</div> 
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
            <input type="text" class="form-control" value="<?=$e->getStart_date() ?>" id="fromdate51" name="from_date" >
        </div>
    </div>
    <div class="col-sm-6" >
        <div class="form-group">
            <label>End Date</label>
            <input type="text" class="form-control" value="<?=$e->getEnd_date() ?>" id="fromdate61" name="to_date" >
        </div>
    </div>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" rows="5" name="desc" ><?=$e->getDescription() ?></textarea>
</div> 
<input type="hidden" name="job" value="36" />
<input type="hidden" name="exp_id" value="<?=$e->getExp_id() ?>" />
<input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
<script>
    $('#fromdate51').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#todate61').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
</script>
<!-- Modal -->
<?php 
require_once '../lib/lib.utils.php';
require_once '../class/class.students_prof_dev.php';
$p = new students_prof_dev();
$p->findOnId($_REQUEST['id']);
?>
<div class="form-group">
    <label>Type</label>
    <select name="type" class="form-control">
        <option value="Seminar" <?=($p->getDev_type() == "Seminar")?"selected":"" ?>>Seminar</option>
        <option value="Workshop" <?=($p->getDev_type() == "Workshop")?"selected":"" ?>>Workshop</option>
        <option value="Conference" <?=($p->getDev_type() == "Conference")?"selected":"" ?>>Conference</option>
    </select>
</div> 
<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" name="name" value="<?=$p->getDev_name() ?>" placeholder="Enter Name">
</div> 

<div class="row" >                
    <div class="col-sm-6" >
        <div class="form-group">
            <label>Start Date</label>
            <input type="text" class="form-control" value="<?=$p->getStart_date() ?>" id="fromdate9a" name="from_date" >
        </div>
    </div>
    <div class="col-sm-6" >
        <div class="form-group">
            <label>End Date</label>
            <input type="text" class="form-control" value="<?=$p->getEnd_date() ?>" id="fromdate10a" name="to_date" >
        </div>
    </div>
</div>

<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" name="desc" ><?=$p->getDescription() ?></textarea>
</div> 
<input type="hidden" name="job" value="38" />
<input type="hidden" name="prof_id" value="<?=$p->getId() ?>" />
<input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
    
<script>
    $('#fromdate9a').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#fromdate10a').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
</script>
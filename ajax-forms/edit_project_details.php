<!-- Modal -->
<?php 
require_once '../lib/lib.utils.php';
require_once '../class/class.students_projects.php';
$p = new students_projects();
$p->findOnPj_id($_REQUEST['id']);
?>

<div class="form-group">
    <label>Project Name</label>
    <input type="text" class="form-control" name="pj_name" value="<?=$p->getPj_name() ?>" placeholder="Enter Project Name">
</div>            
<div class="row" >                
    <div class="col-sm-6" >
        <div class="form-group">
            <label>From date</label>
            <input type="text" class="form-control" value="<?=$p->getPj_from() ?>" id="fromdate21" name="from_date" >
        </div>
    </div>
    <div class="col-sm-6" >
        <div class="form-group">
            <label>To Date</label>
            <input type="text" class="form-control" value="<?=$p->getPj_to() ?>" id="todate21" name="to_date" >
        </div>
    </div>
</div>
<div class="checkbox">
    <label>
        <input type="checkbox" name="pj_status" <?=($p->getPj_name()==1)?"checked":"" ?>>
        I am currently working on this.
    </label>
</div>
<div class="form-group">
    <label>Description</label>
    <textarea class="form-control" name="desc" >
    <?=$p->getPj_desc() ?>
    </textarea>
</div> 
<input type="hidden" name="job" value="32" />
<input type="hidden" name="p_id" value="<?=$p->getPj_id() ?>" />
<script>
    $('#fromdate21').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#todate21').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
</script>
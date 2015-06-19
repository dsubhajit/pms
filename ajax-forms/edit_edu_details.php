<!-- Modal -->
<?php 
require_once '../lib/lib.utils.php';
require_once '../class/class.students_edu.php';
$sed = new students_edu();
$sed->findOnEdu_id($_REQUEST['id']);
?>

      
            <div class="form-group">
                <label>Institute Name</label>
                <input type="text" class="form-control" name="inst_name"  value="<?=$sed->getEdu_inst_name() ?>" placeholder="Enter Institute Name">
            </div>
            
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Degree/Course</label>
                        <input type="text" class="form-control" value="<?=$sed->getEdu_degree() ?>" name="degree" placeholder="Degree/Course">
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Major</label>
                        <input type="text" class="form-control" name="major" value="<?=$sed->getEdu_major()?>" placeholder="Major">
                    </div>
                </div>
            </div>
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>From date</label>
                        <input type="text" class="form-control" value="<?=$sed->getEdu_date_form() ?>" id="fromdate" name="from_date" >
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>To Date</label>
                        <input type="text" class="form-control" value="<?=$sed->getEdu_date_to() ?>" id="todate" name="to_date" >
                    </div>
                </div>
            </div>
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Percentage</label>
                        <input type="text" class="form-control" value="<?=$sed->getEdu_percentage() ?>" name="percentage" placeholder="Enter percentage">
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>CGPA</label>
                        <input type="text" class="form-control" value="<?=$sed->getEdu_cgpa() ?>" name="cgpa" placeholder="Enter CGPA">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" >
                <?=$sed->getEdu_desc() ?>
                </textarea>
            </div> 

            <div class="form-group">
                <label>Skill</label>
                <input type="text" class="form-control" value="<?=$sed->getEdu_skill() ?>" name="skill" placeholder="Enter skills">
            </div>
          
          <input type="hidden" name="job" value="31" />
          <input type="hidden" name="edu_id" value="<?=$sed->getEdu_id() ?>" />
    
<script>
    $('#fromdate').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#todate').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
</script>
<?php 
require_once 'class/class.students_profile.php';
$std = new students_profile();
$std->findOnProfile_id(USER_PROFILE);

?>
<div class="modal fade" id="editInfoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-info-sign"></span> Edit Information</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="row" >
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="<?=$std->getName() ?>" name="std_name" placeholder="Enter name">
                    </div>                    
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" class="form-control" value="<?=$std->getPhone() ?>" name="std_phone" placeholder="Enter phone">
                    </div>
                    
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <div class='input-group date' id='dob'>
                            <input type='text' class="form-control"  value="<?=$std->getDob() ?>" name="std_dob" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Languages </label>
                        <input type="text" class="form-control" value="<?=$std->getLanguages()?>" name="std_lang" placeholder="Enter languages known">
                    </div>
                    <div class="form-group">
                        <label>Professional Interest</label>
                        <textarea class="form-control" rows="2" name="std_pi" placeholder="Professional Interest"><?=trim($std->getProf_interest()) ?></textarea>
                    </div>
                </div>
                <div class="col-md-6" >                                
                    <div class="form-group">
                        <label>Current Address</label>
                        <textarea class="form-control" rows="5"  name="std_add1" placeholder="Address1 "><?=trim($std->getAdd1()) ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Permanent Address</label>
                        <textarea class="form-control" rows="5" name="std_add2" placeholder="Address2"><?=  trim($std->getAdd2()) ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Hobbies</label>
                        <textarea class="form-control" rows="2" name="std_hobbies" placeholder="Hobbies"><?=trim($std->getHobbies()) ?></textarea>
                    </div>
                    

                                                   
                </div>
            </div>
          <input type="hidden" name="job" value="20" />
          <input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script>
    $('#dob').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    
</script>
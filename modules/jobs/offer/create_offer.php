<!-- Modal -->
<?php 
require_once 'class/class.job_application.php';
require_once 'class/class.students_profile.php';
$joba = job_application::getAllJob_application(' company_profile_id='.USER_PROFILE.' and application_status=1 and job_id='.real_escape_string($_REQUEST['job_id']));
?>
<div class="modal fade" id="createOfferModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-star"></span> Create Offer</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">           
            <div class="form-group">
                <label>Select Students</label>
                <select style="height: 200px" class="form-control" multiple="multiple" name="std_id[]"  >
                    <?php
                    foreach($joba as $ja){
                        $std = new students_profile();
                        $std->findOnProfile_id($ja->getStudent_profile_id());
                    ?>
                    <option value="<?=$std->getProfile_id() ?>" ><?=$std->getEnroll_no() ?> | <?=$std->getName() ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div> 
            <div class="form-group">
                <label>Text</label>
                <textarea rows="10" class="form-control"  name="off_text" >
                
                </textarea>
            </div> 
            
          
          <input type="hidden" name="job" value="48" />
          <input type="hidden" name="job_id" value="<?=real_escape_string($_REQUEST['job_id']) ?>" />
          <input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </div>
      </form>
    </div>
  </div>
</div>

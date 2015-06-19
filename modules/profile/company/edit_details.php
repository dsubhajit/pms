<!-- Modal -->
<?php 
    $cp = new company_profile();
    $cp->findOnProfile_id(USER_PROFILE);
?>
<div class="modal fade" id="editCmpDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Information</h4>
      </div>
      <form method="post" action="process.php" >
      <div class="modal-body">          
        <div class="row" >
            <div class="col-md-6" >
                <div class="form-group">
                    <label>Your Full Name</label>
                    <input type="text" class="form-control" name="c_name" value="<?=$cp->getCp_name() ?>">
                </div>
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" class="form-control" name="cmp_name" value="<?=$cp->getCompany_name() ?>">
                </div>
                <div class="form-group">
                    <label>Website</label>
                    <input type="text" class="form-control" name="cmp_website" value="<?=$cp->getCompany_website() ?>">
                </div>        
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" class="form-control" name="cmp_phone" value="<?=$cp->getCp_phone() ?>">
                </div>
                <div class="form-group">
                    <label>Your Designation</label>
                    <input type="text" class="form-control" name="cmp_desg" value="<?=$cp->getCp_desg() ?>">
                </div>
            </div>
            <div class="col-md-6" >      
                <div class="form-group">
                    <label>Type of Company</label>
                    <?php
                        $type= explode(',',$cp->getCmp_type());
                    ?>
                    <select class="form-control" name="cmp_type[]" multiple>                        
                        <option value="Public" <?=(in_array("Public", $type))?"selected":"" ?>>Public</option>
                        <option value="Private" <?=(in_array("Private", $type))?"selected":"" ?>>Private</option>
                        <option value="Start Up" <?=(in_array("Start Up", $type))?"selected":"" ?>>Start Up</option>
                        <option value="PSU" <?=(in_array("PSU", $type))?"selected":"" ?>>PSU</option>
                        <option value="MNC (India Based)" <?=(in_array("MNC (India Based)", $type))?"selected":"" ?>>MNC (India Based)</option>
                        <option value="MNC (Foreign Based)" <?=(in_array("MNC (Foreign Based)", $type))?"selected":"" ?>>MNC (Foreign Based)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Company Address</label>
                    <textarea class="form-control" name="cmp_add" ><?=$cp->getPost_add() ?></textarea>
                </div>
                <input type="hidden" name="job" value="44" />
                <inpu type="hidden" name="redirectUrl" value="<?=  curPageURL() ?>" />
            </div>    
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
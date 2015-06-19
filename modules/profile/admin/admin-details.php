<?php 
    require_once 'class/class.admin.php';
    $adm = new admin();
    $adm->findOnUser_id(USER_ID);
?>
<div class="modal fade" id="editAdminDetailsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Details</h4>
      </div>
      <form method="post" action="process.php" >
      <div class="modal-body">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control"  value="<?=$adm->getFullname() ?>" name="adm_name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" value="<?=$adm->getEmail() ?>" name="adm_email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" value="<?=$adm->getPhone() ?>" name="adm_phone" placeholder="Enter phone">
        </div>
      </div>
      <input type="hidden" name="job" value="14" />
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
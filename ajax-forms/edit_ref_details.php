<!-- Modal -->
<?php 
require_once '../lib/lib.utils.php';
require_once '../class/class.students_ref.php';
$ref = new students_ref();
$ref->findOnId($_REQUEST['id']);
?>

<div class="form-group">
    <label>Name</label>
    <input type="text" class="form-control" value="<?=$ref->getRef_name() ?>" name="name" placeholder="Enter Name" />
</div> 
<div class="form-group">
    <label>Designation</label>
    <input type="text" class="form-control"value="<?=$ref->getDesignation() ?>"  name="desg" placeholder="Enter Designation">
</div> 
<div class="form-group">
    <label>Organization</label>
    <input type="text" class="form-control" value="<?=$ref->getOrganization() ?>" name="org" placeholder="Enter Organization">
</div> 
<div class="form-group">
    <label>Phone</label>
    <input type="text" class="form-control" value="<?=$ref->getPhone() ?>" name="phone" placeholder="Enter Phone No.">
</div> 
<div class="form-group">
    <label>Email</label>
    <input type="text" class="form-control" value="<?=$ref->getEmail() ?>" name="email" placeholder="Enter EmailId">
</div>
<input type="hidden" name="job" value="42" />
<input type="hidden" name="ref_id" value="<?=$ref->getId() ?>" />
<input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
    
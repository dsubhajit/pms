<!-- Modal -->
<div class="modal fade" id="editAboutModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Objective</h4>
      </div>
      <form method="post" action="process.php" >
      <div class="modal-body">
          <textarea class="form-control" rows="5" name="about" ><?=$stud->getAbout() ?></textarea>
          <input type="hidden" name="job" value="1" />
          <input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editCultureModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Culture</h4>
      </div>
      <form method="post" action="process.php" >
      <div class="modal-body">
          <textarea class="form-control" rows="5" cols="60" name="culture" ><?=$cp->getCulture() ?></textarea>
          <input type="hidden" name="job" value="8" />
          <input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
          <?php 
            $target_textarea = "culture";
            include 'includes/ckeditor.php';
            
          ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editTechModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-pushpin"></span> Edit Technical Skills</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="form-group">
                <label>Languages</label>
                <textarea class="form-control" rows="5" name="langs" ><?=$t->getTech_langs() ?></textarea>
            </div>            
            
            <div class="form-group">
                <label>Frameworks</label>
                <textarea class="form-control" name="fworks" ><?=$t->getTech_frameworks() ?></textarea>
            </div> 

            <div class="form-group">
                <label>Tools</label>
                <textarea class="form-control" rows="5" name="tools" ><?=$t->getTech_tools() ?></textarea>
            </div>
            <?php 
                if($t->getTech_id() != NULL){
            ?>
            <input type="hidden" name="tech_id" value="<?=$t->getTech_id() ?>" />
            <?php 
                }
            ?>
            <input type="hidden" name="job" value="5" />
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

<!-- Modal -->
<div class="modal fade" id="addPubModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-book"></span> Add Publication</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="form-group">
                <label>Publication Title</label>
                <input type="text" class="form-control" name="p_title" placeholder="Enter Publication Title">
            </div> 
            <div class="form-group">
                <label>Publisher Name</label>
                <input type="text" class="form-control" name="p_name" placeholder="Enter Publisher Name">
            </div> 
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control" id="fromdate3" name="from_date" >
                    </div>
                </div>
                <div class="col-sm-6" >
                    
                </div>
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" ></textarea>
            </div> 

            <div class="form-group">
                <label>Skill</label>
                <input type="text" class="form-control" name="skill" placeholder="Enter skills">
            </div>
          
          <input type="hidden" name="job" value="4" />
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
    $('#fromdate3').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    
</script>
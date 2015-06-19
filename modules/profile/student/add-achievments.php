<!-- Modal -->
<div class="modal fade" id="addAchievModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-star"></span> Add Achievements</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title">
            </div>            
            
            <div class="form-group">
                <label>Date</label>
                <input type="text" class="form-control" id="fromdate2" name="date" >
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" ></textarea>
            </div> 
            
          <input type="hidden" name="job" value="33" />
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
    $('#fromdate2').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#todate2').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
</script>
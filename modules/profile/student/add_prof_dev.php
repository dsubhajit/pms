<!-- Modal -->
<div class="modal fade" id="addProfDevModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-book"></span> Add Professional Development</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control">
                    <option value="Seminar">Seminar</option>
                    <option value="Workshop" >Workshop</option>
                    <option value="Conference">Conference</option>
                </select>
            </div> 
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name">
            </div> 
            
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="text" class="form-control" id="fromdate9" name="from_date" >
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="text" class="form-control" id="fromdate10" name="to_date" >
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" ></textarea>
            </div> 

            
          
          <input type="hidden" name="job" value="37" />
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
    $('#fromdate9').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#fromdate10').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    
</script>
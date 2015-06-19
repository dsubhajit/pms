<!-- Modal -->
<div class="modal fade" id="addExpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-star"></span> Add Experience</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="form-group">
                <label>Type</label>
                <select name="type" class="form-control">
                    <option value="Training">Training</option>
                    <option value="Internship" >Internship</option>
                </select>
            </div> 
            <div class="form-group">
                <label>Designation</label>
                <input type="text" class="form-control" name="desg" placeholder="Enter Designation">
            </div> 
            <div class="form-group">
                <label>Organization</label>
                <input type="text" class="form-control" name="org" placeholder="Enter Organization">
            </div> 
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="text" class="form-control" id="fromdate5" name="from_date" >
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="text" class="form-control" id="fromdate6" name="to_date" >
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" ></textarea>
            </div> 

            
          
          <input type="hidden" name="job" value="35" />
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
    $('#fromdate5').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#fromdate6').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    
</script>
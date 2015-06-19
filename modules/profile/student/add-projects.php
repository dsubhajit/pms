<!-- Modal -->
<div class="modal fade" id="addProjectsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-briefcase"></span> Add Projects</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="form-group">
                <label>Project Name</label>
                <input type="text" class="form-control" name="pj_name" placeholder="Enter Project Name">
            </div>            
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>From date</label>
                        <input type="text" class="form-control" id="fromdate2" name="from_date" >
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>To Date</label>
                        <input type="text" class="form-control" id="todate2" name="to_date" >
                    </div>
                </div>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="pj_status" value="">
                    I am currently working on this.
                </label>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" ></textarea>
            </div> 
            <?php /*
            <div class="form-group">
                <label>Skill</label>
                <input type="text" class="form-control" name="skill" placeholder="Enter skills">
            </div>
          */?>
          <input type="hidden" name="job" value="3" />
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
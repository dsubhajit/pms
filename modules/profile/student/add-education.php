<!-- Modal -->
<div class="modal fade" id="addEducationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Education</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="form-group">
                <label>Institute Name</label>
                <input type="text" class="form-control" name="inst_name" placeholder="Enter Institute Name">
            </div>
            
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Degree/Course</label>
                        <input type="text" class="form-control" name="degree" placeholder="Degree/Course">
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Major</label>
                        <input type="text" class="form-control" name="major" placeholder="Major">
                    </div>
                </div>
            </div>
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>From date</label>
                        <input type="text" class="form-control" id="fromdate" name="from_date" >
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>To Date</label>
                        <input type="text" class="form-control" id="todate" name="to_date" >
                    </div>
                </div>
            </div>
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Percentage</label>
                        <input type="text" class="form-control" name="percentage" placeholder="Enter percentage">
                    </div>
                </div>
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>CGPA</label>
                        <input type="text" class="form-control" name="cgpa" placeholder="Enter CGPA">
                    </div>
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
          
          <input type="hidden" name="job" value="2" />
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
    $('#fromdate').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#todate').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
</script>
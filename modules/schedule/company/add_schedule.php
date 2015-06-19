<!-- Modal -->
<div class="modal fade" id="addScheduleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-star"></span> Add Slot Schedule</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">           
            <div class="form-group">
                <label>Number of members required</label>
                <input type="text" class="form-control" name="mem" placeholder="">
            </div> 
            <div class="form-group">
                <label>Numbers of rooms required</label>
                <input type="text" class="form-control" name="room" placeholder="">
            </div> 
            <div class="form-group">
                <label>Other Requirements</label>
                <input type="text" class="form-control" name="req" placeholder="">
            </div> 
            
            <div class="row" >                
                <div class="col-sm-4" >
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="text" class="form-control" id="fromdate5" name="start" >
                    </div>
                </div>
                <div class="col-sm-4" >
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="text" class="form-control" id="fromdate6" name="end" >
                    </div>
                </div>
                <div class="col-sm-4" >
                    <div class="form-group">
                        <label></label>
                        <button onclick="CheckSlot()" class="form-control btn btn-primary btn-xs" type="button" >Check Availability</button>
                    </div>
                    
                </div>
                <p class="check" ></p>
            </div>
          
          <input type="hidden" name="job" value="45" />
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
    
    function CheckSlot(){    
        $.ajax({
            url:'ajax/check_schedule.php?start='+$('#fromdate5').val()+'&end='+$('#fromdate6').val(),
            type:'get',
            dataType:'text',
            success:function(data){
                $('.check').html(data);
            }
        });
    }
    
</script>
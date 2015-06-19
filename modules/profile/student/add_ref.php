<!-- Modal -->
<div class="modal fade" id="addRefModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> Add References</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" />
            </div> 
            <div class="form-group">
                <label>Designation</label>
                <input type="text" class="form-control" name="desg" placeholder="Enter Designation">
            </div> 
            <div class="form-group">
                <label>Organization</label>
                <input type="text" class="form-control" name="org" placeholder="Enter Organization">
            </div> 
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Enter Phone No.">
            </div> 
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter EmailId">
            </div> 
            
            
           
            
          
          <input type="hidden" name="job" value="41" />
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

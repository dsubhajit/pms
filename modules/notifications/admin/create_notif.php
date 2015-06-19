<!-- Modal -->
<div class="modal fade" id="createStdNotifModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-bell"></span> Create Notifications</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="notif_title" placeholder="Enter title">
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>To</label>
                        <select name="notif_type" onchange="checkFields(this)" class="form-control" >
                            <option value="<?=STUDENT ?>" >Students</option>
                            <option value="<?=COMPANY ?>" >Company</option>                            
                        </select>
                    </div>
                </div> 
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Severity</label>
                        <select name="notif_severity" class="form-control" >
                            <option value="1" >Major</option>
                            <option value="2" >Minor</option>
                            <option value="3" >Ordinary</option>
                            <option value="4" >Urgent</option>
                        </select>
                    </div>
                </div>  
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Degree</label>
                        <select name="degree[]" class="form-control" id="degree"  multiple="multiple">
                            <option value="0" >All</option>
                            <?php 
                                require_once "class/class.degree.php";
                                $dg = degree::getAllDegree();
                                foreach ($dg as $d){
                            ?>
                            <option value="<?=$d->getDegree_id() ?>" <?=(isset($_REQUEST['degree']) && $_REQUEST['degree']==$d->getDegree_id())?"selected":"" ?>><?=$d->getDegree_name() ?></option>    
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group" >
                        <?php 
                        require_once "class/class.department.php";
                        $d = department::getAllDepartment();
                        ?>
                        <label>Department</label>
                        <select name="dep[]" class="form-control" id="dep"  multiple="multiple">
                            <option value="0" >All</option>
                            <?php
                            foreach ($d as $dp){
                            ?>
                            <option value="<?=$dp->getDep_id() ?>" <?=(isset($_REQUEST['dep']) && $_REQUEST['dep']==$dp->getDep_id())?"selected":"" ?>><?=$dp->getDep_name() ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Branch</label>
                        <select name="branch[]" class="form-control" id="branch"  multiple="multiple">
                            <option value="0" >All</option>
                            <?php                                    
                                require_once 'class/class.branch.php';
                                require_once 'class/class.department.php';
                                $d = department::getAllDepartment();
                                foreach ($d as $dp){
                            ?>
                            <optgroup label="<?=$dp->getDep_name() ?>" >
                            <?php
                                    $bran = branch::getAllBranch(' dep_id='.$dp->getDep_id());
                                    foreach ($bran as $b){
                            ?>
                                <option value="<?=$b->getBranch_id() ?>" <?=(isset($_REQUEST['branch']) && $_REQUEST['branch']==$b->getBranch_id())?"selected":"" ?>><?=$b->getBranch_name() ?></option>
                            <?php            
                                    }
                            ?>
                            </optgroup>    
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>            
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" ></textarea>
                <?php $target_textarea = "desc"; include 'includes/ckeditor.php'; ?>
            </div> 
            <input type="hidden" name="job" value="19" />
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
<!-- Modal -->
<div class="modal fade" id="createStdNotifModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-bell"></span> Create Notification for Students</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="row" >                
                <div class="col-sm-6" >
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="notif_title" placeholder="Enter title">
                    </div>
                </div>
                <div class="col-md-6" >
                    <div class="form-group">
                        <label>Severity</label>
                        <select name="notif_severity" class="form-control" >
                            <option value="1" >Major</option>
                            <option value="2" >Minor</option>
                            <option value="3" >Ordinary</option>
                            <option value="4" >Urgent</option>
                        </select>
                    </div>
                </div>                
            </div>            
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name="desc" ></textarea>
                <?php $target_textarea = "desc"; include 'includes/ckeditor.php'; ?>
            </div> 
            <input type="hidden" name="job" value="19" />
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#degree').multiselect({
            
            enableFiltering: true
        });
        $('#dep').multiselect({
           
            enableFiltering: true
        });
        $('#branch').multiselect({           
            enableFiltering: true
        });
        $('.btn-group').each(function(){
            $(this).addClass('form-control');
        });
    });
</script>
<script>
function checkFields(obj){
    
    if(obj.value == <?=COMPANY ?>) {
        $('#degree').multiselect('disable');
        $('#dep').multiselect('disable');
         
        $('#branch').multiselect('disable');
    }
    else {
        $('#degree').multiselect('enable');
        $('#dep').multiselect('enable');
         
        $('#branch').multiselect('enable');
    }
}
</script>
<style>
    .btn-group {
        border:none!important;
        padding:0px!important;
    }
</style>
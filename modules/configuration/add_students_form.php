<div class="modal fade" id="add_students" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Students</h4>
      </div>
      <div class="modal-body">
          <div role="tabpanel">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Single Student</a></li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Multiple Students</a></li>                
            </ul>
            <?php 
                require_once "class/class.department.php";
                $d = department::getAllDepartment();
            ?>    
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <form action="register-students.php" method="post"  style="margin-top: 20px;" id="std-reg"  >
                        <div class="row" >
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label>Enrolment No.</label>
                                    <input type="text" class="form-control" name="std_enr_no" placeholder="Enter enrolment number">
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="std_name" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="std_email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="std_pass" placeholder="Enter password">
                                </div>
                                <div class="form-group">
                                    <label>Re-type Password</label>
                                    <input type="password" class="form-control" name="std_r_pass" placeholder="Retype password">
                                </div>                                 
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="std_phone" placeholder="Enter phone">
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Year of Enrolment</label>
                                        <select name="std_yr_enr" class="form-control"  >
                                            <?php 
                                                for($i=2000;$i<=2050;$i++){
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label>Year of Passing</label>
                                        <select name="std_yr_pass" class="form-control" >
                                            <?php 
                                                for($i=2000;$i<=2050;$i++){
                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label>Department</label>
                                    <select name="std_dep" class="form-control" >
                                        <option value="-1" >------Select------</option>
                                        <?php
                                        foreach ($d as $dp){
                                            echo '<option value="'.$dp->getDep_id().'" >'.$dp->getDep_name().'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <label>Degree</label>
                                    <select class="form-control" name="std_degree"  >
                                        <?php 
                                            require_once 'class/class.degree.php';
                                            $deg = degree::getAllDegree();
                                            foreach ($deg as $d){
                                                echo '<option value="'.$d->getDegree_id().'">'.$d->getDegree_name().'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Branch</label>
                                    <select class="form-control" name="std_branch"  >
                                        <?php                                    
                                            require_once 'class/class.branch.php';
                                            $d = department::getAllDepartment();
                                            foreach ($d as $dp){
                                        ?>
                                        <optgroup label="<?=$dp->getDep_name() ?>" >
                                        <?php
                                                $bran = branch::getAllBranch(' dep_id='.$dp->getDep_id());
                                                foreach ($bran as $b){
                                                    echo '<option value="'.$b->getBranch_id().'" >'.$b->getBranch_name().'</option>';
                                                }
                                        ?>
                                        </optgroup>    
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>CGPA</label>                                    
                                    <input type='text' class="form-control" name="std_cgpa" />
                                </div>
                            </div>                            
                            <div class="col-sm-12" >   
                                <span id="msg" class="pull-left" ></span>
                                <button type="button" class="btn btn-primary pull-right" id="reg-btn" >Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <form style="margin-top: 10px;" id="bulk_add" method="post" action="bulk_stud_reg.php" enctype="multipart/form-data" >
                        <div class="row" >
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label>Select Student Data <i><b>xls</b></i> file </label>
                                    <input type="file" class="form-control" name="data_file" placeholder="Enter name">
                                    <p>*<small>The data file must have in format given in example doc.</small></p>
                                    <a href="data-file-example.xls" target="_blank" >Sample</a>
                                </div>
                            </div>
                            <div class="col-md-12" >
                                <span id="blk_msg" ></span>
                                <button type="button" id="bulk_add_btn" name="" class="btn btn-primary pull-right" >Save</button>
                            </div>
                        </div>
                    </form>
                    <div class="row" style="margin-top: 10px;" >
                        <div class="col-md-12"  >
                            <table class="table table-bordered  table-hovered" id="status_table" >

                            </table>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
      </div>      
    </div>
  </div>
</div>
<script type="text/javascript">
    
    $(document).ready(function() {   
            
            $('#reg-btn').on('click', function(){                                
                $("#reg-btn").html('<span class="glyphicon glyphicon-refresh spinning"></span> Please Wait ... ');
		$("#std-reg").ajaxForm({                    
                    dataType:'json',
                    success:function(d){
                        var data = d;
                        console.log(data.status);
                        
                        if(!data.status){
                            $("#msg").html('<span class="text-danger" >'+data.text+'</span>');
                            $("#reg-btn").html('Register');
                        }
                        else{
                            $("#reg-btn").addClass('btn-success');                            
                            $("#reg-btn").html('<span class="glyphicon glyphicon-ok "></span> Registration Successful.');
                            setTimeout(function(){
                                $('#std-reg')[0].reset();
                                $("#reg-btn").removeClass('btn-success'); 
                                $("#reg-btn").addClass('btn-primary');                            
                                $("#reg-btn").html('Save');
                            },3000);                            
                        }
                    }
		}).submit();		
            });
            $('#bulk_add_btn').on('click', function(){ 
                $("#status_table").html('');
                $("#bulk_add_btn").html('<span class="glyphicon glyphicon-refresh spinning"></span> Please Wait ... ');
		$("#bulk_add").ajaxForm({                    
                    dataType:'json',
                    success:function(d){
                        var data = d;
                        console.log(data.status);
                        
                        if(data.status) {
                            $("#status_table").html('<tr class="active" ><td>Enrolment No.</td><td>Status</td><td>Comments</td></tr>');
                            var scc_counter = 0;
                            data = data.data;
                            for(var i=0;i<data.length;i++){
                                if(data[i].status == 'Success') scc_counter++;
                                $("#status_table").append('<tr'+((data[i].status == 'Failed')?' class="danger"':'')+'><td>'+data[i].enrl_no+'</td><td>'+data[i].status+'</td><td>'+data[i].text+'</td></tr>');
                            }                            
                            
                            $('#blk_msg').html('Out of '+data.length+' records '+scc_counter+' records added successfully.');
                            $("#bulk_add_btn").addClass('btn-success');                            
                            $("#bulk_add_btn").html('<span class="glyphicon glyphicon-ok "></span> Done.');
                            setTimeout(function(){
                                $('#bulk_add')[0].reset();
                                $("#bulk_add_btn").removeClass('btn-success'); 
                                $("#bulk_add_btn").addClass('btn-primary');                            
                                $("#bulk_add_btn").html('Save');
                            },3000);
                        }
                        else {
                            $('#blk_msg').html(data.text);
                            $('#bulk_add')[0].reset();
                            $("#bulk_add_btn").addClass('btn-primary');                            
                            $("#bulk_add_btn").html('Save');
                        }
                        
                        
                    }
		}).submit();		
            });
        }); 
</script>
<?php 
    require_once 'config.php';
    require_once 'includes/header.php';
?>
<style>
    body {
        padding-top: 60px!important;
        background: url('img/1-bg.png');
    }
    .login-container {
        padding:20px;
        margin-top: 20px;
        border-top: 5px solid #2aabd2;
        background: #fbfbfb;
        -webkit-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.75);
        -moz-box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.75);
        box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.75);
        margin-bottom: 50px;
    }
</style>

    <?php 
    include_once 'includes/nav2.php';
    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login-container" >
                    <h1 class="page-heading" >Students Registration</h1>
                    <form action="register-students.php" method="post" id="std-reg"  >
                        <div class="row" >
                            <div class="col-md-6" >
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
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <div class='input-group date' id='dob'>
                                        <input type='text' class="form-control" name="std_dob" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6" >                                
                                <div class="form-group">
                                    <label>Address 1</label>
                                    <textarea class="form-control" rows="2" name="std_add1" placeholder="Address1 "></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <textarea class="form-control" rows="2" name="std_add2" placeholder="Address2"></textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" class="form-control" name="std_city" placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <label>Pin Code</label>
                                    <input type="text" class="form-control" name="std_pin" placeholder="Enter pin code">
                                </div>
                                <div class="form-group">
                                    <label>State</label>
                                    <input type="text" class="form-control" name="std_state" placeholder="Enter state">
                                </div>  
                                <div class="form-group">
                                    <label>Country</label>
                                    <input type="text" class="form-control" name="std_country" placeholder="Enter country">
                                </div>                                
                            </div>
                            <div class="col-sm-12" >   
                                <span id="msg" class="pull-left" ></span>
                                <button type="button" class="btn btn-primary pull-right" id="reg-btn" >Register</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    
    $(document).ready(function() {   
            $('#dob').datetimepicker({                
                format: 'YYYY-MM-DD'
            });
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
                            $("#msg").html('<span class="text-success" >Please wait while we redirect you.</span>');
                            $("#reg-btn").html('<span class="glyphicon glyphicon-ok "></span> Registration Successful.');
                            setTimeout(function(){
                                window.location.replace(data.url);
                            },3000);                            
                        }
                    }
		}).submit();		
            });
        }); 
</script>
<?php 
include_once 'includes/footer.php';
?>
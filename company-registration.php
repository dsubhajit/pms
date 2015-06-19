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
    $req=2;
    include_once 'includes/nav2.php';
    ?>


    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-container" >
                    <h1 class="page-heading" >Company Registration</h1>
                    <form action="register-companies.php" method="post" id="cmp-reg"  >
                        <div class="row" >
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label>Your Full Name</label>
                                    <input type="text" class="form-control" name="c_name" placeholder="Enter Company name">
                                </div>
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control" name="cmp_name" placeholder="Enter Company name">
                                </div>
                                <div class="form-group">
                                    <label>Website</label>
                                    <input type="url" class="form-control" name="cmp_website" placeholder="Enter Company Website Url">
                                </div>
                                <div class="form-group">
                                    <label>Email ID</label>
                                    <input type="email" class="form-control" name="cmp_email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="cmp_pass" placeholder="Enter password">
                                </div>
                                <div class="form-group">
                                    <label>Re-type Password</label>
                                    <input type="password" class="form-control" name="cmp_r_pass" placeholder="Retype password">
                                </div> 
                                
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="text" class="form-control" name="cmp_phone" placeholder="Enter phone">
                                </div>
                                <div class="form-group">
                                    <label>Your Designation</label>
                                    <input type="text" class="form-control" name="cmp_desg" placeholder="Enter your designation">
                                </div>
                                
                                <div class="form-group" >
                                    <button class="btn btn-primary pull-right" id="reg-btn" >Register</button>
                                </div>
                            </div>    
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    
    $(document).ready(function() {               
        $('#reg-btn').on('click', function(){                                
            $("#reg-btn").html('<span class="glyphicon glyphicon-refresh spinning"></span> Please Wait ... ');
            $("#cmp-reg").ajaxForm({                    
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
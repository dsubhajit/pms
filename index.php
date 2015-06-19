<?php 
    require_once 'config.php';
    require_once 'includes/header.php';
?>
<style>
    body {
        padding-top: 0px!important;
        background: url(img/home_image.jpg);
    }
    .login-container {
        padding:50px;
        margin-top: 20px;
        background: #fff;
    }
</style>

    <?php 
    include_once 'includes/nav2.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-container" >
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="login.php" method="post" id="students-login" autocomplete="off">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Enrolment No." name="username" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                        </label>
                                    </div>
                                    <span id="msg" ></span>
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="button" class="btn btn-lg btn-success btn-block" id="login-btn" >Login</button>                                    
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function() {            
            $('#login-btn').on('click', function(){                                
                $("#login-btn").html('<span class="glyphicon glyphicon-refresh spinning"></span> Please Wait ... ');
		$("#students-login").ajaxForm({                    
                    dataType:'json',
                    success:function(d){
                        var data = d;
                        console.log(data.status);
                        if(data.status == "Failed"){
                            $("#msg").html('<span class="text-danger" >'+data.error+'</span>')
                            $("#login-btn").html('Login');
                        }
                        if(data.status == "Success"){
                            $("#login-btn").html('<span class="glyphicon glyphicon-ok "></span> Login Success');
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
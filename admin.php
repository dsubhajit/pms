<?php 
    require_once 'config.php';
    require_once 'includes/header.php';
?>
<style>
    body {
        margin-top: 80px!important;
        background: url(img/1-bg.png);
    }
    .login-container {
        padding:20px 30px;
        margin-top: 0px;
        background: #fff;
    }
</style>

    <?php 
    $req=3;
    include_once 'includes/nav2.php';
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="login-container" >
                    <h3>Administrator</h3>
                    <div class="login-panel panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Please Sign In</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row" >
                                <div class="col-md-4" >
                                    <img src="img/login_icon.jpg" width="100%"  />
                                </div>
                                <div class="col-md-8" >
                                    <form role="form" action="admin_login.php" method="post" id="students-login" >
                                        <fieldset>
                                            <div class="form-group">
                                                <input class="form-control" placeholder="E-mail" name="username" type="email" autofocus>
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
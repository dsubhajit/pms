<section class="content-header" >
    <h1 class="page-header text-info">Change Password</h1>
    
</section>
<section class="content-element" >
    <div class="row" >
        <div class="col-md-6" >
            <form role="form" action="process.php" method="post" >
                <fieldset>
                    <div class="form-group">
                        <label>Old Password</label>
                        <input class="form-control" placeholder="Old Password" name="o_pass" type="password" autofocus>
                    </div>
                    <div class="form-group">
                        <label>New Password</label>
                        <input class="form-control" placeholder="New Password" name="n_pass" type="password" value="">
                    </div>
                    <div class="form-group">
                        <label>Retype New Password</label>
                        <input class="form-control" placeholder="Retype New Password" name="r_n_pass" type="password" value="">
                    </div>                    
                    <button type="submit" class="btn btn-success" id="login-btn" >Change Password</button>  
                    <input type="hidden" name="job" value="100" />
                    <input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
                </fieldset>
            </form>
        </div>
    </div>
</section>
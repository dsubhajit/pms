<!-- Static navbar -->

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><?=APP_NAME ?></a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
        <?php 
            if(!isset($req)) $req=0;
        ?>    
        <ul class="nav navbar-nav navbar-right">
            <li <?=  checkPageActive($req, 2) ?>><a href="company.php">Company</a></li>
            <li <?=  checkPageActive($req, 3) ?>><a href="admin.php">Admin</a></li>
            <li <?=  checkPageActive($req, 4) ?> ><a href="index.php">Students</a></li>
        </ul>
    </div><!--/.nav-collapse -->
    </div>
</nav>
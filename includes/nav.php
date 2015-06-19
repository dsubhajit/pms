

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
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
            <ul class="nav navbar-nav navbar-right">
                <?php 
                    if(USER_TYPE == STUDENT){   
                        require_once 'class/class.students_profile.php';
                        require_once 'class/class.students_login.php';
                        $stud = new students_profile();
                        $stud->findOnProfile_id(USER_PROFILE);
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user Dropdown" ></span> <?=$stud->getName() ?><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="?page_id=14">Change Password</a></li>
                        
                        <li class="divider"></li>                        
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php 
                    }
                ?>
                <?php 
                    if(USER_TYPE == COMPANY){   
                        require_once 'class/class.company_profile.php';
                        
                        $cp = new company_profile();
                        $cp->findOnProfile_id(USER_PROFILE);
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user Dropdown" ></span> <?=$cp->getCompany_name() ?><span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="?page_id=14">Change Password</a></li>
                        
                        <li class="divider"></li>                        
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php 
                    }
                ?>  
                <?php 
                    if(USER_TYPE == ADMIN){   
                        
                ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <span class="glyphicon glyphicon-user Dropdown" ></span> Administrator<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="?page_id=14">Change Password</a></li>
                        
                        <li class="divider"></li>                        
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php 
                    }
                ?>  
            </ul>
            
        </div>
    </div>
</nav>
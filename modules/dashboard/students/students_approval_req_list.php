
<div class="panel panel-default" >
    <div class="panel-heading" >
        Students Approval Request List
    </div>
    <table class="table table-bordered table-hovered" >
        <tr class="active" >
            <td>Student Name</td>
            <td>Degree</td>
            <td>Department</td>            
            <td>Approval Status</td>
            <td>Option</td>
        </tr>
        <?php 
        require_once 'class/class.students_login.php';
        require_once 'class/class.students_profile.php';
        require_once 'class/class.degree.php';
        require_once 'class/class.branches.php';
        $sl = new students_login();

        $d = new degree();
        $b = new branches();
        $std=array();
        $std = students_profile::getAllStudents_profile(" adm_yr_end='".date("Y")."' order by deparment");
        foreach ($std as $s){
            $d->findOnDegree_id($s->getDegree());
            $b->findOnBranch_id($s->getDeparment());
            $sl->findOnUserName($s->getEmail());
            if($sl->getUser_id() != USER_ID && $sl->getVerified()==PENDING){
        ?>
        <tr>
            <td><?=$s->getName() ?></td>
            <td><?=$d->getDegree_name() ?></td>
            <td><?=$b->getBranch_name() ?></td>
            <td><?=$s->getEmail() ?></td>

            <td><?=$s->getPhone() ?></td>
            <td><?=getStatus($sl->getVerified()) ?></td>
            <td>
                <a href="process.php?job=23&std_id=<?=$sl->getUser_id() ?>" class="btn btn-primary btn-xs" >
                    <span class="glyphicon glyphicon-ok-sign" title="Approve this student" ></span>
                </a>
                <?php 
                if(USER_TYPE==ADMIN){
                    if($sl->getIscordinator()==0){
                    ?>
                    <a href="process.php?job=24&std_id=<?=$sl->getUser_id() ?>" class="btn btn-success btn-xs" >
                        <span class="glyphicon glyphicon-user" title="Create Placement Co-ordinator" ></span>
                    </a>
                    <?php 
                    }
                    else{
                    ?>
                    <a href="process.php?job=26&std_id=<?=$sl->getUser_id() ?>" class="btn btn-danger btn-xs" >
                        <span class="glyphicon glyphicon-user" title="Remove Placement Co-ordinator" ></span>
                    </a>
                    <?php
                    }
                }
                ?>
                <a href="process.php?job=25&std_id=<?=$sl->getUser_id() ?>" class="btn btn-danger btn-xs" >
                    <span class="glyphicon glyphicon-remove-sign" title="Reject this student" ></span>
                </a>
            </td>                
        </tr>
        <?php 
            }
        }
        ?>

    </table>
</div>


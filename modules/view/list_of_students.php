
<section class="content-header" >    
    <h1 class="page-header text-info">List of Students</h1>    
</section>
<section class="content-element" >
    <div class="row" style="margin-bottom: 20px;" >
        <div class="col-md-12" >
            <form  action="" class="form-inline" method="post" >
                <div class="form-group">
                    <label>Degree</label>
                    <select name="degree" id="deg_main" class="form-control" >
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
                <div class="form-group" >
                    <?php 
                    require_once "class/class.department.php";
                    $d = department::getAllDepartment();
                    ?>
                    <label>Department</label>
                    <select name="dep" id="dep_main" class="form-control" >
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
                <div class="form-group">
                    <label>Branch</label>
                    <select name="branch" id="branch_main" class="form-control" >
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
                <div class="form-group">
                    <label>Year of Passing</label>
                    <select name="year" id="yp_main" class="form-control" >                        
                        <?php 
                            for($i=2000;$i<=2050;$i++){
                        ?>
                        <option value="<?=$i ?>" <?=(date("Y")==$i )?"selected":"" ?>  ><?=$i ?></option>    
                        <?php 
                            }
                        ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-filter" ></span> Filter</button>
                
                <button type="button" onclick="submitForm()" class="btn btn-primary" ><span class="glyphicon glyphicon-download-alt" ></span> Download List</button>
            </form>
        </div>
    </div>
    <form id="std_list" action="download_student_list.php" method="post" target="_blank" >
        <input type="hidden" name="year" id="yp">
        <input type="hidden" name="degree" id="deg">
        <input type="hidden" name="dep" id="dep">
        <input type="hidden" name="branch" id="branch">
    </form> 
    <div class="panel panel-default" >
        <div class="panel-heading" >
            Students List 
            
        </div>
        <table class="table table-bordered table-hovered" >
            <tr class="active" >
                <td>Enrollment No.</td>
                <td>Student Name</td>
                <td>Degree</td>
                <td>Department</td>
                <td>Branch</td>
                <td>Email</td>
                <td>Phone</td>
                <td>Job</td>      
                <td>Option</td>      
            </tr>
            <?php 
            require_once 'class/class.students_profile.php';
            require_once 'class/class.students_login.php';
            require_once 'class/class.degree.php';
            require_once 'class/class.branch.php';
            $d = new degree();
            $dep = new department();
            $b = new branch();
            $std=array();
            if(isset($_REQUEST['degree'])){
                $sql = "adm_yr_end='".real_escape_string($_REQUEST['year'])."'";
                if($_REQUEST['degree'] > 0) {
                    $sql .= " and degree=".$_REQUEST['degree'];
                }
                if($_REQUEST['dep'] > 0) {
                    $sql .= " and deparment=".$_REQUEST['dep'];
                }
                if($_REQUEST['branch'] > 0) {
                    $sql .= " and branch=".$_REQUEST['branch'];
                }
                $sql .= ' order by enroll_no';
                $std = students_profile::getAllStudents_profile($sql);
                
            }
            else $std = students_profile::getAllStudents_profile(" adm_yr_end='".date("Y")."' order by deparment");
            $sl = new students_login();
            foreach ($std as $s){
                $d->findOnDegree_id($s->getDegree());
                $b->findOnBranch_id($s->getBranch());
                $dep->findOnDep_id($s->getDeparment());
                $sl->findOnUserName($s->getEnroll_no());
            ?>
            <tr>
                <td><?=$s->getEnroll_no() ?></td>
                <td><?=$s->getName() ?></td>
                <td><?=$d->getDegree_name() ?></td>
                <td><?=$dep->getDep_name() ?></td>
                <td><?=$b->getBranch_name() ?></td>
                <td><?=$s->getEmail() ?></td>
                <td><?=$s->getPhone() ?></td>
                <td>
                    <?=($s->getJob_status()==1)?"Hired":"Not yet" ?>                    
                </td>   
                <td>
                    <a href="?page_id=11&std_id=<?=$s->getProfile_id() ?>" class="btn btn-primary btn-xs" title="View Details"  ><span class="glyphicon glyphicon-check"></span></a>                    
                    <?php 
                    if(USER_TYPE==ADMIN || USER_PRIV == true){
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
                        ?>
                        <a href="process.php?job=43&std_id=<?=$sl->getUser_id() ?>" class="btn btn-danger btn-xs" >
                            <span class="glyphicon glyphicon-trash" title="Delete Student" ></span>
                        </a>
                        <?php
                    }
                    if(USER_TYPE==ADMIN){
                        if($s->getMultiple_job_allow()==0){
                    ?>
                    <a href="process.php?job=51&std_id=<?=$s->getProfile_id() ?>" class="btn btn-info btn-xs" >
                        <span class="glyphicon glyphicon-new-window" title="Allow Multiple Jobs" ></span>
                    </a>
                    <?php                    
                        }
                        else {
                    ?>
                    <a href="process.php?job=52&std_id=<?=$s->getProfile_id() ?>" class="btn btn-warning btn-xs" >
                        <span class="glyphicon glyphicon-new-window" title="Disallow Multiple Jobs" ></span>
                    </a>
                    <?php
                        }
                    }
                    ?>
                </td>
            </tr>
            <?php 
            }
            ?>

        </table>
    </div>
</section>

<script>
function submitForm(){
    $('#deg').val($('#deg_main').val());
    $('#branch').val($('#branch_main').val());
    $('#dep').val($('#dep_main').val());
    $('#yp').val($('#yp_main').val());
    //alert('ggg');
    var url = 'download_student_list.php?dep='+$('#dep_main').val()+'&degree='+$('#deg_main').val()+'&branch='+$('#branch_main').val()+'&year='+$('#yp_main').val();
    var win = window.open(url, '_blank');
    win.focus();  
}
</script>
    
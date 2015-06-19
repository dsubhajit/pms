
<section class="content-header" >    
    <h1 class="page-header text-info">Students Configuration        
        <div class="btn-group pull-right" role="group" aria-label="..."  >
            <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#add_students" >
            <span class="glyphicon glyphicon-plus" ></span> 
            </a> 
            
        </div> 
        
    </h1>    
</section>
<section class="content-element" >
    <div class="row" style="margin-bottom: 20px;" >
        <div class="col-md-12" >
            <form  action="" class="form-inline" method="post" style="width: 100%" >
                
                <div class="form-group">
                    <label>Degree</label>
                    <select name="degree" class="form-control" >
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
                    <select name="dep" class="form-control" >
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
                    <select name="branch" class="form-control" >
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
                    <select name="year" class="form-control" >                        
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
            </form>
        </div>
    </div>
    <div class="panel panel-primary" >
        <div class="panel-heading" >
            Students List
        </div>
        <table class="table table-bordered table-hovered" >
            <tr class="active" >
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
            foreach ($std as $s){
                $d->findOnDegree_id($s->getDegree());
                $b->findOnBranch_id($s->getBranch());
                $dep->findOnDep_id($s->getDeparment());
            ?>
            <tr>
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
                </td>
            </tr>
            <?php 
            }
            ?>

        </table>
    </div>
</section>

<?php 
    include_once 'modules/configuration/add_students_form.php';
?>

<script>
function loadBranchs
</script>
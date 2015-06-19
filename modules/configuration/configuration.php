
<section class="content-header" >
    <h1 class="page-header text-info">Configuration</h1>
    
</section>
<section class="content-element" >
    <div class="row" >
        <div class="col-md-12" style="margin-bottom: 10px;" >
            <a href="?page_id=13" class="btn btn-primary" >Students Configuration</a>
        </div>
        <div class="col-md-6" >
            <div class="panel panel-default" >
                <div class="panel-heading" >
                    Degrees
                </div>
                <div class="panel-body" >
                    <form action="process.php" method="post" >
                        <div class="form-group" >
                            <label>Degree Name</label>
                            <input type="text" class="form-control" name="degree" placeholder="Enter degree name" >
                        </div>
                        <div class="form-group" >
                            <label>Available</label>
                            <select class="form-control" multiple="multiple" >
                                <?php 
                                    require_once 'class/class.degree.php';
                                    $deg = degree::getAllDegree();
                                    foreach ($deg as $d){
                                        echo '<option>'.$d->getDegree_name().'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="job" value="15" />
                        <input type="hidden" name="redirectUrl" value="<?=  curPageURL() ?>" />
                        <button type="submit" class="btn btn-primary" >Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6" >
            <div class="panel panel-default" >
                <div class="panel-heading" >
                    Departments
                </div>
                <div class="panel-body" >
                    <form action="process.php" method="post" >
                        <div class="form-group" >
                            <label>Department Name</label>
                            <input type="text" class="form-control" name="dep" placeholder="Enter department name" >
                        </div>
                        <div class="form-group" >
                            <label>Available</label>
                            <select class="form-control" multiple="multiple" >
                                <?php 
                                    require_once 'class/class.department.php';
                                    $dep = department::getAllDepartment();
                                    foreach ($dep as $dp){
                                        echo '<option>'.$dp->getDep_name().'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="job" value="16" /> 
                        <input type="hidden" name="redirectUrl" value="<?=  curPageURL() ?>" />
                        <button type="submit" class="btn btn-primary" >Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12" >
            <div class="panel panel-default" >
                <div class="panel-heading" >
                    Branches
                </div>
                <?php 
                    require_once "class/class.department.php";
                    $d = department::getAllDepartment();
                ?>
                <div class="panel-body" >
                    <div class="col-md-6" >
                        <form action="process.php" method="post" >
                            <div class="form-group" >
                                <label>Department Name</label>
                                <select name="dep" class="form-control"   <?=(sizeof($d) == 0)?"disabled":"" ?>>
                                    <option value="-1" >------Select------</option>
                                    <?php
                                    foreach ($d as $dp){
                                        echo '<option value="'.$dp->getDep_id().'" >'.$dp->getDep_name().'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" >
                                <label>Branch Name</label>
                                <input type="text" class="form-control" name="branch_name" <?=(sizeof($d) == 0)?"disabled":"" ?>>
                            </div>                        
                            
                            <input type="hidden" name="job" value="28" /> 
                            <input type="hidden" name="redirectUrl" value="<?=  curPageURL() ?>" />
                            <button type="submit" class="btn btn-primary" >Save</button>
                        </form>
                    </div>
                    <div class="col-md-6" >
                        <div class="form-group" >
                            <label>Available</label>
                            <select class="form-control" style="height:200px!important;" multiple="multiple" <?=(sizeof($d) == 0)?"disabled":"" ?>>
                                <?php                                    
                                    require_once 'class/class.branch.php';
                                    foreach ($d as $dp){
                                ?>
                                <optgroup label="<?=$dp->getDep_name() ?>" >
                                <?php
                                        $bran = branch::getAllBranch(' dep_id='.$dp->getDep_id());
                                        foreach ($bran as $b){
                                            echo '<option>'.$b->getBranch_name().'</option>';
                                        }
                                ?>
                                </optgroup>    
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>    
    
</section>

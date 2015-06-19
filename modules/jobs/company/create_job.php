<!-- Modal -->
<div class="modal fade" id="addJobModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-briefcase"></span> Add Job</h4>
      </div>
      <form method="post" action="process.php" >
        <div class="modal-body">
            <div class="row" >  
                <div class="col-md-12">
                    <div class="well well-sm">
                        <h3>About</h3>                    
                        <div class="row">                        
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label>Job Designation</label>
                                    <input type="text" class="form-control" name="desg" placeholder="Enter job designation">
                                </div>
                                <div class="form-group">
                                    <label>Job Location(s)</label>
                                    <input type="text" class="form-control" name="loc" placeholder="Enter job location(s)">
                                </div>
                                <div class="form-group">
                                    <label>Minimum no. of offers you intend to make</label>
                                    <input type="text" class="form-control" name="nof" placeholder="">
                                </div>

                            </div>
                            <div class="col-md-6" >
                                <div class="form-group">
                                    <label>Job Description</label>
                                    <textarea class="form-control" rows="8" name="desc" ></textarea>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="well well-sm" >
                        <h3>Salary Details</h3>
                        <div class="row" >
                            <div class="col-md-4" >
                                <div class="form-group" >
                                    <label>Degree</label>
                                    <select class="form-control" id="degree" multiple="multiple" >                                    
                                        <?php 
                                            require_once 'class/class.degree.php';
                                            $deg = degree::getAllDegree();
                                            foreach ($deg as $d){
                                                echo '<option value="'.$d->getDegree_id().'" >'.$d->getDegree_name().'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>CTC</label>
                                    <input type="text" class="form-control" id="ctc" name="job_ctc" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Gross</label>
                                    <input type="text" class="form-control" id="gross" name="job_gross" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Bonus/Perks/Incentives</label>
                                    <input type="text" class="form-control" id="bonus" name="job_bonus" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>Service Contract/Bond</label>
                                    <input type="text" class="form-control" id="bond" name="job_bond" placeholder="">
                                </div>
                                <buttonn class="btn btn-primary" onclick="addDetails()" type="button" ><span class="glyphicon glyphicon-plus"></span> Add</buttonn>
                            </div>
                            <div class="col-md-8" >
                                <h4>Added Details</h4>
                                <table class="table table-bordered" id="details_table" >
                                    <tr>
                                        <td>Degree</td>
                                        <td>CTC</td>
                                        <td>Gross</td>
                                        <td>Bonus/Perks/Incentives</td>
                                        <td>Service Contract/Bond</td>
                                        <td>Option</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="well well-sm" >
                        <h3>Selection Process</h3>
                        <div class="row" >
                            <div class="col-md-4 " >
                                <div class="form-group">
                                    <label>Numbers of round</label>
                                    <select class="form-control" onchange="addRounds(this)" name="round_num" >
                                        <?php 
                                        for($i = 1;$i<=10;$i++) {
                                            echo '<option value="'.$i.'" >'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8 " ></div>
                            <div class="col-md-12" >
                                <table class="table table-bordered" id="round_details" >

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="well well-sm">
                        <h3>Eligibility Criteria</h3>
                        <div class="row" >
                            <div class="col-md-4 " >
                                <div class="form-group" >
                                    <label>Degree</label>
                                    <select class="form-control" name="degree[]" id="degree" multiple="multiple" >                                    
                                        <?php 
                                            require_once 'class/class.degree.php';
                                            $deg = degree::getAllDegree();
                                            foreach ($deg as $d){
                                                echo '<option value="'.$d->getDegree_id().'" >'.$d->getDegree_name().'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 " >
                                <div class="form-group" >
                                    <?php 
                                    require_once "class/class.department.php";
                                    $d = department::getAllDepartment();
                                    ?>
                                    <label>Department</label>
                                    <select name="dep[]" class="form-control" id="dep"  multiple="multiple">
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
                            </div>
                            <div class="col-md-4 " >
                                <div class="form-group">
                                    <label>Branch</label>
                                    <select name="branch[]" class="form-control" id="branch"  multiple="multiple">
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
                            </div>
                            <div class="col-md-12" >
                                <div class="form-group">
                                    <label>Criteria</label>
                                    <textarea class="form-control" name="criteria" ></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
            
            <input type="hidden" name="job" value="9" />
            <input type="hidden" name="redirectUrl" value="<?=curPageURL() ?>" />
        </div>
        <div class="hid_fields" >
            <input type="hidden" name="sal_count" id="hid_count" />
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
    $('#fromdate2').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    $('#todate2').datetimepicker({                
        format: 'YYYY-MM-DD'
    });
    
    var count = 0;
    
    
    function addDetails(){
        var deg_name_arr = [];
        $("#degree option:selected").each(function(){
            deg_name_arr.push($(this).text());
        });
        
        var deg_name = deg_name_arr.join();        
        var deg_val = $("#degree").val().join();        
        var target = $('.hid_fields');        
        $(target).append('<input type="hidden" class="field_'+count+'" name="degree'+count+'" value="'+deg_val+'" />');        
        
        var ctc = $('#ctc').val();
        var bond = $('#bond').val();
        var gross = $('#gross').val();
        var bonus = $('#bonus').val();
        $(target).append('<input type="hidden" class="field_'+count+'" name="ctc'+count+'" value="'+ctc+'" />');  
        $(target).append('<input type="hidden" class="field_'+count+'" name="bond'+count+'" value="'+bond+'" />');        
        $(target).append('<input type="hidden" class="field_'+count+'" name="gross'+count+'" value="'+gross+'" />');        
        $(target).append('<input type="hidden" class="field_'+count+'" name="bonus'+count+'" value="'+bonus+'" />');        
        
        var table_val = '<tr id="tr'+count+'" >';
        table_val+='<td>'+deg_name+'</td><td>'+ctc+'</td><td>'+gross+'</td><td>'+bonus+'</td><td>'+bond+'</td><td><a class="btn btn-danger btn-xs" href="javascript:remove('+count+')" ><span aria-hidden="true">&times;</span></a></td>';   
        table_val+='</tr>';
        $('#details_table').append(table_val);
        count++;
        $('#hid_count').val(count);
        
    }
    
    function remove(id){        
        
        $('#tr'+id).remove();
        $('.field_'+id).remove();
        //console.log(id);
    }
    
    function addRounds(obj){
        var r = $(obj).val();
        //console.log(r);
        $('#round_details').html('<tr class="active" ><td>Round Name</td><td>Details</td></tr>');
        for(var i = 0;i<r;i++){
            $('#round_details').append('<tr><td><input type="text" name="round_name'+i+'" class="form-control" /></td><td><textarea name="round_details'+i+'" class="form-control" ></textarea></td></tr>');
        }
    }
    
</script>
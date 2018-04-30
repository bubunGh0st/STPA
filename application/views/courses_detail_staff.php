<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
$(document).ready(function() {

  $(function() {
   $('input[name="FinishTime"]').datepicker();
  });

  <?php 
    if(isset($_GET["warning"])){
      if($_GET["warning"]==1){
        ?>alert("Assignment Finish Date must be earlier than the Trimester Finish Date");<?php
      }else if($_GET["warning"]==2){
        ?>alert("Successfully added assignment.");<?php
      }else if($_GET["warning"]==3){
        ?>alert("Successfully deleted assignment.");<?php
      }
    }
  ?>
   
} );
</script>

<script>
var ngAssignment = angular.module('ngAssignment', []);
ngAssignment.controller('myCtrl', function($scope) {
    $scope.AssignmentHours= "<?php echo(intval($getTotalAssignmentHours->AssignmentHours));?>";
    $AssignmentHours=$scope.AssignmentHours;
});

var ngTotal = angular.module('ngTotal', []);
ngTotal.controller('myCtrl2', function($scope) {
    $scope.TotalHours= $AssignmentHours;
});
</script>

<style>
  .clear{
    clear: both;
  }.btn-50-left{
    float:left !important;
    width: 50% !important;
    margin: 0 !important;
    border-bottom-right-radius: 0; 
    border-top-right-radius: 0; 
  }.btn-50-right{
    float:right!important;
    width: 50% !important;
    margin: 0 !important;
    border-bottom-left-radius: 0; 
    border-top-left-radius: 0; 
  }
</style>


  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-flask"></i> <?php echo($getTrimester->CourseCode);?> - <?php echo($getTrimester->CourseName);?>

          <?php if($getEditTrimester){?>
            <button name="btnSubmitEdit" type="submit" class="btn btn btn-primary float-right"><i class="fa fa-save"></i></button>
          <?php }?>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm"><strong>Course Code</strong></div>
            <div class="col-sm"><?php echo($getTrimester->CourseCode);?></div>
          </div>
          <div class="row">
            <div class="col-sm"><strong>Name</strong></div>
            <div class="col-sm"><?php echo($getTrimester->CourseName);?></div>
          </div>
          <div class="row">
            <div class="col-sm"><strong>Current Period</strong></div>
            <div class="col-sm">
              <?php echo($getTrimester->TrimesterName);?>
              [<?php echo(date("d M Y",strtotime($getTrimester->StartDate)));?> - <?php echo(date("d M Y",strtotime($getTrimester->FinishDate)));?>]
            </div>
          </div>
          <div class="row">
            <div class="col-sm"><strong>Current Lecturers</strong></div>
            <div class="col-sm">

                <?php 
                  foreach($getTrimesterStaff as $items){
                    echo("- ".$items->Title." ".$items->FName." ".$items->LName."<br>");
                  }
                ?>
            </div>
          </div>
          <div class="row">
            <div class="col-sm"><strong>Status</strong></div>
            <div class="col-sm"><?php echo($getTrimester->Status);?></div>
          </div>
        </div>
      </div>

      <div class="row">

        <!-- Example DataTables Card-->
        <div class="col-sm-6">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-file-text-o"></i> Assessments
              <?php if($getEditTrimester){?>
                <button data-toggle="modal" data-target="#modal-add-assignment" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
              <?php }?>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="tblAssignment" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Due</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($getTrimesterAssignment as $items){?>
                      <tr>
                        <td><?php echo($items->Title);?></td>
                        <td>
                          <?php echo(date("d M Y",strtotime($items->FinishTime)));?>
                          <br>
                          [<?php echo(intval($items->CompletionHours));?> Hour(s)]
                        </td>
                        <td>
                          <?php if($getEditTrimester){?>
                            <a href="<?php echo(site_url());?>/Dashboard_staff/deleteAssignment/<?php echo($items->AssignmentID);?>" onclick="return confirm('Delete this Assignment?');" class="btnDeleteAssignment btn btn-danger">
                              <i class="fa fa-trash"></i>
                            </a>
                          <?php }?>
                        </td>
                      </tr>
                    <?php }?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-clock-o"></i> Time Distribution
            </div>

            <div class="card-body">
             <form>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Percentage of Full Time</label>
                        <input class="form-control" type="number" aria-describedby="nameHelp" placeholder="Percentage of Full Time" min=1 max=100>
                      </div>
                      <div class="col-md-6">
                        <label>Number of Weeks</label>
                        <input class="form-control" type="number" aria-describedby="nameHelp" placeholder="Number of Weeks" min=1 max=13 value="12">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Total Hours/Week</label>
                        <input class="form-control" type="number" aria-describedby="nameHelp" placeholder="Total Hours/Week" >
                      </div>
                      <div class="col-md-6">
                        <label>Total Hours</label>
                        <input class="form-control" type="number" aria-describedby="nameHelp" value="0" readonly="">
                      </div>
                    </div>
                    <br><br>

                    <div class="form-row">
                      <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                              <th>Item</th>
                              <th>Hours/Week</th>
                              <th>Hours Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Assessment</td>
                              <td></td>
                              <td align="right">
                                <div ng-app="ngAssignment" ng-controller="myCtrl">
                                  {{AssignmentHours}}
                                </div>
                                
                              </td>
                            </tr>
                            <tr>
                              <td>Readings</td>
                              <td><input class="form-control" style="width: 50px;" type="number" value="1"></td>
                              <td align="right">
                                12
                              </td>
                            </tr>
                            <tr>
                              <td>Contacts</td>
                              <td><input class="form-control" style="width: 50px;" type="number" value="2"></td>
                              <td align="right">
                                24
                              </td>
                            </tr>
                            <tr>
                              <td>Exam</td>
                              <td></td>
                              <td align="right">
                                3
                              </td>
                            </tr>
                            <tr>
                              <td>Revision Time</td>
                              <td align="right">0.5</td>
                              <td align="right">6</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th colspan="2">Total Hours</th>
                              <td align="right">
                                <div ng-app="ngTotal" ng-controller="myCtrl2">
                                  {{TotalHours}}
                                </div>
                              </td>
                            </tr>
                           
                          </tfoot>
                        </table>
                      </div>
                     
                    </div>
                  </div>
                  
                </form>
              </div>
          </div>
        </div>

    
      </div>
      <!-- Example DataTables Card-->

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

     <!-- Modal -->
    <div class="modal fade" id="modal-add-assignment" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Add New Assessment</h4>
          </div>
          <div class="modal-body">
              <?php echo form_open_multipart();?>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="Title" placeholder="Title">
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" name="Description" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                  <label>Due</label>
                  <div class="clear"></div>
                  <input type="text" class="form-control" name="FinishTime">
                  <div class="clear"></div>
                </div>
                <div class="form-group">
                  <label>Hours to Complete</label>
                  <input type="number" class="form-control" name="CompletionHours" placeholder="Hours to Complete">
                </div>
                <button class="btn btn-primary btn-block" name="btnSubmitAddAssignment"><i class="fa fa-plus"></i> Add Assessment</button>
              <?php echo form_close()?>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
              <i class="fa fa-remove"></i> Cancel
            </button>
            
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-delete-assignment" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this assignment?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-trash"></i> Delete</button>
          </div>
        </div>
      </div>
    </div>

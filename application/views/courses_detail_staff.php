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
        ?>alert("Assignment Finish Date must be later than the Trimester Start Date.");<?php
      }else if($_GET["warning"]==3){
        ?>alert("Successfully added assignment.");<?php
      }else if($_GET["warning"]==4){
        ?>alert("Successfully deleted assignment.");<?php
      }else if($_GET["warning"]==5){
        ?>alert("Revision Time can not be less than zero.");<?php
      }else if($_GET["warning"]==6){
        ?>alert("Successfully updated Time Distribution.");<?php
      }
    }
  ?>

  calculation();
  $("input[name='CompletionWeeks']").change(function(e){
    calculation();
  });

  $("input[name='CompletionHours']").change(function(e){
    calculation();
  });

  $("input[name='ReadingHours']").change(function(e){
    calculation();
  });

  $("input[name='ContactHours']").change(function(e){
    calculation();
  });

  function calculation(){
    CompletionWeeks=$("input[name='CompletionWeeks']").val();
    CompletionHours=$("input[name='CompletionHours']").val();
    ReadingHours=$("input[name='ReadingHours']").val();
    ContactHours=$("input[name='ContactHours']").val();
    AssignmentHours=parseInt($("#AssignmentHours").html());

    TotalHours=CompletionHours*CompletionWeeks;
    $("input[name='TotalHours']").val(TotalHours);

    TotalReadingHours=ReadingHours*CompletionWeeks;
    TotalContactHours=ContactHours*CompletionWeeks;
    TotalRevisionHours=TotalHours-TotalReadingHours-TotalContactHours-AssignmentHours;
    WeekRevisionHours=Math.round(TotalRevisionHours/CompletionWeeks);
    TotalRevisionHours=WeekRevisionHours*CompletionWeeks;
    TotalHours=TotalRevisionHours+TotalContactHours+TotalReadingHours+AssignmentHours;

    $("#TotalHours").html(TotalHours);
    $("#ReadingHours").html(TotalReadingHours);
    $("#ContactHours").html(TotalContactHours);
    $("#RevisionHours").html(TotalRevisionHours);
    $("input[name='RevisionHours']").val(WeekRevisionHours);
    $("#WeekRevisionHours").html(WeekRevisionHours);
  }
   
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

          <?php echo form_open_multipart();?>
            <i class="fa fa-flask"></i> <?php echo($getTrimester->CourseCode);?> - <?php echo($getTrimester->CourseName);?>

            <?php if($getDeactivateTrimester){?>
              <button name="btnSubmitDeactivate" type="submit" class="btn btn btn-secondary float-right" title="Deactivate"><i class="fa fa-square"></i> Deactivate</button>
            <?php }?>

            <?php if($getActivateTrimester){?>
              <button name="btnSubmitActivate" type="submit" class="btn btn btn-primary float-right" title="Activate"><i class="fa fa-check"></i> Activate</button>
            <?php }?>
          <?php echo form_close()?>
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
              [<?php echo($getTotalWeeksTrimester->WeeksTrimester);?> Week(s)]
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
          <?php echo form_open_multipart();?>
            <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-clock-o"></i> Time Distribution
                <?php if($getEditTrimester){?>
                  <button name="btnSubmitTimeDist" type="submit" class="btn btn btn-primary float-right" title="Save">
                    <i class="fa fa-save"></i>
                  </button>
                <?php }?>
              </div>

              <div class="card-body">
                <div class="form-group">
                  <div class="form-row">
                    <!-- will edit later in change request-->
                    <!--
                    <div class="col-md-6">
                      <label>Percentage of Full Time</label>
                      <input class="form-control" type="number" placeholder="Percentage of Full Time" min=1 max=100>
                    </div>
                    -->
                    <div class="col-md-6">
                      <label>Number of Weeks</label>
                      <?php
                        $WeeksTrimester=$getTotalWeeksTrimester->WeeksTrimester;
                        if($getTrimester->CompletionWeeks>0){
                          $WeeksTrimester=$getTrimester->CompletionWeeks;
                        }
                      ?>
                      <input class="form-control" type="number" placeholder="Number of Weeks" min=1 max=<?php echo md5($getTotalWeeksTrimester->WeeksTrimester);?> name="CompletionWeeks"
                      value="<?php echo(intval($WeeksTrimester)); ?>">
                    </div>
                    <div class="col-md-6">
                      <label>Total Hours/Week</label>
                      <input class="form-control" type="number" value="<?php echo(intval($getTrimester->CompletionHours)); ?>" name="CompletionHours" min=1 placeholder="Total Hours/Week" >
                    </div>
                  </div>
                  <div class="form-row">
                   
                    <div class="col-md-6">
                      <label>Estimated Total Hours</label>
                      <input class="form-control" type="number" aria-describedby="nameHelp" value="<?php echo(intval($getTrimester->CompletionHours*$WeeksTrimester)); ?>" readonly="" name="TotalHours">
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
                              <div id="AssignmentHours">
                                <?php echo(intval($getTotalAssignmentHours->AssignmentHours));?>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Readings</td>
                            <td>
                              <input class="form-control" name="ReadingHours" style="width: 50px;" type="number" min=0 value="<?php echo($getTrimester->ReadingHours);?>">
                            </td>
                            <td align="right">
                              <div id="ReadingHours">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Classes</td>
                            <td>
                              <input class="form-control" name="ContactHours" style="width: 50px;" type="number" min=0 value="<?php echo($getTrimester->ContactHours);?>">
                            </td>
                            <td align="right">
                              <div id="ContactHours">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Revision Time</td>
                            <td>
                              <input class="form-control" name="RevisionHours" style="width: 50px;" type="hidden" value="">
                              <div id="WeekRevisionHours">
                              </div>
                            </td>
                            <td align="right">
                              <div id="RevisionHours">
                              </div>
                            </td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="2">Total Hours</th>
                            <td align="right">
                              <div id="TotalHours">
                                <?php echo(intval($getTrimester->CompletionHours*$WeeksTrimester));?>
                              </div>
                            </td>
                          </tr>
                         
                        </tfoot>
                      </table>
                    </div>
                  </div>
               </div>
            </div>
          </div>
        </div>
      </div>
    <?php echo form_close()?>
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
                  <input type="number" class="form-control" name="CompletionHours" placeholder="Hours to Complete" min=1>
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

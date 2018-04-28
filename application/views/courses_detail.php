<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->model('CoursesModel');

?>


<script>
$(document).ready(function() {

   <?php 
    if(isset($_GET["warning"])){
      if($_GET["warning"]==1){
        ?>alert("Successfully updated course.");<?php
      }else if($_GET["warning"]==2){
        ?>alert("Start Date must be earlier than Finish Date.");<?php
      }else if($_GET["warning"]==3){
        ?>alert("Successfully added new Trimester.");<?php
      }else if($_GET["warning"]==4){
        ?>alert("Successfully deleted Trimester.");<?php
      }
    }
    ?>

      $('#modal-delete-trimester').on('show.bs.modal', function (e) {
          var TrimesterID = $(e.relatedTarget).data('id');
          $(e.currentTarget).find('input[name="TrimesterID"]').val(TrimesterID);
      });

     $(function() {

       $('input[name="StartDate"]').datepicker();
       $('input[name="FinishDate"]').datepicker();

        
     });

    

} );
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

      <?php echo form_open_multipart();?>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-flask"></i> <?php echo($getCourse->CourseCode);?> - <?php echo($getCourse->CourseName);?>
            <button class="btn btn btn-primary float-right" name="btnSubmit" type="btnSubmit"><i class="fa fa-save"></i></button>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label>Course Code</label>
              <input type="text" class="form-control" name="CourseCode" placeholder="Course Code" value="<?php echo($getCourse->CourseCode);?>">
            </div>
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="CourseName" placeholder="Course Name" value="<?php echo($getCourse->CourseName);?>">
            </div>
           
            <div class="form-group">
              <label>Site</label>
              <select class="form-control" name="SiteID">
                <?php foreach($getUserSite as $items){?>
                  <option value="<?php echo($items->SiteID);?>" <?php if($items->SiteID==$getCourse->SiteID)echo("selected");?>>
                    <?php echo($items->SiteName);?>  
                  </option>
                <?php }?>
              </select>
            </div>
          </div>
        </div>
      <?php echo form_close()?>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-flask"></i> Trimester
          <button data-toggle="modal" data-target="#modal-add-trimester" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Start</th>
                  <th>Finish</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Site</th>
                  <th>Finish</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($getTrimester as $items){?>
                  <tr>
                    <td><?php echo($items->TrimesterName);?></td>
                    <td><?php echo(date("d M Y",strtotime($items->StartDate)));?></td>
                    <td><?php echo(date("d M Y",strtotime($items->FinishDate)));?></td>
                    <td>
                      <?php echo($items->Status);?> 
                      <?php 
                      if(date("Ymd",strtotime($items->FinishDate))<date("Ymd")){
                        echo(" - EXPIRED");
                      }
                      ?>
                    </td>
                    <td>

                      <?php if($CI->CoursesModel->isDeleteTrim($items->TrimesterID)){ ?>
                        <a onclick="return confirm('Are you sure to delete this trimester?');" href="<?php echo(site_url());?>/Courses/deleteTrimester/<?php echo($items->TrimesterID);?>?CourseID=<?php echo($getCourse->CourseID);?>" class="btn btn-danger"><i class="fa fa-trash" title="Delete"></i></a>
                      <?php }?>
                    </td>
                  </tr>
                 <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

 <!-- Modal -->
    <div class="modal fade" id="modal-add-trimester" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Add New Trimester</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
             <div class="form-group">
                <label>Trimester Name</label>
                <input type="text" class="form-control" name="TrimesterName" placeholder="Trimester Name">
              </div>
              <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control .btn-50-left" name="StartDate" placeholder="Start Date">
              </div>
              <div class="form-group">
                <label>Finish Date</label>
                <input type="text" class="form-control .btn-50-right" name="FinishDate" placeholder="Finish Date">
              </div>
              <button type="submit" class="btn btn-primary btn-block" name="btnSubmitAddTrimester"><i class="fa fa-save"></i> Save</button>
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
    <div class="modal fade" id="modal-delete-trimester" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Trimester?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">

            <?php echo form_open_multipart();?>
              <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
              <button class="btn btn-danger" type="submit" name="btnSubmitDelTrimester"><i class="fa fa-trash"></i> Delete</button>
              <input type="hidden" name="TrimesterID" value="">
            <?php echo form_close()?>

          </div>
        </div>
      </div>
    </div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
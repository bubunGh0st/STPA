<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript" src="<?php echo(base_url());?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo(base_url());?>js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script>
$(document).ready(function() {

   <?php 
    if(isset($_GET["warning"])){
      if($_GET["warning"]==1){
        ?>alert("At least one course has to be checked.");<?php
      }
    }
    ?>

    $('#modal-remove-trimester').on('show.bs.modal', function (e) {
        var TrimesterID = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="TrimesterID"]').val(TrimesterID);
    });
} );
</script>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-flask"></i> Academic Term
            <button data-toggle="modal" data-target="#modal-add-course-trimester" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Course Code</th>
                  <th>Name</th>
                  <th>Term</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Course Code</th>
                  <th>Name</th>
                  <th>Term</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($getStaffCourses as $items){?>
                  <tr>
                    <td><?php echo($items->CourseCode);?></td>
                    <td><?php echo($items->CourseName);?></td>
                    <td><?php echo($items->TrimesterName);?></td>
                    <td>
                      <a class="btn btn-primary" href="<?php echo(site_url());?>/Dashboard_staff/detail/<?php echo($items->TrimesterID);?>"><i class="fa fa-fw fa-wrench"></i></a>

                      <button data-id="<?php echo($items->TrimesterID);?>" data-toggle="modal" data-target="#modal-remove-trimester" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      
      <!-- Example DataTables Card-->

     <!-- Modal -->
    <div class="modal fade" id="modal-add-course-trimester" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Available Academic Term</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-content">
            <div class="card-body">
              <?php echo form_open_multipart();?>
                <div class="form-group">
                  <div class="form-check checklist" >
                    <?php foreach($getStaffNotCourses as $items){?>
                        <label class="form-check-label"><input class="form-check-input" type="checkbox" name="TrimesterID[]" value="<?php echo($items->TrimesterID);?>"> <?php echo($items->CourseCode);?> - <?php echo($items->CourseName);?> - <?php echo($items->TrimesterName);?></label><br>
                    <?php }?>
                  </div>
                </div>
                <button class="btn btn-primary btn-block" name="btnSubmit" type="submit"><i class="fa fa-fw fa-plus"></i> Add</button>
              <?php echo form_close()?>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
          </div>
        </div>
      </div>
    </div>

      <!-- Modal -->
    <div class="modal fade" id="modal-remove-trimester" User="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to remove this Academic Term?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <?php echo form_open_multipart();?>
              <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
              <button class="btn btn-danger" type="submit" name="btnSubmitDel"><i class="fa fa-trash"></i> Remove</button>
              <input type="hidden" name="TrimesterID" value="">
            <?php echo form_close()?>
          </div>
        </div>
      </div>
    </div>
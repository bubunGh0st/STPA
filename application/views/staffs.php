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
        ?>alert("Cannot create new Staff. Email has been used or invalid.");<?php
      }else if($_GET["warning"]==2){
         ?>alert("Successfully added Staff, Invitation E-mail is sent.");<?php
      }else if($_GET["warning"]==3){
        ?>alert("Cannot delete Staff. This user already has record.");<?php
      }
    }
    ?>

    $('#modal-delete-staff').on('show.bs.modal', function (e) {
        var Email = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="Email"]').val(Email);
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

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-group"></i> Staffs
          <button data-toggle="modal" data-target="#modal-add-Staff" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Site</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Site</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($getStaffs as $items){?>
                  <tr>
                    <td><?php echo($items->Email);?></td>
                    <td><?php echo($items->Title);?> <?php echo($items->FName);?> <?php echo($items->LName);?></td>
                    <td><?php echo($items->SiteName);?></td>
                    <td>
                      <a class="btn btn-primary" href="<?php echo(site_url());?>/Staffs/detail/<?php echo md5($items->Email);?>"><i class="fa fa-fw fa-th-list"></i></a>
                      <button data-id="<?php echo($items->Email);?>" data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                <?php }?>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Example DataTables Card-->

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

     <!-- Modal -->
    <div class="modal fade" id="modal-add-Staff" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Add New Staff</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
              <div class="form-group">
                <label>E-mail</label>
                <input type="Email" class="form-control" name="Email" placeholder="E-mail" required="">
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="FName"  placeholder="First Name" required="">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="LName"  placeholder="Last Name" required="">
              </div>
               <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="Title" placeholder="Title" required="">
              </div>
              <div class="form-group">
                <label>Site</label>
                <select class="form-control" name="SiteID">
                  <?php foreach($getUserSite as $items){?>
                    <option value="<?php echo($items->SiteID);?>"><?php echo($items->SiteName);?></option>
                  <?php }?>
                </select>
              </div>
              <button type="submit" class="btn btn-primary btn-block" name="btnSubmitAdd"><i class="fa fa-save"></i> Save</button>
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
    <div class="modal fade" id="modal-delete-staff" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Staff?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <?php echo form_open_multipart();?>
              <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
              <button class="btn btn-danger" type="submit" name="btnSubmitDel"><i class="fa fa-trash"></i> Delete</button>
              <input type="hidden" name="Email" value="">
            <?php echo form_close()?>

          </div>
        </div>
      </div>
    </div>
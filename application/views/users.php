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
        ?>alert("Email has been used. Please use different email.");<?php
      }else if($_GET["warning"]==2){
        ?>alert("Invitation email has been sent.");<?php
      }else if($_GET["warning"]==3){
        ?>alert("Successfully updated user.");<?php
      }else if($_GET["warning"]==4){
        ?>alert("Cannot delete user, this user already has record.");<?php
      }
    }
    ?>

    $('#modal-edit-user').on('show.bs.modal', function (e) {
        var Email = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="Email"]').val(Email);
         $.post("<?php echo(site_url('Users/getUser'));?>",
          {
              Email: Email,
              dataType: 'json'
          },
          function(data){
            $(e.currentTarget).find('input[name="SiteID[]"]').prop("checked",false);
            $(e.currentTarget).find('#headerEmail').val(data.Email);
            $(e.currentTarget).find('input[name="Email"]').val(data.Email);
            $(e.currentTarget).find('input[name="FName"]').val(data.FName);
            $(e.currentTarget).find('input[name="LName"]').val(data.LName);
            $(e.currentTarget).find('input[name="Title"]').val(data.Title);
            $(e.currentTarget).find('select[name="RoleID"]').val(data.RoleID);
            //console.log(data.SiteID.length);
            var i;
            for (i = 0; i < data.SiteID.length; i++) { 
                $(e.currentTarget).find('input[name="SiteID[]"][value='+data.SiteID[i]+']').prop("checked",true);
            }
          });
    });

    $('#modal-delete-user').on('show.bs.modal', function (e) {
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
          <i class="fa fa-user"></i> Users
          <button data-toggle="modal" data-target="#modal-add-User" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>E-mail</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>E-mail</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach($getUsers as $items){?>
                  <tr>
                    <td><?php echo($items->Email);?></td>
                    <td><?php echo($items->Title." ".$items->FName." ".$items->LName);?></td>
                    <td><?php echo($items->RoleID);?></td>
                    <td>
                      <button data-id="<?php echo($items->Email);?>" data-toggle="modal" data-target="#modal-edit-user" class="btn btn btn-primary"><i class="fa fa-pencil"></i></button>
                      <button data-id="<?php echo($items->Email);?>" data-toggle="modal" data-target="#modal-delete-user" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                    </td>
                  </tr>
                <?php }?>
              
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
      <!-- Example DataTables Card-->

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

     <!-- Modal -->
    <div class="modal fade" id="modal-add-User" User="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Add New User</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
              <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" name="Email" placeholder="E-mail" required="">
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="FName" placeholder="First Name" required="">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="LName" placeholder="Last Name" required="">
              </div>
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="Title" placeholder="Title" required="">
              </div>
              <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="RoleID">
                  <?php foreach($getRoles as $items){?>
                    <option value="<?php echo($items->RoleID);?>"><?php echo($items->RoleID);?></option>
                  <?php }?>
                </select>
              </div>
              <div class="form-group">
                <label>Site</label>
                <div class="form-check checklist" >
                <?php foreach($getSites as $items){?>
                  <label class="form-check-label"><input name="SiteID[]" class="form-check-input" type="checkbox" value="<?php echo($items->SiteID);?>">
                    <?php echo($items->SiteName);?>
                  </label><br>
                <?php }?>
                </div>
              </div>
              <button type="submit" name="btnSubmitAdd" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save</button>
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
    <div class="modal fade" id="modal-edit-user" User="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Edit <div id="headerEmail"></div></h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
             <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" name="Email" placeholder="E-mail" required="" readonly="">
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="FName" placeholder="First Name" required="">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" name="LName" placeholder="Last Name" required="">
              </div>
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" name="Title" placeholder="Title" required="">
              </div>
              <div class="form-group">
                <label>Role</label>
                <select class="form-control" name="RoleID">
                  <?php foreach($getRoles as $items){?>
                    <option value="<?php echo($items->RoleID);?>"><?php echo($items->RoleID);?></option>
                  <?php }?>
                </select>
              </div>
              <div class="form-group">
                <label>Site</label>
                <div class="form-check checklist" >
                <?php foreach($getSites as $items){?>
                  <label class="form-check-label"><input name="SiteID[]" class="form-check-input" type="checkbox" value="<?php echo($items->SiteID);?>">
                    <?php echo($items->SiteName);?>
                  </label><br>
                <?php }?>
                </div>
              </div>
              <button type="submit" name="btnSubmitEdit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save</button>
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
    <div class="modal fade" id="modal-delete-user" User="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this User?</h5>
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
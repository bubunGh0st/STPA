<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script type="text/javascript" src="<?php echo(base_url());?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo(base_url());?>js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script>
$(document).ready(function() {

   $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
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
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo(site_url());?>/blank">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo(site_url());?>/Users">Users</a>
        </li>
      </ol>
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
                  <th>ID</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td>U00001</td>
                  <td>The Sys Admin</td>
                  <td>System Administrator</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-edit-user" class="btn btn btn-primary"><i class="fa fa-pencil"></i></button>
                    <button data-toggle="modal" data-target="#modal-delete-User" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>U00002</td>
                  <td>Dr. Terry Jeon</td>
                  <td>Staff</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-edit-user" class="btn btn btn-primary"><i class="fa fa-pencil"></i></button>
                    <button data-toggle="modal" data-target="#modal-delete-User" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>U00003</td>
                  <td>Dr. Steve Mckinlay</td>
                  <td>Staff</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-edit-user" class="btn btn btn-primary"><i class="fa fa-pencil"></i></button>
                    <button data-toggle="modal" data-target="#modal-delete-User" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
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
            <form User="form">
              <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" id="name" placeholder="E-mail">
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" id="name" placeholder="First Name">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" id="name" placeholder="Last Name">
              </div>
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" id="name" placeholder="Title">
              </div>
              <div class="form-group">
                <label>Role</label>
                <select class="form-control" id="sel1">
                  <option>R0001 - System Administrator</option>
                  <option>R0002 - Site Administrator</option>
                  <option>R1003 - Staff</option>
                </select>
              </div>
              <div class="form-group">
                <label>Site</label>
                <div class="form-check checklist" >
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> WelTec Petone</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> WelTec Wellington</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> Whitirea Porirua</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> Whitirea Paraparaumu</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> Victoria University Kelburn</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> Victoria University Vivian St</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save</button>
            </form>
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
            <h4>Edit User U00003 - Dr. Steve McKinlay</h4>
          </div>
          <div class="modal-body">
            <form User="form">
              <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" id="name" placeholder="E-mail" readonly="" value="steve@stpa.com">
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" id="name" placeholder="First Name" value="Steve">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" id="name" placeholder="Last Name" value="McKinlay">
              </div>
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" id="name" placeholder="Title" value="Dr.">
              </div>
              <div class="form-group">
                <label>Role</label>
                <select class="form-control" id="sel1">
                  <option>R0001 - System Administrator</option>
                  <option>R0002 - Site Administrator</option>
                  <option selected="">R1003 - Staff</option>
                </select>
              </div>
              <div class="form-group">
                <label>Site</label>
                <div class="form-check checklist" >
                  <label class="form-check-label"><input class="form-check-input" type="checkbox" checked=""> WelTec Petone</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> WelTec Wellington</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> Whitirea Porirua</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> Whitirea Paraparaumu</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> Victoria University Kelburn</label><br>
                  <label class="form-check-label"><input class="form-check-input" type="checkbox"> Victoria University Vivian St</label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save</button>
            </form>
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
    <div class="modal fade" id="modal-delete-User" User="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this User?</h5>
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
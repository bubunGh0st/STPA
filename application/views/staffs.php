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
          <a href="<?php echo(site_url());?>/Staffs">Staffs</a>
        </li>
      </ol>
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
                <tr>
                  <td>2123123</td>
                  <td>Dr. Terry Jeon</td>
                  <td>Weltec Petone</td>
                  <td>
                    <a class="btn btn-primary" href="<?php echo(site_url());?>/Staffs/detail/2123123"><i class="fa fa-fw fa-th-list"></i></a>
                    <button data-toggle="modal" data-target="#modal-delete-Staff" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>2123124</td>
                  <td>Dr. Steve McKinlay</td>
                  <td>Weltec Petone</td>
                  <td>
                    <a class="btn btn-primary" href="<?php echo(site_url());?>/Staffs/detail/2123124"><i class="fa fa-fw fa-th-list"></i></a>
                    <button data-toggle="modal" data-target="#modal-delete-Staff" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>2123126</td>
                  <td>Dr. Paul Bryant</td>
                  <td>Weltec Petone</td>
                  <td>
                    <a class="btn btn-primary" href="<?php echo(site_url());?>/Staffs/detail/2123126"><i class="fa fa-fw fa-th-list"></i></a>
                    <button data-toggle="modal" data-target="#modal-delete-Staff" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
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
            <form role="form">
              <div class="form-group">
                <label>E-mail</label>
                <input type="text" class="form-control" id="name" placeholder="E-mail">
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
                <label>Site</label>
                <select class="form-control" id="sel1">
                  <option>Weltec Petone</option>
                  <option>Weltec Wellington</option>
                  <option>Whitirea Porirua</option>
                </select>
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
    <div class="modal fade" id="modal-delete-Staff" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Staff?</h5>
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
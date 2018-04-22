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
          <a href="<?php echo(site_url());?>/Courses">Courses</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo(site_url());?>/Courses/detail/<?php echo($id);?>">IT6256 - Logical Database Design</a>
        </li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-graduation-cap"></i> IT6256 - Logical Database Design
          <button class="btn btn btn-secondary float-right"><i class="fa fa-pencil"></i></button>
          <button class="btn btn btn-primary float-right"><i class="fa fa-save"></i></button>
        </div>
        <div class="card-body">
          <form role="form">
              <div class="form-group">
                <label>Course ID</label>
                <input type="text" class="form-control" id="name" placeholder="Task Name" value="IT6256">
              </div>
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" placeholder="Task Name" value="Logical Database Design">
              </div>
             
              <div class="form-group">
                <label>Site</label>
                <select class="form-control" id="sel1">
                  <option>Weltec Petone</option>
                  <option>Weltec Wellington</option>
                  <option>Whitirea Porirua</option>
                </select>
              </div>
            </form>
        </div>
      </div>


      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-graduation-cap"></i> Trimesters
          <button data-toggle="modal" data-target="#modal-add-staff" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered"  width="100%" cellspacing="0">
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
                  <th>Start</th>
                  <th>Finish</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td>July of 2017</td>
                  <td>12 July 2017</td>
                  <td>11 Nov 2017</td>
                  <td>
                    COMPLETED
                  </td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-primary" disabled><i class="fa fa-check-square-o"></i></button>
                    <button data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-danger" disabled><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>March of 2018</td>
                  <td>5 Mar 2018</td>
                  <td>25 Jun 2018</td>
                  <td>
                    ACTIVE
                  </td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-primary" disabled><i class="fa fa-check-square-o"></i></button>
                    <button data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-danger" disabled><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>July of 2018</td>
                  <td>15 Jul 2018</td>
                  <td>25 Nov 2018</td>
                  <td>
                    INACTIVE
                  </td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-primary"><i class="fa fa-check-square-o"></i></button>
                    <button data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>July of 2019</td>
                  <td>15 Jul 2019</td>
                  <td>25 Nov 2019</td>
                  <td>
                    INACTIVE
                  </td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-primary"><i class="fa fa-check-square-o"></i></button>
                    <button data-toggle="modal" data-target="#modal-delete-staff" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
    <div class="modal fade" id="modal-add-staff" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Assign Staff</h4>
          </div>
          <div class="modal-body">
            <form role="form">
              <div class="form-group">
                <label>Staff</label>
                <select class="form-control" id="sel1">
                  <option>Chalinor Baliuag</option>
                  <option>Paul Bryant</option>
                  <option>John Gould</option>
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
    <div class="modal fade" id="modal-delete-staff" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to remove this staff from course?</h5>
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

   
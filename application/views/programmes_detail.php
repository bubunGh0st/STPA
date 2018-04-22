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
          <a href="<?php echo(site_url());?>/programmes">Programmes</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo(site_url());?>/programmes/detail/<?php echo($id);?>">HV1111 - Graduate Diploma of IT</a>
        </li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-graduation-cap"></i> HV1111 - Graduate Diploma of IT
          <button class="btn btn btn-secondary float-right"><i class="fa fa-pencil"></i></button>
          <button class="btn btn btn-primary float-right"><i class="fa fa-save"></i></button>
        </div>
        <div class="card-body">
          <form role="form">
              <div class="form-group">
                <label>Programme ID</label>
                <input type="text" class="form-control" id="name" placeholder="Task Name" value="HV1111">
              </div>
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" placeholder="Task Name" value="Graduate Diploma of IT">
              </div>
             
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="description" placeholder="Description"></textarea>
              </div>
            </form>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>


      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-flask"></i> Courses
          <button data-toggle="modal" data-target="#modal-add-course" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td>IT6256</td>
                  <td>Logical Database Design</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-course" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>IT6268</td>
                  <td>Project Management</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-course" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>IT7320</td>
                  <td>Software Development & Testing</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-course" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-calendar"></i> Period
          <button data-toggle="modal" data-target="#modal-add-period" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Start</th>
                  <th>Finish</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Start</th>
                  <th>Finish</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td>March 2018</td>
                  <td>5 Mar 2018</td>
                  <td>25 June 2018</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-period" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>March 2018</td>
                  <td>5 Mar 2018</td>
                  <td>25 June 2018</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-period" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>March 2018</td>
                  <td>5 Mar 2018</td>
                  <td>25 June 2018</td>
                  <td>
                    <button data-toggle="modal" data-target="#modal-delete-period" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
    <div class="modal fade" id="modal-add-course" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Assign Course</h4>
          </div>
          <div class="modal-body">
            <form role="form">
              <div class="form-group">
                <label>Course</label>
                <select class="form-control" id="sel1">
                  <option>IT6256 - Logical Database Design</option>
                  <option>IT7320 Software Development & Testing</option>
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
    <div class="modal fade" id="modal-delete-course" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to remove this course from programme?</h5>
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

    <!-- Modal -->
    <div class="modal fade" id="modal-add-period" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Add Period</h4>
          </div>
          <div class="modal-body">
            <form role="form">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" placeholder="Task Name">
              </div>
              <div class="form-group">
                <label>Start/Due</label>
                <div class="clear"></div>
                <input type="text" readonly class="form_datetime form-control btn-50-left">
                <input type="text" readonly class="form_datetime form-control btn-50-right">
                <div class="clear"></div>
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
    <div class="modal fade" id="modal-delete-period" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this period?</h5>
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
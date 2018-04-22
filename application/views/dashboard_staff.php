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
          <a href="<?php echo(site_url());?>/Dashboard_staff">Staff Dashboard</a>
        </li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-flask"></i> Courses Trimester
          <button data-toggle="modal" data-target="#modal-add-course-trimester" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Trimester</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Trimester</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <tr>
                  <td>IT6256</td>
                  <td>Logical Database Design</td>
                  <td>March 2018</td>
                  <td>
                    <a class="btn btn-primary" href="<?php echo(site_url());?>/courses/detail_staff/000001"><i class="fa fa-fw fa-wrench"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>IT6268</td>
                  <td>Project Management</td>
                  <td>March 2018</td>
                  <td>
                    <a class="btn btn-primary" href="<?php echo(site_url());?>/courses/detail_staff/000002"><i class="fa fa-fw fa-wrench"></i></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>

      
      <!-- Example DataTables Card-->

     <!-- Modal -->
    <div class="modal fade" id="modal-add-course-trimester" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Available Course Trimester</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-content">
            <div class="card-body">
              <form>
              
                <div class="form-group">
                  <div class="form-check checklist" >
                    <label class="form-check-label"><input class="form-check-input" type="checkbox"> IT7320 - Software Dev & Testing</label><br>
                    <label class="form-check-label"><input class="form-check-input" type="checkbox"> IT7421 - Incident Response & Com Sec</label><br>
                    <label class="form-check-label"><input class="form-check-input" type="checkbox"> IT7251 - Project</label><br>
                    <label class="form-check-label"><input class="form-check-input" type="checkbox"> IT7252 - Advance Database Design</label><br>
                    <label class="form-check-label"><input class="form-check-input" type="checkbox"> IT6111 - Human Interface Tech</label><br>
                  </div>
                </div>
                <button class="btn btn-primary btn-block"><i class="fa fa-fw fa-plus"></i> Add</button>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
            <button class="btn btn-danger" type="button" data-dismiss="modal"><i class="fa fa-trash"></i> Delete</button>
          </div>
        </div>
      </div>
    </div>
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
        <li class="breadcrumb-item">
          <a href="<?php echo(site_url());?>/courses/detail_staff/<?php echo($id);?>">IT6256 - Logical Database Design - March 2018</a>
        </li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-flask"></i> IT6256 - Logical Database Design
              <button data-toggle="modal" data-target="#modal-add-reading" class="btn btn btn-primary float-right"><i class="fa fa-save"></i></button>
              <button data-toggle="modal" data-target="#modal-add-reading" class="btn btn btn-secondary float-right"><i class="fa fa-pencil"></i></button>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm"><strong>Course ID</strong></div>
            <div class="col-sm">IT6256</div>
          </div>
          <div class="row">
            <div class="col-sm"><strong>Name</strong></div>
            <div class="col-sm">Logical Database Design</div>
          </div>
          <div class="row">
            <div class="col-sm"><strong>Current Period</strong></div>
            <div class="col-sm">5 March 2018 - 20 June 2018</div>
          </div>
          <div class="row">
            <div class="col-sm"><strong>Current Lecturers</strong></div>
            <div class="col-sm">Terry Jeon, Steve McKinlay</div>
          </div>
          <div class="row">
            <div class="col-sm"><strong>Status</strong></div>
            <div class="col-sm">ACTIVE</div>
          </div>
        </div>
      </div>

      <div class="row">

        <!-- Example DataTables Card-->
        <div class="col-sm-6">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-file-text-o"></i> Assignments
              <button data-toggle="modal" data-target="#modal-add-assignment" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
            </div>

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Due</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Name</th>
                      <th>Due</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td>Assignment 1</td>
                      <td>1 Apr 2018<br>[5 hours]</td>
                      <td>
                        <a class="btn btn-primary" href="<?php echo(site_url());?>/assignments/detail_staff/000001"><i class="fa fa-fw fa-th-list"></i></a>
                        <button data-toggle="modal" data-target="#modal-delete-assignment" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>Assignment 2</td>
                      <td>5 May 2018<br>[5 hours]</td>
                      <td>
                        <a class="btn btn-primary" href="<?php echo(site_url());?>/assignments/detail_staff/000002"><i class="fa fa-fw fa-th-list"></i></a>
                        <button data-toggle="modal" data-target="#modal-delete-assignment" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                    <tr>
                      <td>Assignment 3</td>
                      <td>30 May 2018<br>[5 hours]</td>
                      <td>
                        <a class="btn btn-primary" href="<?php echo(site_url());?>/assignments/detail_staff/000003"><i class="fa fa-fw fa-th-list"></i></a>
                        <button data-toggle="modal" data-target="#modal-delete-assignment" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-clock-o"></i> Time Distribution
            </div>

            <div class="card-body">
             <form>
                  <div class="form-group">
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Percentage of Full Time/Week</label>
                        <select class="form-control" id="sel1">
                          <option>12.5% (1/8 Time)</option>
                          <option>25% (1/4 Time)</option>
                          <option>50% (1/2 Time)</option>
                          <option>100% (Full Time)</option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label>Number of Weeks</label>
                        <input class="form-control" type="number" aria-describedby="nameHelp" placeholder="Number of Weeks" min=1 max=13 value="12">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="col-md-6">
                        <label>Total Hours/Week</label>
                        <input class="form-control" type="number" aria-describedby="nameHelp" value="5" readonly="">
                      </div>
                      <div class="col-md-6">
                        <label>Total Hours</label>
                        <input class="form-control" type="number" aria-describedby="nameHelp" value="60" readonly="">
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
                              <td>Assignments</td>
                              <td></td>
                              <td align="right">
                                15
                              </td>
                            </tr>
                            <tr>
                              <td>Readings</td>
                              <td><input class="form-control" style="width: 50px;" type="number" value="1"></td>
                              <td align="right">
                                12
                              </td>
                            </tr>
                            <tr>
                              <td>Contacts</td>
                              <td><input class="form-control" style="width: 50px;" type="number" value="2"></td>
                              <td align="right">
                                24
                              </td>
                            </tr>
                            <tr>
                              <td>Exam</td>
                              <td></td>
                              <td align="right">
                                3
                              </td>
                            </tr>
                            <tr>
                              <td>Revision Time</td>
                              <td align="right">0.5</td>
                              <td align="right">6</td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th colspan="2">Total Hours</th>
                              <td align="right">60</td>
                            </tr>
                           
                          </tfoot>
                        </table>
                      </div>
                     
                    </div>
                  </div>
                  
                </form>
              </div>
          </div>
        </div>

    
      </div>
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
            <h4>Add New Assignment</h4>
          </div>
          <div class="modal-body">
            <form role="form">
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="name" placeholder="Task Name">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" id="description" placeholder="Description"></textarea>
              </div>
              <div class="form-group">
                <label>Course</label>
                <input type="text" class="form-control" id="name" placeholder="Task Name" value="IT6256 - Logical Database Design" readonly="">
              </div>
              <div class="form-group">
                <label>Due</label>
                <div class="clear"></div>
                <input type="text" readonly class="form_datetime form-control">
                <div class="clear"></div>
              </div>
              <div class="form-group">
                <label>Hours to Complete</label>
                <input type="number" class="form-control" id="hour" placeholder="Hours to Complete">
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
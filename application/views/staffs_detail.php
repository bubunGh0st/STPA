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
        <li class="breadcrumb-item">
          <a href="<?php echo(site_url());?>/Staffs/detail/<?php echo($id);?>">2123123 - Terry Jeon</a>
        </li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-graduation-cap"></i> 2123123 - Terry Jeon
          <button class="btn btn btn-secondary float-right"><i class="fa fa-pencil"></i></button>
          <button class="btn btn btn-primary float-right"><i class="fa fa-save"></i></button>
        </div>
        <div class="card-body">
          <form role="form">
              <div class="form-group">
                <label>Staff ID</label>
                <input type="text" class="form-control" id="name" placeholder="Task Name" value="2123123">
              </div>
              <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" id="name" value="Terry">
              </div>
              <div class="form-group">
                <label>Last Name</label>
                <input type="text" class="form-control" id="name" value="Jeon">
              </div>
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control" id="name" value="">
              </div>
              <div class="form-group">
                <label>Gender</label>
                <label class="radio-inline"><input type="radio" name="optradio">M</label>
                <label class="radio-inline"><input type="radio" name="optradio">F</label>
              </div>
             
            </form>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>


     
      <!-- Example DataTables Card-->

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

 
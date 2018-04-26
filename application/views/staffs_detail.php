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
        ?>alert("Successfully updated staff.");<?php
      }
    }
    ?>
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
     
      <!-- Example DataTables Card-->

      <?php echo form_open_multipart();?>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-group"></i> <?php echo($getStaff->Email);?> - <?php echo($getStaff->Title);?> <?php echo($getStaff->FName);?> <?php echo($getStaff->LName);?>
            <button class="btn btn btn-primary float-right" name="btnSubmit" type="submit"><i class="fa fa-save"></i></button>
          </div>
          <div class="card-body">
                <div class="form-group">
                  <label>E-mail</label>
                  <input type="text" class="form-control" name="Email" readonly="" value="<?php echo($getStaff->Email);?>">
                </div>
                <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" name="FName" value="<?php echo($getStaff->FName);?>" required="">
                </div>
                <div class="form-group">
                  <label>Last Name</label>
                  <input type="text" class="form-control" name="LName" value="<?php echo($getStaff->LName);?>" required>
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" class="form-control" name="Title" value="<?php echo($getStaff->Title);?>" required>
                </div>
                <div class="form-group">
                  <label>Site</label>
                  <select class="form-control" name="SiteID">
                    <?php foreach($getUserSite as $items){?>
                      <option value="<?php echo($items->SiteID);?>" <?php if($items->SiteID==$getStaff->SiteID)echo("selected");?> ><?php echo($items->SiteName);?></option>
                    <?php }?>
                  </select>
                </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
      <?php echo form_close()?>


     
      <!-- Example DataTables Card-->

    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

 
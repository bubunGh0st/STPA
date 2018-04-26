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
        ?>alert("Successfully updated course.");<?php
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
      <!-- Example DataTables Card-->

      <?php echo form_open_multipart();?>
        <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-flask"></i> <?php echo($getCourse->CourseCode);?> - <?php echo($getCourse->CourseName);?>
            <button class="btn btn btn-primary float-right" name="btnSubmit" type="btnSubmit"><i class="fa fa-save"></i></button>
          </div>
          <div class="card-body">
                <div class="form-group">
                  <label>Course Code</label>
                  <input type="text" class="form-control" name="CourseCode" placeholder="Course Code" value="<?php echo($getCourse->CourseCode);?>">
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" name="CourseName" placeholder="Course Name" value="<?php echo($getCourse->CourseName);?>">
                </div>
               
                <div class="form-group">
                  <label>Site</label>
                  <select class="form-control" name="SiteID">
                    <?php foreach($getUserSite as $items){?>
                      <option value="<?php echo($items->SiteID);?>" <?php if($items->SiteID==$getCourse->SiteID)echo("selected");?>>
                        <?php echo($items->SiteName);?>  
                      </option>
                    <?php }?>
                  </select>
                </div>
          </div>
        </div>
      <?php echo form_close()?>


      
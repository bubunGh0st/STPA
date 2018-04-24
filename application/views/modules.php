<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<script>
<?php 
if($_GET["warning"]!=NULL){
  if($_GET["warning"]==2){
    ?>alert("Invalid ID");<?php
  }else if($_GET["warning"]==4){
    ?>alert("Module Updated");<?php
  }
}
?>

$('#modal-edit-Module').on('show.bs.modal', function (e) {

    //get data-id attribute of the clicked element
    var ModuleID = $(e.relatedTarget).data('id');
    var ModuleName = $(e.relatedTarget).data('id');

    //populate the textbox
    $(e.currentTarget).find('input[name="ModuleID"]').val(ModuleID);
    //var x = document.getElementById("proid").value; alert("pid"+x);

});

</script>

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
          <a href="<?php echo(site_url());?>/Modules">Modules</a>
        </li>
      </ol>
      <!-- Example DataTables Card-->

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-sitemap"></i> Modules
          <button data-toggle="modal" data-target="#modal-add-Module" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
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
                <?php foreach($getModules as $items){?>
                  <tr>
                    <td><?php echo($items->ModuleID);?></td>
                    <td><?php echo($items->ModuleName);?></td>
                    <td>
                      <button id="<?php echo($items->ModuleID);?>" data-toggle="modal" data-target="#modal-edit-Module" class="btn btn btn-primary"><i class="fa fa-pencil"></i></button>
                      <input type="hidden" name="">
                      <button id="<?php echo($items->ModuleID);?>" data-toggle="modal" data-target="#modal-delete-Module" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
    <div class="modal fade" id="modal-add-Module" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Add New Module</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
              <div class="form-group">
                <label>Module Name</label>
                <input type="text" name="ModuleName" class="form-control" id="name" placeholder="Enter Module Name">
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

    <div class="modal fade" id="modal-edit-Module" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Edit Modules</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
              <div class="form-group">
                <label>Module ID</label>
                <input type="text" class="form-control" name="ModuleID" id="name" placeholder="Task Name" value="M0001" readonly>
              </div>
              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="ModuleName" id="name" placeholder="Task Name" value="Modules">
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
    <div class="modal fade" id="modal-delete-Module" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Module?</h5>
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
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


<script>
  $(document).ready(function(){

    <?php 
    if(isset($_GET["warning"])){
      if($_GET["warning"]==1){
        ?>alert("Cannot delete this site, site is used by user or course");<?php
      }else if($_GET["warning"]==2){
        ?>alert("Successfully updated site");<?php
      }
    }
    ?>

    $('#modal-edit-Site').on('show.bs.modal', function (e) {
        var SiteID = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="SiteID"]').val(SiteID);
         $.post("<?php echo(site_url('Site/getSite'));?>",
          {
              SiteID: SiteID,
              dataType: 'json'
          },
          function(data, status){
            $(e.currentTarget).find('input[name="SiteName"]').val(data.SiteName);
            $(e.currentTarget).find('textarea[name="Address"]').val(data.Address);
            $(e.currentTarget).find('input[name="Contact"]').val(data.Contact);
          });
    });

    $('#modal-delete-Site').on('show.bs.modal', function (e) {
        var SiteID = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="SiteID"]').val(SiteID);
    });
});
</script>

<script type="text/javascript" src="<?php echo(base_url());?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo(base_url());?>js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>


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

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-bank"></i> Sites
          <button data-toggle="modal" data-target="#modal-add-site" class="btn btn btn-primary float-right"><i class="fa fa-plus"></i></button>
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
                <?php foreach($getSites as $items){?>
                  <tr>
                    <td><?php echo($items->SiteID);?></td>
                    <td><?php echo($items->SiteName);?></td>
                    <td>
                      <button data-id="<?php echo($items->SiteID);?>" data-toggle="modal" data-target="#modal-edit-Site" class="btn btn btn-primary"><i class="fa fa-pencil"></i></button>
                      <button data-id="<?php echo($items->SiteID);?>" data-toggle="modal" data-target="#modal-delete-Site" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                      
                    </td>
                  </tr>
                <?php }?>
                
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
    <div class="modal fade" id="modal-add-site" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Add New Site</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
              <div class="form-group">
                <label>Site Name</label>
                <input type="text" name="SiteName" class="form-control" id="name" placeholder="Enter Site Name">
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea name="Address" class="form-control" id="name" placeholder="Enter Address"></textarea>
              </div>
              <div class="form-group">
                <label>Contact</label>
                <input type="text" name="Contact" class="form-control" id="name" placeholder="Enter Contact">
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

    <div class="modal fade" id="modal-edit-Site" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Edit Site</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
              <div class="form-group">
                <label>Site ID</label>
                <input type="text" class="form-control" name="SiteID" id="name"  readonly>
              </div>
                <div class="form-group">
                <label>Site Name</label>
                <input type="text" name="SiteName" class="form-control" id="name" placeholder="Enter Site Name">
              </div>
              <div class="form-group">
                <label>Address</label>
                <textarea name="Address" class="form-control" id="name" placeholder="Enter Address"></textarea>
              </div>
              <div class="form-group">
                <label>Contact</label>
                <input type="text" name="Contact" class="form-control" id="name" placeholder="Enter Contact">
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
    <div class="modal fade" id="modal-delete-Site" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete this Site?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <?php echo form_open_multipart();?>
              <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
              <button name="btnSubmitDelete" class="btn btn-danger" type="submit"><i class="fa fa-trash"></i> Delete</button>
              <input type="hidden" name="SiteID" value="">
            <?php echo form_close()?>
          </div>
        </div>
      </div>
    </div>
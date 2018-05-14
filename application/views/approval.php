<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->model('ApprovalModel');
?>

<script type="text/javascript" src="<?php echo(base_url());?>js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo(base_url());?>js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>

<script>
$(document).ready(function() {

    <?php 
    if(isset($_GET["warning"])){
      if($_GET["warning"]==1){
        ?>alert("Successfully approve Site Admin registration, Invitation E-mail is sent.");<?php
      }else if($_GET["warning"]==2){
        ?>alert("Rejected Site Admin registration.");<?php
      }
    }
    ?>
     $('#dataTable').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
     

    $('#modal-reject-user').on('show.bs.modal', function (e) {
        var Email = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="Email"]').val(Email);
    });
    $('#modal-approve-user').on('show.bs.modal', function (e) {
        var Email = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="Email"]').val(Email);
    });

     $('#modal-add-user-site').on('show.bs.modal', function (e) {
        var Email = $(e.relatedTarget).data('id');
        $(e.currentTarget).find('input[name="Email"]').val(Email);
         
    });
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

      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-check"></i> Site Admin Approval
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Site</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Site</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
              <tbody>
                <?php 
                foreach($getApprovalList as $items){?>
                  <tr 
                  <?php if($items->Status=="ACTIVE-RESET")echo("style='background:lightgreen';");?>
                  <?php if($items->Status=="REJECTED")echo("style='background:pink';");?>
                  >
                    <td><?php echo($items->Title);?> <?php echo($items->FName);?> <?php echo($items->LName);?></td>
                    <td><?php echo($items->Email);?></td>
                    <td>
                      <?php 
                      $getuserSite=$CI->ApprovalModel->getUserSite($items->Email);
                      foreach ($getuserSite as $itemsSite) {
                        echo($itemsSite->SiteName."<br>");
                      }

                      if(!empty($items->SiteSuggestion)){
                        echo("<br>");
                        echo("[".$items->SiteSuggestion."]");
                        echo("<br>");
                        echo("<a data-id='".$items->Email."' class='text-primary' data-toggle='modal' data-target='#modal-add-user-site'>Add New Sites <i class='fa fa-plus'></i></a>");
                      }
                      ?>
                    </td>
                    <td><?php echo($items->Status);?></td>
                    <td>
                      <?php if($items->Status=="WAIT-APPROVAL"){?>
                        <?php if(!empty($getuserSite)){?>
                          <button data-id="<?php echo($items->Email);?>" data-toggle="modal" data-target="#modal-approve-user" class="btn btn btn-primary"><i class="fa fa-check"></i></button>
                        <?php }?>
                        <button data-id="<?php echo($items->Email);?>" data-toggle="modal" data-target="#modal-reject-user" class="btn btn-danger"><i class="fa fa-ban"></i></button>
                      <?php }?>
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
    <div class="modal fade" id="modal-approve-user" User="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to approve this user as Site Admin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <?php echo form_open_multipart();?>
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
            <button class="btn btn-primary" type="submit" name="btnSubmitApprove"><i class="fa fa-check"></i> Approve</button>
            <input type="hidden" name="Email" value="">
            <?php echo form_close()?>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-reject-user" User="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Are you sure to reject this user as Site Admin?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <?php echo form_open_multipart();?>
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
            <button class="btn btn-danger" type="submit" name="btnSubmitReject"><i class="fa fa-ban"></i> Reject</button>
            <input type="hidden" name="Email" value="">
            <?php echo form_close()?>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-add-user-site" User="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Add New Site for user</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
              <input type="hidden" class="form-control" name="Email" placeholder="E-mail" required="">
              <div class="form-group">
                <label>Site Name</label>
                <input type="text" class="form-control" name="SiteName" placeholder="Site Name" required="">
              </div>
              <button type="submit" name="btnSubmitAddSite" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Save</button>
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
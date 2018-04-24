<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>


  <div class="content-wrapper">
    <div class="container-fluid">

     <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-user-o"></i> Profile
          <button data-toggle="modal" data-target="#modal-change-password" class="btn btn btn-primary float-right"><i class="fa fa-refresh"></i> Change Password</button>
        </div>
        <div class="card-body">
          <?php echo form_open_multipart();?>
            <div class="form-group">
              <label>E-mail</label>
              <input type="email" name="Email" class="form-control" placeholder="E-mail" value="<?php echo($this->session->userdata['Email']);?>"readonly="">
            </div>
            <div class="form-group">
              <div class="form-row">
               <div class="col-md-6">
                  <label>First name</label>
                  <input class="form-control" name="FName" type="text" aria-describedby="nameHelp" placeholder="Enter first name" value="<?php echo($this->session->userdata['FName']);?>" required="">
                </div>
                <div class="col-md-6">
                  <label>Last name</label>
                  <input class="form-control" name="LName" type="text" aria-describedby="nameHelp" placeholder="Enter last name" value="<?php echo($this->session->userdata['LName']);?>">
                </div>
                <div class="col-md-6">
                  <label>Title</label>
                  <input class="form-control" name="Title" type="text" aria-describedby="nameHelp" placeholder="Enter title" value="<?php echo($this->session->userdata['Title']);?>">
                </div>
              </div>
            </div>
            <button type="submit" name="btnSubmit" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> Change Profile</button>
          <?php echo form_close()?>
        </div>
        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
      </div>
    </div>
   
   <!-- Modal -->
    <div class="modal fade" id="modal-change-password" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header text-center">
            <h4>Change Password</h4>
          </div>
          <div class="modal-body">
            <?php echo form_open_multipart();?>
              <div class="form-group">
                <label>Current Password</label>
                <input type="Password" name="currentPassword" class="form-control" id="cpass" placeholder="Current Password">
              </div>
              <div class="form-group">
                <label>New Password</label>
                <input type="Password" name="newPassword" class="form-control" id="npass" placeholder="New Password">
              </div>
              <div class="form-group">
                <label>Confirm New Password</label>
                <input type="Password" name="confirmPassword" class="form-control" id="cnpass" placeholder="Confirm New Password">
              </div>
              <button type="submit" name="btnSubmitPass" class="btn btn-primary btn-block"><i class="fa fa-refresh"></i> Change Password</button>
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
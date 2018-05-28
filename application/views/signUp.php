<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
<?php 
if($_GET["warning"]!=NULL){
  if($_GET["warning"]==1){
    ?>alert("Invalid E-mail or no Site selected");<?php
  }
}
?>
</script>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register as Site Admin</div>
      <div class="card-body">
        <?php echo form_open_multipart();?>

          <div class="form-group">
            As a site admin, you are responsible to maintain the course and staff data on your institution
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label>First name</label>
                <input class="form-control" name="FName" type="text" aria-describedby="nameHelp" placeholder="Enter first name" required="">
              </div>
              <div class="col-md-6">
                <label>Last name</label>
                <input class="form-control" name="LName" type="text" aria-describedby="nameHelp" placeholder="Enter last name" required="">
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6">
                <label>Title</label>
                <input class="form-control" name="Title" type="text" aria-describedby="nameHelp" placeholder="Enter title" required="">
              </div>
              <div class="col-md-6">
                <label>Email address</label>
                <input class="form-control" name="Email" type="email" aria-describedby="emailHelp" placeholder="Enter email" required="">
              </div>
            </div>
          </div>

          <div class="form-group">

            <div class="form-row">
              <div class="col-md-6">
                  <label>Site <i data-toggle="modal" data-target="#modal-site-info" class="fa fa-question-circle text-danger" title="Please contact administrator if you do not find your site."></i></label>
                  <div class="form-check checklist" >
                  <?php foreach($getSites as $items){?>
                    <label class="form-check-label"><input class="form-check-input" name="SiteID[]" value="<?php echo($items->SiteID);?>"  type="checkbox"><?php echo($items->SiteName);?></label><br>
                  <?php }?>
                  </div>
                </div>

                <div class="col-md-6">
                  <label>Site Name Suggestion</label>
                  <textarea class="form-control" name="SiteSuggestion" placeholder="Enter your site name suggestions" ></textarea>

                </div>
              </div>

          </div>


          <button class="btn btn-primary btn-block" name="btnSubmit" href="<?php echo(site_url());?>/signIn"><i class="fa fa-fw fa-user-plus"></i> Register</button>
        <?php echo form_close()?>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo(site_url());?>/signIn">Back To Sign In Page</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo(base_url());?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo(base_url());?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="<?php echo(base_url());?>vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

<!-- Modal -->
    <div class="modal fade" id="modal-site-info" User="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Please contact administrator if you do not find your site. Phone: 0123456789</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-remove"></i> Cancel</button>
          </div>
        </div>
      </div>
    </div>

</html>

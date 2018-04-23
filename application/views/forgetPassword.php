<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script>
<?php 
if($_GET["warning"]!=NULL){
  if($_GET["warning"]==1){
    ?>alert("Invalid E-mail");<?php
  }
}
?>

</script>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <?php echo form_open_multipart();?>
          <div class="form-group">
            <input class="form-control" name="Email" type="email" aria-describedby="emailHelp" placeholder="Enter E-mail">
          </div>
          <button name="btnSubmit" class="btn btn-primary btn-block"><i class="fa fa-fw fa-refresh"></i> Reset Password</button>
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

</html>

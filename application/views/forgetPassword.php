<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <div class="text-center mt-4 mb-5">
          <h4>Forgot your password?</h4>
          <p>Enter your email address and we will send you instructions on how to reset your password.</p>
        </div>
        <form>
          <div class="form-group">
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email address">
          </div>
          <a class="btn btn-primary btn-block" href="<?php echo(site_url());?>/signIn"><i class="fa fa-fw fa-refresh"></i> Reset Password</a>
        </form>
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

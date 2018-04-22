<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header"><i class="fa fa-fw fa-gears"></i> STP Admin</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label>E-mail</label>
            <input class="form-control" type="email" aria-describedby="emailHelp" name="Email" placeholder="Enter E-mail">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" type="password" name="Password" placeholder="Enter Password">
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="btnSubmit"><i class="fa fa-fw fa-sign-in"></i>Sign In</button>
          <!-- <a class="btn btn-primary btn-block" href="<?php// echo(site_url());?>/blank"><i class="fa fa-fw fa-sign-in"></i> Sign In</a> -->
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="<?php echo(site_url());?>/signUp">Sign Up as Site Admin</a>
          <a class="d-block small" href="<?php echo(site_url());?>/forgetPassword">Forget Password?</a>
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

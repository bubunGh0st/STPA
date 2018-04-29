<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->model('ModulesModel');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>STP Admin</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo(base_url());?>images/favicon.ico" />
  <!-- Bootstrap core CSS-->
  <link href="<?php echo(base_url());?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="<?php echo(base_url());?>vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="<?php echo(base_url());?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?php echo(base_url());?>css/sb-admin.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Angular JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo(base_url());?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo(base_url());?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <style>
    .card{
      border:1px solid #999;
    }
    .checklist{
      height: 150px;
      overflow-y: scroll;
      border:1px solid #ccc;
      border-radius: 5px;
      padding: 25px;
    }
  </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="<?php echo(site_url());?>/blank"><i class="fa fa-fw fa-gears"></i> STP Admin</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

        <?php if($CI->ModulesModel->isGranted(array("M0001"))){ ?>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Profile">
            <a class="nav-link" href="<?php echo(site_url());?>/profile">
              <i class="fa fa-fw fa-user-circle-o"></i>
              <span class="nav-link-text"><?php echo($this->session->userdata['Title']." ".$this->session->userdata['FName']." ".$this->session->userdata['LName']);?></span>
            </a>
          </li>
        <?php }?>

        <?php if($CI->ModulesModel->isGranted(array("M0002","M0003","M0004","M0005","M0009"))){?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="System Administration">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#system-administration" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-gears"></i>
            <span class="nav-link-text">System Administration</span>
          </a>
          <ul class="sidenav-second-level collapse" id="system-administration">

            <?php if($CI->ModulesModel->isGranted(array("M0002"))){ ?>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Modules">
                <a href="<?php echo(site_url());?>/modules">
                  <i class="fa fa-fw fa-sitemap"></i>
                  <span class="nav-link-text">Modules</span>
                </a>
              </li>
            <?php }?>


            <?php if($CI->ModulesModel->isGranted(array("M0003"))){ ?>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Roles">
                <a href="<?php echo(site_url());?>/roles">
                  <i class="fa fa-fw fa-group"></i>
                  <span class="nav-link-text">Roles</span>
                </a>
              </li>
            <?php }?>

            <?php if($CI->ModulesModel->isGranted(array("M0004"))){ ?>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Users">
                <a href="<?php echo(site_url());?>/users">
                  <i class="fa fa-fw fa-user"></i>
                  <span class="nav-link-text">Users</span>
                </a>
              </li>
            <?php }?>

            <?php if($CI->ModulesModel->isGranted(array("M0009"))){ ?>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Site">
                <a href="<?php echo(site_url());?>/site">
                  <i class="fa fa-fw fa-bank"></i>
                  <span class="nav-link-text">Site</span>
                </a>
              </li>
            <?php }?>

            <?php if($CI->ModulesModel->isGranted(array("M0005"))){ ?>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Approval">
                <a href="<?php echo(site_url());?>/approval">
                  <i class="fa fa-fw fa-check"></i>
                  <span class="nav-link-text">Approval</span>
                </a>
              </li>
            <?php }?>
            
          </ul>
        </li>
        <?php }?>

        <?php if($CI->ModulesModel->isGranted(array("M0006","M0007"))){?>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Site Administration">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#site-administration" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-gear"></i>
            <span class="nav-link-text">Site Administration</span>
          </a>
          <ul class="sidenav-second-level collapse" id="site-administration">
            <!--<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Programmes">
              <a href="<?php echo(site_url());?>/programmes">
                <i class="fa fa-fw fa-graduation-cap"></i>
                <span class="nav-link-text">Programmes</span>
              </a>
            </li>-->
            <?php if($CI->ModulesModel->isGranted(array("M0006"))){ ?>
              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Courses">
                <a href="<?php echo(site_url());?>/courses">
                  <i class="fa fa-fw fa-flask"></i>
                  <span class="nav-link-text">Courses</span>
                </a>
              </li>
            <?php }?>

            <?php if($CI->ModulesModel->isGranted(array("M0007"))){ ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Staffs">
              <a href="<?php echo(site_url());?>/staffs">
                <i class="fa fa-fw fa-group"></i>
                <span class="nav-link-text">Staffs</span>
              </a>
            </li>
            <?php }?>

          </ul>
        </li>
        <?php }?>

        <?php if($CI->ModulesModel->isGranted(array("M0008"))){ ?>
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Staff Menu">
            <a class="nav-link" href="<?php echo(site_url());?>/dashboard_staff">
              <i class="fa fa-fw fa-th-large"></i>
              <span class="nav-link-text">Staff Menu</span>
            </a>
          </li>
        <?php }?>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Sign Out</a>
        </li>
      </ul>
    </div>
  </nav>
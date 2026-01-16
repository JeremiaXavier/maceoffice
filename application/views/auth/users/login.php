<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?= APP_NAME ?> </title>
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta property="og:title" content="" />
  <meta property="og:type" content="" />
  <meta property="og:url" content="" />
  <meta property="og:image" content="" />
 <!-- Favicon -->
 <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>assets/admin/imgs/theme/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/admin/imgs/theme/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>assets/admin/imgs/theme/favicon-16x16.png">

  <!-- Template CSS -->
  <link href="<?= base_url() ?>assets/admin/css/main.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body class="dark">
  <main>
    <header class="main-header style-2 navbar">
      <div class="col-brand">
        <a href="<?= base_url() ?>" class="brand-wrap">
          <!-- <img src="<?= base_url() ?>assets/admin/imgs/theme/logo.svg" class="logo" alt="<?= APP_NAME ?> Dashboard" /> -->
          <h1><span class="text-primary">MACE</span> Office - Employees</h1>

        </a>
      </div>
      <div class="col-nav">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
          </li>
          <li class="nav-item">
            <a href="#" title="Fullscreen" class="requestfullscreen nav-link btn-icon"><i class="material-icons md-cast"></i></a>
          </li>


        </ul>
      </div>
    </header>
    <section class="content-main mt-20 ">
      <div class="card mx-auto card-login">
        <div class="card-body">


          <div id="alert-message-div" style="display: none; padding: 0% 3%;">
          </div>

          <h4 class="card-title mb-4">Sign in as an <a href="#">Employee</a></h4>
          <?php echo form_open(base_url('users/save_login'), 'class="row g-3 needs-validation" id="login-forms" autocomplete="off" '); ?>

          <div class="mb-3">
            <input class="form-control" name="user_name" id="user_name" placeholder="Username or email" type="text" />
          </div>
          <!-- form-group// -->
          <div class="mb-3">
            <input class="form-control" name="user_password" id="user_password" placeholder="Password" type="password" />
          </div>
          <!-- form-group// -->
          <!-- form-group// -->
          <div class="col-12 mt--30 text-center">
            <div class="check-box">
              <div class="g-recaptcha" data-sitekey="<?php echo $this->config->item('google_key') ?>"></div>
            </div>

            <span class="text-white">Refresh captcha? <a class="" onclick="grecaptcha.reset()" id="refresh_button" style="cursor: pointer;color:#96c952">Click here
                <i class="fas fa-sync" aria-hidden="true"></i></a></span>
          </div>
          <!-- form-group// -->
          <div class="mb-3">
            <a href="#" class="float-end font-sm text-muted mb-2">Forgot password?</a>
          </div>
          <!-- form-group form-check .// -->
          <div class="mb-4">

            <div class="progress progress-md" style="display: none;width: 100%">
              <div class="progress-bar bg-success progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
          </div>
          <!-- form-group// -->
          <?php echo form_close(); ?>


        </div>
      </div>
    </section>
    <footer class="main-footer text-center">
      <p class="font-xs">
        <script>
          document.write(new Date().getFullYear());
        </script>
        &copy; <a target="_blank" href="https://nexcode.in/" class="link">Nexcode</a> -<?= APP_NAME ?> Admin portal .
        All rights reserved

      </p>
    </footer>
  </main>
  <script src="<?= base_url() ?>assets/admin/js/vendors/jquery-3.6.0.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/js/vendors/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/js/vendors/jquery.fullscreen.min.js"></script>
  <!-- Main Script -->
  <script src="<?= base_url() ?>assets/admin/js/main.js" type="text/javascript"></script>

  <script src="<?= base_url() ?>assets/auth/scripts.js"></script>



  <style>
    .internet-connection-status {
      display: none;
      position: fixed;
      background-color: transparent;
      width: 100%;
      height: 32px;
      z-index: 99999;
      text-align: center;
      color: #ffffff;
      bottom: 0;
      left: 0;
      right: 0;
      line-height: 32px;
      font-weight: 700;
      font-size: 12px;
    }
  </style>


</body>

</html>
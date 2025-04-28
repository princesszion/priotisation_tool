<!DOCTYPE html>
<html lang="en">

<head>
  <title>Africa CDC Prioritisation Tool</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="<?php echo setting()->site_description; ?>" />
  <meta name="robots" content="noindex">
  <meta name="author" content="Africa CDC" />

  <!-- Favicon icon -->
  <link href="<?php echo base_url() ?>assets/img/favicon.png" rel="icon">

  <!-- Fontawesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/fonts/fontawesome/css/fontawesome-all.min.css">
  <!-- Animation CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/animation/css/animate.min.css">
  <!-- Style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">

         <!-- Lobibox CSS -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/notifications/css/lobibox.min.css" />
  <style>
    body {
      background: url('<?php echo base_url(); ?>assets/images/image_cdc.jpg') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
      padding: 0;
    }

    .auth-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      padding: 1rem;

    }

    .card {
      background-color: #ffffffee;
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
      text-align: center;
      padding: 2rem;
    }

    .card-body img {
      margin-bottom: 1.5rem;
      width: 220px;
    }



    .btn-success {
      width: 100%;
      border-radius: 30px;
    }

    .checkbox label {
      margin-left: 8px;
    }
  </style>
</head>

<body>

  <div class="auth-wrapper">
    <div class="auth-content container">
      <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
          <div class="card">
            <div class="card-body">
              <h4 class="mb-3 f-w-400">Africa CDC Research Priotisation Tool</h4>
              
              <img src="<?php echo base_url() ?>assets/images/logo.png" alt="Africa CDC Logo" class="img-fluid">
              <h5 class="mb-3 f-w-400">Sign In</h5>
              <?php echo form_open_multipart(base_url('auth/login'), array('id' => 'filetypes', 'class' => 'filetypes')); ?>

              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="email" name="email" class="form-control" placeholder="Email address" required>
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <input type="hidden" name="route"
                  value="<?php echo $this->uri->segment(1) ?>/<?php echo $this->uri->segment(2) ?>">
              </div>


              <div class="form-group text-left mt-2">
                <div class="checkbox checkbox-primary d-inline">
                  <input type="checkbox" name="remember_me" id="checkbox-fill-a1" >
                  <label for="checkbox-fill-a1" class="cr"> Save credentials</label>
                </div>
              </div>

              <button class="btn btn-success mb-4">Login</button>

              </form>

              <p class="mb-2 text-muted">Forgot password?
                <!-- <a href="<?php echo base_url('auth/reset-password'); ?>" class="f-w-400">Reset</a> -->
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Required JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="<?php echo base_url() ?>assets/plugins/notifications/js/lobibox.min.js"></script>
  <script src="<?php echo base_url() ?>assets/plugins/notifications/js/notifications.min.js"></script>

  <script>
    $(document).ready(function () {
      <?php if ($this->session->flashdata('error_message')): ?>
        Lobibox.notify('error', {
          pauseDelayOnHover: true,
          continueDelayOnInactiveTab: false,
          position: 'top center',
          icon: 'fa fa-times-circle',
          msg: "<?php echo ($this->session->flashdata('error_message')); ?>"
        });
      <?php endif; ?>

      <?php if ($this->session->flashdata('success_message')): ?>
        Lobibox.notify('success', {
          pauseDelayOnHover: true,
          position: 'top center',
          icon: 'fa fa-check-circle',
          msg: "<?php echo ($this->session->flashdata('success_message')); ?>"
        });
      <?php endif; ?>
    });
  </script>

</body>

</html>
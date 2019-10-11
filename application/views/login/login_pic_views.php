<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login PIC &mdash; Daily Activity Sales</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?php echo base_url('dist/')?>assets/jne/logo.png" alt="logo" width="180" class="">
            </div>
            <!-- validasi -->
            <?php if($this->session->flashdata('pesan1')) {?>
                <div class="alert alert-warning" role="alert">
                    <h4>Peringatan!</h4>
                    <?php echo $this->session->flashdata('pesan1'); ?>
                </div>
            <?php }elseif($this->session->flashdata('pesan2')) {?>
                <div class="alert alert-warning" role="alert">
                    <h4>Ada Kesalahan!</h4>
                    <?php echo $this->session->flashdata('pesan2'); ?>
                </div>
            <?php }; ?>
            <div class="card card-primary">
              <div class="card-header"><h4>Login DCA | PIC Mode</h4></div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url('pic/login_pic/proses_login'); ?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="nip">NIP</label>
                    <input id="nip" type="text" class="form-control" name="nip" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your NIP
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                      <!-- <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a>
                      </div> -->
                    </div>
                    <input id="password" type="password" class="form-control" name="pass" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                      
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                    <br>
                    <a href="#"><span>Lupa Password?</span></a>
                  </div>
                </form>
                <!-- <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Login With Social</div>
                </div>
                <div class="row sm-gutters">
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-facebook">
                      <span class="fab fa-facebook"></span> Facebook
                    </a>
                  </div>
                  <div class="col-6">
                    <a class="btn btn-block btn-social btn-twitter">
                      <span class="fab fa-twitter"></span> Twitter
                    </a>                                
                  </div>
                </div> -->

              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> -->
            <div class="simple-footer">
              Copyright &copy; 2018
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?php echo base_url('dist/')?>assets/modules/jquery.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/popper.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/tooltip.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/moment.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/js/stisla.js"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="<?php echo base_url('dist/')?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/js/custom.js"></script>
</body>
</html>
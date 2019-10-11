
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?php echo base_url('dist/')?>assets/modules/jquery-selectric/selectric.css">

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
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
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
            <div class="text-center">
              <a href="" class="btn btn-danger btn-lg btn-block" tabindex="4"><i class="fab fa-google-plus-g"></i> Daftar Dengan Google+</a>
              <label class="mt-2 mb-2">Atau</label>
            </div>
            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="<?php echo base_url('register/proses_daftar'); ?>">

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="nama_lengkap">Nama Lengkap</label>
                      <input id="nama_lengkap" type="text" class="form-control" name="nama_lengkap" autofocus required>
                    </div>
                    <div class="form-group col-6">
                      <label for="nama_korporat">Nama Korporat</label>
                      <input id="nama_korporat" type="text" class="form-control" name="nama_korporat" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="no_tlp">Nomor Handphone</label>
                    <input id="no_tlp" type="text" class="form-control" name="no_tlp" maxlength="13" required>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea id="alamat" name="alamat" class="form-control" required></textarea>
                    <div class="invalid-feedback">
                    </div>
                  </div>

                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Daftar
                    </button>
                    <br>
                    <span>Sudah mempunyai Akun ? <a href="<?php echo base_url(); ?>"><strong>Login</strong></span></a>
                  </div>

                </form>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Stisla 2018
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
  <script src="<?php echo base_url('dist/')?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="<?php echo base_url('dist/')?>assets/js/page/auth-register.js"></script>
  
  <!-- Template JS File -->
  <script src="<?php echo base_url('dist/')?>assets/js/scripts.js"></script>
  <script src="<?php echo base_url('dist/')?>assets/js/custom.js"></script>
</body>
</html>
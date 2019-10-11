      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Pengaturan Desain Kuisioner</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Kuisioner</div>
              <div class="breadcrumb-item">Atur Kuisioner</div>
            </div>
          </div>
          <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
          <div class="text-left">
              <a class="btn btn-dark" href="<?php echo base_url('admin/kuisioner')?>" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-reply"></i> Kembali<!--  Kembali --></button></a>
          </div>
          <br>
          <div class="row">
            <div class="col-md-12">
              

            </div>              
          </div>
        </section>
      </div>


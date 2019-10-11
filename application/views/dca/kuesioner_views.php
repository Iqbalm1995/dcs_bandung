      <!-- Main Content -->
      <?php foreach ($detailDCA as $read1) { ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Remark "<?php echo $read1->remark; ?>"</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">DCA</div>
              <div class="breadcrumb-item">Remark</div>
            </div>
          </div>
            <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
          <div class="row">
            <div class="col-md-8">
              <!-- Start Control -->
              <a class="btn btn-dark tombolfull" href="<?php echo base_url('admin/dca')?>" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-reply"></i> Kembali</button></a>
              <!-- End Control -->
              <form method="POST" action="<?php echo base_url('admin/dca/simpanKsrn'); ?>">
                <div class="card mt-3">
                  <div class="card-header">
                    <h4>Kuesioner DCA</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-sm" width="100%">
                        <thead>
                        <tr>
                          <th width="3%"  class="text-center">No.</th>
                          <th  class="text-center">Pertanyaan</th>
                          <th width="30%"  class="text-center">Jawaban</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php 
                          $no = 1;
                          foreach ($getKSRN as $read){ 
                          ?>
                        <tr>
                          <td class="text-center"><?php echo $no; ?></td>
                          <input type="hidden" name="dca_id<?php echo $read->id_pertanyaan; ?>" value="<?php echo $read1->id; ?>">
                          <td>
                            <?php echo $read->isi_pertanyaan; ?>
                            <input type="hidden" name="pertanyaan_id<?php echo $read->id_pertanyaan; ?>" value="<?php echo $read->id_pertanyaan; ?>">
                          </td>
                          <td class="text-center">
                            <div class="selectgroup w-100">
                              <label class="selectgroup-item">
                                <input type="radio" name="ksrn<?php echo $read->id_pertanyaan; ?>" value="1" class="selectgroup-input" required>
                                <span class="selectgroup-button">1</span>
                              </label>
                              <label class="selectgroup-item">
                                <input type="radio" name="ksrn<?php echo $read->id_pertanyaan; ?>" value="2" class="selectgroup-input" required>
                                <span class="selectgroup-button">2</span>
                              </label>
                              <label class="selectgroup-item">
                                <input type="radio" name="ksrn<?php echo $read->id_pertanyaan; ?>" value="3" class="selectgroup-input" required>
                                <span class="selectgroup-button">3</span>
                              </label>
                              <label class="selectgroup-item">
                                <input type="radio" name="ksrn<?php echo $read->id_pertanyaan; ?>" value="4" class="selectgroup-input" required>
                                <span class="selectgroup-button">4</span>
                              </label>
                            </div>
                            
                          </td>
                        </tr>
                        <?php 
                          $no++; }; ?>
                        </tbody>
                      </table>
                    </div>
                    <hr>
                    <h5>Kritik Dan Saran</h5>
                    <input type="hidden" name="id_dca" value="<?php echo $read1->id; ?>">
                    <textarea name="saran_ksrn" class="form-control" placeholder="Tulis kritik atau saran untuk pelayanan ini..." required></textarea>
                  </div>
                  <div class="card-footer text-right">
                    <button class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">
                      <i class="fas fa-save"></i> Simpan</button>
                  </div>
                </div>
              </form>



            </div>

            <div class="col-md-4">
              <!-- body -->
              <div class="card">
                <div class="card-header">
                  <h4>Detail</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <?php foreach ($dataDCA as $read2) { ?>
                    <table class="table table-sm" width="100%">
                        <tr>
                          <td colspan="2">
                            <h5>Identitas</h5>
                          </td>
                        </tr>
                        <!-- <tr>
                            <td class="text-right" style="width: 120px;"><strong>ID Customer :</strong></td>
                            <td>&nbsp; <span id="detail_id"><?php echo $read1->id; ?></span></td>
                        </tr> -->
                        <tr>
                            <td class="text-right"><strong>Nama Korporat :</strong></td>
                            <td>&nbsp; <span id="detail_nama_korporat"><?php echo $read2->nama_korporat; ?></span></td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <h5>Keperluan</h5>
                          </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Dengan PIC Sales :</strong></td>
                            <td>&nbsp; <span id="detail_nama"><?php echo $read2->nama; ?></span></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Agenda :</strong></td>
                            <td>&nbsp; <span id="detail_nama_agenda"><?php echo $read2->nama_business; ?></span></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Bisnis :</strong></td>
                            <td>&nbsp; <span id="detail_nama_business"><?php echo $read2->nama_agenda; ?></span></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Remark :</strong></td>
                            <td>&nbsp; <span id="detail_remark"><?php echo $read1->remark; ?></span></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Time Sign :</strong></td>
                            <td>&nbsp; <span id="detail_time_sign"><?php echo $read1->time_sign; ?></span></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Tanggal Buat :</strong></td>
                            <td>&nbsp; <span id="detail_created_date"><?php echo $read1->created_date; ?></span></td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>No. MOM :</strong></td>
                            <td>&nbsp; <span id="detail_no_mom"><?php echo $read1->no_mom; ?>
                        <tr>
                          <td colspan="2">
                            <h5>Aktivitas</h5>
                          </td>
                        </tr>
                        <tr>
                            <td class="text-right"><strong>Status :</strong></td>
                            <?php  
                                switch ($read1->status_activity) {
                                  case 'WAIT':
                                    $status_m = '<div class="badge badge-warning">WAIT</div>';
                                    break;
                                  case 'ACCEPTED':
                                    $status_m = '<div class="badge badge-success">ACCEPTED</div>';
                                    break;
                                  case 'PROGRESS':
                                    $status_m = '<div class="badge badge-info">PROGRESS</div>';
                                    break;
                                  case 'DONE':
                                    $status_m = '<div class="badge badge-primary">DONE</div>';
                                    break;
                                  case 'RESCHEDULING':
                                    $status_m = '<div class="badge badge-light">RESCHEDULING</div>';
                                    break;
                                  
                                  default:
                                    $status_m = '<div class="badge badge-danger">CANCEL</div>';
                                    break;
                                }
                            ?>
                            <td>&nbsp; <span id="detail_status_activity"><?php echo $status_m; ?></span></td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <br>
                            <div id="btnRemark"></div>
                          </td>
                        </tr>
                    </table>
                    <?php }; ?>
                  </div>
                </div>
              </div>

            </div>              
          </div>
        </section>
      </div>
      <!-- Script -->
      <script type="text/javascript">
        var save_method; //for save method string

        $(document).ready(function() {

          //set input/textarea/select event when change value, remove class error and remove text help block 
          $("input").change(function(){
              $(this).parent().parent().removeClass('has-error');
              $(this).next().empty();
          });
          $("textarea").change(function(){
              $(this).parent().parent().removeClass('has-error');
              $(this).next().empty();
          });
          $("select").change(function(){
              $(this).parent().parent().removeClass('has-error');
              $(this).next().empty();
          });

        });

      </script>


      <?php }; ?>


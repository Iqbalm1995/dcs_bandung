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
            <div class="col-md-12">
              <!-- Start Control -->
              <a class="btn btn-dark tombolfull" href="<?php echo base_url('admin/dca')?>" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-reply"></i> Kembali</button></a>
              <!-- End Control -->
              <div class="card mt-3">
                <div class="card-header">
                  <h4>Detail DCA</h4>
                  <div class="card-header-action">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-plus"></i></a>
                  </div>
                </div>
                <div class="collapse hide" id="mycard-collapse">
                  <div class="card-body">
                    <div class="table-responsive">
                      <?php foreach ($dataDCA as $read2) { ?>
                      <table class="table table-sm" width="100%">
                          <tr>
                            <td colspan="2">
                              <h4>Identitas</h4>
                            </td>
                          </tr>
                          <!-- <tr>
                              <td class="text-right" style="width: 170px;"><strong>ID Customer :</strong></td>
                              <td>&nbsp; <span id="detail_id"><?php echo $read1->id; ?></span></td>
                          </tr> -->
                          <tr>
                              <td class="text-right"><strong>Nama Korporat :</strong></td>
                              <td>&nbsp; <span id="detail_nama_korporat"><?php echo $read2->nama_korporat; ?></span></td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <h4>Keperluan</h4>
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
                              <h4>Aktivitas</h4>
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
                        <th width="20%"  class="text-center">Jawaban</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $no = 1;
                        foreach ($hasilKsrn as $r){ 
                        ?>
                      <tr>
                        <td class="text-center"><?php echo $no; ?></td>
                        <td>
                          <?php 
                          $pertanyaan_data     = $this->dca->get_id_val($r->pertanyaan_id,'dcs_pertanyaan_ksrn');
                          echo  $pertanyaan_data['isi_pertanyaan']; 

                          ?>
                        </td>
                        <td class="text-center">
                          <b>
                            <?php 
                              switch ($r->jawaban) {
                                case '2':
                                  echo '<div class="badge badge-warning">Tidak Baik</div>';
                                  break;
                                case '3':
                                  echo '<div class="badge badge-primary">Baik</div>';
                                  break;
                                case '4':
                                  echo '<div class="badge badge-info">Sangat Baik</div>';
                                  break;
                                
                                default:
                                  echo '<div class="badge badge-danger">Sangat Tidak Baik</div>';
                                  break;
                              } 
                            ?>
                          </b>
                        </td>
                      </tr>
                      <?php 
                        $no++; }; ?>
                      </tbody>
                    </table>
                  </div>
                  <hr>
                  <h5>Kritik Dan Saran</h5>
                  <div class="section-title mt-3">Kritik dan Saran</div>
                  <blockquote><?php echo $read1->saran_ksrn; ?></blockquote>
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


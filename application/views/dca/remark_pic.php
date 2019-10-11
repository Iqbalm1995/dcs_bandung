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
              <a class="btn btn-dark tombolfull" href="<?php echo base_url('pic/dca')?>" data-toggle="tooltip" data-placement="bottom" title="Kembali"><i class="fas fa-reply"></i> Kembali</button></a>
              <button class="btn btn-primary tombolfull" onclick="add_remark()" data-toggle="tooltip" data-placement="bottom" title="Tambah Aktivitas Remark">
              <i class="fas fa-plus"></i> Tambah Aktivitas</button>
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
                          <tr>
                              <td class="text-right" style="width: 170px;"><strong>ID Customer :</strong></td>
                              <td>&nbsp; <span id="detail_id"><?php echo $read1->id; ?></span></td>
                          </tr>
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
              <div class="section-body">
                <h2 class="section-title">Aktivitas Remark</h2>
                <div class="row">
                  <div class="col-12">
                    <div class="activities">
                      <?php   
                        date_default_timezone_set('Asia/Jakarta');
                        if(count($detailRemark)>0)
                        {
                            foreach ($detailRemark as $row) { 
                      ?>
                      <!-- Start -->
                      <div class="activity">
                        <div class="activity-icon bg-primary text-white shadow-primary">
                          <i class="fas fa-comment-alt"></i>
                        </div>
                        <!-- Aktivitas -->
                        <div class="activity-detail">
                          <div class="mb-2">
                            <h6><?php echo $row->title; ?></h6>
                            <span class="text-job text-primary">Start</span>
                            <span class="text-job"><?php echo $row->start_remark; ?></span>
                            <span class="text-job">/</span>
                            <span class="text-job text-danger">End</span>
                            <span class="text-job"><?php echo $row->end_remark; ?></span>
                            &nbsp;
                            <div class="float-right dropdown">
                              <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                              <div class="dropdown-menu">
                                <div class="dropdown-title">Aksi</div>
                                <a href="javascript:void(0)" onclick="delete_dca(<?php echo $row->id; ?>)" class="dropdown-item has-icon text-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                              </div>
                            </div>
                          </div>
                          <p><?php echo $row->desc; ?></p>
                        </div>
                      </div>
                      <!-- End -->
                      <?php }
                      } else {?>
                        <div class="alert alert-light alert-has-icon">
                          <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                          <div class="alert-body">
                            <div class="alert-title">Perhatian</div>
                            Saat ini belum ada aktivitas.
                          </div>
                        </div>
                      <?php }; ?>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            

            <div class="col-md-4">
              <!-- body -->
              <div class="card">
                <div class="card-header">
                  <h4>Penilaian Pelayanan</h4>
                </div>
                <div class="card-body">
                  <?php 
                  $get_ksrn     = array('dca_id' => $read1->id);
                  $cekKsrn      = $this->dca->cek($get_ksrn,'dcs_kuisioner')->result();
                    if ($cekKsrn) {?>
                  
                    <!-- <h5>Anda sudah mengisi kuesioner</h5> -->
                    <a href="<?php echo base_url().'pic/dca/result_angket/'.$read1->id; ?>" class="btn btn-primary btn-lg btn-block"><i class="ion-ios-arrow-right"></i> Hasil Kuisioner Pelayanan</a>

                  <?php  } else { ?>

                    <h5 class="text-danger">Kuseioner Belum Diisi Oleh Customer</h5>

                    <!-- <div class="section-title mt-0">Kuisioner</div>
                    <a href="<?php echo base_url().'pic/dca/kuesioner/'.$read1->id; ?>" class="btn btn-primary btn-lg btn-block"><i class="ion-ios-arrow-right"></i> Hasil Kuisioner Pelayanan</a> -->

                  <?php  } ?>
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

        function add_remark()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Tambah Aktivitas Remark'); // Set Title to Bootstrap modal title

        }

        function delete_dca(id)
        {
            if(confirm('Apakah anda yakin akan menghapus data ini?'))
            {
                // ajax delete data to database
                $.ajax({
                    url : "<?php echo site_url('admin/remark/ajax_delete')?>/"+id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        //if success reload ajax table
                        document.location = "<?php echo base_url('admin/dca/remark/')?>" + <?php echo $read1->id; ?>;
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Gagal menghapus data');
                    }
                });

            }
        }

        function save()
        {
            $('#btnSave').text('Menyimpan...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;

            if(save_method == 'add') {
                url = "<?php echo site_url('admin/remark/ajax_add')?>";
            }

            // ajax adding data to database
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) //if success close modal and reload ajax table
                    {
                        document.location = "<?php echo base_url('admin/dca/remark/')?>" + <?php echo $read1->id; ?>;
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                    $('#btnSave').text('Simpan'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 


                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error Menambah / Mengedit Data');
                    $('#btnSave').text('Simpan'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 

                }
            });
        }

      </script>

      <!-- Bootstrap modal -->
      <div class="modal fade" id="modal_form" role="dialog">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body form">
                      <form action="#" id="form" class="form-horizontal">
                          <input type="hidden" value="" name="id"/> 
                          <input type="hidden" value="<?php echo $read1->id; ?>" name="dca_id"/> 
                          <div class="form-body">
                              <div class="form-group">
                                  <label class="control-label col-md-6">Judul</label>
                                  <div class="col-md-12">
                                    <input type="text" name="title" class="form-control">
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-6">Deskripsi</label>
                                  <div class="col-md-12">
                                      <textarea name="desc" class="form-control"></textarea>
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-6">Waktu Mulai-Selesai</label>
                                    <div class="col-md-12">
                                      <div class="row">

                                        <div class="col-md-6 mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-clock"></i>&nbsp;Mulai
                                                    </div>
                                                </div>
                                                <input type="text" name="start_remark" class="form-control timepicker" placeholder="hh:mm PM/AM">
                                            </div>
                                            <span class="help-block"></span>
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="fas fa-clock"></i>&nbsp;Selesai
                                                    </div>
                                                </div>
                                                <input type="text" name="end_remark" class="form-control timepicker" placeholder="hh:mm PM/AM">
                                            </div>
                                            <span class="help-block"></span>
                                        </div>
                                      </div>
                                    </div>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Batal">
                      <i class="fas fa-times"></i></button>
                      <button type="button" id="btnSave" onclick="save()" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Simpan">
                      <i class="fas fa-save"></i> Simpan</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Bootstrap modal -->


      <?php }; ?>


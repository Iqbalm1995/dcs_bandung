
      <style type="text/css">
        #modal_form { overflow-y:scroll };
        #modal_customer { overflow-y:scroll };
        #modal_pic { overflow-y:scroll };
      </style>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>DCA</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">DCA</div>
            </div>
          </div>

            <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
            <div class="text-center">
                <button class="btn btn-primary" onclick="add_dca()" data-toggle="tooltip" data-placement="bottom" title="Tambah DCA">
                    <i class="fas fa-plus"></i><!--  Tambah --></button>
                <!-- <a class="btn btn-primary tombolfull" role="button" href="<?php echo base_url('customer/form');?>">
                  <i class="glyphicon glyphicon-open-file"></i> Import Data
                </a> -->
                <button class="btn btn-light" onclick="reload_table()" data-toggle="tooltip" data-placement="bottom" title="Muat Ulang Tabel">
                    <i class="fas fa-sync-alt"></i><!--  Refresh --></button>
                <button class="btn btn-info" onclick="modal_cari()" data-toggle="tooltip" data-placement="bottom" title="Pencarian Lengkap">
                    <i class="fas fa-search"></i><!--  Pencarian --></button>
            </div>
            <br>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <!-- <div class="card-header">
                    <h4>Advanced Table</h4>
                  </div> -->
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table" width="100%">
                        <thead>
                          <tr>
                            <th class="text-center">
                              No.
                            </th>
                            <th>Korporat</th>
                            <th>Business</th>
                            <th>Time Sign</th>
                            <th>PIC</th>
                            <th>Agenda</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Korporat</th>
                                <th>Business</th>
                                <th>Time Sign</th>
                                <th>PIC</th>
                                <th>Agenda</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <script type="text/javascript">

              var save_method; //for save method string
              var table;
              var base_url = '<?php echo base_url();?>';

              $(document).ready(function() {

                  //datatables
                  table = $('#table').DataTable({ 

                      "processing": true, //Feature control the processing indicator.
                      "serverSide": true, //Feature control DataTables' server-side processing mode.
                      "order": [], //Initial no order.

                      // Load data for the table's content from an Ajax source
                      "ajax": {
                          "url": "<?php echo site_url('dca/ajax_list')?>",
                          "type": "POST",
                          "data": function ( data ) {
                              data.nama_korporat    = $('#fil_korporat').val();
                              data.nama_business    = $('#fil_business').val();
                              data.time_sign        = $('#fil_sign').val();
                              data.nama             = $('#fil_nama').val();
                              data.nama_agenda      = $('#fil_agenda').val();
                              data.status_activity  = $('#fil_status').val();
                              data.no_mom           = $('#fil_mom').val();
                          }
                      },

                      //Set column definition initialisation properties.
                      "columnDefs": [
                          { 
                              "targets": [ 0 ], //first column
                              "orderable": false, //set not orderable
                          },
                          { 
                              "targets": [ -1 ], //last column
                              "orderable": false, //set not orderable
                          },

                      ],

                  });

                  table_pic = $('#table_pic').DataTable({ 

                      "processing": true,
                      "serverSide": true,
                      "order": [],

                      "ajax": {
                          "url": "<?php echo site_url('dca/pic_list')?>",
                          "type": "POST",
                          "data": function ( data ) {
                              data.nip = $('#fil_nip').val();
                              data.nama = $('#fil_nama').val();
                          }
                      },


                      "columnDefs": [
                          { 
                              "targets": [ 0 ],
                              "orderable": false,
                          },
                          { 
                              "targets": [ -1 ],
                              "orderable": false,
                          },

                      ],

                  });

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

                  //check all
                  $("#check-all").click(function () {
                      $(".data-check").prop('checked', $(this).prop('checked'));
                  });

                  $('#btn-filter').click(function(){ //button filter event click
                      table.ajax.reload();  //just reload table
                  });

                  $('#btn-reset').click(function(){ //button reset event click
                      $('#form-filter')[0].reset();
                      table.ajax.reload();  //just reload table
                  });

                  

              });

              function show_data_pic()
              {
                $('#modal_pic').modal('show');
                $('.modal-title').text('Data PIC Sales');

              }

              function pick_pic($pic_id, $pic_nama, $pic_nip)
              {
                document.getElementById("pic_id").value = $pic_id;
                document.getElementById("dataPIC").value = $pic_nama + '(' + $pic_nip + ')';
                  
                  // document.getElementById("from").value = $kode_dist;
                $('#modal_pic').modal('hide');
              }

              function reload_table()
              {
                  table.ajax.reload(null,false); //reload datatable ajax 
              }

              function modal_cari()
              {
                  $('#modal_cari').modal('show'); // show bootstrap modal
                  $('.modal-title').text('Pencarian Lengkap'); // Set Title to Bootstrap modal title

              }

              function add_dca()
              {
                  save_method = 'add';
                  $('#form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string

                  $('#modal_form').modal('show'); // show bootstrap modal
                  $('.modal-title').text('Tambah Daily Activity Sales'); // Set Title to Bootstrap modal title

              }

              function detail(id)
              {
                  $.ajax({
                      url : "<?php echo site_url('dca/ajax_detail')?>/" + id,
                      type: "GET",
                      dataType: "JSON",
                      success: function(data)
                      {
                          $('#detail_id').text(data.id);
                          $('#detail_nama_korporat').text(data.nama_korporat);
                          $('#detail_nama_business').text(data.nama_business);
                          $('#detail_time_sign').text(data.time_sign);
                          $('#detail_nama').text(data.nama);
                          $('#detail_nama_agenda').text(data.nama_agenda);
                          $('#detail_created_date').text(data.created_date);
                          if (data.remark) {
                            $('#detail_remark').text(data.remark);
                          }else{
                            $('#detail_remark').html('<span class="text-warning">Data Belum Ada</span>');
                          }
                          if (data.no_mom) {
                            $('#detail_no_mom').text(data.no_mom);
                          }else{
                            $('#detail_no_mom').html('<span class="text-warning">Data Belum Ada</span>');
                          }
                          
                          $('#detail_status_activity').text(data.status_activity);

                          if (data.status_activity == 'WAIT') {
                            $('#detail_status_activity').html('<div class="badge badge-warning">WAIT</div>');
                          }else if (data.status_activity == 'ACCEPTED') {
                            $('#detail_status_activity').html('<div class="badge badge-success">ACCEPTED</div>');
                            $('#btnRemark').html('<a href="<?php echo base_url('dca/remark/')?>'+ id +'" target="_blank"><button class="btn btn-primary btn-block btn-lg"><i class="ion-ios-arrow-right"></i> Detail Aktivitas DCA</button></a>');
                          }else if (data.status_activity == 'PROGRESS') {
                            $('#detail_status_activity').html('<div class="badge badge-info">PROGRESS</div>');
                            $('#btnRemark').html('<a href="<?php echo base_url('dca/remark/')?>'+ id +'" target="_blank"><button class="btn btn-primary btn-block btn-lg"><i class="ion-ios-arrow-right"></i> Detail Aktivitas DCA</button></a>');
                          }else if (data.status_activity == 'DONE') {
                            $('#detail_status_activity').html('<div class="badge badge-primary">DONE</div>');
                            $('#btnRemark').html('<a href="<?php echo base_url('dca/remark/')?>'+ id +'" target="_blank"><button class="btn btn-primary btn-block btn-lg"><i class="ion-ios-arrow-right"></i> Detail Aktivitas DCA</button></a>');
                          }else if (data.status_activity == 'RESCHEDULING') {
                            $('#detail_status_activity').html('<div class="badge badge-light">RESCHEDULING</div>');
                            $('#btnRemark').html('<a href="<?php echo base_url('dca/remark/')?>'+ id +'" target="_blank"><button class="btn btn-primary btn-block btn-lg"><i class="ion-ios-arrow-right"></i> Detail Aktivitas DCA</button></a>');
                          }else{
                            $('#detail_status_activity').html('<div class="badge badge-danger">CANCEL</div>');
                            $('#btnRemark').html('<a href="<?php echo base_url('dca/remark/')?>'+ id +'" target="_blank"><button class="btn btn-primary btn-block btn-lg"><i class="ion-ios-arrow-right"></i> Detail Aktivitas DCA</button></a>');
                          }

                          $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
                          $('.modal-title').text('Activity Sales'); // Set title to Bootstrap modal title


                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error Pada Saat Mengambil Data');
                      }
                  });
              }

              function edit_dca(id)
              {
                  save_method = 'update';
                  $('#form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string
                  // $('#pwd-container').hide();


                  //Ajax Load data from ajax
                  $.ajax({
                      url : "<?php echo site_url('dca/ajax_edit')?>/" + id,
                      type: "GET",
                      dataType: "JSON",
                      success: function(data)
                      {

                          $('[name="id"]').val(data.id);
                          $('[name="customer_id"]').val(data.customer_id);
                          $('[name="pic_id"]').val(data.pic_id);
                          $('[name="business_id"]').val(data.business_id);
                          $('[name="agenda_id"]').val(data.agenda_id);
                          $('[name="time_sign"]').val(data.time_sign);
                          $('[name="no_mom"]').val(data.no_mom);
                          $('[name="remark"]').val(data.remark);
                          $('[name="status_activity"]').val(data.status_activity);

                          // Get Detail
                          $.ajax({
                              url : "<?php echo site_url('dca/ajax_detail')?>/" + id,
                              type: "GET",
                              dataType: "JSON",
                              success: function(data)
                              {
                                  $('[name="dataCustomer"]').val(data.nama_korporat);
                                  $('[name="dataPIC"]').val(data.nama);
                              },
                              error: function (jqXHR, textStatus, errorThrown)
                              {
                                  alert('Error Pada Saat Mengambil Data');
                              }
                          });


                          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                          $('.modal-title').text('Ubah DCA'); // Set title to Bootstrap modal title

                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error Pada Saat Mengambil Data');
                      }
                  });
              }

              function save()
              {
                  $('#btnSave').text('Menyimpan...'); //change button text
                  $('#btnSave').attr('disabled',true); //set button disable 
                  var url;

                  if(save_method == 'add') {
                      url = "<?php echo site_url('dca/ajax_add')?>";
                  } else {
                      url = "<?php echo site_url('dca/ajax_update')?>";
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
                              document.location = "<?php echo base_url('dca')?>";
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
          </div>

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
                          <div class="alert alert-info">
                            Jika <b><i>Form</i></b> tidak <b><i>Scroll</i></b> ke bawah, maka tekan <b><i>"Tab"</i></b> untuk ke input selanjutnya
                            dan tekan <b><i>"Shift + Tab"</i></b> untuk input sebelumya.
                          </div>
                          <form action="#" id="form" class="form-horizontal">
                              <input type="hidden" value="" name="id"/> 
                              <div class="form-body">
                                  <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $this->session->userdata('id')?>">
                                  <h4>Keperluan</h4>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">PIC (Sales)</label>
                                      <div class="col-md-12">
                                        <div class="input-group">
                                            <input id="dataPIC" name="dataPIC" placeholder="Nama PIC Sales (NIP)" class="form-control" type="text" required>
                                            <span class="input-group-append">
                                                <button class="btn btn-info" type="button" onclick="show_data_pic()">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </span>
                                        </div>
                                        <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <input type="hidden" name="pic_id" id="pic_id">
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Bisnis</label>
                                      <div class="col-md-12">
                                          <select class="form-control" name="business_id">
                                            <option value="">-Pilih-</option>
                                            <?php foreach ($load_business as $r1){ ?>
                                                <option value="<?php echo $r1->id; ?>"><?php echo $r1->nama; ?></option>
                                            <?php }; ?>
                                          </select>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Agenda</label>
                                      <div class="col-md-12">
                                          <select class="form-control" name="agenda_id">
                                            <option value="">-Pilih-</option>
                                            <?php foreach ($load_agenda as $r2){ ?>
                                                <option value="<?php echo $r2->id; ?>"><?php echo $r2->nama; ?></option>
                                            <?php }; ?>
                                          </select>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Time Sign</label>
                                      <div class="col-md-12">
                                          <div class="input-group">
                                              <div class="input-group-prepend">
                                                  <div class="input-group-text">
                                                      <i class="fas fa-clock"></i>
                                                  </div>
                                              </div>
                                              <input type="text" name="time_sign" class="form-control timepicker">
                                          </div>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <h4>Keterangan</h4>
                                  <input type="hidden" name="status_activity" value="WAIT">
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Remark</label>
                                      <div class="col-md-12">
                                          <textarea name="remark" class="form-control"></textarea>
                                          <span class="help-block"></span>
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

          <!-- Bootstrap modal Detail-->
          <div class="modal fade" id="modal_detail" role="dialog">
              <div class="modal-dialog modal-md">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Detail Activity Sales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="table-responsive">
                              <table class="table table-sm" width="100%">
                                  <tr>
                                    <td colspan="2">
                                      <h4>Identitas</h4>
                                    </td>
                                  </tr>
                                  <tr>
                                      <td class="text-right" style="width: 170px;"><strong>ID Customer :</strong></td>
                                      <td>&nbsp; <span id="detail_id"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Nama Korporat :</strong></td>
                                      <td>&nbsp; <span id="detail_nama_korporat"></span></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2">
                                      <h4>Keperluan</h4>
                                    </td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Dengan PIC Sales :</strong></td>
                                      <td>&nbsp; <span id="detail_nama"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Agenda :</strong></td>
                                      <td>&nbsp; <span id="detail_nama_agenda"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Bisnis :</strong></td>
                                      <td>&nbsp; <span id="detail_nama_business"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Remark :</strong></td>
                                      <td>&nbsp; <span id="detail_remark"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Time Sign :</strong></td>
                                      <td>&nbsp; <span id="detail_time_sign"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Tanggal Buat :</strong></td>
                                      <td>&nbsp; <span id="detail_created_date"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>No. MOM :</strong></td>
                                      <td>&nbsp; <span id="detail_no_mom"></span></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2">
                                      <h4>Aktivitas</h4>
                                    </td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Status :</strong></td>
                                      <td>&nbsp; <span id="detail_status_activity"></span></td>
                                  </tr>
                                  <tr>
                                    <td colspan="2">
                                      <br>
                                      <div id="btnRemark"></div>
                                    </td>
                                  </tr>
                              </table>
                            </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- End Bootstrap modal -->


            <!-- Modal Cari -->
            <div class="modal fade" id="modal_cari" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Modal Cari</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body form">
                          <form id="form-filter" class="form-horizontal">
                              <div class="form-group">
                                  <label for="fil_korporat" class="col-sm-12 control-label">Nama Korporat</label>
                                  <div class="col-sm-12">
                                      <input type="text" name="fil_korporat" id="fil_korporat" class="form-control" placeholder="Nama Korporat">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_nama" class="col-sm-12 control-label">Nama PIC</label>
                                  <div class="col-sm-12">
                                      <input type="text" name="fil_nama" id="fil_nama" class="form-control" placeholder="Nama PIC Sales">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_sign" class="col-sm-12 control-label">Time Sign</label>
                                  <div class="col-sm-12">
                                      <div class="input-group">
                                          <div class="input-group-prepend">
                                              <div class="input-group-text">
                                                  <i class="fas fa-clock"></i>
                                              </div>
                                          </div>
                                          <input type="text" name="fil_sign" id="fil_sign" class="form-control timepicker">
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_business" class="col-sm-12 control-label">Tipe Bisnis</label>
                                  <div class="col-md-12">
                                      <select class="form-control" name="fil_business" id="fil_business">
                                        <option value="">-Pilih-</option>
                                        <?php foreach ($load_business as $r1){ ?>
                                            <option value="<?php echo $r1->nama; ?>"><?php echo $r1->nama; ?></option>
                                        <?php }; ?>
                                      </select>
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_agenda" class="col-sm-12 control-label">Tipe Agenda</label>
                                  <div class="col-md-12">
                                      <select class="form-control" name="fil_agenda" id="fil_agenda">
                                        <option value="">-Pilih-</option>
                                        <?php foreach ($load_agenda as $r2){ ?>
                                            <option value="<?php echo $r2->nama; ?>"><?php echo $r2->nama; ?></option>
                                        <?php }; ?>
                                      </select>
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_status" class="col-sm-12 control-label">Status Agenda DCA</label>
                                  <div class="col-sm-12">
                                      <select class="form-control" name="fil_status" id="fil_status">
                                        <option value="">-Pilih-</option>
                                        <option value="WAIT">WAIT</option>
                                        <option value="ACCEPTED">ACCEPTED</option>
                                        <option value="PROGRESS">PROGRESS</option>
                                        <option value="DONE">DONE</option>
                                        <option value="RESCHEDULING">RESCHEDULING</option>
                                        <option value="CANCEL">CANCEL</option>
                                      </select>
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btn-filter" class="btn btn-info" data-dismiss="modal" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Filter">
                          <i class="fas fa-filter"></i> Filter</button>
                            <button type="button" id="btn-reset" class="btn btn-default" data-dismiss="modal" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Reset">
                          <i class="fas fa-undo"></i> Reset</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal Cari -->
        </section>
      </div>

      <!-- PIC Modal -->
      <div class="modal fade" id="modal_pic" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body form">
                  <div class="table-responsive">
                      <table id="table_pic" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                          <thead>
                            <tr>
                              <th class="text-center">
                                No.
                              </th>
                              <th>NIP</th>
                              <th>Nama</th>
                              <th>Unit</th>
                              <th>Login Terakhir</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>

                          </tbody>
                      </table>
                  </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <i class="glyphicon glyphicon-remove"></i> Batal</button>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <!-- End PIC Modal -->

      <!-- Plugin -->
      


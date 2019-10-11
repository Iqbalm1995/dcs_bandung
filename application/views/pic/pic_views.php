      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Person In Charge</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">PIC</div>
            </div>
          </div>

            <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
            <div class="text-center">
                <button class="btn btn-primary" onclick="add_pic()" data-toggle="tooltip" data-placement="bottom" title="Tambah PIC">
                    <i class="fas fa-plus"></i><!--  Tambah --></button>
                <!-- <a class="btn btn-primary tombolfull" role="button" href="<?php echo base_url('customer/form');?>">
                  <i class="glyphicon glyphicon-open-file"></i> Import Data
                </a> -->
                <button class="btn btn-light" onclick="reload_table()" data-toggle="tooltip" data-placement="bottom" title="Muat Ulang Tabel">
                    <i class="fas fa-sync-alt"></i><!--  Refresh --></button>
                <button class="btn btn-info" onclick="modal_cari()" data-toggle="tooltip" data-placement="bottom" title="Pencarian Lengkap">
                    <i class="fas fa-search"></i><!--  Pencarian --></button>
                <button class="btn btn-danger" onclick="bulk_delete()" data-toggle="tooltip" data-placement="bottom" title="Bulk Hapus">
                    <i class="fas fa-trash"></i><!--  Bulk Hapus --></button>
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
                              <input type="checkbox" id="check-all">
                            </th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Unit</th>
                            <th>Status</th>
                            <th>Login Terakhir</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Unit</th>
                                <th>Status</th>
                                <th>Login Terakhir</th>
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
                          "url": "<?php echo site_url('admin/pic/ajax_list')?>",
                          "type": "POST",
                          "data": function ( data ) {
                              data.nip = $('#fil_nip').val();
                              data.nama = $('#fil_nama').val();
                              data.unit = $('#fil_unit').val();
                              data.pic_status = $('#fil_pic_sts').val();
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

              function reload_table()
              {
                  table.ajax.reload(null,false); //reload datatable ajax 
              }

              function modal_cari()
              {
                  $('#modal_cari').modal('show'); // show bootstrap modal
                  $('.modal-title').text('Pencarian Lengkap'); // Set Title to Bootstrap modal title

              }

              function add_pic()
              {
                  save_method = 'add';
                  $('#form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string

                  $('#modal_form').modal('show'); // show bootstrap modal
                  $('.modal-title').text('Tambah PIC'); // Set Title to Bootstrap modal title

              }

              function detail(id)
              {
                  $.ajax({
                      url : "<?php echo site_url('admin/pic/ajax_edit')?>/" + id,
                      type: "GET",
                      dataType: "JSON",
                      success: function(data)
                      {
                          $('#detail_id').text(data.id);
                          $('#detail_nip').text(data.nip);
                          $('#detail_nama').text(data.nama);
                          $('#detail_unit').text(data.unit);
                          if (data.no_tlp) {
                            $('#detail_no_tlp').text(data.no_tlp);
                          }else{
                            $('#detail_no_tlp').html('<span class="text-warning">Data Belum Ada</span>');
                          }
                          if (data.login_terakhir) {
                            $('#detail_login_terakhir').text(data.login_terakhir);
                          }else{
                            $('#detail_login_terakhir').html('<span class="text-warning">Data Belum Ada</span>');
                          }
                          
                          $('#detail_tgl_buat').text(data.tanggal_buat);
                          $('#detail_pic_sts').text(data.pic_status);

                          if (data.pic_status == 'APPROVED') {
                            $('#detail_pic_sts').html('<div class="badge badge-success">APPROVED</div>');
                          }else if (data.pic_status == 'BANNED'){
                            $('#detail_pic_sts').html('<div class="badge badge-danger">BANNED</div>');
                          }else{
                            $('#detail_pic_sts').html('<div class="badge badge-warning">WAIT</div>');
                          }

                          $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
                          $('.modal-title').text('Detail PIC'); // Set title to Bootstrap modal title


                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error Pada Saat Mengambil Data');
                      }
                  });
              }

              function edit_pic(id)
              {
                  save_method = 'update';
                  $('#form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string
                  // $('#pwd-container').hide();


                  //Ajax Load data from ajax
                  $.ajax({
                      url : "<?php echo site_url('admin/pic/ajax_edit')?>/" + id,
                      type: "GET",
                      dataType: "JSON",
                      success: function(data)
                      {

                          $('[name="id"]').val(data.id);
                          $('[name="nip"]').val(data.nip);
                          $('[name="nama"]').val(data.nama);
                          $('[name="unit"]').val(data.unit);
                          $('[name="no_tlp"]').val(data.no_tlp);
                          $('[name="tanggal_buat"]').val(data.tanggal_buat);
                          $('[name="login_terakhir"]').val(data.login_terakhir);
                          $('[name="pic_status"]').val(data.pic_status);
                          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                          $('.modal-title').text('Ubah PIC'); // Set title to Bootstrap modal title

                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error Pada Saat Mengambil Data');
                      }
                  });
              }

              function delete_customer(id)
              {
                  if(confirm('Apakah anda yakin akan menghapus data ini?'))
                  {
                      // ajax delete data to database
                      $.ajax({
                          url : "<?php echo site_url('admin/pic/ajax_delete')?>/"+id,
                          type: "POST",
                          dataType: "JSON",
                          success: function(data)
                          {
                              //if success reload ajax table
                              document.location = "<?php echo base_url('admin/pic')?>";
                          },
                          error: function (jqXHR, textStatus, errorThrown)
                          {
                              alert('Gagal menghapus data');
                          }
                      });

                  }
              }

              function bulk_delete()
              {
                  var list_id = [];
                  $(".data-check:checked").each(function() {
                          list_id.push(this.value);
                  });
                  if(list_id.length > 0)
                  {
                      if(confirm('Apakah anda yakin akan menghapus '+list_id.length+' data ini?'))
                      {
                          $.ajax({
                              type: "POST",
                              data: {id:list_id},
                              url: "<?php echo site_url('admin/pic/ajax_bulk_delete')?>",
                              dataType: "JSON",
                              success: function(data)
                              {
                                  if(data.status)
                                  {
                                      document.location = "<?php echo base_url('admin/pic')?>";
                                  }
                                  else
                                  {
                                      alert('Gagal.');
                                  }
                                  
                              },
                              error: function (jqXHR, textStatus, errorThrown)
                              {
                                  alert('Gagal menghapus data');
                              }
                          });
                      }
                  }
                  else
                  {
                      alert('Data tidak di pilih');
                  }
              }

              function save()
              {
                  $('#btnSave').text('Menyimpan...'); //change button text
                  $('#btnSave').attr('disabled',true); //set button disable 
                  var url;

                  if(save_method == 'add') {
                      url = "<?php echo site_url('admin/pic/ajax_add')?>";
                  } else {
                      url = "<?php echo site_url('admin/pic/ajax_update')?>";
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
                              document.location = "<?php echo base_url('admin/pic')?>";
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
              <div class="modal-dialog modal-md">
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
                              <div class="form-body">
                                  <div class="form-group">
                                      <label class="control-label col-md-6">NIP</label>
                                      <div class="col-md-12">
                                          <input name="nip" placeholder="NIP Karyawan" class="form-control" type="text" maxlength="15" required>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Nama</label>
                                      <div class="col-md-12">
                                          <input name="nama" placeholder="Nama" class="form-control" type="text" required>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Unit</label>
                                      <div class="col-md-12">
                                          <input name="unit" placeholder="Unit" class="form-control" type="text" required>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">No Telp</label>
                                      <div class="col-md-12">
                                          <input name="no_tlp" placeholder="081xxxxxx" class="form-control"  maxlength="13" type="text" value="">
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Password</label>
                                      <div class="col-md-12">
                                          <input name="pass" placeholder="Password Baru" class="form-control" type="password" required>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">PIC Status</label>
                                      <div class="col-md-12">
                                          <select class="form-control" name="pic_status">
                                            <option value="WAIT">WAIT</option>
                                            <option value="APPROVED">APPROVED</option>
                                            <option value="BANNED">BANNED</option>
                                          </select>
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
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div>
          <!-- End Bootstrap modal -->

          <!-- Bootstrap modal Detail-->
          <div class="modal fade" id="modal_detail" role="dialog">
              <div class="modal-dialog modal-md">
                  <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Detail Customer</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="table-responsive">
                              <table class="table table-sm" width="100%">
                                  <tr>
                                      <td class="text-right" style="width: 170px;"><strong>ID Customer :</strong></td>
                                      <td>&nbsp; <span id="detail_id"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>NIP :</strong></td>
                                      <td>&nbsp; <span id="detail_nip"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Nama :</strong></td>
                                      <td>&nbsp; <span id="detail_nama"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Unit :</strong></td>
                                      <td>&nbsp; <span id="detail_unit"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>No Telp :</strong></td>
                                      <td>&nbsp; <span id="detail_no_tlp"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Tanggal Buat :</strong></td>
                                      <td>&nbsp; <span id="detail_tgl_buat"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Login Terakhir :</strong></td>
                                      <td>&nbsp; <span id="detail_login_terakhir"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>PIC Status Akun :</strong></td>
                                      <td>&nbsp; <span id="detail_pic_sts"></span></td>
                                  </tr>
                              </table>
                            </div>
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
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
                                  <label for="fil_nip" class="col-sm-12 control-label">NIP</label>
                                  <div class="col-sm-12">
                                      <input type="text" name="fil_nip" id="fil_nip" class="form-control" placeholder="NIP PIC">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_nama" class="col-sm-12 control-label">Nama</label>
                                  <div class="col-sm-12">
                                      <input type="text" name="fil_nama" id="fil_nama" class="form-control" placeholder="Nama">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_unit" class="col-sm-12 control-label">Unit</label>
                                  <div class="col-sm-12">
                                      <input type="text" name="fil_unit" id="fil_unit" class="form-control" placeholder="Unit">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_pic_sts" class="col-sm-12 control-label">PIC Status Akun</label>
                                  <div class="col-sm-12">
                                      <select class="form-control" name="fil_pic_sts" id="fil_pic_sts">
                                        <option value="">-Tampilkan Semua-</option>
                                        <option value="WAIT">WAIT</option>
                                        <option value="APPROVED">APPROVED</option>
                                        <option value="BANNED">BANNED</option>
                                      </select>
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
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- Modal Cari -->
        </section>
      </div>


      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Customer</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Customer</div>
            </div>
          </div>

            <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
            <div class="text-center">
                <button class="btn btn-primary" onclick="add_customer()" data-toggle="tooltip" data-placement="bottom" title="Tambah Customer">
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
                            <th>E-mail</th>
                            <th>Nama Lengkap</th>
                            <th>Korporat</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>E-mail</th>
                                <th>Nama Lengkap</th>
                                <th>Korporat</th>
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
                          "url": "<?php echo site_url('admin/customer/ajax_list')?>",
                          "type": "POST",
                          "data": function ( data ) {
                              data.nama_lengkap = $('#fil_nama').val();
                              data.nama_korporat = $('#fil_korporat').val();
                              data.email = $('#fil_email').val();
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

              function add_customer()
              {
                  save_method = 'add';
                  $('#form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string

                  $('#modal_form').modal('show'); // show bootstrap modal
                  $('.modal-title').text('Tambah Customer'); // Set Title to Bootstrap modal title

              }

              function detail(id)
              {
                  $.ajax({
                      url : "<?php echo site_url('admin/customer/ajax_edit')?>/" + id,
                      type: "GET",
                      dataType: "JSON",
                      success: function(data)
                      {
                          $('#detail_id').text(data.id);
                          $('#detail_email').text(data.email);
                          $('#detail_nama_lengkap').text(data.nama_lengkap);
                          $('#detail_korporat').text(data.nama_korporat);
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
                          $('#detail_sts_member').text(data.status_member);

                          if (data.status_member == 'M') {
                            $('#detail_sts_member').html('<div class="badge badge-success">M</div>');
                          }else{
                            $('#detail_sts_member').html('<div class="badge badge-info">NB</div>');
                          }

                          $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
                          $('.modal-title').text('Detail Customer'); // Set title to Bootstrap modal title


                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error Pada Saat Mengambil Data');
                      }
                  });
              }

              function edit_customer(id)
              {
                  save_method = 'update';
                  $('#form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string
                  // $('#pwd-container').hide();


                  //Ajax Load data from ajax
                  $.ajax({
                      url : "<?php echo site_url('admin/customer/ajax_edit')?>/" + id,
                      type: "GET",
                      dataType: "JSON",
                      success: function(data)
                      {

                          $('[name="id"]').val(data.id);
                          $('[name="email"]').val(data.email);
                          $('[name="nama_lengkap"]').val(data.nama_lengkap);
                          $('[name="nama_korporat"]').val(data.nama_korporat);
                          $('[name="no_tlp"]').val(data.no_tlp);
                          $('[name="tanggal_buat"]').val(data.tanggal_buat);
                          $('[name="login_terakhir"]').val(data.login_terakhir);
                          $('[name="status_member"]').val(data.status_member);
                          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                          $('.modal-title').text('Ubah Customer'); // Set title to Bootstrap modal title

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
                          url : "<?php echo site_url('admin/customer/ajax_delete')?>/"+id,
                          type: "POST",
                          dataType: "JSON",
                          success: function(data)
                          {
                              //if success reload ajax table
                              document.location = "<?php echo base_url('admin/customer')?>";
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
                              url: "<?php echo site_url('admin/customer/ajax_bulk_delete')?>",
                              dataType: "JSON",
                              success: function(data)
                              {
                                  if(data.status)
                                  {
                                      document.location = "<?php echo base_url('admin/customer')?>";
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
                      url = "<?php echo site_url('admin/customer/ajax_add')?>";
                  } else {
                      url = "<?php echo site_url('admin/customer/ajax_update')?>";
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
                              document.location = "<?php echo base_url('admin/customer')?>";
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
                              <input type="hidden" value="" name="status_member"/> 
                              <div class="form-body">
                                  <div class="form-group">
                                      <label class="control-label col-md-6">E-Mail</label>
                                      <div class="col-md-12">
                                          <input name="email" placeholder="customer@email.com" class="form-control" type="email" required>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Nama Lengkap</label>
                                      <div class="col-md-12">
                                          <input name="nama_lengkap" placeholder="Nama Lengkap" class="form-control" type="text" required>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Korporat</label>
                                      <div class="col-md-12">
                                          <input name="nama_korporat" placeholder="Korporat" class="form-control" type="text" required>
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
                                      <td class="text-right"><strong>E-mail :</strong></td>
                                      <td>&nbsp; <span id="detail_email"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Nama Lengkap :</strong></td>
                                      <td>&nbsp; <span id="detail_nama_lengkap"></span></td>
                                  </tr>
                                  <tr>
                                      <td class="text-right"><strong>Korporat :</strong></td>
                                      <td>&nbsp; <span id="detail_korporat"></span></td>
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
                                  <label for="fil_email" class="col-sm-12 control-label">E-mail</label>
                                  <div class="col-sm-12">
                                      <input type="email" name="fil_email" id="fil_email" class="form-control" placeholder="customer@email.com">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_nama" class="col-sm-12 control-label">Nama</label>
                                  <div class="col-sm-12">
                                      <input type="text" name="fil_nama" id="fil_nama" class="form-control" placeholder="Nama">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="fil_korporat" class="col-sm-12 control-label">Korporat</label>
                                  <div class="col-sm-12">
                                      <input type="text" name="fil_korporat" id="fil_korporat" class="form-control" placeholder="Korporat">
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


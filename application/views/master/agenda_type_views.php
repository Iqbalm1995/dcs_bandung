      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Agenda Type</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Agenda Type</div>
            </div>
          </div>

            <?php echo $this->session->userdata('message1') <> '' ? $this->session->userdata('message1') : ''; ?>
            <div class="text-center">
                <button class="btn btn-primary" onclick="add_agenda_type()" data-toggle="tooltip" data-placement="bottom" title="Tambah data">
                    <i class="fas fa-plus"></i><!--  Tambah --></button>
                <button class="btn btn-light" onclick="reload_table()" data-toggle="tooltip" data-placement="bottom" title="Muat Ulang Tabel">
                    <i class="fas fa-sync-alt"></i><!--  Refresh --></button>
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
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Dibuat</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Dibuat</th>
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
                          "url": "<?php echo site_url('admin/agenda_type/ajax_list')?>",
                          "type": "POST"
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
              });

              function reload_table()
              {
                  table.ajax.reload(null,false); //reload datatable ajax 
              }

              function add_agenda_type()
              {
                  save_method = 'add';
                  $('#form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string

                  $('#modal_form').modal('show'); // show bootstrap modal
                  $('.modal-title').text('Tambah Data'); // Set Title to Bootstrap modal title

              }

              function edit_agenda_type(id)
              {
                  save_method = 'update';
                  $('#form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string
                  // $('#pwd-container').hide();


                  //Ajax Load data from ajax
                  $.ajax({
                      url : "<?php echo site_url('admin/agenda_type/ajax_edit')?>/" + id,
                      type: "GET",
                      dataType: "JSON",
                      success: function(data)
                      {

                          $('[name="id"]').val(data.id);
                          $('[name="nama"]').val(data.nama);
                          $('[name="deskripsi"]').val(data.deskripsi);
                          $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                          $('.modal-title').text('Ubah Data'); // Set title to Bootstrap modal title

                      },
                      error: function (jqXHR, textStatus, errorThrown)
                      {
                          alert('Error Pada Saat Mengambil Data');
                      }
                  });
              }

              function delete_agenda_type(id)
              {
                  if(confirm('Apakah anda yakin akan menghapus data ini?'))
                  {
                      // ajax delete data to database
                      $.ajax({
                          url : "<?php echo site_url('admin/agenda_type/ajax_delete')?>/"+id,
                          type: "POST",
                          dataType: "JSON",
                          success: function(data)
                          {
                              //if success reload ajax table
                              document.location = "<?php echo base_url('admin/agenda_type')?>";
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
                              url: "<?php echo site_url('admin/agenda_type/ajax_bulk_delete')?>",
                              dataType: "JSON",
                              success: function(data)
                              {
                                  if(data.status)
                                  {
                                      document.location = "<?php echo base_url('admin/agenda_type')?>";
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
                      url = "<?php echo site_url('admin/agenda_type/ajax_add')?>";
                  } else {
                      url = "<?php echo site_url('admin/agenda_type/ajax_update')?>";
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
                              document.location = "<?php echo base_url('admin/agenda_type')?>";
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
                          $('#btnSave').text('<i class="fas fa-save"></i> Simpan'); //change button text
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
                              <!-- <input type="hidden" value="" name="pass"/> --> 
                              <div class="form-body">
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Nama Type Bisnis</label>
                                      <div class="col-md-12">
                                          <input name="nama" placeholder="Nama Type Bisnis" class="form-control" type="text" required>
                                          <span class="help-block"></span>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label col-md-6">Deskripsi</label>
                                      <div class="col-md-12">
                                          <textarea class="form-control" name="deskripsi" placeholder="Deskripsi" ></textarea>
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
        </section>
      </div>


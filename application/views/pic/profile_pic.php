      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Profile PIC</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Profile</div>
            </div>
          </div>
          <div class="row">
            <!-- <?php echo $picDATA['nama'];?> -->
            
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card profile-widget">
                <div class="profile-widget-header"> 
                  <?php if ($picDATA['photo'] == '') {
                          echo '<img alt="image" src="'.base_url('dist/').'assets/img/avatar/avatar-1.png" class="rounded-circle profile-widget-picture">';
                      }else{
                          echo '<img alt="image" src="'.base_url().'drive/photo/'.$picDATA['photo'].'" class="rounded-circle profile-widget-picture">';
                  } ?>
                  <!-- <div class="profile-widget-items">
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Posts</div>
                      <div class="profile-widget-item-value">187</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Followers</div>
                      <div class="profile-widget-item-value">6,8K</div>
                    </div>
                    <div class="profile-widget-item">
                      <div class="profile-widget-item-label">Following</div>
                      <div class="profile-widget-item-value">2,1K</div>
                    </div>
                  </div> -->
                </div>
                <div class="profile-widget-description">
                  <div class="profile-widget-name"><?php echo $picDATA['nama'];?> <div class="text-muted d-inline font-weight-normal"><div class="slash"></div> <?php echo $picDATA['nip'];?></div></div>
                  <hr>
                    <table class="table table-sm" width="50%">
                        <tr>
                            <td width="20%"><strong>Unit</strong></td>
                            <td>
                                <?php if ($picDATA['unit'] == '') {
                                        echo ': <i class="fas fa-warning"></i> (Data belum ada, segera isi data)';
                                    }else{
                                        echo ': ', $picDATA['unit'];
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>No Telp</strong></td>
                            <td>
                            <?php if ($picDATA['no_tlp'] == '') {
                                        echo ': <i class="fas fa-warning"></i> (Data belum ada, segera isi data)';
                                    }else{
                                        echo ': ', $picDATA['no_tlp'];
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Status</strong></td>
                            <td>
                            <?php if ($picDATA['nip'] == '') {
                                        echo ': <i class="fa fa-warning text-danger"></i> (Data Belum Ada)';
                                    }else{
                                        echo ': ', $picDATA['nip'];
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer text-center">
                  <div class="font-weight-bold mb-2">Pengaturan</div>
                  <a href="#" class="btn btn-success mr-1" onclick="ubah_foto(<?php echo $picDATA['id'] ?>)"> Ubah Foto Profile
                  </a>
                  <a href="#" class="btn btn-info mr-1" onclick="ubah_info(<?php echo $picDATA['id'] ?>)"> Ubah Info Profile
                  </a>
                  <a href="#" class="btn btn-primary mr-1" onclick="ubah_pass(<?php echo $picDATA['id'] ?>)"> Ubah Password
                  </a>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <!-- Script -->
    <script type="text/javascript">

        function ubah_foto(id)
        {
            save_method = 'update_foto';
            $('#form_foto')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('pic/profile/ajax_edit')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id_foto"]').val(data.id);
                    $('#modal_foto').modal('show');
                    $('.modal-title').text('Ubah Foto');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error Pada Saat Mengambil Data');
                }
            });
        }

        function ubah_info(id)
        {
            save_method = 'update_info';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string


            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('pic/profile/ajax_edit')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id"]').val(data.id);
                    $('[name="unit"]').val(data.unit);
                    $('[name="no_tlp"]').val(data.no_tlp);
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Ubah Info');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error Pada Saat Mengambil Data');
                }
            });
        }

        function ubah_pass(id)
        {
            save_method = 'update_pass';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string


            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('pic/profile/ajax_edit')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="id_pass"]').val(data.id);
                    $('[name="hidden_pass"]').val(data.pass);
                    $('#modal_pass').modal('show');
                    $('.modal-title').text('Ubah Password');
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

            if(save_method == 'update_info') {
                url = "<?php echo site_url('pic/profile/ajax_update')?>";
            }

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
                        document.location = "<?php echo base_url('pic/profile')?>";
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

        function save_foto()
        {
            $('#btnSave').text('Menyimpan...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;

            if (save_method == 'update_foto') {
                url = "<?php echo site_url('pic/profile/ajax_update_photo')?>";
                
            }

            var formData = new FormData($('#form_foto')[0]);
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
                        document.location = "<?php echo base_url('pic/profile')?>";
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

        function save_pass()
        {
            $('#btnSave').text('Menyimpan...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;

            if(save_method == 'update_pass') {
                url = "<?php echo site_url('pic/profile/ajax_update_pass')?>";
            }

            var formData = new FormData($('#form_pass')[0]);
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
                        document.location = "<?php echo base_url('pic/profile')?>";
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

      <!-- Bootstrap modal Detail-->
      <div class="modal fade" id="modal_foto" role="dialog">
          <div class="modal-dialog modal-md">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Detail Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="#" id="form_foto" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" value="" name="id_foto"/>
                        <div class="form-body">
                            <div class="form-group">
                              <div class="section-title">File Browser</div>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" name="photo">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                              <small>*Kosongkan untuk menghapus foto profil</small>
                                
                            </div>
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Batal">
                      <i class="fas fa-times"></i></button>
                      <button type="button" id="btnSave2" onclick="save_foto()" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Simpan">
                      <i class="fas fa-save"></i> Simpan</button>
                  </div>
              </div>
          </div>
      </div>
      <!-- End Bootstrap modal -->

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
                                      <small>*Disarankan untuk menggunakan nomor yang <b>Aktif</b> dan <b>Tetap</b></small>
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

      <!-- Bootstrap modal -->
      <div class="modal fade" id="modal_pass" role="dialog">
          <div class="modal-dialog modal-md">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body form">
                      <form action="#" id="form_pass" class="form-horizontal">
                          <input type="text" value="" name="id_pass"/> 
                          <input type="text" value="" name="hidden_pass"/> 
                          <div class="form-body">
                              <div class="form-group">
                                  <label class="control-label col-md-6">Password Lama</label>
                                  <div class="col-md-12">
                                      <input name="password_lama" placeholder="Kata Sandi Lama" class="form-control" type="password" required autocomplete="off" id="password_lama" required>
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                              <hr>
                              <div class="form-group">
                                  <label class="control-label col-md-6">Password Baru</label>
                                  <div class="col-md-12">
                                      <input name="pass" placeholder="Kata Sandi Baru" class="form-control" type="password" required autocomplete="off" id="password_baru" required>
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="control-label col-md-6">Konfirmasi Password</label>
                                  <div class="col-md-12">
                                      <input name="pass_confirm" placeholder="Konfirmasi Password" class="form-control" type="password" required autocomplete="off" id="password_confirm" required>
                                      <span class="help-block"></span>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Batal">
                      <i class="fas fa-times"></i></button>
                      <button type="button" id="btnSave2" onclick="save_pass()" class="btn btn-primary" data-toggle="tooltip" data-placement="bottom" title="Simpan">
                      <i class="fas fa-save"></i> Simpan</button>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>
      <!-- End Bootstrap modal -->


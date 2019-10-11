      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Kuisioner</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item">Kuisioner</div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Pengaturan Kuisioner</h4>
                  <div class="card-header-action">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary" href="#"><i class="fas fa-minus"></i></a>
                  </div>
                </div>
                <div class="collapse show" id="mycard-collapse">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-6">
                        <p>Pengelolaan Kuisioner</p>
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <a href="<?php echo base_url('admin/jenis_ksrn')?>" class="btn btn-primary tombolfull">Jenis Kuesioner</a>
                          <a href="<?php echo base_url('admin/pertanyaan_ksrn')?>" class="btn btn-primary tombolfull">Pertanyaan Kuisioner</a>
                          <a href="<?php echo base_url('admin/recap_ksrn')?>" class="btn btn-primary tombolfull">Recap Kuesioner</a>
                          <a href="<?php echo base_url('kenalan')?>" class="btn btn-primary tombolfull">Kenalan</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Responden</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      $GETresponden = $this->kuisioner->get_responden(); 
                      $totalRespon = $GETresponden['respon'];
                      echo $totalRespon;
                    ?> Customer
                  </div>
                </div>
              </div>
            </div> 
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Data Kuisioner</h4>
                </div>
                <div class="card-body">
                  <table class="table table-sm table-bordered table-striped" width="100%">
                    <thead>
                      <th class="text-center alert alert-info" colspan="4">Keterangan</th>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">Jawaban 1</td>
                        <td class="text-center">Jawaban 2</td>
                        <td class="text-center">Jawaban 3</td>
                        <td class="text-center">Jawaban 4</td>
                      </tr>
                      <tr>
                        <td class="text-center">Angka 0% - 25%</td>
                        <td class="text-center">Angka 25.01% - 50%</td>
                        <td class="text-center">Angka 50.01% - 75%</td>
                        <td class="text-center">Angka 75.01% - 100%</td>
                      </tr>
                      <tr>
                        <td class="text-center">Sangat Buruk</td>
                        <td class="text-center">Kurang Baik</td>
                        <td class="text-center">Baik (Cukup)</td>
                        <td class="text-center">Sangat Baik</td>
                      </tr>
                    </tbody>
                  </table>
                  <table class="table table-sm table-bordered table-striped" width="100%">
                    <thead>
                      <th rowspan="2" width="3%" class="text-center">No.</th>
                      <th rowspan="2" class="text-center">Pertanyaan</th>
                      <th colspan="4" width="15%" class="text-center">Jawaban</th>
                      <th rowspan="2" width="8%" class="text-center">Persentase</th>
                      <th rowspan="2" width="15%" class="text-center">Keterangan</th>
                      <th rowspan="2" width="15%" class="text-center">Respon Teknis</th>
                    <tr>
                      <th class="text-center">1</th>
                      <th class="text-center">2</th>
                      <th class="text-center">3</th>
                      <th class="text-center">4</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $jumlah = 0;
                      $totalPersen = 0;
                      $no = 1;
                        foreach ($getKSRN as $read){ 
                      ?>
                    <tr>
                      <td class="text-center"><?php echo $no; ?></td>
                      <td><?php echo $read->isi_pertanyaan; ?></td>
                      <?php
                        $getJawaban1 = $this->kuisioner->get_countJwbn(1, $read->id_pertanyaan);
                        $getJawaban2 = $this->kuisioner->get_countJwbn(2, $read->id_pertanyaan);
                        $getJawaban3 = $this->kuisioner->get_countJwbn(3, $read->id_pertanyaan);
                        $getJawaban4 = $this->kuisioner->get_countJwbn(4, $read->id_pertanyaan);

                        $TotalJwb1 = $getJawaban1['jawaban'];
                        $TotalJwb2 = $getJawaban2['jawaban'];
                        $TotalJwb3 = $getJawaban3['jawaban'];
                        $TotalJwb4 = $getJawaban4['jawaban'];

                        $resJwb1 = $TotalJwb1 * 1;
                        $resJwb2 = $TotalJwb2 * 2;
                        $resJwb3 = $TotalJwb3 * 3;
                        $resJwb4 = $TotalJwb4 * 4;

                        $totalSkor = $resJwb1 + $resJwb2 + $resJwb3 + $resJwb4;

                        $x = 1 * $totalRespon;
                        $y = 4 * $totalRespon;

                        $persenJwn = ($totalSkor / $y) * 100;
                        

                      ?>
                      <td class="text-center"><?php echo $TotalJwb1;?></td>
                      <td class="text-center"><?php echo $TotalJwb2;?></td>
                      <td class="text-center"><?php echo $TotalJwb3;?></td>
                      <td class="text-center"><?php echo $TotalJwb4;?></td>
                      <td class="text-center"><b><?php echo $persenJwn;?>%</b></td>
                      <td class="text-center"><b><?php 
                      if (($persenJwn >= 0) AND ($persenJwn <= 25)) {
                          echo '<span class="text-danger">Sangat Buruk</span>';
                        }elseif (($persenJwn >= 25.99) AND ($persenJwn <= 50)) {
                          echo '<span class="text-warning">Kurang Baik</span>';
                        }elseif (($persenJwn >= 50.99) AND ($persenJwn <= 75)) {
                          echo '<span class="text-primary">Baik</span>';
                        }elseif (($persenJwn >= 75.99) AND ($persenJwn <= 100)) {
                          echo '<span class="text-info">Sangat Baik</span>';
                        }
                      ?></b></td>
                      <td class="text-center"><?php 
                      if (($persenJwn >= 0) AND ($persenJwn <= 25)) {
                          echo '<button class="btn btn-sm btn-danger" onclick="res1()">Respon Teknis</button>';
                        }elseif (($persenJwn >= 25.99) AND ($persenJwn <= 50)) {
                          echo '<button class="btn btn-sm btn-warning" onclick="res2()">Respon Teknis</button>';
                        }elseif (($persenJwn >= 50.99) AND ($persenJwn <= 75)) {
                          echo '<button class="btn btn-sm btn-primary" onclick="res3()">Respon Teknis</button>';
                        }elseif (($persenJwn >= 75.99) AND ($persenJwn <= 100)) {
                          echo '<button class="btn btn-sm btn-info" onclick="res4()">Respon Teknis</button>';
                        }
                      ?></td>
                    </tr>

                    <?php 
                      $jumlah = $jumlah + 1;
                      $totalPersen = $totalPersen + $persenJwn;
                      $no++; }; ?>
                    </tbody>
                    <tfoot>
                      <th colspan="6" class="text-right">Rata - Rata Skor</th>
                      <th class="text-center"> 
                        <?php 
                        $rataRata = $totalPersen / $jumlah;
                        echo number_format((float)$rataRata, 2, '.', ''); 
                        ?>%
                      </th>
                      <td class="text-center"><b><?php 
                      if (($rataRata >= 0) AND ($rataRata <= 25)) {
                          echo '<span class="text-danger">Sangat Buruk</span>';
                        }elseif (($rataRata >= 25.01) AND ($rataRata <= 50)) {
                          echo '<span class="text-warning">Kurang Baik</span>';
                        }elseif (($rataRata >= 50.01) AND ($rataRata <= 75)) {
                          echo '<span class="text-primary">Baik</span>';
                        }elseif (($rataRata >= 75.01) AND ($rataRata <= 100)) {
                          echo '<span class="text-info">Sangat Baik</span>';
                        }
                      ?></b></td>
                      <td class="text-center"><?php 
                      if (($rataRata >= 0) AND ($rataRata <= 25)) {
                          echo '<button class="btn btn-sm btn-danger" onclick="res1()">Respon Teknis</button>';
                        }elseif (($rataRata >= 25.01) AND ($rataRata <= 50)) {
                          echo '<button class="btn btn-sm btn-warning" onclick="res2()">Respon Teknis</button>';
                        }elseif (($rataRata >= 50.01) AND ($rataRata <= 75)) {
                          echo '<button class="btn btn-sm btn-primary" onclick="res3()">Respon Teknis</button>';
                        }elseif (($rataRata >= 75.01) AND ($rataRata <= 100)) {
                          echo '<button class="btn btn-sm btn-info" onclick="res4()">Respon Teknis</button>';
                        }
                      ?></td>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h4>Pengaturan Kuisioner</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">
                      <div class="text-right">
                        <form method="POST" action="<?php echo base_url('admin/recap_ksrn/update_recap')?>">
                          <input type="hidden" name="responden" value="<?php echo $totalRespon;?>">
                          <input type="hidden" name="persentase" value="<?php echo number_format((float)$rataRata, 2, '.', '');?>">
                          <input type="submit" class="btn btn-lg btn-primary tombolfull" value="Update Recap Kuesioner">
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>               
          </div>
        </section>
      </div>
      <script type="text/javascript">
        function res1()
        {
            $('#modal_res1').modal('show'); // show bootstrap modal

        }
        function res2()
        {
            $('#modal_res2').modal('show'); // show bootstrap modal

        }
        function res3()
        {
            $('#modal_res3').modal('show'); // show bootstrap modal

        }
        function res4()
        {
            $('#modal_res4').modal('show'); // show bootstrap modal

        }
      </script>
      <div class="modal fade" id="modal_res1" role="dialog">
          <div class="modal-dialog modal-md">
              <div class="modal-content alert alert-danger">
                  <div class="modal-header">
                    <h5 class="modal-title">Respon Teknis Perbaikan Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <hr>
                    <h3>Penilaian Sangat Buruk</h3>
                    <p>Harus diadakannya pelatihan lebih lanjut dengan petugas dari hasil pelayanan terkait.</p>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal_res2" role="dialog">
          <div class="modal-dialog modal-md">
              <div class="modal-content alert alert-warning">
                  <div class="modal-header">
                    <h5 class="modal-title">Respon Teknis Perbaikan Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <hr>
                    <h3>Penilaian Kurang Baik</h3>
                    <p>Memberi peringatan kepada petugas untuk lebih baik untuk melakukan pelayanan.</p>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal_res3" role="dialog">
          <div class="modal-dialog modal-md">
              <div class="modal-content alert alert-primary">
                  <div class="modal-header">
                    <h5 class="modal-title">Respon Teknis Perbaikan Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <hr>
                    <h3>Penilaian Baik</h3>
                    <p>Dengan nilai pelayanan diatas rata-rata petugas bisa meningkatan kualitas pelayanan lebih baik lagi untuk pelayanan terbaik.</p>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal_res4" role="dialog">
          <div class="modal-dialog modal-md">
              <div class="modal-content alert alert-info">
                  <div class="modal-header">
                    <h5 class="modal-title">Respon Teknis Perbaikan Pelayanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <hr>
                    <h3>Penilaian Sangat Baik</h3>
                    <p>Petugas harus bisa mempertahankan nilai pelayanan yang didapat.</p>
                  </div>
              </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
      </div>


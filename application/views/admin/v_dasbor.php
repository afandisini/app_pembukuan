<?php $this->load->view("admin/part/head") ?>
<?php $this->load->view('admin/menu');?>
    <section class="content">
      <?= alert_bs();?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon">
                <?php foreach ($peng->result_array() as $i):
                          $pnm=$i['pengaturan_nama'];
                          $php=$i['pengaturan_hp'];
                          $palt=$i['pengaturan_alt'];
                          $plogo=$i['pengaturan_logo'];
                          $pplus=$i['pengaturan_plus'];
                  ?>
                  <?php if (!empty($pplus)) { ?>
                    <i class="fal fa-<?= $pplus ?> text-success"></i>
                  <?php } else { ?>
                    <i class="fal fa-shopping-bag text-success"></i>
                  <?php } ?>
                </span>
                <div class="col-sm-10 info-box-content">
                  <span class="info-box-text font-weight-bold"><?= $pnm;?> | <span class="text-xs"><?= $php;?></span></span>
                  <span class="info-box-text"><?= $palt;?></span>
                  <?php endforeach; ?>
                </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon"><i class="fal fa-clock text-info"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">
                  <?php 
                        $tanggal= mktime(date("m"),date("d"),date("Y"));
                        date_default_timezone_set('Asia/Makassar');
                        $a = date ("H");
                        if (($a>=6) && ($a<=11)){
                        echo "Selamat Pagi";
                        }
                        else if(($a>11) && ($a<=14))
                        {
                        echo "Selamat Siang";}
                        else if (($a>14) && ($a<=18)){
                        echo "Selamat Sore";}
                        else { echo "Selamat Malam";}
                    ?>
                </span>
                <span class="info-box-number">
                    <span id="jam"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="clearfix hidden-md-up"></div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon"><i class="fal fa-calendar-alt text-warning"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Tanggal</span>
              <span class="info-box-number">
                <?php 
                    function tgl_indo($tanggal){
                      $bulan = array (
                        1 =>   'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                      );
                      $pecahkan = explode('-', $tanggal);
                      
                      // variabel pecahkan 0 = tanggal
                      // variabel pecahkan 1 = bulan
                      // variabel pecahkan 2 = tahun
                    
                      return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
                    
                    echo tgl_indo(date('Y-m-d'));
                ?>
               </span>
            </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon"><i class="fal fa-user-circle text-maroon"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Anda Masuk Sebagai</span>
                <span class="info-box-number"><?= $this->session->userdata('nama');?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6 col-6">
            <div class="row">
              <div class="col-lg-6 col-6">
                <div class="small-box bg-success">
                  <div class="inner mb-4">
                    <p>Pemasukan <i class="fal fa-arrow-right mr-1"></i> <?php echo 'Rp ' .number_format($total_debet);?>
                    <br>Pengeluaran <i class="fal fa-arrow-right mr-1"></i> <?php echo 'Rp ' .number_format($total_kredit);?></p>
                  </div>
                  <div class="icon">
                    <i class="fal fa-user-chart"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                  Lihat <i class="fal fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-lg-6 col-6">
                <div class="small-box bg-info">
                  <div class="inner mb-4">
                    <p>Kas <i class="fal fa-arrow-right mr-1"></i> <?php echo 'Rp ' .number_format($kas);?><br>
                    Total ada <?= $total_kegiatan;?> Kegiatan</p>
                  </div>
                  <div class="icon">
                    <i class="fal fa-chart-bar"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                  Lihat <i class="fal fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
            </div>
              <div class="small-box card">
                <div class="table-responsive-sm pt-3 pb-1">
                    <table class="table table-striped table-sm" id="kegiatan">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nama</th>
                          <th scope="col">Estimasi</th>
                          <th scope="col">Proses Kegiatan</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $no=0; foreach ($lihat_keg->result_array() as $a) {
                              $no++;
                              $knm=$a['keg_nama'];
                              $mulai=$a['start'];
                              $selesai=$a['end'];
                          ?>
                        <tr>
                          <td><?= $no;?></td>
                          <td>
                              <span class="d-inline-block text-truncate" style="max-width:150px;"><?= $knm;?></span>
                          </td>
                          <td>
                              <span class="text-sm"><?= tgl_indo($mulai);?> s/d <?= tgl_indo($selesai);?></span></td>
                          <td>
                              <?php $date = date('Y-m-d');
                                    $date1 = strtotime(''.$mulai.'');
                                    $date2 = strtotime(''.$selesai.'');
                                    $today = time();
                                    $dateDiff = $date2 - $date1;
                                    $dateDiffForToday = $today - $date1;
                                    $percentage = $dateDiffForToday / $dateDiff * 100;
                                    $hsl = round($percentage);
                                ?>
                                  <div class="progress rounded bg-secondary text-center">
                                    <div class="progress-bar bg-gradient-success" style="width:<?= $hsl;?>%;">
                                    <span class="text-xs">
                                      <?php if ($hsl > 100) { ?>Selesai<?php } else { ?>Berjalan<?php } ?>
                                    </span>
                                    </div>
                                  </div>
                                  
                            </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
              </div>
          </div>
          
          <div class="container col-lg-6 col-6">
            <div class="small-box card">
              <div class="container"> 
                <div class="row">  
                    <div class="col-md-12 col-md-offset-1">  
                        <div class="panel panel-default">  
                            <div class="panel-body">  
                                <div id="chart"></div>  
                            </div>  
                        </div>  
                    </div>  
                </div>  
              </div>
            </div>
          </div>
          
          <script>
              $(function () {   
                  var pemasukan = <?php echo $pmas; ?>;  
                  var pengeluaran = <?php echo $pkel; ?>;  
                  $(function() {
                    var chart = new Highcharts.Chart({
                        chart: {
                            renderTo: 'chart'
                        },
                        title: {
                            text: 'Grafik'
                        },
                        xAxis: {
                              categories: ['']
                          },
                        yAxis: {
                          title: {
                                text: ''
                            },
                            labels: {
                                formatter: function() {
                                  return this.value / 1000000 + 'k';
                                }
                            }
                        },
                        series: [{
                          type: 'column',
                              name: 'DEBET',
                              data: [<?= $total_debet;?>],
                              color: '#28a745',
                          }, {
                              type: 'column',
                              name: 'KREDIT',
                              data: [<?= $total_kredit;?>],
                              color: '#dc3545'
                          }, {
                            type: 'column',
                              name: 'KAS',
                              data: [<?= $kas;?>],
                              color: '#ffc107'
                          }]
                    });
                }); 
              });
          </script>
        </div>
        <div class="row">
          
        </div>
      </div><!--/. container-fluid -->
      
    </section>
      <script>
          var tabel = null;
          $(document).ready(function() {
              tabel = $('#kegiatan').DataTable({
                  "processing": false,
                  "responsive":true,
                  "serverSide": false,
                  "ordering": true, // Set true agar bisa di sorting
                  pageLength: 3,
                  language: {url: '<?= base_url('assets/id.json');?>'},
                  dom: 'frtp',
                  lengthMenu: [
                      [ 10, 25, 50, 999999 ],
                      [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                  ],
                  buttons: [{extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-info btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4]}, footer: true}
                  ],
                  "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
              }).buttons().container().appendTo('#keg_wrapper .col-ms-6:eq(0)');
          });
      </script>
      
      <?php $this->load->view("admin/part/foo") ?>
      <script type="text/javascript">
        //datatable
        $(function(){$("#tbstok").DataTable({lengthChange:!1,bInfo:!1,scrollY:"15em",scrollCollapse:!0,paging:!1,responsive:!0,language:{url: '<?= base_url('assets/id.json');?>',ColumnDefs:[{type:"num"}]}}).buttons().container().appendTo("#tbstok_wrapper .col-ms-6:eq(0)")});
      </script>
      <script type="text/javascript">
        $(function(){$("#tbljual").DataTable({lengthChange:!1,bInfo:!1,scrollY:"15em",scrollCollapse:!0,paging:!1,responsive:!0,searchPlaceholder: "Cari Penjualan..",language:{url: '<?= base_url('assets/id.json');?>'}}).buttons().container().appendTo("#tbljual_wrapper .col-ms-6:eq(0)")});
      </script>
    </body>
</html>
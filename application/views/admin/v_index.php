<?php $this->load->view("admin/part/head") ?>
<?php $this->load->view('admin/menu');?>
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/highcharts.css'?>">
  <style>.page-item.active .page-link{background-color:#d3d3d3!important}.page-link{color:#000!important}div.dataTables_wrapper div.dataTables_paginate{margin:10px}div.dataTables_wrapper div.dataTables_filter{text-align:right;margin:10px}</style>
    <section class="content">
      <div class="container-fluid">
        <?php echo $this->session->flashdata('msg');?>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon">
                <?php foreach ($peng->result_array() as $i):
                          $pid=$i['pengaturan_id'];
                          $pnm=$i['pengaturan_nama'];
                          $palt=$i['pengaturan_alt'];
                          $php=$i['pengaturan_hp'];
                          $plogo=$i['pengaturan_logo'];
                  ?>
                  <?php if (!empty($plogo)) { ?>
                    <img class="card-img rounded" src="<?php echo base_url().'uploads/pengaturan/'.$plogo;?>" height="65px" alt="<?php echo $pnm;?>" title="<?php echo $pnm;?>">
                  <?php } else { ?>
                    <img class="card-img rounded" src="<?php echo base_url().'uploads/flashretail.webp';?>" height="65px" alt="<?php echo $pnm;?>" title="<?php echo $pnm;?>">
                  <?php } ?>
                </span>
                <div class="col-sm-10 info-box-content">
                  
                  <span class="info-box-text font-weight-bold"><?php echo $pnm;?></span>
                  <span class="info-box-text"><?php echo $php;?></span>
                  <?php endforeach; ?>
                </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon"><i class="far fa-clock text-info"></i></span>
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
              <span class="info-box-icon"><i class="fas fa-calendar-alt text-warning"></i></span>
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
              <span class="info-box-icon"><i class="far fa-user-circle text-maroon"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Anda Masuk Sebagai</span>
                <span class="info-box-number"><?php echo $this->session->userdata('nama');?></span>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
              <div class="card-header border-0">
                <h5 class="card-title">Stok Barang</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                <?php
                    /* Mengambil query report*/
                    foreach($stok as $result){
                        $bulan[] = $result->kategori_nama; //ambil bulan
                        $value[] = (float) $result->tot_stok; //ambil nilai
                    }
                    /* end mengambil query*/
                ?>
                <div id="report"></div>
                <script type="text/javascript">
                  $(function () {
                      $('#report').highcharts({
                          chart: {
                              type: 'bar',
                              margin: 75,
                              options3d: {
                                  enabled: false,
                                  alpha: 10,
                                  beta: 25,
                                  depth: 70
                              }
                          },
                          title: {
                              text: '<strong style="color:#adb5bd;">Grafik Stok Barang</strong>',
                              style: {
                                      fontSize: '12px',
                                      fontFamily: 'Source Sans Pro, -apple-system,BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial,sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol'
                              }
                          },
                          subtitle: {
                            text: ' ',
                            style: {
                                      fontSize: '15px',
                                      fontFamily: 'Verdana, sans-serif'
                              }
                          },
                          plotOptions: {
                              column: {
                                  depth: 25
                              }
                          },
                          credits: {
                              enabled: false
                          },
                          xAxis: {
                              categories:  <?php echo json_encode($bulan);?>
                          },
                          exporting: { 
                              enabled: false 
                          },
                          yAxis: {
                              title: {
                                  text: ' '
                              },
                          },
                          tooltip: {
                              formatter: function() {
                                  return 'Total Stok <b>' + this.x + '</b> Adalah <b>' + Highcharts.numberFormat(this.y,0) + '</b> Items ';
                              }
                            },
                          series: [{
                              name: '<strong style="color:#adb5bd;">Stok Barang</span>',
                              data: <?php echo json_encode($value);?>,
                              shadow : true,
                              dataLabels: {
                                  enabled: true,
                                  color: '#045396',
                                  align: 'right',
                                  formatter: function() {
                                      return Highcharts.numberFormat(this.y, 0);
                                  }, // one decimal
                                  y: 0, // 10 pixels down from the top
                                  style: {
                                      fontSize: '13px',
                                      fontFamily: 'Verdana, sans-serif'
                                  }
                              }
                          }]
                      });
                  });
                </script>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-6">
            <div class="card">
            <div class="card-header border-0">
                <h5 class="card-title">Penjualan Produk</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            <div class="card-body p-0">
              <?php
                  /* Mengambil query report*/
                  foreach($jml_jual as $result){
                      $jbar[] = $result->d_jual_barang_nama; //ambil bulan
                      $jtot[] = (float) $result->tot_jual; //ambil nilai
                  }
                  /* end mengambil query*/
              ?>
              
              <div id="jual" class="w-100"></div>
              <script type="text/javascript">
                $(function () {
                    $('#jual').highcharts({
                        chart: {
                            type: 'bar',
                            margin: 75,
                            options3d: {
                                enabled: false,
                                alpha: 10,
                                beta: 25,
                                depth: 70
                            }
                        },
                        title: {
                            text: '<strong style="color:#adb5bd;">Grafik Penjualan Produk</strong>',
                            style: {
                                    fontSize: '12px',
                                    fontFamily: 'Source Sans Pro, -apple-system,BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial,sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol'
                            }
                        },
                        subtitle: {
                          text: ' ',
                          style: {
                                    fontSize: '15px',
                                    fontFamily: 'Verdana, sans-serif'
                            }
                        },
                        plotOptions: {
                            column: {
                                depth: 25
                            }
                        },
                        credits: {
                            enabled: false
                        },
                        xAxis: {
                            categories:  <?php echo json_encode($jbar);?>
                        },
                        exporting: { 
                            enabled: false 
                        },
                        yAxis: {
                            title: {
                                text: ' '
                            },
                        },
                        tooltip: {
                            formatter: function() {
                                return 'Penjualan <b>' + this.x + '</b> Total <b>' + Highcharts.numberFormat(this.y,0) + '</b> Unit ';
                            }
                          },
                        series: [{
                            name: '<strong style="color:#adb5bd;">Total dijual</span>',
                            data: <?php echo json_encode($jtot);?>,
                            shadow : true,
                            dataLabels: {
                                enabled: true,
                                color: '#045396',
                                align: 'right',
                                formatter: function() {
                                    return Highcharts.numberFormat(this.y, 0);
                                }, // one decimal
                                y: 0, // 10 pixels down from the top
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Verdana, sans-serif'
                                }
                            }
                        }]
                    });
                });
              </script>
            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h5 class="card-title">Barang Tersedia</h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body p-0">
                  <div class="table-responsive-sm">
                      <table class="table table-hover table-sm" id="tbstok">
                          <thead>
                              <tr>
                                  <th style="width:15px">Jml</th>
                                  <th class="w-30">Kategori</th>
                                  <th class="w-50">Nama Barang</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php 
                              $no=0;
                              foreach ($data->result_array() as $a):
                                  $no++;
                                  $id=$a['barang_id'];
                                  $nm=$a['barang_nama'];
                                  $kat=$a['kategori_nama'];
                                  $stok=$a['barang_stok'];
                          ?>
                              <tr <?php 
                                    if ($a['barang_stok'] < 1) {
                                            $p = 'class="bg-stok"';
                                            }else{
                                            $p = '';
                                            }
                                            $output= $p; echo $p;?>>
                                  <td class="text-center"><?php echo $stok;?></td>
                                  <td><?php echo $kat;?></td>
                                  <td><?php echo $nm;?></td>
                                  
                              </tr>
                          <?php endforeach;?>
                          </tbody>
                      </table>
                  </div>

              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <h5 class="card-title">Penjualan Tgl: <span><?php echo tgl_indo(date('Y-m-d'));?></span></h5>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body m-0 p-0">
                <div class="row">
                  <div class="col-md-12">
                      <div class="table-responsive-sm">
                        <table class="table table-hover table-sm" id="tbljual">
                          <thead>
                            <?php $x=$tlap->row_array();?>
                            <tr>
                                <th width="6px">!# </th>
                                <th>Nama</th>
                                <th>Sat</th>
                                <th>Jual</th>
                                <th>Jumlah</th>
                                <th>Diskon</th>
                                <th>Total</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $no=0;
                                    foreach ($lap->result_array() as $a):
                                        $no++;
                                        $nofak=$a['jual_nofak'];
                                        $tgl=$a['jual_tanggal'];
                                        $kobar=$a['d_jual_barang_id'];
                                        $nabar=$a['d_jual_barang_nama'];
                                        $satuan=$a['d_jual_barang_satuan'];
                                        $harjul=$a['d_jual_barang_harjul'];
                                        $qty=$a['d_jual_qty'];
                                        $diskon=$a['d_jual_diskon'];
                                        $total=$a['d_jual_total'];
                              ?>
                              <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $nabar;?></td>
                                <td><?php echo $satuan;?></td>
                                <td><?php echo 'Rp '.number_format($harjul);?></td>
                                <td class="text-center"><?php echo $qty;?></td>
                                <td><?php echo 'Rp '.number_format($diskon);?></td>
                                <td><?php echo 'Rp '.number_format($total);?></td>
                              </tr>
                              <?php endforeach;?>
                          </tbody>
                          <tfoot>
                              <tr>
                                  <td colspan="6"><b>Total</b></td>
                                  <td><b><?php echo 'Rp '.number_format($x['total']);?></b></td>
                              </tr>
                          </tfoot>
                        </table>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section>
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
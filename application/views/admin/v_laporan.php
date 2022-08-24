<?php $this->load->view("admin/part/head") ?>
    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

    <!-- Page Content -->
        <section class="content">
            <div class="container-fluid">  
                <div class="row">
                    <div class="col-12">
                        <div class="row d-flex justify-content-end">
                            <?php echo $this->session->flashdata('msg');?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-light border-0">
                                
                            </div>
                            <div class="card-body table-responsive-sm p-0">
                                <table class="table table-hover table-sm">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width:20px">No</th>
                                            <th scope="col">Laporan</th>
                                            <th scope="col">Cetak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <tr>
                                            <td>1</td>
                                            <td>Laporan Data Barang</td>
                                            <td class="text-center" style="width:200px">
                                                <a class="btn btn-xs btn-outline-success" href="<?php echo base_url().'admin/laporan/lap_data_barang'?>" target="_blank"><span class="fal fa-print mr-2"></span> Print</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>Laporan Stok Barang</td>
                                            <td class="text-center" style="width:200px">
                                                <a class="btn btn-xs btn-outline-success" href="<?php echo base_url().'admin/laporan/lap_stok_barang'?>" target="_blank"><span class="fal fa-print mr-2"></span> Print</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td>Laporan Penjualan</td>
                                            <td class="text-center" style="width:200px">
                                                <a class="btn btn-xs btn-outline-success" href="<?php echo base_url().'admin/laporan/lap_data_penjualan'?>" target="_blank"><span class="fal fa-print mr-2"></span> Print</a>
                                            </td>
                                        </tr>

                                    <!--<tr>
                                            <td>4</td>
                                            <td>Laporan Penjualan PerTanggal</td>
                                            <td class="text-center" style="width:200px">
                                                <a class="btn btn-xs btn-outline-success" href="#lap_jual_pertanggal" data-toggle="modal"><span class="fal fa-print mr-2"></span> Print</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>5</td>
                                            <td>Laporan Penjualan PerBulan</td>
                                            <td class="text-center" style="width:200px">
                                                <a class="btn btn-xs btn-outline-success" href="#lap_jual_perbulan" data-toggle="modal"><span class="fal fa-print mr-2"></span> Print</a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>6</td>
                                            <td>Laporan Penjualan PerTahun</td>
                                            <td class="text-center" style="width:200px">
                                                <a class="btn btn-xs btn-outline-success" href="#lap_jual_pertahun" data-toggle="modal"><span class="fal fa-print mr-2"></span> Print</a>
                                            </td>
                                        </tr>-->

                                        <tr>
                                            <td>4</td>
                                            <td>Laporan Laba/Rugi</td>
                                            <td class="text-center" style="width:200px">
                                                <a class="btn btn-xs btn-outline-success" href="#lap_laba_rugi" data-toggle="modal"><span class="fal fa-print mr-2"></span> Print</a>
                                            </td>
                                        </tr>
                                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>    

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertanggal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Pilih Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_pertanggal'?>" target="_blank">
                        <div class="modal-body">                            
                            <div class="form-group">
                                <label>Per Tanggal:</label>
                                <div class="input-group date" id="datepicker" data-target-input="nearest">
                                    <input type='text' name="tgl" class="form-control datetimepicker-input" value="" placeholder="Format (2021-01-01)" required/>
                                    <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                        <div class="input-group-text bg-light"><i class="fal fa-calendar-alt"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <div class="btn-group">
                                <button class="btn btn-outline-secondary btn-xs" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-outline-danger btn-xs"><span class="fal fa-print mr-2"></span> Cetak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_perbulan" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header border-0">
                <h5>Pilih Bulan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_perbulan'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Per Bulan</label>
                        <div class="col-xs-9">
                                <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required>
                                <?php foreach ($jual_bln->result_array() as $k) {
                                    $bln=$k['bulan'];
                                ?>
                                    <option><?php echo $bln;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer border-0">
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary btn-xs" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-outline-danger btn-xs"><span class="fal fa-print mr-2"></span> Cetak</button>
                    </div>
                </div>
            </form>
            </div>
            </div>
        </div>

        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="lap_jual_pertahun" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header border-0">
                <h5>Pilih Tahun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_penjualan_pertahun'?>" target="_blank">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tahunan</label>
                        <div class="col-xs-9">
                                <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required>
                                <?php foreach ($jual_thn->result_array() as $t) {
                                    $thn=$t['tahun'];
                                ?>
                                    <option><?php echo $thn;?></option>
                                <?php }?>
                                </select>
                        </div>
                    </div>
                           

                </div>

                <div class="modal-footer border-0">
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary btn-xs" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button class="btn btn-outline-danger btn-xs"><span class="fal fa-print mr-2"></span> Cetak</button>
                    </div>
                </div>
            </form>
            </div>
            </div>
        </div>
        
        <div class="modal fade" id="lap_laba_rugi" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Per Bulan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/laporan/lap_laba_rugi'?>" target="_blank">
                        <div class="modal-body">

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Bulan</label>
                                <div class="col-xs-9">
                                        <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required>
                                        <?php foreach ($jual_bln->result_array() as $k) {
                                            $bln=$k['bulan'];
                                        ?>
                                            <option><?php echo $bln;?></option>
                                        <?php }?>
                                        </select>
                                </div>
                            </div>
                                

                        </div>

                        <div class="modal-footer border-0">
                            <div class="btn-group">
                                <button class="btn btn-outline-secondary btn-xs" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-outline-danger btn-xs"><span class="fal fa-print mr-2"></span> Cetak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        

        <!--END MODAL-->

    <?php $this->load->view("admin/part/foo") ?>
<script>
  $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'DD MMMM YYYY HH:mm',
        });
        
        $('#datepicker').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#datepicker2').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#timepicker').datetimepicker({
            format: 'HH:mm'
        });
    });
</script>
    
</body>

</html>

<?php $this->load->view("admin/part/head") ?>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row d-flex justify-content-end">
                    <?= alert_bs();?>
                </div>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="card-tools">
                                </div>
                                <h5 class="card-title">Pengaturan Toko</h5>
                                <div class="card-tools btn-group">
                                    <button class="btn btn-success btn-xs mb-2" data-toggle="modal" data-target="#help"><i class="fal fa-question mr-1"></i>BANTUAN</button>
                                    <button class="btn btn-warning btn-xs mb-2" data-toggle="modal" data-target="#logo"><i class="fal fa-icons mr-1"></i>LOGO</button>
                                    <a href="<?= base_url(); ?>admin/pengaturan/backup" title="Unduh Database System" class="btn btn-primary btn-xs mb-2"><i class="fal fa-download mr-1"></i>DATABASE</a>
                                    <!--<a class="btn btn-info btn-sm mb-2" href="faicons">+ LOGO</a>-->
                                </div>
                            </div>
                            <div class="card-body">
                                <?php 
                                    $no=0;
                                    foreach ($peng->result_array() as $a):
                                        $no++;
                                        $pid=$a['pengaturan_id'];
                                        $pnm=$a['pengaturan_nama'];
                                        $pfoo=$a['pengaturan_foo'];
                                        $palt=$a['pengaturan_alt'];
                                        $php=$a['pengaturan_hp'];
                                        $plogo=$a['pengaturan_logo'];
                                        $pkota=$a['pengaturan_kota'];
                                        $pplus=$a['pengaturan_plus'];
                                ?>
                                <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengaturan/edit_pengaturan'?>" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <?php if (!empty($plogo)) { ?>
                                                <img class="img-rounded" width="100%" src="<?php echo base_url().'uploads/pengaturan/'.$plogo;?>" title="<?php echo $pnm ?>">
                                            <?php } else { ?>
                                                <div class="text-center">
                                                    <i class='fal fa-building fa-3x text-muted'></i>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3" >Nama Perusahaan</label>
                                                        <div class="col-xs-9">
                                                            <?php if (!empty($pnm)) { ?>
                                                            <input name="pnm" class="form-control bg-warsoft" type="text" value="<?php echo $pnm ?>" required>
                                                            <?php } else { ?><input name="pnm" class="form-control bg-warsoft" type="text" placeholder="Nama Toko Anda..." required><?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-5">
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-3" >Logo icons</label>
                                                        <div class="col-xs-9">
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <?php if (!empty($pplus)) { ?>
                                                                    <span class="input-group-text" id="basic-addon1"><i class="fal fa-<?= $pplus;?>"></i></span>
                                                                    <?php } else { ?><span class="input-group-text" id="basic-addon1"><i class="fal fa-icons"></i></span><?php } ?>
                                                                </div>
                                                                    <?php if (!empty($pplus)) { ?>
                                                                    <input name="pplus" class="form-control bg-warsoft" type="text" value="<?php echo $pplus ?>" title="Hanya Tampil Pada Dasbor!">
                                                                    <?php } else { ?><input name="pplus" class="form-control bg-warsoft" type="text" title="Hanya Tampil Pada Dasbor!" placeholder="Sesuai Keinginan Anda..."><?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-3" >Alamat Toko</label>
                                                <div class="col-xs-9">
                                                    <?php if (!empty($palt)) { ?>
                                                    <input name="palt" class="form-control bg-warsoft" type="text" value="<?php echo $palt ?>"required>
                                                    <?php } else { ?><input name="palt" class="form-control bg-warsoft" type="text" placeholder="Alamat Toko..."required><?php } ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label class="control-label col-xs-3" >Nomor Telp</label>
                                                        <div class="col-xs-9">
                                                            <?php if (!empty($php)) { ?>
                                                            <input name="php" class="form-control bg-warsoft" type="text" value="<?php echo $php ?>"required>
                                                            <?php } else { ?><input name="php" class="form-control bg-warsoft" type="text" placeholder="No Telp Toko..."required><?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="control-label col-xs-3" >Kota</label>
                                                        <div class="col-xs-9">
                                                            <?php if (!empty($pkota)) { ?>
                                                            <input name="pkota" class="form-control bg-warsoft" type="text" value="<?php echo $pkota ?>"required>
                                                            <?php } else { ?><input name="pkota" class="form-control bg-warsoft" type="text" placeholder="Kota/Daerah Toko..." required><?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-xs-3" >Logo Toko</label>
                                                <div class="col-xs-9">
                                                    <div class="custom-file">
                                                        <input type="file" name="filefoto" class="custom-file-input" id="customFile" title="Ganti Logo Toko Anda">
                                                        <label class="custom-file-label bg-warsoft" for="customFile">Pilih Logo Anda..</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?php if (!empty($pfoo)) { ?>
                                        <label class="control-label col-xs-3" >Keterangan</label><br>
                                        <textarea name="pfoo" class="form-control bg-warsoft" rows="3"><?php echo $pfoo ?></textarea>
                                        <?php } else { ?><textarea name="pfoo" class="form-control bg-warsoft" rows="3">Keterangan Untuk User akan Tercetak Pada Faktur Penjualan</textarea><?php } ?>
                                    </div>
                                    <!--<input type="file" class="form-control-file" id="exampleFormControlFile1" name="filefoto">-->
                                    <div class="modal-footer border-0">
                                        <input type="hidden" name="gambar" value="<?php echo $plogo;?>">
                                        <div class="btn-group">
                                            <button class="btn btn-success btn-sm"><i class="fal fa-sync mr-2"></i>UPDATE</button>
                                        </div>
                                    </div>
                                </form>
                            <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 .ml-auto">
                        <div class="card" style="background-image: url('<?= base_url().'uploads/pengaturan/card_2.png';?>');no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;display:block;">
                            <div class="card-header border-0">
                                <div class="card-tools">
                                    <p class="text-xs text-muted"><i class="fal fa-address-card mr-2"></i>Kartu Nama</p>
                                </div>    
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td class="w-50"><span class="h3 font-weight-light">
                                                <span class="text-uppercase"><?php echo $this->session->userdata('nama');?></span></span></br>
                                                <?php if (!empty($pnm)) { ?>
                                                <?php echo '<i class="fal fa-building mr-2"></i><span class="font-weight-bold text-info">' .$pnm. '</span><br>' ?>
                                                <?php } else { ?><i class="fal fa-building mr-2"></i>Nama Perusahaan<br><?php } ?>
                                                <?php if (!empty($palt)) { echo '<i class="fal fa-map-marker mr-2"></i>'.$palt.''; } else { echo '<span class="text-warning">Form belum terisi</span>'; }?></br><i class="fal fa-mobile mr-2"></i><?php if (!empty($php)) { echo $php; } else { echo '<span class="text-warning">Form belum terisi</span>'; }?>
                                            </td>
                                            <td class="w-50"></td>
                                            <!--<td colspan="2">FAKTUR PENJUALAN TUNAI</br>Kepada Yth</br><b>Pelangan Umum</b></br>+62 xxx-xxx-xxx<br>Di <?php if (!empty($pkota)) { echo $pkota; } else { echo '<span class="text-warning">Form belum terisi</span>'; }?></td>-->
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><?php if (!empty($pfoo)) { echo $pfoo; } else { echo '<span class="text-warning">Form belum terisi</span>'; }?></td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="mb-4 pb-3
                            ">
                            </div>
                        </div>
                        <div class="card" style="background-image: url('<?= base_url().'uploads/pengaturan/card.png';?>');no-repeat center center fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;display:block;">
                            <div class="card-header border-0">
                                <div class="card-tools">
                                    <p class="text-xs text-muted"><i class="fal fa-address-card mr-2"></i>Tampak Depan</p>
                                </div>    
                            </div>
                            <div class="card-body text-center">
                                <?php if (!empty($plogo)) { ?>
                                    <img class="img-circle" width="25%" src="<?php echo base_url().'uploads/pengaturan/'.$plogo;?>" title="<?php echo $pnm ?>">
                                <?php } else { ?>
                                    <div class="text-center">
                                        <i class='fal fa-building fa-3x text-muted'></i>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="mb-4 pb-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
        <!-- Modal -->
        <?php
            foreach ($peng->result_array() as $a) {
                $id=$a['pengaturan_id'];
                $nm=$a['pengaturan_nama'];
            ?>
            <div id="modalEditPelanggan<?php echo $id?>" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Edit Pengaturan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengaturan/edit_pengaturan'?>">
                    <div class="modal-body">
                        <input name="kode" type="hidden" value="<?php echo $id;?>">

                <div class="form-group">
                    <label class="control-label col-xs-3" >Pengaturan</label>
                    <div class="col-xs-9">
                        <input name="pengaturan" class="form-control" type="text" value="<?php echo $nm;?>"required>
                    </div>
                </div>

            </div>
                    <div class="modal-footer border-0">
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-outline-success btn-sm">Simpan</button>
                        </div>                            
                    </div>
                </form>
            </div>
            </div>
            </div>
        <?php
    }
    ?>
                <!-- ============ MODAL EDIT =============== -->
                
                <div id="help" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog modal-center">
                    <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5>Kode HTML</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                    Note:<br>
                    Kode HTML sederhana untuk mengisi Baris <label>Keterangan</label>
                    <ol>
                        <li><b class="text-danger">&lt;small&gt;...&lt;/small&gt;</b> untuk Mengecilkan Huruf</li>
                        <li><b class="text-danger">&lt;i&gt;...&lt;/i&gt;</b> untuk Mengecilkan Huruf</li>
                        <li><b class="text-danger">&lt;b&gt;...&lt;/b&gt;</b> untuk merubah menjadi Huruf tebal</li>
                        <li><b class="text-danger">&lt;br&gt;</b> untuk pindah baris (ENTER)</li>
                    </ol>

                    </div>
                    <div class="modal-footer border-0">
                        <div class="btn-group">
                        <i class="fal fa-sync fa-spin" id="loading" style="display:none"></i>
                            <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>                            
                        </div>                            
                    </div>
                </div>
                </div>
                </div>

                <div id="logo" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog modal-center">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5>LOGO AWESOME v5 PRO Light</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="table-responsive-sm">
                                    <table class="table table-sm table-borderless w-100" id="table-query">
                                        <thead class="shadow-sm">
                                            <tr>
                                                <th class="text-center"><h5>Logo</h5></th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>                            
                            </div>
                            <div class="modal-footer border-0">
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>                            
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
        


    <?php $this->load->view("admin/part/foo") ?>
    <script src="<?php echo base_url().'assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js'?>"></script>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#table-query').DataTable({
                "processing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'ftip',
                "order": [[ 0, 'ASC' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/pengaturan/faicons');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"class": "shadow-sm p-0","data": "fa_nama",
                      "render": 
                        function( data, type, row, meta ) {
                            return `<div class="rounded p-2"><i class="fal fa-${row.fa_nama} fa-lg mr-2"></i>${row.fa_nama}</div>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#table-query_wrapper .col-ms-6:eq(0)');
        });
    </script>
    <script>
        $(function () {
        bsCustomFileInput.init();
        });
    </script>
</body>

</html>

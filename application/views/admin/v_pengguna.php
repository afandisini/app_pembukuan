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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <!--<a href="#" data-toggle="modal" data-target="#largeModal" class="btn btn-success btn-sm shadow-sm"><i class="fal fa-user-unlock mr-1"></i> Pengguna</a>-->
                            </div>
                            <div class="card-body table-responsive-sm p-0">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center;width:40px;">No</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>ID Pengguna</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $no=0;
                                        foreach ($data->result_array() as $a):
                                            $no++;
                                            $id=$a['user_id'];
                                            $nm=$a['user_nama'];
                                            $username=$a['user_username'];
                                            $password=$a['user_password'];
                                            $level=$a['user_level'];
                                            $status=$a['user_status'];
                                            $ufoto=$a['user_foto'];
                                    ?>
                                        <tr>
                                            <td><?php echo $no;?></td>
                                            <td>
                                            <?php if (!empty($ufoto)) { ?>
                                                <img class="img-thumbnail rounded-circle shadow-sm" width="40px" src="<?php echo base_url().'uploads/users/'.$ufoto;?>">
                                            <?php } else { ?>
                                                <span id="note" tabindex="0" data-toggle="tooltip" title="Silakan EDIT Tambah Gambar Profil Pengguna">
                                                <img class="img-thumbnail rounded-circle shadow-sm" width="40px" src="<?php echo base_url().'uploads/no_pict.webp';?>">
                                                </span>
                                                <script>$('#note').tooltip(options)</script>
                                            <?php } ?></td>
                                            <td><?php echo $nm;?></td>
                                            <td><?php echo $username;?></td>
                                            <td>
                                                <div class="btn-group float-sm-right">
                                                    <a class="btn btn-xs btn-info" href="#modalEditPelanggan<?php echo $id?>" data-toggle="modal" title="Edit"><span class="fal fa-sync-alt"></span> Ubah</a>
                                                    <?php if ($status == 1) {$p = '<a class="btn btn-xs btn-success" href="#modalNonAktifkan'.$id.'" data-toggle="modal" title="ID Aktif"><span class="fal fa-check mr-2"></span>Aktifkan</a>';}else{$p = '<a class="btn btn-xs btn-secondary" href="#modalAktifkan'.$id.'" data-toggle="modal" title="ID Aktif"><span class="fal fa-times mr-2"></span>Non Aktif</a>';}$output= $p; echo $p;?>
                                                    <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan<?php echo $id?>" data-toggle="modal" title="Hapus"><span class="fal fa-trash-alt"></span> Hapus</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>    
                            </div>
                        </div>
                    </div>
                    <p class="text-muted text-sm ml-2"><strong>Note:</strong><br> Tidak Disarankan Untuk Meng-Hapus ID Pengguna Apabila Telah Melakukan Transaksi Penjualan, Akan Berpengaruh Pada Laporan Penjualan.</p>
                </div>
            </div>
        </section>
    </div>
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header border-0">
                <h5>Tambah <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/tambah_pengguna'?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-sm-4">Nama</label>
                        <div class="col-sm-12">
                            <input name="nama" class="form-control" type="text" placeholder="Masukan Nama..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">ID Pengguna</label>
                        <div class="col-sm-12">
                            <input name="username" class="form-control" type="text" placeholder="Masukan ID Pengguna..." required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Kata Sandi</label>
                        <div class="input-group col-sm-12 mb-3" id="show_hide_password">
                            <input name="password" class="form-control" type="password" placeholder="Masukan Kata Sandi...">
                            <div class="input-group-append">
                                <a href="" class="input-group-text"><i class="fal fa-eye-slash text-danger" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4">Ulangi Kata Sandi</label>
                        <div class="input-group col-sm-12 mb-3" id="show_hide_password2">
                            <input name="password2" class="form-control" type="password" placeholder="Ulangi Kata Sandi...">
                            <div class="input-group-append">
                                <a href="" class="input-group-text"><i class="fal fa-eye-slash text-danger" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"> 
                            <div class="form-group">
                                <label class="control-label col-sm-4">Level</label>
                                <div class="col-sm-12">
                                    <select name="level" class="form-control" required>
                                        <option value="1">Admin</option>
                                        <option value="3">Supervisor</option>
                                        <option value="2">Kasir</option>
                                    </select>
                                </div>
                            </div>
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

        <!-- ============ MODAL EDIT =============== -->
                <?php
                foreach ($data->result_array() as $a) {
                    $id=$a['user_id'];
                    $nm=$a['user_nama'];
                    $username=$a['user_username'];
                    $password=$a['user_password'];
                    $level=$a['user_level'];
                    $status=$a['user_status'];
                    $user_foto=$a['user_foto'];
                ?>
                    <div id="modalEditPelanggan<?php echo $id?>" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5>Edit <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/edit_pengguna'?>" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input name="kode" type="hidden" value="<?php echo $id;?>">

                                <div class="form-group">
                                    <label class="control-label col-sm-4">Nama</label>
                                    <div class="col-sm-12">
                                        <input name="nama" class="form-control" type="text" value="<?php echo $nm;?>" placeholder="Input Nama..." required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-4">ID Pengguna</label>
                                    <div class="col-sm-12">
                                        <input name="username" class="form-control" type="text" value="<?php echo $username;?>" placeholder="Input Username..." required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12">Kata Sandi <small class="text-danger">* opsional</small></label>
                                    <div class="input-group col-sm-12 mb-3" id="show_hide_password">
                                        <input name="password" class="form-control" type="password" placeholder="Masukan Kata Sandi...">
                                        <div class="input-group-append">
                                            <a href="" class="input-group-text"><i class="fal fa-eye-slash text-danger" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12">Ulangi Kata Sandi <small class="text-danger">* opsional</small></label>
                                    <div class="input-group col-sm-12 mb-3" id="show_hide_password2">
                                        <input name="password2" class="form-control" type="password" placeholder="Ulangi Kata Sandi...">
                                        <div class="input-group-append">
                                            <a href="" class="input-group-text"><i class="fal fa-eye-slash text-danger" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12"> 
                                        <div class="form-group">
                                            <label class="control-label col-sm-4">Level</label>
                                            <div class="col-sm-12">
                                                <select name="level" class="form-control" required>
                                                <?php if ($level=='1'):?>
                                                    <option value="1" selected>Admin</option>
                                                    <option value="3">Supervisor</option>
                                                    <option value="2">Kasir</option>
                                                <?php elseif ($level=='1'):?>
                                                    <option value="1">Admin</option>
                                                    <option value="3" selected>Supervisor</option>
                                                    <option value="2">Kasir</option>
                                                <?php else:?>
                                                    <option value="1">Admin</option>
                                                    <option value="3">Supervisor</option>
                                                    <option value="2" selected>Kasir</option>
                                                <?php endif;?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-12" >Foto Anda <small class="text-danger">* opsional</small></label>
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input type="file" name="filefoto" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Pilih Foto Anda..</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <div class="modal-footer border-0">
                                    <input type="hidden" name="gambar" value="<?php echo $user_foto;?>">
                                    <input type="hidden" name="uname" value="<?php echo $username;?>">
                                    <div class="btn-group">
                                        <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                        <button class="btn btn-outline-success btn-sm">Ubah</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
        }
        ?>

        <!-- ============ MODAL HAPUS =============== -->
            <?php
                foreach ($data->result_array() as $a) {
                    $id=$a['user_id'];
                    $nm=$a['user_nama'];
                    $username=$a['user_username'];
                    $password=$a['user_password'];
                    $level=$a['user_level'];
                    $status=$a['user_status'];
            ?>
                <div id="modalHapusPelanggan<?php echo $id?>" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content">
                                <div class="modal-header border-0">
                                    <h5>Hapus <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/hapus_pengguna'?>">
                                    <div class="modal-body text-center">
                                        <p>Yakin Hapus <?php echo isset($nmpage) ? $nmpage : ''; ?><br><b class="text-red"><?php echo $nm;?></b>..?</p>
                                        <p class="text-muted text-sm text-left"><strong>Note:</strong><br> Tidak Disarankan Untuk Meng-Hapus ID Pengguna Apabila Telah Melakukan Transaksi Penjualan, Akan Berpengaruh Pada Laporan Penjualan.
                                        </p>
                                                <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                    </div>
                                    <div class="modal-footer border-0">
                                        <div class="btn-group">
                                            <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                            <button class="btn btn-outline-danger btn-sm">Hapus</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="modalNonAktifkan<?php echo $id?>" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5>Nonaktifkan <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/nonaktifkan'?>">
                                <div class="modal-body text-center">
                                    <p>Yakin Me-Non Aktifkan <?php echo isset($nmpage) ? $nmpage : ''; ?><br><b class="text-red"><?php echo $nm;?></b>..?</p>
                                            <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                </div>
                                <div class="modal-footer border-0">
                                    <div class="btn-group">
                                        <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                                        <button class="btn btn-outline-danger btn-sm">Oke</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div id="modalAktifkan<?php echo $id?>" data-backdrop="static"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5>Aktifkan <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/pengguna/aktifkan'?>">
                                <div class="modal-body text-center">
                                    <p>Anda Ingin Aktifkan <?php echo isset($nmpage) ? $nmpage : ''; ?><br><b class="text-red"><?php echo $nm;?></b>..?</p>
                                            <input name="kode" type="hidden" value="<?php echo $id; ?>">
                                </div>
                                <div class="modal-footer border-0">
                                    <div class="btn-group">
                                        <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                                        <button class="btn btn-outline-danger btn-sm">Oke</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>

        <!--END MODAL-->
        <?php $this->load->view("admin/part/foo") ?>
        <script>
            $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if($('#show_hide_password input').attr("type") == "text"){
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass( "fa-eye-slash text-danger" );
                        $('#show_hide_password i').removeClass( "fa-eye text-success" );
                    }else if($('#show_hide_password input').attr("type") == "password"){
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass( "fa-eye-slash text-danger" );
                        $('#show_hide_password i').addClass( "fa-eye text-success" );
                    }
                });
                $("#show_hide_password2 a").on('click', function(event) {
                    event.preventDefault();
                    if($('#show_hide_password2 input').attr("type") == "text"){
                        $('#show_hide_password2 input').attr('type', 'password');
                        $('#show_hide_password2 i').addClass( "fa-eye-slash text-danger" );
                        $('#show_hide_password2 i').removeClass( "fa-eye text-success" );
                    }else if($('#show_hide_password2 input').attr("type") == "password"){
                        $('#show_hide_password2 input').attr('type', 'text');
                        $('#show_hide_password2 i').removeClass( "fa-eye-slash text-danger" );
                        $('#show_hide_password2 i').addClass( "fa-eye text-success" );
                    }
                });
            });
        </script>
    <script src="<?php echo base_url().'assets/adminlte/plugins/bs-custom-file-input/bs-custom-file-input.min.js'?>"></script>
    <script>
        $(function () {
        bsCustomFileInput.init();
        });
    </script>
    
</body>
</html>

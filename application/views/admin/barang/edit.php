<?php
    $id=$a['barang_id'];
    $nm=$a['barang_nama'];
    $satuan=$a['barang_satuan'];
    $harpok=$a['barang_harpok'];
    $harpokRp = number_format($harpok);
    $harjul=$a['barang_harjul'];
    $harjulRp=number_format($harjul);
    $harjul_grosir=$a['barang_harjul_grosir'];
    $harjul_grosirRp=number_format($harjul_grosir);
    $stok=$a['barang_stok'];
    $min_stok=$a['barang_min_stok'];
    $kat_id=$a['barang_keg_id'];
    $kat_nama=$a['keg_nama'];
?>
<div class="modal-body p-0">
    <nav class="text-muted text-sm pt-2 bg-light rounded">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><i class="fal fa-eye mr-2"></i><?php echo isset($lihat) ? $lihat : ''; ?></a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fal fa-edit mr-2"></i><?php echo isset($edit) ? $edit : ''; ?></a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <div class="modal-body p-0">
                <div class="row">
                    <div class="col-md-12">
                        <!--<div class="col-12 col-sm-6">
                            <div class="col-12">
                                <img src="<?php echo base_url().'uploads/no_pict.webp'?>" class="product-image" alt="Product Image">
                            </div>
                            <div class="col-12 product-image-thumbs">
                                <div class="product-image-thumb active"><img src="<?php echo base_url().'uploads/no_pict.webp'?>" alt="Product Image"></div>
                                <div class="product-image-thumb"><img src="<?php echo base_url().'uploads/no_pict.webp'?>" alt="Product Image"></div>
                                <div class="product-image-thumb"><img src="<?php echo base_url().'uploads/no_pict.webp'?>" alt="Product Image"></div>
                                <div class="product-image-thumb"><img src="<?php echo base_url().'uploads/no_pict.webp'?>" alt="Product Image"></div>
                                <div class="product-image-thumb"><img src="<?php echo base_url().'uploads/no_pict.webp'?>" alt="Product Image"></div>
                            </div>
                        </div>-->
                        <div class="col-12">
                            <h3 class="my-3 pl-2"><?php echo $nm;?></h3>
                            <p><?= $a['barang_ket'];?></p>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr>
                                        <th>Kode Barang:</th>
                                        <th><?php echo $id;?></th>
                                    </tr>
                                    <tr>
                                        <td>Kegiatan:</td>
                                        <td><?php echo $kat_nama;?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Pokok:</td>
                                        <td>Rp <?php echo $harpokRp;?></td>
                                    </tr>
                                    <tr>
                                        <td>Harga Jual:</td>
                                        <td>Rp <?php echo $harjulRp;?></td>
                                    </tr>
                                    <tr>
                                        <td>Stok Barang:</td>
                                        <td><?php echo $stok;?> <?php echo $satuan;?> tersisa</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <?php
                                $barang_varian = $this->db->get_where('tbl_barang_varian',['barang_id' => $a['barang_id']]);
                                if($barang_varian->num_rows() > 0)
                                {
                            ?>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <tr class="bg-light">
                                        <th>#!</th>
                                        <th>IMEI/SN</th>
                                        <th>Warna</th>
                                        <th>Garansi</th>
                                        <th>Stok</th>
                                    </tr>
                                    <?php $no = 1; foreach($barang_varian->result() as $r){?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $r->sn;?></td>
                                        <td><?= $r->warna;?></td>
                                        <td><?= $r->spesifikasi;?></td>
                                        <td><?php 
                                            if ($r->stok == 0) {
                                                    $p = '<span class="text-muted">Belum dibeli</span>';
                                                    }else{
                                                    $p = $r->stok .' ' .$satuan;
                                                    } $output= $p;?><?= $p;?></td>
                                    </tr>  
                                    <?php }?>
                                </table>
                            </div>
                            <?php }else{?>
                            <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer border-0">
            <div class="btn-group">
                <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
            </div>
        </div>
        </div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/barang/edit_barang'?>">
            <input name="harjul_grosir" class="harjul form-control" type="hidden" value="<?php echo $harjul_grosirRp;?>" placeholder="Harga Jual Grosir..." required>
            <input name="min_stok" class="form-control" type="hidden" value="<?php echo $min_stok;?>" placeholder="Minimal Stok..." readonly required>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label" >Kode Barang</label>
                                <div class="col-sm-12 p-0">
                                    <input name="kobar" class="form-control" type="text" value="<?php echo $id;?>" placeholder="Kode Barang..." readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Kegiatan</label>
                                <div class="col-sm-12 p-0">
                                    <select name="kegiatan" class="form-control" data-live-search="true" title="Pilih Kegiatan" placeholder="Pilih Kegiatan" required>
                                        <?php foreach ($kegiatan->result_array() as $k2) {
                                            $id_kat=$k2['keg_id'];
                                            $nm_kat=$k2['keg_nama'];
                                            if($id_kat==$kat_id)
                                                echo "<option value='$id_kat' selected>$nm_kat</option>";
                                            else
                                                echo "<option value='$id_kat'>$nm_kat</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nama Barang</label>
                                <div class="col-sm-12 p-0">
                                    <input name="nabar" class="form-control" type="text" value="<?php echo $nm;?>" placeholder="Nama Barang..." required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label pr-2">Stok | Satuan</label>
                                <div class="input-group">
                                    <input name="stok" class="form-control" type="number" value="<?php echo $stok;?>" title="Penambahan dari Pembelian Barang" required>
                                    <input type="text" class="form-control" name="satuan" value="<?php echo $satuan;?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label text-success">Harga Jual</label>
                                <div class="col-sm-12 p-0">
                                    <input name="harjul" class="harjul form-control" type="text" value="<?php echo $harjulRp;?>" placeholder="Harga Jual..." required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Harga Pokok</label>
                            <div class="form-group">
                                <div class="col-sm-12 p-0">
                                    <input name="harpok" class="harpok form-control" type="text" value="<?php echo $harpokRp;?>" placeholder="Harga Pokok..." required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                $barang_varian = $this->db->get_where('tbl_barang_varian',['barang_id' => $a['barang_id']]);
                                if($barang_varian->num_rows() > 0)
                                {
                            ?>
                            <label for="" class="text-muted">Varian Barang <small class="text-xs text-danger">Note: input Varian Barang Meliputi Varian SN/IMEI dan Varian Warna</small></label>
                            <div class="table-responsive">
                                <table class="table table-borderless w-100" id="table_multiple">
                                    <?php $no = 1; foreach($barang_varian->result() as $r){?>
                                    <tr>
                                        <td class="p-1">
                                            <div class="input-group">
                                                <input name="sn[]" value="<?= $r->sn;?>" required class="form-control" type="text" placeholder="Serial Number">
                                                <input name="warna[]" value="<?= $r->warna;?>" required class="form-control" type="text" placeholder="Warna">
                                                <input name="spesifikasi[]" value="<?= $r->spesifikasi;?>" required class="form-control" type="text" placeholder="Masa Garansi">
                                                <input name="stok[]" value="<?= $r->stok;?>" readonly required class="form-control" type="text" placeholder="Stok">
                                            </div>
                                            <input type="hidden" name="idvarian[]" value="<?= $r->id;?>">
                                        </td>
                                    </tr>
                                    <?php }?>
                                </table>
                            </div>
                                <input type="hidden" name="jenis" value="Varian">
                            <?php }else{?>
                                <input type="hidden" name="jenis" value="Satuan">
                            <?php }?>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Keterangan Barang</label>
                                <textarea name="ketbar" 
                                    class="form-control" id="exampleFormControlTextarea1" rows="4"><?= $a['barang_ket'];?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
                        <button type="submit" class="btn btn-success btn-sm">Ubah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
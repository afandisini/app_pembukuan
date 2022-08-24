<!-- ============ MODAL EDIT =============== -->
    <div class="modal-header border-0">
        <h5>Ubah Input Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/inputdata/update_debet'?>">
        <div class="modal-body">
        <input name="pembukuan_id" class="form-control" type="hidden" value="<?= $edit->pembukuan_id;?>" required>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis </label>
                        <div class="col-xs-9">
                            <input name="pembukuan_nama" class="form-control" type="text" value="<?= $edit->pembukuan_nama;?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Instansi / Client</label>
                        <select class="form-control select2bs4" name="pelanggan_id" title="Pemasukan" required>
                            <option value="">-- Pilih Client --</option>
                            <?php foreach($rekanan as $r){
                                if($edit->pelanggan_id == $r->id)
                                    echo "<option value='$r->id' selected>$r->nama</option>";
                                else
                                    echo "<option value='$r->id'>$r->nama</option>";
                                }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-xs-3" >Keterangan</label>
                <div class="col-xs-9">
                    <textarea name="pembukuan_ket" class="form-control" placeholder="Keterangan" required id="exampleFormControlTextarea1" rows="4"><?= $edit->pembukuan_ket;?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Tanggal Input<br><span class="text-xs text-muted">(Format: <span class="text-xs text-danger">Tahun</span>-<span class="text-xs text-warning">Bulan</span>-<span class="text-xs text-success">Tanggal</span>)</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" id="date2" name="pembukuan_tgl" class="form-control" value="<?= $edit->pembukuan_tgl;?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-xs-3" >Jenis Kegiatan<br><span class="text-xs text-muted">(Pengerjaan dalam Kategori)</span></label>
                        <select class="form-control select2bs4" name="kegiatan" required>
                            <option value="">-- Pilih Kegiatan --</option>
                            <?php foreach($kegiatan as $k){
                                if($edit->kegiatan == $k->keg_id)
                                    echo "<option value='$k->keg_id' selected>$k->keg_nama</option>";
                                else
                                    echo "<option value='$k->keg_id'>$k->keg_nama</option>";
                            }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <?php if ($edit->pembukuan_masuk == 0) { ?>
                <label class="control-label col-xs-3" >Pengeluaran</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">IDR</span>
                    </div>
                    <input name="pembukuan_masuk" type="hidden" value="0">
                    <input name="pembukuan_keluar" class="form-control duit" type="text" value="<?=  number_format($edit->pembukuan_keluar);?>" required>
                </div>
                <?php } else { ?>
                <label class="control-label col-xs-3" >Pemasukan</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">IDR</span>
                    </div>
                    <input name="pembukuan_keluar" type="hidden" value="0">
                    <input name="pembukuan_masuk" class="form-control duit" type="text" value="<?=  number_format($edit->pembukuan_masuk);?>" required>
                </div>
                <?php } ?>
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
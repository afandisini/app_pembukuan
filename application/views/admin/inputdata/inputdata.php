                <div class="modal-header border-0">
                    <h5><?php echo isset($pmasuk) ? $pmasuk : ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-horizontal" method="post" 
                    action="<?php echo base_url().'admin/pemasukan/tambah_debet'?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Jenis <?php echo isset($pmasuk) ? $pmasuk : ''; ?></label>
                                    <div class="col-xs-9">
                                        <input name="anama" class="form-control" type="text" placeholder="Jenis Pengeluaran" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Instansi / Client</label>
                                    <select class="form-control select2bs4" name="mpid" title="Pemasukan" required>
                                        <option value="">-- Pilih Client --</option>
                                        <?php foreach($rekanan as $r){?>
                                        <option value="<?= $r->id;?>"><?= $r->nama;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Keterangan</label>
                            <div class="col-xs-9">
                                <textarea name="aket" class="form-control" placeholder="Keterangan" required id="exampleFormControlTextarea1" rows="4"></textarea>
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
                                        <input type="text" name="mtgl" class="form-control" value="<?= date('Y-m-d h:i:s')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Jenis Kegiatan<br><span class="text-xs text-muted">(Pengerjaan dalam Kategori)</span></label>
                                    <select class="form-control select2bs4" name="mkegid" required>
                                        <option value="">-- Pilih Kegiatan --</option>
                                        <?php foreach($kegiatan as $k){?>
                                        <option value="<?= $k->keg_id;?>"><?= $k->keg_nama;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Pemasukan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">IDR</span>
                                </div>
                                <input name="amas" class="form-control duit" type="text" placeholder="Jumlah Pemasukan" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </div>
                </form>
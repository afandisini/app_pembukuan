<?php
    $kid=$a['keg_id'];
    $keg_nama=$a['keg_nama'];
    $start=$a['start'];
    $end=$a['end'];
    $nilai_kontrak=$a['nilai_kontrak'];
    $opd=$a['opd']
?>
        <div class="modal-header border-0">
            <h5 class="text-muted">EDIT <?= $keg_nama;?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <div class="modal-body p-0">
            <div class="p-2">
                <label class="control-label">Nama Kegiatan</label>
                <input type="text" name="keg_nama" class="form-control mb-2" value="<?= $keg_nama;?>" required>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label class="control-label">Nilai Kontrak</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp.</span>
                            </div>
                            <input type="text" name="nilai_kontrak" class="form-control nilaikontrak" value="<?= number_format($nilai_kontrak);?>" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">OPD / Instansi</label>
                        <input type="text" name="opd" class="form-control" value="<?= $opd;?>" required>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="control-label">Mulai Pengerjaan</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                            </div>
                            <input type="date" name="start" class="form-control datepicker" value="<?= $start;?>" data-provide="datepicker">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">Estimasi Selesai</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fal fa-calendar-check"></i></span>
                            </div>
                            <input type="date" name="end" class="form-control datepicker" value="<?= $end;?>" data-provide="datepicker">
                        </div>
                    </div>
                    <label class="text-muted text-xs ml-2">Format Tanggal Mulai & Selesai (<?= date('Y-m-d');?>)</label>
                </div>
            </div>
        </div>
        <div class="modal-footer border-0">
            <button type="submit" class="btn btn-success btn-sm" type="button">Simpan</button>
        </div>
<script type="text/javascript">
$('input.duit').on('input', function() {
    const value = this.value.replace(/[^\d]/g,"");
    this.value = parseFloat(value).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 0
    });
});
$('input.nilaikontrak').on('input', function() {
    const value = this.value.replace(/[^\d]/g,"");
    this.value = parseFloat(value).toLocaleString('en-US', {
        style: 'decimal',
        maximumFractionDigits: 2,
        minimumFractionDigits: 0,
    });        
});
</script>
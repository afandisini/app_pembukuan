<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kegiatan/del_kegiatan'?>">
<?php $hsl = $a['kegiatan']; if ($hsl < 1) { ?>
    <div class="modal-header border-0">
        <h5>Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <p>Yakin mau menghapus data dari <strong><?= $a['keg_nama']; ?></strong> ?</p>
        <input name="kid" type="hidden" value="<?= $a['keg_id'];?>">
    </div>
    <div class="modal-footer border-0 p-0">
        <button type="submit" class="btn btn-danger hapus btn-sm">Hapus</button>
    </div>
<?php } else { ?>
    <div class="modal-header border-0">
        <h6>Hapus Data</h6>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body text-center">
        <p>
            Maaf... Tidak dapat Menghapus kegiatan <strong><?= $a['keg_nama']; ?></strong>
            <div class="bg-danger m-1 p-1 rounded">Data Kegiatan Sedang Digunakan!</div>
        </p>
    </div>
    <div class="modal-footer border-0 p-0">
        <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
    </div>
<?php } ?>
</form>
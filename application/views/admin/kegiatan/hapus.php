<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kegiatan/del_kegiatan'?>">
<div class="modal-header border-0">
        <h5>Hapus Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <p>Yakin mau menghapus data dari <strong><?= $a['keg_nama']; ?></strong> ?</p>
        <input name="kid" type="hidden" value="<?= $a['keg_id'];?>">
    </div>
    <div class="modal-footer bg-danger border-0 p-0">
            <?php $hsl = $a['verifikasi']; if ($hsl < 1) {$p = '<button type="submit" class="btn btn-danger hapus btn-sm">Hapus</button>';}else{$p = '<span class="text-sm bg-danger text-center w-100 p-2">Sedang digunakan Tidak dapat Dihapus</span>';}$output= $p; echo $p;?>
    </div>
</form>
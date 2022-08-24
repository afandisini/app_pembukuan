<div class="modal-header border-0">
    <h5>Hapus <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/barang/hapus_barang'?>">
    <div class="modal-body text-center">
        <p>Yakin mau menghapus<br> <span class="text-sm font-weight-bold"><?= $a['barang_nama'];?> (<?= $a['barang_id'];?>, <?= $a['barang_ket'];?>)</span>
        <span class="text-danger text-lg font-weight-bold"></span></p>
        <input type="hidden" name="kode" value="<?= $a['barang_id'];?>">
        <input type="hidden" name="jenis" value="<?= $a['barang_varian'];?>">
    </div>
    <div class="modal-footer border-0">
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-outline-danger btn-sm">Hapus</button>
        </div>
    </div>
</form>
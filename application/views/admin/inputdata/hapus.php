<div class="modal-header border-0">
    <h5>Hapus</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/inputdata/Busak'?>">
    <div class="modal-body">
        <p>Yakin mau menghapus data dari <strong><?= $edit->pembukuan_nama; ?></strong> ?</p>
        <input name="kode" type="hidden" value="<?php echo $edit->pembukuan_id; ?>">
    </div>
    <div class="modal-footer border-0">
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button type="submit" class="btn btn-danger hapus btn-sm">Hapus</button>
        </div>
    </div>
</form>
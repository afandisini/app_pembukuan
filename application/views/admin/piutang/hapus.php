<div class="modal-header border-0">
    <h5>Hapus Data Client</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/piutang/delete'?>">
    <div class="modal-body text-center">
        <p>Yakin mau menghapus <br>Pembayaran <strong><?= $edit->pelanggan_id;?></strong> ??
        <span class="text-danger text-lg font-weight-bold"></span></p>
        <input type="hidden" name="piutang_id" value="<?= $edit->piutang_id;?>">
    </div>
    <div class="modal-footer border-0">
        <div class="btn-group">
            <button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-outline-danger btn-sm">Hapus</button>
        </div>
    </div>
</form>
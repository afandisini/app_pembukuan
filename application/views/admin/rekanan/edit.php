<div class="modal-header border-0">
    <h5>Ubah Client</h5>
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/rekanan/update'?>">
    <div class="modal-body">
        <label class="text-muted font-weight-light">Nama Client</label>
        <input type="text" name="nama" placeholder="Nama Client" value="<?= $edit->nama;?>" class="form-control form-control-sm mb-2">
        <label class="text-muted font-weight-light">No Hp</label>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text bg-gradient-light form-control-sm">+62</span>
			</div>
			<input type="number" placeholder="888-111-222" name="hp" value="<?= $edit->hp;?>" class="form-control form-control-sm mb-2">
		</div>
        <label class="text-muted font-weight-light">Alamat</label>
        <textarea name="alamat" rows="5" placeholder="Alamat Tempat Tinggal" class="form-control form-control-sm mb-2" ><?= $edit->alamat;?></textarea>
    </div>
    <div class="modal-footer border-0">
        <input type="hidden" name="id" value="<?= $edit->id;?>">
        <div class="btn-group">
            <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button type="submit" class="btn btn-success btn-sm">Ubah</button>
        </div>
    </div>
</form>
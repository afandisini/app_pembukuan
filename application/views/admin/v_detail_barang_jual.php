<?php 
	error_reporting(0);
	$b=$brg->row_array();
?>
<input type="hidden" name="barang_id" value="<?= $b['barang_id'];?>">
<input type="hidden" name="barang_varian" value="<?= $b['barang_varian'];?>">
<input type="hidden" name="barang_satuan" value="<?= $b['barang_satuan'];?>">
<input type="hidden" name="barang_stok" value="<?= $b['barang_stok'];?>">
<input type="hidden" name="nabar" value="<?php echo $b['barang_nama'];?>">
<input type="hidden" name="harjul" value="<?php echo number_format($b['barang_harjul']);?>">
<table class="table table-sm bg-light">
	<tr>
		<th class="h4 font-weight-bold" colspan="2" scope="col">
			<?php echo $b['barang_nama'];?>
			<button type="button" class="btn btn-info btn-xs">
			STOK<span class="badge badge-light ml-2"><?= $b['barang_stok'];?></span>
			</button>
		</th>
		<th class="h4" colspan="2" scope="col"><?php echo 'Rp ' .number_format($b['barang_harjul']);?></th>
	</tr>
	<tr class="card-outline card-danger">
		<?php if($b['barang_varian'] == 'Varian'){?>
			<th style="width:300px !important;">Varian</th>
		<?php }?>
		<th scope="col">Diskon(Rp)</th>
		<th colspan="2" scope="col">Jumlah</th>
	</tr>
	<tr>
		<?php if($b['barang_varian'] == 'Varian'){?>
			<td>
				<select class="form-control select2bs4" name="varian" required> 
					<option value=""> - pilih varian -</option>
					<?php
						$barang_varian = $this->db->get_where('tbl_barang_varian',['barang_id' => $b['barang_id']]);
						foreach($barang_varian->result() as $r){
					?>
					<option value="<?= $r->id;?>" <?= $r->sn == $kobar ? 'selected' : ''?> 
					<?= $r->stok > 0 ? '' : 'class="d-none" disabled'?>><?= $r->sn;?> | <?= $r->warna;?> | <?= $r->spesifikasi;?></option>
					<?php }?>
				</select>
			</td>
			<td colspan="2">
				<div class="col-sm-12">
					<input type="number" name="diskon" id="diskon" value="0" min="0" class="form-control" required>
				</div>
			</td>
			<td>
				<input type="hidden" name="qty" id="qty" value="1" min="1" max="<?php echo $b['barang_stok'];?>" class="form-control" readonly>
				<div class="btn-group">
					<?php 
						if ($b['barang_stok'] < 1) {
								$p = '<button type="submit" class="btn btn-danger pr-2 pl-2" title="stok habis" disabled><i class="fal fa-empty-set mr-1"></i>Habis</button>';
							}else{
								$p = '<button type="submit" class="btn btn-success pr-2 pl-2" title="Pilih"><i class="fal fa-shopping-cart mr-1"></i>Pilih</button>';
							}
							$output= $p;
							echo $p;
					?>
				</div>
			</td>
		<?php }?>
		<?php if($b['barang_varian'] == 'Satuan'){?>
			<td colspan="2">
			<div class="col-sm-5">
				<input type="number" name="diskon" id="diskon" value="0" min="0" class="form-control form-control-sm" required>
			</div>
			</td>
			<td>
				<div class="btn-group">
					<input type="number" name="qty" id="qty" value="1" min="1" max="<?php echo $b['barang_stok'];?>" class="form-control form-control-sm" required>
					<?php 
						if ($b['barang_stok'] < 1) {
								$p = '<button type="submit" class="btn btn-xs btn-danger btn-block" title="stok habis" disabled><i class="fal fa-empty-set mr-1"></i>Habis</button>';
							}else{
								$p = '<button type="submit" class="btn btn-xs btn-success  btn-block" title="Pilih"><i class="fal fa-shopping-cart mr-1"></i>Pilih</button>';
							}
							$output= $p;
							echo $p;
					?>
				</div>
			</td>
		<?php }?>
	</tr>
	<tr class="bg-white"><td colspan="4"></td></tr>
</table>
<script>
$('.select3').select2();
</script>
					
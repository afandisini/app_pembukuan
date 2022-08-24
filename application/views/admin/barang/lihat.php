<?php
    $id=$b['barang_id'];
    $nm=$b['barang_nama'];
    $satuan=$b['barang_satuan'];
    $harpok=$b['barang_harpok'];
    $harjul=$b['barang_harjul'];
    $harjul_grosir=$b['barang_harjul_grosir'];
    $stok=$b['barang_stok'];
    $min_stok=$b['barang_min_stok'];
    $kat_id=$b['barang_kategori_id'];
    $kat_nama=$b['kategori_nama'];
?>
  <svg class="bd-placeholder-img card-img" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Sample Produk"><title>Produk</title><rect fill="#868e96" width="100%" height="100%"></rect><text fill="#dee2e6" dy=".3em" x="50%" y="50%">Sample Produk</text></svg>
  <div class="card-body">
    <div class="form-group">
        <label class="control-label text-success">Harga (Eceran)</label>
        <div class="col-sm-12 p-0">
            <input name="harjul" class="harjul form-control" type="text" value="" placeholder="Harga Jual..." required>
        </div>
    </div>
  </div>
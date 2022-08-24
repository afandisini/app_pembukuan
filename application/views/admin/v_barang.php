<?php $this->load->view("admin/part/head") ?>
<!-- Navigation -->
<?php $this->load->view('admin/menu');?>
    <!-- Page Content -->
        <section class="content">
            <!--<div class='preloader flex-column justify-content-center align-items-center'>
                <i class='fal fa-circle-notch fa-spin mr-2 fa-fw'></i> Sedang memuat...
            </div>-->
            <div class="row">
                <?= alert_bs();?>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
								<div class="card-tools">
                                    <div class="btn-group">
                                        <a href="<?= base_url('admin/barang/reset');?>" class="btn btn-danger btn-sm"><i class="fal fa-sync-alt mr-2"></i>Reset</a>
                                    </div>
								</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive-sm">
                                    <table class="table table-striped table-sm w-100" id="table-query">
                                        <thead class="text-left">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Kode Barang</th>
                                                <th scope="col">Nama</th>
                                                <th scope="col" class="d-none">Keterangan</th>
                                                <th scope="col">Kegiatan</th>
                                                <th scope="col">Satuan</th>
                                                <th scope="col">Harga Jual</th>
                                                <th scope="col">Stok</th>
                                                <th class="text-center" class="d-print-none">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="9"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="9"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ============ MODAL ADD =============== -->
        <div class="modal fade" id="largeModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Tambah <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/barang/tambah_barang'?>">
                    <input name="harjul_grosir" class="harjul form-control" type="hidden">
                    <div class="modal-body">
                            <!--<div class="form-group">
                            <label class="control-label">Kode Barang</label>
                            <div class="col-sm-12 p-0">
                                <input name="kobar" class="form-control" type="text" placeholder="Kode Barang..." required>
                            </div>
                        </div>-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama Barang</label>
                                    <div class="col-sm-12 p-0">
                                        <input name="nabar" class="form-control" type="text" placeholder="Nama Barang" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Kegiatan</label>
                                    <div class="col-sm-12 p-0">
                                        <select name="kegiatan" class="form-control" required>
                                            <option value="">-- Pilih Kegiatan --</option>
                                            <?php foreach ($kegiatan->result_array() as $kg) {
                                                $id_keg=$kg['keg_id'];
                                                $nm_keg=$kg['keg_nama'];
                                            ?>
                                            <option value="<?php echo $id_keg;?>"><?php echo $nm_keg;?></option>
                                            <?php }?>  
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Modal</label>
                                    <div class="col-sm-12 p-0">
                                        <input name="harpok" class="harpok form-control" type="text" placeholder="Modal">
                                    </div>
                                </div>                                
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label text-success">Harga Jual</label>
                                    <div class="col-sm-12 p-0">
                                        <input name="harjul" class="harjul form-control" type="text" placeholder="Harga Jual">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Satuan</label>
                                    <div class="col-sm-12 p-0">
                                        <input type="text" class="form-control" name="satuan" placeholder="Satuan Barang" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Stok</label>
                                    <input name="stok" value="0" class="form-control" type="text">
                                    <input name="min_stok" value="1" class="form-control" type="hidden" placeholder="Minimal Stok" title="Mencegah Penjualan Barang NULL / Habis / Nol" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Keterangan Barang</label>
                                    <textarea name="ketbar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="jenis" value="Satuan">
                    <div class="modal-footer border-0">
                        <div class="btn-group">
                            <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
                            <button class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

         <!-- ============ MODAL ADD =============== -->
         <div class="modal fade" id="largeModalVarian" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Tambah <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/barang/tambah_barang'?>">
                    <input name="harjul_grosir" class="harjul form-control" type="hidden">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nama Barang</label>
                                    <div class="col-sm-12 p-0">
                                        <input name="nabar" class="form-control" type="text" placeholder="Nama Barang..." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label class="control-label">Kegiatan</label>
                                    <div class="col-sm-12 p-0">
                                        <select name="kegiatan" class="form-control" title="Pilih Kegiatan" required>
                                            <option>-- Pilih Kegiatan --</option>
                                        <?php foreach ($kat2->result_array() as $k2) {
                                            $id_kat=$k2['keg_id'];
                                            $nm_kat=$k2['keg_nama'];
                                            ?>
                                                <option value="<?php echo $id_kat;?>"><?php echo $nm_kat;?></option>
                                        <?php }?>  
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Modal</label>
                                    <div class="col-sm-12 p-0">
                                        <input name="harpok" class="harpok form-control" type="text" placeholder="Modal">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label text-success">Harga Jual</label>
                                    <div class="col-sm-12 p-0">
                                        <input name="harjul" class="harjul form-control" type="text" placeholder="Harga Jual">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Satuan</label>
                                    <div class="col-sm-12 p-0">
                                        <input type="text" class="form-control" name="satuan" placeholder="Satuan Barang" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input name="stok" value="0" readonly class="form-control" type="hidden" placeholder="Stok...">
                                    <input name="min_stok" class="form-control" type="hidden" placeholder="Minimal Stok..." value="1" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="text-muted">Varian Barang <i class="fal fa-arrow-right"></i> <small class="text-xs text-danger">Note: input Varian Barang Meliputi Varian SN/IMEI dan Varian Warna</small></label>
                                <div class="table-responsive">
                                    <table class="table table-borderless w-100" id="table_multiple">
                                        <tr>
                                            <td class="p-1">
                                                <div class="form-group">
                                                    <div class="col-sm-12 p-0">
                                                        <input name="sn[]" required class="form-control" type="text" placeholder="Serial Number">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-1">
                                                <div class="form-group">
                                                    <div class="col-sm-12 p-0">
                                                        <input name="warna[]" required class="form-control" type="text" placeholder="Warna">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-1">
                                                <div class="input-group">
                                                    <input name="spesifikasi[]" required class="form-control" type="text" placeholder="waranti">
                                                </div>
                                            </td>
                                            <td class="p-1">
                                                <a href="javascript:void(0)" class="btn btn-primary" id="tambah_form" onclick="tambah(1)"><i class="fal fa-plus"></i></a>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Keterangan Barang</label>
                                    <textarea name="ketbar" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <input type="hidden" name="jenis" value="Varian">
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
                </div>
            </div>
        </div>
    
    <!-- ============ MODAL LIHAT =============== -->
    <div id="modalLihat" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="lihat-content">
                
            </div>
        </div>
    </div>
    <!-- ============ MODAL EDIT =============== -->
    <div id="modalEdit" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-centered">
            <div class="modal-content" id="ubah-content">
            
            </div>
        </div>
    </div>

    <!-- ============ MODAL HAPUS =============== -->
    <div id="modalHapus" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content" id="delete-content">
                
            </div>
        </div>
    </div>
    <!--END MODAL-->
    <?php $this->load->view("admin/part/foo") ?>
    <script>
    function tambah(i){
        $("#table_multiple").append(`<tr>
                <td class="p-1">
                    <div class="form-group">
                        <div class="col-sm-12 p-0">
                            <input name="sn[]" class="form-control" type="text" placeholder="Serial Number">
                        </div>
                    </div>
                </td>
                <td class="p-1">
                    <div class="form-group">
                        <div class="col-sm-12 p-0">
                            <input name="warna[]" class="form-control" type="text" placeholder="Warna">
                        </div>
                    </div>
                </td>
                <td class="p-1">
                    <div class="form-group">
                        <div class="col-sm-12 p-0">
                            <input name="spesifikasi[]" class="form-control" type="text" placeholder="waranti">
                        </div>
                    </div>
                </td>
                <td class="p-1"><a href="javascript:void(0)" 
                    class="btn btn-danger delete-row" data-id="${i+1}">
                    <i class="fal fa-trash-alt"></i></a></td></tr>`).children(':last');
            $('#tambah_form').attr('onclick',`tambah(${i+1})`);
    }
    </script>
    <script>
    $('#table_multiple tbody').on('click', '.delete-row', function(){
        var rowCount = $('#table_multiple >tbody >tr').length;
        $(this).parent().parent().remove();
        $('#tambah_form').attr('onclick',`tambah(${rowCount-1})`);
    });
    </script>
    <script>
        $('#table-query tbody').on('click', '.ubah', function(){
            var id = $(this).attr('data-id');
            $('#modalEdit').modal('show');
            $.ajax({url:"<?php echo base_url('admin/barang/edit?tipe=edit&id=');?>"+id,success:function(html){
                $("#ubah-content").html(html);
            }});
        });
    </script>
    <script>
        $('#table-query tbody').on('click', '.delete', function(){
            var id = $(this).attr('data-id');
            $('#modalHapus').modal('show');
            $.ajax({url:"<?php echo base_url('admin/barang/edit?tipe=hapus&id=');?>"+id,success:function(html){
                $("#delete-content").html(html);
            }});
        });
    </script>
    <script type="text/javascript">
        $(function(){
            $('.harpok').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.harjul').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
        });
    </script>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#table-query').DataTable({
                "processing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'frBtip',
                lengthMenu: [
                    [ 10, 25, 50, 999999 ],
                    [ 'Cetak 10 baris', 'Cetak 25 baris', 'Cetak 50 baris', 'Cetak Semua' ]
                ],
                buttons: [
                    {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-secondary btn-sm shadow-sm mb-2',footer: true},{text:'<i class="fal fa-plus mr-1"></i> Barang', className: 'btn btn-success btn-sm mb-2', action: function (e, node, config){$('#largeModal').modal('show')}},{text:'<i class="fal fa-sync-alt mr-1"></i> Reset', className: 'btn btn-warning btn-sm mb-2', action: function (e, node, config){$('#largeModal').modal('show')}}
                ],
                "order": [[ 0, 'DESC' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/barang/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'barang_id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    { "data": "barang_id" },  // Tampilkan kategori
                    { "data": "barang_nama" }, 
                    { "className": "d-none", "data": "barang_ket" }, 
                    { "data": "keg_nama" }, 
                    { "data": "barang_satuan" }, 
                    //{ "data": "barang_harpok", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp ' ) }, 
                    { "data": "barang_harjul", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp ' ) },
                    { "className" : "text-center", 
                      "data": "barang_stok" }, 
                    //{ "data": "barang_varian" }, 
                    { "className" : "text-center",
                      "data": "barang_id",
                      "render": 
                        function( data, type, row, meta ) {
                            return `<div class="btn-group text-center" role="group">
                                        
                                        <button class="btn btn-success btn-xs ubah" data-id="${row.barang_id}" title="Edit"><i class="fal fa-sync-alt mr-1"></i>Edit</button>
                                        <button class="btn btn-danger btn-xs delete" data-id="${row.barang_id}" title="Hapus"><i class="fal fa-trash-alt mr-1"></i> Hapus</button>
                                    </div>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#table-query_wrapper .col-ms-6:eq(0)');
        });
    </script>
</body>

</html>

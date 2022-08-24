<?php $this->load->view("admin/part/head") ?>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

        <section class="content">
            <div class="container-fluid">
                <?= alert_bs();?>
                <div class="row">
                    <div class="col-lg-12 mb-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="card-tools btn-group">
                                    <a href="#" data-toggle="modal" data-target="#largeModal" class="btn btn-success shadow-sm btn-sm"><i class="fal fa-plus mr-2"></i> <?php echo isset($nmpage) ? $nmpage : ''; ?></a>
                                </div>
                            </div>
                            <div class="card-body p-0 table-responsive-sm">
                                <table class="table table-sm" id="kategori">
                                    <thead>
                                        <tr>
                                            <th style="width:20px;">No</th>
                                            <th>Kategori</th>
                                            <th style="width:140px;text-align:center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="modal fade" id="largeModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header border-0">
                <h5>Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kategori/tambah_kategori'?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Kategori</label>
                        <div class="col-xs-9">
                            <input name="kategori" class="form-control" type="text" placeholder="Input Nama Kategori..."required>
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

        <!-- ============ MODAL EDIT =============== -->
        <?php foreach ($data->result_array() as $a) {
            $id=$a['kategori_id'];
            $nm=$a['kategori_nama'];
        ?>
            <div id="modalEditPelanggan<?php echo $id?>" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <h5>Edit Kategori</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kategori/edit_kategori'?>">
                            <div class="modal-body">
                                <input name="kode" type="hidden" value="<?php echo $id;?>">

                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Kategori</label>
                                    <div class="col-xs-9">
                                        <input name="kategori" class="form-control" type="text" value="<?php echo $nm;?>"required>
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
        <?php } ?>

        <!-- ============ MODAL HAPUS =============== -->
        <?php foreach ($data->result_array() as $a) {
                        $id=$a['kategori_id'];
                        $nm=$a['kategori_nama'];
                    ?>
                <div id="modalHapusPelanggan<?php echo $id?>" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5>Hapus Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kategori/hapus_kategori'?>">
                        <div class="modal-body">
                            <p>Yakin mau menghapus data <strong><?php echo $nm?></strong>?</p>
                                    <input name="kode" type="hidden" value="<?php echo $id; ?>">
                        </div>
                        <div class="modal-footer border-0">
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
                </div>
            <?php } ?>

        <!--END MODAL-->


    <?php $this->load->view("admin/part/foo") ?>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#kategori').DataTable({
                "rocessing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, 999999 ],
                    [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                ],
                buttons: [{extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-info btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4]}, footer: true}
                ],
                "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/kategori/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'kategori_id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {"data": "kategori_nama" }, 
                    {"data": "kategori_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<div class="btn-group float-sm-right">
                                        <a class="btn btn-xs btn-success" href="#modalEditPelanggan${row.kategori_id}" data-toggle="modal" title="Edit"><span class="fal fa-sync-alt"></span> Ubah</a>
                                        <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan${row.kategori_id}" data-toggle="modal" title="Hapus"><span class="fal fa-trash-alt"></span> Hapus</a>
                                    </div>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#kategori_wrapper .col-ms-6:eq(0)');
        });
    </script>
</body>

</html>

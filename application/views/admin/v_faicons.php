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
                                    <a href="#" data-toggle="modal" data-target="#largeModal" class="btn btn-success shadow-sm btn-sm"><i class="fal fa-plus mr-2"></i> <?= isset($nmpage) ? $nmpage : ''; ?></a>
                                </div>
                            </div>
                            <div class="card-body p-0 table-responsive-sm">
                                <table class="table table-sm" id="faicons">
                                    <thead>
                                        <tr>
                                            <th style="width:20px;">No</th>
                                            <th>Faicons</th>
                                            <th>Kode</th>
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
                <h5>Tambah Faicons</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form class="form-horizontal" method="post" action="<?= base_url().'admin/faicons/tambah_faicons'?>">
                <div class="modal-body">

                    <div class="form-group">
                        <label class="control-label col-xs-3" >Nama Icon</label>
                        <div class="col-xs-9">
                            <input name="fnm" class="form-control mb-3" type="text" placeholder="Input Nama Faicons..."required>
                            <label class="control-label col-xs-3" >Kode Icon</label>
                            <input name="fkod" class="form-control" type="text" placeholder="Input Kode Faicons...">
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
                <?php
                    foreach ($data->result_array() as $a) {
                        $fid=$a['fa_id'];
                        $fnm=$a['fa_nama'];
                        $fkod=$a['fa_kode'];
                    ?>
                <div id="modalEditPelanggan<?= $fid?>" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5>Edit Faicons</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?= base_url().'admin/faicons/update_faicons'?>">
                        <div class="modal-body">
                            <input name="fkod" type="hidden" value="<?= $fid;?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="control-label col-xs-3" >Logo</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-<?= $fnm;?> mr-2"></i></span>
                                    </div>
                                    <input name="fnm" class="form-control" type="text" value="<?= $fnm;?>"required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Kode</label>
                                    <div class="col-xs-9">
                                        <input name="fkod" class="form-control" type="text" value="<?= $fkod;?>"required>
                                    </div>
                                </div>
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
        <?php
                    foreach ($data->result_array() as $a) {
                        $fid=$a['fa_id'];
                        $fnm=$a['fa_nama'];
                        $fkod=$a['fa_kode'];
                    ?>
                <div id="modalHapusPelanggan<?= $fid?>" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                    <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5>Hapus Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?= base_url().'admin/faicons/hapus_faicons'?>">
                        <div class="modal-body">
                            <p>Yakin mau menghapus data <strong><?= $fnm?></strong>?</p>
                                    <input name="fid" type="hidden" value="<?= $fid; ?>">
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
            <?php
        }
        ?>

        <!--END MODAL-->


    <?php $this->load->view("admin/part/foo") ?>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#faicons').DataTable({
                "rocessing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'frtip',
                lengthMenu: [
                    [ 10, 25, 50, 999999 ],
                    [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                ],
                "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/faicons/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'fa_id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {"data": "fa_nama",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<div class="bg-light p-2 rounded"><i class="fal fa-${row.fa_nama} mr-2"></i>${row.fa_nama}</div>`;
                        }
                    }, 
                    {"data": "fa_kode" ,
                    "render": 
                        function( data, type, row, meta ) {
                            return `<div class="bg-light p-2 rounded"><i class="fal fa-${row.fa_kode} mr-2"></i>${row.fa_kode}</div>`;
                        }
                    },  
                    {"data": "fa_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<div class="btn-group float-sm-right">
                                        <a class="btn btn-xs btn-success" href="#modalEditPelanggan${row.fa_id}" data-toggle="modal" title="Edit"><span class="fal fa-sync-alt"></span> Ubah</a>
                                        <a class="btn btn-xs btn-danger" href="#modalHapusPelanggan${row.fa_id}" data-toggle="modal" title="Hapus"><span class="fal fa-trash-alt"></span> Hapus</a>
                                    </div>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#faicons_wrapper .col-ms-6:eq(0)');
        });
    </script>
</body>

</html>

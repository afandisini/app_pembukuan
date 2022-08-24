<?php $this->load->view("admin/part/head") ?>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row d-flex justify-content-end">
                    <?= alert_bs();?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="card-tools btn-group">
                                    <button class="btn btn-warning btn-sm mb-2" data-toggle="modal" data-target="#tambahcetaknota"><strong>+</strong> Cetak Nota</button>
                                </div>
                            </div>
                            <div class="card-body table-responsive-sm p-0">
                                <table class="table table-sm" id="cetaknota">
                                    <thead>
                                        <tr>
                                            <th style="width:45px;">#!</th>
                                            <th>No.Faktur</th>
                                            <th>Nama</th>
                                            <th>Jenis Kegiatan</th>
                                            <th>Keterangan</th>
                                            <th>Nominal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <th colspan="7"></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- ============ MODAL TAMBAH =============== -->
                
    <div id="tambahcetaknota" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-center modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5>CETAK NOTA</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-sm" id="inputdata" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:45px;">No</th>
                                    <th>Nama</th>
                                    <th>Jenis Kegiatan</th>
                                    <th>Debet</th>
                                    <th>Kredit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL HAPUS -->
        <?php foreach ($cetaknota->result_array() as $a) {
            $kid=$a['cetaknota_id'];
        ?>
        <div id="hapus<?php echo $kid?>" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5>Hapus Surat Pernyataan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/cetaknota/hapus_cetaknota'?>">
                        <div class="modal-body">
                            <input name="kode" type="hidden" value="<?php echo $kid;?>">

                            <div class="form-group">
                                <label class="control-label col-xs-3" >Pengaturan</label>
                                <div class="col-xs-9">
                                <p>Yakin mau menghapus data <?php echo $knm; ?>?</p>
                                    <input name="kid" type="hidden" value="<?php echo $kid; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Batalkan</button>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    <!-- ============ MODAL Lihat =============== -->
    
    <?php $this->load->view("admin/part/foo") ?>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#inputdata').DataTable({
                "rocessing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'frtp',
                lengthMenu: [
                    [ 10, 25, 50, 999999 ],
                    [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                ],
                buttons: [
                    {extend: 'print', text:'<i class="fal fa-print mr-2"></i> Cetak', className: 'btn btn-secondary btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7]}, footer: true},
                    {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-info btn-sm', footer: true},{text:'<i class="fal fa-sign-in mr-1"></i> Pemasukan', className: 'btn btn-success btn-sm masuk', action: function (e, node, config){$('#pmasuk').modal('show')}},{text:'<i class="fal fa-sign-out mr-1"></i> Pengeluaran', className: 'btn btn-danger btn-sm keluar', action: function (e, node, config){$('#pkeluar').modal('show')}},{text:'<i class="far fa-building mr-1"></i> Kegiatan', className: 'btn btn-warning btn-sm keg', action: function (e, node, config){$('#kegiatan').modal('show')}},{text:'<i class="far fa-user mr-1"></i> Rekan', className: 'btn btn-primary btn-sm keg', action: function (e, node, config){$('#tmb_cust').modal('show')}}
                ],
                "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/inputdata/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'pembukuan_id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {"data": "nama" },
                    {"data": "keg_nama" },
                    {"class": "bg-succsoft text-right", "data": "pembukuan_masuk", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp ' )},
                    {"class": "bg-warsoft text-right", "data": "pembukuan_keluar", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp ' )},
                    {"class": "text-center", "data": "pembukuan_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/cetaknota/tambah_cetaknota'?>">
                                        <input type="hidden" name="no_nota" class="form-control" value="<?php echo (date('Y')) .((date('mY'))+(19));?>">
                                        <input type="hidden" name="pelanggan_id" class="form-control" value="${row.pelanggan_id}">
                                        <input type="hidden" name="cetaknota_ket" class="form-control" value="${row.pembukuan_ket}">
                                        <input type="hidden" name="nominal" class="form-control" value="${row.pembukuan_masuk}">
                                        <input type="hidden" name="nominal2" class="form-control" value="${row.pembukuan_keluar}">
                                        <input type="hidden" name="kegiatan_id" class="form-control" value="${row.kegiatan}">
                                        <div class="text-center">    
                                            <div class="btn-group text-sm">
                                                <button type="submit" class="btn btn-success btn-sm"><i class="fal fa-check mr-1"></i> Pilih</button>
                                            </div>
                                        </div>
                                    </form>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#inputdata_wrapper .col-ms-6:eq(0)');
        });
    </script>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#cetaknota').DataTable({
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
                    "url": "<?= base_url('admin/cetaknota/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'cetaknota_id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {"data": "no_nota"},
                    {"data": "nama"},
                    {"data": "keg_nama" },
                    {"data": "cetaknota_ket" }, 
                    {"targets": 4,
                        "data": "nominal",
                        "render": function ( data, type, row, meta, display ) {
                        var numFormat = $.fn.dataTable.render.number( ',', '.', 0 ,'Rp ' ).display;
                        if (data == 0)
                            {return `${numFormat(row.nominal2)}`;}
                        else
                            { return `${numFormat(row.nominal)}`;}
                        }
                    },
                    {"data": "cetaknota_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<form method="post" action="<?php echo base_url().'admin/cetaknota/hapus_cetaknota'?>">         <input name="cid" type="hidden" value="${row.cetaknota_id}">
                                        <div class="btn-group">
                                        <a class="btn btn-xs btn-secondary" href="#note${row.cetaknota_id}" data-toggle="modal" title="Catatan"><i class="fal fa-comment-alt-exclamation mr-1"></i> Note</a>
                                            <a href="cetaknota/cetak?A4=${row.cetaknota_id}" target="_blank" class="btn btn-success btn-xs"><i class='fal fa-print mr-1'></i> Cetak</a>
                                            <button type="submit" class="btn btn-danger btn-xs"><i class="fal fa-trash-alt mr-1"></i> Hapus</button>
                                        </div>
                                    </form>
                                    <div id="note${row.cetaknota_id}" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5>Form Pernyataan/Perjanjian</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/cetaknota/catatan'?>">
                                                    <input type="hidden" name="cetaknota_id" value="${row.cetaknota_id}">
                                                    <div class="modal-body">
                                                        <div class="highlighter-rouge pb-3 text-sm">&lt;br&gt;=Enter (Pindah Baris)<br>&lt;strong&gt;Konten&lt;/strong&gt;=Huruf Tebal<br>&lt;i&gt;Konten&lt;/i&gt; = Huruf Miring</div>
                                                        <textarea name="catatan" class="form-control pt-2" id="exampleFormControlTextarea1" rows="5"></textarea>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <div class="btn-group">
                                                            <button class="btn btn-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Batal</button>
                                                            <button class="btn btn-danger btn-sm">Simpan</button>
                                                        </div>                            
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#cetaknota_wrapper .col-ms-6:eq(0)');
        });
    </script>
    
</body>

</html>

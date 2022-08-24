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
                                <div class="card-tools align-middle btn-group shadow-sm">
                                    <a href="<?php echo base_url().'admin/jurnal/reset'?>" title="Reset Keranjang" class="btn btn-danger btn-sm"><i class="fal fa-sync mr-2"></i>Reset</a>
                                    <a href="#" data-toggle="modal" data-target="#ambil_input" title="Ambil Data" class="btn btn-primary btn-sm"><i class="fal fa-file-alt mr-2"></i>Input Data</a>
                                    <a href="#" data-toggle="modal" data-target="#add_akun" title="Tambah Akun Jurnal" class="btn btn-success btn-sm"><i class="fal fa-file-alt mr-2"></i>Akun</a>
                                </div>
                            </div>
                            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/jurnal/add'?>">
                                <?php foreach ($jrntmp->result_array() as $a) {
                                    $jt_id=$a['jurnal_tmp_id'];
                                    $jt_nama=$a['jurnal_tmp_nama'];
                                    $jt_ket=$a['jurnal_tmp_ket'];
                                    $jt_pid=$a['pelanggan_id'];
                                    $jt_keg=$a['keg_nama'];
                                    $jt_keg2=$a['kegiatan'];
                                    $jt_deb=$a['jurnal_tmp_masuk'];
                                    $jt_kre=$a['jurnal_tmp_keluar'];
                                    $jt_tgl=$a['jurnal_tmp_tgl'];
                                    $jt_no=('JN' .($jt_id*3));
                                ?>
                                
                                    <input type="hidden" class="form-control mb-2" name="jurnal_nama" value="<?= $jt_nama;?>">
                                    <input type="hidden" class="form-control mb-2" name="jurnal_ket" value="<?= $jt_ket;?>">
                                    <input type="hidden" class="form-control mb-2" name="pelanggan_id" value="<?= $jt_pid;?>">
                                    <input type="hidden" class="form-control mb-2" name="kegiatan" value="<?= $jt_keg2;?>">
                                    <?php if (!empty($jt_nama)) { ?>
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">NO</th>
                                                        <th scope="col">TGL INPUT</th>
                                                        <th scope="col">NAMA</th>
                                                        <th scope="col">KETERANGAN</th>
                                                        <th scope="col">KEGIATAN</th>
                                                        <th scope="col">DEBET</th>
                                                        <th scope="col">KREDIT</th>
                                                        <th scope="col">AKUN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><span class="d-inline-block text-truncate" style="max-width: 170.5px;"><?= $jt_no;?></span></td>
                                                        <td><span class="d-inline-block text-truncate" style="max-width: 170.5px;"><?= tgl_indo($jt_tgl);?></span></td>
                                                        <td><span class="d-inline-block text-truncate" style="max-width: 170.5px;"><?= $jt_nama;?></span></td>
                                                        <td><span class="d-inline-block text-truncate" style="max-width: 170.5px;"><?= $jt_ket;?></span></td>
                                                        <td><span class="d-inline-block text-truncate" style="max-width: 170.5px;"><?= $jt_keg;?></span></td>
                                                        <td style="max-width: 170.5px;"><input name="jurnal_masuk" class="form-control duit" type="text" value="<?= number_format($jt_deb);?>"></td>
                                                        <td style="max-width: 170.5px;"><input name="jurnal_keluar" class="form-control duit" type="text" value="<?= number_format($jt_kre);?>"></td>
                                                        <td style="max-width: 170.5px;">
                                                            <select class="form-control select2bs4" name="kategori_id" required>
                                                                <option value="">-- Pilih Akun --</option>
                                                                <?php foreach($akun as $k){?>
                                                                <option value="<?= $k->kategori_id;?>"><?= $k->kategori_nama;?></option>
                                                                <?php }?>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <tfoot>
                                                    <tr><td colspan="8"></td><tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <div class="btn-group">
                                                <button class="btn btn-success btn-sm">Jurnal</button>
                                            </div>
                                        </div>
                                    <?php } else { ?>
                                        Kosong
                                    <?php } ?>
                                <?php } ?>
                            </form>
                            
                        </div>
                        <div class="card">
                            <div class="card-header border-0"></div>
                            <div class="table-responsive p-0">
                                <table class="table table-striped table-sm w-100" id="jurnal">
                                    <thead>
                                        <tr>
                                            <th style="width:50px;">No</th>
                                            <th>Input Jurnal</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Kegiatan</th>
                                            <th>Jenis Akun</th>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            
                                            <th></th>
                                            <th class="text-muted">Kas:</th>
                                            <th class="bg-succsoft"></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total:</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="9"></th>
                                        </tr>
                                       
                                    </tfoot>
                                </table>

                                <p class="mt-2 ml-4 text-xs text-muted"><i class="fal fa-table mr-2"></i><?php echo isset($diskripsi) ? $diskripsi : ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ambil_input" tabindex="0" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Data Input</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                    <?php $this->load->view("admin/jurnal/inputdata")?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_akun" data-backdrop="static" tabindex="0" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Tambah Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/jurnal/add_akun'?>">
                        <div class="modal-body">
                            <label class="control-label col-xs-3">Nama Akun</label>
                            <input type="text" name="kategori_nama" class="form-control mb-2" placeholder="Nama Akun">
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
    </div>
    <!-- end Modal-->
            
    <?php $this->load->view("admin/part/foo") ?>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#jurnal').DataTable({
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
        
                    // Total over all pages
                    total = api
                        .column(6)
                        .data()
                        .reduce(function (x, y) {
                            return intVal(x) + intVal(y);
                        }, 0);
        
                    // Total over this page
                    pageTotal = api
                        .column(7, { page: 'current' })
                        .data()
                        .reduce(function (x, y) {
                            return intVal(x) + intVal(y);
                        }, 0);
                    
        
                    // Update footer
                    var numFormat = $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' ).display;
                    $( api.column( 2 ).footer() ).html(numFormat((total)-(pageTotal))); 
                    $( api.column( 6 ).footer() ).html(numFormat(total));
                    $( api.column( 7 ).footer() ).html(numFormat(pageTotal)); 
                },
                "rocessing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'Bfrtip<"clear">',
                lengthMenu: [
                    [ 10, 25, 50, 999999 ],
                    [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                ],
                buttons: [
                    {extend: 'print', text:'<i class="fal fa-print mr-2"></i> Cetak', className: 'btn btn-warning btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6]}, footer: true},
                    {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-info btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6]}, footer: true},//{text:'<i class="far fa-file mr-1"></i> Akun', className: 'btn btn-success btn-sm', action: function (e, node, config){$('#add_akun').modal('show')}},
                    //{text:'<i class="far fa-file-alt mr-1"></i> Inputdata', className: 'btn btn-primary btn-sm', action: function (e, node, config){$('#ambil_input').modal('show')}}
                ],
                "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/jurnal/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'jurnal_id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    {"class": "text-left", "data": "jurnal_tgl", 
                        render: function (value) {
                              if (value === null) return "";
                              return moment(value).format('YYYY-MM-DD');}
                    },  
                    {"data": "jurnal_nama" }, 
                    {"data": "jurnal_ket",
                        "render": 
                        function( data, type, row, meta ) {
                            return `<span class="d-inline-block text-truncate" style="max-width: 250px;">
                            ${row.jurnal_ket}
                                    </span>`;
                        }
                    },
                    {"data": "keg_nama"},
                    {"data": "kategori_nama" },
                    {"class": "bg-succsoft text-right", "data": "jurnal_masuk", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' )},
                    {"class": "bg-warsoft text-right", "data": "jurnal_keluar", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' )},
                    {"class": "text-center", "data": "jurnal_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/jurnal/hapus'?>">
                                        <div class="text-xs"><input name="jid" type="hidden" value="${row.jurnal_id}">
                                        <button type="submit" class="btn btn-danger btn-xs"><span class="fal fa-trash-alt mr-1"></span> Hapus</button></div>
                                    </form>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#jurnal_wrapper .col-ms-6:eq(0)');
        });
    </script>
    <script type="text/javascript">
        $('input.duit').on('input', function() {
            const value = this.value.replace(/[^\d]/g,"");
            this.value = parseFloat(value).toLocaleString('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 0
            });
        });
    </script>
</body>
</html>

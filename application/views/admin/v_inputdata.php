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
                                <div class="btn-group">
                                    
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-sm w-100" id="inputdata">
                                    <thead>
                                        <tr>
                                            <th style="width:45px;">No</th>
                                            <th>Tgl Input</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Instansi / Client</th>
                                            <th>Jenis Kegiatan</th>
                                            <th>Debet</th>
                                            <th>Kredit</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>KAS: </th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total: <span class="text-xs">(Per Halaman)</span></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="9"></th>
                                        </tr>
                                    </tfoot>
                                </table>

                                <p class="mt-2 ml-4 text-sm text-muted"><i class="fal fa-comment-alt mr-2 fa-flip-horizontal"></i><?php echo isset($diskripsi) ? $diskripsi : ''; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
   
    <div class="modal fade" id="pmasuk" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card-outline card-success">
                <div class="modal-header border-0">
                    <h5><?php echo isset($pmasuk) ? $pmasuk : ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-horizontal" method="post" 
                    action="<?php echo base_url().'admin/inputdata/tambah_debet'?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Jenis <?php echo isset($pmasuk) ? $pmasuk : ''; ?></label>
                                    <div class="col-xs-9">
                                        <input name="anama" class="form-control" type="text" placeholder="Jenis Pengeluaran" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Instansi / Client</label>
                                    <select class="form-control select2bs4" name="mpid" title="Pemasukan" required>
                                        <option value="">-- Pilih Client --</option>
                                        <?php foreach($rekanan as $r){?>
                                        <option value="<?= $r->id;?>"><?= $r->nama;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Keterangan</label>
                            <div class="col-xs-9">
                                <textarea name="aket" class="form-control" placeholder="Keterangan" required id="exampleFormControlTextarea1" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Tanggal Input<br><span class="text-xs text-muted">(Format: <span class="text-xs text-danger">Tahun</span>-<span class="text-xs text-warning">Bulan</span>-<span class="text-xs text-success">Tanggal</span>)</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="mtgl" class="form-control" value="<?= date('Y-m-d')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Jenis Kegiatan<br><span class="text-xs text-muted">(Pengerjaan dalam Kategori)</span></label>
                                    <select class="form-control select2bs4" name="mkegid" required>
                                        <option value="">-- Pilih Kegiatan --</option>
                                        <?php foreach($kegiatan as $k){?>
                                        <option value="<?= $k->keg_id;?>"><?= $k->keg_nama;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Pemasukan</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">IDR</span>
                                </div>
                                <input name="akel" type="hidden" value="0">
                                <input name="amas" class="form-control duit" type="text" placeholder="Jumlah Pemasukan" required>
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
    <div class="modal fade" id="pkeluar" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content card-outline card-danger">
                <div class="modal-header border-0">
                    <h5><?php echo isset($pkeluar) ? $pkeluar : ''; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form class="form-horizontal" method="post" 
                    action="<?php echo base_url().'admin/inputdata/tambah_debet'?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Jenis <?php echo isset($pkeluar) ? $pkeluar : ''; ?></label>
                                    <div class="col-xs-9">
                                        <input name="anama" class="form-control" type="text" placeholder="Jenis Pengeluaran" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Instansi / Client</label>
                                    <select class="form-control select2bs4" name="mpid" title="Pemasukan" required>
                                        <option value="">-- Pilih Client --</option>
                                        <?php foreach($rekanan as $r){?>
                                        <option value="<?= $r->id;?>"><?= $r->nama;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Keterangan</label>
                            <div class="col-xs-9">
                                <textarea name="aket" class="form-control" placeholder="Keterangan" required id="exampleFormControlTextarea1" rows="4"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Tanggal Input<br><span class="text-xs text-muted">(Format: <span class="text-xs text-danger">Tahun</span>-<span class="text-xs text-warning">Bulan</span>-<span class="text-xs text-success">Tanggal</span>)</span></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="date" name="mtgl" class="form-control" value="<?= date('Y-m-d')?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-xs-3" >Jenis Kegiatan<br><span class="text-xs text-muted">(Pengerjaan dalam Kategori)</span></label>
                                    <select class="form-control select2bs4" name="mkegid" required>
                                        <option value="">-- Pilih Kegiatan --</option>
                                        <?php foreach($kegiatan as $k){?>
                                        <option value="<?= $k->keg_id;?>"><?= $k->keg_nama;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-xs-3" >Pengeluaran</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text">IDR</span>
                                </div>
                                <input name="amas" type="hidden" value="0">
                                <input name="akel" class="form-control duit" type="text" placeholder="Jumlah Pengeluaran" required>
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
    <div class="modal fade" id="kegiatan" data-backdrop="static" role="dialog" aria-labelledby="akun" aria-hidden="true">
        <div class="modal-dialog modal-center modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Tambah Jenis Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                        <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/inputdata/input'?>">
                        <div class="modal-body p-0">
                            <div class="p-3">
                                <label class="control-label">Nama Kegiatan</label>
                                <input type="text" name="keg_nama" class="form-control" placeholder="Nama Jenis Kegiatan">
                                <div class="row mt-2">
                                    <div class="col-sm-5">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" name="start" class="form-control datepicker" value="<?= date('Y-m-d');?>" data-provide="datepicker">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-calendar-check"></i></span>
                                            </div>
                                            <input type="date" name="end" class="form-control datepicker" value="<?php $tlgNow = date("Y-m-d"); echo date('Y-m-d', strtotime( "$tlgNow +5 month" ));?>" data-provide="datepicker">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-secondary btn-block" type="button"><i class="fal fa-plus mr-1"></i>Tambah</button>
                                    </div>
                                    <label class="text-muted text-xs ml-2">Format Tanggal Mulai & Selesai (<?= date('Y-m-d');?>)</label>
                                </div>
                                
                        </form>

                                <a class="btn btn-primary btn-sm mt-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="fal fa-list mr-1"></i> List Kegiatan</a>
                            </div>
                            <div class="collapse" id="collapseExample">
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped w-100" id="pekerjaan">
                                        <thead>
                                            <tr>
                                                <th scope="col">!#</th>
                                                <th scope="col">Nama Kegiatan</th>
                                                <th scope="col">Tanggal</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tr class="bg-white"><td colspan="4"></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tmb_cust" tabindex="-1" role="dialog" aria-labelledby="tmb_custLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="tmb_custLabel">Tambah Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/rekanan/store?kasir=retail'?>">
                    <div class="modal-body">
                        <label class="text-muted font-weight-light">Nama Pelanggan</label>
                        <input type="text" name="nama" class="form-control form-control-sm mb-2" placeholder="Nama Lengkap">
                        <label class="text-muted font-weight-light">No Hp</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text form-control bg-light">+62</span>
                            </div>
                            <input type="number" name="hp" class="form-control mb-2" placeholder="888 7766 5544">
                        </div>
                        <label class="text-muted font-weight-light">Alamat</label>
                        <input type="text" name="alamat" class="form-control form-control-sm mb-2" placeholder="Alamat Saat ini">
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
    <div id="modalEdit" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" id="ubah-content">
                
                </div>
            </div>
        </div>

    <script>
        $('#inputdata tbody').on('click', '.ubah', function(){
            var id = $(this).attr('data-id');
            $('#modalEdit').modal('show');
            $.ajax({url:"<?php echo base_url('admin/inputdata/pisah?model=edit&pembukuan_id=');?>"+id,success:function(html){
                $("#ubah-content").html(html);
            }});
        });
    </script>
    <script>
        $('.select2bs5').select2({
		theme: 'bootstrap4'
		})
    </script>
    <script type="text/javascript">
        $(function () {
		$('#pekerjaan').DataTable({
			"processing": true,
            "responsive":true,
            "serverSide": true,
            "ordering": true,
			language: {url: '<?= base_url('assets/id.json');?>'},
			dom: 'frtip',
			buttons: [
                    {extend: 'print', text:'<i class="fal fa-print text-white mr-2"></i> Cetak', className: 'btn btn-success btn-sm text-white ml-4', pageSize: 'A4',footer: true}
                ],
            "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
            "ajax":
            {
                "url": "<?= base_url('admin/inputdata/kegiatan');?>",
                "type": "POST"
            },
            "deferRender": true,
                "columns": [
                    {"data": 'keg_id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1 + '.';
                        }  
                    },    
                    {"data": "keg_nama" }, 
                    {"data": "start",
                        "render": 
                        function( data, type, row, meta ) {
                            return `${row.start} <i class="fal fa-exchange"></i> ${row.end}`;
                        }
                    },
                    {"class": "text-center", "data": "keg_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/inputdata/del_kegiatan'?>">
                                        <input name="kid" type="hidden" value="${row.keg_id}">
                                        <button type="submit" class="btn btn-danger btn-xs"><i class="fal fa-trash-alt mr-1"></i>Hapus</button>
                                    </form>`;
                        }
                    },
                ],
			}).buttons().container().appendTo('#pekerjaan_wrapper .col-ms-6:eq(0)');
		});
    </script>
    <?php $this->load->view("admin/part/foo") ?>
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
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#inputdata').DataTable({
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
        
                    // Total over all pages
                    debet = api
                        .column(6)
                        .data()
                        .reduce(function (x, y) {
                            return intVal(x) + intVal(y);
                        }, 0);
                    kredit = api
                        .column(7)
                        .data()
                        .reduce(function (x, y) {
                            return intVal(x) + intVal(y);
                        }, 0);
        
                    // Update footer
                    var numFormat = $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' ).display;
                    $( api.column( 2 ).footer() ).html(numFormat((debet)-(kredit))); 
                    $( api.column( 6 ).footer() ).html(numFormat(debet));
                    $( api.column( 7 ).footer() ).html(numFormat(kredit));
                },
                "processing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true,
               // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, 999999 ],
                    [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                ],
                buttons: [
                    {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-primary btn-sm', footer: true},{extend: 'print', text:'<i class="fal fa-print mr-2"></i> Cetak', className: 'btn btn-secondary btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7]}, footer: true},
                    {extend: 'excel', text:'<i class="fal fa-file-excel mr-2"></i> Excel', className: 'btn btn-warning btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7]}, footer: true},
                    {text:'<i class="fal fa-sign-in mr-1"></i> Pemasukan', className: 'btn btn-success btn-sm masuk', action: function (e, node, config){$('#pmasuk').modal('show')}},{text:'<i class="fal fa-sign-out mr-1"></i> Pengeluaran', className: 'btn btn-danger btn-sm keluar', action: function (e, node, config){$('#pkeluar').modal('show')}},{text:'<i class="far fa-building mr-1"></i> Kegiatan', className: 'btn btn-info btn-sm keg', action: function (e, node, config){$('#kegiatan').modal('show')}},{text:'<i class="far fa-user mr-1"></i> Rekan', className: 'btn btn-dark btn-sm keg', action: function (e, node, config){$('#tmb_cust').modal('show')}}
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
                            return meta.row + meta.settings._iDisplayStart + 1 + '.';
                        }  
                    },
                    {"class": "text-left", "data": "pembukuan_tgl", 
                        render: function (value) {
                              if (value === null) return "";
                              return moment(value).format('YYYY-MM-DD');}
                    },    
                    {"data": "pembukuan_nama" }, 
                    {"data": "pembukuan_ket",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<span class="d-inline-block text-truncate" style="max-width:200px;">
                            ${row.pembukuan_ket}</span>`;
                        }
                    },
                    {"data": "nama" },
                    {"data": "keg_nama",
                        "render": 
                        function( data, type, row, meta ) {
                            return `<span class="d-inline-block text-truncate" style="max-width:200px;">
                            ${row.keg_nama}</span>`;
                        }
                    },
                    {"class": "bg-succsoft text-right", "data": "pembukuan_masuk", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' )},
                    {"class": "bg-warsoft text-right", "data": "pembukuan_keluar", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' )},
                    {"class": "text-center", "data": "pembukuan_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<div class="text-center">    
                                        <div class="btn-group text-xs">
                                            <!--<a class="btn btn-xs btn-success" href="#modalUbah$//{row.pembukuan_id}" data-toggle="modal" title="Ubah $//{row.pembukuan_nama}"><span class="fal fa-sync-alt"></span> Ubah</a>-->
                                            <button class="btn btn-success btn-xs ubah" data-id="${row.pembukuan_id}" 
                                                title="Ubah ${row.pembukuan_nama}"><i class="fal fa-sync-alt"></i> Ubah
                                            </button>
                                            <form class="form-horizontal" method="post" action="<?= base_url().'admin/inputdata/Busak'?>">
                                                <input name="pembukuan_id" type="hidden" value="${row.pembukuan_id}">
                                                <button type="submit" class="btn btn-danger btn-xs"><span class="fal fa-trash-alt mr-1"></span>Hapus</button>
                                            </form>
                                        </div>
                                    </div`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#inputdata_wrapper .col-ms-6:eq(0)');
        });
    </script>
    <script>
        $("#date")..datepicker({                  
        minDate: moment().add('d', 1).toDate(),
        });
        $("#date2")..datepicker({                  
        minDate: moment().add('d', 1).toDate(),
        }); 
    </script>
</body>
</html>

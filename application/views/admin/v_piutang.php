<?php $this->load->view("admin/part/head") ?>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>
        <section class="content">
            <div class="container-fluid">
                    <?= alert_bs();?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="card-tools btn-group">
                                    
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm w-100" id="table_piutang">
                                        <thead>
                                            <tr>
                                                <th style="width:15px;">No</th>
                                                <th>Kepada</th>
                                                <th>Kegiatan</th>
                                                <th>Jumlah (Rp)</th>
                                                <th>Pelunasan (Rp)</th>
                                                <th>Tgl Piutang</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="2">Sisa: (Rp)</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            <tr><td class="bg-white" colspan="7"></td></tr>
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
        <div class="modal fade" id="piutang" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog">
            	<div class="modal-content">
					<div class="modal-header border-0">
						<h5>Tambah <?php echo isset($nmpage) ? $nmpage : ''; ?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
						<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/piutang/simpan'?>">
							<div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-xs-3" >Dari <span class="text-xs text-muted">(Pemberi Pihutang)</span></label>
                                                <select class="form-control select2bs4" name="pelanggan_id" title="Pemasukan" required>
                                                    <option value="">-- Pilih Client --</option>
                                                    <?php foreach($rekanan as $r){?>
                                                    <option value="<?= $r->id;?>"><?= $r->nama;?></option>
                                                    <?php }?>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label col-xs-3" >Kegiatan <span class="text-xs text-muted">(Pihutang Pengerjaan)</span></label>
                                            <select class="form-control select2bs4" name="kegiatan_id" required>
                                                <option value="">-- Pilih Kegiatan --</option>
                                                <?php foreach($kegiatan as $k){
                                                    if($mkegid == $k->keg_id)
                                                        echo "<option value='$k->keg_id' selected>$k->keg_nama</option>";
                                                    else
                                                        echo "<option value='$k->keg_id'>$k->keg_nama</option>";
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label col-xs-3" >Tanggal Input<br><span class="text-xs text-muted">(Format: <span class="text-xs text-danger">Tahun</span>-<span class="text-xs text-warning">Bulan</span>-<span class="text-xs text-success">Tanggal</span>)</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="date" id="date2" name="tgl_input" class="form-control" value="<?= date('Y-m-d');?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 col-sm-6">
                                        <label class="control-label col-xs-3" >Nominal<br><span class="text-xs text-muted">(Jumlah Pihutang)</span></label>
                                            <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text">IDR</span>
                                            </div>
                                            <input type="text" name="debet" class="form-control duit" value="0">
                                            <input type="hidden" name="kredit" class="form-control duit" value="0">
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
        </div>

        <!-- ============ MODAL Lihat Input =============== -->
        <div id="modalInputData" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" id="input-content">
                    <div class="modal-header border-0">
                        <h5>Data Pengeluaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-sm w-100" id="inputdata">
                            <thead>
                                <tr>
                                    <th style="width:45px;">No</th>
                                    <th>Tgl_Input</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Kegiatan</th>
                                    <th>Kredit</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="7"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
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

        <!-- ============ MODAL HAPUS =============== -->
        <div id="modalHapus" data-backdrop="static" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm">
                <div class="modal-content" id="delete-content">
                    
                </div>
            </div>
        </div>
    <script>
        $('#table_piutang tbody').on('click', '.input', function(){
            var id = $(this).attr('data-id');
            $('#modalInputData').modal('show');
            $.ajax({url:"<?php echo base_url('admin/piutang/pisah?model=input&piutang_id=');?>"+id,success:function(html){
                $("#input-content").html(html);
            }});
        });
    </script>
    <script>
        $('#table_piutang tbody').on('click', '.ubah', function(){
            var id = $(this).attr('data-id');
            $('#modalEdit').modal('show');
            $.ajax({url:"<?php echo base_url('admin/piutang/pisah?model=edit&piutang_id=');?>"+id,success:function(html){
                $("#ubah-content").html(html);
            }});
        });
    </script>
    <script>
        $('#table_piutang tbody').on('click', '.delete', function(){
            var id = $(this).attr('data-id');
            $('#modalHapus').modal('show');
            $.ajax({url:"<?php echo base_url('admin/piutang/pisah?model=hapus&piutang_id=');?>"+id,success:function(html){
                $("#delete-content").html(html);
            }});
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
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#table_piutang').DataTable({
                "footerCallback": function (row, data, start, end, display) {
                    var api = this.api();
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
        
                    // Total over all pages
                    piutang = api
                        .column(3)
                        .data()
                        .reduce(function (x, y) {
                            return intVal(x) + intVal(y);
                        }, 0);
                    pelunasan = api
                        .column(4)
                        .data()
                        .reduce(function (x, y) {
                            return intVal(x) + intVal(y);
                        }, 0);
        
                    // Update footer
                    var numFormat = $.fn.dataTable.render.number( ',', '.', 0 ,'' ).display;
                    $( api.column( 2 ).footer() ).html(numFormat((piutang)-(pelunasan))); 
                    $( api.column( 3 ).footer() ).html(numFormat(piutang));
                    $( api.column( 4 ).footer() ).html(numFormat(pelunasan));
                },
                "processing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 10, 25, 50, 999999 ],
                    [ '10 baris', '25 baris', '50 baris', 'Semua' ]
                ],
                buttons: [
                    {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-info btn-sm', footer: true},{text:'<i class="fal fa-file-invoice mr-1"></i> +Piutang', className: 'btn btn-danger btn-sm keg', action: function (e, node, config){$('#piutang').modal('show')}},{text:'<i class="fal fa-credit-card-front mr-1"></i> Pelunasan', className: 'btn btn-success btn-sm keg', action: function (e, node, config){$('#modalInputData').modal('show')}}
                ],
                "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/piutang/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'piutang_id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    { "data": "nama"},  // Tampilkan kategori
                    { "data": "keg_nama"},
                    { "target": 4,"className":"text-right","data": "debet", "render": $.fn.dataTable.render.number( ',', '.', 0 ,'' )},
                    { "target": 5,"className":"text-right","data": "kredit", "render": $.fn.dataTable.render.number( ',', '.', 0 ,'' )},
                    { "className":"text-center","data": "tgl_input"},
                    { "data": "piutang_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<button class="btn btn-danger btn-xs delete" data-id="${row.piutang_id}" title="Hapus"><i class="fal fa-trash-alt mr-1"></i> Hapus</button>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#table_piutang_wrapper .col-ms-6:eq(0)');
        });
    </script>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#inputdata').DataTable({
                "processing": true,
                "responsive":true,
                "serverSide": true,
                "ordering": true, // Set true agar bisa di sorting
                language: {url: '<?= base_url('assets/id.json');?>'},
                dom: 'frtip',
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
                    {"data": "nama" },
                    {"data": "pembukuan_ket",
                        "render": 
                        function( data, type, row, meta ) {
                            return `<span class="d-inline-block text-truncate" style="max-width:250px;">
                            ${row.pembukuan_ket}</span>`;
                        }
                    },
                    {"data": "keg_nama",
                        "render": 
                        function( data, type, row, meta ) {
                            return `<span class="d-inline-block text-truncate" style="max-width:250px;">
                            ${row.keg_nama}</span>`;
                        }
                    },
                    {"class": "bg-warsoft text-right", "data": "pembukuan_keluar", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' )},
                    {"class": "text-center", "data": "pembukuan_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/piutang/simpan'?>">
                                        <input type="hidden" name="tgl_input" class="form-control duit" value="${row.pembukuan_tgl}">
                                        <input type="hidden" name="pelanggan_id" class="form-control duit" value="${row.pelanggan_id}">
                                        <input type="hidden" name="kegiatan_id" class="form-control duit" value="${row.kegiatan}">
                                        <input type="hidden" name="kredit" class="form-control duit" value="${row.pembukuan_keluar}">
                                        <input type="hidden" name="debet" class="form-control duit" value="0">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-success btn-xs"><span class="fal fa-check mr-1"></span> Pilih</button>
                                        </div>
                                    </form>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#inputdata_wrapper .col-ms-6:eq(0)');
        });
    </script>
    <!--END MODAL-->
<?php $this->load->view("admin/part/foo") ?>
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
                                <table class="table table-sm table-striped w-100" id="pekerjaan">
                                    <thead>
                                        <tr>
                                            <th scope="col">!#</th>
                                            <th scope="col">Nama Kegiatan</th>
                                            <th scope="col">Tgl Kegiatan</th>
                                            <th scope="col">Nilai Kegiatan</th>
                                            <th scope="col">OPD/Instansi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tr class="bg-white"><td colspan="6"></td></tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <!-- ============ MODAL ADD =============== -->
    <div class="modal fade" id="kegiatan" data-backdrop="static" role="dialog" aria-labelledby="akun" aria-hidden="true">
        <div class="modal-dialog modal-center">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5>Tambah Jenis Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                    <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/kegiatan/input'?>">
                        <div class="modal-body p-0">
                            <div class="p-3">
                                <label class="control-label">Nama Kegiatan</label>
                                <input type="text" name="keg_nama" class="form-control mb-2" placeholder="Nama Jenis Kegiatan" required>
                                <div class="row mb-2">
                                    <div class="col-sm-6">
                                        <label class="control-label">Nilai Kontrak</label>
                                        <input type="text" name="nilai_kontrak" class="form-control nilaikontrak" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">OPD / Instansi</label>
                                        <input type="text" name="opd" class="form-control" placeholder="OPD / Instansi" required>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-6">
                                        <label class="control-label">Mulai Pengerjaan</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-calendar-alt"></i></span>
                                            </div>
                                            <input type="date" name="start" class="form-control datepicker" value="<?= date('Y-m-d');?>" data-provide="datepicker">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Estimasi Selesai</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-calendar-check"></i></span>
                                            </div>
                                            <input type="date" name="end" class="form-control datepicker" value="<?php $tlgNow = date("Y-m-d"); echo date('Y-m-d', strtotime( "$tlgNow +3 month" ));?>" data-provide="datepicker">
                                        </div>
                                    </div>
                                    <label class="text-muted text-xs ml-2">Format Tanggal Mulai & Selesai (<?= date('Y-m-d');?>)</label>
                                </div>                               
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                                <button type="submit" class="btn btn-success btn-sm" type="button">simpan</button> 
                        </div>
                    </form>
                </div>
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
    <script>
        $('#pekerjaan tbody').on('click', '.ubah', function(){
            var keg_id = $(this).attr('data-id');
            $('#modalEdit').modal('show');
            $.ajax({url:"<?php echo base_url('admin/kegiatan/edit?tipe=edit&kid=');?>"+keg_id,success:function(html){
                $("#ubah-content").html(html);
            }});
        });
    </script>
    <script>
        $('#pekerjaan tbody').on('click', '.delete', function(){
            var keg_id = $(this).attr('data-id');
            $('#modalHapus').modal('show');
            $.ajax({url:"<?php echo base_url('admin/kegiatan/edit?tipe=hapus&kid=');?>"+keg_id,success:function(html){
                $("#delete-content").html(html);
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
			dom: 'Bfrtip',
			lengthMenu: [
                [ 10, 25, 50, 999999 ],
                [ '10 baris', '25 baris', '50 baris', 'Semua' ]
            ],
            buttons: [
                {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-primary btn-sm', footer: true},{text:'<i class="far fa-plus mr-1"></i> Kegiatan', className: 'btn btn-warning btn-sm keg', action: function (e, node, config){$('#kegiatan').modal('show')}},
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
                    {"data": "keg_nama"
                    }, 
                    {"data": "start",
                        "render": 
                        function( data, type, row, meta ) {
                            return `<span class="d-inline-block text-truncate" style="max-width:200px;">${row.start}<i class="fal fa-arrows-h"></i>${row.end}</span>`;
                        }
                    },
                    {"data": "nilai_kontrak", render: $.fn.dataTable.render.number( ',', '.', 0 ,'Rp.' )},
                    {"data": "opd" },
                    {"class": "text-center", "data": "keg_id",
                    "render": 
                        function( data, type, row, meta ) {
                            return `<div class="btn-group">
                            <button class="btn btn-success btn-xs ubah" data-id="${row.keg_id}" title="Edit"><i class="fal fa-sync-alt mr-1"></i>Edit</button>
                            <button class="btn btn-danger btn-xs delete" data-id="${row.keg_id}" title="Hapus"><i class="fal fa-trash-alt mr-1"></i> Hapus</button></div>`;
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
        $('input.nilaikontrak').on('input', function() {
            const value = this.value.replace(/[^\d]/g,"");
            this.value = parseFloat(value).toLocaleString('en-US', {
                style: 'decimal',
                maximumFractionDigits: 2,
                minimumFractionDigits: 0,
            });        
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

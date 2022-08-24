    <div class="modal-body table-responsive p-0">
        <table class="table table-striped table-sm w-100" id="inputdata">
            <thead>
                <tr>
                    <th style="width:45px;">No</th>
                    <th>Nama</th>
                    <th>Keterangan</th>
                    <th>Instansi</th>
                    <th>Jenis Kegiatan</th>
                    <th>Debet</th>
                    <th>Kredit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot><tr><th class="bg-white" colspan="8"></th></tr></tfoot>
        </table>
    </div>

<script type="text/javascript">
     var tabel = null;
        $(document).ready(function() {
            tabel = $('#inputdata').DataTable({
                "processing": true,
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
                    {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-primary btn-sm', footer: true},
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
                                            <form class="form-horizontal" method="post" action="<?php echo base_url().'admin/jurnal/add_to_jurnal'?>">
                                                <input name="jurnal_tmp_nama" type="hidden" value="${row.pembukuan_nama}">
                                                <input name="jurnal_tmp_ket" type="hidden" value="${row.pembukuan_ket}">
                                                <input name="pelanggan_id" type="hidden" value="${row.pelanggan_id}">
                                                <input name="kegiatan" type="hidden" value="${row.kegiatan}">
                                                <input name="jurnal_tmp_masuk" type="hidden" value="${row.pembukuan_masuk}">
                                                <input name="jurnal_tmp_keluar" type="hidden" value="${row.pembukuan_keluar}">
                                                <input name="jurnal_tmp_tgl" type="hidden" value="${row.pembukuan_tgl}">
                                                <button class="btn btn-success btn-xs" data-id="${row.pembukuan_id}" 
                                                    title="Tambah Jurnal"><i class="fal fa-check"></i> Pilih
                                                </button>
                                            </form>
                                        </div>
                                    </div`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#inputdata_wrapper .col-ms-6:eq(0)');
        });
</script>
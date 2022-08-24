<?php $this->load->view("admin/part/head") ?>

    <!-- Navigation -->
   <?php 
        $this->load->view('admin/menu');
   ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 mb-2">
                        <div class="row d-flex justify-content-end">
                            <?php echo $this->session->flashdata('msg');?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header border-0">
                                <h5><i class="fal fa-print mr-2"></i><?php echo isset($tbl) ? $tbl : ''; ?></h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive-sm">
                                    <table class="table table-sm" id="table-query">
                                        <thead>
                                            <tr>
                                                <th style="15px">#</th>
                                                <th>No Faktur</th>
                                                <th>Tanggal</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </section>
    
    <?php $this->load->view("admin/part/foo") ?>
    <script>
        var tabel = null;
        $(document).ready(function() {
            tabel = $('#table-query').DataTable({
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
                    {extend: 'pageLength', text:'<i class="fal fa-list mr-2"></i> <span class="mr-2">Tampilkan</span>', className: 'btn btn-outline-primary btn-sm', exportOptions: {columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9]}, footer: true}
                ],
                "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/cetakulang/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'jual_nofak',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    { "data": "jual_nofak" },  // Tampilkan kategori
                    { "data": "jual_tanggal" },
                    { "data": "d_jual_barang_id" },
                    { "data": "d_jual_barang_nama" },
                    { "class": "text-center",
                      "data": "jual_nofak",
                    "render": 
                        function( data, type, row, meta ) {
                            return ` <div class="btn-group" role="group"><a href="<?= base_url('admin/penjualan/cetak_faktur?nofak=');?>${row.jual_nofak}" target="_blank" class="btn btn-success btn-xs" title="Cetak Ulang Nota"><i class="fal fa-print mr-1"></i>Faktur</a>
                            <a href="<?= base_url('admin/penjualan/cetak_surat?nofak=');?>${row.jual_nofak}" target="_blank" class="btn btn-warning btn-xs" title="Cetak Ulang Surat Jalan"><i class="fal fa-truck-container mr-1"></i>Surat Jalan</a></div> `;
                        }
                    },
                ],
            }).buttons().container().appendTo('#table-query_wrapper .col-ms-6:eq(0)');
        });
    </script>
</body>

</html>

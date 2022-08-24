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
                                    <a href="#" data-toggle="modal" data-target="#largeModal" class="btn btn-success btn-sm shadow-sm"><i class="fal fa-user-plus mr-1"></i> Client</a>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-sm" style="width:100%" id="table-query">
                                        <thead>
                                            <tr>
                                                <th style="width:15px;">No</th>
                                                <th>Nama</th>
                                                <th>Alamat</th>
                                                <!--<th>No Hp</th>-->
                                                <th>Hubungi</th>
                                                <th>Email</th>
                                                <th class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tr><td colspan="6"></td></tr>
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
						<form class="form-horizontal" method="post" action="<?php echo base_url().'admin/rekanan/store'?>">
							<div class="modal-body">
								<label class="text-muted font-weight-light">Nama Client</label>
								<input type="text" name="nama" class="form-control mb-2" placeholder="Nama Lengkap">
								<label class="text-muted font-weight-light">No Hp</label>
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
									<span class="input-group-text form-control bg-light">+62</span>
								  </div>
								  <input type="number" name="hp" class="form-control mb-2" placeholder="888 7766 5544">
								</div>
								<label class="text-muted font-weight-light">Alamat</label>
								<input type="text" name="alamat" class="form-control mb-2" placeholder="Alamat Saat ini">
							</div>
							<div class="modal-footer border-0">
								<div class="btn-group">
									<button class="btn btn-outline-secondary btn-sm" data-dismiss="modal" aria-hidden="true">Tutup</button>
									<button class="btn btn-outline-success btn-sm">Simpan</button>
								</div>
							</div>
						</form>
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
        $('#table-query tbody').on('click', '.ubah', function(){
            var id = $(this).attr('data-id');
            $('#modalEdit').modal('show');
            $.ajax({url:"<?php echo base_url('admin/rekanan/pisah?model=edit&id=');?>"+id,success:function(html){
                $("#ubah-content").html(html);
            }});
        });
    </script>
    <script>
        $('#table-query tbody').on('click', '.delete', function(){
            var id = $(this).attr('data-id');
            $('#modalHapus').modal('show');
            $.ajax({url:"<?php echo base_url('admin/rekanan/pisah?model=hapus&id=');?>"+id,success:function(html){
                $("#delete-content").html(html);
            }});
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
                dom: 'frtip',
                "order": [[ 0, 'desc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
                "ajax":
                {
                    "url": "<?= base_url('admin/rekanan/data');?>",
                    "type": "POST"
                },
                "deferRender": true,
                "columns": [
                    {"data": 'id',"sortable": false, 
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }  
                    },
                    { "data": "nama"},  // Tampilkan kategori
                    { "data": "alamat"},
                    { "data": "hp",
                    "render": 
                        function( data, type, row, meta ) {
                            return ` <a href="https://wa.me/62${row.hp}" target="_blank" class="btn btn-success btn-xs" data-toggle="offcanvas" role="button" data-tooltip="tooltip" data-placement="right" title="0${row.hp}"><i class="fab fa-whatsapp mr-1"></i> Hubungi</a> `;
                        }
                    },
                    { "data": "email"},
                    { "data": "id",
                    "render": 
                        function( data, type, row, meta ) {
                            return ` <div class="btn-group" role="group">
                                        <button class="btn btn-success btn-xs ubah" data-id="${row.id}" title="Edit"><i class="fal fa-sync-alt mr-1"></i>Edit</button>
                                        <button class="btn btn-danger btn-xs delete" data-id="${row.id}" title="Hapus"><i class="fal fa-trash-alt mr-1"></i> Hapus</button>
                                    </div>`;
                        }
                    },
                ],
            }).buttons().container().appendTo('#table-query_wrapper .col-ms-6:eq(0)');
        });
    </script>
    <!--END MODAL-->
<?php $this->load->view("admin/part/foo") ?>